<?php include_once("templates/header.tpl"); ?>
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <img src="images/account-top.gif" width="980" height="5" />
          </td>
        </tr>
        <tr>
          <td valign="top" background="images/account-bg.gif">
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
                <tr>
                  <td align="left" valign="top">                      
                    <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" class="overall-content">
                      <tr>
                        <td width="100" align="center"><strong>歡迎您登入網站管理系統</strong></td>
                      </tr>
                      <tr>
                        <td align="center"><strong>親愛的<?php echo $_SESSION['adm_name'];?>，您好：</strong></td>
                      </tr>
                      <tr>
                        <td align="center">歡迎您登入 海商紀元 後端管理系統 </td>
                      </tr>
                      <tr>
                        <td align="center">您可以透過此系統管理網站相關資訊</td>
                      </tr>
                   </table>
                  </td>
                </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <img src="images/account-footer.gif" width="980" height="5" />
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php include_once("templates/footer.tpl"); ?>