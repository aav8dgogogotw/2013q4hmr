<script type="text/javascript">




//368縣市的處理

department2=new Array();
department2[1]=["請選擇鄉鎮區", "板橋區", "三重區", "蘆洲區", "新莊區", "汐止區", "新店區", "中和區", "永和區", "土城區", "樹林區", "三峽區", "鶯歌區", "瑞芳區", "淡水區", "八里區", "萬里區", "金山區", "深坑區", "石碇區", "平溪區", "雙溪區", "貢寮區", "坪林區", "烏來區", "泰山區", "林口區", "五股區", "三芝區", "石門區"];   //新北市
department2[2]=["請選擇鄉鎮區", "桃園市", "中壢市", "平鎮市", "八德市", "大溪鎮", "楊梅鎮", "龍潭鄉", "新屋鄉", "觀音鄉", "龜山鄉", "復興鄉", "大園鄉", "蘆竹鄉"];  //桃園縣
department2[3]=["請選擇鄉鎮區", "竹北市", "新埔鎮", "關西鎮", "竹東鎮", "湖口鄉", "新豐鄉", "芎林鄉", "寶山鄉", "五峰鄉", "橫山鄉", "尖石鄉", "北埔鄉", "峨眉鄉"];   //新竹縣       
department2[4]=["請選擇鄉鎮區", "苗栗市", "竹南鎮", "頭份鎮", "後龍鎮", "通霄鎮", "苑裡鎮", "卓蘭鎮", "三灣鄉", "南庄鄉", "獅潭鄉", "造橋鄉", "頭屋鄉", "公館鄉", "大湖鄉", "泰安鄉", "銅鑼鄉", "三義鄉", "西湖鄉"];  //苗栗縣
department2[5]=["請選擇鄉鎮區", "中山區", "安樂區", "七堵區", "暖暖區", "仁愛區", "信義區", "中正區"];    //基隆市          
department2[6]=["請選擇鄉鎮區", "北投區", "士林區", "內湖區", "松山區", "中山區", "大同區", "南港區", "信義區", "大安區", "中正區", "萬華區", "文山區"];   //台北市
department2[7]=["請選擇鄉鎮區", "北區", "香山區", "東區"];   //新竹市
department2[8]=["請選擇鄉鎮區", "大里區", "太平區", "豐原區", "大甲區", "沙鹿區", "東勢區", "梧棲區", "清水區", "潭子區", "大雅區", "龍井區", "烏日區", "霧峰區", "神岡區", "大肚區", "后里區", "外埔區", "新社區", "大安區", "石岡區", "和平區", "西屯區", "南屯區", "北屯區", "東區", "西區", "南區", "北區", "中區"];    //台中市
department2[9]=["請選擇鄉鎮區", "彰化市", "北斗鎮", "二林鎮", "田中鎮", "員林鎮", "溪湖鎮", "和美鎮", "鹿港鎮", "埔鹽鄉", "線西鄉", "伸港鄉", "社頭鄉", "永靖鄉", "溪洲鄉", "竹塘鄉", "大城鄉", "芳苑鄉", "芬園鄉", "花壇鄉", "秀水鄉", "福興鄉", "埔心鄉", "大村鄉", "田尾鄉", "埤頭鄉", "二水鄉"];    //彰化縣
department2[10]=["請選擇鄉鎮區", "南投市", "草屯鎮", "埔里鎮", "集集鎮", "竹山鎮", "中寮鄉", "國姓鄉", "仁愛鄉", "名間鄉", "水里鄉", "魚池鄉", "信義鄉", "鹿谷鄉"];   //南投縣
department2[11]=["請選擇鄉鎮區", "斗六市", "斗南鎮", "虎尾鎮", "西螺鎮", "土庫鎮", "北港鎮", "東勢鄉", "大埤鄉", "褒忠鄉", "台西鄉", "崙背鄉", "麥寮鄉", "林內鄉", "古坑鄉", "莿桐鄉", "二崙鄉", "水林鄉", "口湖鄉", "四湖鄉", "元長鄉"];   //雲林縣
department2[12]=["請選擇鄉鎮區", "太保市", "朴子市", "大林鎮", "布袋鎮", "民雄鄉", "中埔鄉", "番路鄉", "梅山鄉", "竹崎鄉", "阿里山鄉", "大埔鄉", "水上鄉", "鹿草鄉", "東石鄉", "六腳鄉", "新港鄉", "溪口鄉", "義竹鄉"];   //嘉義縣
department2[13]=["請選擇鄉鎮區", "東區", "西區"];   //嘉義市
department2[14]=["請選擇鄉鎮區", "永康區", "新營區", "麻豆區", "佳里區", "新化區", "學甲區", "白河區", "鹽水區", "善化區", "歸仁區", "左鎮區", "玉井區", "楠西區", "南化區", "仁德區", "關廟區", "龍崎區", "官田區", "西港區", "七股區", "將軍區", "北門區", "後壁區", "東山區", "六甲區", "下營區", "柳營區", "大內區", "山上區", "新市區", "安定區", "北區", "中西區", "東區", "南區", "安南區", "安平區"];   //台南市
department2[15]=["請選擇鄉鎮區", "鳳山區", "岡山區", "旗山區", "美濃區", "仁武區", "大社區", "路竹區", "阿蓮區", "田寮區", "燕巢區", "橋頭區", "梓官區", "彌陀區", "永安區", "湖內區", "大寮區", "林園區", "鳥松區", "大樹區", "六龜區", "內門區", "杉林區", "甲仙區", "桃源區", "那瑪夏區", "茂林區", "茄萣區", "楠梓區", "左營區", "鼓山區", "三民區", "鹽埕區", "前金區", "新興區", "苓雅區", "前鎮區", "小港區", "旗津區"];   //高雄市
department2[16]=["請選擇鄉鎮區", "屏東市", "東港鎮", "恆春鎮", "潮州鎮", "三地門鄉", "霧台鄉", "瑪家鄉", "九如鄉", "里港鄉", "高樹鄉", "鹽埔鄉", "長治鄉", "麟洛鄉", "竹田鄉", "內埔鄉", "萬丹鄉", "泰武鄉", "來義鄉", "新園鄉", "新埤鄉", "林邊鄉", "佳冬鄉", "枋寮鄉", "春日鄉", "枋山鄉", "獅子鄉", "牡丹鄉", "車城鄉", "滿州鄉", "崁頂鄉", "琉球鄉", "南州鄉", "萬巒鄉"];   //屏東縣
department2[17]=["請選擇鄉鎮區", "宜蘭市", "頭城鎮", "羅東鎮", "蘇澳鎮", "礁溪鄉", "壯圍鄉", "員山鄉", "三星鄉", "大同鄉", "五結鄉", "冬山鄉", "南澳鄉"];   //宜蘭縣
department2[18]=["請選擇鄉鎮區", "花蓮市", "玉里鎮", "鳳林鎮", "新城鄉", "秀林鄉", "吉安鄉", "壽豐鄉", "光復鄉", "豐濱鄉", "瑞穗鄉", "萬榮鄉", "卓溪鄉", "富里鄉"];   //花蓮縣
department2[19]=["請選擇鄉鎮區", "台東市", "成功鎮", "關山鎮", "綠島鄉", "蘭嶼鄉", "延平鄉", "卑南鄉", "鹿野鄉", "海端鄉", "池上鄉", "東河鄉", "長濱鄉", "太麻里鄉", "金峰鄉", "大武鄉", "達仁鄉"];   //台東縣
department2[20]=["請選擇鄉鎮區", "馬公市", "西嶼鄉", "望安鄉", "七美鄉", "白沙鄉", "湖西鄉"];   //澎湖縣
department2[21]=["請選擇鄉鎮區", "金沙鎮", "金湖鎮", "金城鎮", "金寧鄉", "烈嶼鄉", "烏坵鄉"];   //金門縣
department2[22]=["請選擇鄉鎮區", "南竿鄉", "北竿鄉", "莒光鄉", "東引鄉"];   //連江縣


function renewcity(index){
    for(var i=0;i<department2[index].length;i++)
        document.myCity.addr.options[i]=new Option(department2[index][i], department2[index][i]);   // 設定新選項
    document.myCity.addr.length=department2[index].length; // 刪除多餘的選項
}




department=new Array();
department[1]=["請選擇細項", "照燒豬肉炒烏龍", "沙茶燒肉炒烏龍", "泡菜海鮮炒烏龍"];  
department[2]=["請選擇細項", "炸醬麵", "香菇肉燥麵", "蒜拌麵"]; 
department[3]=["請選擇細項", "咖哩嫩雞飯", "起司海鮮飯", "南瓜燻雞飯", "野菇燻雞焗飯"];        
department[4]=["請選擇細項", "鮭魚炒飯", "蝦仁炒飯", "素三杯炒飯", "香腸蛋炒飯", "鹹魚雞粒炒飯", "韓式泡菜豬肉炒飯"];

department[5]=["請選擇細項", "蕃茄肉醬義大利麵", "奶油培根義大利麵", "青醬蛤蜊義大利麵", "奶油明太子義大利細麵", "泰式酸辣墨魚義大利麵", "墨西哥香辣香腸義大利麵"];              
function renew(index){
    for(var i=0;i<department[index].length;i++)
        document.myForm.fooditems.options[i]=new Option(department[index][i], department[index][i]);   // 設定新選項
    document.myForm.fooditems.length=department[index].length; // 刪除多餘的選項
}
</script>






<div  style="display:none; align:center">
    <!-- 任務1(加入桂冠輕鬆生活粉絲團) -->
    <div id="m1block" class="m1block">
   
        <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Flaurel.hmr&amp;width=292&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=241705639316957" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:258px;" allowTransparency="true"></iframe><button id="fb-fans-btn">確定</button>
   
       
    </div>

  

<!--//完成得到抽獎資格的頁面(遊戲成功)-->


<div class="DiaBox" id="Success">


    <div class="DiaTitle"> <a href="?page=game" title="關閉" class="ButClose">關閉</a></div>
    <div class="DiaCont">
        <div class="LinkAgain">
            <a id="play_again" href="?page=game&acton=success" title="再玩一次">再玩一次</a>
        </div>      
    </div>
</div>

<!--//recipe食譜的放大-->


<!--//recipe食譜的放大結束-->



<!--//首頁影片的連結-->
<div  id="video_url" style="width:640px; height:480px; position:relative;  ">
    <iframe width="560" height="315" src="//www.youtube.com/embed/QqX8enSHWVY" frameborder="0" allowfullscreen></iframe>
    <a href="javascript: close();">
            <img src="images/BtnClose.png" width="32" height="34" class="close4" title="關閉"/>
     </a>
</div>




<div  id="recipe_url" style="width:640px; height:480px; position:relative;  ">
    <iframe width="600" height="600" src="images/01.jpg" frameborder="0" allowfullscreen></iframe>
    <a href="javascript: close();">
            <img src="images/BtnClose.png" width="32" height="34" class="close4" title="關閉"/>
     </a>
</div>

<div  id="recipe02_url" style="width:640px; height:480px; position:relative;  ">
    <iframe width="600" height="600" src="images/02.jpg" frameborder="0" allowfullscreen></iframe>
    <a href="javascript: close();">
            <img src="images/BtnClose.png" width="32" height="34" class="close4" title="關閉"/>
     </a>
</div>

<div  id="recipe03_url" style="width:640px; height:480px; position:relative;  ">
    <iframe width="600" height="600" src="images/03.jpg" frameborder="0" allowfullscreen></iframe>
    <a href="javascript: close();">
            <img src="images/BtnClose.png" width="32" height="34" class="close4" title="關閉"/>
     </a>
</div>

<div  id="recipe04_url" style="width:640px; height:480px; position:relative;  ">
    <iframe width="600" height="600" src="images/04.jpg" frameborder="0" allowfullscreen></iframe>
    <a href="javascript: close();">
            <img src="images/BtnClose.png" width="32" height="34" class="close4" title="關閉"/>
     </a>
</div>

<div  id="recipe05_url" style="width:640px; height:480px; position:relative;  ">
    <iframe width="600" height="600" src="images/05.jpg" frameborder="0" allowfullscreen></iframe>
    <a href="javascript: close();">
            <img src="images/BtnClose.png" width="32" height="34" class="close4" title="關閉"/>
     </a>
</div>

<!--//完成得到參加獎的頁面(遊戲失敗)-->
<div class="DiaBox" id="Fail" >
    <div class="DiaTitle"> <a href="?page=game" title="關閉" class="ButClose">關閉</a></div>
    <div class="DiaCont">
        <div class="Number">
             <?php echo  $this->getcoupon["coupon"];  ?>
        </div>      
    </div>
</div>


<!-- 遊戲成功或失敗的抽獎要填寫的表單 -->
   <?php  if($this->ishavedata == 0){  ?>
    <div class="DiaBox" id="Fill">
    <div class="DiaTitle"> <a href="?page=game" title="關閉" class="ButClose">關閉</a></div>
    <div class="DiaCont">
        <div class="NormalForm">
            <ul>
                <li class="clearfix">
                    <div class="ItemHead">
                        <label for="user_name">姓名</label>
                    </div>
                    <div class="ItemBox">
                        <input type="text" name="user_name" id="user_name" class="Text">
                        <input type="hidden" name="user_coupon" id="user_coupon" 
                        value=<?php echo  $this->getcoupon["coupon"];?>>
                    </div>
                </li>
                <li class="clearfix">
                    <div class="ItemHead">
                        <label for="user_email">Email</label>
                    </div>
                    <div class="ItemBox">
                        <input type="text" name="user_email" id="user_email" class="Text">
                    </div>
                </li>

                <li class="clearfix">
                    <div class="ItemHead">
                        <label for="user_tel">聯絡電話</label>
                    </div>
                    <div class="ItemBox">
                        <input type="text" value="" name="user_tel" id="user_tel">
                    </div>
                </li>

                <li class="clearfix">
                    <div class="ItemHead">
                        <label for="user_addr">地址</label>
                    </div>
                    <div class="ItemBox">
                <form name="myCity">
                 <select id="country" name="country" class="Select" 
                        onChange="renewcity(this.selectedIndex);">
                            <option value="請選擇縣市">請選擇縣市
                 <option value="新北市">新北市
                 <option value="桃園縣">桃園縣
                 <option value="新竹縣">新竹縣
                 <option value="苗栗縣">苗栗縣
                 <option value="基隆市">基隆市
                 <option value="台北市">台北市
                 <option value="新竹市">新竹市
<option value="台中市">台中市
<option value="彰化縣">彰化縣
<option value="南投縣">南投縣
<option value="雲林縣">雲林縣
<option value="嘉義縣">嘉義縣
<option value="嘉義市">嘉義市
<option value="台南市">台南市
<option value="高雄市">高雄市
<option value="屏東縣">屏東縣
<option value="宜蘭縣">宜蘭縣
<option value="花蓮縣">花蓮縣
<option value="台東縣">台東縣
<option value="澎湖縣">澎湖縣
<option value="金門縣">金門縣
<option value="連江縣">連江縣
                        </select>

<select id="addr" name="addr"  
onChange="this.options[this.selectedIndex].value;"
class="Select">
    <option value="">請先由左方選取縣市
</select>
<input type="text" name="user_addr" id="user_addr" class="Text" style="width:120px">
</form>
               
                        
                    </div>
                </li>

                <li class="clearfix">
                    <div class="ItemHead">
                        <label>到貨時間</label>
                    </div>
                    <div class="ItemBox">
                        <input id="attend_time" name="attend_time" value="1"  type="radio"  checked>
                        中午前
                        <input id="attend_time" name="attend_time" value="2"  type="radio">
                        12-17時
                        <input id="attend_time" name="attend_time" value="3" type="radio">
                        17-20時 
                    </div>
                </li>

                <li class="clearfix">
                    <div class="ItemHead">
                        <label>您是</label>
                    </div>
                    <div class="ItemBox">
                        <input type="radio" id="iswork" name="iswork" value="1"   type="radio"  checked>
                        家管
                        <input type="radio" id="iswork" name="iswork" value="2"   type="radio" >
                        上班族
                        
                    </div>
                </li>

                <li class="clearfix">
                    <div class="ItemHead">
                        <label>家裡是否有小朋友</label>
                    </div>
                    <div class="ItemBox">
                        <input id="isfriend" name="isfriend" value="1"  type="radio" checked>
                        有 ，<input type="text" name="friendyears"  id="friendyears"  class="Text02"> 歲
                        <input id="isfriend" name="isfriend" value="0"   type="radio" >
                        沒有
                        
                    </div>
                </li>

                <li class="clearfix">
                    <div class="ItemHead">
                        <label>有沒有買過微波食品</label>
                    </div>
                    <div class="ItemBox">
                        <input  id="isfood1" name="isfood" value="1"  type="radio" checked>
                        有 
                        <input  id="isfood1" name="isfood" value="0"  type="radio">
                        沒有
                        
                    </div>
                </li>

                <li class="clearfix">
                    <div class="ItemHead">
                        <label>最喜歡桂冠哪一支口味</label>
                    </div>
                    <div class="ItemBox">    <form name="myForm">                     
                        <select id="foodspecies" name="foodspecies" class="Select"  onChange="renew(this.selectedIndex);">
                            <option value="請選擇">請選擇
                     <option value="炒烏龍">炒烏龍
                    <option value="醬拌麵">醬拌麵
                    <option value="洋飯">洋飯
                      <option value="炒飯">炒飯
                        <option value="義大利麵">義大利麵
                        </select>
                        <select id="fooditems" name="fooditems" class="Select" onChange="this.options[this.selectedIndex].value;">
    <option value="">請先由左方選取種類
</select>
</form>
                    </div>
                </li>

                <li class="clearfix">
                    <div class="ItemHead">
                        <label>您何時會開火</label>
                    </div>
                    <div class="ItemBox">                       
                        <input id="howfire" name="howfire" value="1"  type="radio" checked >
                        平日 
                        <input  id="howfire" name="howfire" value="2"  type="radio">
                        假日
                        <input  id="howfire" name="howfire" value="3"  type="radio" >
                        都有
                        <input  id="howfire" name="howfire" value="4"  type="radio" >
                        都沒有
                    </div>
                </li>

                <li class="clearfix">
                    <div class="ItemHead">
                   
                    </div>

                    <div class="ItemBox">      
                        <div id="require_error"></div>                  
                        <input type="checkbox" id="agreedata" name="agreedata" value="1"/>
                        我同意未來收到更多報名或食譜資訊  <br>
                         <input type="checkbox" id="readservice" name="readservice" value="1" checked/>
                        我已閱讀並了解<a href="?page=privacy" title="隱私權保護政策" target="_blank"><font color="#ff7e7e">桂冠隱私權條款</font></a>
                        
                    </div>
                </li>



            </ul>

            <div class="ButtonBar">
            <a  id="btn_reset" href="javascript: void(0);" class="BtnReset">重填</a>
            <a id="btn_submit" href="javascript: void(0);" class="BtnSubmit">送出</a>
        </div>

        </div> 
    </div>
</div>

    <?php  } ?>




</div>