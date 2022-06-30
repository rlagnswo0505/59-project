<?php

include_once "db/db_user.php";

session_start();
$login_user = $_SESSION['login_user'];
$user_num = $login_user['user_num'];

print $user_num;

$param = [
    'user_num' => $user_num
];

user_dropout($param);
header("Location: login.php");