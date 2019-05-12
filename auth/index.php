<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?><?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "au_auth", Array(
	"FORGOT_PASSWORD_URL" => "index.php",	// Страница забытого пароля
		"PROFILE_URL" => "profile.php",	// Страница профиля
		"REGISTER_URL" => "registration.php",	// Страница регистрации
		"SHOW_ERRORS" => "Y",	// Показывать ошибки
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>