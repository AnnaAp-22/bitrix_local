<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<form class="main-header__search"  action="<?=$arResult["FORM_ACTION"]?>">
  <input type="text" class="main-header__search-fld" name="q" placeholder="Поиск лота">
  <input class="main-header__search-btn" type="submit" name="s" value="Найти">
</form>
