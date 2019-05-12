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
?>
<?
if (!empty($arResult['ITEMS']))
{
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

	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
//		echo '<pre>'; var_dump($arResult["NAME"]); echo '</pre>';

//	$res = CIBlockSection::GetByID($_GET["GID"]);
//	if($ar_res = $res->GetNext())
//		echo $ar_res['NAME'];

?>

  <div class="container">
  <section class="lots">
  <h2>Все лоты в категории <span>«<? echo $arResult["NAME"]; ?>»</span></h2>
  <ul class="lots__list">
<?
foreach ($arResult['ITEMS'] as $key => $arItem)
{

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);

	$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

	$productTitle = (
		isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $arItem['NAME']
	);
	$imgTitle = (
		isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $arItem['NAME']
	);

	$minPrice = false;
	if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
		$minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
//-----------
//	echo '<pre>'; var_dump($arItem); echo '</pre>';
	?>
  <li class="lots__item lot" id="<? echo $strMainID; ?>">
    <div class="lot__image">
      <img src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" width="350" height="260" alt="<? echo $imgTitle; ?>">
    </div>
    <div class="lot__info">
      <span class="lot__category"><? echo $arResult["NAME"]; ?></span>
      <h3 class="lot__title"><a class="text-link" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" title="<? echo $productTitle; ?>">"<? echo $productTitle; ?>"</a></h3>
      <div class="lot__state">
        <div class="lot__rate">
          <span class="lot__amount"><?=(!empty($arItem["DISPLAY_PROPERTIES"]["CNT_ST"]["DISPLAY_VALUE"])? $arItem["DISPLAY_PROPERTIES"]["CNT_ST"]["DISPLAY_VALUE"]." ставок":"Стартовая цена"); ?></span>
          <? $priceSt = $arItem["DISPLAY_PROPERTIES"]["PRICE_CUR"]["DISPLAY_VALUE"]; ?>
          <span class="lot__cost"><?echo ($priceSt);?><b class="rub">р</b></span>

        </div>
				<?
			  $stmp = MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["DATE_FIN"]["DISPLAY_VALUE"], "DD.MM.YYYY");
				$date1 = new DateTime(); $date1->setTimestamp($stmp);
				$date2 = new DateTime();
        if ($date1 > $date2 ) {
					$dDiffA = $date2->diff($date1)->format('%a');
					$dDiff = ($dDiffA >= 1 ? $dDiffA . "дн." : $date2->diff($date1)->format('%H:%I:%S'));
				} else $dDiff = '00:00:00';?>
        <div class="lot__timer timer">
          <?= $dDiff?>
        </div>
      </div>
    </div>
  </li>
  <?}?>
  </ul>
  </section>
<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	} ?>
	</div>
<?
}?>