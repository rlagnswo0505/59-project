<?php
   include('db/db_sub.php');

   $reservation_date = $_POST['day']." ".$_POST['time'];
   $sub_num = $_POST['sub_num'];
   $remaining_count = $_POST['remaining_count'];

   $param = [
      'reservation_date' => $reservation_date,
      'sub_num' =>$sub_num,
      'remaining_count' => $remaining_count
   ];

   // echo $reservation_date."<br>";
   // echo $sub_num."<br>";
   // echo $remaining_count;


   $result = insert_usedsub($param);
   // echo $result;
   if(!$result) {
      echo "<script>alert('오류가 발생했습니다');
      window.location.href = 'sub_manage.php';</script>";
   } else {
      //유저 본인에게 상태변경을 알리는 프로세스추가
      echo "<script>alert('예약을 요청했습니다');
      window.location.href = 'home.php';</script>";
      
     
   }
