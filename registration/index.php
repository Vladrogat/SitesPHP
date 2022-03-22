<?php
$isRegistration = $isEror = $isErorPassword = $isErorLowPassword = false;
require_once dirname(__DIR__) . "/templates/header.php";
//проверка авторизованности
if (authorizedCheck()) {
    //есил авторизован то происходит редирект на главную страницу
    header("Location: /");
    exit();
}
//если был отправлен post
if (!empty($_POST)) {
    //---------валидация полей-----------//

    //проверка заполненности полей
    foreach ($_POST as $key => $value) {
        if (trim($value) === "") {
            $isEror = true;
            break;
        }
    }
    if (!$isEror) {
        include dirname(__DIR__) . "/data/dbConnect.php";
        //получение подключения к бд
        $connect = getConnection();
        extract($_POST);
        //совпадение пароля и подтверждения
        if ($password !== $confirm_password) {
            $isErorPassword = true;
        } else {
            if (strlen($password) < 6) {
                $isErorLowPassword = true;
            } else {
                //регистрация
                addUser($connect, "активен", $fio, $email, $phone, $password, $sending_notification ?? "не согласен");
            }
        }
        include dirname(__DIR__) . "/data/dbclose.php";
    }
}
?>
<main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
    <div class="py-4 pb-8">
        <div class="ml-15 m-5 gap-6">
            <?php
            //вывод сообщения по результатм валидации
            if ($isEror) {
                includeTemplate('messages/error_message.php', ['message' => 'Введите все поля']);
            } elseif ($isErorLowPassword) {
                includeTemplate('messages/error_message.php', ['message' => 'Пароль должен быть не меньше 6 символов']);
            } elseif ($isErorPassword) {
                includeTemplate('messages/error_message.php', ['message' => 'Пароли не совпадают']);
            } elseif ($isRegistration) {
                includeTemplate('messages/success_message.php', ['message' => 'Вы успешно зарегистрировались']);
                header("Location: /login/");
            }
            ?>
            
            <form action="#" method="post">
                <div class="flex-1 container m-auto overflow-hidden px-4 sm:px-6 mt-8 max-w-md">
                    <h1 class="text-black text-3xl font-bold mb-4">Регистрация</h1>
                    <div class="grid grid-cols-1 gap-5">
                        <div class="block">
                            <label for="fieldFio" class="text-gray-700 font-bold">ФИО*</label>
                            <input id="fieldFio" name="fio" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Иванов Иван Иванович">
                        </div>
                        <div class="block">
                            <label for="fieldEmail" class="text-gray-700 font-bold">Email*</label>
                            <input id="fieldEmail" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com">
                        </div>
                        <div class="block">
                            <label for="fieldPhone" class="text-gray-700 font-bold">Телефон*</label>
                            <input id="fieldPhone" name="phone" type="tel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="+7(ХХХ)-ХХХ-ХХ-ХХ">
                        </div>
                        <div class="block">
                            <label for="fieldPassword" class="text-gray-700 font-bold">Пароль*</label>
                            <input id="fieldPassword" name="password"  type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="******">
                        </div>
                        <div class="block">
                            <label for="fieldConfirmPassword" class="text-gray-700 font-bold">Подтверждение пароля*</label>
                            <input id="fieldConfirmPassword" name="confirm_password"  type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="******">
                        </div>
                        <div class="block"> 
                            <input id="fieldNotification" name="sending_notification"  type="checkbox" class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="******">
                            <label for="fieldNotification" class="text-gray-700 font-bold">Согласие на получение уведомлений по email</label>
                        </div>
                        <div class="block">
                            <input type="submit" value="Зарегистрироваться" class="w-full inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<?php require_once dirname(__DIR__) . "/templates/footer.php";?>