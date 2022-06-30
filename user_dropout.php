<?php

include_once 'db/db_user.php';

session_start();
$login_user = $_SESSION['login_user'];
$user_num = $login_user['user_num']; 
if($_GET['user_num'] !== $login_user['user_num'] || empty($_GET['user_num']))
{ ?>
    <script>
    alert("잘못된 접근입니다.")
    location.href = "login.php"
    </script>
<?php
} 
$page_name = "회원탈퇴";

$param = [
'created_at' => $login_user['created_at'],
'user_num' => $login_user['user_num']
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <div class = "center_flex_box">
            <div class = "user_drop_message">
            <?=$login_user['nickname']?>님께서 함께 해주신 <br>
            <?=user_Hours_of_use($param)?> 동안 <br>
            할인받으신 금액은 <?=all_discount_price($param)?> 입니다.
            <br>
            정말 탈퇴하실건가요?
            </div>
            <div class = user_dropout>
            <button type="botton" onclick="location.href='user_dropout_proc.php'">탈퇴하기</button>
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
</body>
</html>