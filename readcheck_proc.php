<?php

include_once "db/db_user.php";

session_start();
$login_user = $_SESSION['login_user'];
$user_num = $login_user['user_num'];

$not_num = $_GET['not_num'];

$param = [
    'not_num' => $_GET['not_num']
];

$val = sel_today($param);

if($user_num !== $val['user_num'])
{ ?>
<script>
    alert("잘못된 접근입니다.")
    location.href = "mypage.php"
</script>
<?php
}

$not_url = $val['not_url'];

$result = upd_read($param);

    header("Location: $not_url");




