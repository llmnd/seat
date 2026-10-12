(function () {
	'use strict';

	var installPrompt = null;
	var installPanel = document.querySelector('[data-pwa-install]');
	var installButton = document.querySelector('[data-pwa-install-button]');
	var dismissButton = document.querySelector('[data-pwa-install-dismiss]');
	var dismissedKey = 'seat-pwa-install-dismissed';

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
