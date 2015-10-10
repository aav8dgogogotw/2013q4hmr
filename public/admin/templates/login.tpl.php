<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="/js/jquery/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="/js/jquery/jquery.validate.pack.js" type="text/javascript"></script>
    <link href="css/store.css" rel="stylesheet" type="text/css">
    <link href="css/drag.css" rel="stylesheet" type="text/css">
    <title>後台-後台登入</title>
  </head>
  
  <body>
    <style type="text/css">
    	.error {color: red;}
    </style>
    <script language="text/javascript" type="text/JavaScript">
      function login(){
      	if($('#loginform').valid() == true){
      		var login_index = 'index.php'
      		$.post(
      				$('#loginform').attr('action'),
      				$('#loginform').serialize(),
      				function(Data){
      					if(Data.msg == "OK"){
      						// alert("登入成功!!");
      						location.href=login_index;
      					}
      					else{
      						alert('帳號密碼錯誤，登入失敗');
      					}
      				}
      			,'json');
      	}
      }

      $(document).ready(function() {
      	//驗證ticket_form
      	$("#loginform").validate({
      		success:'valid',
      			rules: {
      				adm_id:
      				{ 
      					required: true,
      				},				
      				adm_pwd:
      				{ 
      					required: true,
      				}
      			},
      			messages: {
      				adm_id:
      				{ 
      					required: ' 必填欄位',
      				},
      				adm_pwd:
      				{ 
      					required: ' 必填欄位',
      				}
      			}
      	});
      });
    </script>
    <table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="20"></td>
      </tr>
      <tr>
        <td valign="top">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="170" align="center" valign="middle" background="images/luxa-taiwan.gif"><span id="store-title">海商紀元</span></td>
              <td align="right" valign="top">
                <table width="800" border="0" cellpadding="0" cellspacing="0" background="images/topmen-bg.gif">
                  <tr>
                    <td width="10">
                      <img src="images/topmenu-l.gif" width="10" height="35" />
                    </td>
                    <td width="50" align="center">
                      <img src="images/home-icon.gif" width="14" height="11" />
                    </td>
                    <td>
                      <span id="store-title">後台管理系統</span>
                    </td>
                    <td width="10">
                      <img src="images/topmenu-r.gif" width="10" height="35" />
                    </td>
                  </tr>
              </table>
            </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td valign="top">
          <img src="images/blank.gif" width="10" height="10" />
        </td>
      </tr>
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
                          <form action="index.php?page=login" Method="POST" id="loginform" name="loginform">  
                            <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" class="overall-content">
                              <tr>
                                <td width="100" align="right">帳號</td>
                                <td>
                                  <input name="adm_id" id="adm_id" type="text" />
                                </td>
                              </tr>
                              <tr>
                                <td align="right">密碼</td>
                                <td>
                                  <input name="adm_pwd" id="adm_pwd" type="password" />
                                </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>
                                  <span onclick="login()" style="cursor: pointer;"><img  src="images/login.gif"  width="85" height="28"/></span>
                                </td>
                              </tr>
                             </table>  
                          </form>
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
  </body>
</html>