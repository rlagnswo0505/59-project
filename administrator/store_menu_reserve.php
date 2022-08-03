<?php
include_once '../db/db_store.php';
$user_num =  $_POST['user_num'];
$store_nm =  $_POST['store_nm'];
print $store_nm;
$menu_nm =  $_POST['menu_nm'];
$not_type =  $_POST['not_type'];
$menu_num =  $_POST['menu_num'];
$not_url = "review_write.php?menu_num=" . $menu_num;
$not_read_check =  $_POST['not_read_check'];

if(not_reserve($user_num, $store_nm, $menu_nm, $not_type,$not_url,$not_read_check)){
    header('location: store_main.php');
}
