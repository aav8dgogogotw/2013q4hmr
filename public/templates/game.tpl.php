<?php include_once("header.tpl");?>
<?php include_once("fb.tpl");?>

        

<script  type="text/javascript" language="javascript">


<!--//遊戲成功或失敗出現的表單-->




function lotteryForm(isfail,issuccess) {

    var fail = isfail;
    var success = issuccess;
   // var coupon = "<?echo $value;?>";  

    var showObj = {
        name: "Fill",
        top: "50px",
        left: "30%",
        width: "800px",
        height: "400px",
        opacity: 0.5
    };
    show(showObj);

    var btn_reset = $("#btn_reset");
    var btn_submit = $("#btn_submit");
    var user_name = $("#user_name");
    var user_email = $("#user_email");
    var user_tel = $("#user_tel");
    var user_addr = $("#user_addr");
    var agreedata = $("#agreedata");
    var readservice = $("#readservice");
    var friendyears = $("#friendyears");
    var user_coupon = $("#user_coupon");
    
    
 


    btn_reset.bind("click", function() {
        user_name.val("");
        user_email.val("");
        user_tel.val("");
        user_addr.val("");
        friendyears.val("");
        //attend_time.val("");
    });

    btn_submit.bind("click", function() {

      //3. 填寫資料送出的按鈕
      ga('send', 'event', 'data_submit_button', 'data_submit_click', 'data_submit');
    
       var reg = /[\w-]+@([\w-]+\.)+[\w-]+/;
       var tel = /^(\d{3,4}-?)?\d{7,9}$/g;
     //  var chinese = /^[a-z0-9_u4e00-u9fa5]+[^_]$/g; 

        if(user_name.val() == "") {
           $('#require_error').html('<font color=red>*你必須要填寫中文或英文名字!!</font>');
           
        //  }else if(!chinese.test(user_name.val())) {
             // $('#require_error').html('<font color=red>*你只能輸入中英文或部份數字!!</font>'); 

          }else if(user_name.val() != "" && user_email.val() == "") {
              
              $('#require_error').html('<font color=red>*你必須要填寫電子郵件!!</font>'); 
              

          }else if(user_email.val() == ""){
           $('#require_error').html('<font color=red>*你必須要填寫電子郵件!!</font>');

       
 
          }else if(!reg.test(user_email.val())) {
              $('#require_error').html('<font color=red>*電子郵件格式不正確!!</font>'); 
             //return false;
          }else if(user_email.val() != "" && reg.test(user_email.val())  && user_tel.val() == "") {
              $('#require_error').html('<font color=red>*你必須要填寫電話!!</font>'); 
           


          }else if(user_tel.val() == ""){
           $('#require_error').html('<font color=red>*你必須要填寫電話!!</font>'); 

          }else if(user_tel.val().length < 9) {
              $('#require_error').html('<font color=red>*請正確填寫你的手機號碼!!</font>'); 

          }else if(user_tel.val() != "" && user_tel.val().length > 9 && user_addr.val() == "") {
              $('#require_error').html('<font color=red>*你必須要填寫地址!!</font>'); 
             // $('#require_tel').html('');
          
          }else if(user_addr.val() == ""){
           $('#require_error').html('<font color=red>*你必須要填寫地址!!</font>'); 
          
          
          
 
        }else {

        $.post('api/active.php', {action:'user.put',  act:"act3"}, function(res) {}, 'json');


       // var friendyears = $("#friendyears").val();
        var attend_time = $("input[name='attend_time']:checked").val(); 
        var isfriend = $("input[name='isfriend']:checked").val();
        var isfood = $("input[name='isfood']:checked").val(); 
        var iswork = $("input[name='iswork']:checked").val(); 
        var howfire = $("input[name='howfire']:checked").val();
        var country = $("#country").val(); 
        var addr = $("#addr").val();
        var foodspecies = $("#foodspecies").val(); 
        var fooditems = $("#fooditems").val();  
        var agreedata= (typeof($("input[name='agreedata']:checked").val()) == "undefined" )? "0":"1"; 
        var readservice= (typeof($("input[name='readservice']:checked").val()) == "undefined" )? "0":"1";   
         
         if(country == "請選擇縣市"){
            $('#require_error').html('<font color=red>*請選擇一個縣市!!</font>'); 

         }else if(addr == "請選擇鄉鎮區" && country != "請選擇縣市"){
            $('#require_error').html('<font color=red>*請選擇一個鄉鎮區!!</font>');
      
         }else if(isfriend == "1" && friendyears.val() == ""){
            $('#require_error').html('<font color=red>*由於家裡有小朋友,必須填歲數!!</font>');

         }else if(foodspecies == "請選擇"){

         $('#require_error').html('<font color=red>*請選擇一個食品分類!!</font>'); 

         }else if(fooditems == "請選擇細項" && foodspecies != "請選擇"){
         $('#require_error').html('<font color=red>*請選擇一個食品細項!!</font>'); 

         }else if(readservice == "0" && user_addr.val() != ""){
          $('#require_error').html('<font color=red>*服務條款必須要勾選!!</font>'); 
         // $('#require_addr').html('');
          
        }else if(readservice == "0"){
          $('#require_error').html('<font color=red>*服務條款必須要勾選!!</font>'); 

        }else{

            $.post('api/active.php', 
            {
                action:'lottery.post', 
                name:user_name.val(), 
                email: user_email.val(),
                tel: user_tel.val(),
                addr: country+addr+user_addr.val(),
                friendyears: friendyears.val(),
                isfail:fail,
                coupon_number: user_coupon.val(),
                issuccess:success,
                attend_time: attend_time,
                isfriend: isfriend,
                isfood: isfood,
                iswork: iswork,
                howfire: howfire,
                agreedata: agreedata,
                readservice: readservice,
                foodspecies: foodspecies,
                fooditems: fooditems
            }, function(res) {
                if(res.message == "OK") {
                    
                    
                    if(fail == 1){
                      lotteryFailForm();
                    }else if(fail == 0){
                      lotterySuccessForm();
                    }

                   // close();


                }else {
                    alert(res.detail);
                }
            }, 'json');

        }

        }
    })
}
// 取得參加獎狀態 (每次輸的對話框出來時都會call一次，確保flash裡得到的資料是最新的)
function getJoinPrizeStatus() {
    /*
    0 是沒拿過，庫存也還有
    1 拿過
    2 庫存沒了
    */
  <?php if($this->lotteryfail["isfail"] == "1"){ ?>  
    return 1;
  <?php }elseif($this->todaylotteryfailtimes > 100){  ?>
    return 2;
  <?php }else{  ?>

    return 0;
  <?php }  ?>
}




function fbsharePage(pass) {

   FbFunc.FbFeed(function(res) {
        if(res) {
            $.post('api/active.php', {action:'user.put', act:"act2"}, function(res) {
                if(res.message == "OK") {
                    if(pass)
                        getAward("C");
                }else {
                    alert(res.detail);
                    location.reload();
                }
            }, 'json');
            $.post('api/active.php', {action:'logClick.post', click:5}, function(res) {}, 'json');
            $.post('api/active.php', {action:'logShare.post'}, function(res) {}, 'json');
           //分享塗鴉牆後就接表單
            <?php  if($this->ishavedata == 0){  ?>
         //  alert("你已經成功地分享於塗鴉牆, 後續請填寫抽獎表單!!");
           lotteryForm(0,1);
           <?php  }else{  ?>
           //SQL語法改變該FB_ID issuccess欄位為1
           $.post('api/active.php', {action:'lottery.put', issuccess:"1"}, function(res) {}, 'json');
        //   alert("你已經填寫過表單!!將直接導到抽獎頁面!!"); 
           lotterySuccessForm();

           <?php  }  ?>

        }
    });

 
}


function gamefailPage() {
     //5. 領取參加獎的按鈕
     ga('send', 'event', 'gift_btn_button', 'gift_btn_click', 'gift_btn');

     $.post('api/active.php', {action:'logClick.post', click:10}, function(res) {}, 'json');
     
     var coupon = $("#coupon");

   // $.post('api/active.php', {action:'user.put', act:"act2"}, function(res) {
    <?php  if($this->ishavedata == 0){  ?>

   // alert("遊戲失敗, 後續請填寫抽獎表單領取參加獎!!");
    lotteryForm(1,0);

    <?php  }else{  ?>
    //SQL語法改變該FB_ID isfail欄位為1,並存入已發送的酷鵬序號
    $.post('api/active.php', {action:'lottery.put', isfail:"1" ,coupon_number:coupon.val()}, function(res) {}, 'json');

   // alert("你已經填寫過表單!!將直接導到領取參加獎頁面!!"); 
    lotteryFailForm();

    <?php  }  ?>
 
}





</script>

 
<?php 
  if(isset($_GET["acton"]) && !empty($_GET["acton"])){

    if($_GET["acton"] == "success"){
          ?>
<script  type="text/javascript" language="javascript">
<!--//以下是透過抓取GET參數來更新資料,預防成功後再按一次的二次表單-->
// get 方法，用 data 参数传值 
$.get('?page=game&acton=success', {action: "success"}, function(data) 
{ 
  replay();
}); 
</script>

<?php
}   
    }
?>
   
    



<input type="hidden" name="coupon" id="coupon" 
                        value=<?php echo  $this->getcoupon["coupon"];?>>



  <?php if($this->act['active'] > 1){?>

  <?php  //定義那些User Agent String屬於手機瀏覽
function check_mobile(){
    $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
    $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
    $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
    $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";   
    $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
    $regex_match.=")/i";
    return preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
} ?>
<?php if( check_mobile() ){  //如果是手機瀏覽，則執行此段語法
?>
<div class="Content Flash SameBlock">
  <img src="images/noplay.jpg" />
</div>

<?php }else{ ?>
  
 
<div class="Content Flash SameBlock">
<div class="Warpper">
   <div id="flashcontent">
        <h2>請稍等，網頁正在下載中...</h2>
        <p>若您等候許久，仍然停留在此畫面，請確認網路是否順暢、Javascript是否開啟，或者沒有安裝 Adobe Flash Player。</p>
        <ul>
            <li id="disabled_javascript">請將瀏覽器的Javascript功能打開。</li>
            <li id="unsupported_flashplayer">請安裝最新的 <a href="http://get.adobe.com/tw/flashplayer/">Adobe Flash Player</a>。</li>
        </ul>
        <p class="appendix"><a href="http://get.adobe.com/tw/flashplayer/"><img src="images/get_adobe_flash_player.png" alt="Download Adobe Flash Player" width="158" height="39" /></a></p>
    </div>
<div>
  <div>
    <?php } ?>

  <?php  }else{  ?>
  <script>
  checkFans();
  </script>

  <script type="text/javascript">
       $(document).ready(function () {
       $('#shareonfacebook').click(function (e) {
         ga('send', 'event', 'share_film_button', 'share_film_click', 'share_film');
      e.preventDefault();
      FB.ui(
      {
      method: 'feed',
      name: '簡單做 開心吃 快樂料理在我家',
      picture: 'http://event.laurel.com.tw/2013Q4hmr/images/fb_movie.jpg',
      link: 'http://event.laurel.com.tw/2013Q4hmr/',
      caption: 'events.laurel.com.tw',
      description: '簡單做開心吃，快樂料理在我家，看影片學輕鬆料理五字訣煮扣拌加好，天天都能美味上桌，輕鬆做菜',
      message: ''
      });
      });
      });
     </script>
     
  <div class="Content HomeBlock SameBlock">
    <div class="Warpper"><img src="images/Tmp.png" width="990" height="600">
        <a class="LinkVideo" href="javascript: videoUrlForm();"></a>
        <a id="shareonfacebook" class="ShareFb">ShareFb</a>

        <!--玩遊戲的流程START-->
        
        <?php if($this->act['active'] == 1):?>
        <a href="javascript: checkFans();" class="LinkPlay">LinkPlay</a>

        <?php elseif($this->act['active'] > 1):?>
        <a href="?page=game" class="LinkPlay">LinkPlay</a>

        <?php else:?>
        <a href="javascript: linkClick(0);" class="LinkPlay">LinkPlay</a>

        <?php endif;?>
        <!--玩遊戲的流程END-->
    </div>
</div>

  <?php  }   ?>

 
   

<?php include_once("mission.tpl");?>
<?php include_once("show.tpl");?>
<?php include_once("footer.tpl");?>