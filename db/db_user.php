<?php
include_once "db.php";

function join_user(&$param) {

$user_mail = $param['user_mail'];
$user_pw = $param['user_pw'];
$nickname = $param['nickname'];
$user_nm = $param['user_nm'];

$sql = "INSERT INTO t_user
(user_mail,user_pw,nickname,user_nm)
value
('$user_mail',password($user_pw),'$nickname','$user_nm')
";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function id_check(&$param)
{
    $user_mail = $param['user_mail'];

    $sql = "SELECT user_mail 
            from t_user
            where user_mail = '$user_mail' 
    ";
    $conn = get_conn();
    $row = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($row);
    mysqli_close($conn); 
    if(isset($result['user_mail']))
    {
    return true;
    }
    return false;
}

function nkname_check(&$param)
{
    $nickname = $param['nickname'];

    $sql = "SELECT nickname 
            from t_user
            where nickname = '$nickname' 
    ";
    $conn = get_conn();
    $row = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($row);
    mysqli_close($conn); 
    if(isset($result['nickname']))
    {
    return true;
    }
    return false;
}

function login_user(&$param){

        $user_mail = $param['user_mail'];
        $user_pw = $param['user_pw'];

            $sql = "SELECT *
            from t_user 
            where user_mail = '$user_mail'
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    if(!empty($row) && $row['user_pw'] == $user_pw)
    {
            session_start();
            $_SESSION['login_user'] = $row;
    }
    return $row;
}

function sel_user(&$param)
{
    $user_num = $param['user_num'];

    $sql = "SELECT * from t_user where user_num = $user_num
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row;
}

function upd_user_info(&$param)
{
        $user_num = $param['user_num'];
        $user_mail = $param['user_mail'];
        $user_pw = $param['user_pw'];
        $nickname = $param['nickname'];
        $user_nm = $param['user_nm'];

    $sql = "UPDATE t_user
            SET user_mail = '$user_mail',
            user_pw = password($user_pw),
            nickname = '$nickname',
            user_nm = '$user_nm'
            WHERE user_num = '$user_num'
    ";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}