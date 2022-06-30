<?php
    include_once "db/db.php";
    $conn = get_conn();
    $sql = "SELECT * FROM t_categorie";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <title>가게 - join</title>
</head>
<body>
    <div>
        <header>

        </header>
        <main>
            <div>회원가입</div>
            <div>이메일로 회원가입</div>
            <form action="store_join_proc.php" method="post">
                <div><input type="text" name="store_nm" placeholder="가게이름" required></div>
                <div><input type="email" name="store_email" placeholder="이메일" required></div>
                <div><input type="password" name="store_pw" placeholder="비밀번호" required></div>
                <hr>
                <div><input type="number" name="business_num" placeholder="사업자 등록번호" required></div>
                <div>
                    <select name="cate_num" required>
                        <option value="0">== 가게업종 ==</option>
                        <?php
                            while($row = mysqli_fetch_assoc($result)){ ?>
                                <option value="<?=$row['cate_num']?>"><?=$row['cate_nm']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div><input type="text" name="store_ph" placeholder="가게 전화번호" required></div>
                <!-- 현재는 위도, 경도값 못 들고옴,,,,DB에 null로 바꿔놨음 추후에 변경 해야함! -->
                <div><input type="text" name="store_adr" id="store_address" placeholder="가게주소" required></div>
                <div><input type="file" name="store_photo" accept="img/store/*" required></div>
                <div> 영업요일 <br>
                    <label><input type="checkbox" name="sales_day[]" value="월">월</label>
                    <label><input type="checkbox" name="sales_day[]" value="화">화</label>
                    <label><input type="checkbox" name="sales_day[]" value="수">수</label>
                    <label><input type="checkbox" name="sales_day[]" value="목">목</label>
                    <label><input type="checkbox" name="sales_day[]" value="금">금</label>
                    <label><input type="checkbox" name="sales_day[]" value="토">토</label>
                    <label><input type="checkbox" name="sales_day[]" value="일">일</label>
                </div> 
                <div>영업시간 <br>
                    영업 시작 시간 : <input type="text" class="timepicker" name="sales_time_start"><br>
                    영업 종료 시간 : <input type="text" class="timepicker" name="sales_time_end">
                </div>
                <div>
                    <textarea name="store_info"cols="30" rows="10" placeholder="가게 소개(500자까지 입력가능)"></textarea>
                </div>
                <div>
                    <input type="submit" value="가입">
                </div>
            </form>
        </main>
        <footer>

        </footer>
    </div>
</body>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
window.onload = function(){
    document.getElementById("store_address").addEventListener("click", function(){ //주소입력칸을 클릭하면
        //카카오 지도 발생
        new daum.Postcode({
            oncomplete: function(data) { //선택시 입력값 세팅
                document.getElementById("store_address").value = data.address; // 주소 넣기
            }
        }).open();
    });
}

$(document).ready(function(){
    $('input.timepicker').timepicker({});
});
$('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});

</script>
</html>