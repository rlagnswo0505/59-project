<!-- 오구프로젝트 
시작일시 : 2022.05.13일
버전 : 오구 1.0v
로그인 페이지
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wclassth=device-wclassth, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>로그인</title>
    <script src="https://kit.fontawesome.com/8eb4f0837a.js" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="css/styles.css">
    <style>

    </style>

</head>

<body>
    <!-- 전체사이즈 -->
    <div class="container">
        <!-- header 인클루드해서 사용 -->
        <header>
            <?php
            $page_name = "로그인";
            include_once "header.php";
            ?>
        </header>
        <!-- main -->
        <main>
            <div class="center_flex_box">
                <div>
                    <a href="">
                        <div class='logo'></div>
                    </a>
                </div>

                <div class="intro">
                    로그인하고 다양한 혜택을 받아보세요!
                </div>

                <div>
                    <a href="">
                        <div class="kakao_login">
                            <img src="/59-PROJECT/img/kakao_logo.png">
                            <div>카카오로 로그인</div>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="">
                        <div class="naver_login">
                            <img src="/59-PROJECT/img/naver_logo.png">
                            <div>네이버로 로그인</div>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="email_login.php">
                        <div class="email_login">
                            <div>이메일로 로그인</div>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="join.php">
                        <div class="join_email">
                            <div>
                                이메일로 회원가입</div>
                        </div>
                    </a>
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