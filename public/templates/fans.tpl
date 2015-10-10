<!-- 加入粉絲團:開始-->
    <div id='AppFans' 
    style="top:200px; left:180px; z-index:1000; position:absolute; width:400px; height:190px; display:none; background: url('images/backLike.png') no-repeat; font-family: "微軟正黑體";">
        <div style='margin:10px; color:#1874CD; font-size:14px; line-height:1.5em; position: relative; top: 12px;'>
            請先按讚加入「海商紀元」粉絲頁，<br/>再按下方「確認」即可通過第一關！<BR/>
        </div>
        <fb:like-box href="<?=$this->fansUrl?>" stream="false" header="false" Connections='0' height="95"></fb:like-box>    
<!--        <iframe style="position:relative; left:10px;" src='http://www.facebook.com/connect/connect.php?id=152739014741402&connections=10&css=style.css&stream=0&locale=zh_TW' scrolling='no' frameborder='0' height='270' width='290'></iframe> -->
        <div align="center" style="position: relative; bottom: 5px;">
            <button type='button' onclick='closeFans();' style="margin:3px;">確認</button>
        </div>
    </div>
<!-- 加入粉絲團:結束 -->