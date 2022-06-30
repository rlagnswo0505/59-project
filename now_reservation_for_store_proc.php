<?php

$now_res = json_decode($_POST['nowResJson'], true);

print_r($now_res);
include_once('db/db_sub.php');
$param = [
    'sub_num' => $now_res[0]['sub_num'],
    'used_at' => $now_res[0]['used_at']
];

$result = change_cd_sub_status($param);

if ($result) {
    header('Location: administrator/store_main.php');
} else {
    echo "<script>alert('오류가 발생했습니다');
    window.location.href = 'Location: administrator/store_main.php';</script>";
}
