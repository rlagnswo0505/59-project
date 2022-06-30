<?php

include_once "db/db_user.php";

$user_num = $_GET['user_num'];

$param = [
    'user_num' => $_GET['user_num']
];

$result = sel_user($param);

$ue = $result['user_mail'];
$uk = $result['nickname'];
$unm = $result['user_nm'];

session_start();
$login_user = $_SESSION['login_user'];

if($_GET['user_num'] !== $login_user['user_num'])
{ ?>
<script>
    alert("잘못된 접근입니다.")
    location.href = "login.php"
</script>
<?php
}



if(isset($_POST['user_mail']))
{
    $param += [
    'nickname' => $_POST['nickname']
    ];   
    $nkname_check = nkname_check($param);
    if($nkname_check[1] !== $result['nickname'] && $nkname_check[1]) {
    $wk = $_POST['nickname']."는 중복된 닉네임입니다. <br> 다른 닉네임을 입력해주세요.";
    }
    else{
if($_POST['user_mail'] == $result['user_mail'])
{
    if (!$_POST['user_pw']){
        $wp = "비밀번호를 입력해주세요.";
    }
    if ($_POST['user_pw'] !== $_POST['user_check_pw']) {
        $wp = "비밀번호가 일치하지 않습니다.";
    }
        if (!$_POST['nickname']) {
        $wk = "닉네임을 입력해주세요.";
    }
        if (!$_POST['user_nm']) {
        $wnm = "이름을 입력해주세요";
        }

        $user_mail = $_POST['user_mail'];
        $user_pw = $_POST['user_pw'];

        $mailCheck = mailCheck($user_mail);
        $passwordCheck = passwordCheck($user_pw);

        if($passwordCheck[0] == false){
        $we = $mailCheck[1];
        }
        if ($passwordCheck[0] == false){
        $wp = $passwordCheck[1];
        }

        if($_POST['user_nm'] !== "" && $_POST['nickname'] !== "" && $_POST['user_pw'] == $_POST['user_check_pw'] && $_POST['user_mail'] == $result['user_mail'] && $mailCheck[0] && $passwordCheck[0])
        {        
            $param += [
                'user_mail' => $_POST['user_mail'],
                'user_pw' => $_POST['user_pw'],
                'nickname' => $_POST['nickname'],
                'user_nm' => $_POST['user_nm']
            ];
            $result = upd_user_info($param);
            header("Location: myinfo_mod.php?user_num=$user_num");
        }
    }
    else
    { ?>
<script>
    alert("이메일은 변경할 수가 없습니다.")
    location.href = "myinfo_mod.php?user_num=$user_num"
</script>
<?php
    }
}
}

