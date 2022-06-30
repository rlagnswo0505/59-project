<?php
    include_once "db/db.php";
    define('PROFILE_PATH', 'img/store/');

    function gen_uuid_v4() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x'
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff) | 0x4000
            , mt_rand(0, 0xffff) | 0x8000
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff)
        );
    }

    function ins_store(&$param) {
        $store_nm = $param['store_nm'];
        $store_email = $param['store_email'];
        $store_pw = $param['store_pw'];
        $cate_num = $param['cate_num'];
        $store_ph = $param['store_ph'];
        $store_adr = $param['store_adr'];
        $store_photo = $param['store_photo'];
        $sales_day = $param['sales_day'];
        $sales_time = $param['sales_time'];
        $business_num = $param['business_num'];
        $store_info = $param['store_info'];
        $conn = get_conn();
        $sql = "INSERT INTO t_store
        (store_nm, store_email, store_pw, cate_num, store_ph, store_adr, 
        store_photo, sales_day, sales_time, business_num, store_info)
        VALUES
        ('$store_nm', '$store_email', '$store_pw', '$cate_num', '$store_ph', '$store_adr', 
        '$store_photo', '$sales_day', '$sales_time', '$business_num', '$store_info')";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    $store_nm = $_POST['store_nm'];
    $store_email = $_POST['store_email'];
    $store_pw = $_POST['store_pw'];
    $cate_num = $_POST['cate_num'];
    $store_ph = $_POST['store_ph'];
    $store_adr = $_POST['store_adr'];
    $sales_day = $_POST['sales_day'];
    $sales_time = $_POST['sales_time_start'] . "," . $_POST['sales_time_end'];
    $business_num = $_POST['business_num'];
    $store_info = $_POST['store_info'];


    $img_name = $_FILES["store_photo"]["name"];
    $last_index = mb_strrpos($img_name, ".");
    $ext = mb_substr($img_name, $last_index);
    $target_filenm = gen_uuid_v4() . $ext;
    $target_full_path = PROFILE_PATH . $store_nm;
    if(!is_dir($target_full_path)) {
        mkdir($target_full_path, 0777, true);
    }
    $tmp_img = $_FILES['img']['tmp_name'];
    $imageUpload = move_uploaded_file($tmp_img, $target_full_path . "/Main_img/" . $target_filenm);

    $param = [
        'store_nm' => $store_nm,
        'store_email' => $store_email,
        'store_pw' => $store_pw,
        'cate_num' => $cate_num,
        'store_ph' => $store_ph,
        'store_adr' => $store_adr,
        'sales_day' => $sales_day,
        'sales_time' => $sales_time,
        'business_num' => $business_num,
        'store_info' => $store_info,
        'store_photo' => $target_filenm
    ];
    
    $result = ins_store($param);
    header("Location: home.php");
    
?> 