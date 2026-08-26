<?php
/**
 * Единый перечень сторонних сервисов (сайтов) medplakaty.ru.
 * Подключать: include $_SERVER['DOCUMENT_ROOT'].'/legal/include/third_parties_list.php';
 *
 * Опционально перед include: $legalThirdPartiesExtended = true;
 * — добавляет получателей передачи ПДн (доставка, платежи и т.д.).
 */
$legalThirdPartiesExtended = !empty($legalThirdPartiesExtended);
?>
        <li>ООО «Яндекс» (ИНН 7736207543) — <a href="https://mc.yandex.ru/" target="_blank" rel="noopener">Яндекс.Метрика</a> (mc.yandex.ru, mc.yandex.com), <a href="https://api-maps.yandex.ru/" target="_blank" rel="noopener">Яндекс.Карты</a> (api-maps.yandex.ru, core-renderer-tiles.maps.yandex.net, log.api-maps.yandex.ru);</li>
        <li>ООО «1С-Битрикс» (ИНН 7717586110) — <a href="https://www.1c-bitrix.ru/" target="_blank" rel="noopener">платформа сайта</a> (1c-bitrix.ru), <a href="https://analytics.bitrix.info/" target="_blank" rel="noopener">analytics.bitrix.info</a> (рекомендации товаров);</li>
        <li>ООО «Бизнес-аналитика» (ИНН 7709973919) — сервис <a href="https://roistat.com/" target="_blank" rel="noopener">Roistat</a> (roistat.com, cloud.roistat.com), аналитика и коллтрекинг;</li>
        <li>ООО «ПРАЙМ» (ИНН 3665107119) — <a href="https://prime-ltd.su/" target="_blank" rel="noopener">prime-ltd.su</a>, SEO-сопровождение, обезличенная аналитика;</li>
<?php if ($legalThirdPartiesExtended): ?>
        <li>партнёрам по доставке (курьерские и транспортные компании);</li>
        <li>платёжным операторам (банки, процессинговые центры);</li>
        <li>IT-подрядчикам для технической поддержки;</li>
        <li>государственным органам по законным требованиям;</li>
        <li>иным лицам в случаях, предусмотренных законодательством РФ или с согласия Субъекта;</li>
<?php endif; ?>
