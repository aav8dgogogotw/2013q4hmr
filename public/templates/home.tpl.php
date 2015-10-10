<?php include_once("header.tpl");?>
    <script>
        logClick(1);    
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
      caption: 'www.laurel.com.tw',
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

   

		<!--玩遊戲的流程START -->
		
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

<?php include_once("mission.tpl");?>
<?php include_once("show.tpl");?>
<?php include_once("fb.tpl");?>
<?php include_once("footer.tpl");?>