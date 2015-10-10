<?php
    include_once("../../config/setting.inc");

    include_once (LIB_PATH . 'Api.class.php');
    $api = new Api();

    include_once (LIB_PATH . 'Tools.class.php');
    $tools = new Tools();

    // 要執行的API
    $page = explode(".", $_POST['action']);
    $param["action"] = $page[0];
    if(!isset($param["action"])){
        $api->setError('not found');
        $api->apiResponse();
        exit();
    }

    $param['method'] = $page[1];

    // 基本參數設定
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $param['ip'] = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $param['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $param['ip'] = $_SERVER['REMOTE_ADDR'];
    }

    $param['today'] = date("Y-m-d");
    $param['now']   = date("Y-m-d H:i:s");



    // 白名單過濾
    switch ($param["action"]) {
        case "logClick":

            // 活動點擊數 /day
            require_once("log_click.php");
            break;
        
        case "logLike":

            // 按讚人數
            require_once("log_like.php");
            break;

        case "logShare":

            // 分享至塗鴉牆人數
            require_once("log_share.php");
            break;

         case "logActStart":

            // 按讚人數
            require_once("log_act_start.php");
            break;
        case "user":

            // 關卡確認相關
            require_once("user.php");
            break;
        case "friend":

            // 關卡確認相關
            require_once("friend.php");
            break;
        case "invite":

            // 關卡確認相關
            require_once("invite.php");
            break;
        case "awardsn":

            // 獎勵取得
            require_once("awardsn.php");
            break;
        case "lottery":

            // 抽獎填表
            require_once("lottery.php");
            break;
        case "fans":

            // 確認粉絲
            require_once("fans.php");
            break;
        case "request":

            // 點擊邀請
            require_once("request.php");
            break;
        default:

            $api->setError('not found');
            $api->apiResponse();
            exit();
            break;
    }
    switch ($param['method']) {
        case 'get':
            function_exists("resourceGet") ? resourceGet($api, $tools, $param) : $api->setError('not allowed');
            break;
        case 'put':
            function_exists("resourcePut") ? resourcePut($api, $tools, $param) : $api->setError('not allowed');        
            break;
        case 'post':
            function_exists("resourcePost") ? resourcePost($api, $tools, $param) : $api->setError('not allowed');  
            break;
        case 'delete':        
            function_exists("resourceDelete") ? resourceDelete($api, $tools, $param) : $api->setError('not allowed');  
            break;
        default:
            $api->setError('method not allowed');
            break;
    }
    
    $api->apiResponse();
    unset($param, $api);
?>