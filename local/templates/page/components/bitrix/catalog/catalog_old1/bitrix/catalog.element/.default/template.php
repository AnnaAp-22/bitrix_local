<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BASIS_PRICE' => $strMainID.'_basis_price',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'BASKET_ACTIONS' => $strMainID.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);
reset($arResult['MORE_PHOTO']);
$arFirstPhoto = current($arResult['MORE_PHOTO']);
//echo '<pre>'; var_dump($arResult); echo '</pre>';
?>

<section class="lot-item container" id="<? echo $arItemIDs['ID']; ?>">
  <h2><?	$sect =$arResult["SECTION"]["NAME"];
echo (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
	: $arResult["NAME"]
);?></h2>
  <div class="lot-item__content">
    <div class="lot-item__left">
      <div class="lot-item__image">
        <img id="<? echo $arItemIDs['PICT']; ?>" src="<? echo $arFirstPhoto['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>" width="730" height="548">
      </div>
      <p class="lot-item__category">Категория: <span><? echo $sect; ?></span></p>
      <p class="lot-item__description"><? echo $arResult['DETAIL_TEXT']; ?></p>
    </div>
    <div class="lot-item__right">
      <div class="lot-item__state">
				<?
				$stmp = MakeTimeStamp($arResult["DISPLAY_PROPERTIES"]["DATE_FIN"]["DISPLAY_VALUE"], "DD.MM.YYYY");
				$date1 = new DateTime(); $date1->setTimestamp($stmp);
				$date2 = new DateTime();
				if ($date1 > $date2 ) {
					$dDiffA = $date2->diff($date1)->format('%a');
					$dDiff = ($dDiffA >= 1 ? $dDiffA . "дн." : $date2->diff($date1)->format('%H:%I:%S'));
				} else $dDiff = '00:00:00';
				?>
        <div class="lot-item__timer timer">
					<?= $dDiff?>
        </div>
        <div class="lot-item__cost-state">
          <div class="lot-item__rate">
            <span class="lot-item__amount">Текущая цена</span>
            <span class="lot-item__cost"><?= $arResult["DISPLAY_PROPERTIES"]["PRICE_CUR"]["DISPLAY_VALUE"];?></span>
          </div>
          <div class="lot-item__min-cost">
            Мин. ставка <span><?= $arResult["DISPLAY_PROPERTIES"]["PRICE_CUR"]["DISPLAY_VALUE"] + $arResult["DISPLAY_PROPERTIES"]["STEP_ST"]["DISPLAY_VALUE"];?> р</span>
          </div>
        </div>
				<?
				if ($USER->IsAuthorized()){?>
        <form class="lot-item__form" action="<?=POST_FORM_ACTION_URI?>" method="post">
          <div class="lot-item__form-item">
            <label for="cost">Ваша ставка</label>
            <input id="cost" type="number" name="cost" placeholder="<?= $arResult["DISPLAY_PROPERTIES"]["PRICE_CUR"]["DISPLAY_VALUE"] + $arResult["DISPLAY_PROPERTIES"]["STEP_ST"]["DISPLAY_VALUE"];?>">
            <input  type="hidden" name="lot"  value=<?= $arResult['ID']?>>
            <input  type="hidden" name="section"  value="<?= $sect ?>">
            <input  type="hidden" name="costMin"  value=<?= ($arResult["DISPLAY_PROPERTIES"]["PRICE_CUR"]["DISPLAY_VALUE"] + $arResult["DISPLAY_PROPERTIES"]["STEP_ST"]["DISPLAY_VALUE"]);?>>

          </div>
          <button type="submit" class="button">Сделать ставку</button>
        </form>
        <?}?>
      </div>
      <div class="history">
        <? if(empty($arResult["DISPLAY_PROPERTIES"]["CNT_ST"]["DISPLAY_VALUE"])){?>
					<h3>Ставок нет</h3>
        <table class="history__list">
       <? }else{?>
        <h3>История ставок (<span><?=$arResult["DISPLAY_PROPERTIES"]["CNT_ST"]["DISPLAY_VALUE"]?></span>)</h3>
        <table class="history__list">
					<?foreach($arResult["BET_LINK"] as $key=>$arItem):?>
						<?
//						$stmp = MakeTimeStamp($arItem["DATE_ACTIVE_FROM"], CSite::GetDateFormat());
//						$date1 = new DateTime(); $date1->setTimestamp($stmp);
//						$date2 = new DateTime();
//						$dDiffh = $date2->diff($date1)->format('%h');
//						if ($dDiffh < 1){
//							$dDiff = FormatDate("iago", $stmp);
//            }elseif($dDiffh <= 12){
//							$dDiff = FormatDate("Hago", $stmp);
//            }else $dDiff = '00:00:00';
//						if ($date1 > $date2 ) {
//							$dDiffA = $date2->diff($date1)->format('%a');
//							$dDiff = ($dDiffA >= 1 ? $dDiffA . "дн." : $date2->diff($date1)->format('%H:%I:%S'));
//						} else $dDiff = '00:00:00';
//						$dDiff = FormatDate("x", $stmp);
						?>
          <tr class="history__item">
            <td class="history__name"><?=preg_replace("~\(.*\)~", "", $arItem["CREATED_USER_NAME"]) ?> </td>
            <td class="history__price"><?= $arItem["PROPERTY_PRICE_VALUE"]?></td>
<!--            <td class="history__time">--><?//= $arItem["DATE_ACTIVE_FROM"]?><!--</td>-->
            <td class="history__time"><?= FormatDate("x", MakeTimeStamp($arItem["DATE_ACTIVE_FROM"], CSite::GetDateFormat()))?></td>
          </tr>
					<?endforeach;
        }?>

        </table>
      </div>
    </div>
  </div>
</section>
<!---->

<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
BX.message({
	ECONOMY_INFO_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO'); ?>',
	BASIS_PRICE_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_BASIS_PRICE') ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
	BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE'); ?>',
	BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
	TITLE_SUCCESSFUL: '<? echo GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK'); ?>',
	COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
	COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
	COMPARE_TITLE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
	BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
	SITE_ID: '<? echo SITE_ID; ?>'
});
</script>