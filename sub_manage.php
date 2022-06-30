<?php
session_start();
$page_name = '구독관리';

if (isset($_SESSION['login_user'])) {
    $login_user = $_SESSION['login_user'];
    $user_num = $_SESSION['login_user']['user_num'];
} else {
    echo "<script>
    alert('로그인 후 이용 가능합니다.');
    window.location.href = 'login.php';
    </script>";
}

$param = [
    "user_num" => $user_num
];
include_once('db/db_sub.php');
$result = search_sub_for_user($param);
$list = [];
foreach ($result as $item) {
    array_push($list, $item);
}
mysqli_free_result($result);
$list_json = json_encode($list);

// $now_res_list = [];
// $result = search_now_reservation_for_user($param);
// foreach ($result as $item) {
//     if ($item['cd_sub_status'] != 9) {
//         array_push($now_res_list, $item);
//     }
// }
// print_r($now_res_list);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/57749be668.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" href="css/styles_std.css">
    <link rel="stylesheet" href="css/screens/sub_manage.css">
    <title>sub_manage</title>
</head>

<body>
    <div class="container">
        <header>
            <?php
            include_once "header.php";
            ?>
        </header>
        <main>
            <div class="sub-manage-tap">
                <div><input type="radio" name="manage_tab" id="sub_list" onclick="getSubList()" checked><label for="sub_list">구독 리스트</label></div>
                <div><input type="radio" name="manage_tab" id="total_save" onclick="getTotalSave()"><label for="total_save">총 할인금액</label></div>
            </div>
            <div class="total-save-price">
                <div class="total-save-price__month"></div>
                <div class="total-save-price__graph">
                    <div><canvas id="bar-chart" width="300" height="230"></canvas></div>
                </div>
            </div>
            <div class="sub-list"> </div>
            <!-- <div class="reserved-sub"></div> -->
            <form action="reservation.php" method="post" id="info_form">
                <input type="hidden" id="store_num" name="store_num">
                <input type="hidden" id="sub_num" name="sub_num">
                <input type="hidden" id="menu_num" name="menu_num">
                <input type="hidden" id="remaining_count" name="remaining_count">
            </form>
        </main>
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>


    </div>
    <script>
        const list = JSON.parse('<?= $list_json ?>');
    </script>

    <script src="./js/sub_manage.mjs"></script>

</body>

</html>

</body>

</html>