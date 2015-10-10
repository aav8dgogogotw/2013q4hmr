<?php include_once("header.tpl");?>
<?php include_once("fb.tpl");?>
<style>
    #fb_icon{
        position: absolute; 
        top: 295px; left: 50px;
        width: 252px; height: 80px;
        background: url('images/f_name.png') no-repeat;
        display: none;
    }
    #fb_pic{position: absolute; top: 15px; left: 15px; width: 50px; height: 50px;}
    #fb_name {
        position: absolute;
        top: 15px; left: 75px;
        width: 160px; height: 50px; line-height: 50px;
        text-align: left; vertical-align: middle;
        font-size: 16px; font-weight: bold;
    }
</style>
<script>
    init(function(){
        var request_ids = '<?php echo $this->request_ids;?>';
        inviteLogin(request_ids);
        HiiirTrack('3132385f33343230cea34869696972547261636b');
        logClick(11);
    });
    function inviteClick(click) {
        switch(parseInt(click)) {
            case 1:
                HiiirTrack("3132385f33343138cea34869696972547261636b");
                logClick(9);
                window.open("<?php echo $this->SERVER_HOST;?>");
            break;
            case 2:
                HiiirTrack("3132385f33343139cea34869696972547261636b");
                logClick(10);
                window.open("https://www.molome.tw/auth/facebook/me");
            break;
        }
    }
</script>
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                text-align: center; vertical-align: middle;">
        <div style="position: relative; width:760px; height:700px; background: url('images/FB2_bg.png') no-repeat; display:inline-block;">
            <a href="javascript: inviteClick(2);" 
                    style="position: absolute; top:210px; left: 339px; width:173px; height:176px;">
                <img src="images/bt_play1.gif" width="173" height="176"/>
            </a>
            <a href="javascript: inviteClick(1);" 
                    style="position: absolute; bottom:35px; left: 245px; width:173px; height:176px;">
                <img src="images/bt_play2.gif" width="173" height="176"/>
            </a>
            <div id="fb_icon">
                <span id="fb_name"></span>
            </div>
        </div>        
    </div>
<?php include_once("footer.tpl");?>