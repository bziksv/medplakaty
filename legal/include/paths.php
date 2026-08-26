<?php
if (!defined('LEGAL_IMG_POLITIKA')) {
	define('LEGAL_IMG_POLITIKA', '/legal/assets/politika-pdn.png');
	define('LEGAL_IMG_SOGLASIE', '/legal/assets/soglasie-pdn.png');
	define('LEGAL_IMG_COOKIE', '/legal/assets/cookie.png');
	define('LEGAL_IMG_REKOMEND', '/legal/assets/rekomendatelnye-tehnologii.png');
}

if (!function_exists('legal_img')) {
	function legal_img(string $key): string
	{
		static $map = [
			'politika' => LEGAL_IMG_POLITIKA,
			'soglasie' => LEGAL_IMG_SOGLASIE,
			'cookie' => LEGAL_IMG_COOKIE,
			'rekomend' => LEGAL_IMG_REKOMEND,
		];

		return $map[$key] ?? '#';
	}
}
