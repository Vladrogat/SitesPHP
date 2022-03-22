<?php
//функция определения выделенного пункта по текущему url
function isSelectedChapter($url, $path) : bool
{
    $url = parse_url($url);
    return $url['path'] == $path ;
}
