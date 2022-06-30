<!-- 오구프로젝트 
시작일시 : 2022.05.13일
버전 : 오구 1.0v
-->
<?php
include_once 'db/db_store_and_menu.php';
session_start();
if (isset($_SESSION['login_user'])) {
  $login_user = $_SESSION['login_user'];
  $user_num = $login_user['user_num'];
}
$menu_num = $_GET['menu_num'];
// $user_num = 44;

$param = [
  'menu_num' => $menu_num,
  'user_num' => $user_num
];

$store_menu = select_one_menu($param);

$page_name = $store_menu['store_nm'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <title>리뷰페이지</title>
  <script src="https://kit.fontawesome.com/8eb4f0837a.js" crossorigin="anonymous" defer></script>
  <script src="js/image-input.js" defer></script>
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
      <div class="main--box">
        <div class="review--title">
          <h1 class="store--name">
            <?= $store_menu['menu_nm'] ?>
          </h1>
        </div>
        <div class="review--content">
          <form action="review_write_proc.php" method="post">
            <input type="hidden" name="store_num" value="<?= $store_menu['store_num'] ?>">
            <input type="hidden" name="user_num" value="<?= $user_num ?>">
            <img class="review-logo" src="img/logo.png" alt="">
            <h2 class="review-h2">구독상품은 어떠셨어요?</h2>
            <div class="stars-widget">
              <label><i class="fa-solid fa-star"></i><input type="radio" class="star-radio" id="star_1" name="star" value="1" /></label>
              <label><i class="fa-solid fa-star"></i><input type="radio" class="star-radio" id="star_2" name="star" value="2" /></label>
              <label><i class="fa-solid fa-star"></i><input type="radio" class="star-radio" id="star_3" name="star" value="3" /></label>
              <label><i class="fa-solid fa-star"></i><input type="radio" class="star-radio" id="star_4" name="star" value="4" /></label>
              <label><i class="fa-solid fa-star"></i><input type="radio" class="star-radio" id="star_5" name="star" value="5" /></label>
            </div>
            <div class="review__main">
              <div>
                <textarea name="review_ctnt" id="review_ctnt" cols="30" rows="10" placeholder="구독한 상품에 대한 솔직한 리뷰를 남겨주세요."></textarea>
              </div>
              <div class="image-input">
                <div id="inputWrapper" class="image-input__input-wrapper">
                  <input type="file" name="imageInput" id="imageInput" class="ui-input image-input__input" tabindex="0" />
                  <div class="image-input__pseudo">
                    <div><i class="fa-solid fa-plus"></i></div>
                    <div>이미지 넣기</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="review__footer">
              <p class="review-sanctions">솔직하게 작성하신 리뷰는 구독을 고민하는 분들께 도움이 됩니다. 하지만 허위리뷰나 명예훼손, 욕설, 타인비방글 등 선량한 업주나 제3자의 권리를 침해하는 게시물은 서비스 이용약관이나 관련 법률에 따라 제재를 받을 수 있습니다. </p>
              <input class="review--submit" type="submit" value="완료">
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
  <script>
    let radioInputs = document.getElementsByClassName("star-radio");

    let selected = 0;

    for (let idx = 0; idx < radioInputs.length; idx++) {
      let current = radioInputs[idx];
      current.onclick = function() {
        selected = current.value;
        for (let idx2 = 0; idx2 < radioInputs.length; idx2++) {
          let radioGuy = radioInputs[idx2];
          if (radioGuy.value <= selected) {
            let icon = radioGuy.previousSibling;
            icon.classList.add("checked");
          } else {
            let icon = radioGuy.previousSibling;
            icon.classList.remove("checked");
          }
        }
      };
    }
    const starWidget = document.querySelector(".stars-widget");
    const reviewH2 = document.querySelector(".review-h2");
    const reviewLogo = document.querySelector(".review-logo");
    const reviewSanctions = document.querySelector(".review-sanctions");
    const reviewMain = document.querySelector(".review__main");
    const reviewSubmit = document.querySelector(".review--submit")

    starWidget.addEventListener("click", () => {
      starWidget.classList.add("click-ani")
      reviewH2.classList.add("d_none");
      reviewLogo.classList.add("d_none");
      reviewSanctions.classList.add("d_none");
      reviewMain.classList.add("d_block");
      reviewSubmit.classList.add("footer-ani");
    })
  </script>
</body>

</html>