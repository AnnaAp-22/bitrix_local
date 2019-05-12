<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?>

<? if (CUser::IsAuthorized()) { ?>
<? } else { ?>
    <? $APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd",
        ".default",
        Array()
    ); ?>
<? } ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>