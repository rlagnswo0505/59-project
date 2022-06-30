<!-- 오구프로젝트 
시작일시 : 2022.05.13일
버전 : 오구 1.0v
-->
<?php
include_once "db/db_user.php";


session_start();
$login_user = $_SESSION['login_user'];
$user_num = $login_user['user_num'];

if (isset($_GET['user_num'])) {
    if ($_GET['user_num'] !== $user_info['user_num']) { ?>
        <script>
            alert("잘못된 접근입니다.")
            location.href = "login.php"
        </script>
<?php
    }
}

$page = 1;
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
}
$row_count = 7;

$param = [
    'user_num' => $user_num,
    'row_count' => $row_count,
    'start_idx' => ($page - 1) * $row_count
];

$review_list = user_review($param);

if (!$login_user) {
    header("Location:mypage.php");
}


$page_name = "리뷰관리";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>리뷰관리페이지</title>
    <script src="https://kit.fontawesome.com/8eb4f0837a.js" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <!-- 전체사이즈 -->
    <div class="container">
        <!-- header 인클루드해서 사용 -->
        <header>
            <?php
            include_once "header.php";
            ?>
        </header>
        <!-- main -->
        <main>
            <div class="center_flex_box">
                <div class="not_list">
                    <?php
                    foreach ($review_list as $item) { ?>
                        <div class="not_box">
                            <a href="readcheck_proc.php?not_num=<?= $item['not_num'] ?>">
                                <?= $item['store_nm'] ?>에서 수령하신 <?= $item['menu_nm'] ?>의 리뷰를 <br> 기다리고 있습니다~!.
                                <div class="not_ctreat_at"><?= $item['created_at'] ?></div>
                            </a>
                        </div>
                    <?php } ?>
                    <button class="not_button" onclick="next_page()">이전 리뷰보기</button>
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
<script>
    let page = 1;

    function next_page() {
        page = page + 1;
        location.href = `user_review.php?page=${page}`;
    }
</script>

</html>