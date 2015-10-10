<?php
function resourcePost($api, $tools, $param)
{
    $param["fb_id"] = $tools->sql_injection_anti($_SESSION["fbId"]);

    if (empty($param["fb_id"])) {
        
        // log it
        $log_param = Array();
        $log_param = $param;
        $log_param["message"] = "資料不齊全，請重新輸入。";
        // $api->setApiErrorLog($this->resource, $log_param);

        $api->setError($log_param["message"]);
        unset($param);
        return;
    }

    include_once (LIB_PATH . 'Table/LogLike.class.php');

    $logLike = new LogLike();

    $sql_param = Array();
    $sql_param["fb_id"] = $param["fb_id"];
    $sql_param["ip"]    = $param["ip"];
    $sql_param["today"] = $param["today"];
    $lastId = $logLike->addLikeLog($sql_param);

    if (empty($lastId)) {

        // log it
        $log_param = Array();
        $log_param = $param;
        $log_param["message"] = "LOG記錄失敗。";
        $api->setApiErrorLog($param["action"], $log_param);

        $api->setError($log_param["message"]);
        unset($param);
        return;
    }
    unset($sql_param);
    
    $output["last_id"] = $lastId;
    $api->setOutput('LOG記錄成功', $output);
}
?>