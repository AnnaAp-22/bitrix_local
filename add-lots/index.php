<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавление лота");
?><?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form",
	"add_lot",
	Array(
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "Изображение",
		"CUSTOM_TITLE_DETAIL_TEXT" => "Описание",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "Категория",
		"CUSTOM_TITLE_NAME" => "Наименование",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"GROUPS" => array("6"),
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "/",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => array("2", "4", "6", "7", "NAME", "IBLOCK_SECTION", "DETAIL_TEXT", "DETAIL_PICTURE"),
		"PROPERTY_CODES_REQUIRED" => array("2", "4", "6", "NAME", "IBLOCK_SECTION", "DETAIL_TEXT", "DETAIL_PICTURE"),
		"RESIZE_IMAGES" => "Y",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "Лот добавлен.",
		"USER_MESSAGE_EDIT" => "",
		"USE_CAPTCHA" => "N"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>