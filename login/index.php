<?php
require_once dirname(__DIR__) . "/templates/header.php";
//----------------логика формы-------------//
$isAuthorization = $isEror = $isNoActiv =  false;
//проверка на пустоту передаваемые значения post
if (!empty($_POST)) {

    $isAuthorization = false;
    $isEror = true;


    include dirname(__DIR__) . "/data/dbConnect.php";
    //подключение к бд
    $connect = getConnection();
    //проверка полей на сервере
    if ($result = getAvtoriz($connect, $_POST['email'], $_POST['password'])) {
            if ($row["activity_flag"] == "неактивен") {
                $isAuthorization = $isEror =  false;
                $isNoActiv =  true;
            } else {
                $isAuthorization = true;
                $isEror = false;
                $_SESSION["isAuthorized"] = $isAuthorization;
                $_SESSION['name'] = $result["fio"];
                $_SESSION['id'] = $result["id"];
                //создание куки сохраняя почту на месяц 
                setcookie("email", $result["email"], time() + 60 * 60 * 24 * 31, '/');
                header("Location: /login/#");
            }
    } else {
        echo "Ошибка: " . mysqli_error($connect);
    }
    include dirname(__DIR__) . "/data/dbclose.php";
}

?>
<main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
    <div class="py-4 pb-8">
        <h1 class="text-black text-3xl font-bold mb-4">Авторизация</h1>
        <?php
        //вывод сообщения в зависимости от результат авторизации
        if ($isEror) {
            includeTemplate('messages/error_message.php', ['message' => 'Неверно указан логин или пароль']);
        } elseif ($isAuthorization) {
            includeTemplate('messages/success_message.php', ['message' => 'Вы успешно авторизовались']);
        } elseif ($isNoActiv) {
            includeTemplate('messages/error_message.php', ['message' => 'Доступ запрещен']);
        }?>
        
        <form action="#" method="post">
            <div class="mt-8 max-w-md">
                <div class="grid grid-cols-1 gap-6">
                    <div class="block">
                        <label for="fieldEmail" class="text-gray-700 font-bold">Email</label>
                        <input id="fieldEmail" value = "<?=isset($_POST['email']) && $isEror ? $_POST['email'] : (!empty($_COOKIE["email"]) && !authorizedCheck() ? $_COOKIE["email"] : ""); ?>" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com">
                    </div>
                    <div class="block">
                        <label for="fieldPassword" class="text-gray-700 font-bold">Пароль</label>
                        <input id="fieldPassword" value= "<?php echo isset($_POST['password']) && $isEror ? $_POST['password'] : "";?>"name="password"  type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="******">
                    </div>
                    <div class="block">
                        <input type="submit" value="Войти" class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                        <a href="/registration/" class="inline-block hover:underline focus:outline-none font-bold py-2 px-4 rounded">
                            У меня нет аккаунта
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </div>
</main>
<?php require_once dirname(__DIR__) . "/templates/footer.php";?>
