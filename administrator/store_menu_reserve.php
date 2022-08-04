<?php
include_once '../db/db_store.php';
$user_num =  $_POST['user_num'];
$store_nm =  $_POST['store_nm'];
$menu_nm =  $_POST['menu_nm'];
$not_type =  $_POST['not_type'];
$menu_num =  $_POST['menu_num'];
$not_url = "review_write.php?menu_num=" . $menu_num;
$not_read_check =  $_POST['not_read_check'];
$sub_num = $_POST['sub_num'];
$remain_count = $_POST['remain_count'];

if(not_reserve($user_num, $store_nm, $menu_nm, $not_type,$not_url,$not_read_check)){
    remaining_count($remain_count, $sub_num);
    accept2($sub_num);
    header('location: store_main.php');
}else {
    header('location: store_main.php');
}
