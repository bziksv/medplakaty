<?php
class CNigesCookiesAcceptPublic
{
	/** @var string|null */
	private static $bannerHtml = null;

	/**
	 * Render banner into a static buffer (runs before EndBufferContent).
	 */
	public static function OnEpilog()
	{
		self::$bannerHtml = null;

		if (!CModule::IncludeModule(cookiesaccept_MODULE_ID)) {
			return;
		}

		if (COption::GetOptionString(cookiesaccept_MODULE_ID, 'ACTIVE', 'N', SITE_ID) !== 'Y') {
			return;
		}

		if (defined('ADMIN_SECTION') && ADMIN_SECTION === true) {
			return;
		}

		if (defined('PUBLIC_AJAX_MODE') && PUBLIC_AJAX_MODE === true) {
			return;
		}
		if (isset($_REQUEST['ajax']) && (string)$_REQUEST['ajax'] !== '') {
			return;
		}
		if (isset($_REQUEST['bxajaxid']) && (string)$_REQUEST['bxajaxid'] !== '') {
			return;
		}

		global $APPLICATION;
		if (!is_object($APPLICATION)) {
			return;
		}

		ob_start();
		$APPLICATION->IncludeComponent(
			'niges:cookiesaccept',
			'.default',
			array(),
			false,
			array('HIDE_ICONS' => 'Y')
		);
		$html = ob_get_clean();
		if (is_string($html) && $html !== '') {
			self::$bannerHtml = $html;
		}
	}

	/**
	 * Place banner before </body> so it is not after </html>.
	 */
	public static function OnEndBufferContent(&$content)
	{
		if (!is_string($content) || $content === '' || self::$bannerHtml === null || self::$bannerHtml === '') {
			return;
		}

		$banner = self::$bannerHtml;
		self::$bannerHtml = null;

		if (strpos($content, 'id="nca-cookiesaccept-line"') !== false) {
			return;
		}

		$pos = strripos($content, '</body>');
		if ($pos !== false) {
			$content = substr($content, 0, $pos).$banner.substr($content, $pos);
			return;
		}

		$content .= $banner;
	}
}
