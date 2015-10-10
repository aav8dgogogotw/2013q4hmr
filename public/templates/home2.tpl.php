<?php include_once("header.tpl");?>
<?php include_once("fb.tpl");?>
<script>
    init(function(){
        <?php if($this->act['active'] == 1):?>
            $("#act1").bind("click", function(){
                checkFans();
            });
        <?php endif;?>

        <?php if($this->act['active'] == 2):?>
            $("#act2").bind("click", function(){
                inviteFriend(2);
            });
        <?php elseif($this->act['active'] > 2):?>
            $("#act2").bind("click", function(){
                inviteFriend(0);
            });
        <?php endif;?>

        <?php if($this->act['active'] == 3):?>
            $("#act3").bind("click", function(){                
                postMsg(1);
            });
        <?php elseif($this->act['active'] > 3):?>
            $("#act3").bind("click", function(){
                postMsg(0);
            });
        <?php endif;?>        

        <?php if($this->act['active'] == 4):?>
            $("#act4").bind("click", function(){
                checkGame(2);
            });
        <?php endif;?>

        <?php if($this->act['active'] == 5):?>
            $("#act5").bind("click", function(){                
                inviteFriend(5);
            });
        <?php elseif($this->act['active'] > 5):?>
            $("#act5").bind("click", function(){
                inviteFriend(0);
            });
        <?php endif;?>

        <?php if($this->act['active'] == 6):?>
            $("#act6").bind("click", function(){
                checkGame(4);
            });
        <?php endif;?>
    });
</script>
<a id="act1" href="javascript: void(0);"><img src="../images/<?php echo $this->act['pass']>0?"white":"black"?>.jpg"/></a>
<a id="act2" href="javascript: void(0);"><img src="../images/<?php echo $this->act['pass']>1?"white":"black"?>.jpg"/></a>
<a id="act3" href="javascript: void(0);"><img src="../images/<?php echo $this->act['pass']>2?"white":"black"?>.jpg"/></a>
<a id="act4" href="javascript: void(0);"><img src="../images/<?php echo $this->act['pass']>3?"white":"black"?>.jpg"/></a>
<a id="act5" href="javascript: void(0);"><img src="../images/<?php echo $this->act['pass']>4?"white":"black"?>.jpg"/></a>
<a id="act6" href="javascript: void(0);"><img src="../images/<?php echo $this->act['pass']>5?"white":"black"?>.jpg"/></a>
<?php include_once("fans.tpl");?>
<?php include_once("footer.tpl");?>