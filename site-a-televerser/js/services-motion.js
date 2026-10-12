/* ==========================================================
   SEAT Opus Global — Energy scene (services-motion.js)
   Cycle du soleil + compteur kWh animé + flux proportionnels
   à l'ensoleillement. Modèle pédagogique : valeurs illustratives.
   ========================================================== */

// Installation d'exemple
const PEAK_KW = 2.4;      // puissance solaire au zénith
const BATTERY_KWH = 5;    // capacité de stockage
const SOC_FLOOR = 0.12;   // niveau minimal de la batterie
const LOAD_REF_KW = 1;    // consommation de référence (barre à 100 %)
const DAWN = 7.25;        // début de production
const DUSK = 17;          // fin de production
const DAY_LEN = DUSK - DAWN;

const gauss = (h, center, width) => Math.exp(-(((h - center) / width) ** 2));
const solarPower = (h) => (h <= DAWN || h >= DUSK ? 0 : PEAK_KW * Math.sin((Math.PI * (h - DAWN)) / DAY_LEN));
const homeLoad = (h) => 0.3 + 0.45 * gauss(h, 7.5, 1.1) + 0.2 * gauss(h, 12.8, 1) + 0.55 * gauss(h, 18, 1.6);
const energyProduced = (h) => {
	if (h <= DAWN) return 0;
	const total = (PEAK_KW * 2 * DAY_LEN) / Math.PI;
	if (h >= DUSK) return total;
	return (PEAK_KW * DAY_LEN / Math.PI) * (1 - Math.cos((Math.PI * (h - DAWN)) / DAY_LEN));
};

document.querySelectorAll("[data-energy-scene]").forEach((scene) => {
	const stage = scene.querySelector(".energy-scene__stage");
	const sun = scene.querySelector("[data-energy-sun]");
	const range = scene.querySelector("[data-energy-range]");
	const timeOutput = scene.querySelector("[data-energy-time]");
	const stateOutput = scene.querySelector("[data-energy-state]");
	const playButton = scene.querySelector("[data-energy-play]");
	const playLabel = scene.querySelector("[data-energy-play-label]");
	const batteryFill = scene.querySelector("[data-energy-battery-fill]");
	const daylight = scene.querySelector("[data-energy-daylight]");
	const sunbeams = Array.from(scene.querySelectorAll(".energy-scene__sunbeam"));
	const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");

	// Compteurs et indicateurs (facultatifs : la scène marche sans)
	const statOut = {
		kw: scene.querySelector("[data-energy-kw]"),
		kwh: scene.querySelector("[data-energy-kwh]"),
		load: scene.querySelector("[data-energy-load]"),
		soc: scene.querySelector("[data-energy-soc]"),
	};
	const metricBars = {
		solar: scene.querySelector(".energy-scene__metric--solar"),
		battery: scene.querySelector(".energy-scene__metric--battery"),
		home: scene.querySelector(".energy-scene__metric--home"),
	};
	const fmt1 = new Intl.NumberFormat("fr-FR", { minimumFractionDigits: 1, maximumFractionDigits: 1 });
	const fmt0 = new Intl.NumberFormat("fr-FR", { maximumFractionDigits: 0 });

	const minHour = Number(range.min);
	const maxHour = Number(range.max);
	const cycleDuration = 24000;
	let playing = !reducedMotion.matches;
	let previousFrame = 0;
	let currentHour = Number(range.value);
	let lastHour = currentHour;

	// ---- Batterie : état de charge simulé une fois, lu ensuite par interpolation ----
	const STEP = 0.05;
	const steps = Math.round((maxHour - minHour) / STEP);
	const simulate = (startSoc) => {
		const table = [startSoc];
		for (let i = 1; i <= steps; i++) {
			const h = minHour + i * STEP;
			const next = table[i - 1] + ((solarPower(h) - homeLoad(h)) * STEP) / BATTERY_KWH;
			table.push(Math.min(1, Math.max(SOC_FLOOR, next)));
		}
		return table;
	};
	// Deux passes : le niveau de départ tient compte de la consommation de la nuit précédente
	let socTable = simulate(0.35);
	socTable = simulate(Math.max(SOC_FLOOR, socTable[steps] - (0.3 * 12) / BATTERY_KWH));
	const socAt = (h) => {
		const p = (Math.max(minHour, Math.min(maxHour, h)) - minHour) / STEP;
		const a = Math.floor(p);
		const b = Math.min(steps, a + 1);
		return socTable[a] + (socTable[b] - socTable[a]) * (p - a);
	};

	// ---- Compteur animé : les valeurs affichées glissent vers leur cible ----
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
		if (moving) {
			requestAnimationFrame(tween);
		} else {
			tweening = false;
		}
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

	const update = (hour) => {
		currentHour = Math.max(minHour, Math.min(maxHour, hour));
		hour = currentHour;
		const progress = Math.max(0, Math.min(1, (hour - minHour) / (maxHour - minHour)));
		const angle = Math.PI * progress;
		const x = 83 + progress * 791;
		const y = 303 - Math.sin(angle) * 240;
		const isNight = hour < DAWN || hour >= DUSK;
		const phase = isNight ? "night" : hour < 9 ? "morning" : hour > 15.5 ? "evening" : "day";

		// Énergie : production, consommation, batterie
		const power = solarPower(hour);
		const load = homeLoad(hour);
		const soc = socAt(hour);
		const net = power - load;
		const batteryMode = net > 0.05 && soc < 0.995 ? "charging" : net < -0.05 && soc > SOC_FLOOR + 0.005 ? "discharging" : "idle";
		const sunRatio = power / PEAK_KW;
		const batteryHeight = 70 * soc;

		sun.setAttribute("transform", `translate(${x.toFixed(1)} ${y.toFixed(1)})`);
		sunbeams.forEach((beam, index) => {
			const targetX = index === 0 ? 205 : 285;
			beam.setAttribute("d", `M${(x - 11 + index * 16).toFixed(1)} ${(y + 22).toFixed(1)}L${targetX} 346`);
		});
		stage.dataset.phase = phase;
		stage.dataset.battery = batteryMode;
		stage.style.setProperty("--sun", sunRatio.toFixed(3));
		stage.style.setProperty("--flow-solar", sunRatio.toFixed(3));
		stage.style.setProperty("--flow-battery", Math.min(1, Math.abs(net) / PEAK_KW + 0.12).toFixed(3));
		stage.style.setProperty("--flow-home", Math.min(1, load / LOAD_REF_KW).toFixed(3));
		range.value = String(hour);
		range.setAttribute("aria-valuetext", `${formatTime(hour)}${isNight ? ", la batterie alimente les usages" : ", le soleil produit de l’énergie"}`);
		timeOutput.textContent = formatTime(hour);
		batteryFill.setAttribute("y", String(460 - batteryHeight));
		batteryFill.setAttribute("height", String(batteryHeight));
		daylight.style.setProperty("--daylight-progress", `${progress * 100}%`);
		stateOutput.textContent = isNight
			? "La batterie prend le relais pour alimenter les usages."
			: batteryMode === "idle" && soc >= 0.995
				? "La batterie est pleine : le soleil alimente directement la maison."
				: phase === "morning"
					? "La production solaire démarre et la batterie se recharge."
					: phase === "evening"
						? "La production baisse ; la batterie garde l’énergie."
						: "Le soleil alimente la maison et recharge la batterie.";

		// Barres d'indicateurs (valeurs exactes)
		if (metricBars.solar) metricBars.solar.style.setProperty("--level", `${Math.round(sunRatio * 100)}%`);
		if (metricBars.battery) metricBars.battery.style.setProperty("--level", `${Math.round(soc * 100)}%`);
		if (metricBars.home) metricBars.home.style.setProperty("--level", `${Math.round(Math.min(1, load / LOAD_REF_KW) * 100)}%`);

		// Compteurs : à chaque nouvelle journée, on repart de zéro sans glisser en arrière
		target.kw = power;
		target.kwh = energyProduced(hour);
		target.load = load;
		target.soc = soc * 100;
		if (hour < lastHour - 3) shown.kwh = 0;
		lastHour = hour;
		requestTween();
	};

	const setPlaying = (nextPlaying) => {
		playing = nextPlaying && !reducedMotion.matches;
		playButton.setAttribute("aria-pressed", String(playing));
		playButton.setAttribute("aria-label", playing ? "Mettre en pause l’animation du soleil" : "Lancer l’animation du soleil");
		playLabel.textContent = playing ? "Mettre en pause" : "Lancer la journée";
		previousFrame = 0;
		if (playing) requestAnimationFrame(animate);
	};

	const animate = (timestamp) => {
		if (!playing) return;
		if (!previousFrame) previousFrame = timestamp;
		const elapsed = timestamp - previousFrame;
		previousFrame = timestamp;
		const nextHour = currentHour + (elapsed / cycleDuration) * (maxHour - minHour);
		update(nextHour > maxHour ? minHour + (nextHour - maxHour) : nextHour);
		requestAnimationFrame(animate);
	};

	range.addEventListener("input", () => update(Number(range.value)));
	playButton.addEventListener("click", () => setPlaying(!playing));
	const handleMotionPreference = () => {
		if (reducedMotion.matches) setPlaying(false);
	};
	if (typeof reducedMotion.addEventListener === "function") {
		reducedMotion.addEventListener("change", handleMotionPreference);
	} else {
		reducedMotion.addListener(handleMotionPreference);
	}

	update(Number(range.value));
	setPlaying(playing);
});