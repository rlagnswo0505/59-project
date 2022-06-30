<?php
    include_once('db/db_sub.php');
    $param = [
        'user_num' => $_GET['user_num']
    ];
    $result = search_now_reservation_for_user($param);
    $now_reserve = [];
    foreach($result as $list) {
        if($list['cd_sub_status'] != 9) {
        array_push($now_reserve, $list);
        }
    }

    $now_reserve_json = json_encode($now_reserve);
    print $now_reserve_json;