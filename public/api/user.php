<?php 
 

    function resourcePost($api, $tools, $param) {
        
        global $FBArr;
        $param["fbId"] = $tools->sql_injection_anti($_POST["data"]["id"]);
        $param["name"] = $tools->sql_injection_anti($_POST["data"]["name"]);
        $param["email"] = empty($_POST["data"]["email"])?"":$tools->sql_injection_anti($_POST["data"]["email"]);
        $param["sex"] = empty($_POST["data"]["gender"])?"":$tools->sql_injection_anti($_POST["data"]["gender"]);
        $_SESSION["fb_{$FBArr['appId']}_access_token"] = $_POST['token'];

        if($param["fbId"] == "" or $param["name"] == "") {
            $api->setError("資料不齊全，請重新輸入。");
            return;
        }

        include_once "../../library/Table/User.class.php";
        $user = new User();

        include_once "../../library/Table/Game.class.php";
        $game = new Game();

        include_once "../../library/Table/Friend.class.php";
        $friend = new Friend();

        // $gameData = $game->getByFbId($param['fbId']);

        if(empty($gameData)) {

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

            if($json->info[0]->name != '' and $json->info[0]->sid != '') {
                    
                $param['join'] = 1;
                $param['gameacc'] = $json->info[0]->gameacc;
                $param['gamename'] = $json->info[0]->name;
                $param['sid'] = $json->info[0]->sid;
                $param['addtime'] = $json->info[0]->addtime;                

                $game->add($param);

                $friend->updateFriendJoin($param['fbId'], $param['addtime']);

                unset($friend, $game);
            }else {
                $param['join'] = 0;
            }
        }else {
            $friend->updateFriendJoin($param['fbId'], $gameData['join_time']);
            $param['join'] = 1;
        }

        $userData = $user->getByFbId($param['fbId']);

        if(empty($userData)) {

            $userId = $user->add($param);
            $_SESSION['id'] = $userId;
            $_SESSION['fbId'] = $param['fbId'];

            unset($curl, $json);
        }else {

            $user->updateByFbId($param, $param['fbId']);
            $_SESSION['id'] = $userData['user_id'];
            $_SESSION['fbId'] = $userData['fb_id'];
        }

        unset($user, $param);

        $api->setOutput('新增資料成功');
    }

    function resourcePut($api, $tools, $param) {
        $param['fbId'] = $tools->sql_injection_anti($_SESSION["fbId"]);
        $param['act'] = $tools->sql_injection_anti($_POST["act"]);

        if($param["fbId"] == "" or $param['act'] == "") {
            $api->setError("資料不齊全，請重新輸入。");
            return;
        }

        include_once "../../library/Table/User.class.php";
        $user = new user();

        include_once "../../library/Table/LogActFinish.class.php";
        $logActFinish = new LogActFinish();

        $userData = $user->getByFbId($param['fbId']);

        if(empty($userData)) {
            //session_destroy();
            $api->setError("查無此玩家資料！");
        }else {
            $max = $user->actMax($param['act']);
            $user->updateActByFbId($param['act'],1, $param['fbId']);
            switch($param["act"]) {
                case "act1":
                    $param['log'] = "A";
                break;
                case "act2";
                    $param['log'] = "B";
                break;
                case "act3";
                    $param['log'] = "C";
                break;
                case "act4";
                    $param['log'] = "D";
                break;
                case "act5";
                    $param['log'] = "E";
                break;
                case "act6";
                    $param['log'] = "F";
                break;
            }
            $logActFinish->add($param);
            $api->setOutput("加入粉絲團成功");
        }
        return;
    }
?>