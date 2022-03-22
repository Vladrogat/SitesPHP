<?php

require_once dirname(__DIR__) . "/templates/header.php";
//если пользователь не авторизован но происходит редирект на главную страницу
if (!authorizedCheck()) {
    header("Location: /");
    exit();
}
include dirname(__DIR__) . "/data/dbConnect.php";
//получение подключения к бд
$connect = getConnection();
//получить пользоателя и его группы по ид хранящейся в сессии
$result = getUser($connect, $_SESSION['id']);
$groups = getGroups($connect, $_SESSION['id']);
//вывод данных о пользователе
?>
<main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
    <div class="py-4 pb-8">
        <div class="ml-15 m-5 gap-6">
            <h1 class="text-black text-3xl font-bold m-4"><?=$result["fio"];?></h1>
            <ul>
                <li><span style="font-size: 15pt;">Активность пользователя:</span> <?=$result['activity_flag'];?></li>
                <li><span style="font-size: 15pt;">Почта: </span><?=$result['email']?></li>
                <li><span style="font-size: 15pt;">Телефон: </span><?=$result['phone']?></li>
                <li><span style="font-size: 15pt;"> Согласие на получение уведомлений по email: </span><?=$result['sending_notification']?></li>
                <p style="font-size: 15pt;">Группы:</p>
                <ul>
                <?php foreach ($groups as $group) { ?>
                    <li>Имя: <?=$group['name']?> - Описание: <?=$group['description'] ?? ""?></li>
                <?php }?>
                </ul>
            </ul>
        </div>
    </div>
</main>
    <?php require_once dirname(__DIR__) . "/templates/footer.php";?>
