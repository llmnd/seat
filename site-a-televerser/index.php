<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="SEAT Opus Global conçoit et réalise des solutions solaires, électriques et de pompage adaptées à vos besoins.">
	<meta name="theme-color" content="#103b59">
	<title>SEAT Opus Global — L’énergie, pensée pour durer</title>
	<link rel="icon" href="images/logo.jpg">
	<?php require __DIR__ . '/includes/site-fonts.php'; ?>
	<link rel="stylesheet" href="css/homepage.css?v=11">
	<link rel="stylesheet" href="css/hero.css?v=8">
	<link rel="stylesheet" href="css/site-header.css">
	<link rel="stylesheet" href="css/sections.css?v=2">
	<link rel="stylesheet" href="css/project-planner.css?v=2">
	<script src="js/home-hero.js?v=2" defer></script>
	<script src="js/project-planner.js?v=1" defer></script>
</head>
<body>
	<?php require __DIR__ . '/includes/header.php'; ?>

	<main>
		<section class="hx" aria-labelledby="hero-title">
			<div class="container hx-container">

				<div class="hx-badge" aria-hidden="true">
					<svg viewBox="0 0 120 120">
						<defs><path id="hx-circle" d="M60,60 m-44,0 a44,44 0 1,1 88,0 a44,44 0 1,1 -88,0"/></defs>
						<text><textPath href="#hx-circle" textLength="270" lengthAdjust="spacing">ÉNERGIE · ÉLECTRICITÉ · INGÉNIERIE · </textPath></text>
					</svg>
					<svg class="hx-badge-sun" viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="7" stroke="currentColor" stroke-width="2"/><path d="M24 6v6m0 24v6M6 24h6m24 0h6M11.3 11.3l4.2 4.2m17 17 4.2 4.2m0-25.4-4.2 4.2m-17 17-4.2 4.2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
				</div>

				<div class="hx-head">
					<p class="hx-pill"><span></span> Énergie · Électricité · Ingénierie</p>
					<h1 id="hero-title">L’énergie de demain,<br><em>pensée pour durer.</em></h1>
					<p class="hx-copy">Des solutions fiables, pensées pour vos projets.</p>
					<div class="hx-actions">
						<a class="hx-btn hx-btn-dark" href="contact.php">Parlons de votre projet <i aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></i></a>
						<a class="hx-btn hx-btn-light" href="realisationSolaire.php">Voir nos réalisations <i aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M5 12h14m-7-7 7 7-7 7"/></svg></i></a>
					</div>
				</div>

				<div class="hx-stage" data-hero-carousel role="region" aria-roledescription="carrousel" aria-label="Nos réalisations en images">
					<div class="hx-frame">
						<img class="hero-slide is-active" src="images/solaire1.jpg" alt="Technicien installant des panneaux solaires sur une toiture">
						<img class="hero-slide" data-src="images/solaire.jpg" alt="Équipe installant des panneaux solaires" aria-hidden="true">
						<img class="hero-slide" data-src="images/solaire3.jpg" alt="Panneaux solaires et éoliennes au coucher du soleil" aria-hidden="true">
						<img class="hero-slide hero-slide-pompage" data-src="images/pompage1.png" alt="Installation de pompage solaire" aria-hidden="true">
						<img class="hero-slide" data-src="images/solaire2.PNG" alt="Installation de panneaux solaires" aria-hidden="true">
						<img class="hero-slide" data-src="images/pompage2.PNG" alt="Projet de pompage solaire sur le terrain" aria-hidden="true">
						<span class="hx-shade" aria-hidden="true"></span>

						<div class="hero-slide-controls" aria-label="Choisir une image">
							<button type="button" data-hero-slide="0" aria-label="Afficher le technicien installant les panneaux" aria-pressed="true">01</button>
							<button type="button" data-hero-slide="1" aria-label="Afficher l’équipe solaire" aria-pressed="false">02</button>
							<button type="button" data-hero-slide="2" aria-label="Afficher les panneaux et éoliennes" aria-pressed="false">03</button>
							<button type="button" data-hero-slide="3" aria-label="Afficher le pompage solaire" aria-pressed="false">04</button>
							<button type="button" data-hero-slide="4" aria-label="Afficher une autre installation solaire" aria-pressed="false">05</button>
							<button type="button" data-hero-slide="5" aria-label="Afficher un projet de pompage solaire" aria-pressed="false">06</button>
						</div>
					</div>
				</div>

				<div class="hx-foot">
					<p><span></span> Membre du Groupe NS2I</p>
					<p>Installer juste.<br>Durer longtemps.</p>
				</div>
			</div>
		</section>

		<section class="sa sa-promo" id="estimation" aria-labelledby="sa-title">
			<div class="container">
				<div class="sa-showcase-head">
					<div class="sa-showcase-copy">
						<p class="sa-kicker"><span aria-hidden="true"></span> Innovation · Assistant solaire</p>
						<h2 class="sx-title" id="sa-title">Votre projet solaire,<br><em>prend forme ici.</em></h2>
						<p class="sx-lead">Découvrez en quelques réponses une première estimation de vos panneaux, de votre batterie et de votre onduleur.</p>
						<div class="sa-trust">
							<span><i aria-hidden="true">✓</i> Simple et personnalisable</span>
							<span><i aria-hidden="true">✓</i> Gratuit, sans inscription</span>
						</div>
						<a class="sa-cta sa-promo-cta" href="contact.php" data-nour-open>
							Parler avec Nour <span aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span>
						</a>
					</div>
					<div class="sa-hero-assistant">
						<div class="sa-hero-glow" aria-hidden="true"></div>
						<img class="sa-mascot" src="images/nour-assistant.svg" alt="Illustration de Nour, votre assistante solaire">
						<div class="sa-hello"><span class="sa-hello-dot" aria-hidden="true"></span>Bonjour, moi c’est <strong>Nour</strong> !</div>
						<p class="sa-hero-caption">Votre guide pour imaginer<br>une solution solaire adaptée.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- 1. Expertises -->
		<section class="sx-section sx-services" id="expertises" aria-labelledby="services-title">
			<div class="container">
				<div class="sx-head">
					<h2 class="sx-title" id="services-title">Des solutions concrètes,<br><em>pensées pour durer.</em></h2>
					<p class="sx-lead">Nous concevons et réalisons des solutions adaptées à vos besoins, à votre activité et aux réalités de votre site.</p>
				</div>

				<div class="sx-panels">
					<a class="sx-panel sx-panel--solar" href="monocristallin.php">
						<img src="images/solaire1.jpg" alt="" loading="eager" decoding="async">
						<span class="sx-panel-icon" aria-hidden="true">
							<svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="8" stroke="currentColor" stroke-width="1.7"/><path d="M24 4v6m0 28v6M4 24h6m28 0h6M9.86 9.86l4.24 4.24m19.8 19.8 4.24 4.24m0-28.28-4.24 4.24m-19.8 19.8-4.24 4.24" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
						</span>
						<span class="sx-panel-go" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span>
						<span class="sx-panel-body">
							<span class="sx-panel-title">Énergie solaire</span>
							<span class="sx-panel-more"><span class="sx-panel-more-inner">
								<span class="sx-panel-text">Étude et installation de systèmes photovoltaïques conçus selon vos besoins, votre site et vos usages.</span>
								<span class="sx-panel-cta">Découvrir nos panneaux</span>
							</span></span>
						</span>
					</a>

					<a class="sx-panel sx-panel--electric" href="service.php">
						<img src="images/realisation2.PNG" alt="" loading="eager" decoding="async">
						<span class="sx-panel-icon" aria-hidden="true">
							<svg viewBox="0 0 48 48" fill="none"><path d="M27.5 4 11 26h11l-1.5 18L37 21H25l2.5-17Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
						</span>
						<span class="sx-panel-go" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span>
						<span class="sx-panel-body">
							<span class="sx-panel-title">Électricité générale</span>
							<span class="sx-panel-more"><span class="sx-panel-more-inner">
								<span class="sx-panel-text">Conception, installation et mise en conformité, avec méthode et sécurité à chaque étape.</span>
								<span class="sx-panel-cta">Voir nos services</span>
							</span></span>
						</span>
					</a>

					<a class="sx-panel sx-panel--water" href="realisationPompage.php">
						<img src="images/pompage.jpg" alt="" loading="eager" decoding="async">
						<span class="sx-panel-icon" aria-hidden="true">
							<svg viewBox="0 0 48 48" fill="none"><path d="M24 5s13 14 13 24a13 13 0 1 1-26 0C11 19 24 5 24 5Z" stroke="currentColor" stroke-width="1.7"/><path d="M18 30c.7 3 2.6 4.7 5.8 5.2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
						</span>
						<span class="sx-panel-go" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span>
						<span class="sx-panel-body">
							<span class="sx-panel-title">Pompage solaire</span>
							<span class="sx-panel-more"><span class="sx-panel-more-inner">
								<span class="sx-panel-text">Des équipements adaptés au terrain pour répondre durablement à vos besoins en eau.</span>
								<span class="sx-panel-cta">Voir nos réalisations</span>
							</span></span>
						</span>
					</a>
				</div>
			</div>
		</section>

		<!-- 2. À propos -->
		<section class="sx-section sx-about" id="apropos" aria-labelledby="about-title">
			<div class="container sx-about-grid">
				<figure class="sx-about-media">
					<img src="images/apropos.JPG" alt="Un technicien SEAT Opus Global lors d’une installation électrique" loading="lazy">
					<figcaption class="sx-about-note">Le savoir-faire, sur le terrain <small>Membre du Groupe NS2I</small></figcaption>
				</figure>

				<div class="sx-about-copy">
					<h2 class="sx-title" id="about-title">La technique au service<br>de <em>vos ambitions.</em></h2>
					<p class="sx-about-lead">SEAT Opus Global accompagne particuliers et professionnels dans leurs projets énergétiques et électriques.</p>
					<p class="sx-about-text">Notre approche associe écoute, expertise technique et choix d’équipements professionnels. Chaque installation répond à un besoin réel, avec une attention particulière portée à la qualité et à la pérennité.</p>
					<ul class="sx-checks">
						<li>
							<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="10.5" stroke="currentColor" stroke-width="1.4"/><path d="m7.5 12.4 3 3 6-6.4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
							Des recommandations adaptées à votre projet
						</li>
						<li>
							<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="10.5" stroke="currentColor" stroke-width="1.4"/><path d="m7.5 12.4 3 3 6-6.4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
							Une attention constante à la qualité d’exécution
						</li>
						<li>
							<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="10.5" stroke="currentColor" stroke-width="1.4"/><path d="m7.5 12.4 3 3 6-6.4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
							Des techniciens qualifiés et habilités
						</li>
					</ul>
					<a class="sx-btn" href="service.php">En savoir plus sur nos services <span aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span></a>
				</div>
			</div>

			<div class="container">
				<ol class="sx-method" aria-label="Notre méthode">
					<li>
						<span class="sx-method-n" aria-hidden="true">1</span>
						<h3>Écouter</h3>
						<p>Nous partons de votre besoin réel, de votre site et de vos usages avant de proposer quoi que ce soit.</p>
					</li>
					<li>
						<span class="sx-method-n" aria-hidden="true">2</span>
						<h3>Étudier</h3>
						<p>Nous dimensionnons la solution et choisissons des équipements professionnels adaptés à votre projet.</p>
					</li>
					<li>
						<span class="sx-method-n" aria-hidden="true">3</span>
						<h3>Installer</h3>
						<p>Nos techniciens qualifiés et habilités réalisent l’installation avec méthode, sécurité et exigence de qualité.</p>
					</li>
				</ol>
			</div>
		</section>

		<!-- 3. Réalisations -->
		<section class="sx-section sx-projects" id="realisations" aria-labelledby="projects-title">
			<div class="container">
				<div class="sx-head">
					<h2 class="sx-title" id="projects-title">Des projets qui prennent<br><em>vie avec le soleil.</em></h2>
					<a class="sx-link" href="realisations.php">Toutes nos réalisations <svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></a>
				</div>

				<div class="sx-projects-grid">
					<a class="sx-project sx-project--feature" href="realisationSolaire.php">
						<img src="images/realisation.PNG" alt="Centrale solaire de 100 kW destinée à l’alimentation d’un hôpital de district" loading="lazy">
						<span class="sx-project-kw" aria-label="Puissance du projet : 100 kilowatts">100 kW</span>
						<span class="sx-project-body">
							<span class="sx-project-tag">Solaire · Santé</span>
							<span class="sx-project-name">Une centrale solaire pour un hôpital de district <span aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span></span>
						</span>
					</a>

					<a class="sx-project" href="realisationPompage.php">
						<img src="images/pompage1.PNG" alt="Projet de pompage solaire sur le terrain" loading="lazy">
						<span class="sx-project-body">
							<span class="sx-project-tag">Pompage solaire</span>
							<span class="sx-project-name">L’énergie au service de l’eau <span aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span></span>
						</span>
					</a>

					<a class="sx-project" href="realisationLampadaire.php">
						<img src="images/realisation1.PNG" alt="Équipement solaire installé par l’équipe SEAT" loading="lazy">
						<span class="sx-project-body">
							<span class="sx-project-tag">Éclairage</span>
							<span class="sx-project-name">Des solutions pour chaque espace <span aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span></span>
						</span>
					</a>
				</div>
			</div>
		</section>

		<section class="project-planner" id="preparer-projet" data-project-planner aria-labelledby="planner-title">
			<div class="project-planner__print-brand" aria-hidden="true">
				<img src="images/logo1.jfif" alt="">
				<div><strong>SEAT Opus Global</strong><span>Carnet de préparation de projet</span></div>
			</div>
			<div class="container project-planner__layout">
				<div class="project-planner__intro">
					<p class="project-planner__eyebrow"><span aria-hidden="true"></span> Votre projet, mieux préparé</p>
					<h2 id="planner-title">Faisons le point<br><em>sur vos besoins.</em></h2>
					<p>En quelques choix, préparez un brief clair à transmettre à notre équipe. Pas de calcul automatique : ces informations nous aident à mieux comprendre votre demande.</p>
					<ol class="project-planner__steps" aria-label="Étapes du carnet de projet">
						<li><span>01</span> Décrivez votre projet</li>
						<li><span>02</span> Choisissez vos priorités</li>
						<li><span>03</span> Partagez votre récapitulatif</li>
					</ol>
					<p class="project-planner__privacy">Vos réponses restent dans votre navigateur jusqu’à ce que vous choisissiez de les partager.</p>
				</div>

				<div class="project-planner__card">
					<form data-planner-form>
						<label class="project-planner__field">
							<span>Quel type de projet préparez-vous ?</span>
							<select name="type" required>
								<option value="">Choisir un domaine</option>
								<option value="Énergie solaire">Énergie solaire</option>
								<option value="Pompage solaire">Pompage solaire</option>
								<option value="Électricité générale">Électricité générale</option>
								<option value="Éclairage solaire">Éclairage solaire</option>
								<option value="Autre besoin">Autre besoin</option>
							</select>
						</label>

						<div class="project-planner__fields">
							<label class="project-planner__field">
								<span>Ville du projet</span>
								<input name="city" type="text" autocomplete="address-level2" maxlength="100" placeholder="Ex. N’Djamena" required>
							</label>
							<label class="project-planner__field">
								<span>Où en êtes-vous ?</span>
								<select name="stage">
									<option value="Je découvre les solutions possibles">Je découvre les solutions possibles</option>
									<option value="J’ai déjà un site ou un bâtiment">J’ai déjà un site ou un bâtiment</option>
									<option value="J’ai des informations techniques">J’ai des informations techniques</option>
									<option value="Je souhaite planifier une visite">Je souhaite planifier une visite</option>
								</select>
							</label>
						</div>

						<fieldset class="project-planner__priorities">
							<legend>Quelles sont vos priorités ? <span>Plusieurs choix possibles</span></legend>
							<label><input type="checkbox" name="priority" value="Assurer une alimentation électrique plus régulière"><span>Assurer une alimentation plus régulière</span></label>
							<label><input type="checkbox" name="priority" value="Réduire la dépendance au réseau ou au carburant"><span>Réduire la dépendance au réseau ou au carburant</span></label>
							<label><input type="checkbox" name="priority" value="Alimenter une pompe ou sécuriser l’accès à l’eau"><span>Alimenter une pompe ou sécuriser l’accès à l’eau</span></label>
							<label><input type="checkbox" name="priority" value="Améliorer l’éclairage d’un espace"><span>Améliorer l’éclairage d’un espace</span></label>
							<label><input type="checkbox" name="priority" value="Installer ou mettre aux normes une installation électrique"><span>Installer ou mettre aux normes une installation électrique</span></label>
						</fieldset>

						<label class="project-planner__field">
							<span>Un détail utile à préciser ? <span>Facultatif</span></span>
							<textarea name="details" rows="3" maxlength="600" placeholder="Ex. type de bâtiment, équipement à alimenter, contrainte particulière…"></textarea>
						</label>

						<div class="project-planner__preview" aria-labelledby="planner-preview-title">
							<div class="project-planner__preview-head">
								<span class="project-planner__preview-icon" aria-hidden="true">
									<svg viewBox="0 0 24 24" fill="none"><path d="M7 3h7l5 5v13H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M14 3v5h5M9 13h6M9 17h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
								</span>
								<div><h3 id="planner-preview-title">Votre carnet de projet</h3><p>Le récapitulatif se met à jour avec vos réponses.</p></div>
							</div>
							<div class="project-planner__summary" data-planner-summary>
								<p>Choisissez un domaine et indiquez la ville pour commencer votre brief.</p>
							</div>
							<p class="project-planner__status" data-planner-status aria-live="polite"></p>
							<div class="project-planner__actions">
								<button type="button" class="project-planner__button project-planner__button--primary" data-planner-whatsapp disabled>
									<span aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M20 11.5a8 8 0 0 1-11.8 7L4 20l1.5-4A8 8 0 1 1 20 11.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 9.2c.5 2 1.8 3.3 3.8 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
									Préparer sur WhatsApp
								</button>
								<button type="button" class="project-planner__button" data-planner-copy disabled>Copier le brief</button>
								<button type="button" class="project-planner__button" data-planner-print disabled>Imprimer / PDF</button>
								<a class="project-planner__text-link" href="contact.php" data-planner-contact>Compléter une demande de devis <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-7-7 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>

		<!-- 4. Partenaires -->
		<section class="sx-partners" aria-labelledby="partners-title">
			<div class="container sx-partners-inner">
				<h2 class="sx-title sx-partners-title" id="partners-title">Des partenaires<br><em>de confiance.</em></h2>
				<div class="sx-logos" role="region" aria-label="Partenaires de confiance">
					<div class="sx-logos-track">
						<div class="sx-logos-group">
							<img src="images/ns2i%20groupe.jpg" alt="NS2i Group" loading="eager">
							<img src="images/logo%20hoppercker.jpg" alt="Hoppecke" loading="eager">
							<img src="images/logo%20lorentz.png" alt="Lorentz" loading="eager">
							<img src="images/logo%20ifrisol.jpeg" alt="Ifrisol" loading="eager">
							<img src="images/logo%20sma.png" alt="SMA" loading="eager">
							<img src="images/logo%20solarworld.png" alt="SolarWorld" loading="eager">
							<img src="images/logo%20studer.jpg" alt="Studer" loading="eager">
							<img src="images/logo%20victron%20energy.png" alt="Victron Energy" loading="eager">
							<img src="images/LOGO%20SCHNEIDER.png" alt="Schneider Electric" loading="eager">
							<img src="images/logo%20grundfos.jpg" alt="Grundfos" loading="eager">
							<img src="images/CONSULTING-LOGO-OFFICIEL.png" alt="Consulting Africa Tchad" loading="eager">
							<img src="images/logo%20steca.png" alt="Steca" loading="eager">
						</div>
						<div class="sx-logos-group" aria-hidden="true">
							<img src="images/ns2i%20groupe.jpg" alt="" loading="lazy">
							<img src="images/logo%20hoppercker.jpg" alt="" loading="lazy">
							<img src="images/logo%20lorentz.png" alt="" loading="lazy">
							<img src="images/logo%20ifrisol.jpeg" alt="" loading="lazy">
							<img src="images/logo%20sma.png" alt="" loading="lazy">
							<img src="images/logo%20solarworld.png" alt="" loading="lazy">
							<img src="images/logo%20studer.jpg" alt="" loading="lazy">
							<img src="images/logo%20victron%20energy.png" alt="" loading="lazy">
							<img src="images/LOGO%20SCHNEIDER.png" alt="" loading="lazy">
							<img src="images/logo%20grundfos.jpg" alt="" loading="lazy">
							<img src="images/CONSULTING-LOGO-OFFICIEL.png" alt="" loading="lazy">
							<img src="images/logo%20steca.png" alt="" loading="lazy">
						</div>
					</div>
				</div>
			</div>
		</section>

	</main>

	<?php require __DIR__ . '/includes/site-footer.php'; ?>
</body>
</html>