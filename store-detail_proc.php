<?php
include_once 'db/db_store_and_menu.php';

$store_num = $_GET['store_num'];
$user_num = $_GET['user_num'];
$store_like = $_GET['store_like'];

$param = [
  'store_num' => $store_num,
  'user_num' => $user_num,
  'store_like' => $store_like
];

print json_encode($param);
$sel_result = sel_store_like($param);
if (isset($sel_result)) {
  $store_like = "1";
} else {
  $store_like = "0";
}
if ($store_like !== "0") { //이미 좋아요를 누른 경우 기존 좋아요 삭제
  // 내역 삭제
  $del_result = del_store_like($param);
  $store_like = "0";
} else {
  // 내역 생성
  $ins_result = ins_store_like($param);
  $store_like = "1";
}
