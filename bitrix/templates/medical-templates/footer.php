<? if(!CSite::InDir('/index.php')): ?>
</div>
<?endif;?>

<div class="footer">
    <div class="container">
        <div class="footer__wrapper footer__row">
            <div class="footer__col">
                <div class="footer__subscribe">
                    <i class="icon-email_big"></i>
                    <span>Подпишитесь! Новинки, скидки, предложения!</span>
                </div>
            </div>
            <div class="footer__col">

                <?$APPLICATION->IncludeComponent(
	"bitrix:sender.subscribe", 
	"sender.subscribe", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CONFIRMATION" => "N",
		"HIDE_MAILINGS" => "N",
		"SET_TITLE" => "N",
		"SHOW_HIDDEN" => "N",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_PERSONALIZATION" => "Y",
		"COMPONENT_TEMPLATE" => "sender.subscribe",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="footer__row">
            <div class="footer__col">

                <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom.menu", Array(
                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                    "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                    "MAX_LEVEL" => "2",	// Уровень вложенности меню
                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                    "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                    "ROOT_MENU_TYPE" => "bottom",	// Тип меню для первого уровня
                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "COMPONENT_TEMPLATE" => "catalog_horizontal",
                    "MENU_THEME" => "site",	// Тема меню
                ),
                    false
                );?>

            </div>
            <div class="footer__col flex-3">
                <div class="footer__phone icon-phone">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/footer_phone.jpg">
                    <span>88005555550</span>
                </div>
                <a href="javascript:void(0);" class="footer__callback footer__link callback-btn">Заказать звонок</a>
                <div class="footer__email icon-email">
                    <a href="mailto:<?=tplvar('email');?>" class="footer__link roi_visit"><?=tplvar('email', true);?></a>
                    (Для заказов)
                </div>
            </div>
            <div class="footer__col flex-2">
                <div class="footer__copy icon-copyright"><?=date("Y")?> Все права защищены.</div>
                <a href="https://prime-ltd.su/?from=medplakaty.ru" target="_blank" rel="nofollow">
                <img src="https://prime-ltd.su/logo/white.svg" 
                title="Продвижение сайтов" 
                alt="Продвижение сайтов"
                style="display: inline-block; vertical-align: top; max-width: 225px; height: auto;">
                </a>
                
            </div>
        </div>
<hr>
		<noindex><div>Мы используем файлы <a style="color: #fff;" target="_blank" href="/upload/cookies-medplakaty.png">cookies</a> и <a style="color: #fff;" target="_blank" href="/upload/rekomendatelnye-tehnologii.png"> рекомендательные технологии</a> для улучшения функционала сайта, персонализации рекламы и анализа статистики посещаемости. Используя сайт, вы соглашаетесь на обработку ваших персональных данных в соответстви с нашей <a style="color: #fff;" target="_blank" href="/upload/politics.png">политикой конфиденциальности</a>. Для отказа от обработки cookies можно отключить сохранение cookies в настройках вашего браузера.</div></noindex>
    </div>
</div>




<?$APPLICATION->IncludeComponent(
	"nbrains:main.feedback", 
	"popup-callback", 
	array(
		"EMAIL_TO" => "info@medplakaty.ru",
		"EVENT_MESSAGE_ID" => array(
			0 => "53",
		),
		"ROI_VISIT" => $_COOKIE['roistat_visit'],
		"IBLOCK_ID" => "37",
		"IBLOCK_TYPE" => "feedback",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"PROPERTY_CODE" => array(
			0 => "NAME",
			1 => "URL",
			2 => "PHONE",
			3 => "MAIL",
			4 => "QUERY",
		),
		"USE_CAPTCHA" => "Y",
		"COMPONENT_TEMPLATE" => "popup-callback",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>




<script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/alertify.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.maskinput.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.bpopup.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/lightgallery.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/functions.js"></script>


<!-- Yandex.Metrika counter от Prime -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(54369226, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/54369226" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<!-- Сквозная от Prime -->
<script>
(function(w, d, s, h, id) {
    w.roistatProjectId = id; w.roistatHost = h;
    var p = d.location.protocol == "https:" ? "https://" : "http://";
    var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init";
    var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
})(window, document, 'script', 'cloud.roistat.com', '22940c090890d679f28f099093087604');
</script>

</body>
</html>