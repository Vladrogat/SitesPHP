<?php
//получение доступных пунктов менюменю
function getMenu() : array
{
    $menu = [
        [
            'title' => 'Главная',
            'path' => '/',
            'sort' => 10,
        ],
        [
            'title' => 'Раздел 1',
            'path' => '/chapter1/',
            'sort' => 12,
        ],
        [
            'title' => 'Раздел 2',
            'path' => '/chapter2/',
            'sort' => 15,
        ],
        [
            'title' => 'Раздел 3',
            'path' => '/chapter3/',
            'sort' => 18,
        ],
    ];
    //если пользователь автоизован то добавляем пункт каталог
    if (authorizedCheck()) {
        array_push($menu, [
            'title' => 'Каталог',
            'path' => '/catalog/',
            'sort' => 20,
        ]);
    }
    //сортируем по возрастанию пункты меню по ключу "sort"
    $menu = arraySort($menu, 'sort', SORT_ASC);
    return $menu;
}
