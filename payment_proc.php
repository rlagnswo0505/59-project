<?php

session_start();


if (isset($_SESSION['login_user'])) {
    $login_user = $_SESSION['login_user'];
} else {
    echo "<script>
    alert('로그인 후 이용 가능합니다.');
    window.location.href = 'login.php';
    </script>";
}

include_once('db/db.php');
$menuList = json_decode($_GET['itemList'], true);
$basket = json_decode($_GET['basket'], true);

// print_r($menuList);
// echo "<br>";
// print_r($basket);
// echo "<br>";
// print_r($login_user);

$values = "";



foreach ($menuList as $key => $item) {
    // echo "<hr>";
    // echo "key:" . $key . "<br>";
    // print_r($item);
    // echo "<hr>";
    // echo $basket[$key];
    $save_price = $item['price'] - $item['subed_price'];

    $val = "(" . $login_user['user_num'] . ","
        . $item['menu_num'] . ","
        . $item['subed_price'] . ","
        . $item['store_num'] . ","
        . "now()" . ","
        . "now()" . ","
        . "0" . ","
        . "DATE_ADD(NOW(), INTERVAL " . $basket[$key]  . " MONTH)"  . ","
        . $item['subed_count'] * $basket[$key] . ","
        . $item['subed_count'] * $basket[$key] . ","
        . $save_price * $basket[$key] . ")";
    $values = $values . $val;
}

$sql =
    "   INSERT INTO t_sub
        (user_num, menu_num,subed_price, store_num, sub_at, pay_date, pay_method, end_date, subed_count, remaining_count, save_price)
        VALUES
        ${values}
";

$conn = get_conn();
$result = mysqli_query($conn, $sql);
