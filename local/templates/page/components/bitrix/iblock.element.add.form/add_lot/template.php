<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);

if (!empty($arResult["ERRORS"])):?>
	<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<form class="form form--add-lot container " name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?><h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item "> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="PROPERTY[NAME][0]" placeholder="Введите наименование лота" >

      </div>
      <div class="form__item">
        <label for="category">Категория</label>
        <select id="category" name="PROPERTY[IBLOCK_SECTION][]" >
          <option value="">(не установлено)</option>
					<?
          foreach ($arResult["PROPERTY_LIST_FULL"]["IBLOCK_SECTION"]["ENUM"] as $key => $arEnum)
					{?>
            <option value="<?=$key?>"><?=$arEnum["VALUE"]?></option>
						<?
					}
					?>
        </select>
      </div>
    </div>
    <div class="form__item form__item--wide">
      <label for="message">Описание</label>
      <textarea id="message" name="PROPERTY[DETAIL_TEXT][0]" placeholder="Напишите описание лота" ></textarea>

    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label id="photox">Изображение</label>

      <input type="hidden" name="PROPERTY[DETAIL_PICTURE][0]" value="">
      <input id="photox" type="file"  name="PROPERTY_FILE_DETAIL_PICTURE_0">

<!--      <div class="preview">-->
<!--        <button class="preview__remove" type="button">x</button>-->
<!--        <div class="preview__img">-->
<!--          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="form__input-file">-->
<!--        <input class="visually-hidden" type="file" id="photo2" value="">-->
<!--        <label for="photo2">-->
<!--          <span>+ Добавить</span>-->
<!--        </label>-->
<!--      </div>-->
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="PROPERTY[2][0]" placeholder="0"  >
        <span class="form__error">Введите начальную цену</span>
      </div>
      <div class="form__item form__item--small">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="PROPERTY[4][0]" placeholder="0" >
        <span class="form__error">Введите шаг ставки</span>
      </div>
<!--      <div class="form__item">-->
<!--        <label for="lot-date">Дата окончания торгов</label>-->
<!--        <input class="form__input-date" id="lot-date" type="date" name="PROPERTY[DATE_ACTIVE_TO][0]" >-->
<!--        <span class="form__error">Введите дату завершения торгов</span>-->
<!--      </div>-->
      <div class="form__item">
        <label for="lot-date">Дата окончания торгов</label>
        <input  id="lot-date" type="text" name="PROPERTY[6][0]" placeholder="Дата завершения торгов" /><?
//         if($arResult["PROPERTY_LIST_FULL"]["DATE_ACTIVE_TO"]["USER_TYPE"] == "DateTime"):
				$APPLICATION->IncludeComponent(
					'bitrix:main.calendar',
					'',
					array(
						'FORM_NAME' => 'iblock_add',
						'INPUT_NAME' => "PROPERTY[6][0]",
						'INPUT_VALUE' => '',
						'SHOW_TIME' => 'N',
					),
					null,
					array('HIDE_ICONS' => 'Y')
				);
?>
        <span class="form__error">Введите дату завершения торгов</span>
      </div>
    </div>
<!--    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>-->

  <input class="button" type="submit" name="iblock_submit" value="Добавить лот" />
  </form>

