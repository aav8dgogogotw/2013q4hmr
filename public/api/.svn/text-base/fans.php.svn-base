<?php 
    function resourceGet($api, $tools, $param) {
        include_once(LIB_PATH.'facebook/facebook.php');
        global $FBArr, $fansId;
        $param['fbId'] = $tools->sql_injection_anti($_SESSION["fbId"]);

        if($param['fbId'] == '')
            header("Location: index.php?page=chkfans");

        $facebook = new Facebook($FBArr);
        $facebook->setAccessToken($_SESSION["fb_{$FBArr['appId']}_access_token"]);

        //無菸生活
        $isFans = $facebook->api(array( 'method' => 'fql.query', 'query' => "SELECT target_id FROM connection WHERE source_id = '{$param['fbId']}' AND target_id = '{$fansId}'"));

        if(empty($isFans)) {
            $api->setOutput("確認是否加入粉綜", array("isFans"=>false));
        }else {
            $api->setOutput("確認是否加入粉綜", array("isFans"=>true));
        }

        return;
    }
?>