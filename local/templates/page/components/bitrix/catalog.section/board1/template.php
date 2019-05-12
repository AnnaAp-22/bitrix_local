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
//	echo '<pre>'; var_dump($arResult); echo '</pre>';
?>
<section class="lots">
  <div class="lots__header">
    <h2><?=$arParams["PAGER_TITLE"]?></h2>
  </div>
  <ul class="lots__list">
	<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
	<?
//		echo '<pre>'; var_dump($arElement); echo '</pre>';
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
  $res = CIBlockSection::GetByID($arElement["IBLOCK_SECTION_ID"]);
	$secName ="";
  if($ar_res = $res->GetNext()) {
    $secName = $ar_res['NAME'];
  }
	?>
    <li class="lots__item lot">
      <div class="lot__image">
        <img src=<?=$arElement["PREVIEW_PICTURE"]["SRC"]?> width="350" height="260" alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>"
             title="<?=$arElement["PREVIEW_PICTURE"]["TITLE"]?>">
      </div>
      <div class="lot__info">
        <span class="lot__category"><?=$secName?></span>
        <h3 class="lot__title">
          <a class="text-link" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a>
        </h3>
        <div class="lot__state">
          <div class="lot__rate">
<!--            echo '<pre>'; var_dump($arElement); echo '</pre>';-->
            <span class="lot__amount"><?=(!empty($arElement["DISPLAY_PROPERTIES"]["CNT_ST"]["DISPLAY_VALUE"])? $arElement["DISPLAY_PROPERTIES"]["CNT_ST"]["DISPLAY_VALUE"]." ставок":"Стартовая цена"); ?></span>
            <span class="lot__cost"><?=$arElement["DISPLAY_PROPERTIES"]["PRICE_CUR"]["DISPLAY_VALUE"]; ?><b class="rub">р</b></span>
          </div>
					<?
					$stmp = MakeTimeStamp($arElement["DISPLAY_PROPERTIES"]["DATE_FIN"]["DISPLAY_VALUE"], "DD.MM.YYYY");
					$date1 = new DateTime(); $date1->setTimestamp($stmp);
					$date2 = new DateTime();
					if ($date1 > $date2 ) {
						$dDiffA = $date2->diff($date1)->format('%a');
						$dDiff = ($dDiffA >= 1 ? $dDiffA . "дн." : $date2->diff($date1)->format('%H:%I:%S'));
					} else $dDiff = '00:00:00';
					?>

          <div class="lot__timer timer">
						<?= $dDiff?>
          </div>
        </div>
      </div>
    </li>
	<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>
  </ul>
</section>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
  <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>