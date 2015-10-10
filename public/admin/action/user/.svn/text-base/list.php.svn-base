<?php

$param["at"] = $tools->sql_injection_anti($_GET['at']);
if(empty($param["at"]))
    $param["at"] = 0;

$param["limit"] = 50;

$param['account'] = $_SESSION['account'];

include_once(LIB_PATH . "Table/User.class.php");
$tb_user = new User();

$counts = $tb_user->countUser();
$tpl->counts = $counts;

$pageBar['url']      = "index.php?page=user/list&at=";
$pageBar['current']  = floor($param["at"]);                 // 當前頁數
$pageBar['pageNums'] = ceil( $counts / $param["limit"]);    // 總頁數
$pageBar['rowNums']  = floor($counts);                      // 總筆數

$tpl->pageBar = $pageBar;

$offset = $param["at"] * $param["limit"];

$list = $tb_user->listUser($offset, $param["limit"]);
/*
if ($list) {
    foreach ($list as $key => $value) {
        $date = $value['log_time'];



    }    
}
*/

$tpl->list = $list;
?>