<?php 

include $_SERVER["DOCUMENT_ROOT"] . "/59-PROJECT/kakao_login_proc.php"; 
// callback 으로 들어온 값을 확인한다. 

$code = $_REQUEST["code"]; 
$state = $_REQUEST["state"]; 
$error = $_REQUEST["error"]; 
$error_description = $_REQUEST["error_description"]; 

if($error) 
{ echo "<script> 
alert('문제가 발생해서 정상적으로 로그인이 되지 않았습니다. [{$error}]');
location.href='/';
</script>"; 
exit(); } 

// 카카오로그인 객체 생성 
$kakao = new KakaoLogin($_SESSION['csrf-token']); 

// 토큰 받기 

$tokenData = $kakao->getToken($code); 

// 사용자 정보 가져오기. 

if(! empty($tokenData["data"]["access_token"])) 
{ $userInfoData = $kakao->getUserInfo($tokenData["data"]["access_token"]); 
// 사용자 정보를 이용해 추가 로직 
}
