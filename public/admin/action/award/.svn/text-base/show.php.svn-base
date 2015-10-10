<?php

$param["at"] = $tools->sql_injection_anti($_GET['at']);
if(empty($param["at"]))
    $param["at"] = 0;

$param["limit"] = 15;

$param['stage']   = $tools->sql_injection_anti($_GET['stage']);
$param['account'] = $_SESSION['account'];

switch ($param['stage']) {
    case "A":

        // no break;
    case "B":

        // no break;
    case "C":

        // no break;
    case "D":

        // no break;
    case "E":
        
        // no break;
    case "F":
        
        // no break;
    case "G":
    
        // no break;
    case "H":
    
        // no break;
    case "I":

        // no break;
    case "J":
        break;
    default: 

        echo "<script>alert('關卡設定錯誤'); location.href='index.php?page=award/list';</script>";
        exit;
}

include_once(LIB_PATH . "Table/AwardSn.class.php");
$tb_award_sn = new AwardSn();

$counts = $tb_award_sn->countAwardSnByStage($param['stage']);

$pageBar['url']      = "index.php?page=award/show&stage=A&at=";
$pageBar['current']  = floor($param["at"]);                 // 當前頁數
$pageBar['pageNums'] = ceil( $counts / $param["limit"]);    // 總頁數
$pageBar['rowNums']  = floor($counts);                      // 總筆數

// $tpl->pageBar = $pageBar;

$list = $tb_award_sn->listAwardSnByStage($param['stage']);

$tpl->list = $list;
?>