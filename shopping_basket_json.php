<?php

$menus = json_decode($_GET['menus']);


include_once('db/db_store_and_menu.php');

$param = $menus;



$result = get_menus_for_shopping($param);

$list = [
    // 'length' => 0
];
foreach ($result as $row) {
    $num = $row['menu_num'];
    $list[$num] = $row;
    // $list['length'] += 1;
}

$list_json = json_encode($list);

print $list_json;
