<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Правила применения рекомендательных технологий ООО «АЛЬМАМЕД» — интернет-магазин медицинских плакатов medplakaty.ru");
$APPLICATION->SetTitle("Правила применения рекомендательных технологий");
?><div class="wrapper">
	<div class="main text" style="width:100%; max-width:100%; float:none;">
		<div class="content">
			<?
			$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."content.php", Array(), Array(
				"MODE" => "html",
				"NAME" => "Правила применения рекомендательных технологий",
				"TEMPLATE" => ""
			));
			?>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
