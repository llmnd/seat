<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<?php
$catalogPages = ['kit.php', 'monocristallin.php', 'polycristallin.php', 'lampe.php', 'Lampadaire.php', 'batterie.php', 'tubular.php', 'convertisseurSolaire.php', 'convertisseurChargeur.php', 'chargeur.php', 'regulateur.php', 'pompe.php'];
if (in_array(basename($_SERVER['SCRIPT_NAME'] ?? ''), $catalogPages, true)) :
?>
<link rel="stylesheet" href="css/product-catalog.css?v=4">
<?php endif; ?>
