<div class="quote-cta__choice">
	<p class="quote-cta__label">Comment préférez-vous recevoir votre devis ?</p>
	<div class="quote-cta__tabs" role="tablist" aria-label="Choisir un moyen de contact">
		<button type="button" role="tab" id="quote-tab-whatsapp" aria-controls="quote-contact-panel" aria-selected="true" tabindex="0" data-quote-method="whatsapp">
			<svg class="quote-cta__tab-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 11.5a8 8 0 0 1-11.8 7L4 20l1.5-4A8 8 0 1 1 20 11.5Z"/><path d="M9 9.2c.5 2 1.8 3.3 3.8 4"/></svg> WhatsApp
		</button>
		<button type="button" role="tab" id="quote-tab-email" aria-controls="quote-contact-panel" aria-selected="false" tabindex="-1" data-quote-method="email">
			<svg class="quote-cta__tab-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg> E-mail
		</button>
	</div>
	<div class="quote-cta__brief" data-quote-brief>
		<p class="quote-cta__brief-title">Quelques détails pour mieux vous répondre <span>Facultatif</span></p>
		<label class="quote-cta__field">
			<span>Type de projet</span>
			<select name="project_type" data-quote-field="type">
				<option value="">Choisir un domaine</option>
				<option>Énergie solaire</option>
				<option>Pompage solaire</option>
				<option>Électricité générale</option>
				<option>Éclairage solaire</option>
				<option>Autre besoin</option>
			</select>
		</label>
		<div class="quote-cta__field-row">
			<label class="quote-cta__field">
				<span>Votre nom</span>
				<input type="text" name="name" autocomplete="name" placeholder="Nom et prénom" data-quote-field="name">
			</label>
			<label class="quote-cta__field">
				<span>Votre ville</span>
				<input type="text" name="city" autocomplete="address-level2" placeholder="Ex. N’Djamena" data-quote-field="city">
			</label>
		</div>
		<label class="quote-cta__field">
			<span>Votre téléphone <span class="quote-cta__optional">Pour être rappelé · facultatif</span></span>
			<input type="tel" name="phone" autocomplete="tel" placeholder="+235 …" data-quote-field="phone">
		</label>
		<label class="quote-cta__field">
			<span>Votre besoin</span>
			<textarea name="project_details" rows="3" placeholder="Décrivez brièvement votre projet…" data-quote-field="details"></textarea>
		</label>
	</div>
	<div class="quote-cta__panel" id="quote-contact-panel" role="tabpanel" aria-labelledby="quote-tab-whatsapp" aria-live="polite">
		<p data-quote-description>Complétez les détails si vous le souhaitez, puis écrivez-nous directement au +235 66 17 30 93.</p>
		<a class="quote-cta__action" href="https://wa.me/23566173093?text=Bonjour%2C%20je%20souhaite%20obtenir%20un%20devis%20pour%20mon%20projet." target="_blank" rel="noopener noreferrer" data-quote-link>
			<span data-quote-link-label>Demander un devis sur WhatsApp</span><span aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span>
		</a>
	</div>
</div>
