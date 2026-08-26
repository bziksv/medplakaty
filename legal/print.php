<?php
$doc = isset($_GET['doc']) ? (string)$_GET['doc'] : '';
$allowed = [
	'politika-pdn' => 'Политика обработки персональных данных',
	'soglasie-pdn' => 'Согласие на обработку персональных данных',
	'cookie' => 'Политика использования cookie-файлов',
	'rekomendatelnye-tehnologii' => 'Правила применения рекомендательных технологий',
];

if (!isset($allowed[$doc])) {
	http_response_code(404);
	exit('Not found');
}

$contentFile = $_SERVER['DOCUMENT_ROOT'].'/legal/'.$doc.'/content.php';
if (!is_file($contentFile)) {
	http_response_code(404);
	exit('Not found');
}

?><!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=htmlspecialchars($allowed[$doc], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?></title>
	<style>
		html, body { margin: 0; padding: 0; background: #fff; }
		body { padding: 32px 40px 48px; }
	</style>
</head>
<body>
<?php include $contentFile; ?>
</body>
</html>
