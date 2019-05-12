<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul class="promo__list">
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>

    <?
    switch ($arItem["TEXT"]) {
        case 'Доски и лыжи':
            $addClass = "promo__item--boards";
            break;
        case 'Крепления':
            $addClass = "promo__item--attachment";
            break;
        case 'Ботинки':
            $addClass = "promo__item--boots";
            break;
        case 'Одежда':
            $addClass = "promo__item--clothing";
            break;
        case 'Инструменты':
            $addClass = "promo__item--tools";
            break;
        case 'Разное':
            $addClass = "promo__item--other";
            break;
        default:
            $addClass ="";
            break;
    }
    ?>
  <li class="promo__item <?=$addClass?> "><a class="promo__link " href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>

<?endforeach?>

</ul>
<?endif?>
