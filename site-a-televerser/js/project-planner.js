document.querySelectorAll("[data-project-planner]").forEach((planner) => {
	const form = planner.querySelector("[data-planner-form]");
	const summary = planner.querySelector("[data-planner-summary]");
	const status = planner.querySelector("[data-planner-status]");
	const whatsappButton = planner.querySelector("[data-planner-whatsapp]");
	const copyButton = planner.querySelector("[data-planner-copy]");
	const printButton = planner.querySelector("[data-planner-print]");
	const contactLink = planner.querySelector("[data-planner-contact]");
	const fields = {
		type: form.elements.namedItem("type"),
		city: form.elements.namedItem("city"),
		stage: form.elements.namedItem("stage"),
		details: form.elements.namedItem("details"),
		priorities: Array.from(form.querySelectorAll('input[name="priority"]')),
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
	};

	form.addEventListener("input", update);
	form.addEventListener("change", update);

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

	update();
});
