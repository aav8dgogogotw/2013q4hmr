<?php

$param['stage']   = $tools->sql_injection_anti($_POST['stage']);
$param['account'] = $_SESSION['account'];

switch ($param['stage']) {
    case "A":

        // no break
    case "B":

        // no break
    case "C":

        // no break
    case "D":

        // no break
    case "E":

        // no break
    case "F":

        // no break
    case "G":

        // no break
    case "H":

        // no break
    case "I":

        // no break
    case "J":
        break;
    default:
        echo "<script>alert('關卡設定錯誤'); location.href='index.php?page=award/edit';</script>";
        exit;
}

// 處理 EXCEL
include_once(LIB_PATH . "PHPExcel.php");

// 分析文件
if ($_FILES["file"]["error"] > 0){
    switch($_FILES["file"]["error"]){
        case 1: 
            echo "<script>alert('錯誤:上傳檔案大小超過系統預設值'); location.href='/admin/message/multimessage'</script>";
            break;
        case 2: 
            echo "<script>alert('錯誤:上傳檔案大小超過系統預設值'); location.href='/admin/message/multimessage'</script>"; 
            break;
        case 4: 
            echo "<script>alert('錯誤:未上傳任何檔案'); location.href='/admin/message/multimessage'</script>"; 
            break;
        default : 
            echo "<script>alert('錯誤:上傳檔案失敗'); location.href='/admin/message/multimessage'</script>"; 
            break;
    }
    exit;
}
        
if ($_FILES["file"]["type"] == 'application/ms-excel' || $_FILES["file"]["type"] == 'application/vnd.ms-excel') {

    // do nothing
} else {
    echo "<script>alert('錯誤:請上傳Excel xls格式檔案'); location.href='index.php?page=award/edit';</script>";
    exit;
}

$ObjExcel = new PHPExcel();

// 讀取舊版 excel 檔案
$reader = PHPExcel_IOFactory::createReader("Excel5");
try {

    // 檔案名稱
    $PHPExcel = $reader->load($_FILES["file"]["tmp_name"]);
} catch(Exception $e) {
    echo "<script>alert('請使用與97-2003完全相容的活頁簿格式'); location.href='index.php?page=award/edit';</script>";
    exit;
}

// 讀取第一個工作表(編號從 0 開始)
$sheet = $PHPExcel->getSheet(0);

// 取得總列數
$highestRow = $sheet->getHighestRow();

// 一次讀取一列
try {
    $sn_array = Array();
    for ($row = 1; $row <= $highestRow; $row++) {
        $ary["sn"]   = $sheet->getCellByColumnAndRow(0, $row)->getValue();

        if (!empty($ary["sn"])) {
            array_push($sn_array, $ary);
        } else {
            echo "<script>alert('第".$row."行資料不齊全'); location.href='index.php?page=award/edit';</script>";
            exit;
        }       
    }
} catch(Exception $e) {

    // 若有錯誤就要回覆
    echo "<script>alert('上傳文件格式不符'); location.href='index.php?page=award/edit';</script>";
    exit;
}

     
include_once(LIB_PATH . "Table/AwardSn.class.php");
$tb_award_sn = new AwardSn();

if (!empty($sn_array)) {
    foreach($sn_array as $key=>$value){
        $affectedRow = $tb_award_sn->addAwardSn($param['stage'], $value["sn"], $param['account']);
        if(empty($affectedRow)) {
            echo "<script>alert('訊息儲存發生錯誤'); location.href='index.php?page=award/edit';</script>";
            exit;
        }
    }
}

// 取得目前數量
$counts = $tb_award_sn->countAwardSnByStage($param['stage']);        

echo "<script>alert('資料儲存完成，共" . $counts . "筆。'); location.href='index.php?page=award/list';</script>";
exit;
?>