<?php 
include_once("../library/Table/User.class.php");
    if($_SESSION["fb_{$FBArr['appId']}_access_token"] == "" or empty($_SESSION['fbId'])) {
        header("Location: /2013Q4hmr/");
        exit();
    }

     
   if(isset($_GET["action"]) && !empty($_GET["action"])){
          if($_GET["action"] == "success"){
            $tpl->success = $_GET["action"] ;
          }
   }
   

    //print_r($_SESSION["fb_{$FBArr['appId']}_access_token"]);

     $user = new User();
    $data = $user->getByFbId($_SESSION['fbId']);
   // print_r($data["fb_id"]);

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
    $tpl->data = $data;

     include_once("../library/Table/Coupon.class.php");
        $coupon = new Coupon();
        $getcoupon = $coupon->getByRandCoupon();
        $tpl->getcoupon = $getcoupon;


    include_once("../library/Table/Lottery.class.php");
    $lottery = new Lottery();
    //以下是計算USER有無領過獎
  //  date_default_timezone_set("Asia/Taipei");
   // $today = date("Y-m-d");
   // $today = (str)$today;
   // print_r($today);
    $lotteryfail = $lottery->getByLotteryFbId($_SESSION['fbId']);
    $tpl->lotteryfail = $lotteryfail;
    //以下是計算USER當日有無在被領100次以外 
    //countLotteryByDate
    $todaylotteryfailtimes = $lottery->countLotteryByDate($today);
    $tpl->todaylotteryfailtimes = $todaylotteryfailtimes;

    //判斷該FB_ID有沒有填寫過表單,有填寫過的話則直接導頁

    $ishavedata = $lottery->countLotteryFbid($_SESSION['fbId']);
    $tpl->ishavedata = $ishavedata;
    //print_r($ishavedata);

    //取出該FB_ID的EMAIL
     $getEmail = $lottery->getByLotteryEmail($_SESSION['fbId']);
     $tpl->getemail = $getEmail;


?>