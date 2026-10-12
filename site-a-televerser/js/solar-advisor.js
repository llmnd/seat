/* ==========================================================================
   SEAT Opus Global — assistant solaire
   Conversation guidée + dimensionnement indicatif + simulation d'une journée.
   Les appareils sont calculés dans le navigateur ; seules la ville et la
   configuration des panneaux servent à interroger les services de données.
   ========================================================================== */
(() => {
	'use strict';

	const root = document.querySelector('[data-solar-advisor]');
	if (!root) return;

	const backdrop = document.querySelector('[data-nour-backdrop]');
	const launcher = document.querySelector('[data-nour-launcher]');
	const closeButton = root.querySelector('[data-nour-close]');
	const viewToggle = root.querySelector('[data-sa-view-toggle]');
	let returnFocus = null;

	const closeAssistant = () => {
		backdrop.hidden = true;
		root.classList.remove('sa-show-viz');
		viewToggle.setAttribute('aria-expanded', 'false');
		viewToggle.textContent = 'Résultat';
		document.body.classList.remove('sa-dialog-open');
		if (returnFocus instanceof HTMLElement) returnFocus.focus({ preventScroll: true });
	};

	const openAssistant = (trigger) => {
		returnFocus = trigger instanceof HTMLElement ? trigger : launcher;
		backdrop.hidden = false;
		document.body.classList.add('sa-dialog-open');
		closeButton.focus({ preventScroll: true });
		start();
	};

	launcher.hidden = false;
	launcher.addEventListener('click', () => openAssistant(launcher));
	document.querySelectorAll('[data-nour-open]').forEach((trigger) => {
		trigger.addEventListener('click', (event) => {
			event.preventDefault();
			openAssistant(trigger);
		});
	});
	closeButton.addEventListener('click', closeAssistant);
	viewToggle.addEventListener('click', () => {
		const showViz = !root.classList.contains('sa-show-viz');
		root.classList.toggle('sa-show-viz', showViz);
		viewToggle.setAttribute('aria-expanded', String(showViz));
		viewToggle.textContent = showViz ? 'Chat' : 'Résultat';
	});
	backdrop.addEventListener('click', (event) => {
		if (event.target === backdrop) closeAssistant();
	});
	document.addEventListener('keydown', (event) => {
		if (backdrop.hidden) return;
		if (event.key === 'Escape') {
			event.preventDefault();
			closeAssistant();
			return;
		}

		if (event.key !== 'Tab') return;
		const focusable = Array.from(root.querySelectorAll(
			'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
		)).filter((element) => element.getClientRects().length > 0);
		if (!focusable.length) {
			event.preventDefault();
			root.focus();
			return;
		}

		const first = focusable[0];
		const last = focusable[focusable.length - 1];
		if (!root.contains(document.activeElement)) {
			event.preventDefault();
			(event.shiftKey ? last : first).focus();
		} else if (event.shiftKey && document.activeElement === first) {
			event.preventDefault();
			last.focus();
		} else if (!event.shiftKey && document.activeElement === last) {
			event.preventDefault();
			first.focus();
		}
	});

	const log = root.querySelector('[data-sa-log]');
	const viz = root.querySelector('[data-sa-viz]');
	const chartEl = root.querySelector('[data-sa-chart]');
	const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	const nf = new Intl.NumberFormat('fr-FR', { maximumFractionDigits: 1 });

	/* ---------- Hypothèses de dimensionnement et valeurs de repli ---------- */
	const PSH = 5;            // heures équivalentes par jour, utilisées si les données locales échouent
	const LOSS = 0.85;        // chaleur, poussière, câbles
	const PANEL_W = 550;      // panneau moderne courant
	const PANEL_M2 = 2.6;     // surface d'un panneau de 550 W
	const DOD = 0.8;          // décharge utile d'une batterie lithium (LiFePO4)
	const ETA_DIRECT = 0.85;  // panneaux → appareils (onduleur, câbles)
	const ETA_BATT = 0.75;    // panneaux → batterie → appareils
	const INVERTERS = [300, 500, 800, 1000, 1500, 2000, 3000, 5000, 8000, 10000, 15000, 20000];
	const MONTH_NAMES = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
	const COMPASS = [
		{ label: 'Nord', aspect: -180 },
		{ label: 'Nord-est', aspect: -135 },
		{ label: 'Est', aspect: -90 },
		{ label: 'Sud-est', aspect: -45 },
		{ label: 'Sud', aspect: 0 },
		{ label: 'Sud-ouest', aspect: 45 },
		{ label: 'Ouest', aspect: 90 },
		{ label: 'Nord-ouest', aspect: 135 }
	];

	/* when : day = le jour · night = soir et nuit · all = jour et nuit (50/50) */
	const APP = {
		led:     { n: 'Lampe LED',                 w: 10,  h: 5,  when: 'night' },
		fan:     { n: 'Ventilateur',               w: 60,  h: 8,  when: 'all' },
		tv:      { n: 'Téléviseur',                w: 100, h: 4,  when: 'night' },
		laptop:  { n: 'Ordinateur portable',       w: 65,  h: 6,  when: 'day' },
		phone:   { n: 'Chargeur de téléphone',     w: 10,  h: 3,  when: 'all' },
		router:  { n: 'Box internet',              w: 12,  h: 24, when: 'all' },
		fridge:  { n: 'Réfrigérateur',             w: 150, h: 24, when: 'all',   duty: 0.4,  motor: 3 },
		freezer: { n: 'Congélateur',               w: 200, h: 24, when: 'all',   duty: 0.4,  motor: 3 },
		ac:      { n: 'Climatiseur (1 CV)',        w: 900, h: 8,  when: 'night', duty: 0.6,  motor: 3.5 },
		pump:    { n: 'Pompe immergée (1 CV)',     w: 750, h: 6,  when: 'day',   motor: 3 },
		custom:  { n: 'Autre appareil',            w: 100, h: 4,  when: 'all' }
	};

	const WHEN_OPTIONS = { day: 'Jour', night: 'Soir et nuit', all: 'Jour et nuit' };

	const PRESETS = [
		{ label: 'Une maison', phrase: 'une maison', items: [['led', 6], ['fan', 2], ['tv', 1], ['fridge', 1], ['phone', 3], ['laptop', 1]] },
		{ label: 'Un commerce ou un bureau', phrase: 'un commerce ou un bureau', items: [['led', 8], ['fan', 3], ['laptop', 2], ['fridge', 1], ['freezer', 1], ['router', 1]] },
		{ label: 'Une ferme ou un point d’eau', phrase: 'une ferme ou un point d’eau', items: [['pump', 1], ['led', 4], ['phone', 2], ['fridge', 1]] },
		{ label: 'Je choisis moi-même', phrase: 'votre projet', items: [] }
	];

	const makeItem = (id, qty) => ({ id, qty, hours: APP[id].h, watts: APP[id].w, when: APP[id].when });

	const state = {
		items: [], night: true, phrase: 'votre projet', interacted: false, hour: 12,
		swept: false, res: null, location: null, solar: null, source: 'none',
		daylight: { sunrise: 6, sunset: 18 }
	};

	/* ---------- Calcul ---------- */
	function nextInverter(w) {
		return INVERTERS.find((s) => s >= w) || Math.ceil(w / 1000) * 1000;
	}

	function compute(items, night, irradiation = PSH, daylight = state.daylight) {
		let dayWh = 0, nightWh = 0, running = 0, surge = 0;

		items.forEach((it) => {
			const a = APP[it.id];
			const w = it.watts || a.w;
			const energy = w * it.qty * it.hours * (a.duty || 1);
			const when = it.when || a.when;
			const nightShare = when === 'night' ? 1 : when === 'day' ? 0 : 0.5;
			nightWh += energy * nightShare;
			dayWh += energy * (1 - nightShare);
			running += w * it.qty;
			if (a.motor) surge = Math.max(surge, w * (a.motor - 1)); // un moteur démarre à la fois
		});

		const nightServed = night ? nightWh : 0;
		if (dayWh + nightWh <= 0) return null;

		const effectiveIrradiation = irradiation * LOSS;
		const needWp = (dayWh / ETA_DIRECT + nightServed / ETA_BATT) / effectiveIrradiation;
		const panels = needWp > 0 ? Math.max(1, Math.ceil(needWp / PANEL_W)) : 0;
		const wp = panels * PANEL_W;
		const producedKwh = (wp * effectiveIrradiation) / 1000;
		const batteryKwh = nightServed ? nightServed / (DOD * 0.9) / 1000 : 0;
		const inverter = nextInverter((running * 0.7 + surge) * 1.25);

		// Courbe de production : cloche du lever au coucher, normalisée sur l'énergie du jour
		let area = 0;
		for (let i = 0; i < 240; i++) area += prodShape(i / 10, daylight) / 10;
		const k = (wp * effectiveIrradiation) / area;

		const cons = new Array(24).fill(0);
		for (let h = 0; h < 24; h++) {
			const dayOverlap = Math.max(0, Math.min(h + 1, daylight.sunset) - Math.max(h, daylight.sunrise));
			const nightOverlap = 1 - dayOverlap;
			cons[h] = dayWh * dayOverlap / (daylight.sunset - daylight.sunrise)
				+ nightWh * nightOverlap / (24 - (daylight.sunset - daylight.sunrise));
		}

		return {
			dayWh, nightWh, nightServed, panels, wp, producedKwh, batteryKwh, inverter, irradiation,
			demandKwh: (dayWh + nightServed) / 1000,
			area: panels * PANEL_M2, k, peak: k, cons,
			consMax: Math.max(...cons)
		};
	}

	function prodShape(h, daylight = state.daylight) {
		const x = (h - daylight.sunrise) / (daylight.sunset - daylight.sunrise);
		return x <= 0 || x >= 1 ? 0 : Math.pow(Math.sin(Math.PI * x), 1.6);
	}

	function daylightWindow(latitude, month) {
		const dayOfYear = Math.floor((Date.UTC(2023, month - 1, 15) - Date.UTC(2023, 0, 0)) / 86400000);
		const declination = 23.44 * Math.sin((2 * Math.PI * (284 + dayOfYear)) / 365);
		const latitudeRad = (Math.max(-89.8, Math.min(89.8, latitude)) * Math.PI) / 180;
		const declinationRad = (declination * Math.PI) / 180;
		const hourAngleCos = -Math.tan(latitudeRad) * Math.tan(declinationRad);
		if (hourAngleCos >= 1) return { sunrise: 11.5, sunset: 12.5 };
		if (hourAngleCos <= -1) return { sunrise: 0.5, sunset: 23.5 };
		const dayLength = Math.max(1, Math.min(23, (24 * Math.acos(hourAngleCos)) / Math.PI));
		return { sunrise: 12 - dayLength / 2, sunset: 12 + dayLength / 2 };
	}

	/* ---------- Formats ---------- */
	const fmtWp = (wp) => (wp >= 1000 ? `${nf.format(wp / 1000)} kWc` : `${wp} Wc`);
	const fmtVA = (w) => (w >= 1000 ? `${nf.format(w / 1000)} kVA` : `${w} VA`);

	/* ---------- Graphique SVG ---------- */
	const STARS = [[.02,.1,1.2],[.06,.35,1],[.1,.18,1.4],[.14,.5,1],[.18,.08,1],[.21,.3,1.2],[.235,.15,1],[.77,.12,1.2],[.8,.4,1],[.84,.2,1.4],[.88,.08,1],[.92,.45,1],[.95,.22,1.2],[.985,.12,1]];

	function chart(res) {
		const small = window.matchMedia('(max-width: 600px)').matches;
		const FS = small ? 21 : 12;
		const W = 640, H = small ? 280 : 300, L = 10, R = 10, T = small ? 36 : 28, B = small ? 46 : 38;
		const pw = W - L - R, ph = H - T - B;
		const X = (h) => L + (h / 24) * pw;
		const max = Math.max(res.peak, res.consMax, 1) * 1.2;
		const Y = (v) => T + ph - (v / max) * ph;
		const daylight = state.daylight;
		const dayMidpoint = (daylight.sunrise + daylight.sunset) / 2;

		let line = '';
		for (let i = 0; i <= 96; i++) {
			const h = i / 4;
			line += `${i ? 'L' : 'M'}${X(h).toFixed(1)} ${Y(res.k * prodShape(h, daylight)).toFixed(1)}`;
		}
		const area = `${line}L${X(24).toFixed(1)} ${Y(0).toFixed(1)}L${X(0).toFixed(1)} ${Y(0).toFixed(1)}Z`;

		let bars = '';
		res.cons.forEach((v, h) => {
			if (v <= 0) return;
			const isNight = h + 0.5 < state.daylight.sunrise || h + 0.5 >= state.daylight.sunset;
			bars += `<rect x="${(X(h) + 1.5).toFixed(1)}" y="${Y(v).toFixed(1)}" width="${(pw / 24 - 3).toFixed(1)}" height="${(Y(0) - Y(v)).toFixed(1)}" rx="3" fill="${isNight ? '#0093d9' : '#7fd3f7'}" fill-opacity="${isNight ? '.9' : '.6'}"/>`;
		});

		const stars = STARS.map(([fx, fy, r], index) => {
			const starHour = index < 7
				? (fx / .235) * daylight.sunrise
				: daylight.sunset + ((fx - .77) / (.985 - .77)) * (24 - daylight.sunset);
			return `<circle cx="${X(starHour).toFixed(1)}" cy="${(T + ph * fy * 0.8).toFixed(1)}" r="${r}" fill="#fff" fill-opacity=".55"/>`;
		}).join('');
		const grid = [0.33, 0.66].map((f) => `<line x1="${L}" x2="${W - R}" y1="${(T + ph * f).toFixed(1)}" y2="${(T + ph * f).toFixed(1)}" stroke="#fff" stroke-opacity=".06"/>`).join('');
		const ticks = [0, 6, 12, 18, 24].map((h) => `<text x="${X(h).toFixed(1)}" y="${H - 14}" text-anchor="${h === 0 ? 'start' : h === 24 ? 'end' : 'middle'}" fill="#86a3b5" font-size="${FS}">${h} h</text>`).join('');

		// Le soleil suit l'heure choisie sur la courbe
		const hh = state.hour;
		const prod = res.k * prodShape(hh, daylight);
		const cx = X(hh).toFixed(1), cy = Y(prod).toFixed(1);
		const marker = prod > 0
			? `<circle cx="${cx}" cy="${cy}" r="24" fill="url(#sa-glow)"/><circle cx="${cx}" cy="${cy}" r="7" fill="#ffd9a8"/>`
			: `<circle cx="${cx}" cy="${cy}" r="5" fill="#9fbccd"/>`;

		return `<svg viewBox="0 0 ${W} ${H}" role="img" aria-label="Production solaire et consommation sur 24 heures">
			<defs>
				<linearGradient id="sa-sun" x1="0" y1="0" x2="0" y2="1">
					<stop offset="0" stop-color="#ffbb72" stop-opacity=".6"/>
					<stop offset="1" stop-color="#e47614" stop-opacity="0"/>
				</linearGradient>
				<radialGradient id="sa-glow"><stop offset="0" stop-color="#ffbb72" stop-opacity=".85"/><stop offset="1" stop-color="#ffbb72" stop-opacity="0"/></radialGradient>
			</defs>
			<rect x="${X(0)}" y="${T}" width="${(X(daylight.sunrise) - X(0)).toFixed(1)}" height="${ph}" fill="#04141f" fill-opacity=".5"/>
			<rect x="${X(daylight.sunset).toFixed(1)}" y="${T}" width="${(X(24) - X(daylight.sunset)).toFixed(1)}" height="${ph}" fill="#04141f" fill-opacity=".5"/>
			${stars}${grid}
			<line x1="${L}" x2="${W - R}" y1="${Y(0)}" y2="${Y(0)}" stroke="#fff" stroke-opacity=".25"/>
			<path d="${area}" fill="url(#sa-sun)"/>
			${bars}
			<path d="${line}" fill="none" stroke="#ffbb72" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
			<line x1="${cx}" x2="${cx}" y1="${T}" y2="${Y(0)}" stroke="#fff" stroke-opacity=".4" stroke-dasharray="3 5"/>
			${marker}
			<text x="${X(daylight.sunrise / 2)}" y="${T - 12}" text-anchor="middle" fill="#86a3b5" font-size="${FS}">Nuit</text>
			<text x="${X(dayMidpoint)}" y="${T - 12}" text-anchor="middle" fill="#cfe0ea" font-size="${FS}">Jour</text>
			<text x="${X((daylight.sunset + 24) / 2)}" y="${T - 12}" text-anchor="middle" fill="#86a3b5" font-size="${FS}">Nuit</text>
			${ticks}
		</svg>`;
	}

	/* ---------- Affichage ---------- */
	const out = (name) => viz.querySelector(`[data-out="${name}"]`);
	const SAMPLE = compute(PRESETS[0].items.map(([id, q]) => makeItem(id, q)), true);

	const slider = root.querySelector('[data-sa-hour]');
	const readoutEl = root.querySelector('[data-sa-readout]');
	const fmtW = (w) => (w >= 1000 ? `${nf.format(w / 1000)} kW` : `${Math.round(w)} W`);
	const fmtTime = (h) => {
		const hr = Math.floor(h), mn = Math.round((h - hr) * 60);
		return mn ? `${hr} h ${String(mn).padStart(2, '0')}` : `${hr} h`;
	};

	function sentence(res, prod, cons) {
		if (cons <= 0) return prod > 0 ? 'Les panneaux produisent, mais aucun appareil ne tourne à cette heure.' : 'Aucun appareil ne tourne à cette heure.';
		if (prod * ETA_DIRECT >= cons) return res.batteryKwh ? 'Le soleil alimente tout et recharge la batterie.' : 'Le soleil alimente tout.';
		if (prod > 0) return res.batteryKwh ? 'Le soleil et la batterie se partagent la charge.' : 'Le soleil couvre une partie de la charge.';
		if (res.batteryKwh) return 'La batterie prend le relais.';
		return 'Cette consommation du soir ou de la nuit n’est pas couverte dans le scénario sans batterie.';
	}

	function drawChart() {
		const res = state.res;
		chartEl.innerHTML = chart(res || SAMPLE);
		if (!res) { readoutEl.innerHTML = ''; return; }
		const prod = res.k * prodShape(state.hour);
		const cons = res.cons[Math.min(23, Math.floor(state.hour))];
		const text = sentence(res, prod, cons);
		readoutEl.innerHTML = `<strong>${fmtTime(state.hour)}</strong><span>Production <b>${fmtW(prod)}</b></span><span>Consommation <b>${fmtW(cons)}</b></span><p>${text}</p>`;
		slider.setAttribute('aria-valuetext', `${fmtTime(state.hour)} : production ${fmtW(prod)}, consommation ${fmtW(cons)}. ${text}`);
	}

	function sweep() {
		if (reduce) return;
		const from = 5.5, to = 12, dur = 2400, t0 = performance.now();
		state.hour = from;
		const step = (now) => {
			if (state.touched) return;
			const t = Math.min(1, (now - t0) / dur);
			state.hour = from + (to - from) * (1 - Math.pow(1 - t, 3));
			slider.value = state.hour;
			drawChart();
			if (t < 1) requestAnimationFrame(step);
		};
		requestAnimationFrame(step);
	}

	slider.addEventListener('input', () => {
		state.touched = true;
		state.hour = Number(slider.value);
		drawChart();
	});

	function render() {
		const irradiation = state.solar ? state.solar.designIrradiation : PSH;
		const noBattery = compute(state.items, false, irradiation);
		const withBattery = compute(state.items, true, irradiation);
		const res = state.night ? withBattery : noBattery;
		const live = !!res && state.source !== 'none';
		state.res = res;
		viz.dataset.state = live ? 'live' : 'idle';
		slider.disabled = !live;
		viewToggle.dataset.live = live ? 'true' : 'false';
		drawChart();
		if (live && !state.swept) { state.swept = true; sweep(); }

		if (!live) {
			['panels', 'battery', 'inverter', 'energy'].forEach((k) => { out(k).textContent = '—'; out(`${k}-sub`).textContent = ''; });
		} else {
			out('panels').textContent = `${res.panels} × ${PANEL_W} W`;
			out('panels-sub').textContent = `${fmtWp(res.wp)} · environ ${Math.round(res.area)} m² de toiture`;
			out('battery').textContent = res.batteryKwh ? `≈ ${nf.format(res.batteryKwh)} kWh` : 'Aucune';
			out('battery-sub').textContent = res.batteryKwh ? 'Lithium · une nuit d’autonomie' : 'Usage de jour uniquement';
			out('inverter').textContent = `≈ ${fmtVA(res.inverter)}`;
			out('inverter-sub').textContent = 'Démarrage des moteurs inclus';
			out('energy').textContent = `${nf.format(res.producedKwh)} kWh/jour`;
			out('energy-sub').textContent = state.solar
				? `Mois le moins ensoleillé · pour ${nf.format(res.demandKwh)} kWh/j servis`
				: `Pour ${nf.format(res.demandKwh)} kWh consommés par jour`;
		}

		const sourceEl = root.querySelector('[data-sa-source]');
		if (state.source === 'pvgis' && state.solar && state.location) {
			sourceEl.textContent = `Lieu : ${state.location.label}. Dimensionnement sur le mois le moins ensoleillé (${MONTH_NAMES[state.solar.designMonth - 1]}, ${nf.format(state.solar.designIrradiation)} kWh/m²/j). Moyenne annuelle : ${nf.format(state.solar.annualIrradiation)} kWh/m²/j, données ${state.solar.yearFrom}–${state.solar.yearTo} (PVGIS-ERA5). Lever et coucher approximatifs : ${fmtTime(state.daylight.sunrise)}–${fmtTime(state.daylight.sunset)}.`;
		} else if (state.source === 'generic') {
			sourceEl.textContent = `Données locales indisponibles. Estimation générale utilisée : ${PSH} h de soleil équivalent par jour, sans correction locale d’orientation (${state.location ? state.location.label : 'lieu non précisé'}).`;
		} else {
			sourceEl.textContent = 'Choisissez le lieu et l’orientation pour afficher une estimation solaire locale.';
		}

		const comparison = root.querySelector('[data-sa-comparison]');
		comparison.hidden = !live;
		if (live && noBattery && withBattery) {
			comparison.innerHTML = `<p class="sa-comparison-title">Comparaison pour le même lieu et les mêmes appareils</p>
				<div class="sa-comparison-grid">
					<section><h3>Sans batterie</h3>
						<p><b>${noBattery.panels} × ${PANEL_W} W</b><small>${fmtWp(noBattery.wp)} de panneaux</small></p>
						<p><b>Aucune</b><small>batterie</small></p>
						<p class="sa-comparison-warning"><b>${nf.format(noBattery.nightWh / 1000)} kWh/j</b><small>de consommation nocturne non couverte</small></p>
					</section>
					<section><h3>Avec batterie</h3>
						<p><b>${withBattery.panels} × ${PANEL_W} W</b><small>${fmtWp(withBattery.wp)} de panneaux</small></p>
						<p><b>≈ ${nf.format(withBattery.batteryKwh)} kWh</b><small>de batterie pour une nuit</small></p>
						<p><b>${nf.format(withBattery.producedKwh)} kWh/j</b><small>production au mois de dimensionnement</small></p>
					</section>
				</div>`;
		}

		root.querySelectorAll('[data-bind]').forEach((el) => {
			const key = el.dataset.bind;
			if (key === 'label') el.textContent = state.phrase;
			if (!res) return;
			if (key === 'panels') el.textContent = `${res.panels} panneau${res.panels > 1 ? 'x' : ''} de ${PANEL_W} W (${fmtWp(res.wp)})`;
			if (key === 'battery') el.textContent = res.batteryKwh ? `≈ ${nf.format(res.batteryKwh)} kWh` : 'Aucune';
			if (key === 'inverter') el.textContent = `≈ ${fmtVA(res.inverter)}`;
			if (key === 'note') el.textContent = state.night ? '' : 'Sans batterie, les appareils utilisés le soir et la nuit ne sont pas alimentés.';
		});
		updateHow(irradiation);
	}

	/* ---------- « Comment c'est calculé » ---------- */
	const howEl = root.querySelector('[data-sa-how]');
	function updateHow(irradiation) {
		if (!howEl) return;
		const pct = (v) => `${Math.round(v * 100)} %`;
		const sourceFormula = state.source === 'pvgis' && state.solar
			? `${nf.format(irradiation)} kWh/m²/j (mois de dimensionnement)`
			: `${PSH} h équivalent/j`;
		const sourceText = state.source === 'pvgis' && state.solar
			? `Irradiation sur les panneaux : ${nf.format(irradiation)} kWh/m²/j en ${MONTH_NAMES[state.solar.designMonth - 1]} ; moyenne annuelle ${nf.format(state.solar.annualIrradiation)} kWh/m²/j. Source : PVGIS-ERA5, ${state.solar.yearFrom}–${state.solar.yearTo}.`
			: `Sans donnée locale : ${PSH} heures de soleil équivalent par jour.`;
		howEl.innerHTML = `<ol>
			<li><b>Énergie de chaque appareil</b> = puissance × quantité × heures par jour × taux de fonctionnement (un réfrigérateur ne tourne qu’environ 40 % du temps).</li>
			<li><b>Jour ou nuit.</b> Chaque appareil est rangé : le jour, le soir et la nuit, ou les deux à moitié. La batterie ne sert qu’à ce qui se consomme le soir et la nuit.</li>
			<li><b>Panneaux</b> = (énergie de jour ÷ ${ETA_DIRECT} + énergie de nuit ÷ ${ETA_BATT}) ÷ (${sourceFormula} × ${LOSS}), converti en Wc, divisé par ${PANEL_W} W et arrondi au panneau supérieur. L’énergie de nuit pèse plus lourd, car elle passe par la batterie.</li>
			<li><b>Batterie</b> = énergie de nuit ÷ (${pct(DOD)} de décharge utile × 90 % de rendement de l’onduleur).</li>
			<li><b>Onduleur</b> = (puissances cumulées × 70 % + surcharge de démarrage du plus gros moteur) × 1,25, arrondi au calibre standard.</li>
		</ol><p>${sourceText} Les ${pct(1 - LOSS)} de pertes (chaleur, poussière, câbles) restent une hypothèse générale ; un technicien affine ces valeurs sur site.</p>`;
	}

	/* ---------- Conversation ---------- */
	const sleep = (ms) => new Promise((r) => setTimeout(r, reduce ? 0 : ms));

	function el(tag, cls) {
		const node = document.createElement(tag);
		if (cls) node.className = cls;
		return node;
	}

	function reveal() {
		if (!state.interacted) return;
		requestAnimationFrame(() => {
			log.scrollTo({ top: log.scrollHeight, behavior: reduce ? 'auto' : 'smooth' });
		});
	}

	async function say(html, cls) {
		const typing = el('div', 'sa-msg sa-typing');
		typing.setAttribute('aria-hidden', 'true');
		typing.innerHTML = '<i></i><i></i><i></i>';
		log.appendChild(typing);
		reveal(typing);
		await sleep(Math.min(700, 300 + html.replace(/<[^>]+>/g, '').length * 5));
		const msg = el('div', `sa-msg${cls ? ` ${cls}` : ''}`);
		msg.innerHTML = html;
		typing.replaceWith(msg);
		reveal(msg);
		return msg;
	}

	function ask(labels) {
		return new Promise((resolve) => {
			const wrap = el('div', 'sa-chips');
			wrap.setAttribute('role', 'group');
			wrap.setAttribute('aria-label', 'Réponses possibles');
			labels.forEach((text, i) => {
				const b = el('button', 'sa-chip');
				b.type = 'button';
				b.textContent = text;
				b.addEventListener('click', () => {
					state.interacted = true;
					wrap.remove();
					const u = el('div', 'sa-msg sa-msg--user');
					u.textContent = text;
					log.appendChild(u);
					reveal(u);
					resolve(i);
				});
				wrap.appendChild(b);
			});
			log.appendChild(wrap);
			reveal(wrap);
			if (state.interacted) wrap.firstChild.focus({ preventScroll: true });
		});
	}

	function recordChoice(text) {
		state.interacted = true;
		const answer = el('div', 'sa-msg sa-msg--user');
		answer.textContent = text;
		log.appendChild(answer);
		reveal(answer);
	}

	function askLocation() {
		return new Promise((resolve) => {
			const box = el('div', 'sa-msg sa-msg--widget sa-place-widget');
			const label = el('label', 'sa-cap');
			label.textContent = 'Ville et pays du projet';
			const input = el('input', 'sa-place-input');
			input.type = 'search';
			input.autocomplete = 'off';
			input.maxLength = 100;
			input.placeholder = 'Ex. N’Djamena, Tchad';
			input.setAttribute('aria-label', 'Ville et pays du projet');
			const search = el('button', 'sa-chip');
			search.type = 'button';
			search.textContent = 'Rechercher la ville';
			const status = el('p', 'sa-place-status');
			status.setAttribute('role', 'status');
			const results = el('div', 'sa-place-results');
			const attribution = el('small', 'sa-place-attribution');
			attribution.textContent = 'Recherche de ville par Open-Meteo / GeoNames.';
			box.append(label, input, search, status, results, attribution);
			log.appendChild(box);
			reveal(box);
			if (!window.matchMedia('(max-width: 600px)').matches) input.focus({ preventScroll: true });

			const find = async () => {
				const query = input.value.trim();
				if (query.length < 2) {
					status.textContent = 'Saisissez au moins deux caractères.';
					input.focus();
					return;
				}

				search.disabled = true;
				status.textContent = 'Recherche en cours…';
				results.replaceChildren();
				try {
					const url = new URL('https://geocoding-api.open-meteo.com/v1/search');
					url.search = new URLSearchParams({ name: query, count: '5', language: 'fr', format: 'json' });
					const response = await fetch(url, { headers: { Accept: 'application/json' } });
					if (!response.ok) throw new Error(`La recherche de ville a échoué (HTTP ${response.status}).`);
					const payload = await response.json();
					if (!Array.isArray(payload.results) || payload.results.length === 0) {
						status.textContent = 'Aucune ville trouvée. Vérifiez l’orthographe ou ajoutez le pays.';
						return;
					}

					status.textContent = 'Choisissez le résultat qui correspond au projet :';
					payload.results.forEach((place) => {
						if (!Number.isFinite(Number(place.latitude)) || !Number.isFinite(Number(place.longitude))) return;
						const labelParts = [place.name, place.admin1, place.country].filter((part, index, all) => part && all.indexOf(part) === index);
						const button = el('button', 'sa-chip sa-place-result');
						button.type = 'button';
						button.textContent = labelParts.join(', ');
						button.addEventListener('click', () => {
							box.remove();
							const location = {
								label: labelParts.join(', '),
								latitude: Number(place.latitude),
								longitude: Number(place.longitude)
							};
							recordChoice(location.label);
							resolve(location);
						});
						results.appendChild(button);
					});
				} catch (error) {
					status.textContent = error instanceof Error
						? `${error.message} Vérifiez votre connexion puis réessayez.`
						: 'La recherche de ville a échoué. Vérifiez votre connexion puis réessayez.';
				} finally {
					search.disabled = false;
				}
			};

			search.addEventListener('click', find);
			input.addEventListener('keydown', (event) => {
				if (event.key === 'Enter') {
					event.preventDefault();
					find();
				}
			});
		});
	}

	function askPanelSetup(location) {
		return new Promise((resolve) => {
			const box = el('div', 'sa-msg sa-msg--widget sa-panel-setup');
			const orientationLabel = el('label', 'sa-cap');
			orientationLabel.textContent = 'Orientation des panneaux';
			const orientation = document.createElement('select');
			orientation.setAttribute('aria-label', 'Orientation des panneaux');
			COMPASS.forEach((direction) => {
				const option = document.createElement('option');
				option.value = String(direction.aspect);
				option.textContent = direction.label;
				orientation.appendChild(option);
			});
			orientation.value = location.latitude >= 0 ? '0' : '-180';

			const tiltLabel = el('label', 'sa-cap');
			tiltLabel.textContent = 'Inclinaison par rapport à l’horizontale';
			const tiltWrap = el('div', 'sa-tilt-control');
			const tilt = document.createElement('input');
			tilt.type = 'range';
			tilt.min = '0';
			tilt.max = '90';
			tilt.step = '1';
			tilt.value = String(Math.round(Math.min(90, Math.abs(location.latitude))));
			tilt.setAttribute('aria-label', 'Inclinaison des panneaux en degrés');
			const tiltValue = document.createElement('output');
			tiltValue.textContent = `${tilt.value}°`;
			tilt.addEventListener('input', () => { tiltValue.textContent = `${tilt.value}°`; });
			tiltWrap.append(tilt, tiltValue);

			const hint = el('small', 'sa-place-attribution');
			hint.textContent = 'Gardez les valeurs proposées si vous ne les connaissez pas.';
			const submit = el('button', 'sa-chip');
			submit.type = 'button';
			submit.textContent = 'Calculer le potentiel solaire';
			box.append(orientationLabel, orientation, tiltLabel, tiltWrap, hint, submit);
			log.appendChild(box);
			reveal(box);
			orientation.focus({ preventScroll: true });

			submit.addEventListener('click', () => {
				const selectedAspect = Number(orientation.value);
				const selectedDirection = COMPASS.find((direction) => direction.aspect === selectedAspect);
				const setup = { aspect: selectedAspect, tilt: Number(tilt.value), direction: selectedDirection.label };
				box.remove();
				recordChoice(`${setup.direction}, inclinaison ${setup.tilt}°`);
				resolve(setup);
			});
		});
	}

	async function loadSolarResource(location, setup) {
		const url = new URL('api/solar-resource.php', document.baseURI);
		url.search = new URLSearchParams({
			lat: String(location.latitude),
			lon: String(location.longitude),
			angle: String(setup.tilt),
			aspect: String(setup.aspect)
		});
		const response = await fetch(url, { headers: { Accept: 'application/json' } });
		let payload;
		try {
			payload = await response.json();
		} catch (error) {
			throw new Error('La réponse du service solaire est illisible. Réessayez plus tard.');
		}
		if (!response.ok) throw new Error(payload.error || `Le service solaire a répondu avec le code ${response.status}.`);
		if (!Array.isArray(payload.monthly) || payload.monthly.length !== 12) {
			throw new Error('Les données mensuelles de ce lieu sont incomplètes.');
		}

		const monthly = payload.monthly.map((entry) => ({
			month: Number(entry.month),
			irradiation: Number(entry.irradiation)
		}));
		if (monthly.some((entry) => !Number.isInteger(entry.month) || entry.month < 1 || entry.month > 12 || !Number.isFinite(entry.irradiation) || entry.irradiation <= 0)) {
			throw new Error('Les données mensuelles de ce lieu ne sont pas valides.');
		}
		const designMonth = monthly.reduce((lowest, entry) => entry.irradiation < lowest.irradiation ? entry : lowest);
		const annualIrradiation = Number(payload.annual_daily_irradiation);
		if (!Number.isFinite(annualIrradiation) || annualIrradiation <= 0) {
			throw new Error('La moyenne annuelle de rayonnement solaire est indisponible.');
		}
		const yearFrom = Number(payload.years.from);
		const yearTo = Number(payload.years.to);
		if (!Number.isInteger(yearFrom) || !Number.isInteger(yearTo) || yearFrom <= 0 || yearTo < yearFrom) {
			throw new Error('La période des données solaires est indisponible.');
		}
		return {
			monthly,
			designMonth: designMonth.month,
			designIrradiation: designMonth.irradiation,
			annualIrradiation,
			yearFrom,
			yearTo,
			tilt: setup.tilt,
			direction: setup.direction,
			daylight: daylightWindow(location.latitude, designMonth.month)
		};
	}

	/* ---------- Liste d'appareils ---------- */
	const clamp = (v, lo, hi) => Math.min(hi, Math.max(lo, v));

	function rowHtml(it) {
		const a = APP[it.id];
		const meta = it.id === 'custom'
			? `<input type="number" min="1" max="20000" step="1" value="${it.watts}" inputmode="numeric" data-watts aria-label="Puissance en watts"> W`
			: `${a.w} W`;
		const whenOptions = Object.entries(WHEN_OPTIONS).map(([key, label]) =>
			`<option value="${key}"${it.when === key ? ' selected' : ''}>${label}</option>`
		).join('');
		return `<div class="sa-row" data-id="${it.id}">
			<div class="sa-row-name"><strong>${a.n}</strong><small>${meta}<select data-when aria-label="Moment d’utilisation pour ${a.n}">${whenOptions}</select></small></div>
			<div><span class="sa-cap">Quantité</span><div class="sa-step" role="group" aria-label="Quantité de ${a.n}">
				<button type="button" data-act="qty-" aria-label="Une de moins">−</button><output data-qty>${it.qty}</output><button type="button" data-act="qty+" aria-label="Une de plus">+</button></div></div>
			<div><span class="sa-cap">Heures par jour</span><div class="sa-step" role="group" aria-label="Heures par jour pour ${a.n}">
				<button type="button" data-act="h-" aria-label="Moins d’heures">−</button><output data-hours>${nf.format(it.hours)} h</output><button type="button" data-act="h+" aria-label="Plus d’heures">+</button></div></div>
			<button class="sa-x" type="button" data-act="rm" aria-label="Retirer ${a.n}">×</button>
		</div>`;
	}

	function buildWidget() {
		const box = el('div', 'sa-msg sa-msg--widget');
		const options = Object.entries(APP).map(([k, a]) => `<option value="${k}">${a.n}</option>`).join('');
		box.innerHTML = `<div data-sa-list></div>
			<div class="sa-add"><label class="sa-cap" for="sa-add-select">Ajouter un appareil</label>
			<select id="sa-add-select" data-sa-add><option value="">Choisir…</option>${options}</select></div>`;

		const list = box.querySelector('[data-sa-list]');
		list.innerHTML = state.items.map(rowHtml).join('');

		const updateRow = (row, it) => {
			row.querySelector('[data-qty]').textContent = it.qty;
			row.querySelector('[data-hours]').textContent = `${nf.format(it.hours)} h`;
		};

		list.addEventListener('click', (e) => {
			const btn = e.target.closest('[data-act]');
			if (!btn) return;
			const row = btn.closest('.sa-row');
			const it = state.items.find((x) => x.id === row.dataset.id);
			const act = btn.dataset.act;
			if (act === 'qty+') it.qty = clamp(it.qty + 1, 1, 20);
			if (act === 'qty-') it.qty = clamp(it.qty - 1, 1, 20);
			if (act === 'h+') it.hours = clamp(it.hours + 0.5, 0.5, 24);
			if (act === 'h-') it.hours = clamp(it.hours - 0.5, 0.5, 24);
			if (act === 'rm') {
				state.items = state.items.filter((x) => x !== it);
				row.remove();
			} else {
				updateRow(row, it);
			}
			render();
		});

		list.addEventListener('input', (e) => {
			if (!e.target.matches('[data-watts]')) return;
			const it = state.items.find((x) => x.id === e.target.closest('.sa-row').dataset.id);
			it.watts = clamp(Number(e.target.value) || 1, 1, 20000);
			render();
		});

		list.addEventListener('change', (e) => {
			if (!e.target.matches('[data-when]')) return;
			const it = state.items.find((x) => x.id === e.target.closest('.sa-row').dataset.id);
			it.when = e.target.value;
			render();
		});

		box.querySelector('[data-sa-add]').addEventListener('change', (e) => {
			const id = e.target.value;
			e.target.value = '';
			if (!id) return;
			const existing = state.items.find((x) => x.id === id);
			if (existing) {
				existing.qty = clamp(existing.qty + 1, 1, 20);
				updateRow(list.querySelector(`[data-id="${id}"]`), existing);
			} else {
				const it = makeItem(id, 1);
				state.items.push(it);
				list.insertAdjacentHTML('beforeend', rowHtml(it));
			}
			render();
		});

		return box;
	}

	/* ---------- Scénario ---------- */
	async function run() {
		await say('Bonjour, je suis Nour. Je calcule vos panneaux, batterie et onduleur en une minute.');
		await say('Que voulez-vous alimenter ?');

		const preset = PRESETS[await ask(PRESETS.map((p) => p.label))];
		state.items = preset.items.map(([id, q]) => makeItem(id, q));
		state.phrase = preset.phrase;

		await say(preset.items.length
			? 'Ajustez les quantités et les heures. Le résultat se met à jour en direct.'
			: 'Ajoutez vos appareils un par un. Le résultat se met à jour en direct.');

		const widget = buildWidget();
		log.appendChild(widget);
		reveal(widget);
		render();

		for (;;) {
			await ask(['Continuer']);
			if (state.items.length) break;
			await say('Ajoutez au moins un appareil pour que je puisse calculer.');
		}

		await say('Courant le soir et la nuit ?');
		state.night = (await ask(['Oui, avec batteries', 'Non, le jour seulement'])) === 0;
		render();

		await say('Dans quelle ville ? Elle sert uniquement à récupérer l’ensoleillement.');
		state.location = await askLocation();
		const setup = await askPanelSetup(state.location);
		state.source = 'none';
		state.solar = null;
		render();
		await say('Je récupère les données solaires…');
		while (state.source === 'none') {
			try {
				state.solar = await loadSolarResource(state.location, setup);
				state.daylight = state.solar.daylight;
				state.source = 'pvgis';
			} catch (error) {
				const message = error instanceof Error ? error.message : 'Une erreur inconnue est survenue.';
				await say(`${message} Réessayer ou continuer avec une estimation générale ?`);
				const fallback = await ask(['Réessayer', 'Estimation générale']);
				if (fallback === 1) {
					state.source = 'generic';
					state.solar = null;
				}
			}
		}
		render();

		const basis = state.source === 'pvgis' && state.solar
			? `Le dimensionnement solaire utilise le mois le moins ensoleillé (${MONTH_NAMES[state.solar.designMonth - 1]}) et l’orientation ${state.solar.direction} à ${state.solar.tilt}°.`
			: `Les données locales n’ont pas pu être chargées ; l’estimation générale utilise ${PSH} heures de soleil équivalent par jour.`;
		await say(`<p><strong>Pour <span data-bind="label"></span>, voici mon estimation.</strong></p>
			<ul class="sa-result">
				<li><span>Panneaux</span><b data-bind="panels"></b></li>
				<li><span>Batterie</span><b data-bind="battery"></b></li>
				<li><span>Onduleur</span><b data-bind="inverter"></b></li>
			</ul>
			<p class="sa-fine" data-bind="note"></p>
			<p class="sa-fine">${basis} Détail et comparaison dans « Résultat ». Étude sur site nécessaire.</p>
			<a class="sa-cta" href="contact.php">Demander une étude personnalisée <span aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span></a>`);
		render();

		await ask(['Recommencer']);
		log.innerHTML = '';
		state.items = [];
		state.night = true;
		state.swept = false;
		state.touched = false;
		state.hour = 12;
		state.location = null;
		state.solar = null;
		state.source = 'none';
		state.daylight = { sunrise: 6, sunset: 18 };
		slider.value = 12;
		render();
		run();
	}

	/* ---------- Démarrage quand la section devient visible ---------- */
	render();
	let started = false;
	const start = () => {
		if (started) return;
		started = true;
		run();
	};

	if ('IntersectionObserver' in window) {
		const io = new IntersectionObserver((entries) => {
			if (entries.some((e) => e.isIntersecting)) {
				io.disconnect();
				start();
			}
		}, { threshold: 0.3 });
		io.observe(root);
	} else {
		start();
	}
})();