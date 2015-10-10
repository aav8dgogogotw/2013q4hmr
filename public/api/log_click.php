<?php

function resourcePost($api, $tools, $param)
{
    $param["click"] = $tools->sql_injection_anti($_POST["click"]);

    if (empty($param["click"])) {
        
        // log it
        $log_param = Array();
        $log_param = $param;
        $log_param["message"] = "資料不齊全，請重新輸入。";
        // $api->setApiErrorLog($this->resource, $log_param);

        $api->setError($log_param["message"]);
        unset($param);
        return;
    }

    include_once (LIB_PATH . 'Table/LogClick.class.php');

    $logClick = new logClick();

    $sql_param = Array();

    /**
     * click
     *
     * - 1: index_click 活動首頁
     * - 2: intro_click 導覽(親子料理食譜)
     * - 3: active_click 導覽(活動辦法)
     * - 4: picture_click 導覽(料理照片募集)
     * - 5: facebook_share 分享到FACEBOOK
     * - 6: youtude_share 分享影片的按鈕(FB分享 拿料理箱)
     * - 7: start_game 玩遊戲的按鈕(玩遊戲 抽獎去)
     * - 8: mission_start 開始的按鈕(玩遊戲 抽獎去)
     * - 9: success_submit 表單填寫完submit 
     * - 10: join_prize 領取參加獎按鈕(領取參加獎)
     * - 11: fail_submit 表單填寫完submit
     * - 12: fans_click 前往粉絲團(對照Hero)
     * - 13: login_click 登入點擊
     */
    switch ($param["click"]) {
        case "1":
            $affectedRow = $logClick->addIndexClickLog();
            break;

        case "20":
            $affectedRow = $logClick->addIntroClickLog();
            break;

        case "23":
            $affectedRow = $logClick->addActiveClickLog();
            break;

        case "4":
            $affectedRow = $logClick->addPictureClickLog();
            break;

        case "5":
            $affectedRow = $logClick->addFacebookShareLog();
            break;

        case "6":
            $affectedRow = $logClick->addYoutudeClickLog();
            break;

        case "7":
            $affectedRow = $logClick->addStartGameClickLog();
            break;

        case "8":
            $affectedRow = $logClick->addMissionStartClickLog();
            break;

        case "9":
            $affectedRow = $logClick->addSuccessClickLog();
            break;

        case "10":
            $affectedRow = $logClick->addJoinPrizeClickLog();
            break;

        case "11":
            $affectedRow = $logClick->addFailClickLog();
            break;

        case "12":
            $affectedRow = $logClick->addFansClickLog();
            break;

        case "13":
            $affectedRow = $logClick->addLoginClickLog();
            break;

        default:

            // log it
            $log_param = Array();
            $log_param = $param;
            $log_param["message"] = "資料不齊全，請重新輸入。";
            $api->setApiErrorLog($param["action"], $log_param);

            $api->setError($log_param["message"]);
            unset($param);
            return;
    }
    
    if (empty($affectedRow)) {

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
    $api->setOutput("LOG記錄成功。", $output);
}
?>