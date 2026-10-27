<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
	<title>SEAT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Capitalist Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	<!-- Favicon -->
	<link rel="shortcut icon" href="images/logo.jpg">

	<!-- font files -->
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<!-- /font files -->
	<!-- css files -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/jQuery.lightninBox.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/pogo-slider.min.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/site-header.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/pages.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/services-motion.css?v=1" type="text/css" media="all">
	<link rel="stylesheet" href="css/service-cards.css?v=2" type="text/css" media="all">
	<!-- /css files -->
	<!-- js files -->
	<script src="js/modernizr.custom.js"></script>
	<!-- /js files -->
<?php require __DIR__ . '/includes/site-fonts.php'; ?>
</head>
<body>
<?php require __DIR__ . '/includes/header.php'; ?>

<?php require __DIR__ . '/includes/page-intro.php'; ?>

<?php
// Réglages du simulateur (à ajuster avec SEAT Opus Global)
$energy_whatsapp   = '';          // ex. '23566000000' (indicatif + numéro, sans « + »). Vide = renvoi vers la page contact
$energy_fuel_price = 750;         // prix du gasoil en FCFA par litre (hypothèse à valider)
$energy_contact    = 'contact.php';
?>
<section class="energy-scene" id="energie" data-energy-scene
	data-wa="<?= htmlspecialchars($energy_whatsapp, ENT_QUOTES) ?>"
	data-fuel-price="<?= (int) $energy_fuel_price ?>"
	data-contact="<?= htmlspecialchars($energy_contact, ENT_QUOTES) ?>"
	aria-labelledby="energy-scene-title">
	<div class="energy-scene__inner">
		<div class="energy-scene__heading">
			<p class="energy-scene__eyebrow"><span aria-hidden="true"></span> Comprendre l’énergie en mouvement</p>
			<h2 id="energy-scene-title">Du soleil<br><em>à vos usages.</em></h2>
			<p>Suivez une journée solaire et découvrez comment l’énergie circule entre les panneaux, le stockage et les équipements.</p>

			<!-- Indicateurs : pilotés en CSS par data-phase, aucun JS requis -->
			<ul class="energy-scene__metrics" aria-hidden="true">
				<li class="energy-scene__metric energy-scene__metric--solar">
					<span class="energy-scene__metric-name">Production</span>
					<span class="energy-scene__metric-bar"><i></i></span>
				</li>
				<li class="energy-scene__metric energy-scene__metric--battery">
					<span class="energy-scene__metric-name">Stockage</span>
					<span class="energy-scene__metric-bar"><i></i></span>
				</li>
				<li class="energy-scene__metric energy-scene__metric--home">
					<span class="energy-scene__metric-name">Consommation</span>
					<span class="energy-scene__metric-bar"><i></i></span>
				</li>
			</ul>

			<p class="energy-scene__note">Animation pédagogique : les flux illustrent le principe d’une installation, pas les mesures d’un site réel.</p>
		</div>

		<div class="energy-scene__stage">
			<div class="energy-scene__tabs" role="tablist" aria-label="Type d’installation">
				<button type="button" role="tab" class="energy-scene__tab" data-energy-scenario="home" aria-selected="true">Maison</button>
				<button type="button" role="tab" class="energy-scene__tab" data-energy-scenario="pump" aria-selected="false" tabindex="-1">Pompage agricole</button>
				<button type="button" role="tab" class="energy-scene__tab" data-energy-scenario="shop" aria-selected="false" tabindex="-1">Commerce &amp; froid</button>
			</div>
			<div class="energy-scene__sky">
				<div class="energy-scene__sky-glow" aria-hidden="true"></div>
				<div class="energy-scene__cloud energy-scene__cloud--one" aria-hidden="true"></div>
				<div class="energy-scene__cloud energy-scene__cloud--two" aria-hidden="true"></div>
				<div class="energy-scene__cloud energy-scene__cloud--three" aria-hidden="true"></div>
				<div class="energy-scene__cloud energy-scene__cloud--four" aria-hidden="true"></div>
				<svg class="energy-scene__drawing" viewBox="0 0 960 520" role="img" aria-labelledby="energy-svg-title energy-svg-desc">
					<title id="energy-svg-title">Animation du trajet de l’énergie solaire</title>
					<desc id="energy-svg-desc">Le soleil suit sa course au-dessus des panneaux. Des lignes animées montrent l’énergie qui rejoint le convertisseur, la batterie et une maison.</desc>
					<defs>
						<linearGradient id="energy-ground" x1="0" x2="1" y1="0" y2="1">
							<stop offset="0" stop-color="#e3f3ea"/>
							<stop offset="1" stop-color="#b4d8cd"/>
						</linearGradient>
						<linearGradient id="energy-ground-2" x1="0" x2="0" y1="0" y2="1">
							<stop offset="0" stop-color="#a7cfc2"/>
							<stop offset="1" stop-color="#8fbfb0"/>
						</linearGradient>
						<linearGradient id="energy-panel" x1="0" x2="1" y1="0" y2="1">
							<stop offset="0" stop-color="#1b8cc0"/>
							<stop offset=".55" stop-color="#124a6d"/>
							<stop offset="1" stop-color="#0d3550"/>
						</linearGradient>
						<linearGradient id="energy-house" x1="0" x2="0" y1="0" y2="1">
							<stop offset="0" stop-color="#fff"/>
							<stop offset="1" stop-color="#e8f2f4"/>
						</linearGradient>
						<linearGradient id="energy-roof" x1="0" x2="0" y1="0" y2="1">
							<stop offset="0" stop-color="#e29458"/>
							<stop offset="1" stop-color="#c76f3b"/>
						</linearGradient>
						<linearGradient id="energy-shine" x1="0" x2="1" y1="0" y2="0">
							<stop offset="0" stop-color="#fff" stop-opacity="0"/>
							<stop offset=".5" stop-color="#fff" stop-opacity=".5"/>
							<stop offset="1" stop-color="#fff" stop-opacity="0"/>
						</linearGradient>
						<radialGradient id="energy-sun-glow">
							<stop offset="0" stop-color="#fff2b8" stop-opacity=".9"/>
							<stop offset=".45" stop-color="#ffd56a" stop-opacity=".28"/>
							<stop offset="1" stop-color="#ffd56a" stop-opacity="0"/>
						</radialGradient>
						<radialGradient id="energy-ground-shadow">
							<stop offset="0" stop-color="#16394a" stop-opacity=".22"/>
							<stop offset="1" stop-color="#16394a" stop-opacity="0"/>
						</radialGradient>
						<clipPath id="energy-panel-clip"><path d="m82 322 237-10 45 98-254 8Z"/></clipPath>
					</defs>

					<!-- Étoiles (visibles la nuit) -->
					<g class="energy-scene__stars" aria-hidden="true">
						<circle cx="120" cy="70" r="1.8"/><circle cx="230" cy="130" r="1.3"/>
						<circle cx="340" cy="52" r="2"/><circle cx="470" cy="108" r="1.4"/>
						<circle cx="590" cy="60" r="1.8"/><circle cx="700" cy="140" r="1.3"/>
						<circle cx="820" cy="80" r="2"/><circle cx="905" cy="150" r="1.4"/>
						<circle cx="60" cy="170" r="1.4"/><circle cx="640" cy="190" r="1.2"/>
					</g>

					<path class="energy-scene__sun-path" d="M83 303C228 40 707 34 874 300"/>
					<g class="energy-scene__sun" data-energy-sun transform="translate(83 303)">
						<circle class="energy-scene__sun-aura" r="120" fill="url(#energy-sun-glow)"/>
						<circle class="energy-scene__sun-halo" r="49"/>
						<circle class="energy-scene__sun-core" r="24"/>
						<path class="energy-scene__sun-rays" d="M0-39v-12m0 102v12m39-51h12m-102 0h12m66-27 9-9m-72 72 9-9m54 0 9 9m-72-72 9 9"/>
					</g>
					<path class="energy-scene__sunbeam" d="M360 195 285 322"/>
					<path class="energy-scene__sunbeam" d="M408 204 333 330"/>

					<!-- Décor : collines, arbres -->
					<g class="energy-scene__ground">
						<path d="M0 385c134-48 227-26 344 2 128 31 230-36 363-20 87 10 166 49 253 24v129H0Z" fill="url(#energy-ground)"/>
						<path d="M0 421c166-33 264 9 390 19 136 11 262-37 400-14 70 12 116 29 170 28v66H0Z" fill="url(#energy-ground-2)" opacity=".8"/>
						<ellipse cx="228" cy="452" rx="150" ry="14" fill="url(#energy-ground-shadow)"/>
						<ellipse cx="725" cy="440" rx="120" ry="12" fill="url(#energy-ground-shadow)"/>
						<g class="energy-scene__tree" transform="translate(898 392)">
							<path d="M0 0v34" stroke="#7a5b45" stroke-width="5" stroke-linecap="round"/>
							<circle cy="-8" r="19" fill="#8fc1a9"/><circle cx="-12" cy="3" r="13" fill="#9ccdb6"/><circle cx="12" cy="4" r="12" fill="#86b9a2"/>
						</g>
						<g class="energy-scene__tree" transform="translate(40 410) scale(.8)">
							<path d="M0 0v34" stroke="#7a5b45" stroke-width="5" stroke-linecap="round"/>
							<circle cy="-8" r="19" fill="#8fc1a9"/><circle cx="-12" cy="3" r="13" fill="#9ccdb6"/><circle cx="12" cy="4" r="12" fill="#86b9a2"/>
						</g>
					</g>

					<g class="energy-scene__panel energy-scene__part" data-energy-part="panels" role="button" tabindex="0" aria-label="Panneaux solaires : afficher l’explication">
						<path d="m82 322 237-10 45 98-254 8Z" fill="url(#energy-panel)" stroke="#fff" stroke-opacity=".85" stroke-width="3"/>
						<path d="m106 320 39 94m33-96 37 95m32-97 35 96m31-97 34 96M95 350l273-10m-259 39 275-10" fill="none" stroke="#a8d9ee" stroke-opacity=".55" stroke-width="1.6"/>
						<g clip-path="url(#energy-panel-clip)">
							<rect class="energy-scene__shine" x="40" y="300" width="70" height="140" fill="url(#energy-shine)" transform="skewX(-18)"/>
						</g>
						<path d="m184 418-10 26m108-28 8 25m-129 0h153" fill="none" stroke="#526f7b" stroke-linecap="round" stroke-width="7"/>
					</g>

					<path class="energy-scene__wire energy-scene__wire--solar" d="M330 367h65v-62h55"/>
					<path class="energy-scene__wire energy-scene__wire--battery" d="M505 305h50v120h52"/>
					<path class="energy-scene__wire energy-scene__wire--home" d="M505 305h68v14h40"/>
					<path class="energy-scene__pulse energy-scene__pulse--solar" d="M330 367h65v-62h55"/>
					<path class="energy-scene__pulse energy-scene__pulse--battery" data-energy-pulse-battery d="M505 305h50v120h52"/>
					<path class="energy-scene__pulse energy-scene__pulse--home" data-energy-pulse-home d="M505 305h68v14h40"/>

					<g class="energy-scene__inverter energy-scene__part" data-energy-part="inverter" role="button" tabindex="0" aria-label="Convertisseur : afficher l’explication">
						<rect x="447" y="258" width="60" height="94" rx="12" fill="#fff" stroke="#c5d8df" stroke-width="2"/>
						<rect x="457" y="270" width="40" height="24" rx="6" fill="#e8f5f8"/>
						<path d="M462 282h7l4-6 6 12 4-6h7" fill="none" stroke="#0785bd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3"/>
						<circle class="energy-scene__inverter-light" cx="477" cy="315" r="5"/>
						<path d="M462 335h30" stroke="#a8bbc3" stroke-linecap="round" stroke-width="3"/>
					</g>

					<g class="energy-scene__battery energy-scene__part" data-energy-part="battery" role="button" tabindex="0" aria-label="Batterie : afficher l’explication">
						<rect x="610" y="379" width="73" height="91" rx="11" fill="#f9fcfd" stroke="#bdcfd6" stroke-width="2"/>
						<path d="M633 373h27v6h-27z" fill="#69828d"/>
						<rect class="energy-scene__battery-fill" data-energy-battery-fill x="620" y="390" width="53" height="70" rx="6"/>
						<path d="M652 403 638 427h10l-5 17 17-26h-11z" fill="#fff" opacity=".9"/>
						<circle class="energy-scene__battery-light" cx="646" cy="481" r="4"/>
					</g>

					<g class="energy-scene__home energy-scene__part" data-energy-part="home" role="button" tabindex="0" aria-label="Équipements : afficher l’explication">
						<path d="m622 305 95-73 95 73" fill="url(#energy-roof)" stroke="#a95e37" stroke-linejoin="round" stroke-width="9"/>
						<rect x="768" y="238" width="18" height="40" rx="2" fill="#b9714a"/>
						<path d="M641 300v119h152V300l-76-59Z" fill="url(#energy-house)" stroke="#d6e1e3" stroke-width="2"/>
						<path d="M696 419v-59a22 22 0 0 1 44 0v59" fill="#b8ced3"/>
						<circle cx="730" cy="394" r="2.5" fill="#6f8c96"/>
						<circle class="energy-scene__attic" cx="717" cy="285" r="10" fill="#c3e4ed" stroke="#fff" stroke-width="3"/>
						<rect class="energy-scene__window" x="657" y="324" width="27" height="27" rx="3"/>
						<path d="M670.5 324v27m-13.5-13.5h27" stroke="#fff" stroke-opacity=".9" stroke-width="2"/>
						<rect class="energy-scene__window" x="751" y="324" width="27" height="27" rx="3"/>
						<path d="M764.5 324v27m-13.5-13.5h27" stroke="#fff" stroke-opacity=".9" stroke-width="2"/>
						<path d="M671 430h94" stroke="#b8ced3" stroke-linecap="round" stroke-width="4"/>
					</g>


					<!-- Scénario : pompage agricole -->
					<g class="energy-scene__pump energy-scene__part" data-energy-part="home" role="button" tabindex="0" aria-label="Pompe solaire : afficher l’explication">
						<path d="M613 319v62h24" fill="none" stroke="#8aa1ab" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
						<path d="m626 380 36-26 36 26" fill="#d7824a" stroke="#a95e37" stroke-linejoin="round" stroke-width="7"/>
						<rect x="636" y="380" width="52" height="39" rx="3" fill="url(#energy-house)" stroke="#d6e1e3" stroke-width="2"/>
						<circle cx="662" cy="400" r="9" fill="#e8f5f8" stroke="#0785bd" stroke-width="2.5"/>
						<path d="M662 394v12m-6-6h12" stroke="#0785bd" stroke-linecap="round" stroke-width="2"/>
						<path d="M730 419l-12-92m70 92 12-92" fill="none" stroke="#526f7b" stroke-linecap="round" stroke-width="6"/>
						<rect x="708" y="262" width="84" height="68" rx="12" fill="#eaf6fa" stroke="#bdcfd6" stroke-width="2"/>
						<rect class="energy-scene__tank-fill" data-energy-tank-fill x="713" y="324" width="74" height="0" rx="7"/>
						<path class="energy-scene__water" d="M688 402h42v-70"/>
						<path d="M688 402h42v-70" fill="none" stroke="#8aa1ab" stroke-linecap="round" stroke-linejoin="round" stroke-opacity=".5" stroke-width="5"/>
						<path d="M818 419v-18m-6 8 6-8m6 8-6-8m36 18v-22m-7 10 7-10m7 10-7-10m36 22v-16m-6 7 6-7m6 7-6-7" fill="none" stroke="#6faa84" stroke-linecap="round" stroke-width="3"/>
						<path d="M792 428h96" stroke="#b8ced3" stroke-linecap="round" stroke-width="4"/>
					</g>

					<!-- Scénario : commerce &amp; froid solaire -->
					<g class="energy-scene__shop energy-scene__part" data-energy-part="home" role="button" tabindex="0" aria-label="Commerce et froid solaire : afficher l’explication">
						<path d="M641 300h152v119H641Z" fill="url(#energy-house)" stroke="#d6e1e3" stroke-width="2"/>
						<path d="M630 298h174l-10 32H640Z" fill="#e68a36"/>
						<path d="M660 300l-3 30m33-30-1 30m33-30v30m33-30 1 30m33-30 3 30" stroke="#fff" stroke-opacity=".55" stroke-width="9"/>
						<rect x="690" y="270" width="64" height="20" rx="10" fill="#0785bd"/>
						<path d="M722 274v12m-6-9 12 6m0-6-12 6" stroke="#fff" stroke-linecap="round" stroke-width="1.6"/>
						<rect class="energy-scene__window" x="655" y="342" width="76" height="62" rx="4"/>
						<rect x="679" y="350" width="28" height="48" rx="3" fill="#fff" stroke="#9fc3d0" stroke-width="2"/>
						<path d="M679 372h28m-4-12v6m0 14v8" stroke="#9fc3d0" stroke-linecap="round" stroke-width="2"/>
						<rect x="748" y="350" width="34" height="69" rx="3" fill="#b8ced3"/>
						<circle cx="774" cy="388" r="2.5" fill="#6f8c96"/>
						<path d="M671 430h94" stroke="#b8ced3" stroke-linecap="round" stroke-width="4"/>
					</g>

					<g class="energy-scene__label" aria-hidden="true">
						<rect x="98" y="458" width="175" height="34" rx="17"/>
						<text x="185" y="480" text-anchor="middle">PANNEAUX SOLAIRES</text>
						<rect x="414" y="369" width="126" height="30" rx="15"/>
						<text x="477" y="389" text-anchor="middle">CONVERTISSEUR</text>
						<rect x="595" y="481" width="103" height="30" rx="15"/>
						<text x="646" y="501" text-anchor="middle">BATTERIE</text>
						<rect x="680" y="432" width="104" height="30" rx="15"/>
						<text x="732" y="452" text-anchor="middle" data-energy-equip-label>ÉQUIPEMENTS</text>
					</g>
				</svg>
				<div class="energy-scene__daylight" aria-hidden="true"><span data-energy-daylight></span></div>
				<div class="energy-scene__veil" aria-hidden="true"></div>
				<div class="energy-scene__info" data-energy-info hidden>
					<button type="button" class="energy-scene__info-close" data-energy-info-close aria-label="Fermer l’explication">&times;</button>
					<strong data-energy-info-title></strong>
					<p data-energy-info-text></p>
				</div>
			</div>

			<div class="energy-scene__controls">
				<div class="energy-scene__time-row">
					<div class="energy-scene__time-readout">
						<span data-energy-time>12:00</span>
						<span class="energy-scene__state" data-energy-state aria-live="polite">Le soleil alimente la maison et recharge la batterie.</span>
					</div>
					<button class="energy-scene__play" type="button" data-energy-play aria-pressed="false" aria-label="Lancer l’animation du soleil">
						<svg class="energy-scene__play-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m8 5 12 7-12 7z"/></svg>
						<svg class="energy-scene__pause-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 5h4v14H7zm7 0h4v14h-4z"/></svg>
						<span data-energy-play-label>Lancer la journée</span>
					</button>
				</div>
				<label class="energy-scene__range-label" for="energy-time">Faire avancer le soleil</label>
				<input class="energy-scene__range" id="energy-time" type="range" min="6" max="18" step="0.25" value="12" data-energy-range aria-valuetext="12 heures">
				<div class="energy-scene__range-ends" aria-hidden="true"><span>6 h · lever</span><span>12 h · midi</span><span>18 h · coucher</span></div>
				<fieldset class="energy-scene__weather">
					<legend>Météo</legend>
					<span class="energy-scene__seg">
						<label><input type="radio" name="energy-weather" value="clear" checked><span>Ciel dégagé</span></label>
						<label><input type="radio" name="energy-weather" value="variable"><span>Passages nuageux</span></label>
						<label><input type="radio" name="energy-weather" value="overcast"><span>Couvert</span></label>
					</span>
				</fieldset>
				<p class="energy-scene__legend"><span><i aria-hidden="true"></i> Production solaire</span><span><i aria-hidden="true"></i> Énergie stockée puis utilisée</span><span class="energy-scene__hint">Touchez un élément du schéma pour comprendre son rôle</span></p>
			</div>

			<div class="energy-scene__stats" aria-hidden="true">
				<div class="energy-scene__stat energy-scene__stat--solar">
					<span class="energy-scene__stat-label">Puissance solaire</span>
					<span class="energy-scene__stat-value"><b data-energy-kw>0,0</b><small>kW</small></span>
				</div>
				<div class="energy-scene__stat energy-scene__stat--solar">
					<span class="energy-scene__stat-label">Produit aujourd’hui</span>
					<span class="energy-scene__stat-value"><b data-energy-kwh>0,0</b><small>kWh</small></span>
				</div>
				<div class="energy-scene__stat">
					<span class="energy-scene__stat-label">Consommation</span>
					<span class="energy-scene__stat-value"><b data-energy-load>0,0</b><small>kW</small></span>
				</div>
				<div class="energy-scene__stat energy-scene__stat--battery">
					<span class="energy-scene__stat-label">Batterie</span>
					<span class="energy-scene__stat-value"><b data-energy-soc>0</b><small>%</small></span>
				</div>
			</div>

			<div class="energy-scene__chart">
				<div class="energy-scene__chart-head"><span>Production, consommation et batterie</span><span>Touchez le graphique pour changer l’heure</span></div>
				<svg data-energy-chart viewBox="0 0 600 140" role="img" aria-label="Courbes de production solaire, de consommation et de niveau de batterie de 6 h à 18 h"></svg>
				<p class="energy-scene__chart-legend"><span><i style="background:#e68a36"></i> Production (kW)</span><span><i style="background:#0785bd"></i> Consommation (kW)</span><span><i style="background:#4fbf8b"></i> Batterie (%)</span></p>
			</div>
		</div>
	</div>

	<div class="energy-scene__lab" data-energy-lab>
		<div class="energy-scene__lab-head">
			<p class="energy-scene__eyebrow"><span aria-hidden="true"></span> Simulateur de dimensionnement</p>
			<h3>Quel équipement pour <em>vos besoins ?</em></h3>
			<p>Choisissez ce que vous voulez alimenter : la scène, la courbe et les chiffres se recalculent instantanément.</p>
		</div>
		<div class="energy-scene__lab-grid">
			<fieldset class="energy-scene__appliances" data-energy-appliances>
				<legend class="sr-only">Équipements à alimenter</legend>
			</fieldset>
			<div class="energy-scene__results">
				<div class="energy-scene__res-grid">
					<div class="energy-scene__res"><span>Consommation</span><b data-energy-res="daily">—</b><small data-energy-res-sub="daily"></small></div>
					<div class="energy-scene__res"><span>Panneaux solaires</span><b data-energy-res="panels">—</b><small data-energy-res-sub="panels"></small></div>
					<div class="energy-scene__res"><span>Batterie</span><b data-energy-res="battery">—</b><small data-energy-res-sub="battery"></small></div>
					<div class="energy-scene__res"><span>Convertisseur</span><b data-energy-res="inverter">—</b><small data-energy-res-sub="inverter"></small></div>
					<div class="energy-scene__res"><span>Autonomie sans soleil</span><b data-energy-res="autonomy">—</b><small data-energy-res-sub="autonomy"></small></div>
				</div>
				<div class="energy-scene__savings">
					<div><span>Économie estimée</span><b data-energy-sav="money">—</b><small>par mois</small></div>
					<div><span>Gasoil évité</span><b data-energy-sav="fuel">—</b><small>par mois</small></div>
					<div><span>CO₂ évité</span><b data-energy-sav="co2">—</b><small>par mois</small></div>
				</div>
				<p class="energy-scene__assumptions" data-energy-assumptions></p>
				<div class="energy-scene__cta">
					<button type="button" class="energy-scene__btn energy-scene__btn--primary" data-energy-quote>Demander un devis</button>
					<button type="button" class="energy-scene__btn energy-scene__btn--ghost" data-energy-share>Copier le lien de cette simulation</button>
				</div>
			</div>
		</div>
		<p class="sr-only" aria-live="polite" data-energy-sr></p>
	</div>
</section>

<!-- services section -->
<section class="service-w3ls svc-section" aria-labelledby="svc-title">
	<div class="svc-shell">
		<div class="svc-heading">
			<p class="svc-eyebrow"><span aria-hidden="true"></span> Notre savoir-faire</p>
			<h2 id="svc-title">Des solutions utiles,<br><em>de l’idée au terrain.</em></h2>
			<p class="svc-intro">De l’étude à la mise en service, nous vous accompagnons avec des solutions électriques et solaires adaptées à vos besoins.</p>
		</div>

		<div class="svc-grid">
			<article class="svc-card" data-service-card="electricity">
				<div class="svc-card__top">
					<span class="svc-icon" aria-hidden="true">
						<svg viewBox="0 0 48 48" fill="none"><path d="M24 5v38M5 24h38M10.6 10.6l26.8 26.8m0-26.8L10.6 37.4" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/><circle cx="24" cy="24" r="8" fill="currentColor" opacity=".16"/><circle cx="24" cy="24" r="4" fill="currentColor"/></svg>
					</span>
					<span class="svc-number">01</span>
				</div>
				<span class="svc-recommendation" data-service-match hidden>Conseillé pour votre projet</span>
				<h3>Électricité générale</h3>
				<p>Des installations fiables et conformes, entretenues par une équipe à votre écoute.</p>
				<ul><li>Conception et réalisation</li><li>Dépannage et mise en conformité</li></ul>
			</article>

			<article class="svc-card svc-card--featured" data-service-card="renewable">
				<div class="svc-card__top">
					<span class="svc-icon" aria-hidden="true">
						<svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="8" stroke="currentColor" stroke-width="2.5"/><path d="M24 4v6m0 28v6M4 24h6m28 0h6M9.9 9.9l4.2 4.2m19.8 19.8 4.2 4.2m0-28.2-4.2 4.2m-19.8 19.8-4.2 4.2" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
					</span>
					<span class="svc-number">02</span>
				</div>
				<span class="svc-recommendation" data-service-match hidden>Conseillé pour votre projet</span>
				<p class="svc-card__tag">Énergie solaire</p>
				<h3>Énergies renouvelables</h3>
				<p>Produisez une énergie durable grâce à des équipements solaires pensés pour votre quotidien.</p>
				<ul><li>Solaire photovoltaïque</li><li>Solutions autonomes et efficaces</li></ul>
			</article>

			<article class="svc-card" data-service-card="studies">
				<div class="svc-card__top">
					<span class="svc-icon" aria-hidden="true">
						<svg viewBox="0 0 48 48" fill="none"><path d="M8 39V13l16-7 16 7v26M5 39h38M17 39V27h14v12M14 17h4m12 0h4m-20 6h4m12 0h4" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</span>
					<span class="svc-number">03</span>
				</div>
				<span class="svc-recommendation" data-service-match hidden>Conseillé pour votre projet</span>
				<h3>Études &amp; conception</h3>
				<p>Nous étudions votre projet pour définir une solution adaptée à votre site et à vos usages.</p>
				<ul><li>Conseil technique</li><li>Dimensionnement des équipements</li></ul>
			</article>

			<article class="svc-card" data-service-card="logistics">
				<div class="svc-card__top">
					<span class="svc-icon" aria-hidden="true">
						<svg viewBox="0 0 48 48" fill="none"><path d="M7 16h34v25H7zM4 11h40v7H4zM18 11V6h12v5m-6 7v6m-5-3h10" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</span>
					<span class="svc-number">04</span>
				</div>
				<span class="svc-recommendation" data-service-match hidden>Conseillé pour votre projet</span>
				<h3>Logistique &amp; fournitures</h3>
				<p>Un appui matériel et logistique pour faciliter la réalisation de vos projets.</p>
				<ul><li>Approvisionnement en équipements</li><li>Appui aux projets et organisations</li></ul>
			</article>

			<article class="svc-card" data-service-card="installation">
				<div class="svc-card__top">
					<span class="svc-icon" aria-hidden="true">
						<svg viewBox="0 0 48 48" fill="none"><path d="M6 22 24 8l18 14M11 20v21h26V20M20 41V28h8v13M17 18l14-4" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/><path d="m22 13-2 5h4l-2 5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</span>
					<span class="svc-number">05</span>
				</div>
				<span class="svc-recommendation" data-service-match hidden>Conseillé pour votre projet</span>
				<h3>Installation solaire</h3>
				<p>Des installations réalisées avec soin, de la pose des panneaux à la mise en service.</p>
				<ul><li>Kits et panneaux photovoltaïques</li><li>Pompage et froid solaires</li></ul>
			</article>

			<article class="svc-card" data-service-card="equipment">
				<div class="svc-card__top">
					<span class="svc-icon" aria-hidden="true">
						<svg viewBox="0 0 48 48" fill="none"><path d="M6 17h36v24H6zM4 10h40v8H4zM12 10l4 7m8-7v7m8-7-4 7M14 25v8m-4-4h8m10-4 8 8m0-8-8 8" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</span>
					<span class="svc-number">06</span>
				</div>
				<span class="svc-recommendation" data-service-match hidden>Conseillé pour votre projet</span>
				<h3>Matériel électrique</h3>
				<p>Un choix d’équipements pour vos installations, avec conseil et garantie.</p>
				<ul><li>Lampes, lampadaires et convertisseurs</li><li>Chargeurs et régulateurs</li></ul>
			</article>
		</div>

		<div class="svc-planner" data-service-planner>
			<div class="svc-planner__intro">
				<p class="svc-eyebrow"><span aria-hidden="true"></span> Votre projet, en quelques clics</p>
				<h3>Par où commencer ?</h3>
				<p>Choisissez votre situation et votre priorité : nous vous indiquons les services à explorer.</p>
			</div>
			<div class="svc-planner__controls">
				<fieldset class="svc-choice-group">
					<legend><span>01</span> Quel est votre projet ?</legend>
					<div class="svc-choice-list">
						<button type="button" data-planner-place="home" aria-pressed="true">Maison / logement</button>
						<button type="button" data-planner-place="business" aria-pressed="false">Commerce / entreprise</button>
						<button type="button" data-planner-place="farm" aria-pressed="false">Agriculture</button>
					</div>
				</fieldset>
				<fieldset class="svc-choice-group">
					<legend><span>02</span> Quel est votre besoin principal ?</legend>
					<div class="svc-choice-list svc-choice-list--needs">
						<button type="button" data-planner-need="solar" aria-pressed="true">Énergie solaire</button>
						<button type="button" data-planner-need="pump" aria-pressed="false">Pompage d’eau</button>
						<button type="button" data-planner-need="electricity" aria-pressed="false">Installation électrique</button>
						<button type="button" data-planner-need="cold" aria-pressed="false">Froid / conservation</button>
					</div>
				</fieldset>
			</div>
			<div class="svc-planner__result" aria-live="polite">
				<div class="svc-planner__result-head">
					<div>
						<p class="svc-planner__result-label">Votre première piste</p>
						<h4 data-planner-title>Une solution solaire pour votre logement</h4>
					</div>
				</div>
				<p class="svc-planner__result-copy" data-planner-description>Nous pouvons étudier une installation photovoltaïque adaptée à vos usages, avec les équipements de stockage nécessaires selon votre besoin.</p>
				<div class="svc-planner__steps" data-planner-services aria-label="Services à explorer">
					<span><b>1</b><span>Études &amp; conception</span></span>
					<span><b>2</b><span>Énergies renouvelables</span></span>
					<span><b>3</b><span>Installation solaire</span></span>
				</div>
				<div class="svc-planner__result-foot">
					<p>Orientation indicative, sans calcul de puissance. Le dimensionnement se fait après étude de votre site et de vos équipements.</p>
					<a href="contact.php?project_type=%C3%89nergie%20solaire&amp;details=Je%20souhaite%20une%20%C3%A9tude%20pour%20une%20solution%20solaire%20adapt%C3%A9e%20%C3%A0%20mon%20projet." data-planner-contact>Parler de ce projet <span aria-hidden="true">↗</span></a>
				</div>
			</div>
		</div>

		<div class="svc-cta">
			<div><span>Un projet en tête ?</span><p>Parlons ensemble de la solution adaptée à votre besoin.</p></div>
			<a href="contact.php">Échanger avec notre équipe <span aria-hidden="true">↗</span></a>
		</div>
	</div>
</section>
<!-- /services section -->

<?php require __DIR__ . '/includes/site-footer.php'; ?>
<a href="#" class="cd-top">Top</a>
<!-- js files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/top.js"></script>
<script src="js/jQuery.lightninBox.js"></script>
<script type="text/javascript">
	$(".lightninBox").lightninBox();
</script>
<script>
	$(document).ready(function(){
		// Add smooth scrolling to all links in navbar + footer link
		$(".navbar li a").on('click', function(event) {

			// Make sure this.hash has a value before overriding default behavior
			if (this.hash !== "") {

				// Store hash
				var hash = this.hash;

				// Using jQuery's animate() method to add smooth page scroll
				// The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
				$('html, body').animate({
					scrollTop: $(hash).offset().top
				}, 900, function(){

					// Add hash (#) to URL when done scrolling (default click behavior)
					window.location.hash = hash;
				});
			} // End if
		});
	})
</script>
<script>
	$(window).scroll(function() {
		$(".slideanim").each(function(){
			var pos = $(this).offset().top;

			var winTop = $(window).scrollTop();
			if (pos < winTop + 600) {
				$(this).addClass("slide");
			}
		});
	});
</script>
<script src="js/jquery.pogo-slider.min.js"></script>
<script src="js/main.js"></script>
<script src="js/services-motion.js?v=1" defer></script>
<script src="js/service-configurator.js?v=1" defer></script>
<!-- /js files -->
</body>
</html>