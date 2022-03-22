<?php

require dirname(__DIR__) . "/templates/header.php";
//если пользователь не авторизован но происходит редирект на главную страницу
if (!authorizedCheck()) {
    header("Location: /");
    exit();
} else { ?>
<main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
    <div class="py-4 pb-8">
        <h1 class="text-black text-3xl font-bold mb-4">Каталог</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
            <?php includeTemplate('cars_catalog.php', ['cars' => getCars()]);?>
        </div>
    </div>
</main>
<?php require dirname(__DIR__) . "/templates/footer.php";
}?>
