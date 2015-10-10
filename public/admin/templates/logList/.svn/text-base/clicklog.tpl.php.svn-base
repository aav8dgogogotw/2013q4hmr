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
                    <br/>
                    <div style="width:95%; margin:auto; text-align:right;">
                    <a class="button" href="index.php?page=logList/excel" target="_blank"> 匯出EXCEL </a>
                    </div>
                    <br/>
                    <table width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" class="overall-content">
                    <form id="form1" name="form1">
                        <tr>
                            <th align="center" bgcolor="#DDDDDD">日期</th>
                            <th align="center" bgcolor="#DDDDDD">開啟活動首頁人次</th>
                            <th align="center" bgcolor="#DDDDDD">遊戲介紹頁(點擊)</th>
                            <th align="center" bgcolor="#DDDDDD">活動辦法頁(點擊)</th>
                            <th align="center" bgcolor="#DDDDDD">得獎名單頁(點擊)</th>
                            <th align="center" bgcolor="#DDDDDD">尋寶去(點擊)</th>
                            <th align="center" bgcolor="#DDDDDD">粉絲團按讚人數</th>
                            <th align="center" bgcolor="#DDDDDD">新進入本活動人數</th>
                            <?php /*
                            <th align="center" bgcolor="#DDDDDD">確認加入遊戲人數</th>
                            */?>
                            <th align="center" bgcolor="#DDDDDD">透過本活動加入遊戲人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 I 活動人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 II 活動人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 III 活動人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 IV 活動人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 V 活動人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 VI 活動人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 I 完成人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 II 完成人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 III 完成人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 IV 完成人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 V 完成人數</th>
                            <th align="center" bgcolor="#DDDDDD">活動中，關卡 VI 完成人數</th>
                            <th align="center" bgcolor="#DDDDDD">邀請好友活動人數</th>
                            <th align="center" bgcolor="#DDDDDD">邀請的好友進入活動人數</th>
                            <th align="center" bgcolor="#DDDDDD">分享至塗鴉牆數</th>
                            <th align="center" bgcolor="#DDDDDD">參加抽獎人數</th>
                            <th align="center" bgcolor="#DDDDDD">至遊戲官網造訪人次</th>
                            <th align="center" bgcolor="#DDDDDD">至遊樂迷造訪人次</th>
                            <th align="center" bgcolor="#DDDDDD">前往活動頁(點擊)</th>
                            <th align="center" bgcolor="#DDDDDD">前往官網(點擊)</th>
                            <th align="center" bgcolor="#DDDDDD">海商紀元點擊</th>
                        </tr>
                    <?php 
                        if($this->list):
                            foreach($this->list as $key => $row):
                                if ($key % 2 == 1) { $bgcolor = "#FBEAE7"; }else{ $bgcolor = "#FFFFFF"; }
                                
                                // 不同table的pk不一樣，避免下面每個要用到pk都要改一次，所以這邊設一個變數來使用
                                $primary_key = $row['page_id'];
                    ?>
                        <tr class="RowAction" bgcolor="<?=$bgcolor?>" onMouseOver="this.style.backgroundColor='#FFF0D0';" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>';">
                            <td align="center"><?php echo $row['log_date'];?></td>
                            <td align="center"><?php echo $row['index_click'];?></td>
                            <td align="center"><?php echo $row['intro_click'];?></td>
                            <td align="center"><?php echo $row['active_click'];?></td>
                            <td align="center"><?php echo $row['award_click'];?></td>
                            <td align="center"><?php echo $row['start_game'];?></td>
                            <td align="center"><?php echo $row['count_like'];?></td>
                            <td align="center"><?php echo $row['count_user'];?></td>
                            <?php/*
                            <td align="center"><?php echo $row['count_game_user'];?></td>
                            */?>
                            <td align="center"><?php echo $row['count_already_join'];?></td>
                            <td align="center"><?php echo $row['count_act_start_a'];?></td>
                            <td align="center"><?php echo $row['count_act_start_b'];?></td>
                            <td align="center"><?php echo $row['count_act_start_c'];?></td>
                            <td align="center"><?php echo $row['count_act_start_d'];?></td>
                            <td align="center"><?php echo $row['count_act_start_e'];?></td>
                            <td align="center"><?php echo $row['count_act_start_f'];?></td>
                            <td align="center"><?php echo $row['count_act_finish_a'];?></td>
                            <td align="center"><?php echo $row['count_act_finish_b'];?></td>
                            <td align="center"><?php echo $row['count_act_finish_c'];?></td>
                            <td align="center"><?php echo $row['count_act_finish_d'];?></td>
                            <td align="center"><?php echo $row['count_act_finish_e'];?></td>
                            <td align="center"><?php echo $row['count_act_finish_f'];?></td>
                            <td align="center"><?php echo $row['count_invite_friend'];?></td>
                            <td align="center"><?php echo $row['count_invite_friend_enter'];?></td>
                            <td align="center"><?php echo $row['facebook_share'];?></td>
                            <td align="center"><?php echo $row['count_lottery'];?></td>
                            <td align="center"><?php echo $row['official_click'];?></td>
                            <td align="center"><?php echo $row['molome_click'];?></td>
                            <td align="center"><?php echo $row['invite_active_click'];?></td>
                            <td align="center"><?php echo $row['invite_official_click'];?></td>
                            <td align="center"><?php echo $row['login_click'];?></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr>
                            <td height="34" colspan="14" align="center" bgcolor="#FFFFCC">沒有記錄</td>
                        </tr>
                    <?php endif;?>
                    </form>      
                    </table>

                    <?php 
                        if ($this->pageBar) {
                            $i = 0;
                            while ($i < $this->pageBar['pageNums']) {
                                if ($pageBar['current'] == ($i + 1)) {
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