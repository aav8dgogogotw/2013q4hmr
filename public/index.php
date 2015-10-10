<?php

// if($_GET["page"] != "invite") {
//     header("Location: /wait.html");
//     exit();
// }



ini_set('display_errors','on');
ini_set("session.use_only_cookies", 1);
ini_set("session.cookie_httponly", 1);

header('Content-type: text/html; charset=utf-8');
header('Vary: Accept-Language');
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA div COM NAV OTC NOI DSP COR"');

// config
include_once("../config/setting.inc");
//die(var_dump("11111"));
include_once(LIB_PATH."Tools.class.php");
// include_once("../lib/db/menu.class.php");

$tools = new Tools();

$tpl->title = $SERVICE_NAME;

// 初始化PAGE值
if(!isset($_GET['page']))
    $_GET['page'] = 'home';

//邏輯面
if($_GET['page']){
    include_once("action/".$_GET['page'].".php");
}

// 呈現面
$tpl->display("templates/".$_GET['page'].".tpl.php");
?>