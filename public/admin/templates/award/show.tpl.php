<?php include_once("templates/header.tpl"); ?>

<!-- 這個頁面所需要用的js fucntion都會集中在這裡:開始 -->
<script type="text/javascript">
    var returnUrl = Url.encode(window.location.toString());

    //分頁用
    function MM_jumpMenu(targ,selObj,restore){ //v3.0
         eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
         if (restore) selObj.selectedIndex=0;
    }
    
    $(document).ready(function(){

    });
</script>  
<!-- 這個頁面所需要用的js fucntion都會集中在這裡:結束 -->
    <tr>
        <td valign="top"><img src="images/blank.gif" width="10" height="10" /></td>
    </tr>
    <tr>
    <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><img src="images/account-top.gif" width="980" height="5" /></td>
            </tr>
            <tr>
                <td valign="top" background="images/account-bg.gif">
                    <p><?php include_once("templates/sub_menu.tpl"); ?></p>

                    <table width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" class="overall-content">
                    <form id="form1" name="form1">
                        <tr>
                            <th  align="center" bgcolor="#DDDDDD">序號</th>
                            <th  align="center" bgcolor="#DDDDDD">狀態</th>
                            <th  align="center" bgcolor="#DDDDDD">取得玩家</th>
                            <th  align="center" bgcolor="#DDDDDD">取得時間</th>
                        </tr>
                        <?php if($this->list):
                                foreach($this->list as $key => $row):
                                    if ($key % 2 == 1) { $bgcolor = "#FBEAE7"; }else{ $bgcolor = "#FFFFFF"; }
                                    $primary_key = $row['page_id']; //不同table的pk不一樣，避免下面每個要用到pk都要改一次，所以這邊設一個變數來使用
                        ?>
                        <tr class="RowAction" bgcolor="<?=$bgcolor?>" onMouseOver="this.style.backgroundColor='#FFF0D0';" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>';">
                            <td align="center"><?php echo $row["sn"];?></td>
                            <td align="center">
                            <?php 
                                if ($row["status"] == "Y") {
                                    echo "已取得";
                                } else if ($row["status"] == "N") {
                                    echo "未取得";
                                }
                            ?>
                            </td>
                            <td align="center"><?php echo $row["fb_id"];?></td>
                            <td align="center"><?php echo $row["get_time"];?></td>
                        </tr>
                              
                          <?php endforeach; else: ?>
                              <tr>
                                <td height="34" colspan="14" align="center" bgcolor="#FFFFCC">沒有記錄</td>
                              </tr>
                          <?php endif;?>

                    </form>      
                    </table>
                    <div style="width:95%; margin:auto; text-align:center;">
                        <br/>
                        <input type="button" onclick="location.href='index.php?page=award/list';" value="回列表" />
                    </div> 
                    <?php 
                        if ($this->pageBar) {
                            $i = 0;
                            while ($i < $this->pageBar['pageNums']) {
                                if ($pageBar['current'] == $i) {
                                    echo ($i + 1);
                                } else {
                                    echo '<a href="' . $this->pageBar['url'] . $i . '">' . ($i + 1) . '</a>';
                                }
                                
                                $i++;
                            }
                            unset($i);
                        }
                    ?>
              </td>
            </tr>
            <tr>
                <td><img src="images/account-footer.gif" width="980" height="5" /></td>
            </tr>
        </table>
    </td>
  </tr>
</table> 
<?php include_once("templates/footer.tpl"); ?>