<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (CUser::IsAuthorized()) {
	header('Location: /?login=yes');
}
CJSCore::Init();
?>

<div class="bx-system-auth-form">

<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);

?>

<?if($arResult["FORM_TYPE"] == "login"):?>

<form class="form container" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
	<?foreach ($arResult["POST"] as $key => $value):?>
    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
	<?endforeach?>
  <input type="hidden" name="AUTH_FORM" value="Y" />
  <input type="hidden" name="TYPE" value="AUTH" />
  <h2>Вход</h2>
  <div class="form__item"> <!-- form__item--invalid -->
    <label for="email">E-mail*</label>
    <input id="email" type="text" name="USER_LOGIN" placeholder="Введите e-mail" value="">
    <script>
      BX.ready(function() {
        var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
        if (loginCookie)
        {
          var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
          var loginInput = form.elements["USER_LOGIN"];
          loginInput.value = loginCookie;
        }
      });
    </script>
  </div>
  <div class="form__item form__item--last">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="USER_PASSWORD" autocomplete="off" placeholder="Введите пароль" />

  </div>
  <input type="submit" class="button" name="Login" value="Войти" />


</form>
<?
else:
?>
<form action="<?=$arResult["AUTH_URL"]?>">
	<table width="95%">
		<tr>
			<td align="center">
				<?=$arResult["USER_NAME"]?><br />
				[<?=$arResult["USER_LOGIN"]?>]<br />
				<a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=GetMessage("AUTH_PROFILE")?></a><br />
			</td>
		</tr>
		<tr>
			<td align="center">
			<?foreach ($arResult["GET"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			<input type="hidden" name="logout" value="yes" />
			<input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
			</td>
		</tr>
	</table>
</form>
<?endif?>
</div>
