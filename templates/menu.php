
<ul class="list-inside bullet-list-item flex flex-wrap justify-between -mx-5 -my-2">
    <?php
    foreach ($menu as $value) {?>
        <li class="px-5 py-2">
            <a class="<?=isSelectedChapter($_SERVER['REQUEST_URI'], $value['path']) ? 'text-orange cursor-default' : "text-gray-600 hover:text-orange";?>"
            href="<?=$value['path']?>">
            <?=//обрезка названия пункта меню если в не больше 15 символов
            strlen($value['title']) > 15 ?
                //функция для обрезки названия на 12 символов заменяя остальные "..."
                cutString($value['title'], 12, "...") : $value['title'];?>
            </a>
        </li>
        <?php
    }?>
</ul>
