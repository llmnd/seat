(function () {
	'use strict';

	var installPrompt = null;
	var installPanel = document.querySelector('[data-pwa-install]');
	var installButton = document.querySelector('[data-pwa-install-button]');
	var dismissButton = document.querySelector('[data-pwa-install-dismiss]');
	var splash = document.querySelector('[data-pwa-splash]');
	var dismissedKey = 'seat-pwa-install-dismissed';
	var splashShownKey = 'seat-pwa-splash-shown';

	function showLaunchSplash() {
		var isStandalone = window.matchMedia('(display-mode: standalone)').matches
			|| window.navigator.standalone === true;
		if (!isStandalone || !splash || window.sessionStorage.getItem(splashShownKey) === 'yes') return;

		window.sessionStorage.setItem(splashShownKey, 'yes');
		splash.hidden = false;
		splash.classList.add('is-visible');

		var startedAt = Date.now();
		var minimumDuration = 1300;
		var dismissalStarted = false;
		var failSafe = window.setTimeout(hideLaunchSplash, 3500);

		function hideLaunchSplash() {
			if (dismissalStarted) return;
			dismissalStarted = true;
			window.clearTimeout(failSafe);
			var delay = Math.max(0, minimumDuration - (Date.now() - startedAt));
			window.setTimeout(function () {
				splash.classList.remove('is-visible');
				splash.classList.add('is-leaving');
				window.setTimeout(function () {
					splash.hidden = true;
					splash.classList.remove('is-leaving');
				}, 350);
			}, delay);
		}

		if (document.readyState === 'complete') {
			hideLaunchSplash();
		} else {
			window.addEventListener('load', hideLaunchSplash, { once: true });
		}
	}

	showLaunchSplash();

	if ('serviceWorker' in navigator) {
		window.addEventListener('load', function () {
			navigator.serviceWorker.register('./service-worker.js', { scope: './' })
				.catch(function (error) {
					console.error('Impossible d’activer le mode hors connexion SEAT.', error);
				});
		});
	}

	if (!installPanel || !installButton) return;

	window.addEventListener('beforeinstallprompt', function (event) {
		event.preventDefault();
		installPrompt = event;
		if (window.localStorage.getItem(dismissedKey) !== 'yes') {
			installPanel.hidden = false;
		}
	});

	window.addEventListener('appinstalled', function () {
		installPrompt = null;
		installPanel.hidden = true;
	});

	installButton.addEventListener('click', async function () {
		if (!installPrompt) return;

		installPrompt.prompt();
		var choice = await installPrompt.userChoice;
		if (choice.outcome === 'accepted') {
			installPanel.hidden = true;
		}
		installPrompt = null;
	});

	if (dismissButton) {
		dismissButton.addEventListener('click', function () {
			installPanel.hidden = true;
			window.localStorage.setItem(dismissedKey, 'yes');
		});
	}
})();
