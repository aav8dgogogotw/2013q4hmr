<?php

$stage = Array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J");

include_once(LIB_PATH . "Table/AwardSn.class.php");
$tb_award_sn = new AwardSn();

$stageTitle = Array();
$stageTitle["A"] = "關卡 I - 送10萬銀幣";
$stageTitle["B"] = "關卡 II - 送10萬祝福";
$stageTitle["C"] = "關卡 III - 送2個屬性刷新水晶";
$stageTitle["D"] = "關卡 IV - 送全家39元早餐兌換券";
$stageTitle["E"] = "關卡 V - 送1級隨機寶石";
$stageTitle["F"] = "關卡 VI - 「HTC New One」抽獎機會";
$stageTitle["G"] = "限量虛寶 - 九藏";
$stageTitle["H"] = "限量虛寶 - 森野樹";
$stageTitle["I"] = "限量虛寶 - 龍魂";
$stageTitle["J"] = "限量虛寶 - 黑鬍子祕寶";

$tpl->stageTitle = $stageTitle;

$stageCounts = Array();
foreach ($stage as $value) {
    $stageCounts[$value] = $tb_award_sn->countAwardSnByStage($value);
    $stageCountsUserGet[$value] = $tb_award_sn->countAwardSnByStageUserGet($value);
}

$tpl->list = $stageCounts;
$tpl->stageCountsUserGet = $stageCountsUserGet;
?>