<?php
function resourcePost($api, $tools, $param)
{
    $param["fb_id"] = $tools->sql_injection_anti($_SESSION["fbId"]);

    // array 如果做 sql_injection_anti 會無法解，所以不做。
    $param["friend_array"] = $_POST["friend"];

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

    if (!empty($param['friend_array'])) {

        // 暫時保留，以防要走 JSON
        // $array_tag = json_decode($param['fb_tag'], true);

        $array_friend = $param['friend_array'];

        if(is_array($array_friend) && !empty($array_friend)){

            include_once (LIB_PATH . 'Table/LogInviteFriend.class.php');
            $logInviteFriend = new LogInviteFriend();

            $sql_param = Array();
                
            foreach($array_friend as $value){

                $sql_param["fb_id"]     = $param["fb_id"];
                $sql_param["ip"]        = $param["ip"];
                $sql_param["friend_id"] = $value;
                $sql_param["today"]     = $param["today"];
                $lastId = $logInviteFriend->addInviteFriendLog($sql_param);

                if (empty($lastId)) {

                    // log it
                    $log_param = Array();
                    $log_param = $param;
                    $log_param["message"] = "LOG記錄失敗。";
                    $api->setApiErrorLog($param["action"], $log_param);

                    // $api->setError($log_param["message"]);
                    // unset($param);
                    // return;
                }
                unset($sql_param);
            }
        }
    } else {

        // 傳入空陣列, do nothing
    }

    $api->setOutput('LOG記錄完畢', $output);
}
?>