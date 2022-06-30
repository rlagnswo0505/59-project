<?php
$page_name = "";
$store_num = $_POST['store_num'];
$menu_num = $_POST['menu_num'];
$sub_num = $_POST['sub_num'];
$remaining_count = $_POST['remaining_count'];


$openTime = "09:00";
$closeTime = "19:00";
$openDay = "월 화 수 목 금 토 일";
// 영업시간 초기값
// 휴무일반영되게 추가해야함.


$param = [
    "store_num" => $store_num,
    "menu_num" => $menu_num,
    "sub_num" => $sub_num
];
include_once 'db/db_store_and_menu.php';
$list_store = select_one_store($param);
$sales_time = str_replace(" ", "", $list_store['sales_time']);
if (isset($list_store)) {
    $openTime = explode(",", $sales_time)[0];
    $closeTime = explode(",", $sales_time)[1];
}
$list_menu = select_one_menu($param);
if (isset($list_menu)) {
    $menu_nm = $list_menu['menu_nm'];
    $menu_subed_count = $list_menu['subed_count'];
}
if (!$list_menu['required_time']) {
    $list_menu['required_time'] = 0;
}
?>
<script>
    let requiredTimeMin = <?= $list_menu['required_time'] ?>;
    console.log("requiredTime:" + requiredTimeMin);
</script>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>reservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://kit.fontawesome.com/57749be668.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="css/screens/reservation.css" />
    <link rel="stylesheet" href="css/styles_std.css">


</head>

<body>

    <div class="container">
        <header>
            <?php
            include_once "header.php";
            ?>
        </header>
        <!-- Swiper -->
        <main class="reservation">
            <div class="reservation__do-reserve">
                <h1>예약하기</h1>
                <table>
                    <tr>
                        <td>구독메뉴</td>
                        <td><?= $menu_nm ?></td>
                    </tr>
                    <tr>
                        <td>남은횟수</td>
                        <td><?= $remaining_count ?>회</td>
                    </tr>
                </table>
            </div>
            <form action="reservation_proc.php" method="post">
                <div class="reservation__select-day">
                    <div class="reservation__select-day-title">날짜선택</div>
                    <div class="day-box">
                        <div class="swiper mySwiper1">
                            <div class="swiper-wrapper swiper-wrapper1">

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>

                <div class="reservation__select-time">
                    <div>시간선택</div>
                    <div class="time-box">
                        <div class="swiper mySwiper2">
                            <div class="swiper-wrapper swiper-wrapper2">
                                <div class="swiper-slide swiper-slide2">

                                </div>
                            </div>
                            <div class="swiper-scrollbar"></div>
                        </div>

                    </div>
                </div>
                <input type="hidden" name="sub_num" value="<?= $sub_num ?>">
                <input type="hidden" name="remaining_count" value="<?= $remaining_count ?>">
                <div class="reservation__submit"><input type="submit" /></div>
            </form>


        </main>
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>
    </div>


    <script>
        <?= "let openTime = '$openTime';" ?>
        <?= "let closeTime = '$closeTime';" ?>
        <?= "let openDay = '$openDay';" ?>


        var swiper = new Swiper(".mySwiper1", {
            slidesPerView: 6.5,
            spaceBetween: 15,
            pagination: {
                // el: ".swiper-pagination",
                clickable: false,
            },
        });

        var swiper = new Swiper(".mySwiper2", {
            direction: "vertical",
            slidesPerView: "auto",
            freeMode: true,
            scrollbar: {
                el: ".swiper-scrollbar",
            },
            mousewheel: true,
        });
    </script>
    <script src="./js/reservation_create_time_fn.js"></script>

</body>

</html>