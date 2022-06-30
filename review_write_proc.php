<?php
include_once 'db/db_review.php';

$param = [
  'store_num' => $_POST['store_num'],
  'user_num' => $_POST['user_num'],
  'star_rating' => $_POST['star'],
  'ctnt' => $_POST['review_ctnt']
];
print_r($param);
$result = ins_menu_review($param);
print_r($result);
header("Location: store-detail.php?store_num={$param['store_num']}");
