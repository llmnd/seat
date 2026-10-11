<button class="sa-launcher" type="button" data-nour-launcher aria-label="Ouvrir l’assistant solaire Nour" aria-haspopup="dialog" aria-controls="nour-dialog" hidden>
	<img src="images/nour-assistant.svg" alt="" aria-hidden="true">
</button>

<div class="sa-widget-backdrop" data-nour-backdrop hidden>
	<section class="sa sa-widget-dialog" id="nour-dialog" data-solar-advisor role="dialog" aria-modal="true" aria-labelledby="nour-dialog-title" tabindex="-1">
		<div class="sa-widget-top">
			<div class="sa-agent sa-widget-agent">
				<span class="sa-avatar" aria-hidden="true"><img src="images/nour-assistant.svg" alt=""></span>
				<div>
					<strong id="nour-dialog-title">Nour <span>· Assistant solaire</span></strong>
					<small><i aria-hidden="true"></i> En ligne pour vous guider</small>
				</div>
			</div>
			<button class="sa-widget-close" type="button" data-nour-close aria-label="Fermer l’assistant">×</button>
		</div>

		<div class="sa-grid">
			<div class="sa-chat-card">
				<div class="sa-log" role="log" aria-live="polite" aria-relevant="additions" data-sa-log></div>
				<noscript><p class="sa-fine">Activez JavaScript pour utiliser Nour, ou <a href="contact.php">contactez notre équipe</a> pour une étude.</p></noscript>
			</div>

			<aside class="sa-viz" data-sa-viz data-state="idle" aria-label="Simulation d’une journée solaire">
				<p class="sa-viz-title">Une journée avec vos panneaux</p>
				<p class="sa-viz-source" data-sa-source aria-live="polite">Choisissez le lieu et l’orientation pour afficher une estimation solaire locale.</p>
				<div class="sa-chart" data-sa-chart></div>
				<div class="sa-time">
					<input class="sa-range" type="range" min="0" max="24" step="0.25" value="12" data-sa-hour aria-label="Heure de la journée" disabled>
					<div class="sa-readout" data-sa-readout></div>
				</div>
				<ul class="sa-legend">
					<li><i style="background:#ffbb72"></i> Production solaire</li>
					<li><i style="background:#7fd3f7"></i> Consommation de jour</li>
					<li><i style="background:#0093d9"></i> Consommation du soir et de la nuit</li>
				</ul>
				<p class="sa-viz-note">Répondez à Nour : votre journée solaire se dessine ici.</p>
				<dl class="sa-metrics">
					<div><dt>Panneaux solaires</dt><dd data-out="panels">—</dd><small data-out="panels-sub"></small></div>
					<div><dt>Batterie</dt><dd data-out="battery">—</dd><small data-out="battery-sub"></small></div>
					<div><dt>Onduleur</dt><dd data-out="inverter">—</dd><small data-out="inverter-sub"></small></div>
					<div><dt>Production journalière</dt><dd data-out="energy">—</dd><small data-out="energy-sub"></small></div>
				</dl>
				<div class="sa-comparison" data-sa-comparison hidden></div>
				<details class="sa-how">
					<summary>Comment c’est calculé</summary>
					<div data-sa-how></div>
				</details>
			</aside>
		</div>
		<p class="sa-disclaimer"><span aria-hidden="true">i</span> Estimation indicative, à confirmer par une étude technique sur votre site.</p>
	</section>
</div>
