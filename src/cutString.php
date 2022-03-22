<?php
//функция обрезки строки
function cutString($line, $length = 12, $appends = '...'): string
{
    if (strlen($line) > $length) {
        return mb_strimwidth($line, 0, $length, $appends);
    } else {
        return $line;
    }
}
