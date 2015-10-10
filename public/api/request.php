<?php 
    function resourcePost($api, $tools, $param) {
        global $FBArr;
        $param["fbId"] = $tools->sql_injection_anti($_POST["data"]["id"]);
        $_SESSION["fb_{$FBArr['appId']}_access_token"] = $_POST['token'];
        $param["requestIds"] = $tools->sql_injection_anti($_POST["requestIds"]);

        include_once "../../library/Table/Request.class.php";
        $request = new Request();

        include_once(LIB_PATH.'facebook/facebook.php');

        $facebook = new Facebook($FBArr);
        $facebook->setAccessToken($_SESSION["fb_{$FBArr['appId']}_access_token"]);

        $requestData = $facebook->api(array( 'method' => 'fql.query', 'query' => "SELECT sender_uid FROM apprequest WHERE request_id = '{$param["requestIds"]}'"));

        $param["senderId"] = $requestData[0]["sender_uid"];

        $url = "http://me.molome.tw/game/get_fb_gameacc";
        $key = "WVdFMVpqQTBaVGtPQzAwTkRjMUxUazNN";    
        $time = time();
        $sign = md5($param["fbId"].$time.$key);
        $url = sprintf($url."?fbid=%s&time=%s&sign=%s", $param["fbId"], $time, $sign);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT,30);
        $result = curl_exec($curl);
        $json = json_decode($result);
        curl_close($curl);

        if($json->info[0]->name != '' and $json->info[0]->sid != '') {
            $param['join'] = -1;
        }else {
            $param['join'] = 0;
        }

        $url = "http://graph.facebook.com/".$param['senderId'];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT,30);
        $result = curl_exec($curl);
        $userData = json_decode($result);

        $api->setOutput('新增資料成功', array("sender"=>$userData));
        return;
    }
?>