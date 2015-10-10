<?php include_once("header.tpl");?>
<?php include_once("fb.tpl");?>
<script>
    $(function(){
        $("button").bind("click", function() {
            fbLogin();
        })        
    });
</script>
<button id="start">start</button>
<?php include_once("footer.tpl");?>