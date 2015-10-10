<?php

// 定義ROOT路徑
// defined('ROOT_PATH') || define('ROOT_PATH', realpath(dirname(__FILE__)));

// 定義PHP套件路徑
// defined('LIB_PATH') || define('LIB_PATH', realpath(dirname(__FILE__) . '/../lib'));

// 定義設定檔路徑
// defined('CONFIG_PATH') || define('CONFIG_PATH', realpath(dirname(__FILE__) . '/../config'));

// 定義ACTION路徑
// defined('ACTION_PATH') || define('ACTION_PATH', ROOT_PATH . '/action');

//// 定義頁面檔路徑
//defined('TEMPLATE_PATH') || define('TEMPLATE_PATH', ROOT_PATH . '/templates');

ini_set('display_errors','on');
ini_set("session.use_only_cookies","1");;

header('Content-type: text/html; charset=utf-8');
header('Vary: Accept-Language');
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA div COM NAV OTC NOI DSP COR"');

// config
include_once("../../config/setting.inc");

include_once(LIB_PATH."Tools.class.php");
// include_once("../lib/db/menu.class.php");

$tools = new Tools();

$tpl->title = '海商紀元後端管理系統';

// 初始化PAGE值
if($_SESSION["adm_id"] == '')
    $_GET['page'] = 'login';
else if($_SESSION["adm_id"] != '' && !isset($_GET['page']))
    $_GET['page'] = 'welcome';

//邏輯面
if($_GET['page']){
    include_once("action/".$_GET['page'].".php");
}

// 呈現面
$tpl->display("templates/".$_GET['page'].".tpl.php");
?>