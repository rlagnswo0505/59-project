<!-- 오구프로젝트 
시작일시 : 2022.05.13일
버전 : 오구 1.0v
회원가입 페이지
-->
<?php

include_once "db/db_user.php";

$we = "";
$wp = "";
$wk = "";
$wnm = "";
$ue = "";
$uk = "";
$unm = "";

if (isset($_GET['user_num'])) {
    $user_num = $_GET['user_num'];
    $title = "회원정보수정";
    include_once "mod_proc.php";
    $on = 1;
    $join = "join.php?user_num=$user_num";
} else {
    $title = "회원가입";
    include_once "join_proc.php";
    $join = 'join.php';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title><?= $title ?></title>
    <script src="https://kit.fontawesome.com/8eb4f0837a.js" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <!-- 전체사이즈 -->
    <div class="container">
        <!-- header 인클루드해서 사용 -->
        <header>
            <?php
            $page_name = $title;
            include_once "header.php";
            ?>
        </header>
        <!-- main -->
        <main>
            <div class="form_box">
                <form name="frm" action="<?= $join ?>" method="post">
                    <div class="join_email">
                        <label for="email">
                            이메일주소</label>
                        <input type="text" id="email" name="user_mail" placeholder="이메일 주소 입력" value='<?= $ue ?>'>
                        <p class="warning_massage"><?= $we ?></p>
                    </div>

                    <div class="join_pw">
                        <label for="user_pw">비밀번호</label>
                        <input type="password" id="user_pw" name="user_pw" placeholder="영문,숫자,특수문자 포함 8자리 이상">
                    </div>
                    <div class="join_pw_check">
                        <label for="">
                            비밀번호 확인 </label>
                        <input type="password" id="user_check_pw" name="user_check_pw" placeholder="영문,숫자,특수문자 포함 8자리 이상">
                        <p class="warning_massage"><?= $wp ?></p>
                    </div>

                    <div class="join_nkname">
                        <label id="join_nkname">
                            닉네임</label>
                        <input type="text" name="nickname" placeholder="닉네임 입력" value=<?= $uk ?>>
                        <!-- required oninvalid="this.setCustomValidity('닉네임을 입력해주세요.')" oninput="setCustomValidity('')"> -->
                        <p class="warning_massage"><?= $wk ?></p>
                    </div>

                    <div class="join_nm">
                        <label for="user_nm">
                            이름 </label>
                        <input type="text" id="user_nm" name="user_nm" placeholder="이름 입력" value=<?= $unm ?>>
                        <!-- required oninvalid="this.setCustomValidity('이름을 입력해주세요.')" oninput="setCustomValidity('')" -->
                        <p class="warning_massage"><?= $wnm ?></p>
                    </div>

                    <div class="join_insert">
                        <button type="submit" name="joinbtd" onclick="InputCheckReq()"> 다음</button>
                    </div>
                </form>
            </div>
        </main>
        <!-- footer 인클루드해서 사용 -->
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>
    </div>
    <?php
    if (isset($_GET['user_num'])) {
        if ($on == 1) { ?>
            <script>
                const email = document.querySelector('#email');
                console.log(email);
                email.setAttribute('readonly', true);
            </script>
    <?php }
    } ?>
</body>

</html>