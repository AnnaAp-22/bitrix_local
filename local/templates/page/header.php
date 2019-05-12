<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?$APPLICATION->ShowHead();
		use Bitrix\Main\Page\Asset;
		// CSS
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/normalize.min.css');
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/template_styles.css');
    ?>
    <title><?$APPLICATION->ShowTitle()?></title>

<!--    <link href="--><?//=SITE_TEMPLATE_PATH?><!--/css/normalize.min.css" rel="stylesheet">-->
<!--    <link href="--><?//=SITE_TEMPLATE_PATH?><!--/css/template_styles.css" rel="stylesheet">-->

</head>
<body>
    <?$APPLICATION->ShowPanel()?>

    <div class="page-wrapper">

        <header class="main-header">
            <div class="main-header__container container">
                <h1 class="visually-hidden">YetiCave</h1>
                <a class="main-header__logo" <?=(CSite::InDir('/index.php')?"":"href='/'")?>>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/logo.php"
                        )
                    );?>
                </a>

                <?$APPLICATION->IncludeComponent(
                    "bitrix:search.form",
                    "search_form",
                    Array(
                        "PAGE" => "#SITE_DIR#search/index.php",
                        "USE_SUGGEST" => "N"
                    )
                );?>
							<?if ($USER->IsAuthorized()):?>
                <a class="main-header__add-lot button" href="/add-lots/">Добавить лот</a>
              <?endif?>
              <nav class="user-menu">
                <?if ($USER->IsAuthorized()):
                    $dbUser = CUser::GetByID($USER->GetID());
                    $arUser = $dbUser->Fetch();
                    ?>

                    <a class="user-menu__image" href="/auth/profile.php">
                      <img src="<?=CFile::GetPath($arUser["PERSONAL_PHOTO"])?>" width="40" height="40" alt="Пользователь">
                    </a>
                    <div class="user-menu__logged">
                      <p><?=$arUser["NAME"]?></p>
<!--                      <a href="/auth/?logout=yes">Выйти</a>-->
                      <a href="<?=$APPLICATION->GetCurPageParam("logout=yes", array(
												"login",
												"logout",
												"register",
												"forgot_password",
												"change_password"))?>">Выйти</a>
                    </div>

                <?else:?>

                    <ul class="user-menu__list">
                      <li class="user-menu__item">
                        <noindex><a href="/auth/registration.php" rel="nofollow">Регистрация </a></noindex>
<!--                        <a href="/auth/registration.php">Регистрация</a>-->
                      </li>
                      <li class="user-menu__item">
                        <a href="/auth/">Вход</a>
                      </li>
                    </ul>

                <?endif?>
              </nav>

            </div>
        </header>
      <?if(CSite::InDir('/index.php')) { ?>
<!--    Главная-->
      <main class="container">
        <section class="promo">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "page",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => ""
                )
            );?>

            <?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu_main", Array(
                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                "DELAY" => "N",	// Откладывать выполнение шаблона меню
                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                    0 => "",
                ),
                "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            ),
                false
            );?>

        </section>

     <? }else{?>
        <main>
        <? include_once( $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include/menu_top.php");?>
      <?}?>
