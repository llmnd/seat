<?php
$pageDetails = [
	'batterie.php' => ['Batteries', 'Produits'],
	'chargeur.php' => ['Chargeurs de batteries', 'Produits'],
	'contact.php' => ['Parlons de votre projet', 'Contact'],
	'convertisseurChargeur.php' => ['Convertisseurs chargeurs', 'Produits'],
	'convertisseurSolaire.php' => ['Convertisseurs solaires', 'Produits'],
	'error.php' => ['Envoi non effectué', 'Contact'],
	'kit.php' => ['Kits solaires', 'Produits'],
	'Lampadaire.php' => ['Lampadaires solaires', 'Produits'],
	'lampe.php' => ['Lampes solaires', 'Produits'],
	'monocristallin.php' => ['Panneaux monocristallins', 'Produits'],
	'polycristallin.php' => ['Panneaux polycristallins', 'Produits'],
	'pompe.php' => ['Pompes immergées', 'Produits'],
	'realisationLampadaire.php' => ['Éclairage solaire', 'Réalisations'],
	'realisationPompage.php' => ['Pompage solaire', 'Réalisations'],
	'realisationSolaire.php' => ['Solutions solaires', 'Réalisations'],
	'realisations.php' => ['Nos réalisations', 'Réalisations'],
	'regulateur.php' => ['Régulateurs de charge', 'Produits'],
	'service.php' => ['Nos services', 'Services'],
	'success.php' => ['Merci pour votre message', 'Contact'],
	'tubular.php' => ['Batteries Tubular Plate', 'Produits'],
];
$pageKey = basename(isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '');
$pageTitle = isset($pageDetails[$pageKey][0]) ? $pageDetails[$pageKey][0] : 'Nos solutions';
$pageSection = isset($pageDetails[$pageKey][1]) ? $pageDetails[$pageKey][1] : 'Nos activités';
?>
<section class="page-hero" data-page-section="<?php echo htmlspecialchars($pageSection, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="page-title">
	<div class="page-hero__inner">
		<div class="page-hero__content">
			<p class="page-hero__eyebrow"><span class="page-hero__eyebrow-line" aria-hidden="true"></span>SEAT Opus Global <span class="page-hero__eyebrow-divider" aria-hidden="true">/</span> Énergie &amp; ingénierie</p>
			<p class="page-hero__category"><?php echo htmlspecialchars($pageSection, ENT_QUOTES, 'UTF-8'); ?></p>
			<h1 id="page-title"><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
			<nav class="page-breadcrumb" aria-label="Fil d’Ariane">
				<a href="index.php">Accueil</a>
				<span class="page-breadcrumb__separator" aria-hidden="true">/</span>
				<span><?php echo htmlspecialchars($pageSection, ENT_QUOTES, 'UTF-8'); ?></span>
			</nav>
		</div>
		<div class="page-hero__visual" aria-hidden="true">
			<div class="page-hero__orbit page-hero__orbit--outer"></div>
			<div class="page-hero__orbit page-hero__orbit--inner"></div>
			<div class="page-hero__visual-core">
				<svg viewBox="0 0 48 48" fill="none">
					<circle cx="24" cy="24" r="8" stroke="currentColor" stroke-width="1.6"/>
					<path d="M24 4v7m0 26v7M4 24h7m26 0h7M9.86 9.86l4.95 4.95m18.38 18.38 4.95 4.95m0-28.28-4.95 4.95M14.81 33.19l-4.95 4.95" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
				</svg>
			</div>
			<span class="page-hero__visual-label">Énergie<br>en mouvement</span>
		</div>
	</div>
</section>
