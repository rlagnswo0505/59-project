<!-- 오구프로젝트 
시작일시 : 2022.05.13일
버전 : 오구 1.0v
-->
<?php

include_once "db/db_user.php";

$page_name = "알림";

session_start();
$login_user = $_SESSION['login_user'];
$user_num = $login_user['user_num'];

//페이징
$page =1;
if(isset($_GET['page']))
{
    $page = intval($_GET['page']);
}
$row_count = 7;

$param = [
    'user_num' => $user_num,
    'row_count' => $row_count,
    'start_idx' => ($page - 1) * $row_count
];

$today_not_list = sel_not_today($param);

if(!$login_user)
{
    header("Location:mypage.php");
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
                <div class = "not_list">
                <?php
                foreach($today_not_list as $item) {
                    if($item['not_type'] == 4)
                    { ?>
                    <div class = "not_box">
                    <a href="readcheck_proc.php?not_num=<?=$item['not_num']?>">
                    <?=$item['store_nm']?>에서 구독하신 <?=$item['menu_nm']?>의 구독이 <br> 내일 마감됩니다.
                    <div class = "not_ctreat_at"><?=$item['created_at']?></div>    
                </a>
                </div>
                <?php }
                    if($item['not_type'] == 0)
                    { ?>
                    <div class = "not_box">
                    <a href="readcheck_proc.php?not_num=<?=$item['not_num']?>">
                    <?=$item['store_nm']?>에서 주문하신 <?=$item['menu_nm']?>(이)가 <br> 접수중입니다.
                    <a>
                </div>
                <?php }
                    if($item['not_type'] == 1)
                    { ?>
                    <div class = "not_box">
                    <a href="readcheck_proc.php?not_num=<?=$item['not_num']?>">
                    <?=$item['store_nm']?>에서 주문하신 <?=$item['menu_nm']?>(이)가 <br>주문확인 되었습니다.
                    <a>
                </div>
                <?php }
                    if($item['not_type'] == 3)
                    { ?>
                    <div class = "not_box">
                    <a href="readcheck_proc.php?not_num=<?=$item['not_num']?>">
                    <?=$item['store_nm']?>에서 주문확인 <?=$item['menu_nm']?>(이)가 준비완료 되었습니다.
                    <a>
                </div>
                <?php }
                    if($item['not_type'] == 9)
                    { ?>
                    <div class = "not_box">
                    <a href="readcheck_proc.php?not_num=<?=$item['not_num']?>">
                    <?=$item['store_nm']?>에서 주문하신 <?=$item['menu_nm']?>(을)를 수령하셨습니다. 
                    <br>리뷰를 등록해주세요~!
                    <a>
                </div>
                <?php }}?>
                <button class = "not_button" onclick="next_page()">이전 알림보기</button>
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
<script>
    let page = 1;
    function next_page()
    {
        page = page + 1;
        location.href = `not.php?page=${page}`;
    }
</script>
</html>

<!-- //http://www.ciboard.co.kr/manual/tables/notification
상품 주문
 →   
주문중 0 
주문확인 1
픽업대기 3
주문취소(주인거절, 주인취소, 사용자취소) 9?
수령완료(사용자거절)


구독 만료 전 날 연장 여부 알림

수령완료 후 
예전 알림 숨기기 클릭하면 보이고
-->