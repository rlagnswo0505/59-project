<?php
    include_once('db/db_sub.php');
    $param = [
        'store_num' => $_GET['store_num']
    ];
    $result = search_now_reservation_for_store($param);
    $now_reserve = [];
    foreach($result as $list) {
        if($list['cd_sub_status'] == 0 ) {
        array_push($now_reserve, $list);
        }
    }
    // print_r($now_reserve);
    $now_reserve_json = json_encode($now_reserve);
    print $now_reserve_json;