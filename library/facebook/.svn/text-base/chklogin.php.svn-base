<?php
include_once("facebook.php");

$facebook = new Facebook($FBArr);

/****FOR SAFARI 專用:開始****/
if($_POST['fb_session']){
    $session_json =  str_replace("\\", "", $_POST['fb_session']);;
    $fb_sessionArr = json_decode($session_json);
    try{
        foreach($fb_sessionArr as $key => $val){
                $session_row = $session_row.'&'.$key.'='.htmlspecialchars($val);
        }
        //將FB的COOKIE 寫進去 Safari用
        setcookie("fbs_".$FBArr['appId'], $session_row, time()+315360000,'/',$_SERVER['HTTP_HOST']);
        //Safari 判斷用戶非重複登入
        setcookie("uid", $fb_sessionArr->uid, time()+315360000,'/',$_SERVER['HTTP_HOST']);
    }catch (Exception $e){
        //錯誤的session登入  
    }
}
/****FOR SAFARI 專用:結束****/

//判斷是否登入依據
//$FBSession = $facebook->getSession();
//$FBuid = $facebook->getUser();//抓取uid值''
//代表第一次登入,且不是同一個人

if($_SESSION["fb_{$FBArr['appId']}_access_token"] != ""){    

    //$_SESSION['FbUid'] = $FBuid;
    $facebook->setAccessToken($_SESSION["fb_{$FBArr['appId']}_access_token"]);
    $me = $facebook->api('/me');//抓取用戶資訊
    
    //print "登入後要做的事情，記錄USER_INFO";

    if($me["id"] == "" or $_SESSION["fbId"] != $me["id"]) {
        $_SESSION = array();
        header("Location: /");
        exit();
    }

    $_SESSION["fbId"] = $me["id"];
}
unset($facebook);

//設定需要登入
// $Login = true;
// $tpl->page = $_GET['page'];
// $tpl->ToUrl = $ROOTURL."index.php?page=".$_GET['page'];
?>
