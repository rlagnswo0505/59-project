<!-- 오구프로젝트 
시작일시 : 2022.05.13일
버전 : 오구 1.0v
-->
<?php
include_once "db/db_store_login.php";

$we = "";
$wp = "";
$wnm = "";

if(isset($_POST['store_email'])) {
include_once "owner_join_proc.php";
}
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
    <div class = "all_page">
        <main>
        <div class = "owner_page">
        <div class = "owner_login_page_flex">
            <div class ="owner_join_page">
                <div class = "owner_join_bigfont">사장님 로그인</div>
                <div class = "owner_join_smallfont">오구 아이디로 모든 <br> 오구 관리자 서비스를 이용할 수 있습니다.</div>
                <div><button onclick = "location.href='owner_login.php'">로그인</button></div>
            </div>
            <div class ="owner_login_page">
                <div class = "owner_login_logo">회원가입</div>
                <div class = "owner_login_grayfont">이메일로 회원가입</div>                                                          
                <div class = "owner_input">                                 
                    <form method="post" action="owner_join.php">
                            <label>
                                <input type="text" name = "store_email" placeholder = "이메일">
                                </label>
                                <p class="owner_warning_massage"><?=$we?></p>
                            <label>
                                <input type="text" name = "owner_nm" placeholder = "이름">
                            </label>
                            <p class="owner_warning_massage"><?=$wnm?></p>
                            <label>
                                <input type="password" name = "store_pw" placeholder = "패스워드"></label>
                                <input type="password" name = "store_pw_check" placeholder = "패스워드 확인"></label>
                                <p class="owner_warning_massage"><?=$wp?></p>
                            </div>
                        <button type="submit">로그인</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </main>
    </div>
</body>
</html>