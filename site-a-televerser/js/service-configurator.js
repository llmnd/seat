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