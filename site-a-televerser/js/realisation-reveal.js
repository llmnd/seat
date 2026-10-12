document.querySelectorAll("[data-realisation-reveal]").forEach((reveal) => {
	const range = reveal.querySelector("[data-reveal-range]");
	const viewport = reveal.querySelector("[data-reveal-viewport]");
	const mainImage = reveal.querySelector("[data-reveal-after] img");
	const photoLabel = reveal.querySelector("[data-reveal-photo-label]");
	const captionTitle = reveal.querySelector("[data-reveal-caption-title]");
	const captionDetail = reveal.querySelector("[data-reveal-caption-detail]");
	const categoryButtons = Array.from(reveal.querySelectorAll("[data-reveal-category]"));
	const photoGroups = Array.from(reveal.querySelectorAll("[data-reveal-photos]"));

	const selectPhoto = (button) => {
		const value = Number(range.value);
		mainImage.src = button.dataset.src;
		mainImage.alt = button.dataset.alt;
		photoLabel.textContent = button.dataset.label;
		captionTitle.textContent = button.dataset.caption;
		captionDetail.textContent = button.dataset.detail;
		range.setAttribute("aria-valuetext", `${value}% de la photo ${button.dataset.detail} révélée sur l’illustration`);

		const group = button.closest("[data-reveal-photos]");
		group.querySelectorAll("[data-reveal-photo]").forEach((photo) => {
			const active = photo === button;
			photo.classList.toggle("is-active", active);
			photo.setAttribute("aria-pressed", String(active));
		});
	};

	const selectCategory = (button, focusButton = false) => {
		const category = button.dataset.revealCategory;
		const group = photoGroups.find((photos) => photos.dataset.category === category);
		if (!group) return;

		categoryButtons.forEach((categoryButton) => {
			const active = categoryButton === button;
			categoryButton.setAttribute("aria-pressed", String(active));
			categoryButton.tabIndex = active ? 0 : -1;
		});
		photoGroups.forEach((photos) => {
			photos.hidden = photos !== group;
		});
		if (focusButton) button.focus();

		const firstPhoto = group.querySelector("[data-reveal-photo]");
		if (firstPhoto) selectPhoto(firstPhoto);
	};

	const updateReveal = () => {
		const value = Number(range.value);
		viewport.style.setProperty("--reveal-position", `${value}%`);
		range.setAttribute(
			"aria-valuetext",
			`${value}% de la photo ${captionDetail.textContent} révélée sur l’illustration`
		);
	};

	categoryButtons.forEach((button, index) => {
		button.tabIndex = button.getAttribute("aria-pressed") === "true" ? 0 : -1;
		button.addEventListener("click", () => selectCategory(button));
		button.addEventListener("keydown", (event) => {
			let nextIndex = index;
			if (event.key === "ArrowRight" || event.key === "ArrowDown") {
				nextIndex = (index + 1) % categoryButtons.length;
			} else if (event.key === "ArrowLeft" || event.key === "ArrowUp") {
				nextIndex = (index - 1 + categoryButtons.length) % categoryButtons.length;
			} else if (event.key === "Home") {
				nextIndex = 0;
			} else if (event.key === "End") {
				nextIndex = categoryButtons.length - 1;
			} else {
				return;
			}
			event.preventDefault();
			selectCategory(categoryButtons[nextIndex], true);
		});
	});

	photoGroups.forEach((group) => {
		group.querySelectorAll("[data-reveal-photo]").forEach((button) => {
			button.addEventListener("click", () => selectPhoto(button));
		});
	});

	range.addEventListener("input", updateReveal);
	range.addEventListener("change", updateReveal);
	categoryButtons.forEach((button) => {
		if (button.getAttribute("aria-pressed") === "true") selectCategory(button);
	});
	updateReveal();
});
