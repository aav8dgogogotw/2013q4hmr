<?php include_once("header.tpl");?>
<?php include_once("fb.tpl");?>
    <script>
        init(function() {
            var missionButton = $(".mission_button");
            missionButton.bind("mouseover", function() {                
                var mThis = $(this);
                mThis.parent().find(".mission_ex").show();
            });

            missionButton.bind("mouseout", function() {
                var mThis = $(this);
                mThis.parent().find(".mission_ex").hide();
            });            
        });
    </script>
    <div class="map">
        <div class="Warpper">
            <?php include_once("logo.tpl");?>

            
         

            <?php include_once("button.tpl");?>            
        </div>
    </div>

<?php include_once("mission.tpl");?>
<?php include_once("show.tpl");?>
<?php include_once("footer.tpl");?>