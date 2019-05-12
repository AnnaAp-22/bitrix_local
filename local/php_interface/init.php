<?php
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");

AddEventHandler("main", "OnBeforeUserRegister", Array("CUserMy", "OnBeforeUserRegisterHandler"));
class CUserMy
{
	function OnBeforeUserRegisterHandler(&$arFields)
	{
		$arFields["LOGIN"] = $arFields["EMAIL"];
		$arFields["CONFIRM_PASSWORD"] = $arFields["PASSWORD"];
	}
}
?>
<?
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("MyClass1", "OnBeforeIBlockElementAddHandler"));
class MyClass1
{
	// создаем обработчик события "OnBeforeIBlockElementAdd"
	function OnBeforeIBlockElementAddHandler(&$arFields)
	{
		if (is_array($arFields["DETAIL_PICTURE"]))
		{
			if(copy($arFields["DETAIL_PICTURE"]["tmp_name"], $arFields["DETAIL_PICTURE"]["tmp_name"]."~"))
			{
				$arFields["PREVIEW_PICTURE"] = $arFields["DETAIL_PICTURE"];
				$arFields["PREVIEW_PICTURE"]["tmp_name"] .= "~";
				$arFields["PREVIEW_PICTURE"] = CIBlock::ResizePicture($arFields["PREVIEW_PICTURE"], array("WIDTH" => 350,  "METHOD" => "resample",));
//				$arFields["PREVIEW_PICTURE"] = CIBlock::ResizePicture($arFields["PREVIEW_PICTURE"], array("WIDTH" => 350, "HEIGH" => 260, "METHOD" => "resample",));
			}
			$arFields["DETAIL_PICTURE"] = CIBlock::ResizePicture($arFields["DETAIL_PICTURE"], array("WIDTH" => 730,  "METHOD" => "resample",));
		}
		$arParams = array(
			"max_len" => "60", // обрезаем символьный код до 60 символов
			"change_case" => "L", // приводим к нижнему регистру
			"replace_space" => "-", // меняем пробелы на тире
			"replace_other" => "-", // меняем плохие символы на тире
			"delete_repeat_replace" => "true", // удаляем повторяющиеся тире
			"use_google" => "false", // отключаем использование google
		);
		$arFields["CODE"] = Cutil::translit($arFields["NAME"], "ru", $arParams);
		$arFields["PROPERTY_VALUES"][7] = $arFields["PROPERTY_VALUES"][2];//PRICE_START -> PRICE_CUR
		AddMessage2Log(print_r($arFields, true));
	}

}
?>
