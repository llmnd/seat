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
	const minHour = Number(range.min);
	const maxHour = Number(range.max);
	const cycleDuration = 24000;
	let playing = !reducedMotion.matches;
	let previousFrame = 0;
	let currentHour = Number(range.value);

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
		const isNight = hour < 7.25 || hour >= 17;
		const phase = isNight ? "night" : hour < 9 ? "morning" : hour > 15.5 ? "evening" : "day";
		const batteryLevel = hour < 7.25
			? 0.35 + ((hour - minHour) / 1.25) * 0.18
			: hour >= 17
				? 0.53 - ((hour - 17) / (maxHour - 17)) * 0.18
				: 0.53 + (Math.sin(Math.PI * ((hour - 7.25) / 9.75)) * 0.42);
		const batteryHeight = 70 * Math.max(0.25, Math.min(1, batteryLevel));

		sun.setAttribute("transform", `translate(${x.toFixed(1)} ${y.toFixed(1)})`);
		sunbeams.forEach((beam, index) => {
			const targetX = index === 0 ? 205 : 285;
			beam.setAttribute("d", `M${(x - 11 + index * 16).toFixed(1)} ${(y + 22).toFixed(1)}L${targetX} 346`);
		});
		stage.dataset.phase = phase;
		range.value = String(hour);
		range.setAttribute("aria-valuetext", `${formatTime(hour)}${isNight ? ", la batterie alimente les usages" : ", le soleil produit de l’énergie"}`);
		timeOutput.textContent = formatTime(hour);
		batteryFill.setAttribute("y", String(460 - batteryHeight));
		batteryFill.setAttribute("height", String(batteryHeight));
		daylight.style.setProperty("--daylight-progress", `${progress * 100}%`);
		stateOutput.textContent = isNight
			? "La batterie prend le relais pour alimenter les usages."
			: phase === "morning"
				? "La production solaire démarre et la batterie se recharge."
				: phase === "evening"
					? "La production baisse ; la batterie garde l’énergie."
					: "Le soleil alimente la maison et recharge la batterie.";
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
