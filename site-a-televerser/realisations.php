<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Découvrez les réalisations solaires, de pompage et d’éclairage de SEAT Opus Global.">
	<meta name="theme-color" content="#103b59">
	<title>Nos réalisations — SEAT Opus Global</title>
	<link rel="icon" href="images/logo.jpg">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/site-header.css">
	<link rel="stylesheet" href="css/pages.css">
	<link rel="stylesheet" href="css/solar-tools.css?v=1">
	<?php require __DIR__ . '/includes/site-fonts.php'; ?>
	<script src="js/solar-tools.js?v=1" defer></script>
</head>
<body>
	<?php require __DIR__ . '/includes/header.php'; ?>
	<main>
		<?php require __DIR__ . '/includes/page-intro.php'; ?>
		<section class="realisation-gallery" data-realisation-filters aria-labelledby="realisation-gallery-title">
			<div class="container">
				<div class="realisation-gallery__heading">
					<p class="eyebrow"><span></span> Du concret, sur le terrain</p>
					<h2 id="realisation-gallery-title">Nos réalisations</h2>
					<p>Parcourez les photos de nos projets et filtrez-les selon le type d’installation.</p>
				</div>
				<div class="realisation-filters" role="group" aria-label="Filtrer les réalisations">
					<button type="button" data-filter="all" aria-pressed="true" tabindex="0">Tout voir</button>
					<button type="button" data-filter="solaire" aria-pressed="false" tabindex="-1">Solaire</button>
					<button type="button" data-filter="pompage" aria-pressed="false" tabindex="-1">Pompage</button>
					<button type="button" data-filter="eclairage" aria-pressed="false" tabindex="-1">Éclairage</button>
				</div>
				<p class="realisation-gallery__count" data-filter-count aria-live="polite"></p>
				<div class="realisation-gallery__grid">
					<?php
					$realisationImages = [];
					foreach ([1, 3, 4, 5, 6, 2, 7, 8] as $number) {
						$realisationImages[] = [
							'file' => "solaire{$number}.PNG",
							'category' => 'solaire',
							'category_label' => 'Énergie solaire',
							'title' => 'Installation solaire photovoltaïque',
						];
					}
					foreach ([9, 10, 11, 12] as $number) {
						$realisationImages[] = [
							'file' => "solaire{$number}.PNG",
							'category' => 'solaire',
							'category_label' => 'Énergie solaire',
							'title' => 'Solution solaire autonome',
						];
					}
					foreach ([1, 2, 3] as $number) {
						$realisationImages[] = [
							'file' => "pompage{$number}.PNG",
							'category' => 'pompage',
							'category_label' => 'Pompage solaire',
							'title' => 'Installation de pompage solaire',
						];
					}
					foreach (['realisation2.PNG', 'realisation.PNG', 'realisation1.PNG'] as $file) {
						$realisationImages[] = [
							'file' => $file,
							'category' => 'eclairage',
							'category_label' => 'Éclairage solaire',
							'title' => 'Installation d’éclairage solaire',
						];
					}
					foreach ($realisationImages as $image) :
						$imagePath = 'images/' . $image['file'];
						if (!is_file(__DIR__ . '/' . $imagePath)) continue;
					?>
						<figure class="realisation-gallery__card" data-category="<?php echo htmlspecialchars($image['category'], ENT_QUOTES, 'UTF-8'); ?>">
							<img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($image['title'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy" decoding="async">
							<figcaption>
								<span><?php echo htmlspecialchars($image['category_label'], ENT_QUOTES, 'UTF-8'); ?></span>
								<strong><?php echo htmlspecialchars($image['title'], ENT_QUOTES, 'UTF-8'); ?></strong>
							</figcaption>
						</figure>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	</main>
	<?php require __DIR__ . '/includes/site-footer.php'; ?>
</body>
</html>
