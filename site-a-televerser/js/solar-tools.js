document.querySelectorAll("[data-solar-calculator]").forEach((calculator) => {
	const list = calculator.querySelector("[data-solar-load-list]");
	const addButton = calculator.querySelector("[data-solar-add-load]");
	const result = calculator.querySelector("[data-solar-result]");
	const dailyValue = calculator.querySelector("[data-solar-daily]");
	const panelValue = calculator.querySelector("[data-solar-panel]");
	const contactLink = calculator.querySelector("[data-solar-contact]");
	const template = calculator.querySelector("template[data-solar-load-template]");
	const maxLoads = 12;

	const updateEstimate = () => {
		const rows = Array.from(list.querySelectorAll("[data-solar-load]"));
		const totalWh = rows.reduce((total, row) => {
			const powerInput = row.querySelector("[data-load-power]");
			const quantityInput = row.querySelector("[data-load-quantity]");
			const hoursInput = row.querySelector("[data-load-hours]");
			const power = Number(powerInput.value);
			const quantity = Number(quantityInput.value);
			const hours = Number(hoursInput.value);
			if (![powerInput, quantityInput, hoursInput].every((input) => input.validity.valid)) return total;
			if (![power, quantity, hours].every(Number.isFinite) || power <= 0 || quantity <= 0 || hours <= 0) {
				return total;
			}
			return total + power * quantity * hours;
		}, 0);

		if (totalWh <= 0) {
			result.classList.remove("is-visible");
			result.hidden = true;
			return;
		}

		const dailyKwh = totalWh / 1000;
		const panelLowKwp = dailyKwh / (5 * 0.8);
		const panelHighKwp = dailyKwh / (4 * 0.7);
		const roundedDaily = Math.round(dailyKwh * 10) / 10;
		const roundedLow = Math.max(0.1, Math.ceil(panelLowKwp * 10) / 10);
		const roundedHigh = Math.max(roundedLow, Math.ceil(panelHighKwp * 10) / 10);

		dailyValue.textContent = `${roundedDaily.toLocaleString("fr-FR", { maximumFractionDigits: 1 })} kWh / jour`;
		panelValue.textContent = `${roundedLow.toLocaleString("fr-FR", { maximumFractionDigits: 1 })} à ${roundedHigh.toLocaleString("fr-FR", { maximumFractionDigits: 1 })} kWc`;
		contactLink.href = `contact.php?daily_kwh=${encodeURIComponent(roundedDaily)}&panel_min=${encodeURIComponent(roundedLow)}&panel_max=${encodeURIComponent(roundedHigh)}`;
		result.hidden = false;
		requestAnimationFrame(() => result.classList.add("is-visible"));
	};

	const syncPowerFromPreset = (row) => {
		const select = row.querySelector("[data-load-preset]");
		const power = row.querySelector("[data-load-power]");
		const option = select.selectedOptions[0];
		power.value = option?.dataset.watts || "0";
	};

	const createLoadRow = () => {
		const row = template.content.firstElementChild.cloneNode(true);
		const removeButton = row.querySelector("[data-load-remove]");
		row.querySelector("[data-load-preset]").addEventListener("change", () => syncPowerFromPreset(row));
		row.querySelectorAll("input").forEach((input) => {
			input.addEventListener("input", updateEstimate);
			input.addEventListener("change", updateEstimate);
		});
		row.querySelector("[data-load-preset]").addEventListener("change", updateEstimate);
		removeButton.addEventListener("click", () => {
			row.remove();
			updateEstimate();
			addButton.disabled = list.children.length >= maxLoads;
		});
		list.append(row);
		updateEstimate();
		addButton.disabled = list.children.length >= maxLoads;
	};

	addButton.addEventListener("click", createLoadRow);
	calculator.querySelector("[data-solar-reset]").addEventListener("click", () => {
		list.replaceChildren();
		result.hidden = true;
		result.classList.remove("is-visible");
		createLoadRow();
	});

	createLoadRow();
});

document.querySelectorAll("[data-realisation-filters]").forEach((gallery) => {
	const buttons = Array.from(gallery.querySelectorAll("[data-filter]"));
	const cards = Array.from(gallery.querySelectorAll("[data-category]"));
	const count = gallery.querySelector("[data-filter-count]");

	const applyFilter = (filter, focusButton = false) => {
		const activeButton = buttons.find((button) => button.dataset.filter === filter);
		if (!activeButton) return;

		buttons.forEach((button) => {
			const active = button === activeButton;
			button.setAttribute("aria-pressed", String(active));
			button.tabIndex = active ? 0 : -1;
		});
		if (focusButton) activeButton.focus();

		let visible = 0;
		cards.forEach((card) => {
			const show = filter === "all" || card.dataset.category === filter;
			card.hidden = !show;
			if (show) visible += 1;
		});
		count.textContent = `${visible} ${visible > 1 ? "réalisations affichées" : "réalisation affichée"}`;
	};

	buttons.forEach((button, index) => {
		button.addEventListener("click", () => applyFilter(button.dataset.filter));
		button.addEventListener("keydown", (event) => {
			const nextIndex = event.key === "ArrowRight" || event.key === "ArrowDown"
				? (index + 1) % buttons.length
				: event.key === "ArrowLeft" || event.key === "ArrowUp"
					? (index - 1 + buttons.length) % buttons.length
					: event.key === "Home"
						? 0
						: event.key === "End"
							? buttons.length - 1
							: -1;
			if (nextIndex !== -1) {
				event.preventDefault();
				applyFilter(buttons[nextIndex].dataset.filter, true);
			}
		});
	});

	applyFilter("all");
});
