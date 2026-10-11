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
	<!-- /css files -->
	<!-- js files -->
	<script src="js/modernizr.custom.js"></script>
	<!-- /js files -->
<?php require __DIR__ . '/includes/site-fonts.php'; ?>
</head>
<body>
<?php require __DIR__ . '/includes/header.php'; ?>

<?php require __DIR__ . '/includes/page-intro.php'; ?>

<section class="energy-scene" data-energy-scene aria-labelledby="energy-scene-title">
	<div class="energy-scene__inner">
		<div class="energy-scene__heading">
			<p class="energy-scene__eyebrow"><span aria-hidden="true"></span> Comprendre l’énergie en mouvement</p>
			<h2 id="energy-scene-title">Du soleil<br><em>à vos usages.</em></h2>
			<p>Suivez une journée solaire et découvrez comment l’énergie circule entre les panneaux, le stockage et les équipements.</p>
			<p class="energy-scene__note">Animation pédagogique : les flux illustrent le principe d’une installation, pas les mesures d’un site réel.</p>
		</div>

		<div class="energy-scene__stage">
			<div class="energy-scene__sky">
				<div class="energy-scene__sky-glow" aria-hidden="true"></div>
				<div class="energy-scene__cloud energy-scene__cloud--one" aria-hidden="true"></div>
				<div class="energy-scene__cloud energy-scene__cloud--two" aria-hidden="true"></div>
				<svg class="energy-scene__drawing" viewBox="0 0 960 520" role="img" aria-labelledby="energy-svg-title energy-svg-desc">
					<title id="energy-svg-title">Animation du trajet de l’énergie solaire</title>
					<desc id="energy-svg-desc">Le soleil suit sa course au-dessus des panneaux. Des lignes animées montrent l’énergie qui rejoint le convertisseur, la batterie et une maison.</desc>
					<defs>
						<linearGradient id="energy-ground" x1="0" x2="1" y1="0" y2="1">
							<stop offset="0" stop-color="#dff1e9"/>
							<stop offset="1" stop-color="#b4d8cd"/>
						</linearGradient>
						<linearGradient id="energy-panel" x1="0" x2="1" y1="0" y2="1">
							<stop offset="0" stop-color="#167cab"/>
							<stop offset="1" stop-color="#103b59"/>
						</linearGradient>
						<linearGradient id="energy-house" x1="0" x2="0" y1="0" y2="1">
							<stop offset="0" stop-color="#fff"/>
							<stop offset="1" stop-color="#eaf4f5"/>
						</linearGradient>
					</defs>
					<path class="energy-scene__sun-path" d="M83 303C228 40 707 34 874 300"/>
					<g class="energy-scene__sun" data-energy-sun transform="translate(83 303)">
						<circle class="energy-scene__sun-halo" r="49"/>
						<circle class="energy-scene__sun-core" r="24"/>
						<path class="energy-scene__sun-rays" d="M0-39v-12m0 102v12m39-51h12m-102 0h12m66-27 9-9m-72 72 9-9m54 0 9 9m-72-72 9 9"/>
					</g>
					<path class="energy-scene__sunbeam" d="M360 195 285 322"/>
					<path class="energy-scene__sunbeam" d="M408 204 333 330"/>

					<path d="M0 385c134-48 227-26 344 2 128 31 230-36 363-20 87 10 166 49 253 24v129H0Z" fill="url(#energy-ground)"/>
					<path d="M0 421c166-33 264 9 390 19 136 11 262-37 400-14 70 12 116 29 170 28v66H0Z" fill="#a7cfc2" opacity=".72"/>

					<g class="energy-scene__panel" aria-hidden="true">
						<path d="m82 322 237-10 45 98-254 8Z" fill="url(#energy-panel)" stroke="#fff" stroke-opacity=".82" stroke-width="3"/>
						<path d="m106 320 39 94m33-96 37 95m32-97 35 96m31-97 34 96M95 350l273-10m-259 39 275-10" fill="none" stroke="#a8d9ee" stroke-opacity=".68" stroke-width="2"/>
						<path d="m184 418-10 26m108-28 8 25m-129 0h153" fill="none" stroke="#526f7b" stroke-linecap="round" stroke-width="7"/>
					</g>

					<path class="energy-scene__wire energy-scene__wire--solar" d="M330 367h65v-62h55"/>
					<path class="energy-scene__wire energy-scene__wire--battery" d="M505 305h50v120h52"/>
					<path class="energy-scene__wire energy-scene__wire--home" d="M505 305h68v14h40"/>
					<path class="energy-scene__pulse energy-scene__pulse--solar" d="M330 367h65v-62h55"/>
					<path class="energy-scene__pulse energy-scene__pulse--battery" data-energy-pulse-battery d="M505 305h50v120h52"/>
					<path class="energy-scene__pulse energy-scene__pulse--home" data-energy-pulse-home d="M505 305h68v14h40"/>

					<g class="energy-scene__inverter" aria-hidden="true">
						<rect x="447" y="258" width="60" height="94" rx="12" fill="#fff" stroke="#c5d8df" stroke-width="2"/>
						<rect x="457" y="270" width="40" height="24" rx="6" fill="#e8f5f8"/>
						<path d="M462 282h7l4-6 6 12 4-6h7" fill="none" stroke="#0785bd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3"/>
						<circle class="energy-scene__inverter-light" cx="477" cy="315" r="5"/>
						<path d="M462 335h30" stroke="#a8bbc3" stroke-linecap="round" stroke-width="3"/>
					</g>

					<g class="energy-scene__battery" aria-hidden="true">
						<rect x="610" y="379" width="73" height="91" rx="11" fill="#f9fcfd" stroke="#bdcfd6" stroke-width="2"/>
						<path d="M633 373h27v6h-27z" fill="#69828d"/>
						<rect class="energy-scene__battery-fill" data-energy-battery-fill x="620" y="390" width="53" height="70" rx="6"/>
						<path d="M652 403 638 427h10l-5 17 17-26h-11z" fill="#fff" opacity=".9"/>
						<circle class="energy-scene__battery-light" cx="646" cy="481" r="4"/>
					</g>

					<g class="energy-scene__home" aria-hidden="true">
						<path d="m622 305 95-73 95 73" fill="#d7824a" stroke="#a95e37" stroke-linejoin="round" stroke-width="9"/>
						<path d="M641 300v119h152V300l-76-59Z" fill="url(#energy-house)" stroke="#d6e1e3" stroke-width="2"/>
						<path d="M696 419v-59a22 22 0 0 1 44 0v59" fill="#b8ced3"/>
						<rect class="energy-scene__window" x="657" y="324" width="27" height="27" rx="3"/>
						<path d="M670.5 324v27m-13.5-13.5h27" stroke="#fff" stroke-opacity=".9" stroke-width="2"/>
						<rect class="energy-scene__window" x="751" y="324" width="27" height="27" rx="3"/>
						<path d="M764.5 324v27m-13.5-13.5h27" stroke="#fff" stroke-opacity=".9" stroke-width="2"/>
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
						<text x="732" y="452" text-anchor="middle">ÉQUIPEMENTS</text>
					</g>
				</svg>
				<div class="energy-scene__daylight" aria-hidden="true"><span data-energy-daylight></span></div>
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
				<p class="energy-scene__legend"><span><i aria-hidden="true"></i> Production solaire</span><span><i aria-hidden="true"></i> Énergie stockée puis utilisée</span></p>
			</div>
		</div>
	</div>
</section>

<!-- services section -->
<section class="service-w3ls">
	<div class="container">
		<h3 class="text-center slideanim">Nos Services</h3>
		<p class="text-center slideanim">

		Fort de son expertise dans le domaine d’électricité générale,
		SEAT Opus Global assure sa place avec une forte compétence théorique et pratique.
		Nous apportons à nos clients le conseil en matière de sureté,
		de conformité et des solutions innovantes dans le choix des équipements durable et leurs efficacités énergétiques.

		</p>
	</div>
	<!-- services -->
	<div class="services">
		<div class="container">
			<div class="services-w3lsrow">
				<div class="col-md-4 services-grids top">
					<i class="fa fa-database" aria-hidden="true"></i>
					<h4 style="color: #201815">Electricité Générale</h4>
					<p>
						Nous assurons la Conception et réalisation, le
						Dépannage rapide et aussi la
						Mise en conformité.
						<br>
						<br>
						<br>
					</p>
				</div>
				<div class="col-md-4 services-grids top-1">
					<i class="fa fa-external-link" aria-hidden="true"></i>
					<h4 style="color: #201815">Energies renouvelables </h4>
					<p>
						Notre objectif est de promouvoir les énergies renouvelables.Nous proposons
						des solutions liées au développement et à la diffusion des énergies renouvelables fournies par le soleil.
					</p>
				</div>
				<div class="col-md-4 services-grids top-2">
					<i class="fa fa-cubes" aria-hidden="true"></i>
					<h4 style="color: #201815">Études et Conceptions</h4>
					<p>
						De l'Etude à la conception et à l'installation, SEAT OPUS Global s'occupe de votre électricité générale.
						Particulier ou Professionnel, notre metier c'est de satisfaire votre besoin.
						<br>
					</p>
				</div>
				<div class="col-md-4 services-grids top-3">
					<i class="fa fa-gears icon" aria-hidden="true"></i>
					<h4 style="color: #201815">Logistique et Fournitures</h4>
					<br>
					<p>
						SEAT OPUS Global offre de l'Appui Logistique et Fournitures d'équipements aux projets
						et Organisations. Car pour nous, tout client est important!
						<br><br><br>
					</p>
				</div>
				<div class="col-md-4 services-grids top-4">
					<i class="fa fa-external-link" aria-hidden="true"></i>
					<h4 style="color: #201815">Installation </h4>
					<br>
					<p>
						Nous assurons l'installation des panneaux solaires, des kits solaires photovoltaïques, des pompages solaires
						et aussi des Frigo et congélateur solaire.
						<br><br><br>
					</p>
				</div>
				<div class="col-md-4 services-grids top-5">
					<i class="fa fa-briefcase icon" aria-hidden="true"></i>
					<h4 style="color: #201815">Vente des Matériels Electriques</h4>
					<p>
						Nous disposons des différents matériels electriques dont les lampes mobiles, les lampadaires, les convertisseur
						solaire et chargeur, les chargeur batteries et les regulateurs de charge solaire et assurons leurs garantie.
					</p>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //services -->
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
<!-- /js files -->
</body>
</html>