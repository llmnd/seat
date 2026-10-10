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
	<!-- /css files -->
	<!-- js files -->
	<script src="js/modernizr.custom.js"></script>
	<!-- /js files -->
<?php require __DIR__ . '/includes/site-fonts.php'; ?>
</head>
<body>
<?php require __DIR__ . '/includes/header.php'; ?>

<?php require __DIR__ . '/includes/page-intro.php'; ?>

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

<?php require __DIR__ . '/includes/contact-cta.php'; ?>
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
<!-- /js files -->
</body>
</html>