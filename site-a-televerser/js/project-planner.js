document.querySelectorAll("[data-project-planner]").forEach((planner) => {
	const form = planner.querySelector("[data-planner-form]");
	const summary = planner.querySelector("[data-planner-summary]");
	const status = planner.querySelector("[data-planner-status]");
	const whatsappButton = planner.querySelector("[data-planner-whatsapp]");
	const copyButton = planner.querySelector("[data-planner-copy]");
	const printButton = planner.querySelector("[data-planner-print]");
	const contactLink = planner.querySelector("[data-planner-contact]");
	const panels = Array.from(form.querySelectorAll("[data-planner-panel]"));
	const stepButtons = Array.from(form.querySelectorAll("[data-planner-step-button]"));
	const progress = form.querySelector("[data-planner-progress]");
	const progressLabel = form.querySelector("[data-planner-progress-label]");
	const progressPercent = form.querySelector("[data-planner-progress-percent]");
	const previousButton = form.querySelector("[data-planner-back]");
	const nextButton = form.querySelector("[data-planner-next]");
	const navigation = form.querySelector("[data-planner-navigation]");
	let currentStep = 0;
	const fields = {
		type: form.elements.namedItem("type"),
		city: form.elements.namedItem("city"),
		stage: form.elements.namedItem("stage"),
		details: form.elements.namedItem("details"),
		priorities: Array.from(form.querySelectorAll('input[name="priority"]')),
	};

	const showStep = (index) => {
		currentStep = Math.max(0, Math.min(panels.length - 1, index));
		panels.forEach((panel, panelIndex) => {
			const active = panelIndex === currentStep;
			panel.hidden = !active;
			panel.classList.toggle("is-active", active);
		});

		stepButtons.forEach((button, buttonIndex) => {
			const active = buttonIndex === currentStep;
			const complete = buttonIndex < currentStep;
			button.classList.toggle("is-active", active);
			button.classList.toggle("is-complete", complete);
			if (active) button.setAttribute("aria-current", "step");
			else button.removeAttribute("aria-current");
		});

		const percentage = Math.round(((currentStep + 1) / panels.length) * 100);
		progress.style.width = `${percentage}%`;
		progressLabel.textContent = `Étape ${currentStep + 1} sur ${panels.length}`;
		progressPercent.textContent = `${percentage} %`;
		previousButton.disabled = currentStep === 0;
		nextButton.hidden = currentStep === panels.length - 1;
		navigation.hidden = currentStep === panels.length - 1;
	};

	const validateStep = (index) => {
		const invalid = Array.from(panels[index].querySelectorAll(":invalid"))[0];
		if (!invalid) return true;
		invalid.reportValidity();
		return false;
	};

	const navigateToStep = (index) => {
		const target = Math.max(0, Math.min(panels.length - 1, index));
		if (target > currentStep) {
			for (let step = currentStep; step < target; step += 1) {
				showStep(step);
				if (!validateStep(step)) {
					return;
				}
			}
		} else if (target > 0 && !form.querySelector('input[name="type"]:checked')) {
			showStep(0);
			validateStep(0);
			return;
		} else if (target > 1 && !fields.city.value.trim()) {
			showStep(1);
			validateStep(1);
			return;
		}

		showStep(target);
	};

	const getBrief = () => {
		const priorities = fields.priorities.filter((input) => input.checked).map((input) => input.value);
		const details = fields.details.value.trim();
		return [
			"Bonjour, je souhaite échanger avec SEAT Opus Global au sujet d’un projet.",
			`Type de projet : ${fields.type.value}`,
			`Ville : ${fields.city.value.trim()}`,
			`Avancement : ${fields.stage.value}`,
			`Priorités : ${priorities.length ? priorities.join(", ") : "À préciser avec l’équipe"}`,
			details ? `Informations complémentaires : ${details}` : "",
		].filter(Boolean).join("\n");
	};

	const getContactDetails = () => {
		const priorities = fields.priorities.filter((input) => input.checked).map((input) => input.value);
		const details = fields.details.value.trim();
		return [
			`Avancement : ${fields.stage.value}`,
			`Priorités : ${priorities.length ? priorities.join(", ") : "À préciser avec l’équipe"}`,
			details ? `Informations complémentaires : ${details}` : "",
		].filter(Boolean).join("\n");
	};

	const addSummaryLine = (label, value) => {
		const line = document.createElement("p");
		const heading = document.createElement("strong");
		heading.textContent = `${label} : `;
		line.append(heading, document.createTextNode(value));
		summary.append(line);
	};

	const update = () => {
		const ready = fields.type.value !== "" && fields.city.value.trim() !== "" && form.checkValidity();
		const priorities = fields.priorities.filter((input) => input.checked).map((input) => input.value);
		summary.replaceChildren();

		if (!fields.type.value && !fields.city.value.trim()) {
			const hint = document.createElement("p");
			hint.textContent = "Choisissez un domaine et indiquez la ville pour commencer votre brief.";
			summary.append(hint);
		} else {
			if (fields.type.value) addSummaryLine("Projet", fields.type.value);
			if (fields.city.value.trim()) addSummaryLine("Lieu", fields.city.value.trim());
			addSummaryLine("Avancement", fields.stage.value);
			addSummaryLine("Priorités", priorities.length ? priorities.join(" · ") : "À préciser avec l’équipe");
			if (fields.details.value.trim()) addSummaryLine("Détail", fields.details.value.trim());
		}

		[whatsappButton, copyButton, printButton].forEach((button) => {
			button.disabled = !ready;
		});
		status.textContent = "";

		const params = new URLSearchParams({
			project_type: fields.type.value,
			city: fields.city.value.trim(),
			details: ready ? getContactDetails() : "",
		});
		contactLink.href = `contact.php?${params.toString()}`;

		stepButtons[0].classList.toggle("is-complete", fields.type.value !== "");
		stepButtons[1].classList.toggle("is-complete", fields.city.value.trim() !== "");
		stepButtons[2].classList.toggle("is-complete", priorities.length > 0 || fields.details.value.trim() !== "");
	};

	form.addEventListener("input", update);
	form.addEventListener("change", update);
	previousButton.addEventListener("click", () => navigateToStep(currentStep - 1));
	nextButton.addEventListener("click", () => {
		if (validateStep(currentStep)) navigateToStep(currentStep + 1);
	});
	stepButtons.forEach((button) => {
		button.addEventListener("click", () => navigateToStep(Number(button.dataset.plannerStepButton)));
	});

	whatsappButton.addEventListener("click", () => {
		if (!form.reportValidity()) return;
		const url = `https://wa.me/23566173093?text=${encodeURIComponent(getBrief())}`;
		const opened = window.open(url, "_blank", "noopener,noreferrer");
		if (!opened) {
			status.textContent = "WhatsApp n’a pas pu s’ouvrir. Vous pouvez copier le brief ou continuer avec la demande de devis.";
		}
	});

	copyButton.addEventListener("click", async () => {
		if (!form.reportValidity()) return;
		try {
			await navigator.clipboard.writeText(getBrief());
			status.textContent = "Brief copié. Vous pouvez le coller dans votre message.";
		} catch (error) {
			status.textContent = "La copie n’est pas autorisée par ce navigateur. Utilisez WhatsApp ou la demande de devis.";
		}
	});

	printButton.addEventListener("click", () => {
		if (!form.reportValidity()) return;
		window.print();
	});

	showStep(0);
	update();
});
