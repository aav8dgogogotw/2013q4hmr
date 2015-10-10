<?php include_once("templates/header.tpl"); ?>
    <link href="/js/jquery/style_timePicker/timePicker.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/js/jquery/style_jquery/jquery-ui-1.8.4.custom.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="/js/jquery/jquery.timePicker.min.js" type="text/javascript"></script>
    <script src="/js/jquery/jquery-ui-1.8.7.custom.min.js" type="text/javascript"></script>
    <tr><td valign="top"><img src="images/blank.gif" width="10" height="10" /></td></tr>
    <tr>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="images/account-top.gif" width="980" height="5" /></td>
                </tr>
                <tr>
                    <td valign="top" background="images/account-bg.gif">
                        <p><?php include_once('templates/sub_menu.tpl'); ?></p>
                        <table width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" class="overall-content">
 
                            <form action="index.php?page=award/update" name="PublicForm" id="PublicForm" enctype="multipart/form-data" method="post" >
                                <input type="hidden" name="award_id" id="award_id" value="<?php echo  $this->data["award_id"]?>" />
                                <tr>
                                    <td width="15%" bgcolor="#F4F4F4">關卡</td>
                                    <td width="85%" bgcolor="#FFFFFF">
                                        <label><input id="stage" type="radio" name="stage" value="A" checked /> 關卡 I 銀幣 </label>
                                        <label><input id="stage" type="radio" name="stage" value="B"/> 關卡 II 祝福 </label>
                                        <label><input id="stage" type="radio" name="stage" value="C"/> 關卡 III 水晶 </label>
                                        <label><input id="stage" type="radio" name="stage" value="D"/> 關卡 IV 全家早餐 </label>
                                        <label><input id="stage" type="radio" name="stage" value="E"/> 關卡 V 寶石 </label>
                                        <?php /* <label><input id="stage" type="radio" name="stage" value="F"/> 關卡 VI </label> */?>
                                        <br />
                                        <label><input id="stage" type="radio" name="stage" value="G"/> 虛寶 九藏 </label>
                                        <label><input id="stage" type="radio" name="stage" value="H"/> 虛寶 森野樹 </label>
                                        <label><input id="stage" type="radio" name="stage" value="I"/> 虛寶 龍魂 </label>
                                        <label><input id="stage" type="radio" name="stage" value="J"/> 虛寶 黑鬍子秘寶 </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%" bgcolor="#F4F4F4">EXCEL匯入</td>
                                    <td width="85%" bgcolor="#FFFFFF">
                                        <input type="file" name="file">
                                        <a href="/data/example.xls"> &gt;&gt; 範本下載</a>
                                        <br/>
                                        <span style="color:red; font-size:8pt;">* 需使用 Office 97-2003 格式上傳匯入</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFF" colspan="2">
                                        <?php ?>
                                    </td>
                                </tr>
                                <?php /*
                                <tr>
                                    <td width="15%" bgcolor="#F4F4F4">上線/下線</td>
                                    <td width="85%" bgcolor="#FFFFFF">
                                        <input id="statusY" type="radio" name="status" value="Y" checked = "checked"/> <label for="statusY">上線</label> /
                                        <input id="statusN" type="radio" name="status" value="N" <?php echo $this->data['status'] == "N"?"checked='checked'":"";?>> <label for="statusN">下線</label>
                                    </td>
                                </tr>
                                */ ?>
                                <tr>
                                    <td colspan="3" bgcolor="#FFFFFF" align="center">
                                    <input type="submit" name="Submit" value="送出" />
                                    <input type="button" onclick="location.href='index.php?page=award/list';" value="回列表" />    
                                    </td>
                                </tr>
                            </form>
                        </table>
                  </td>
                </tr>
                <tr><td><img src="images/account-footer.gif" width="980" height="5" /></td></tr>
            </table>
        </td>
    </tr>
</table>
<?php include_once('templates/footer.tpl'); ?>