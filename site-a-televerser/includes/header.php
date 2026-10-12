<?php
$currentPage = basename($_SERVER['SCRIPT_NAME'] ?? '');
$productPages = ['kit.php', 'monocristallin.php', 'polycristallin.php', 'lampe.php', 'Lampadaire.php', 'batterie.php', 'tubular.php', 'convertisseurSolaire.php', 'convertisseurChargeur.php', 'chargeur.php', 'regulateur.php', 'pompe.php'];
$realisationPages = ['realisations.php', 'realisationSolaire.php', 'realisationPompage.php', 'realisationLampadaire.php'];
?>
<!-- Optionnel : police Inter (sinon Helvetica Neue / Arial)
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
-->
<header class="seat-header">
	<div class="seat-header__navigation">
		<div class="seat-header__inner seat-header__navigation-inner">
			<a class="seat-header__brand" href="index.php" aria-label="SEAT Opus Global — accueil">
				<img src="images/logo1.jfif" alt="SEAT Opus Global">
			</a>
			<nav class="seat-header__desktop-nav" aria-label="Navigation principale">
				<a href="index.php"<?php if ($currentPage === 'index.php') echo ' aria-current="page"'; ?>>Accueil</a>
				<a href="service.php"<?php if ($currentPage === 'service.php') echo ' aria-current="page"'; ?>>Services</a>
				<details class="seat-nav-dropdown<?php if (in_array($currentPage, $productPages, true)) echo ' is-current'; ?>">
					<summary>Produits <span class="seat-nav-caret" aria-hidden="true"></span></summary>
					<div class="seat-mega-menu">
						<a class="seat-mega-menu__feature" href="kit.php">
							<span class="seat-mega-menu__feature-title">Kit solaire</span>
							<span class="seat-mega-menu__feature-text">Panneaux, batterie et régulateur réunis pour une installation prête à l'emploi.</span>
							<span class="seat-mega-menu__feature-link">Découvrir le kit</span>
						</a>
						<div class="seat-mega-menu__group">
							<h2>Panneaux solaires</h2>
							<a href="monocristallin.php">Monocristallin</a>
							<a href="polycristallin.php">Polycristallin</a>
							<h2>Schneider électrique</h2>
							<a href="lampe.php">Lampe mobile</a>
							<a href="Lampadaire.php">Lampadaire solaire</a>
							<h2>Batteries</h2>
							<a href="batterie.php">Batterie</a>
							<a href="tubular.php">Tubular Plate</a>
						</div>
						<div class="seat-mega-menu__group">
							<h2>Autres produits</h2>
							<a href="kit.php">Kit solaire</a>
							<a href="convertisseurSolaire.php">Convertisseur solaire</a>
							<a href="convertisseurChargeur.php">Convertisseur chargeur</a>
							<a href="chargeur.php">Chargeur batteries</a>
							<a href="regulateur.php">Régulateur de charge solaire</a>
							<a href="pompe.php">Pompe immergée</a>
						</div>
					</div>
				</details>
				<details class="seat-nav-dropdown<?php if (in_array($currentPage, $realisationPages, true)) echo ' is-current'; ?>">
					<summary>Réalisations <span class="seat-nav-caret" aria-hidden="true"></span></summary>
					<div class="seat-nav-simple-menu">
						<a href="realisations.php">Toutes les réalisations</a>
						<a href="realisationSolaire.php">Solution solaire</a>
						<a href="realisationPompage.php">Pompage solaire</a>
						<a href="realisationLampadaire.php">Lampadaire solaire</a>
					</div>
				</details>
				<a class="seat-header__project-link" href="index.php#preparer-projet">
					Préparer un projet
					<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg>
				</a>
				<a href="contact.php"<?php if ($currentPage === 'contact.php') echo ' aria-current="page"'; ?>>Contact</a>
			</nav>
			<details class="seat-header__mobile-menu">
				<summary aria-label="Menu de navigation"><span></span><span></span></summary>
				<nav aria-label="Navigation mobile">
					<a href="index.php"<?php if ($currentPage === 'index.php') echo ' aria-current="page"'; ?>>Accueil</a>
					<a href="service.php"<?php if ($currentPage === 'service.php') echo ' aria-current="page"'; ?>>Services</a>
					<details class="seat-mobile-submenu">
						<summary>Produits</summary>
						<a href="monocristallin.php"<?php if ($currentPage === 'monocristallin.php') echo ' aria-current="page"'; ?>>Monocristallin</a>
						<a href="polycristallin.php"<?php if ($currentPage === 'polycristallin.php') echo ' aria-current="page"'; ?>>Polycristallin</a>
						<a href="lampe.php"<?php if ($currentPage === 'lampe.php') echo ' aria-current="page"'; ?>>Lampe mobile</a>
						<a href="Lampadaire.php"<?php if ($currentPage === 'Lampadaire.php') echo ' aria-current="page"'; ?>>Lampadaire solaire</a>
						<a href="batterie.php"<?php if ($currentPage === 'batterie.php') echo ' aria-current="page"'; ?>>Batteries</a>
						<a href="tubular.php"<?php if ($currentPage === 'tubular.php') echo ' aria-current="page"'; ?>>Tubular Plate</a>
						<a href="kit.php"<?php if ($currentPage === 'kit.php') echo ' aria-current="page"'; ?>>Kit solaire</a>
						<a href="convertisseurSolaire.php"<?php if ($currentPage === 'convertisseurSolaire.php') echo ' aria-current="page"'; ?>>Convertisseur solaire</a>
						<a href="convertisseurChargeur.php"<?php if ($currentPage === 'convertisseurChargeur.php') echo ' aria-current="page"'; ?>>Convertisseur chargeur</a>
						<a href="chargeur.php"<?php if ($currentPage === 'chargeur.php') echo ' aria-current="page"'; ?>>Chargeur batteries</a>
						<a href="regulateur.php"<?php if ($currentPage === 'regulateur.php') echo ' aria-current="page"'; ?>>Régulateur de charge solaire</a>
						<a href="pompe.php"<?php if ($currentPage === 'pompe.php') echo ' aria-current="page"'; ?>>Pompe immergée</a>
					</details>
					<details class="seat-mobile-submenu">
						<summary>Réalisations</summary>
						<a href="realisations.php"<?php if ($currentPage === 'realisations.php') echo ' aria-current="page"'; ?>>Toutes les réalisations</a>
						<a href="realisationSolaire.php"<?php if ($currentPage === 'realisationSolaire.php') echo ' aria-current="page"'; ?>>Solution solaire</a>
						<a href="realisationPompage.php"<?php if ($currentPage === 'realisationPompage.php') echo ' aria-current="page"'; ?>>Pompage solaire</a>
						<a href="realisationLampadaire.php"<?php if ($currentPage === 'realisationLampadaire.php') echo ' aria-current="page"'; ?>>Lampadaire solaire</a>
					</details>
					<a class="seat-mobile-project-link" href="index.php#preparer-projet">
						Préparer un projet
						<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7 17 17 7M7 7h10v10"/></svg>
					</a>
					<a href="contact.php"<?php if ($currentPage === 'contact.php') echo ' aria-current="page"'; ?>>Contact</a>
				</nav>
			</details>
		</div>
	</div>
</header>
<script>
(function () {
	var header = document.querySelector('.seat-header');
	if (!header) return;
	var ticking = false;
	function update() {
		var y = window.scrollY;
		if (y > 80) header.classList.add('is-scrolled');
		else if (y < 20) header.classList.remove('is-scrolled');
		ticking = false;
	}
	window.addEventListener('scroll', function () {
		if (!ticking) { ticking = true; requestAnimationFrame(update); }
	}, { passive: true });
	window.addEventListener('pageshow', update);
	update();
	document.addEventListener('click', function (e) {
		header.querySelectorAll('details[open]').forEach(function (d) {
			if (!d.contains(e.target)) d.removeAttribute('open');
		});
	});
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') header.querySelectorAll('details[open]').forEach(function (d) { d.removeAttribute('open'); });
	});
})();
</script>