(() => {
	const planner = document.querySelector("[data-service-planner]");
	if (!planner) return;

	const placeOptions = {
		home: "maison ou logement",
		business: "commerce ou entreprise",
		farm: "exploitation agricole",
	};
	const services = {
		electricity: "Électricité générale",
		renewable: "Énergies renouvelables",
		studies: "Études & conception",
		logistics: "Logistique & fournitures",
		installation: "Installation solaire",
		equipment: "Matériel électrique",
	};
	const recommendations = {
		solar: {
			projectType: "Énergie solaire",
			titles: {
				home: "Du solaire adapté à votre logement",
				business: "Une énergie solaire pour votre activité",
				farm: "Une solution solaire pour votre exploitation",
			},
			description: "Une étude de vos usages aidera à définir une installation photovoltaïque et les équipements nécessaires. Le dimensionnement se fera selon votre consommation réelle.",
			services: ["studies", "renewable", "installation"],
		},
		pump: {
			projectType: "Pompage solaire",
			titles: {
				home: "Un pompage solaire adapté à votre site",
				business: "Un pompage solaire pour votre activité",
				farm: "Un pompage solaire pour votre exploitation",
			},
			description: "Le choix d’une pompe solaire dépend notamment de la profondeur, du débit et de l’usage de l’eau. Une étude du site permet de sélectionner une solution adaptée.",
			services: ["studies", "installation", "logistics"],
		},
		electricity: {
			projectType: "Électricité générale",
			titles: {
				home: "Une installation électrique sûre chez vous",
				business: "Une installation électrique pour votre activité",
				farm: "Une installation électrique pour votre exploitation",
			},
			description: "Nous pouvons étudier votre installation, vos équipements et vos contraintes afin de vous orienter vers les travaux et le matériel appropriés.",
			services: ["electricity", "studies", "equipment"],
		},
		cold: {
			projectType: "Énergie solaire",
			titles: {
				home: "Du froid solaire pour votre logement",
				business: "Du froid solaire pour votre activité",
				farm: "Du froid solaire pour votre exploitation",
			},
			description: "La conservation au froid nécessite une étude des équipements, de la durée d’utilisation et de l’alimentation disponible pour proposer une solution adaptée.",
			services: ["studies", "renewable", "equipment", "installation"],
		},
	};

	const placeButtons = Array.from(planner.querySelectorAll("[data-planner-place]"));
	const needButtons = Array.from(planner.querySelectorAll("[data-planner-need]"));
	const title = planner.querySelector("[data-planner-title]");
	const description = planner.querySelector("[data-planner-description]");
	const steps = planner.querySelector("[data-planner-services]");
	const contact = planner.querySelector("[data-planner-contact]");
	const cards = Array.from(document.querySelectorAll("[data-service-card]"));
	let place = "home";
	let need = "solar";

	// ---------- Aperçu : scène qui change avec le lieu et le besoin ----------
	const scenePlaces = { home: "Maison", business: "Commerce", farm: "Exploitation" };
	const sceneNeeds = { solar: "Énergie solaire", pump: "Pompage solaire", electricity: "Installation électrique", cold: "Froid solaire" };
	const wall = 'fill="rgba(255,255,255,.09)" stroke="rgba(255,255,255,.4)" stroke-width="1.5"';
	const roof = 'fill="rgba(255,189,118,.22)" stroke="#ffbd76" stroke-width="2.5" stroke-linejoin="round"';
	const door = 'fill="rgba(255,255,255,.22)"';

	const sceneBuilding = (kind, blink) => {
		const win = `s-win${blink ? " s-win--blink" : ""}`;
		if (kind === "business") {
			return `<rect x="140" y="156" width="104" height="70" rx="3" ${wall}/><path d="M134 156H250L242 176H142Z" fill="rgba(255,189,118,.3)" stroke="#ffbd76" stroke-width="2" stroke-linejoin="round"/><rect x="168" y="134" width="48" height="16" rx="8" fill="rgba(155,220,236,.35)"/><rect class="${win}" x="152" y="186" width="44" height="30" rx="2"/><rect x="210" y="186" width="24" height="40" rx="2" ${door}/>`;
		}
		if (kind === "farm") {
			return `<path d="M132 168 190 124 248 168Z" ${roof}/><rect x="142" y="164" width="96" height="62" rx="3" ${wall}/><rect x="174" y="186" width="32" height="40" rx="2" fill="rgba(255,255,255,.14)" stroke="rgba(255,255,255,.4)"/><path d="M174 186 206 226M206 186 174 226" stroke="rgba(255,255,255,.3)" stroke-width="1.5"/>`;
		}
		return `<path d="M130 170 190 126 250 170Z" ${roof}/><rect x="140" y="168" width="100" height="58" rx="3" ${wall}/><rect x="178" y="194" width="18" height="32" rx="2" ${door}/><rect class="${win}" x="206" y="184" width="22" height="18" rx="2"/>`;
	};

	const scenePanels = (count) => {
		let out = "";
		for (let i = 0; i < count; i++) {
			const x = 10 + i * 42;
			out += `<path d="M${x + 16} 208V226" stroke="rgba(255,255,255,.35)" stroke-width="3" stroke-linecap="round"/><path d="M${x} 210 ${x + 7} 188 ${x + 39} 184 ${x + 32} 206Z" fill="rgba(155,220,236,.22)" stroke="#9bdcec" stroke-width="2" stroke-linejoin="round"/>`;
		}
		return out;
	};

	const sceneSun = () => {
		let rays = "";
		for (let k = 0; k < 8; k++) {
			const a = (k * Math.PI) / 4;
			rays += `M${(296 + Math.cos(a) * 24).toFixed(1)} ${(62 + Math.sin(a) * 24).toFixed(1)}L${(296 + Math.cos(a) * 31).toFixed(1)} ${(62 + Math.sin(a) * 31).toFixed(1)}`;
		}
		return `<circle cx="296" cy="62" r="38" fill="#ffbd76" opacity=".13"/><circle cx="296" cy="62" r="15" fill="#ffbd76"/><path class="s-rays" d="${rays}" stroke="#ffbd76" stroke-width="2.5" stroke-linecap="round"/>`;
	};

	const sceneFlow = (d, water) => `<path class="s-wire${water ? " s-wire--water" : ""}" d="${d}"/><path class="s-flow${water ? " s-flow--water" : ""}" d="${d}"/>`;

	const sceneNeed = {
		solar: () => scenePanels(3) + sceneFlow("M14 222H187"),
		pump: () => scenePanels(2) + sceneFlow("M14 222H187") +
			'<path d="M288 226 296 190M324 226 316 190" stroke="rgba(255,255,255,.4)" stroke-width="3" stroke-linecap="round"/>' +
			'<rect x="278" y="150" width="56" height="40" rx="9" fill="rgba(155,220,236,.1)" stroke="#9bdcec" stroke-width="2"/>' +
			'<rect class="s-water" x="283" y="155" width="46" height="30" rx="5"/>' + sceneFlow("M252 222H264V170H278", true),
		electricity: () =>
			'<path d="M36 226V128M18 140H54M22 152H50" stroke="rgba(255,255,255,.45)" stroke-width="3" stroke-linecap="round"/>' +
			sceneFlow("M20 140Q88 176 150 168") +
			'<path class="s-bolt" d="M196 78l-12 20h10l-6 18 16-24h-10z"/>',
		cold: () => scenePanels(2) + sceneFlow("M14 222H187") +
			'<rect x="282" y="172" width="42" height="54" rx="7" fill="rgba(155,220,236,.1)" stroke="#9bdcec" stroke-width="2"/>' +
			'<path d="M282 196H324M290 182v8M290 204v10" stroke="#9bdcec" stroke-width="2" stroke-linecap="round"/>' +
			'<g class="s-snow" stroke="#bfeaf6" stroke-width="2.2" stroke-linecap="round"><path d="M303 134v24M292.6 140l20.8 12M292.6 152l20.8-12"/></g>',
	};

	const resultBox = planner.querySelector(".svc-planner__result");
	const scene = document.createElement("div");
	scene.className = "svc-scene";
	scene.setAttribute("aria-hidden", "true");
	scene.innerHTML = '<svg viewBox="0 0 360 280" preserveAspectRatio="xMidYMax meet" focusable="false"></svg><span class="svc-scene__tag"></span>';
	resultBox.appendChild(scene);
	const sceneSvg = scene.querySelector("svg");
	const sceneTag = scene.querySelector(".svc-scene__tag");

	const renderScene = () => {
		const crops = place === "farm" && (need === "solar" || need === "electricity")
			? '<path d="M270 226v-14m-5 6 5-6m5 6-5-6M296 226v-18m-5 8 5-8m5 8-5-8M322 226v-12m-5 5 5-5m5 5-5-5" stroke="#6fd0a0" stroke-width="2.5" stroke-linecap="round" fill="none"/>'
			: "";
		const stars = '<g fill="#fff" opacity=".35"><circle cx="40" cy="40" r="1.4"/><circle cx="96" cy="76" r="1.1"/><circle cx="160" cy="34" r="1.4"/><circle cx="224" cy="86" r="1.1"/><circle cx="340" cy="120" r="1.2"/></g>';
		sceneSvg.innerHTML = `<g class="s-art">${stars}${need === "electricity" ? "" : sceneSun()}<rect x="-600" y="226" width="1560" height="400" fill="rgba(255,255,255,.04)"/><path d="M-600 226H960" stroke="rgba(255,255,255,.22)" stroke-width="1.5"/>${crops}${sceneBuilding(place, need === "electricity")}${sceneNeed[need]()}</g>`;
		sceneTag.textContent = `${scenePlaces[place]} · ${sceneNeeds[need]}`;
	};


	const update = () => {
		const recommendation = recommendations[need];
		const placeLabel = placeOptions[place];

		title.textContent = recommendation.titles[place];
		description.textContent = recommendation.description;
		steps.replaceChildren();
		steps.dataset.count = String(recommendation.services.length);

		recommendation.services.forEach((serviceId, index) => {
			const item = document.createElement("span");
			const number = document.createElement("b");
			const label = document.createElement("span");
			item.style.setProperty("--i", String(index));
			number.textContent = String(index + 1).padStart(2, "0");
			label.textContent = services[serviceId];
			item.append(number, label);
			steps.appendChild(item);
		});

		cards.forEach((card) => {
			const isRecommended = recommendation.services.includes(card.dataset.serviceCard);
			card.classList.toggle("is-recommended", isRecommended);
			card.querySelector("[data-service-match]").hidden = !isRecommended;
		});

		const params = new URLSearchParams({
			project_type: recommendation.projectType,
			details: `Je souhaite étudier ${recommendation.projectType.toLowerCase()} pour mon projet (${placeLabel}). Le configurateur m’oriente vers : ${recommendation.services.map((id) => services[id]).join(", ")}.`,
		});
		contact.href = `contact.php?${params.toString()}`;
		renderScene();
	};

	const bindChoices = (buttons, dataKey, setSelected) => {
		buttons.forEach((button) => {
			button.addEventListener("click", () => {
				setSelected(button.dataset[dataKey]);
				buttons.forEach((option) => {
					option.setAttribute("aria-pressed", String(option === button));
				});
				update();
			});
		});
	};

	bindChoices(placeButtons, "plannerPlace", (value) => { place = value; });
	bindChoices(needButtons, "plannerNeed", (value) => { need = value; });
	update();
})();

/* ==========================================================
   Cartes de services : mini-simulations + lueur curseur.
   Rien à changer dans le HTML : tout est injecté depuis data-service-card.
   ========================================================== */
(() => {
	const cards = Array.from(document.querySelectorAll(".svc-card[data-service-card]"));
	if (!cards.length) return;

	const attrs = 'viewBox="0 0 320 80" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false"';

	const bars = () => [22, 34, 28, 46, 38, 54]
		.map((h, i) => `<rect class="v-bar" style="--i:${i}" x="${40 + i * 40}" y="${70 - h}" width="18" height="${h}" rx="4"/>`)
		.join("");

	const cells = () => {
		let out = "";
		for (let i = 0; i < 10; i++) {
			const col = i % 5;
			const row = Math.floor(i / 5);
			out += `<rect class="v-cell" style="--i:${i}" x="${34 + col * 52}" y="${24 + row * 26}" width="44" height="20" rx="4"/>`;
		}
		return out;
	};

	const circuit = "M0 52H96l14-24 18 44 18-52 14 32H320";

	const viz = {
		electricity: {
			tag: "<i></i><b>230</b> V · circuit actif",
			svg: `<svg ${attrs}><path class="v-base" d="${circuit}" pathLength="300"/><path class="v-flow v-flow--circuit" d="${circuit}" pathLength="300"/></svg>`,
		},
		renewable: {
			tag: "<i></i><b data-svc-kw>0,0</b> kW produits",
			svg: `<svg ${attrs}><path class="v-base" d="M20 66Q160 -34 300 66"/><path d="M10 66H310" stroke="currentColor" stroke-opacity=".25" stroke-width="2" stroke-linecap="round"/><g class="v-sun"><circle r="15" fill="currentColor" opacity=".22"/><circle r="6.5" fill="currentColor"/></g></svg>`,
		},
		studies: {
			tag: "<i></i>Dimensionnement",
			svg: `<svg ${attrs}><line class="v-target" x1="20" x2="300" y1="26" y2="26" stroke-width="1.5"/>${bars()}</svg>`,
		},
		logistics: {
			tag: "<i></i>Livraison en cours",
			svg: `<svg ${attrs}><path class="v-route" d="M20 58H300"/><circle cx="20" cy="58" r="4" fill="currentColor"/><circle cx="300" cy="58" r="4" fill="currentColor" fill-opacity=".45"/><g transform="translate(26 56)"><g class="v-truck"><rect x="0" y="-18" width="26" height="15" rx="3"/><path d="M28-14h8l5 6v5H28z"/><circle cx="7" cy="-2" r="3.5" stroke="#fff" stroke-opacity=".6" stroke-width="1.5"/><circle cx="34" cy="-2" r="3.5" stroke="#fff" stroke-opacity=".6" stroke-width="1.5"/></g></g></svg>`,
		},
		installation: {
			tag: "<i></i>Pose des panneaux",
			svg: `<svg ${attrs}>${cells()}</svg>`,
		},
		equipment: {
			tag: "<i></i>Batterie en charge",
			svg: `<svg ${attrs}><rect class="v-base" x="104" y="22" width="108" height="40" rx="9" stroke-width="2.5"/><rect class="v-base" x="214" y="34" width="7" height="16" rx="3"/><rect class="v-charge" x="110" y="28" width="96" height="28" rx="5"/></svg>`,
		},
	};

	const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
	let kwEl = null;
	let kwVisible = true;
	const kwStart = performance.now();

	cards.forEach((card) => {
		const key = card.dataset.serviceCard;
		const def = viz[key];

		if (def && !card.querySelector(".svc-viz")) {
			const box = document.createElement("div");
			box.className = "svc-viz";
			box.setAttribute("aria-hidden", "true");
			box.innerHTML = `<span class="svc-viz__tag">${def.tag}</span>${def.svg}`;
			card.insertBefore(box, card.querySelector("ul"));

			if (key === "renewable") {
				kwEl = box.querySelector("[data-svc-kw]");
				if ("IntersectionObserver" in window) {
					new IntersectionObserver((entries) => {
						kwVisible = entries[0].isIntersecting;
					}).observe(card);
				}
			}
		}

		card.addEventListener("pointermove", (event) => {
			const rect = card.getBoundingClientRect();
			card.style.setProperty("--mx", `${event.clientX - rect.left}px`);
			card.style.setProperty("--my", `${event.clientY - rect.top}px`);
		});
	});

	// Compteur kW synchronisé avec le soleil (cycle de 6 s, courbe en cloche)
	if (kwEl) {
		if (reduceMotion) {
			kwEl.textContent = "2,4";
		} else {
			setInterval(() => {
				if (!kwVisible || document.hidden) return;
				const p = ((performance.now() - kwStart) % 6000) / 6000;
				kwEl.textContent = (3.2 * Math.sin(Math.PI * p)).toFixed(1).replace(".", ",");
			}, 120);
		}
	}
})();