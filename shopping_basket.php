<?php

$page_name = "장바구니";
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
// if (isset($_POST['menu_num']) || isset($_POST['menu_count'])) {
//     $menu_num = $_POST['menu_num'];
//     $menu_count = $_POST['menu_count'];
// }



?>
<script src="js/shopping_basket.js"></script>
<script>
    let menuNum = <?= isset($_POST['menu_num']) ? $_POST['menu_num'] : 0 ?>;
    let menuCount = <?= isset($_POST['menu_count']) ? $_POST['menu_count'] : 0 ?>;
    console.log(menuNum + ":" + menuCount);

    if (menuNum != 0) {
        let beforeCount = sessionStorage.getItem(menuNum);
        console.log(beforeCount);
        if (beforeCount == null) {
            beforeCount = 0;
        }
        sessionStorage.setItem(menuNum, Number(beforeCount) + Number(menuCount));
    }
    console.log(sessionStorage);


    let basketList = Object.keys(sessionStorage);
    console.log(basketList);
    let basketListJson = JSON.stringify(basketList);
    console.log(basketListJson);

    let itemList;
    fetch(`shopping_basket_json.php?menus=${basketListJson}`)
        .then((response) => {
            return response.json();
        }).then((list) => {
            console.log(list);
            itemList = list;
            return makeBasketBox(list);
        }).then((listDone) => {
            afterBox();
        });
</script>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/57749be668.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/screens/shopping_basket.css" />
    <link rel="stylesheet" href="css/styles_std.css">
    <title>장바구니</title>
</head>

<body>
    <div class="container">

        <header>
            <?php
            include_once "header_plus_home.php";
            ?>
        </header>

        <main>
            <div class="basket-container">

            </div>
        </main>
        <div class="basket-payment">
            <div class="basket__touch"></div>
            <table>
                <tr>
                    <td>총 주문금액</td>
                    <td class="totalPrice price"></td>
                </tr>
                <tr>
                    <td>쿠폰 할인</td>
                    <td class="price">0원</td>
                </tr>
            </table>

            <hr class="payment__line">
            <div class="payment__sub-total">
                <div>Sub Total</div>
                <div class="totalPrice price"></div>
            </div>

            <div class="payment__button" onclick="goPayment()">결제하기</div>
        </div>
    </div>

</body>

</html>