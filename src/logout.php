<?php
//выход из профиля
session_start();
session_destroy();
header("Location: /");
exit();
