<!-- 오구프로젝트 
시작일시 : 2022.05.13일
버전 : 오구 1.0v
-->
<?php
session_start();
if (isset($_SESSION['login_user'])) {
    $user_info = $_SESSION['login_user'];
}

if (isset($_GET['user_num'])) {
    if ($_GET['user_num'] !== $user_info['user_num']) { ?>
        <script>
            alert("잘못된 접근입니다.")
            location.href = "login.php"
        </script>
<?php
    }
}

include_once "db/db_user.php";

if (isset($_SESSION['login_user'])) {
    $param = [
        'user_num' => $user_info['user_num']
    ];


    $coupon_count = 0;
    $sub_count = 0;
    $review_count = 0;
    if (user_coupon_count($param) !== null) {
        $coupon_count = user_coupon_count($param);
    }
    if (user_sub_count($param) !== null) {
        $sub_count = user_sub_count($param);
    }
    if (user_review_count($param) !== null) {
        $review_count = user_review_count($param);
    }
}

$page_name = "마이페이지";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>마이페이지</title>
    <script src="https://kit.fontawesome.com/8eb4f0837a.js" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <!-- 전체사이즈 -->
    <div class="container">
        <!-- header 인클루드해서 사용 -->
        <header>
            <?php
            include_once "user-header.php";
            ?>
        </header>
        <!-- main -->
        <main>
            <?php if (isset($_SESSION['login_user'])) { ?>
                <div class="flex_box">
                    <div class="mypage_id">
                        <div class="myinfo_text">
                            <div class="mypage_user_nm"><?= $user_info['user_nm'] ?></div>
                            <a href="myinfo_mod.php?user_num=<?= $user_info['user_num'] ?>">
                                <div><i class="fa-solid fa-chevron-right"></i></div>
                            </a>
                        </div>
                        <div class="mypage_user_mail"><?= $user_info['user_mail'] ?></div>
                    </div>
                </div>
                <div class="myinfo_box_flex">
                    <a href="">
                        <div class="myinfo_box">
                            <div class="myinfo_box_text">쿠폰함</div>
                            <div class="myinfo_box_small_text"><?= $coupon_count ?>장</div>
                        </div>
                    </a>
                    <a href="sub_manage.php">
                        <div class="myinfo_box">
                            <div class="myinfo_box_text">구독관리</div>
                            <div class="myinfo_box_small_text"><?= $sub_count ?>개</div>
                        </div>
                    </a>
                    <a href="user_review.php">
                        <div class="myinfo_box">
                            <div class="myinfo_box_text">리뷰관리</div>
                            <div class="myinfo_box_small_text"><?= $review_count ?>장</div>
                        </div>
                    </a>
                </div>
            <?php } else { ?>
                <div class="center_flex_box">
                    <div class="myinfo_ogu_intro">오구에 오신 것을 환영합니다</div>
                    <div class="myinfo_login_intro">로그인 후 매일 새로운 할인을 만나보세요</div>
                    <button class="myinfo_login_box" onclick="location.href='login.php'">로그인 / 회원가입</button>
                </div>
            <?php } ?>
            <div>
                <a href="#">
                    <div class="info_div mypage_text">공지사항</div>
                </a>
                <a href="#">
                    <div class="info_div mypage_text">오구 안내</div>
                </a>
                <a href="#">
                    <div class="info_div mypage_text">이벤트 소식</div>
                </a>
                <a href="#">
                    <div class="info_div mypage_text">고객센터</div>
                </a>
                <a href="#">
                    <div class="info_div mypage_text">서비스 약관</div>
                </a>
            </div>
        </main>
        <!-- footer 인클루드해서 사용 -->
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>
    </div>
</body>

</html>