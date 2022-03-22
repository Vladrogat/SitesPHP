<?php
//данные подключения базы данных
$host = 'newgrade.vpool';
$user = 'test';
$password = 'test';
$dbname = 'rogatyxv_qschool_test';
//функция получения поключения бд
function getConnection($host  = 'newgrade.vpool', $user = 'test', $password ='test', $database = 'rogatyxv_qschool_test')
{
    static $connection;
    if (null === $connection) {
       $connection = new mysqli($host, $user, $password, $database);
    }
   return $connection;
}
//функция добавления пользователя
function addUser($connect, $flag, $fio, $email, $phone, $password, $notif)
{
    //защита от sql инъекции
    $flag = mysqli_real_escape_string($connect, $flag);
    $email = mysqli_real_escape_string($connect, $email);
    $fio = mysqli_real_escape_string($connect, $fio);
    $phone = mysqli_real_escape_string($connect, $phone);
    $password = mysqli_real_escape_string($connect, $password);
    $notif =mysqli_real_escape_string($connect, $notif);
    //хеширования пароля
    $password = md5($password);
    //определение соглашения на уведомление
    $notif = $notif === "on" ? "согласен" : $notif;
    $phone = str_replace("+7", "8", $phone);
    //запрос на добавление в бд
    $sql = "INSERT INTO users (activity_flag, fio, email, phone, password, sending_notification) 
    VALUES ('$flag', '$fio', '$email', '$phone',  '$password', '$notif')";
    mysqli_query($connect, $sql);
}
//функция поверки авторизации
function getAvtoriz($connect, $email, $password)
{
    //защита от sql инъекции
    $email = mysqli_real_escape_string($connect, $email);
    $password = mysqli_real_escape_string($connect, md5($password));
    //запрос на получение данных по введенным паролю и почте
    $sql = "SELECT * FROM users WHERE email = '$email'  and password = '$password' LIMIT 1";
    $result = mysqli_fetch_assoc($connect->query($sql));
    return $result;
}

function getUser($connect, $id)
{
    //защита от sql инъекции
    $id = mysqli_real_escape_string($connect, $id);
    //получение пользователя по ид
    $sql = "SELECT * FROM users WHERE id = '$id' LIMIT 1;";
    $result = mysqli_fetch_assoc($connect->query($sql));
    return $result;
}

function getGroups($connect, $id)
{
    //защита от sql инъекции
    $id = mysqli_real_escape_string($connect, $id);
    //заапрос на получение групп пользователя
    $sql = "SELECT name, description FROM group_user
        join users on users.id = id_user
        join groups on groups.id = id_group
        WHERE users.id = '$id';";
    $result = $connect->query($sql);
    $groups = [];
    while ($res = mysqli_fetch_assoc($result)) {
        $groups[] = $res;
    }
    return $groups;
}
