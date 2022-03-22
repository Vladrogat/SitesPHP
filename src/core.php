<?php
//подключение всех функций в файлах
session_start();
require "authorizedCheck.php";
require "includeTemplate.php";
require "cutString.php";
require "arraySort.php";
require "getMenu.php";
require "selectChapter.php";
require "getCars.php";
//продление куки при переходе по страницам
if (authorizedCheck()) {
    setcookie("email", $_COOKIE["email"], time() + 60 * 60 * 24 * 31, "/");
}
