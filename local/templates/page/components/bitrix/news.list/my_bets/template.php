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
<section class="rates container">
  <h2>Мои ставки</h2>
  <table class="rates__list">
		<?if ($USER->IsAuthorized()):?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
			<? $arLink = $arItem["DISPLAY_PROPERTIES"]["LOT_LINK"];
			$idLot =intval($arLink["VALUE"]);
//	echo '<pre>'; var_dump($arItem); echo '</pre>';
			$pict =$arLink["LINK_ELEMENT_VALUE"][$idLot]["PREVIEW_PICTURE"];
			$picture = CFile::ShowImage($pict, 54, 40, "border=0", "", true);
//			echo $picture;
      $idStat = $arItem["DISPLAY_PROPERTIES"]["STATUS"]["VALUE_ENUM_ID"];
			?>
      <tr class="rates__item<?($idStat== "5"?" rates__item--end":"" )?> <?($idStat== "6"?" rates__item--win":"" )?>">
        <td class="rates__info">
          <div class="rates__img">
            <? echo $picture;?>
          </div>
          <div>
          <h3 class="rates__title">
            <?= $arLink["DISPLAY_VALUE"];?>
          </h3>
          </div>
        </td>
        <td class="rates__category">
          <?= $arItem["DISPLAY_PROPERTIES"]["SECTION"]["DISPLAY_VALUE"]?>
        </td>
        <td class="rates__timer">
          <div class="timer timer">
            <? if($arItem["DISPLAY_PROPERTIES"]["STATUS"]["VALUE_ENUM_ID"] == '4'){
              $db_props = CIBlockElement::GetProperty(1, $idLot, array("sort" => "asc"), Array("CODE"=>"DATE_FIN"));
							if($ar_props = $db_props->Fetch())
								$DATE_FIN = $ar_props["VALUE"];
//
//							$stmp = MakeTimeStamp($arResult["DISPLAY_PROPERTIES"]["DATE_FIN"]["DISPLAY_VALUE"], "DD.MM.YYYY");
							$date1 = new DateTime(); $date1->setTimestamp(MakeTimeStamp($DATE_FIN, "DD.MM.YYYY"));
							$date2 = new DateTime();
							if ($date1 > $date2 ) {
								$dDiffA = $date2->diff($date1)->format('%a');
								$dDiff = ($dDiffA >= 1 ? $dDiffA . "дн." : $date2->diff($date1)->format('%H:%I:%S'));
							} else $dDiff = '00:00:00';
							?>
							<?= $dDiff?>
          <?}else{?>
						<?= $arItem["DISPLAY_PROPERTIES"]["STATUS"]["DISPLAY_VALUE"] ?>
         <?   }?>
          </div>
        </td>
        <td class="rates__price">
					<?= $arItem["DISPLAY_PROPERTIES"]["PRICE"]["DISPLAY_VALUE"]?>
        </td>
        <td class="rates__time">
					<?= FormatDate("x", MakeTimeStamp($arItem["ACTIVE_FROM"], CSite::GetDateFormat()))?>
        </td>
      </tr>
		<? endforeach;?>
		<?endif?>
  </table>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
      <br /><?=$arResult["NAV_STRING"]?>
		<?endif;?>
</section>


