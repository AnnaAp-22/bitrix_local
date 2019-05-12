<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>
<div class="bx-auth-reg">

<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<?
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif?>

<form class="form container" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>
  <h2>Регистрация нового аккаунта</h2>
  <div class="form__item"> <!-- form__item--invalid -->
    <label for="email">E-mail*</label>
    <input  id="email" type="text" name="REGISTER[EMAIL]" value="<?=$arResult["VALUES"]["EMAIL"]?>" placeholder="Введите e-mail" />

  </div>
  <div class="form__item">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="REGISTER[PASSWORD]" value="<?=$arResult["VALUES"]["PASSWORD"]?>" autocomplete="off" placeholder="Введите пароль"  />

  </div>
  <div class="form__item">
    <label for="name">Имя*</label>
    <input  id="name" type="text" name="REGISTER[NAME]" value="<?=$arResult["VALUES"]["NAME"]?>" placeholder="Введите имя" />
    <!--       <span class="form__error">Введите имя</span>-->
  </div>
  <div class="form__item">
    <label for="message">Контактные данные*</label>
    <!--      <textarea id="message"  name="REGISTER[PERSONAL_NOTES]" placeholder="Напишите как с вами связаться"></textarea>-->
    <textarea id="message" placeholder="Напишите как с вами связаться" name="REGISTER[PERSONAL_NOTES]"><?=$arResult["VALUES"]["PERSONAL_NOTES"]?></textarea>

  </div>
  <div class="form__item form__item--file form__item--last">
    <label id="photox">Аватар</label>
    <input  id="photox" type="file" name="REGISTER_FILES_PERSONAL_PHOTO" >
<!--    <div class="preview">-->
<!--      <button class="preview__remove" type="button">x</button>-->
<!--      <div class="preview__img">-->
<!--        <img src="" width="113" height="113" alt="Ваш аватар">-->
<!--      </div>-->
<!--    </div>-->
<!--    <div class="form__input-file">-->
<!--      <input class="visually-hidden" id="photo2" type="file" name="REGISTER_FILES_PERSONAL_PHOTO" >-->
<!---->
<!--      <label for="photo2">-->
<!--        <span>+ Добавить</span>-->
<!--      </label>-->
<!--    </div>-->
  </div>
  <input class="visually-hidden" type="text" name="REGISTER[LOGIN]" value="qqq" />
  <input class="visually-hidden" type="text" name="REGISTER[CONFIRM_PASSWORD]" value="123456" />
  <input type="submit" class="button" name="register_submit_button" value="Зарегистрироваться" />
  <a class="text-link" href="/auth/">Уже есть аккаунт</a>
</form>
<?endif?>
</div>