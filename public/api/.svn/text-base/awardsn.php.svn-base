<?php 

    function resourceGet($api, $tools, $param) {

        $param["fbId"] = $tools->sql_injection_anti($_SESSION['fbId']);
        $param["stage"] = $tools->sql_injection_anti($_POST['stage']);

        if($param["fbId"] == "" or $param["stage"] == "") {
            $api->setError("資料不齊全，請重新輸入。");
            return;
        }

        include_once "../../library/Table/User.class.php";
        $user = new User();

        include_once "../../library/Table/Friend.class.php";
        $friend = new Friend();

        $userData = $user->getByFbId($param['fbId']);

        if(empty($userData)) {
            $api->setError("查無玩家資料！");
            return;
        }else {

            switch($param['stage']) {
                case "F":
                    if($userData['act6'] == 0) {
                        $api->setError("不符合獎勵條件！");
                        return;
                    }
                case "E":
                    if($userData['act5'] == 0) {
                        $api->setError("不符合獎勵條件！");
                        return;
                    }
                case "D":
                    if($userData['act4'] == 0) {
                        $api->setError("不符合獎勵條件！");
                        return;
                    }
                case "C":
                if($userData['act3'] == 0) {
                        $api->setError("不符合獎勵條件！");
                        return;
                    }                        
                case "B":
                    if($userData['act2'] == 0) {
                        $api->setError("不符合獎勵條件！");
                        return;
                    }

                case "A":
                    if($userData['act1'] == 0) {
                        $api->setError("不符合獎勵條件！");
                        return;
                    }
                break;
                default:
                    $api->setError("無此關卡獎勵！");
                break;
            }
            include_once "../../library/Table/AwardSn.class.php";
            $awardSn = new AwardSn();            
                
            $award = $awardSn->getAwardSn($param['stage'], $param['fbId']);
            if(empty($award)) {
                $awardSn->receiveAwardSn($param['stage'], $param['fbId']);
                $award = $awardSn->getAwardSn($param['stage'], $param['fbId']);
            }

            $extra = array();

            if($param['stage'] == "C") {

                $extra = $awardSn->getAwardSn("G", $param['fbId']);
                if(empty($extra)) {
                    
                    $extra = $awardSn->getAwardSn("H", $param['fbId']);
                    if(empty($extra)) {
                        if(intval($userData['act3']) % 100 == 0 and intval($userData['act3']) > 3425) {
                            $awardSn->receiveAwardSn("G", $param['fbId']);
                            $extra = $awardSn->getAwardSn("G", $param['fbId']);
                            if(empty($extra)) {
                                $awardSn->receiveAwardSn("H", $param['fbId']);
                                $extra = $awardSn->getAwardSn("H", $param['fbId']);
                            }
                        }
                    }
                }                
            }

            if($param['stage'] == "E") {
                $extra = $awardSn->getAwardSn("I", $param['fbId']);

                if(empty($extra)) {

                    $extra = $awardSn->getAwardSn("I", $param['fbId']);
                    if(empty($extra)) {
                        if(intval($userData['act5']) % 100 == 0 and intval($userData['act5']) > 1160) {
                            $awardSn->receiveAwardSn("I", $param['fbId']);
                            $extra = $awardSn->getAwardSn("I", $param['fbId']);
                            if(empty($extra)) {
                                $awardSn->receiveAwardSn("J", $param['fbId']);
                                $extra = $awardSn->getAwardSn("J", $param['fbId']);
                            }
                        }
                    }
                }                
            }

            $api->setOutput("取得獎勵資料", array("award"=>$award, "extra"=>$extra));
        }        
        return;
    }

?>