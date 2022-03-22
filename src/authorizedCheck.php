<?php
//проверка авторизован ли пользователь по сессии 
function authorizedCheck() : bool
{
    return !empty($_SESSION) && $_SESSION["isAuthorized"] == true;
}
