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
	<link rel="stylesheet" href="css/project-journey.css?v=1">
	<script src="js/home-hero.js?v=2" defer></script>
	<script src="js/project-planner.js?v=1" defer></script>
	<script src="js/project-journey.js?v=1" defer></script>
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
						<img class="hero-slide" data-src="images/b2.jpeg" alt="Rangées de panneaux photovoltaïques sous un ciel dégagé" aria-hidden="true">
						<img class="hero-slide" data-src="images/solaire.jpg" alt="Panneaux solaires alimentant une installation de pompage agricole" aria-hidden="true">
						<span class="hx-shade" aria-hidden="true"></span>

						<div class="hero-slide-controls" aria-label="Choisir une image">
							<button type="button" data-hero-slide="0" aria-label="Afficher un technicien installant des panneaux solaires" aria-pressed="true">01</button>
							<button type="button" data-hero-slide="1" aria-label="Afficher des panneaux photovoltaïques" aria-pressed="false">02</button>
							<button type="button" data-hero-slide="2" aria-label="Afficher une installation de pompage solaire agricole" aria-pressed="false">03</button>
							<button type="button" data-hero-slide="3" aria-label="Afficher un détail d’équipement électrique" aria-pressed="false">04</button>
							<button type="button" data-hero-slide="4" aria-label="Afficher une installation de pompage solaire" aria-pressed="false">05</button>
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
						<img src="images/realisations/solaire-panneaux-toiture-etablissement.jpeg" alt="" loading="eager" decoding="async">
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
						<img src="images/realisations/solaire-equipe-electrique.jpeg" alt="" loading="eager" decoding="async">
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
						<img src="images/realisations/pompage-solaire-site-01.jpeg" alt="" loading="eager" decoding="async">
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
				<section class="sx-leadership" aria-labelledby="leadership-title">
					<figure class="sx-leadership__portrait">
						<img src="images/ceo.jpeg" alt="Le CEO de SEAT Opus Global au milieu des équipements solaires" loading="lazy" decoding="async">
						<figcaption>SEAT Opus Global <span>Énergie · Expertise · Engagement</span></figcaption>
					</figure>
					<div class="sx-leadership__copy">
						<p class="sx-leadership__eyebrow"><span aria-hidden="true"></span> Une vision portée sur le terrain</p>
						<h2 id="leadership-title">L’énergie de demain<br><em>se construit ensemble.</em></h2>
						<p>À la tête de SEAT Opus Global, notre CEO porte une ambition : proposer des solutions énergétiques fiables, adaptées aux réalités du terrain et pensées pour durer.</p>
						<div class="sx-leadership__signature">
							<span class="sx-leadership__mark" aria-hidden="true">S</span>
							<span><strong>Le CEO</strong><small>SEAT Opus Global</small></span>
						</div>
					</div>
				</section>
			</div>

			<div class="container">
				<section class="project-journey" data-project-journey aria-labelledby="project-journey-title">
					<div class="project-journey__heading">
						<p class="project-journey__eyebrow"><span aria-hidden="true"></span> Votre projet, pas à pas</p>
						<h2 id="project-journey-title">Du premier besoin<br><em>à l’énergie en marche.</em></h2>
						<p>Explorez les grandes étapes de notre accompagnement, de la compréhension de votre besoin à la mise en service de votre installation.</p>
					</div>

					<div class="project-journey__card" data-journey-step="0">
						<div class="project-journey__scene" aria-hidden="true">
							<svg class="project-journey__drawing" viewBox="0 0 820 330" fill="none" xmlns="http://www.w3.org/2000/svg">
								<defs>
									<linearGradient id="journey-sky" x1="410" y1="0" x2="410" y2="330" gradientUnits="userSpaceOnUse">
										<stop stop-color="#E7F5F8"/>
										<stop offset="1" stop-color="#F7FAF7"/>
									</linearGradient>
									<radialGradient id="journey-sun">
										<stop stop-color="#FFE2A3" stop-opacity=".8"/>
										<stop offset="1" stop-color="#FFE2A3" stop-opacity="0"/>
									</radialGradient>
								</defs>
								<rect width="820" height="330" rx="22" fill="url(#journey-sky)"/>
								<circle cx="715" cy="62" r="94" fill="url(#journey-sun)"/>
								<circle cx="715" cy="62" r="19" fill="#F4B84F" fill-opacity=".86"/>
								<path d="M0 247C125 216 205 264 326 244C467 221 546 208 670 243C735 261 784 257 820 245V330H0V247Z" fill="#E6F1E9"/>
								<path d="M0 273C135 248 230 281 357 268C501 253 634 247 820 276V330H0V273Z" fill="#D9EAE1"/>
								<path class="project-journey__route-base" d="M81 228H739" pathLength="100"/>
								<path class="project-journey__route-progress" data-journey-progress d="M81 228H739" pathLength="100" stroke-dasharray="0 100"/>

								<g class="project-journey__station is-active" data-journey-node="0" transform="translate(81 0)">
									<circle class="project-journey__station-halo" cx="0" cy="228" r="43"/>
									<circle class="project-journey__station-ring" cx="0" cy="228" r="17"/>
									<circle class="project-journey__station-center" cx="0" cy="228" r="5"/>
									<g class="project-journey__icon">
										<path d="M-33 109C-33 96-23 87-10 87H16C29 87 38 96 38 109V119C38 132 29 141 16 141H2L-12 153V141C-25 139-33 130-33 119V109Z" fill="#FFF" stroke="#9EC4CE" stroke-width="2"/>
										<path d="M-20 111H23M-20 122H10" stroke="#1689B5" stroke-width="3" stroke-linecap="round"/>
										<circle cx="29" cy="78" r="7" fill="#F2B24B"/>
										<path d="M29 65V60M29 96V91M16 78H11M47 78H42M20 69L16 65M42 91L38 87M42 69L46 65" stroke="#E89A32" stroke-width="2" stroke-linecap="round"/>
									</g>
								</g>

								<g class="project-journey__station" data-journey-node="1" transform="translate(245.5 0)">
									<circle class="project-journey__station-halo" cx="0" cy="228" r="43"/>
									<circle class="project-journey__station-ring" cx="0" cy="228" r="17"/>
									<circle class="project-journey__station-center" cx="0" cy="228" r="5"/>
									<g class="project-journey__icon">
										<rect x="-33" y="88" width="66" height="61" rx="7" fill="#FFF" stroke="#9EC4CE" stroke-width="2"/>
										<path d="M-22 100H22M-22 111H-2M-22 122H5M-22 133H-9" stroke="#C1D7DC" stroke-width="2" stroke-linecap="round"/>
										<path d="M11 126C11 115 25 105 25 105C25 105 39 115 39 126A14 14 0 0 1 11 126Z" fill="#E9F5FA" stroke="#1689B5" stroke-width="2"/>
										<circle cx="25" cy="125" r="4" fill="#1689B5"/>
										<path d="M25 130V139" stroke="#1689B5" stroke-width="2"/>
									</g>
								</g>

								<g class="project-journey__station" data-journey-node="2" transform="translate(410 0)">
									<circle class="project-journey__station-halo" cx="0" cy="228" r="43"/>
									<circle class="project-journey__station-ring" cx="0" cy="228" r="17"/>
									<circle class="project-journey__station-center" cx="0" cy="228" r="5"/>
									<g class="project-journey__icon">
										<rect x="-35" y="83" width="70" height="67" rx="7" fill="#FFF" stroke="#9EC4CE" stroke-width="2"/>
										<path d="M-22 96H22M-22 107H-8M-22 118H-1" stroke="#C1D7DC" stroke-width="2" stroke-linecap="round"/>
										<path d="M-17 136 0 125 10 130 23 113" stroke="#0785BD" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
										<circle cx="23" cy="113" r="3" fill="#0785BD"/>
										<path d="M-23 142H23" stroke="#E89A32" stroke-width="2" stroke-linecap="round"/>
									</g>
								</g>

								<g class="project-journey__station" data-journey-node="3" transform="translate(574.5 0)">
									<circle class="project-journey__station-halo" cx="0" cy="228" r="43"/>
									<circle class="project-journey__station-ring" cx="0" cy="228" r="17"/>
									<circle class="project-journey__station-center" cx="0" cy="228" r="5"/>
									<g class="project-journey__icon">
										<path d="M-37 124 0 103 37 124 29 146H-29L-37 124Z" fill="#D9EFF7" stroke="#1689B5" stroke-width="2"/>
										<path d="M-23 123 4 108M-11 145 2 110M3 145 16 117M17 145 28 124M-32 132H33M-28 140H30" stroke="#88BDCE" stroke-width="1.5"/>
										<path d="M-1 83 7 72 15 83 10 83 12 96 3 96 5 83H-1Z" fill="#E9A53D"/>
										<path d="M-3 151V160M-16 151V160M10 151V160M23 151V160" stroke="#819DA8" stroke-width="2" stroke-linecap="round"/>
									</g>
								</g>

								<g class="project-journey__station" data-journey-node="4" transform="translate(739 0)">
									<circle class="project-journey__station-halo" cx="0" cy="228" r="43"/>
									<circle class="project-journey__station-ring" cx="0" cy="228" r="17"/>
									<circle class="project-journey__station-center" cx="0" cy="228" r="5"/>
									<g class="project-journey__icon">
										<path d="M-39 112 0 82 39 112" stroke="#BE7447" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M-30 109V150H30V109" fill="#FFF" stroke="#A9C3CB" stroke-width="2"/>
										<path d="M-8 150V127A9 9 0 0 1 10 127V150" fill="#DCEBF0"/>
										<rect x="-23" y="119" width="10" height="12" rx="2" fill="#FFE2A0"/>
										<rect x="15" y="119" width="10" height="12" rx="2" fill="#FFE2A0"/>
										<path d="M-18 125H-8M20 125H30" stroke="#E5A73B" stroke-width="2"/>
										<path d="M-22 106 0 91 20 106" stroke="#0785BD" stroke-width="2" stroke-dasharray="3 4"/>
									</g>
								</g>
								<path d="M93 293H727" stroke="#C8DCD9" stroke-width="2" stroke-linecap="round"/>
								<circle cx="93" cy="293" r="3" fill="#F2B24B"/>
								<circle cx="727" cy="293" r="3" fill="#0785BD"/>
							</svg>
						</div>

						<div class="project-journey__detail" data-journey-detail aria-live="polite" aria-atomic="true">
							<span class="project-journey__step-count" data-journey-count>ÉTAPE 01 / 05</span>
							<h3 data-journey-title>Nous commençons par vous écouter.</h3>
							<p data-journey-description>Vous nous parlez de vos besoins, de votre activité et de ce que vous souhaitez alimenter. Chaque projet part de vos usages.</p>
							<a class="project-journey__cta" href="contact.php">Parlons de votre projet
								<svg viewBox="0 0 24 24" focusable="false" aria-hidden="true"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
							</a>
						</div>

						<div class="project-journey__steps" role="group" aria-label="Choisir une étape du parcours">
							<button type="button" class="project-journey__step is-active" data-journey-button="0" aria-pressed="true">
								<span>01</span><strong>Votre besoin</strong>
							</button>
							<button type="button" class="project-journey__step" data-journey-button="1" aria-pressed="false">
								<span>02</span><strong>Le site</strong>
							</button>
							<button type="button" class="project-journey__step" data-journey-button="2" aria-pressed="false">
								<span>03</span><strong>L’étude</strong>
							</button>
							<button type="button" class="project-journey__step" data-journey-button="3" aria-pressed="false">
								<span>04</span><strong>L’installation</strong>
							</button>
							<button type="button" class="project-journey__step" data-journey-button="4" aria-pressed="false">
								<span>05</span><strong>La mise en service</strong>
							</button>
						</div>
					</div>
				</section>
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
						<img src="images/realisations/solaire-panneaux-toiture-etablissement.jpeg" alt="Panneaux photovoltaïques installés sur la toiture d’un établissement" loading="lazy">
						<span class="sx-project-kw" aria-label="Puissance du projet : 100 kilowatts">100 kW</span>
						<span class="sx-project-body">
							<span class="sx-project-tag">Solaire · Santé</span>
							<span class="sx-project-name">Une centrale solaire pour un hôpital de district <span aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span></span>
						</span>
					</a>

					<a class="sx-project" href="realisationPompage.php">
						<img src="images/realisations/pompage-solaire-panneaux-03.jpeg" alt="Panneaux et équipements solaires sur un site de pompage" loading="lazy">
						<span class="sx-project-body">
							<span class="sx-project-tag">Pompage solaire</span>
							<span class="sx-project-name">L’énergie au service de l’eau <span aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg></span></span>
						</span>
					</a>

					<a class="sx-project" href="realisationLampadaire.php">
						<img src="images/realisations/eclairage-lampadaire-installation-01.jpeg" alt="Installation d’un lampadaire solaire sur le terrain" loading="lazy">
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
					<p>Quelques étapes guidées pour clarifier votre besoin et préparer un brief prêt à partager avec notre équipe.</p>
					<ol class="project-planner__steps" aria-label="Étapes du carnet de projet">
						<li><span>01</span> Précisez votre besoin</li>
						<li><span>02</span> Situez votre projet</li>
						<li><span>03</span> Partagez votre brief</li>
					</ol>
					<p class="project-planner__privacy">Vos réponses restent dans votre navigateur jusqu’à ce que vous choisissiez de les partager.</p>
				</div>

				<div class="project-planner__card">
					<form data-planner-form>
						<div class="project-planner__wizard-head">
							<div class="project-planner__wizard-status">
								<span data-planner-progress-label>Étape 1 sur 4</span>
								<span data-planner-progress-percent>25 %</span>
							</div>
							<div class="project-planner__progress-track" aria-hidden="true"><span data-planner-progress></span></div>
							<div class="project-planner__stepper" role="group" aria-label="Étapes de préparation du projet">
								<button type="button" data-planner-step-button="0" aria-current="step"><span>01</span><span>Besoin</span></button>
								<button type="button" data-planner-step-button="1"><span>02</span><span>Lieu</span></button>
								<button type="button" data-planner-step-button="2"><span>03</span><span>Priorités</span></button>
								<button type="button" data-planner-step-button="3"><span>04</span><span>Brief</span></button>
							</div>
						</div>

						<section class="project-planner__panel is-active" data-planner-panel="0" aria-labelledby="planner-step-title-0">
							<div class="project-planner__panel-heading">
								<span>01 — Le point de départ</span>
								<h3 id="planner-step-title-0">Quel projet avez-vous en tête ?</h3>
								<p>Choisissez le domaine qui se rapproche le plus de votre besoin.</p>
							</div>
							<fieldset class="project-planner__type-choices">
								<legend class="project-planner__visually-hidden">Type de projet</legend>
								<label class="project-planner__type-choice">
									<input type="radio" name="type" value="Énergie solaire" required>
									<span class="project-planner__type-choice-icon" aria-hidden="true"><svg viewBox="0 0 32 32" fill="none"><circle cx="16" cy="16" r="5" stroke="currentColor" stroke-width="1.8"/><path d="M16 2v5m0 18v5M2 16h5m18 0h5M6.1 6.1l3.5 3.5m12.8 12.8 3.5 3.5m0-19.8-3.5 3.5M9.6 22.4l-3.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
									<span><strong>Énergie solaire</strong><small>Panneaux, autonomie, stockage</small></span>
									<span class="project-planner__choice-check" aria-hidden="true"></span>
								</label>
								<label class="project-planner__type-choice">
									<input type="radio" name="type" value="Pompage solaire" required>
									<span class="project-planner__type-choice-icon" aria-hidden="true"><svg viewBox="0 0 32 32" fill="none"><path d="M16 3C16 3 7 14 7 20a9 9 0 1 0 18 0c0-6-9-17-9-17Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M12 21a4 4 0 0 0 4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
									<span><strong>Pompage solaire</strong><small>Pompe, forage, accès à l’eau</small></span>
									<span class="project-planner__choice-check" aria-hidden="true"></span>
								</label>
								<label class="project-planner__type-choice">
									<input type="radio" name="type" value="Électricité générale" required>
									<span class="project-planner__type-choice-icon" aria-hidden="true"><svg viewBox="0 0 32 32" fill="none"><path d="m18.5 2-13 17h9l-1 11 14-18h-9l.5-10Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg></span>
									<span><strong>Électricité générale</strong><small>Installation, rénovation, conformité</small></span>
									<span class="project-planner__choice-check" aria-hidden="true"></span>
								</label>
								<label class="project-planner__type-choice">
									<input type="radio" name="type" value="Éclairage solaire" required>
									<span class="project-planner__type-choice-icon" aria-hidden="true"><svg viewBox="0 0 32 32" fill="none"><path d="M11 21h10m-9 4h8m-6 4h4m-2-27a10 10 0 0 0-6 18c1.1.8 1.8 1.8 2 3h8c.2-1.2.9-2.2 2-3a10 10 0 0 0-6-18Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 6v4m-5-2 2.5 3m7.5-3-2.5 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
									<span><strong>Éclairage solaire</strong><small>Éclairage de cour, rue ou site</small></span>
									<span class="project-planner__choice-check" aria-hidden="true"></span>
								</label>
								<label class="project-planner__type-choice">
									<input type="radio" name="type" value="Autre besoin" required>
									<span class="project-planner__type-choice-icon" aria-hidden="true"><svg viewBox="0 0 32 32" fill="none"><circle cx="16" cy="16" r="12" stroke="currentColor" stroke-width="1.8"/><path d="M16 14v8m0-13v.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
									<span><strong>Autre besoin</strong><small>Parlons de votre idée</small></span>
									<span class="project-planner__choice-check" aria-hidden="true"></span>
								</label>
							</fieldset>
						</section>

						<section class="project-planner__panel" data-planner-panel="1" aria-labelledby="planner-step-title-1" hidden>
							<div class="project-planner__panel-heading">
								<span>02 — Le lieu et le moment</span>
								<h3 id="planner-step-title-1">Où en est votre projet ?</h3>
								<p>Ces repères nous aident à comprendre le contexte de votre demande.</p>
							</div>
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
							<div class="project-planner__tip"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/><path d="M12 11v5m0-8v.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg> Une localisation approximative suffit pour commencer.</div>
						</section>

						<section class="project-planner__panel" data-planner-panel="2" aria-labelledby="planner-step-title-2" hidden>
							<div class="project-planner__panel-heading">
								<span>03 — Ce qui compte pour vous</span>
								<h3 id="planner-step-title-2">Quelles sont vos priorités ?</h3>
								<p>Plusieurs réponses possibles. Vous pouvez aussi ajouter un détail utile.</p>
							</div>
							<fieldset class="project-planner__priorities">
								<legend class="project-planner__visually-hidden">Priorités du projet</legend>
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
						</section>

						<div class="project-planner__wizard-navigation" data-planner-navigation>
							<button type="button" class="project-planner__back" data-planner-back disabled>
								<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m7 7-7-7 7-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
								Précédent
							</button>
							<button type="button" class="project-planner__next" data-planner-next>
								Continuer
								<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-7-7 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</button>
						</div>

						<div class="project-planner__preview project-planner__panel" data-planner-panel="3" aria-labelledby="planner-preview-title" hidden>
							<div class="project-planner__preview-head">
								<span class="project-planner__preview-icon" aria-hidden="true">
									<svg viewBox="0 0 24 24" fill="none"><path d="M7 3h7l5 5v13H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M14 3v5h5M9 13h6M9 17h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
								</span>
								<div><h3 id="planner-preview-title">Votre brief est prêt.</h3><p>Relisez-le, puis choisissez comment le partager.</p></div>
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