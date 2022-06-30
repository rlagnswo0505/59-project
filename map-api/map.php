<?php
include_once '../db/db_store_and_menu.php';

$user_location = $_GET["user_location"];

$param = [];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>

<body>
  <h1>카카오 지도 api</h1>
  <!-- 카카오 지도가 표시될 영역 -->
  <div id="map" style="width:500px;height:400px;"></div>
  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=432d560dba4b5bfdf6e7e35e15d62c34&libraries=services,clusterer,drawing"></script>
  <script>
    var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
      mapOption = {
        center: new kakao.maps.LatLng(35.868304, 128.593923), // 지도의 중심좌표
        level: 2, // 지도의 확대 레벨
        mapTypeId: kakao.maps.MapTypeId.ROADMAP // 지도종류
      };

    // 지도를 생성한다 
    var map = new kakao.maps.Map(mapContainer, mapOption);

    // 지도에 마커를 생성하고 표시한다
    var marker = new kakao.maps.Marker({
      position: new kakao.maps.LatLng(35.868304, 128.593923), // 마커의 좌표
      draggable: true, // 마커를 드래그 가능하도록 설정한다
      map: map // 마커를 표시할 지도 객체
    });

    // 마커 위에 표시할 인포윈도우를 생성한다
    var infowindow = new kakao.maps.InfoWindow({
      content: '<div style="padding:5px;"></div>' // 인포윈도우에 표시할 내용
    });

    // 인포윈도우를 지도에 표시한다
    infowindow.open(map, marker);
  </script>
</body>

</html>