  </main>
</div>

<footer class="main-footer">
    <? include_once( $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include/menu.php");?>

<!--  <nav class="nav">-->
<!--        --><?//$APPLICATION->IncludeComponent("bitrix:menu", "top_menu", Array(
//            "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
//            "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
//            "DELAY" => "N",	// Откладывать выполнение шаблона меню
//            "MAX_LEVEL" => "1",	// Уровень вложенности меню
//            "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
//                0 => "",
//            ),
//            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
//            "MENU_CACHE_TYPE" => "N",	// Тип кеширования
//            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
//            "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
//            "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
//        ),
//            false
//        );?>
<!--  </nav>-->
    <div class="main-footer__bottom container">
        <div class="main-footer__copyright">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/copyright.php"
                )
            );?>
        </div>
        <div class="main-footer__social social">
            <span class="visually-hidden">Мы в соцсетях:</span>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/social.php"
                )
            );?>
        </div>
			<?if ($USER->IsAuthorized()):?>
        <a class="main-footer__add-lot button" href="/add-lots/">Добавить лот</a>
			<?endif?>
        <div class="main-footer__developed-by">
            <span class="visually-hidden">Разработано:</span>
            <a class="logo-academy" href="https://htmlacademy.ru/intensive/php">
                <span class="visually-hidden">HTML Academy</span>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/logo_ac.php"
                    )
                );?>
            </a>
        </div>
    </div>
</footer>

</body>
</html>
