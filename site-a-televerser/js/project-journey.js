document.querySelectorAll("[data-project-journey]").forEach((journey) => {
	const card = journey.querySelector(".project-journey__card");
	const buttons = Array.from(journey.querySelectorAll("[data-journey-button]"));
	const stations = Array.from(journey.querySelectorAll("[data-journey-node]"));
	const progress = journey.querySelector("[data-journey-progress]");
	const count = journey.querySelector("[data-journey-count]");
	const title = journey.querySelector("[data-journey-title]");
	const description = journey.querySelector("[data-journey-description]");

	const steps = [
		{
			title: "Nous commençons par vous écouter.",
			description: "Vous nous parlez de vos besoins, de votre activité et de ce que vous souhaitez alimenter. Chaque projet part de vos usages."
		},
		{
			title: "Nous prenons en compte les réalités du site.",
			description: "L’emplacement, les contraintes techniques et les conditions d’utilisation aident à orienter la solution la plus pertinente."
		},
		{
			title: "Nous préparons une solution adaptée.",
			description: "L’étude permet de définir les équipements et les caractéristiques de l’installation en fonction du besoin et des contraintes identifiées."
		},
		{
			title: "Nos équipes réalisent l’installation.",
			description: "Les équipements sont mis en place avec méthode, en tenant compte des exigences de sécurité et de qualité du projet."
		},
		{
			title: "Votre installation est mise en service.",
			description: "Les vérifications finales permettent de s’assurer du bon fonctionnement de l’installation et de son adéquation avec les usages prévus."
		}
	];

	const selectStep = (index) => {
		const step = steps[index];
		if (!step) return;

		card.dataset.journeyStep = String(index);
		count.textContent = `ÉTAPE ${String(index + 1).padStart(2, "0")} / 05`;
		title.textContent = step.title;
		description.textContent = step.description;
		progress.setAttribute("stroke-dasharray", `${index * 25} 100`);

		buttons.forEach((button, buttonIndex) => {
			const active = buttonIndex === index;
			button.classList.toggle("is-active", active);
			button.classList.toggle("is-complete", buttonIndex < index);
			button.setAttribute("aria-pressed", String(active));
		});

		stations.forEach((station, stationIndex) => {
			station.classList.toggle("is-active", stationIndex === index);
			station.classList.toggle("is-complete", stationIndex < index);
		});
	};

	buttons.forEach((button, index) => {
		button.addEventListener("click", () => selectStep(index));
		button.addEventListener("keydown", (event) => {
			let nextIndex = index;
			if (event.key === "ArrowRight" || event.key === "ArrowDown") {
				nextIndex = (index + 1) % buttons.length;
			} else if (event.key === "ArrowLeft" || event.key === "ArrowUp") {
				nextIndex = (index - 1 + buttons.length) % buttons.length;
			} else if (event.key === "Home") {
				nextIndex = 0;
			} else if (event.key === "End") {
				nextIndex = buttons.length - 1;
			} else {
				return;
			}

			event.preventDefault();
			buttons[nextIndex].focus();
			selectStep(nextIndex);
		});
	});

	selectStep(0);
});
