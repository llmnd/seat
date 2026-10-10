document.addEventListener('DOMContentLoaded', function () {
	const carousel = document.querySelector('[data-hero-carousel]');
	if (!carousel) {
		return;
	}

	const slides = Array.from(carousel.querySelectorAll('.hero-slide'));
	const controls = Array.from(carousel.querySelectorAll('[data-hero-slide]'));
	const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
	let activeIndex = Math.max(0, slides.findIndex(function (slide) {
		return slide.classList.contains('is-active');
	}));
	let timer;

	function stopRotation() {
		window.clearTimeout(timer);
	}

	function showSlide(index) {
		const slide = slides[index];
		if (!slide.getAttribute('src') && slide.dataset.src) {
			slide.src = slide.dataset.src;
			delete slide.dataset.src;
		}
		if (!slide.complete || slide.naturalWidth === 0) {
			if (slide.dataset.loading !== 'true') {
				slide.dataset.loading = 'true';
				slide.addEventListener('load', function () {
					delete slide.dataset.loading;
					showSlide(index);
				}, { once: true });
				slide.addEventListener('error', function () {
					delete slide.dataset.loading;
					console.error('Impossible de charger une image du carrousel :', slide.src);
				}, { once: true });
			}
			return;
		}

		activeIndex = index;
		slides.forEach(function (slide, slideIndex) {
			const isActive = slideIndex === activeIndex;
			slide.classList.toggle('is-active', isActive);
			slide.setAttribute('aria-hidden', String(!isActive));
		});
		controls.forEach(function (control, controlIndex) {
			control.setAttribute('aria-pressed', String(controlIndex === activeIndex));
		});
	}

	function preloadSlide(index) {
		const slide = slides[index];
		if (!slide.dataset.src || slide.dataset.preloading === 'true') {
			return;
		}
		slide.dataset.preloading = 'true';
		const image = new Image();
		image.onload = function () {
			delete slide.dataset.preloading;
		};
		image.onerror = function () {
			delete slide.dataset.preloading;
			console.error('Impossible de précharger une image du carrousel :', image.src);
		};
		image.src = slide.dataset.src;
	}

	function scheduleRotation() {
		stopRotation();
		if (prefersReducedMotion.matches || document.hidden || carousel.matches(':hover') || carousel.contains(document.activeElement)) {
			return;
		}
		preloadSlide((activeIndex + 1) % slides.length);
		timer = window.setTimeout(function () {
			showSlide((activeIndex + 1) % slides.length);
			scheduleRotation();
		}, 5500);
	}

	controls.forEach(function (control, index) {
		control.addEventListener('click', function () {
			showSlide(index);
			scheduleRotation();
		});
	});

	carousel.addEventListener('pointerenter', stopRotation);
	carousel.addEventListener('pointerleave', scheduleRotation);
	carousel.addEventListener('focusin', stopRotation);
	carousel.addEventListener('focusout', function (event) {
		if (!carousel.contains(event.relatedTarget)) {
			scheduleRotation();
		}
	});
	document.addEventListener('visibilitychange', scheduleRotation);
	prefersReducedMotion.addEventListener('change', scheduleRotation);

	showSlide(activeIndex);
	scheduleRotation();
});
