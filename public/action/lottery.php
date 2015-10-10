<?php 
include_once("../library/Table/User.class.php");
    if($_SESSION["fb_{$FBArr['appId']}_access_token"] == "" or empty($_SESSION)) {
        header("Location: /2013Q4hmr/");
        exit();
    }

     $user = new User();
    $data = $user->getByFbId($_SESSION['fbId']);

    if($data['act1'] == 0) {
        $act["pass"] = 0;
        $act["active"] = 1;
    }elseif($data['act2'] == 0) {
        $act["pass"] = 1;
        $act["active"] = 2;
    }elseif($data['act3'] == 0) {
        $act["pass"] = 2;
        $act["active"] = 3;
    }elseif($data['act4'] == 0) {
        $act["pass"] = 3;
        $act["active"] = 4;
    }elseif($data['act5'] == 0) {
        $act["pass"] = 4;
        $act["active"] = 5;
    }elseif($data['act6'] == 0) {
        $act["pass"] = 5;
        $act["active"] = 6;
    }else {
        $act["pass"] = 6;
        $act["active"] = 7;
    }
    $tpl->act = $act;

    

?>