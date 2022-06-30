<?php
$page_name = "결제하기";
session_start();

//작업용 임시
// $_SESSION['login_user']['user_num'] = 1;

if (isset($_SESSION['login_user'])) {
    $login_user = $_SESSION['login_user'];
} else {
    echo "<script>
    alert('로그인 후 이용 가능합니다.');
    window.location.href = 'login.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/57749be668.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles_std.css">
    <link rel="stylesheet" href="css/screens/payment.css">
    <title>결제하기</title>
</head>

<body>
    <div class="container">

        <header>
            <?php
            include_once "header_plus_home.php";
            ?>
        </header>

        <main>
            <form action="#">
                <!-- 요청사항 -->
                <div class="payment__comment">
                    <h2>요청사항</h2>
                    <div>
                        <input type="text" name="order" id="order" placeholder="예) 동일한 가격의 카페라떼로 바꿔주세요">
                    </div>
                </div>
                <!-- 결제수단 -->
                <div class="payment__how">
                    <h2>결제수단</h2>
                    <div class="payment__three">
                        <div class="payment__cacao not-ready">카카오로 계산하기</div>
                        <div class="payment__naver not-ready">네이버로 계산하기</div>
                        <div class="payment__payco not-ready">PAYCO 계산하기</div>
                    </div>
                </div>
                <div class="payment__coupon">
                    <h2>할인쿠폰</h2>
                    <div class="payment__select-box">
                        <select name="coupon" id="coupon">
                            <option value="none">1개 보유</option>
                            <option value="1">1000원 할인쿠폰</option>
                        </select>
                    </div>
                </div>
            </form>
        </main>
        <div class="basket-payment">
            <div class="basket__touch"></div>


            <div class="payment__button">결제하기</div>
        </div>
</body>

</html>

<script>
    let totalPrice = sessionStorage['totalPrice'];
    document.querySelector('.payment__button').textContent = `${totalPrice}원 결제하기`;
    document.querySelectorAll('.not-ready').forEach(e => e.onclick = goPayment);
    document.querySelector('.payment__button').onclick = goPayment;

    function goPayment() {
        console.log(localStorage);
        let itemListJson = localStorage.getItem('itemList');
        let basket = JSON.stringify(sessionStorage);
        localStorage.removeItem('itemList');
        console.log(itemListJson);
        console.log(basket);
        fetch(`payment_proc.php?itemList=${itemListJson}&basket=${basket}`)
            .then((res) => {
                console.log(res);
                if (res.ok) {
                    sessionStorage.clear();
                    location.href = 'sub_manage.php';
                }
            });
        //t_sub에 정보담고 sub_manage.php로이동

    }
</script>