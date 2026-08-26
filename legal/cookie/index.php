<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Политика использования cookie-файлов ООО «АЛЬМАМЕД» — интернет-магазин медицинских плакатов medplakaty.ru");
$APPLICATION->SetTitle("Политика использования cookie-файлов");
?><div class="wrapper">
	<div class="main text" style="width:100%; max-width:100%; float:none;">
		<div class="content">
			<?
			$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."content.php", Array(), Array(
				"MODE" => "html",
				"NAME" => "Политика использования cookie-файлов",
				"TEMPLATE" => ""
			));
			?>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
