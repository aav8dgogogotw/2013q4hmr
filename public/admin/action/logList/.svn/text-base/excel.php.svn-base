<?php
include_once (LIB_PATH . 'Table/LogClick.class.php');
include_once (LIB_PATH . 'Table/LogLike.class.php');
include_once (LIB_PATH . 'Table/Game.class.php');
include_once (LIB_PATH . 'Table/LogActStart.class.php');
include_once (LIB_PATH . 'Table/LogActFinish.class.php');
include_once (LIB_PATH . 'Table/LogInviteFriend.class.php');
include_once (LIB_PATH . 'Table/Lottery.class.php');
include_once (LIB_PATH . 'Table/User.class.php');

$logClick = new LogClick();

$result_log = $logClick->listClickLog();


if (!empty($result_log)) {

    $logLike         = new LogLike();
    $tbGame          = new Game();
    $logActStart     = new LogActStart();
    $logActFinish    = new LogActFinish();
    $logInviteFriend = new LogInviteFriend();
    $tbLottery       = new Lottery();
    $tbUser          = new User();
    
    foreach ($result_log as $key => $value) {
        $tempRow = $value;

        // 按讚人數
        $countLike = $logLike->countLikeLogByDate($tempRow['log_date']);
        $tempRow["count_like"] = $countLike;

        // 確認進入遊戲人數
        
        // $countGameUser = $tbGame->countGameUserByDate($tempRow['log_date']);
        // $tempRow["count_game_user"] = $countGameUser;
        $listGameUser = $tbGame->listGameUserByDate($tempRow['log_date']);
        if (!empty($listGameUser) and is_array($listGameUser)) {
            $tempRow["count_game_user"] = count($listGameUser);
            
            // 因為此活動而進入遊戲的人數
            $tempRow["count_already_join"] = 0;
            $gameUserArray = array();
            foreach ($listGameUser as $value) {
                $checkUserAlreadyJoin = $tbUser->checkUserAlreadyJoin($value["fb_id"]);
                if ($checkUserAlreadyJoin) {
                    $tempRow["count_already_join"] = $tempRow["count_already_join"] + 1;
                }
            }
            unset($gameUserArray);
        } else {
            $tempRow["count_game_user"] = 0;
            $tempRow["count_already_join"] = 0;
        }

        // 活動中，每關卡遊戲人數
        $countActStart = $logActStart->countActStartLogByDateAndAct($tempRow['log_date'], "A");
        $tempRow["count_act_start_a"] = $countActStart;

        $countActStart = $logActStart->countActStartLogByDateAndAct($tempRow['log_date'], "B");
        $tempRow["count_act_start_b"] = $countActStart;

        $countActStart = $logActStart->countActStartLogByDateAndAct($tempRow['log_date'], "C");
        $tempRow["count_act_start_c"] = $countActStart;
        
        $countActStart = $logActStart->countActStartLogByDateAndAct($tempRow['log_date'], "D");
        $tempRow["count_act_start_d"] = $countActStart;
        
        $countActStart = $logActStart->countActStartLogByDateAndAct($tempRow['log_date'], "E");
        $tempRow["count_act_start_e"] = $countActStart;

        $countActStart = $logActStart->countActStartLogByDateAndAct($tempRow['log_date'], "F");
        $tempRow["count_act_start_f"] = $countActStart;

        // 活動中，每關卡完成人數
        $countActFinish = $logActFinish->countActFinishLogByDateAndAct($tempRow['log_date'], "A");
        $tempRow["count_act_finish_a"] = $countActFinish;

        $countActFinish = $logActFinish->countActFinishLogByDateAndAct($tempRow['log_date'], "B");
        $tempRow["count_act_finish_b"] = $countActFinish;

        $countActFinish = $logActFinish->countActFinishLogByDateAndAct($tempRow['log_date'], "C");
        $tempRow["count_act_finish_c"] = $countActFinish;

        $countActFinish = $logActFinish->countActFinishLogByDateAndAct($tempRow['log_date'], "D");
        $tempRow["count_act_finish_d"] = $countActFinish;

        $countActFinish = $logActFinish->countActFinishLogByDateAndAct($tempRow['log_date'], "E");
        $tempRow["count_act_finish_e"] = $countActFinish;

        $countActFinish = $logActFinish->countActFinishLogByDateAndAct($tempRow['log_date'], "F");
        $tempRow["count_act_finish_f"] = $countActFinish;

        // 邀請好友遊戲人數
        $countInviteFriend = $logInviteFriend->countInviteFriendLogByDate($tempRow['log_date']);
        $tempRow["count_invite_friend"] = $countInviteFriend;

        // 進入活動人數
        $resultUser = $tbUser->listFbidByCreateDate($tempRow['log_date']);
        $userAry = Array();
        if (!empty($resultUser) && is_array($resultUser)) {
            foreach ($resultUser as $value) {
                $userAry[] = $value['fb_id'];
            }
            unset($value);
        
            $tempRow["count_user"] = count($resultUser);
        } else {
            $tempRow["count_user"] = 0;
        }
        

        // 邀請好友正式進入活動遊戲人數 (檢查玩家是否在邀請名單)
        if (!empty($userAry)) {
            $inviteAry = Array();
            $listInviteFriend = $logInviteFriend->listInviteFriend();
            if (!empty($listInviteFriend) && is_array($listInviteFriend)) {
                foreach ($listInviteFriend as $value) {
                    $inviteAry[] = $value['friend_id'];
                }
            
                // 名單比對
                $intersectAry = array_intersect($userAry, $inviteAry);
                $tempRow["count_invite_friend_enter"] = count($intersectAry);
            } else {
                $tempRow["count_invite_friend_enter"] = 0;
            }
        } else {
            $tempRow["count_invite_friend_enter"] = 0;
        }
        /*
        $listInviteFriendEnter = $logInviteFriend->listFriendEnterGameByDate($tempRow['log_date']);
        if (is_array($listInviteFriendEnter)) {
            $tempRow["count_invite_friend_enter"] = count($listInviteFriendEnter);
        } else {
            $tempRow["count_invite_friend_enter"] = 0;
        }
        */

        // 參加抽獎人數
        $countLottery = $tbLottery->countLotteryByDate($tempRow['log_date']);
        $tempRow["count_lottery"] = $countLottery;

        // 塞回陣列中
        $result_log[$key] = $tempRow;
    }
}

$tpl->list = $result_log;
?>