/* ==========================================================
   SEAT Opus Global — Energy scene (services-motion.js)
   Soleil + scénarios + météo + simulateur de dimensionnement
   + compteur kWh + courbe du jour + lien partageable.
   Modèle pédagogique : toutes les valeurs sont indicatives.
   ========================================================== */

// ---- Hypothèses de dimensionnement (modifiables) ----
const PSH = 5.5;             // heures équivalent plein soleil par jour
const ETA = 0.75;            // rendement global du système
const SOC_FLOOR = 0.2;       // batterie utilisable à 80 %
const PANEL_WC = 400;        // panneau de référence
const GENSET_L_PER_KWH = 0.45; // gasoil consommé par un groupe électrogène
const DIESEL_KG_CO2_PER_L = 2.68;
const DAWN = 7.25;           // début de production visible dans la scène
const DUSK = 17;             // fin de production
const DAY_LEN = DUSK - DAWN;

// ---- Équipements proposés (puissance moyenne en W, créneaux d'usage en heures) ----
const APPLIANCES = [
	{ id: "light", label: "Éclairage LED", w: 60, slots: [[18, 23], [5, 7]], note: "6 ampoules" },
	{ id: "fan", label: "Ventilateur", w: 55, slots: [[12, 21]] },
	{ id: "tv", label: "Télévision + décodeur", w: 90, slots: [[18, 23]] },
	{ id: "fridge", label: "Réfrigérateur solaire", w: 45, slots: [[0, 24]], note: "puissance moyenne" },
	{ id: "freezer", label: "Congélateur solaire", w: 70, slots: [[0, 24]], note: "puissance moyenne" },
	{ id: "pump", label: "Pompe solaire", w: 750, slots: [[9, 15]], note: "pompage" },
	{ id: "charge", label: "Chargeurs & ordinateur", w: 40, slots: [[8, 17]] },
];
const APP_BY_ID = Object.fromEntries(APPLIANCES.map((a) => [a.id, a]));

const SCENARIOS = {
	home: { label: "Maison", equip: "ÉQUIPEMENTS", on: ["light", "fan", "tv", "fridge", "charge"] },
	pump: { label: "Pompage agricole", equip: "POMPE SOLAIRE", on: ["pump", "light", "charge"] },
	shop: { label: "Commerce & froid", equip: "FROID SOLAIRE", on: ["fridge", "freezer", "light", "fan", "charge"] },
};
const WEATHERS = ["clear", "variable", "overcast"];

// ---- Fonctions pures ----
const hourOf = (h) => ((h % 24) + 24) % 24;
const slotActive = (slot, h) => (slot[1] > slot[0] ? h >= slot[0] && h < slot[1] : h >= slot[0] || h < slot[1]);
const slotHours = (slot) => (slot[1] > slot[0] ? slot[1] - slot[0] : 24 - slot[0] + slot[1]);
const solarShape = (h) => (h <= DAWN || h >= DUSK ? 0 : Math.sin((Math.PI * (h - DAWN)) / DAY_LEN));
const weatherFactor = (mode, h) => {
	if (mode === "overcast") return 0.3;
	if (mode === "variable") return Math.min(1, Math.max(0.35, 0.72 + 0.28 * Math.sin(h * 2.3) * Math.cos(h * 0.9)));
	return 1;
};
const slotText = (a) =>
	a.slots.map((s) => (s[0] === 0 && s[1] === 24 ? "24 h/24" : `${s[0]} h–${s[1]} h`)).join(" · ");

document.querySelectorAll("[data-energy-scene]").forEach((scene) => {
	const stage = scene.querySelector(".energy-scene__stage");
	const sun = scene.querySelector("[data-energy-sun]");
	const range = scene.querySelector("[data-energy-range]");
	const timeOutput = scene.querySelector("[data-energy-time]");
	const stateOutput = scene.querySelector("[data-energy-state]");
	const playButton = scene.querySelector("[data-energy-play]");
	const playLabel = scene.querySelector("[data-energy-play-label]");
	const batteryFill = scene.querySelector("[data-energy-battery-fill]");
	const tankFill = scene.querySelector("[data-energy-tank-fill]");
	const equipLabel = scene.querySelector("[data-energy-equip-label]");
	const daylight = scene.querySelector("[data-energy-daylight]");
	const sunbeams = Array.from(scene.querySelectorAll(".energy-scene__sunbeam"));
	const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
	const $ = (sel) => scene.querySelector(sel);

	const statOut = { kw: $("[data-energy-kw]"), kwh: $("[data-energy-kwh]"), load: $("[data-energy-load]"), soc: $("[data-energy-soc]") };
	const metricBars = { solar: $(".energy-scene__metric--solar"), battery: $(".energy-scene__metric--battery"), home: $(".energy-scene__metric--home") };
	const chartSvg = $("[data-energy-chart]");
	const info = { box: $("[data-energy-info]"), title: $("[data-energy-info-title]"), text: $("[data-energy-info-text]"), close: $("[data-energy-info-close]") };
	const applianceBox = $("[data-energy-appliances]");
	const srOutput = $("[data-energy-sr]");

	const fmt0 = new Intl.NumberFormat("fr-FR", { maximumFractionDigits: 0 });
	const fmt1 = new Intl.NumberFormat("fr-FR", { minimumFractionDigits: 1, maximumFractionDigits: 1 });

	const minHour = Number(range.min);
	const maxHour = Number(range.max);
	const cycleDuration = 24000;
	const STEP = 0.05;
	const steps = Math.round((maxHour - minHour) / STEP);
	const fuelPrice = Number(scene.dataset.fuelPrice) || 750;

	// ---- État ----
	const params = new URLSearchParams(window.location.search);
	let scenario = SCENARIOS[params.get("s")] ? params.get("s") : "home";
	let weather = WEATHERS.includes(params.get("w")) ? params.get("w") : "clear";
	const selected = new Set();
	const urlApps = params.get("a");
	if (urlApps !== null) {
		urlApps.split(",").forEach((id) => APP_BY_ID[id] && selected.add(id));
	} else {
		SCENARIOS[scenario].on.forEach((id) => selected.add(id));
	}
	const urlHour = parseFloat(params.get("h"));
	const hasUrlHour = !Number.isNaN(urlHour);

	let currentHour = hasUrlHour ? Math.max(minHour, Math.min(maxHour, urlHour)) : Number(range.value);
	let lastHour = currentHour;
	let playing = !reducedMotion.matches && !hasUrlHour;
	let previousFrame = 0;
	let rafId = 0;
	let visible = !("IntersectionObserver" in window);
	let userChanged = false;
	let openPart = null;
	let sys = {};
	let tables = {};
	let live = { power: 0, load: 0, soc: 0, mode: "idle" };
	let chartParts = {};

	// ---- Dimensionnement ----
	const loadAt = (h) => {
		const x = hourOf(h);
		let kw = 0;
		selected.forEach((id) => {
			const a = APP_BY_ID[id];
			if (a.slots.some((s) => slotActive(s, x))) kw += a.w / 1000;
		});
		return kw;
	};

	const sizeSystem = () => {
		let daily = 0;
		selected.forEach((id) => {
			const a = APP_BY_ID[id];
			daily += (a.w / 1000) * a.slots.reduce((sum, s) => sum + slotHours(s), 0);
		});
		let night = 0;
		let peak = 0;
		for (let h = 0; h < 24; h += 0.25) {
			const l = loadAt(h);
			peak = Math.max(peak, l);
			if (!(h >= DAWN && h < DUSK)) night += l * 0.25;
		}
		const wc = daily > 0 ? Math.ceil((daily / (PSH * ETA)) * 10) * 100 : 0;
		const battery = daily > 0 ? Math.max(1, Math.ceil((night / (1 - SOC_FLOOR)) * 2) / 2) : 0;
		const inverter = daily > 0 ? Math.max(300, Math.ceil(peak * 12.5) * 100) : 0;
		const autonomy = daily > 0 ? (battery * (1 - SOC_FLOOR)) / (daily / 24) : 0;
		const peakKw = (wc / 1000) * PSH * ETA * Math.PI / (2 * DAY_LEN);
		return { daily, wc, battery, inverter, autonomy, peakLoad: peak, peakKw, cap: battery || 1 };
	};

	// ---- Tables : production, consommation, énergie cumulée, batterie ----
	const buildTables = () => {
		const prod = [], load = [], energy = [0];
		for (let i = 0; i <= steps; i++) {
			const h = minHour + i * STEP;
			prod.push(sys.peakKw * solarShape(h) * weatherFactor(weather, h));
			load.push(loadAt(h));
			if (i > 0) energy.push(energy[i - 1] + ((prod[i - 1] + prod[i]) / 2) * STEP);
		}
		let nightAfter = 0;
		for (let h = maxHour; h < minHour + 24; h += 0.25) nightAfter += loadAt(h) * 0.25;
		const simulate = (start) => {
			const t = [start];
			for (let i = 1; i <= steps; i++) {
				const next = t[i - 1] + ((prod[i] - load[i]) * STEP) / sys.cap;
				t.push(Math.min(1, Math.max(SOC_FLOOR, next)));
			}
			return t;
		};
		let soc = simulate(0.6);
		for (let k = 0; k < 3; k++) soc = simulate(Math.max(SOC_FLOOR, Math.min(1, soc[steps] - nightAfter / sys.cap)));
		tables = { prod, load, energy, soc };
	};

	const at = (table, h) => {
		const p = (Math.max(minHour, Math.min(maxHour, h)) - minHour) / STEP;
		const a = Math.floor(p);
		const b = Math.min(steps, a + 1);
		return table[a] + (table[b] - table[a]) * (p - a);
	};

	// ---- Graphique ----
	const CW = 600, CH = 140, PL = 12, PR = 10, PT = 10, PB = 22;
	const cx = (h) => PL + ((h - minHour) / (maxHour - minHour)) * (CW - PL - PR);

	const drawChart = () => {
		if (!chartSvg) return;
		const yMax = Math.max(0.5, ...tables.prod, ...tables.load) * 1.15;
		const cy = (v) => PT + (1 - v / yMax) * (CH - PT - PB);
		const sy = (s) => PT + (1 - s) * (CH - PT - PB);
		const base = CH - PB;
		const pts = (table, fy) => {
			const out = [];
			for (let i = 0; i <= steps; i += 4) out.push(`${cx(minHour + i * STEP).toFixed(1)} ${fy(table[i]).toFixed(1)}`);
			return out;
		};
		const prodPts = pts(tables.prod, cy);
		let ticks = "";
		for (let h = 6; h <= 18; h += 3) ticks += `<text class="energy-scene__c-tick" x="${cx(h).toFixed(1)}" y="${CH - 6}" text-anchor="middle">${h} h</text>`;
		chartSvg.innerHTML =
			`<line class="energy-scene__c-grid" x1="${PL}" x2="${CW - PR}" y1="${base}" y2="${base}"/>` +
			`<line class="energy-scene__c-grid" x1="${PL}" x2="${CW - PR}" y1="${PT}" y2="${PT}"/>` +
			`<line class="energy-scene__c-grid" x1="${PL}" x2="${CW - PR}" y1="${((PT + base) / 2).toFixed(1)}" y2="${((PT + base) / 2).toFixed(1)}"/>` +
			ticks +
			`<path class="energy-scene__c-prod" d="M${cx(minHour).toFixed(1)} ${base} L${prodPts.join(" L")} L${cx(maxHour).toFixed(1)} ${base}Z"/>` +
			`<path class="energy-scene__c-prod-line" d="M${prodPts.join(" L")}"/>` +
			`<path class="energy-scene__c-load" d="M${pts(tables.load, cy).join(" L")}"/>` +
			`<path class="energy-scene__c-soc" d="M${pts(tables.soc, sy).join(" L")}"/>` +
			`<line class="energy-scene__c-cursor" data-c="line" y1="${PT}" y2="${base}"/>` +
			`<circle class="energy-scene__c-dot" data-c="prod" r="4.5" fill="#e68a36"/>` +
			`<circle class="energy-scene__c-dot" data-c="load" r="4.5" fill="#0785bd"/>` +
			`<circle class="energy-scene__c-dot" data-c="soc" r="4.5" fill="#4fbf8b"/>`;
		chartParts = {
			line: chartSvg.querySelector('[data-c="line"]'),
			prod: chartSvg.querySelector('[data-c="prod"]'),
			load: chartSvg.querySelector('[data-c="load"]'),
			soc: chartSvg.querySelector('[data-c="soc"]'),
			cy, sy,
		};
	};

	const moveCursor = (h, power, load, soc) => {
		if (!chartParts.line) return;
		const x = cx(h).toFixed(1);
		chartParts.line.setAttribute("x1", x);
		chartParts.line.setAttribute("x2", x);
		[["prod", chartParts.cy(power)], ["load", chartParts.cy(load)], ["soc", chartParts.sy(soc)]].forEach(([key, y]) => {
			chartParts[key].setAttribute("cx", x);
			chartParts[key].setAttribute("cy", y.toFixed(1));
		});
	};

	// ---- Compteurs animés ----
	const target = { kw: 0, kwh: 0, load: 0, soc: 0 };
	const shown = { kw: 0, kwh: 0, load: 0, soc: 0 };
	let tweening = false;

	const renderStats = () => {
		if (statOut.kw) statOut.kw.textContent = fmt1.format(shown.kw);
		if (statOut.kwh) statOut.kwh.textContent = fmt1.format(shown.kwh);
		if (statOut.load) statOut.load.textContent = fmt1.format(shown.load);
		if (statOut.soc) statOut.soc.textContent = fmt0.format(shown.soc);
	};

	const tween = () => {
		let moving = false;
		Object.keys(target).forEach((key) => {
			const delta = target[key] - shown[key];
			if (reducedMotion.matches || Math.abs(delta) < 0.005) {
				shown[key] = target[key];
			} else {
				shown[key] += delta * 0.16;
				moving = true;
			}
		});
		renderStats();
		if (moving) requestAnimationFrame(tween);
		else tweening = false;
	};

	const requestTween = () => {
		if (tweening) return;
		tweening = true;
		requestAnimationFrame(tween);
	};

	const formatTime = (hour) => {
		const totalMinutes = Math.round(hour * 60);
		const hours = Math.floor(totalMinutes / 60);
		const minutes = totalMinutes % 60;
		return `${String(hours).padStart(2, "0")}:${String(minutes).padStart(2, "0")}`;
	};

	// ---- Infobulles ----
	const partInfo = (part) => {
		const mode = { charging: "se recharge", discharging: "se décharge", idle: "est au repos" }[live.mode];
		if (part === "panels") return ["Panneaux solaires", `${fmt1.format(live.power)} kW produits en ce moment, pour une installation d’environ ${fmt0.format(sys.wc)} Wc. Ils transforment la lumière en courant continu.`];
		if (part === "inverter") return ["Convertisseur & régulateur", `Il transforme le courant continu en 220 V utilisable, gère la recharge de la batterie et protège l’installation. Puissance conseillée : au moins ${fmt0.format(sys.inverter)} W.`];
		if (part === "battery") return ["Batterie", `Niveau actuel : ${fmt0.format(live.soc * 100)} % — elle ${mode}. Capacité conseillée : ${fmt1.format(sys.battery)} kWh, pour alimenter vos équipements la nuit et par temps couvert.`];
		const names = { home: "Maison", pump: "Pompage agricole", shop: "Commerce & froid solaire" }[scenario];
		return [names, `${fmt1.format(live.load)} kW consommés en ce moment. L’énergie vient directement des panneaux le jour, et de la batterie la nuit.`];
	};

	const refreshInfo = () => {
		if (!openPart || info.box.hidden) return;
		const [title, text] = partInfo(openPart);
		info.title.textContent = title;
		info.text.textContent = text;
	};

	const showInfo = (part) => {
		openPart = part;
		info.box.hidden = false;
		refreshInfo();
	};

	// ---- Mise à jour de la scène ----
	const tankFrac = (h) => (h < 9 ? 0.2 : h < 15 ? 0.2 + 0.8 * ((h - 9) / 6) : Math.max(0.2, 1 - (h - 15) * 0.2));

	const update = (hour) => {
		currentHour = Math.max(minHour, Math.min(maxHour, hour));
		hour = currentHour;
		const progress = Math.max(0, Math.min(1, (hour - minHour) / (maxHour - minHour)));
		const x = 83 + progress * 791;
		const y = 303 - Math.sin(Math.PI * progress) * 240;
		const isNight = hour < DAWN || hour >= DUSK;
		const phase = isNight ? "night" : hour < 9 ? "morning" : hour > 15.5 ? "evening" : "day";

		const power = at(tables.prod, hour);
		const load = at(tables.load, hour);
		const soc = at(tables.soc, hour);
		const net = power - load;
		const mode = net > 0.03 && soc < 0.995 ? "charging" : net < -0.03 && soc > SOC_FLOOR + 0.005 ? "discharging" : "idle";
		const sunRatio = sys.peakKw > 0 ? Math.min(1, power / sys.peakKw) : 0;
		const wf = weatherFactor(weather, hour);
		live = { power, load, soc, mode };

		sun.setAttribute("transform", `translate(${x.toFixed(1)} ${y.toFixed(1)})`);
		sunbeams.forEach((beam, index) => {
			const targetX = index === 0 ? 205 : 285;
			beam.setAttribute("d", `M${(x - 11 + index * 16).toFixed(1)} ${(y + 22).toFixed(1)}L${targetX} 346`);
		});
		stage.dataset.phase = phase;
		stage.dataset.battery = mode;
		stage.dataset.scenario = scenario;
		stage.dataset.weather = weather;
		const pumpOn = selected.has("pump") && slotActive(APP_BY_ID.pump.slots[0], hour) && power > 0.02;
		stage.dataset.pump = pumpOn ? "on" : "off";
		const st = stage.style;
		st.setProperty("--sun", sunRatio.toFixed(3));
		st.setProperty("--weather", wf.toFixed(3));
		st.setProperty("--flow-solar", sunRatio.toFixed(3));
		st.setProperty("--flow-battery", Math.min(1, Math.abs(net) / Math.max(sys.peakKw, 0.3) + 0.12).toFixed(3));
		st.setProperty("--flow-home", Math.min(1, load / Math.max(sys.peakLoad, 0.3)).toFixed(3));

		range.value = String(hour);
		range.setAttribute("aria-valuetext", `${formatTime(hour)}${isNight ? ", la batterie alimente les usages" : ", le soleil produit de l’énergie"}`);
		timeOutput.textContent = formatTime(hour);
		const batteryHeight = 70 * soc;
		batteryFill.setAttribute("y", String(460 - batteryHeight));
		batteryFill.setAttribute("height", String(batteryHeight));
		if (tankFill) {
			const h = 62 * tankFrac(hour);
			tankFill.setAttribute("y", String(328 - h));
			tankFill.setAttribute("height", String(h));
		}
		daylight.style.setProperty("--daylight-progress", `${progress * 100}%`);

		const empty = soc <= SOC_FLOOR + 0.01 && net < 0;
		stateOutput.textContent = sys.daily === 0
			? "Sélectionnez au moins un équipement pour lancer la simulation."
			: isNight
			? empty && sys.daily > 0
				? "La batterie est à son minimum : il faudrait une batterie plus grande."
				: "La batterie prend le relais pour alimenter les usages."
			: empty && sys.daily > 0
				? "Production insuffisante : un groupe d’appoint serait nécessaire."
				: mode === "idle" && soc >= 0.995
					? "La batterie est pleine : le soleil alimente directement les équipements."
					: weather === "overcast"
						? "Ciel couvert : la production chute, la batterie compense."
						: phase === "morning"
							? "La production solaire démarre et la batterie se recharge."
							: phase === "evening"
								? "La production baisse ; la batterie garde l’énergie."
								: "Le soleil alimente les équipements et recharge la batterie.";

		if (metricBars.solar) metricBars.solar.style.setProperty("--level", `${Math.round(sunRatio * 100)}%`);
		if (metricBars.battery) metricBars.battery.style.setProperty("--level", `${Math.round(soc * 100)}%`);
		if (metricBars.home) metricBars.home.style.setProperty("--level", `${Math.round(Math.min(1, load / Math.max(sys.peakLoad, 0.3)) * 100)}%`);

		target.kw = power;
		target.kwh = at(tables.energy, hour);
		target.load = load;
		target.soc = soc * 100;
		if (hour < lastHour - 3) shown.kwh = 0;
		lastHour = hour;
		requestTween();
		moveCursor(hour, power, load, soc);
		refreshInfo();
	};

	// ---- Résultats du simulateur ----
	const setText = (sel, value) => {
		const el = $(sel);
		if (el) el.textContent = value;
	};

	const renderResults = () => {
		const none = sys.daily === 0;
		const dash = "—";
		setText('[data-energy-res="daily"]', none ? dash : `${fmt1.format(sys.daily)} kWh`);
		setText('[data-energy-res-sub="daily"]', none ? "Choisissez au moins un équipement" : `soit ${fmt0.format((sys.daily / 24) * 1000)} W en moyenne`);
		setText('[data-energy-res="panels"]', none ? dash : `${fmt0.format(sys.wc)} Wc`);
		setText('[data-energy-res-sub="panels"]', none ? "" : sys.wc >= PANEL_WC ? `≈ ${Math.ceil(sys.wc / PANEL_WC)} panneaux de ${PANEL_WC} Wc` : "kit solaire compact");
		setText('[data-energy-res="battery"]', none ? dash : `${fmt1.format(sys.battery)} kWh`);
		setText('[data-energy-res-sub="battery"]', none ? "" : `${fmt1.format(sys.battery * (1 - SOC_FLOOR))} kWh utilisables`);
		setText('[data-energy-res="inverter"]', none ? dash : `≥ ${fmt0.format(sys.inverter)} W`);
		setText('[data-energy-res-sub="inverter"]', none ? "" : `pic de ${fmt0.format(sys.peakLoad * 1000)} W`);
		setText('[data-energy-res="autonomy"]', none ? dash : `${fmt0.format(sys.autonomy)} h`);
		setText('[data-energy-res-sub="autonomy"]', none ? "" : "sans soleil, usage moyen");
		const fuelMonth = sys.daily * GENSET_L_PER_KWH * 30;
		setText('[data-energy-sav="money"]', none ? dash : `${fmt0.format(fuelMonth * fuelPrice)} FCFA`);
		setText('[data-energy-sav="fuel"]', none ? dash : `${fmt0.format(fuelMonth)} L`);
		setText('[data-energy-sav="co2"]', none ? dash : `${fmt0.format(fuelMonth * DIESEL_KG_CO2_PER_L)} kg`);
		setText("[data-energy-assumptions]",
			`Estimation indicative : ${fmt1.format(PSH)} h de plein soleil par jour, rendement système ${Math.round(ETA * 100)} %, batterie utilisable à ${Math.round((1 - SOC_FLOOR) * 100)} %. ` +
			`Économies calculées en remplaçant un groupe électrogène (${GENSET_L_PER_KWH.toString().replace(".", ",")} L/kWh, gasoil à ${fmt0.format(fuelPrice)} FCFA/L). ` +
			`Un technicien SEAT Opus Global affine le dimensionnement sur site.`);
		if (userChanged && srOutput) {
			srOutput.textContent = none
				? "Aucun équipement sélectionné."
				: `${SCENARIOS[scenario].label} : ${fmt1.format(sys.daily)} kWh par jour, ${fmt0.format(sys.wc)} Wc de panneaux, batterie ${fmt1.format(sys.battery)} kWh.`;
		}
	};

	const syncUrl = () => {
		try {
			const p = new URLSearchParams(window.location.search);
			p.set("s", scenario);
			p.set("w", weather);
			p.set("a", [...selected].join(",") || "none");
			p.set("h", currentHour.toFixed(2));
			window.history.replaceState(null, "", `${window.location.pathname}?${p.toString()}#energie`);
		} catch (e) { /* aperçu sans historique */ }
	};

	const rebuild = () => {
		sys = sizeSystem();
		buildTables();
		drawChart();
		renderResults();
		update(currentHour);
	};

	const afterUserChange = () => {
		userChanged = true;
		rebuild();
		syncUrl();
	};

	// ---- Scénarios ----
	const tabs = Array.from(scene.querySelectorAll("[data-energy-scenario]"));
	const syncAppliances = () => {
		if (!applianceBox) return;
		applianceBox.querySelectorAll("input").forEach((input) => { input.checked = selected.has(input.value); });
	};
	const syncTabs = () => {
		tabs.forEach((tab) => {
			const on = tab.dataset.energyScenario === scenario;
			tab.setAttribute("aria-selected", String(on));
			tab.tabIndex = on ? 0 : -1;
		});
		if (equipLabel) equipLabel.textContent = SCENARIOS[scenario].equip;
	};
	const setScenario = (id, focus) => {
		scenario = id;
		selected.clear();
		SCENARIOS[id].on.forEach((a) => selected.add(a));
		syncTabs();
		syncAppliances();
		if (info.box) info.box.hidden = true;
		openPart = null;
		afterUserChange();
		if (focus) tabs.find((t) => t.dataset.energyScenario === id).focus();
	};
	tabs.forEach((tab, index) => {
		tab.addEventListener("click", () => setScenario(tab.dataset.energyScenario));
		tab.addEventListener("keydown", (event) => {
			if (event.key !== "ArrowRight" && event.key !== "ArrowLeft") return;
			event.preventDefault();
			const next = (index + (event.key === "ArrowRight" ? 1 : tabs.length - 1)) % tabs.length;
			setScenario(tabs[next].dataset.energyScenario, true);
		});
	});

	// ---- Équipements ----
	if (applianceBox) {
		APPLIANCES.forEach((a) => {
			const label = document.createElement("label");
			label.className = "energy-scene__appliance";
			label.innerHTML =
				`<input type="checkbox" value="${a.id}"><span class="energy-scene__appliance-body"><b>${a.label}</b>` +
				`<small>${a.w} W${a.note ? ` (${a.note})` : ""} · ${slotText(a)}</small></span><span class="energy-scene__appliance-check" aria-hidden="true"></span>`;
			label.querySelector("input").addEventListener("change", (event) => {
				if (event.target.checked) selected.add(a.id);
				else selected.delete(a.id);
				afterUserChange();
			});
			applianceBox.appendChild(label);
		});
		syncAppliances();
	}

	// ---- Météo ----
	scene.querySelectorAll('input[name="energy-weather"]').forEach((radio) => {
		radio.checked = radio.value === weather;
		radio.addEventListener("change", () => {
			weather = radio.value;
			afterUserChange();
		});
	});

	// ---- Infobulles : clic, clavier ----
	scene.querySelectorAll("[data-energy-part]").forEach((part) => {
		const open = () => showInfo(part.dataset.energyPart);
		part.addEventListener("click", open);
		part.addEventListener("keydown", (event) => {
			if (event.key === "Enter" || event.key === " ") {
				event.preventDefault();
				open();
			}
		});
	});
	if (info.close) info.close.addEventListener("click", () => { info.box.hidden = true; openPart = null; });

	// ---- Graphique : toucher / glisser pour changer l'heure ----
	if (chartSvg) {
		let dragging = false;
		const scrub = (event) => {
			const rect = chartSvg.getBoundingClientRect();
			const px = ((event.clientX - rect.left) / rect.width) * CW;
			const hour = minHour + ((px - PL) / (CW - PL - PR)) * (maxHour - minHour);
			setPlaying(false);
			update(hour);
		};
		chartSvg.addEventListener("pointerdown", (event) => {
			dragging = true;
			if (chartSvg.setPointerCapture) chartSvg.setPointerCapture(event.pointerId);
			scrub(event);
		});
		chartSvg.addEventListener("pointermove", (event) => { if (dragging) scrub(event); });
		const stop = () => { if (dragging) { dragging = false; syncUrl(); } };
		chartSvg.addEventListener("pointerup", stop);
		chartSvg.addEventListener("pointercancel", stop);
	}

	// ---- Devis et partage ----
	const quote = $("[data-energy-quote]");
	if (quote) {
		quote.addEventListener("click", () => {
			const list = [...selected].map((id) => APP_BY_ID[id].label).join(", ") || "à préciser";
			const message =
				`Bonjour SEAT Opus Global, je souhaite un devis (${SCENARIOS[scenario].label}). Équipements : ${list}. ` +
				`Estimation du simulateur : ${fmt0.format(sys.wc)} Wc de panneaux, batterie ${fmt1.format(sys.battery)} kWh, convertisseur ≥ ${fmt0.format(sys.inverter)} W.`;
			const wa = (scene.dataset.wa || "").replace(/\D/g, "");
			if (wa) window.open(`https://wa.me/${wa}?text=${encodeURIComponent(message)}`, "_blank", "noopener");
			else window.location.href = `${scene.dataset.contact || "contact.php"}?message=${encodeURIComponent(message)}`;
		});
	}
	const share = $("[data-energy-share]");
	if (share) {
		share.addEventListener("click", () => {
			syncUrl();
			const done = () => {
				const old = share.textContent;
				share.textContent = "Lien copié";
				setTimeout(() => { share.textContent = old; }, 1800);
			};
			if (navigator.clipboard && navigator.clipboard.writeText) navigator.clipboard.writeText(window.location.href).then(done, done);
			else done();
		});
	}

	// ---- Lecture / pause ----
	const startLoop = () => {
		if (playing && visible && !rafId) rafId = requestAnimationFrame(animate);
	};

	const setPlaying = (nextPlaying) => {
		playing = nextPlaying && !reducedMotion.matches;
		playButton.setAttribute("aria-pressed", String(playing));
		playButton.setAttribute("aria-label", playing ? "Mettre en pause l’animation du soleil" : "Lancer l’animation du soleil");
		playLabel.textContent = playing ? "Mettre en pause" : "Lancer la journée";
		stateOutput.setAttribute("aria-live", playing ? "off" : "polite");
		previousFrame = 0;
		startLoop();
	};

	const animate = (timestamp) => {
		rafId = 0;
		if (!playing || !visible) {
			previousFrame = 0;
			return;
		}
		if (!previousFrame) previousFrame = timestamp;
		const elapsed = timestamp - previousFrame;
		previousFrame = timestamp;
		const nextHour = currentHour + (elapsed / cycleDuration) * (maxHour - minHour);
		update(nextHour > maxHour ? minHour + (nextHour - maxHour) : nextHour);
		rafId = requestAnimationFrame(animate);
	};

	if ("IntersectionObserver" in window) {
		new IntersectionObserver((entries) => {
			visible = entries[0].isIntersecting;
			scene.classList.toggle("is-offscreen", !visible);
			if (visible) startLoop();
		}, { threshold: 0.05 }).observe(scene);
	}

	range.addEventListener("input", () => {
		update(Number(range.value));
		syncUrl();
	});
	playButton.addEventListener("click", () => setPlaying(!playing));
	const handleMotionPreference = () => {
		if (reducedMotion.matches) setPlaying(false);
	};
	if (typeof reducedMotion.addEventListener === "function") reducedMotion.addEventListener("change", handleMotionPreference);
	else reducedMotion.addListener(handleMotionPreference);

	// ---- Démarrage ----
	syncTabs();
	rebuild();
	setPlaying(playing);
});