<!DOCTYPE HTML>
<html xmlns:fb="http://ogp.me/ns/fb#">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <meta name="google" value="notranslate" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="桂冠雲吞、輕鬆料理五字訣 煮扣拌加好、桂冠、桂冠食品、食譜、關西風雲吞烏龍麵、日式咖哩雲吞、五彩香郁雲吞湯、紅蔥肉燥雲吞、簡單美味、好心情、晴天娃娃、翻轉好心情、菜肉雲吞、鮮蝦雲吞、雲吞娃娃、輕鬆做晚餐、簡單輕盈">
    <meta property="og:title" content="簡單做 開心吃 快樂料理在我家" />

    <meta property="og:site_name" content=""/>
    <meta property="og:title" content="" /> 
    <meta property="og:description" content="" /> 
    <meta property="og:image" content="" />
    <title><?php echo $this->title?></title>
    <link rel="shortcut icon" href="images/icon.png">
    <link href="css/rest.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript"  src="js/action/libs/jquery-1.9.1.min.js"></script>
    <script type="text/javascript"  src="js/action/libs/swfobject.js"></script>
    <script type="text/javascript"  src="js/action/main.js"></script>


    <script type="text/javascript" src="https://connect.facebook.net/zh_TW/all.js"></script>
    <script type="text/javascript" src="https://static.ak.fbcdn.net/connect.php/js/FB.Share"></script>

    <script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery/plugins/jquery.blockUI.min.js"></script>

    <script type="text/javascript" src="js/jquery/jquery.validate.js"></script>

    
    
    <script type="text/javascript" src="js/action/FbLogin.js?v=<?php echo md5(date("YmdHis"));?>"></script>
    <script type="text/javascript" src="js/action/main.js?v=<?php echo md5(date("YmdHis"));?>"></script>
    <style>
    </style>
  </head>
  <body id="bg" onload="MM_preloadImages('images/menu01.png','images/menu02.png','images/menu03.png','images/menu04.png')"> 

  <div id="Header">
    <div class="Warpper clearfix">
        <h1><a href="http://www.laurel.com.tw/" title="桂冠十分輕鬆料理" target="_blank">桂冠十分輕鬆料理</a></h1>
    <div class="NavBlock">
            <ul class="Navigation">

                <li class="Nav01"><a href="?page=home" title="首頁" class="Active">首頁</a></li>


               <!--玩遊戲的流程START-->
                <li class="Nav02">
                    <?php if($this->act['active'] == 1):?>
                    <a href="javascript: checkFans();" title="玩遊戲" >玩遊戲</a>
                <?php elseif($this->act['active'] > 1):?>
                    <a href="?page=game" title="玩遊戲" >玩遊戲</a>
                 <?php else:?>
           <!--
            <a id="link_login" href="javascript: linkClick(7);"></a>
           -->
            <a id="link_map" href="javascript: linkClick(0);">玩遊戲</a>
                 <?php endif;?>
                </li>
                 <!--玩遊戲的流程END http://fv38.com/80437-->
             
               <li class="Nav03"><a href="javascript: introClick();" title="親子料理食譜">親子料理食譜</a></li>           
                <li class="Nav04"><a href="http://fv38.com/80437" title="料理照片募集" target="_blank">料理照片募集</a></li>
                <li class="Nav05"><a href="javascript: activeClick();" title="活動辦法">活動辦法</a></li>    
                <li class="LikeBlock"><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fevent.laurel.com.tw%2F2013Q4HMR%2F&amp;width=100&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;send=false&amp;appId=220758728092584" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></li>
            </ul>
        </div>
</div>   
</div>