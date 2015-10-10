//global functions for flash

// 取得參加獎狀態 (每次輸的對話框出來時都會call一次，確保flash裡得到的資料是最新的)
function getJoinPrizeStatus() {
    /*
    0 是沒拿過，庫存也還有
    1 拿過
    2 庫存沒了
    */
    return 0;
}

// 贏會call這支
function fbsharePage() {
    alert('u win, and the alert is fired by js func -> fbsharePage.');
}

// 輸會call這支
function gamefailPage() {
    alert('u loose, and the alert is fired by js func -> gamefailPage.');
}

// 如果領完獎不需切換頁面的話，可以CALL這支來replay遊戲
function replay() {
    var swf = swfobject.getObjectById('flashcontent');
	swf.replay();
}

// 寫入flash
jQuery(document).ready(function() {
    swfobject.embedSWF('swf/game.swf', 'flashcontent', '990', '515', '9.0.0', 'js/libs/expressInstall.swf', null, {wmode: 'opaque'});
});