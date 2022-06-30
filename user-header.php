<style>
    .nav--notice {
        position: relative;
    }
    .red_circle {
        position: absolute;
        margin: 0 auto;
        width: 7px;
        height: 7px;
        background-color : red;
        border-radius: 50%;
        top: -1px;
        left: 9px;
    }
</style>
<?php

include_once "db/db_user.php";

session_start();
if(isset($_SESSION['login_user'])){
$login_user = $_SESSION['login_user'];
$user_num = $login_user['user_num'];

$param = [
    'user_num' => $user_num
];

$unread_not = check_not($param);
}
?>
<nav class="header--nav">
    <div class="nav--logo">
        <a href="javascript:history.back();" class="nav--back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>
    <div class="nav--addr">
        <a href="#">
            <!-- 본인페이지에서 $page_name에 페이지이름 문자열로 넣어주기  -->
            <?= $page_name ?>
        </a>
    </div>
    <div class="nav--notice">
        <a href="not.php">
            <i class="fa-regular fa-bell"></i>
            <?php if(isset($_GET['user_num']) && isset($_SESSION['login_user']) && $unread_not !== '0') {
            echo "<div class = 'red_circle'></div>";
            } ?>
        </a>
    </div>
</nav>