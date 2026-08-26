$('input[name="PHONE"]').mask('+7 (999) 999 99 99');
$('input[autocomplete="tel"]').mask('+7 (999) 999 99 99');

$('.cart__content .cart__radio').change(function(){
    $('.cart__content > p.article').text("Арт: " + $(this).val());
    $('.cart__content > .cart__price').text($(this).attr('data-price'));
    $('.cart__content > .cart_old_price').text($(this).attr('data-old-price'));
});

$('.cart__content > p.article').text("Арт: " + $('.cart__content .cart__radio:checked').val());

if($('.cart__content .cart__radio:checked').attr('data-price') != 'Цена 0 ₽'){
		$('.cart__content > .cart__price').text($('.cart__content .cart__radio:checked').attr('data-price'));
}

$('.cart__content > .cart_old_price').text($('.cart__content .cart__radio:checked').attr('data-old-price'));


$('.callback-btn').click(function(){
    $('#callback').bPopup({
        zIndex:1000
    });
});

function ensureBitrixSessid($form) {
    var $sessid = $form.find('input[name="sessid"]');
    if ($sessid.length && !$sessid.val() && typeof BX !== 'undefined' && BX.bitrix_sessid) {
        $sessid.val(BX.bitrix_sessid());
    }
}

function validateConsentForm($checkbox, $error) {
    if (!$checkbox.length || $checkbox.is(':checked')) {
        $error.hide();
        return true;
    }
    $error.show();
    return false;
}

function handleCallbackFormResult() {
    var $callback = $('#callback');
    if (!$callback.length) {
        return;
    }

    var paramsHash = $callback.data('params-hash');
    var urlParams = new URLSearchParams(window.location.search);
    var success = urlParams.get('success');

    if (success && paramsHash && success === String(paramsHash)) {
        alertify.success('Спасибо, ваше сообщение принято.');
        $callback.bPopup({zIndex: 1000});
        if (window.history && window.history.replaceState) {
            urlParams.delete('success');
            var newSearch = urlParams.toString();
            window.history.replaceState({}, document.title, window.location.pathname + (newSearch ? '?' + newSearch : '') + window.location.hash);
        }
        return;
    }

    if ($callback.find('.errortext').length) {
        alertify.error('Ошибка отправки формы. Обновите страницу и попробуйте снова.');
        $callback.bPopup({zIndex: 1000});
    }
}

$(function() {
    handleCallbackFormResult();

    var $callbackForm = $('#callback form');
    if ($callbackForm.length) {
        $callbackForm.on('submit', function(e) {
            var $form = $(this);
            ensureBitrixSessid($form);
            if (!validateConsentForm($('#callback-consent'), $form.find('.mf-consent-error'))) {
                e.preventDefault();
                return false;
            }
        });
    }

    $('#callback-consent').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).closest('form').find('.mf-consent-error').hide();
        }
    });
});


var path = "/bitrix/templates/medical-templates/ajax/";

function replaseBasketTop() {
    $.ajax({
        url: path + 'basket.php',
        type: 'get',
        success: function (data) {
            $('.header__basket').replaceWith(data);
        }
    })
}

function replaseBasketMobileTop() {
    $.ajax({
        url: path + 'basket.mobile.php',
        type: 'get',
        success: function (data) {
            $('.header__basket_mobile').replaceWith(data);
        }
    })
}


function addToBasket2(idel, quantity,el) {

    $art = $(el).closest('.cart__content').find('.cart__radio:checked').val();
    if(!$art)
        $art = $(el).closest('.goods__item').find('input[name="article"]').val();

    $color = $.trim($(el).closest('.cart__content').find('.cart__radio:checked').parent().text());
    if(!$color)
        $color = $(el).closest('.goods__item').find('input[name="color"]').val();

    if($color == undefined)
        $color = 0;

    $href = path + "add.php?id=" + idel + '&quantity=' + quantity + '&art=' + $art + '&color=' + $color;
    $.ajax({
        url: $href,
        type: 'get',
        success: function (data) {
            console.log(data);
            if (data == 'Товар успешно добавлен в корзину') {
                replaseBasketTop();
                replaseBasketMobileTop();
                alertify.success(data);
            } else {
                alertify.error(data);
            }
        }
    });
    return false;
}


$( function() {
    $( ".cart__price.tooltip,.goods__price.tooltip" ).tooltip({
        show: null,
        content: "<noindex>Цена зависит от комплектации прибора и/или наличия на складе. Для уточнения стоимости необходимо отправить запрос по электронной почте (запросить КП),  либо оформить заказ на сайте  и менеджер сам вам перезвонит. Если указанная цена вас не устроит, Вы можете отказаться от товара до момента его оплаты.</noindex>",
        items: "div[class]",
        position: {
            my: "left top",
            at: "left bottom"
        },
        open: function( event, ui ) {
            ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
        }
    });
} );

window.roistatVisitCallback = function(visitId) {
    var mail = visitId + "@" + window.location.hostname;
    var roi = $('.roi_visit');
    roi.text(mail);
    roi.attr('href','mailto:' + mail);
};