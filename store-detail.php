<?php
include_once "db/db_store_and_menu.php";

$store_num = $_GET['store_num'];
session_start();
$user_num = 10;
$param = [
    "store_num" => $store_num,
    "user_num" => $user_num
];
// 세션에 정보가 있으면 셀렉트
if (isset($_SESSION['login_user'])) {
    $login_user = $_SESSION['login_user'];
    $user_num = $login_user['user_num'];
    $param['user_num'] = $user_num;

    $store_like = 0;
    $store_like = sel_store_like($param);
} else {
    $user_num = 0;
}
$store_like = sel_store_like($param);


// 처음 가게페이지에 들어 왔을 때 디비에 좋아요 데이터가 있는지 확인 후 있으면 꽉찬하트 아니면 빈 하트
$heart = 0;
if (isset($store_like)) {
    $store_like = 1;
    $heart = 1;
} else {
    $store_like = 0;
}
$menu_info = select_store_menus($param);
$store_info = select_one_store($param);
$store_reviews = select_store_review($param);
$store_stars = select_store_stars($param);
$cates = select_menu_cate($param);
// 찜하기 submit 의 name
// $like_num = 1;

// 별점 평균과 각 점수별 퍼센트 만들기
$star_avg = round($store_stars['star_avg'], 1);
if ($store_stars['star_total'] == 0) {
    $store_stars['star_total'] = 1;
}
$stars_avg = [
    'star5_avg' => round(($store_stars['star5'] / $store_stars['star_total']) * 100),
    'star4_avg' => round(($store_stars['star4'] / $store_stars['star_total']) * 100),
    'star3_avg' => round(($store_stars['star3'] / $store_stars['star_total']) * 100),
    'star2_avg' => round(($store_stars['star2'] / $store_stars['star_total']) * 100),
    'star1_avg' => round(($store_stars['star1'] / $store_stars['star_total']) * 100)
];
// 쉬는날 배열만들기
$week = ['월', '화', '수', '목', '금', '토', '일'];
$sales_days = explode(' ', $store_info['sales_day']);
$off_days = array_diff($week, $sales_days);
$cate = '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>가게페이지</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/8eb4f0837a.js" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js" defer></script>
    <script src="js/store-tabs.js" defer></script>
    <script src="js/star.js" defer></script>
    <script src="js/swiper.js" defer></script>
</head>

<body>
    <!-- 전체사이즈 -->
    <div class="container">
        <!-- header 인클루드해서 사용 -->
        <header class="store--header">
            <?php
            include_once "store-header.html";
            ?>
        </header>
        <!-- main -->
        <main>
            <div class="store--img--box">
                <?php if($store_info["store_photo"] === 'null') {
                    print "<img src='https://cdn.pixabay.com/photo/2020/04/17/19/48/city-5056657_960_720.png' alt=''>";
                }else {
                    print "<img src='img/store/{$store_info["store_nm"]}/Main_img/{$store_info["store_photo"]}'>";
                }?>
                <!-- <img src="https://images.unsplash.com/photo-1564327368633-151ef1d45021?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt=""> -->
            </div>
            <div class="store-main">
                <h1><?= $store_info['store_nm'] ?></h1>
                <div class="store-point">
                    <div class="store-point__star">
                        <i class="fa-solid fa-star"></i>
                        <div><?= $star_avg ?></div>
                    </div>
                    <div class="store-point__heart">
                        <!-- <i class="fa-regular fa-heart"></i>
                        <div>단골 찜</div> -->
                        <?php
                        if ($heart !== 0) {  // 좋아요 있으면 꽉찬하트 보여주기 
                        ?>
                            <div id="btn_like"><i class='fas fa-heart'></i>단골찜</div>
                        <?php } else {  // 좋아요 없으면 빈하트 보여주기
                        ?>
                            <div id="btn_like"><i class='far fa-heart'></i>단골찜</div>
                        <?php } ?>
                    </div>
                </div>
                <div class="store-cummuni">
                    <a href="#">
                        <i class="fa-solid fa-phone"></i>
                        전화하기
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        공유하기
                    </a>
                </div>
            </div>
            <div class="store-tabs">
                <!-- -------- 탭 헤드 -------- -->
                <div class="tabs__head">
                    <div class="tabs__toggle is-active">
                        <a class="tabs__name">메뉴</a>
                    </div>
                    <div class="tabs__toggle">
                        <a class="tabs__name">정보</a>
                    </div>
                    <div class="tabs__toggle">
                        <a class="tabs__name">리뷰</a>
                    </div>
                </div>
                <!-- -------- 탭 바디 -------- -->
                <div class="tabs__body">
                    <!-- -------- 가게메뉴 -------- -->
                    <div class="tabs__content is-active">
                        <div class="tabs__content__box menu__content">
                            <!-- -------- 메뉴 카테고리 스와이프-------- -->
                            <?php
                            include_once 'swiper.php';
                            foreach ($menu_info as $menu) {
                                if ($menu['menu_cate'] != $cate) {
                                    $cate = $menu['menu_cate'];
                                    print "<h1 id='$cate' class='cate_title'>$cate</h1>";
                                }
                            ?>
                                <!-- -------- 카테고리별 메뉴 리스트 -------- -->
                                <div class="menu-list">
                                    <div class="menu-info">
                                        <div class="menu_num" style="display: none;"><?= $menu['menu_num'] ?></div>
                                        <?php $menu["menu_photo"] !== null ? print "<img src='img/store/{$menu["store_nm"]}/Menu_img/{$menu["menu_num"]}/{$menu["menu_photo"]}'>" : print "<img src='img/store/sub_basic'>";?>
                                        <div class="menu-text">
                                            <h2 class="menu-info__name"><?= $menu['menu_nm'] ?></h2>
                                            <div class="menu-info__count">월 <?= $menu['subed_count'] ?>회</div>
                                        </div>
                                    </div>
                                    <h2 class="menu--price"><?= $menu['subed_price'] ?>원</h2>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                    <!-- -------- 가게정보 -------- -->
                    <div class="tabs__content">
                        <div class="tabs__content__box">
                            <h2 class="tabs__title">가게소개</h2>
                            <p class="tabs__text"><?= $store_info['store_info'] ?></p>
                        </div>
                        <div class="tabs__content__box">
                            <h2 class="tabs__title">영업정보</h2>
                            <table>
                                <tr>
                                    <td>상호명</td>
                                    <td><?= $store_info['store_nm'] ?></td>
                                </tr>
                                <tr>
                                    <td>운영시간</td>
                                    <td><?= $store_info['sales_day'] ?> - <?= $store_info['sales_time'] ?> </td>
                                </tr>
                                <tr>
                                    <td>휴무일</td>
                                    <td>매주 <?php foreach ($off_days as $day) {
                                                print $day;
                                            };
                                            ?></td>
                                </tr>
                                <tr>
                                    <td>전화번호</td>
                                    <td><?= $store_info['store_ph'] ?></td>
                                </tr>
                                <tr>
                                    <td>사업자번호</td>
                                    <td><?= $store_info['business_num'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="tabs__content__box">
                            <h2 class="tabs__title">가게통계</h2>
                            <table>
                                <tr>
                                    <td>구독수</td>
                                    <td>600+</td>
                                </tr>
                                <tr>
                                    <td>리뷰수</td>
                                    <td><?= $store_stars['star_total'] ?></td>
                                </tr>
                                <tr>
                                    <td>찜</td>
                                    <td>100+</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- -------- 가게리뷰 -------- -->
                    <div class="tabs__content">
                        <div class="tabs__content__box">
                            <h2 class="tabs__title">사장님 공지</h2>
                            <p class="tabs__text"><?= $store_info['store_notice'] ?></p>
                        </div>
                        <div class="tabs__content__box">
                            <div class="point--box">
                                <div class="star--box store--rating">
                                    <div class="form-group">
                                        <h1 class="ratingPoint"><?= $star_avg ?></h1>
                                    </div>
                                    <div class="star">
                                        <div class="stars-outer">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <div class="stars-inner shop--rating">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="point--graph">
                                    <div class="gray-star">
                                        <ul class="star-list-gray">
                                            <li>
                                                5점
                                            </li>
                                            <li>
                                                <div class="bar">
                                                    <div class="fill five"></div>
                                                </div>
                                            </li>
                                            <li>(<?= $store_stars['star5'] ?>)</li>
                                        </ul>
                                        <ul class="star-list-gray">
                                            <li>
                                                4점
                                            </li>

                                            <li>
                                                <div class="bar">
                                                    <div class="fill four"></div>
                                                </div>
                                            </li>
                                            <li>(<?= $store_stars['star4'] ?>)</li>
                                        </ul>
                                        <ul class="star-list-gray">
                                            3점
                                            <li>
                                                <div class="bar">
                                                    <div class="fill three"></div>
                                                </div>
                                            </li>
                                            <li>(<?= $store_stars['star3'] ?>)</li>
                                        </ul>
                                        <ul class="star-list-gray">
                                            2점
                                            <li>
                                                <div class="bar">
                                                    <div class="fill two"></div>
                                                </div>
                                            </li>
                                            <li>(<?= $store_stars['star2'] ?>)</li>
                                        </ul>
                                        <ul class="star-list-gray">
                                            1점
                                            <li>
                                                <div class="bar">
                                                    <div class="fill one"></div>
                                                </div>
                                            </li>
                                            <li>(<?= $store_stars['star1'] ?>)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tabs__content__box">
                            <?php foreach ($store_reviews as $review) { ?>
                                <div class="review--content">
                                    <div class="review--header">
                                        <h2 class="nickname"><?= $review['nickname'] ?></h2>
                                        <div class="star--box">
                                            <div class="star">
                                                <div class="stars-outer">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <div class="stars-inner star<?= $review['star_rating'] ?>">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review--image">
                                        <img src="https://images.unsplash.com/photo-1615324606695-afaaf3a8554e?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974" alt="">
                                    </div>
                                    <div class="review--comment">
                                        <?= $review['ctnt'] ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- footer 인클루드해서 사용 -->
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>
    </div>
    <script>
        // 가게 좋아요를 위한 ajax
        const btnLike = document.querySelector('#btn_like')
        const heartIcon = btnLike.querySelector('i');
        const heartCtn = document.querySelector(".store-point__heart");
        // 하트 아이콘이 꽉 차 있으면 색을 넣어줌
        if (heartIcon.classList.value === "fas fa-heart") {
            heartCtn.classList.add('heart--click');
        }
        document.addEventListener("DOMContentLoaded", function() {
            // 단골찜 버튼 클릭 시 fetch로 proc와 연결, 버튼 토글
            btnLike.addEventListener('click', () => {

                const url = 'store-detail_proc.php?store_num=<?= $store_num ?>&user_num=<?= $user_num ?>&store_like=<?= $store_like ?>';
                fetch(url).then((response) => {
                    console.log(response);
                    return response.json();
                }).then((element) => {
                    console.log(element);
                })
                if (<?= $user_num ?> === 0) {
                    let userConfirm = confirm("로그인을 하셔야 찜을 하실 수 있습니다.[확인 시 로그인 페이지로 이동]");
                    if (userConfirm === true) {
                        location.href = 'mypage.php';
                    }
                } else {
                    heartCtn.classList.toggle('heart--click');
                    heartIcon.classList.toggle('fas');
                    heartIcon.classList.toggle('far');
                }
            })
        })

        // 리스트 클릭해도 페이지이동
        const rows = document.querySelectorAll(".menu-list");

        for (const row of rows) {
            const menu = row.querySelector(".menu_num").innerHTML;

            function handleRowClick() {
                location.href = `menu-detail.php?menu_num=${menu}`;
            }
            row.addEventListener("click", handleRowClick);
        }
        // 점수 평균으로 그래프 칠하기 
        const graph = document.querySelector('.point--graph'),
            five = graph.querySelector('.five'),
            four = graph.querySelector('.four'),
            three = graph.querySelector('.three'),
            two = graph.querySelector('.two'),
            one = graph.querySelector('.one');

        five.style.width = '<?= $stars_avg['star5_avg'] ?>%';
        four.style.width = '<?= $stars_avg['star4_avg'] ?>%';
        three.style.width = '<?= $stars_avg['star3_avg'] ?>%';
        two.style.width = '<?= $stars_avg['star2_avg'] ?>%';
        one.style.width = '<?= $stars_avg['star1_avg'] ?>%';
    </script>
</body>

</html>