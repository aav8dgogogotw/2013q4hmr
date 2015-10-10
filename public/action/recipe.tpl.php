<?php include_once("header.tpl");?>
    <script>
        logClick(1);    
    </script>
   <script>
   //2. 5套食譜的頁簽按鈕
$('#recipe').bind('click', function() {
  ga('send', 'event', 'recipe1_link', 'recipe1_click', 'recipe1');
  location.href="?page=recipe";
});

$('#recipe02').bind('click', function() {
  ga('send', 'event', 'recipe2_link', 'recipe2_click', 'recipe2');
  location.href="?page=recipe02";
});

$('#recipe03').bind('click', function() {
  ga('send', 'event', 'recipe3_link', 'recipe3_click', 'recipe3');
  location.href="?page=recipe03";
});

$('#recipe04').bind('click', function() {
  ga('send', 'event', 'recipe4_link', 'recipe4_click', 'recipe4');
  location.href="?page=recipe04";
});

$('#recipe05').bind('click', function() {
  ga('send', 'event', 'recipe5_link', 'recipe4_click', 'recipe5');
  location.href="?page=recipe05";
});
   </script>
<div class="Content Recipe01Block SameBlock">
    <div class="Warpper">
        <div class="TabBlock">
                <ul>
                    <li class="Tab01"><a id="recipe" title="青醬蛤蜊麵包盅"  class="Active">青醬蛤蜊麵包盅</a></li>
                    <li class="Tab02"><a id="recipe02" title="墨西哥香辣香腸番茄盅" >墨西哥香辣香腸番茄盅</a></li>
                    <li class="Tab03"><a id="recipe03" title="蝦仁炒飯米蛋糕" >蝦仁炒飯米蛋糕</a></li>
                    <li class="Tab04"><a id="recipe04" title="香腸蛋炒飯米Pizza" >香腸蛋炒飯米Pizza</a></li>
                    <li class="Tab05"><a id="recipe05" title="韓風炸醬麵" >韓風炸醬麵</a></li>
                </ul>
            </div>

            <div class="RecipeBox">             
                <img src="images/recipe.png">
                <!--玩遊戲的流程START -->
        
            <?php if($this->act['active'] == 1):?>
        <a id="LinkPlay" href="javascript: checkFans();" class="LinkGo" title="玩遊戲 抽獎去">玩遊戲 抽獎去</a>

        <?php elseif($this->act['active'] > 1):?>
        <a id="LinkPlay" href="?page=game" class="LinkGo" title="玩遊戲 抽獎去">玩遊戲 抽獎去</a>

        <?php else:?>
        <a id="LinkPlay" href="javascript: linkClick(0);" class="LinkGo" title="玩遊戲 抽獎去">玩遊戲 抽獎去</a>

        <?php endif;?>
        <!--玩遊戲的流程END-->
            </div>      
    </div>
</div>

   

<?php include_once("show.tpl");?>
<?php include_once("fb.tpl");?>
<?php include_once("footer.tpl");?>