<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

/**
 * sale.basket.basket.line caches TOTAL via BasketComponentHelper::calculateBasketCost(),
 * which refreshData(PRICE) and overwrites CUSTOM_PRICE with catalog BASE.
 * Recalculate from the loaded basket without refresh so article prices stay correct.
 */
if (!\Bitrix\Main\Loader::includeModule('sale') || !\Bitrix\Main\Loader::includeModule('currency')) {
	return;
}

$fuserId = (int)\Bitrix\Sale\Fuser::getId(true);
if ($fuserId <= 0) {
	return;
}

$siteId = defined('SITE_ID') ? SITE_ID : 's1';
$basket = \Bitrix\Sale\Basket::loadItemsForFUser($fuserId, $siteId);

$sum = 0.0;
$count = 0;
foreach ($basket as $item) {
	if (!$item->canBuy() || $item->isDelay()) {
		continue;
	}
	$sum += (float)$item->getFinalPrice();
	$count++;
}

$currency = \Bitrix\Sale\Internals\SiteCurrencyTable::getSiteCurrency($siteId);
$arResult['NUM_PRODUCTS'] = $count;
$arResult['TOTAL_PRICE_RAW'] = $sum;
$arResult['TOTAL_PRICE'] = CCurrencyLang::CurrencyFormat($sum, $currency, true);

$_SESSION['SALE_USER_BASKET_PRICE'][$siteId][$fuserId] = $sum;
$_SESSION['SALE_USER_BASKET_QUANTITY'][$siteId][$fuserId] = $count;
