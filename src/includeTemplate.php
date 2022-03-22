<?php
//функция подключения шаблонов с передачей в них парпметров
function includeTemplate($templatePath, $data = [])
{
    extract($data);
    include dirname(__DIR__) . '/templates/' . ltrim($templatePath, '/');
}
