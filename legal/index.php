<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Правовая информация ООО «АЛЬМАМЕД» — политика персональных данных, согласие, cookie и рекомендательные технологии");
$APPLICATION->SetPageProperty("robots", "noindex, nofollow");
$APPLICATION->SetTitle("Правовая информация");
\Bitrix\Main\Page\Asset::getInstance()->addCss("/legal/assets/legal.css");
?>
<div class="wrapper">
	<div class="main text" style="width:100%; max-width:100%; float:none;">
		<div class="content">
			<article class="legal-page">
				<h1 class="legal-page__title">Правовая информация</h1>
				<div class="legal-doc">
					<ul>
						<li><a href="/legal/politika-pdn/">Политика обработки персональных данных</a></li>
						<li><a href="/legal/soglasie-pdn/">Согласие на обработку персональных данных</a></li>
						<li><a href="/legal/cookie/">Политика использования cookie-файлов</a></li>
						<li><a href="/legal/rekomendatelnye-tehnologii/">Правила применения рекомендательных технологий</a></li>
					</ul>
				</div>
			</article>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
