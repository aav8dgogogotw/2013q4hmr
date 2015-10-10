<?php

if (isset($_SESSION['adm_id']) && $_SESSION['adm_id'] != '') {
    echo '<script language="javascript">location.href = "index.php?page=welcome";</script>';
    exit;
} else if ($_POST['adm_id'] && $_POST['adm_pwd']) {

    $param['adm_id']  = $tools->sql_injection_anti($_POST['adm_id']);
    $param['adm_pwd'] = $tools->sql_injection_anti($_POST['adm_pwd']);

    include_once(LIB_PATH."Table/Admin.class.php");
    
    $admin = new Admin();

    // get user data
    $res = $admin->login($param['adm_id']);
    if ($res) {
        if ($res["passwd"] === $param['adm_pwd']) {
            $_SESSION['adm_id']    = $res['admin_id'];
            $_SESSION['adm_name']  = $res['name'];
            $_SESSION['adm_email'] = $res['email'];
            $_SESSION['account']   = $res['account'];

            $json['msg'] = "OK";

        } else {
            $json['msg'] = "Fail";
        }
    } else {
        $json['msg'] = "Fail";
    }

    // log 
    $affectedRow = $admin->updateLoginIp($res['account'], $_SERVER['REMOTE_ADDR']);
    if ($affectedRow <> 1) {

        // DB Err, log it
        $err_log_str = date("Y-m-d H:i:s")." updateLoginIp > ".print_r($param ,true)."\n\n";
        $err_log_dir = ERR_LOG_PATH . 'Web/login/' . date("Y") . '/' . date("m") . '/';
        if (!is_dir($err_log_dir)) { mkdir( $err_log_dir, 0777, true ); }
        error_log($err_log_str, 3, $err_log_dir . date("Y-m-d-H-i") . "_error.log");
    }

    unset($res, $admin, $param);
    echo json_encode($json);
    exit();
}
?> 