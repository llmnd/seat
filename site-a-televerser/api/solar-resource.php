<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function respond(int $status, array $body): void
{
	http_response_code($status);
	echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
	header('Allow: GET');
	respond(405, ['error' => 'Méthode non autorisée.']);
}

function queryNumber(string $name, float $min, float $max): float
{
	$value = $_GET[$name] ?? null;
	if (!is_string($value) || !is_numeric($value)) {
		respond(400, ['error' => 'Paramètre numérique invalide : ' . $name . '.']);
	}

	$number = (float) $value;
	if (!is_finite($number) || $number < $min || $number > $max) {
		respond(400, ['error' => 'Valeur hors limites pour le paramètre : ' . $name . '.']);
	}

	return $number;
}

$latitude = queryNumber('lat', -90, 90);
$longitude = queryNumber('lon', -180, 180);
$angle = queryNumber('angle', 0, 90);
$aspect = queryNumber('aspect', -180, 180);

$query = http_build_query([
	'lat' => $latitude,
	'lon' => $longitude,
	'peakpower' => 1,
	'loss' => 14,
	'angle' => $angle,
	'aspect' => $aspect,
	'raddatabase' => 'PVGIS-ERA5',
	'outputformat' => 'json',
	'browser' => 0,
], '', '&', PHP_QUERY_RFC3986);
$url = 'https://re.jrc.ec.europa.eu/api/v5_3/PVcalc?' . $query;

if (function_exists('curl_init')) {
	$handle = curl_init($url);
	if ($handle === false) {
		respond(502, ['error' => 'Impossible de préparer la requête des données solaires.']);
	}

	curl_setopt_array($handle, [
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CONNECTTIMEOUT => 8,
		CURLOPT_TIMEOUT => 20,
		CURLOPT_HTTPHEADER => ['Accept: application/json'],
	]);
	$response = curl_exec($handle);
	$status = (int) curl_getinfo($handle, CURLINFO_RESPONSE_CODE);
	$transportError = curl_error($handle);
	curl_close($handle);
} elseif ((bool) ini_get('allow_url_fopen') && extension_loaded('openssl')) {
	$context = stream_context_create([
		'http' => [
			'method' => 'GET',
			'timeout' => 20,
			'ignore_errors' => true,
			'header' => "Accept: application/json\r\n",
		],
	]);
	$response = @file_get_contents($url, false, $context);
	$status = 0;
	$transportError = '';
	foreach ($http_response_header ?? [] as $header) {
		if (preg_match('/^HTTP\/\S+\s+(\d{3})/', $header, $matches)) {
			$status = (int) $matches[1];
		}
	}
	if ($response === false) {
		$transportError = 'Connexion au service solaire impossible.';
	}
} else {
	respond(503, ['error' => 'Activez l’extension PHP cURL ou OpenSSL pour accéder aux données solaires.']);
}

if (!is_string($response) || $status < 200 || $status >= 300) {
	error_log('PVGIS request failed: HTTP ' . $status . ($transportError !== '' ? ' ' . $transportError : ''));
	respond(502, ['error' => 'Le service de données solaires est temporairement indisponible. Réessayez dans un instant.']);
}

try {
	$data = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
} catch (JsonException $exception) {
	error_log('PVGIS returned invalid JSON: ' . $exception->getMessage());
	respond(502, ['error' => 'Le service solaire a renvoyé une réponse illisible. Réessayez plus tard.']);
}

$monthly = $data['outputs']['monthly']['fixed'] ?? null;
$annual = $data['outputs']['totals']['fixed']['H(i)_d'] ?? null;
if (!is_array($monthly) || !is_numeric($annual) || count($monthly) !== 12) {
	respond(502, ['error' => 'Les données solaires de ce lieu sont incomplètes ou indisponibles.']);
}

$values = [];
foreach ($monthly as $month) {
	$monthNumber = $month['month'] ?? null;
	$irradiation = $month['H(i)_d'] ?? null;
	if (!is_numeric($monthNumber) || !is_numeric($irradiation) || $irradiation <= 0) {
		respond(502, ['error' => 'Les données mensuelles de ce lieu sont incomplètes ou indisponibles.']);
	}
	$values[] = [
		'month' => (int) $monthNumber,
		'irradiation' => (float) $irradiation,
	];
}

respond(200, [
	'location' => [
		'latitude' => $latitude,
		'longitude' => $longitude,
	],
	'tilt' => $angle,
	'aspect' => $aspect,
	'database' => $data['inputs']['meteo_data']['radiation_db'] ?? 'PVGIS-ERA5',
	'years' => [
		'from' => $data['inputs']['meteo_data']['year_min'] ?? null,
		'to' => $data['inputs']['meteo_data']['year_max'] ?? null,
	],
	'annual_daily_irradiation' => (float) $annual,
	'monthly' => $values,
]);
