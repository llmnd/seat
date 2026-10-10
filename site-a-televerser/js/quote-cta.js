document.querySelectorAll("[data-quote-choice]").forEach((choice) => {
	const tabs = Array.from(choice.querySelectorAll("[data-quote-method]"));
	const tabList = choice.querySelector(".quote-cta__tabs");
	const panel = choice.querySelector(".quote-cta__panel");
	const description = choice.querySelector("[data-quote-description]");
	const action = choice.querySelector("[data-quote-link]");
	const actionLabel = choice.querySelector("[data-quote-link-label]");
	const fields = Object.fromEntries(
		Array.from(choice.querySelectorAll("[data-quote-field]"))
			.map((field) => [field.dataset.quoteField, field])
	);

	const buildMessage = () => {
		const projectType = fields.type.value.trim();
		const name = fields.name.value.trim();
		const city = fields.city.value.trim();
		const phone = fields.phone.value.trim();
		const details = fields.details.value.trim();
		const productTitle = document.querySelector('.page-hero[data-page-section="Produits"] h1')?.textContent.trim();
		const projectDescription = {
			"Énergie solaire": "un projet en énergie solaire",
			"Pompage solaire": "un projet de pompage solaire",
			"Électricité générale": "un projet d’électricité générale",
			"Éclairage solaire": "un projet d’éclairage solaire",
			"Autre besoin": "un projet spécifique"
		}[projectType];
		const introduction = projectDescription
			? `Je souhaiterais obtenir un devis pour ${projectDescription}.`
			: "Je souhaiterais obtenir un devis pour mon projet.";
		const personalDetails = name && city
			? `Je m’appelle ${name} et mon projet se situe à ${city}.`
			: name
				? `Je m’appelle ${name}.`
				: city
					? `Mon projet se situe à ${city}.`
					: "";
		const contactDetails = phone
			? `Vous pouvez me joindre au ${phone}.`
			: "";
		const productDetails = productTitle
			? `Je vous contacte également au sujet de « ${productTitle} ».`
			: "";
		const projectDetails = details
			? `Voici quelques détails sur mon projet :\n${details}`
			: "";
		const closing = name ? `Bien cordialement,\n${name}` : "Bien cordialement.";

		return [
			"Bonjour,",
			introduction,
			personalDetails,
			contactDetails,
			productDetails,
			projectDetails,
			"Je reste à votre disposition pour échanger sur les détails du projet.",
			closing
		].filter(Boolean).join("\n\n");
	};

	const methods = {
		whatsapp: {
			label: "Demander un devis sur WhatsApp",
			href: () => `https://wa.me/23566173093?text=${encodeURIComponent(buildMessage())}`,
			description: "Votre demande s’ouvrira dans WhatsApp avec les détails renseignés et le numéro +235 66 17 30 93.",
			target: "_blank"
		},
		email: {
			label: "Demander un devis par e-mail",
			href: () => {
				const productTitle = document.querySelector('.page-hero[data-page-section="Produits"] h1')?.textContent.trim();
				const subject = productTitle
					? `Demande de devis — ${productTitle}`
					: "Demande de devis";
				return `mailto:direction@seatopusglobal.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(buildMessage())}`;
			},
			description: "Votre demande s’ouvrira dans votre application e-mail, adressée à direction@seatopusglobal.com.",
			target: ""
		}
	};

	const updateAction = () => {
		const content = methods[tabs.find((tab) => tab.getAttribute("aria-selected") === "true")?.dataset.quoteMethod];
		if (content) action.href = content.href();
	};

	const selectMethod = (method, focusTab = false) => {
		const selectedTab = tabs.find((tab) => tab.dataset.quoteMethod === method);
		const content = methods[method];
		if (!selectedTab || !content) return;

		tabs.forEach((tab) => {
			const isSelected = tab === selectedTab;
			tab.setAttribute("aria-selected", String(isSelected));
			tab.tabIndex = isSelected ? 0 : -1;
		});

		if (focusTab) selectedTab.focus();
		tabList.dataset.active = method;
		panel.setAttribute("aria-labelledby", selectedTab.id);
		panel.classList.add("is-changing");

		window.setTimeout(() => {
			description.textContent = content.description;
			action.href = content.href();
			action.target = content.target;
			actionLabel.textContent = content.label;
			if (content.target) {
				action.rel = "noopener noreferrer";
			} else {
				action.removeAttribute("target");
				action.removeAttribute("rel");
			}
			panel.classList.remove("is-changing");
		}, 150);
	};

	Object.values(fields).forEach((field) => {
		field.addEventListener("input", updateAction);
		field.addEventListener("change", updateAction);
	});

	tabs.forEach((tab, index) => {
		tab.addEventListener("click", () => selectMethod(tab.dataset.quoteMethod));
		tab.addEventListener("keydown", (event) => {
			const nextIndex = event.key === "ArrowRight" || event.key === "ArrowDown"
				? (index + 1) % tabs.length
				: event.key === "ArrowLeft" || event.key === "ArrowUp"
					? (index - 1 + tabs.length) % tabs.length
					: event.key === "Home"
						? 0
						: event.key === "End"
							? tabs.length - 1
							: -1;

			if (nextIndex !== -1) {
				event.preventDefault();
				selectMethod(tabs[nextIndex].dataset.quoteMethod, true);
			}
		});
	});
});
