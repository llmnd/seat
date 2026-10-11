<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/quote-cta.css?v=3">
<script src="js/quote-cta.js?v=5" defer></script>
<link rel="stylesheet" href="css/solar-advisor.css?v=7">
<script src="js/solar-advisor.js?v=6" defer></script>
<?php
$catalogPages = ['kit.php', 'monocristallin.php', 'polycristallin.php', 'lampe.php', 'Lampadaire.php', 'batterie.php', 'tubular.php', 'convertisseurSolaire.php', 'convertisseurChargeur.php', 'chargeur.php', 'regulateur.php', 'pompe.php'];
if (in_array(basename($_SERVER['SCRIPT_NAME'] ?? ''), $catalogPages, true)) :
?>
<link rel="stylesheet" href="css/product-catalog.css?v=4">
<?php endif; ?>
