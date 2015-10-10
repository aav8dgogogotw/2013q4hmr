<?php include_once("templates/header.tpl"); ?>

<!-- 這個頁面所需要用的js fucntion都會集中在這裡:開始 -->
<script type="text/javascript">
    var returnUrl = Url.encode(window.location.toString());

    //分頁用
    function MM_jumpMenu(targ, selObj, restore) { //v3.0
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
                            <th align="center" bgcolor="#DDDDDD">關卡</th>
                            <th align="center" bgcolor="#DDDDDD">剩餘數 / 資料總數</th>
                            <th align="center" bgcolor="#DDDDDD">詳細資料</th>
                        </tr>

                        <?php if($this->list):
                                foreach($this->list as $key => $row):
                                    if ($key % 2 == 1) { $bgcolor = "#FBEAE7"; }else{ $bgcolor = "#FFFFFF"; }
                                    
                                    // 不同table的pk不一樣，避免下面每個要用到pk都要改一次，所以這邊設一個變數來使用
                                    $primary_key = $row['page_id'];
                        ?>
                        <tr class="RowAction" bgcolor="<?=$bgcolor?>" onMouseOver="this.style.backgroundColor='#FFF0D0';" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>';">
                            <td align="center"><?php echo $this->stageTitle[$key];?></td>
                            <td align="center"><?php echo $this->stageCountsUserGet[$key]; ?> / <?php echo $row;?></td>
                            <td align="center"><input type="button" onclick="location.href='index.php?page=award/show&stage=<?php echo $key; ?>';" value="檢視" /></td>
                        </tr>
                        <?php endforeach; else: ?>
                        
                        <tr>
                            <td height="34" colspan="14" align="center" bgcolor="#FFFFCC">沒有記錄</td>
                        </tr>
                        <?php endif;?>
                    </form>
                    </table>

                    <?php if($this->list): ?>
                    <?php echo $this->pageList;?>
                    <?php endif;?>   
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