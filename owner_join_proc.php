<?php

    include_once "db/db_store_login.php";

if ($_POST['store_email'] === "") {
        $we = "이메일을 입력해주세요.";
}
else 
{
    $param = [
        'store_email' => $_POST['store_email']
    ];

    $store_email = $_POST['store_email'];
    $store_pw = $_POST['store_pw'];

    $id_check = id_check($param);

    if($id_check) {
      $we = $_POST["store_email"]."는 중복된 아이디입니다. <br> 다른 아이디를 입력해주세요.";
    }
    if (!$_POST['owner_nm']) {
        $wnm = "이름을 입력해주세요";
    }
    if (!$_POST['store_pw'])
    {
        $wp = "비밀번호를 입력해주세요.";
    }
        if ($_POST['store_pw'] !== $_POST['store_pw_check']) {
        $wp = "비밀번호가 일치하지 않습니다.";
    }
    }


    // 아이디, 비밀번호 정규식
        $mailCheck = mailCheck($store_email);
        $passwordCheck = passwordCheck($store_pw);

        if($passwordCheck[0] == false){
        $we = $mailCheck[1];
        }
        if ($passwordCheck[0] == false){
        $wp = $passwordCheck[1];
        }

        if(!$id_check && $_POST['owner_nm'] !== "" && $_POST['store_pw'] == $_POST['store_pw_check'] && $_POST['store_email'] !== "" && $mailCheck[0] == true && $passwordCheck[0] == true)
        {        
            $param += [
                'store_pw' => $_POST['store_pw'],
                'owner_nm' => $_POST['owner_nm']
            ];
            join_user($param);
            header("Location: owner_login.php");
        }
