<!-- FACEBOOK CLIENT LOGIN:開始 -->
  <script type="text/javascript">
    var param = {
        'AppId'       : '<?php echo $this->appId?>',
        'ToURL'       : '<?php echo $this->toUrl?>',
        'Login'       : '<?php echo $this->login?>',
        'RedirectURL' : '<?php echo urlencode($this->redirectURL)?>',
        'ChannelUrl'  : '<?php echo $this->channelURL?>',
        'Scope'       : '<?php echo $this->scope?>',
        'FansId'      : '<?php echo $this->fansId?>',
        'Height'      : '<?php echo $this->height?>'
    }

    $.FBLogin(param);    
  </script>  
<!-- FACEBOOK CLIENT LOGIN:結束 -->