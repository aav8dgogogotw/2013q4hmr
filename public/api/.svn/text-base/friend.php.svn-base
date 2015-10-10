<?php 
    function resourcePost($api, $tools, $param) {

        $param["fbId"] = $tools->sql_injection_anti($_SESSION['fbId']);
        $param["ids"] = is_array($_POST["ids"])?$_POST['ids']:array();

        if($param["fbId"] == "" or empty($param["ids"])) {
            $api->setError("資料不齊全，請重新輸入。");
            return;
        }

        include_once "../../library/Table/User.class.php";
        $user = new User();        

        $userData = $user->getByFbId($param['fbId']);

        if(empty($userData)) {
            $api->setError("查無玩家資料！");
            unset($userData, $user, $param);
            return;
        }else {
            
            include_once "../../library/Table/Friend.class.php";
            $friend = new Friend();

            $data['fbId'] = $param['fbId'];
            $data['now'] = $param['now'];
            $data['today'] = $param['today'];

            include_once "../../library/Table/Game.class.php";
            $game = new Game();

            foreach($param['ids'] as $row) {

                $friendData = $game->getByFbId($row);
                $data['friendId'] = $row;

                if(empty($friendData)) {
                    $friend->add($data);
                }else {
                    $friend->addJoin($data);
                }
            }
            unset($data);

            $invite = $friend->getInviteNum($param['fbId']);

            $api->setOutput("邀請好友成功", array("num"=>count($invite)));
            unset($invite, $game);
        }
        unset($userData, $friend, $user, $param);
        reuturn;
    }

    function resourceGet($api, $tools, $param) {
        $param["fbId"] = $tools->sql_injection_anti($_SESSION["fbId"]);
        $param["list"] = empty($_POST["list"])?0:$tools->sql_injection_anti($_POST["list"]);

        include_once "../../library/Table/User.class.php";
        $user = new User();        

        $userData = $user->getByFbId($param['fbId']);

        if(empty($userData)) {
            $api->setError("查無玩家資料！");
            unset($userData, $user, $param);
            return;
        }else {

            include_once "../../library/Table/Friend.class.php";
            $friend = new Friend();

            $invite = $friend->getGameNum($param['fbId']);
            $list = $friend->listFriend($param['fbId']);

            if($param["list"]){
                $api->setOutput("取得好友人數", array("list"=>$list));
            }else {
                $api->setOutput("取得好友人數", array("num"=>count($invite)));
            }
            unset($list, $invite);
        }
        unset($userData, $friend, $user, $param);
        reuturn;
    }
?>