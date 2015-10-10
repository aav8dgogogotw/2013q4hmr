<?php
    function resourcePost($api, $tools, $param) {

        $param["fbId"] = $tools->sql_injection_anti($_SESSION['fbId']);
        $param["name"] = $tools->sql_injection_anti($_POST['name']);
        $param["email"] = $tools->sql_injection_anti($_POST['email']);
        $param["tel"] = $tools->sql_injection_anti($_POST['tel']);
        $param["addr"] = $tools->sql_injection_anti($_POST['addr']);
        $param["isfail"] = $tools->sql_injection_anti($_POST['isfail']);
        $param["issuccess"] = $tools->sql_injection_anti($_POST['issuccess']);
        $param["attend_time"] = $tools->sql_injection_anti($_POST['attend_time']);
        $param["isfriend"] = $tools->sql_injection_anti($_POST['isfriend']);
        $param["isfood"] = $tools->sql_injection_anti($_POST['isfood']);
        $param["agreedata"] = $tools->sql_injection_anti($_POST['agreedata']);
        $param["readservice"] = $tools->sql_injection_anti($_POST['readservice']);
        $param["friendyears"] = $tools->sql_injection_anti($_POST['friendyears']);
        $param["iswork"] = $tools->sql_injection_anti($_POST['iswork']);
        $param["howfire"] = $tools->sql_injection_anti($_POST['howfire']);
       // $_POST['foodspecies'] = str_replace('\n', "", $_POST['foodspecies']);
        $param["foodspecies"] = $tools->sql_injection_anti($_POST['foodspecies']);
         $param["fooditems"] = $tools->sql_injection_anti($_POST['fooditems']);
         if($param["isfail"] == "1")
         {
         $param["coupon_number"] = $tools->sql_injection_anti($_POST['coupon_number']);
         }else{
         $param["coupon_number"] = "";
         }

        if($param["fbId"] == "" or 
            $param["name"] == "" or 
            $param["email"] == "" or
            $param["tel"] == "" or
            $param["addr"] == "" or
            $param["attend_time"] == "" or
            $param["isfriend"] == "" or
            $param["isfood"] == "" or
            $param["agreedata"] == "" or
            $param["readservice"] == "") {
            $api->setError("資料不齊全，請重新輸入。");
            return;
        }
///////發信程式START/////////////////////////////
        
        ///因為遊戲失敗才會觸發此發信程式
if($param["isfail"] == "1")
{

   
       // print_r($getcoupon["coupon"]);

$Body=
'<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>桂冠 :::簡單做開心吃 快樂料理在我家:::</title>
</head>
<body style="margin:0; padding:0;">
<table width="760" border="0" cellspacing="0" cellpadding="0" style="margin:auto;">
    <tr>
        <td width="760" height="352"><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_01.png" alt="輕鬆做擁有好心情" width="760" height="352" style="display:block; line-height:0;"></td>
    </tr>
    <tr>
        <td width="760" height="39"><table width="760" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="418" height="39"><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_02.png" alt="輕鬆做擁有好心情" width="418" height="39" style="display:block; line-height:0;" ></td>
                    <td width="101" height="39" bgcolor="#fae9cc" style="font-size:18px; color:#f49d36; font-weight:bold;">'.$param["coupon_number"].'</td>
                    <td width="241" height="39"><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_10.png" alt="輕鬆做擁有好心情" width="241" height="39" style="display:block; line-height:0;" ></td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td width="760" height="188" ><table width="760" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="217" height="188" ><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_03.png" alt="複製編號" width="217" height="188" style="display:block; line-height:0;"></td>
                    <td width="172" height="188" ><a href="http://my.laurel.com.tw/" title="登入線上購物去" target="_blank" style="border:0 none;"><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_04.png" alt=" 登入線上購物去" width="172" height="188" style="display:block; line-height:0;border:0 none;"></a></td>
                    <td width="171" height="188" ><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_06.png" alt=" 購滿$500" width="171" height="188" style="display:block; line-height:0;"></td>
                    <td width="200" height="" background="http://event.laurel.com.tw/2013Q4hmr/images/edm_07.png" style="font-size:16px; color:#f49d36; font-weight:bold; padding:22px 0 0 95px;" >'.$param["coupon_number"].'</td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td width="760" style="padding:10px 50px; color:#f49d36; " height="207" bgcolor="#fdfbec"> 本券使用說明：<br>
            1. 本券僅限<a href="http://my.laurel.com.tw/" title="登入線上購物去" target="_blank" style="border:0 none;"><img src="http://event.laurel.com.tw/2013Q4hmr/images/Mylaurel.png" alt="My Laurel" width="68" height="15" align="absmiddle" style="line-height:0;border:0 none;"></a>線上購物使用，不得要求兌換現金。<br>
            2. 使用時間至：2014/2/28 PM24:00止，逾期等同作廢。<br>
            3. 本券折價編號僅限用一次，單次消費滿$500以上，方可使用。<br>
            4. 於線上購物結帳時，在結帳頁面輸入【折價券編號】即可享有折價優惠。<br>
            5. 請妥善保存本券編號，如因個人行為導致編號遺失，恕不補發。<br>
            6.「桂冠實業股份有限公司」保留修改活動之權利。<br></td>
    </tr>
    <tr>
        <td width="760" height="61" > <img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_05.png" alt="輕鬆做擁有好心情" width="760" height="61" style="display:block; line-height:0;"> </td>
    </tr>
</table>
</body>
</html>';

//此段能顯示電子郵件出處，且中文資料不會出現亂碼
$Type = "Content-Type: text/html; charset=UTF-8\r\n";

$Form ="From:"."桂冠家庭代餐-活動小組"."<john_lin@hiiir.com>"."\r\n";
//此段是要設定資料的類型
$Header=$Type.$Form;
//此段為檔頭設定
$Subject="=?UTF-8?B?" . base64_encode("桂冠家庭代餐-Coupon通知信")."?=";
//此段為郵件的主旨設定
mail($param["email"], $Subject,$Body,$Header);
//此處以會員電子郵件當作寄出位置}}
}

///////發信程式END//////////////////////////////

        include_once "../../library/Table/User.class.php";
        $user = new User();        

        $userData = $user->getByFbId($param['fbId']);
     

        if(empty($userData)) {
            $api->setError("查無玩家資料！");
            return;
        }else {
            /*
            if($userData['act1'] == 0 || 
                $userData['act2'] == 0 || 
                $userData['act3'] == 0 ||
                $userData['act4'] == 0 ||
                $userData['act5'] == 0 ||
                $userData['act6'] == 0) {

                $api->setError("您尚未完成所有任務！");
                return;
            }
            */
            include_once "../../library/Table/Lottery.class.php";
            $lottery = new Lottery();
            $lottery->add($param);

            include_once "../../library/Table/Coupon.class.php";
            $coupon = new Coupon();
            if($param["isfail"] == "1")
            {
            $coupon->deleteEmailCoupon($param["coupon_number"]);
            }

            $api->setOutput('新增資料成功');
            unset($lottery);            
        }
        unset($param, $usesrData, $user);
        return;
    }



    function resourcePut($api, $tools, $param) {
        $param['fbId'] = $tools->sql_injection_anti($_SESSION["fbId"]);
        $param['issuccess'] = $tools->sql_injection_anti($_POST["issuccess"]);
        $param['isfail'] = $tools->sql_injection_anti($_POST["isfail"]);
        $param['coupon_number'] = $tools->sql_injection_anti($_POST["coupon_number"]);
        include_once "../../library/Table/Lottery.class.php";
        $lottery = new Lottery();
        $status = $lottery->getByFbId($param['fbId']);
        //print_r($status["issuccess"]);
        if($status["issuccess"] == 1 && $status["isfail"] != 1){
        //假如issuccess = 1存在,就更新isfail = 1並存入酷碰券 
        $lottery->updateStatusFail($param['isfail'],$param['coupon_number'],$param['fbId']); 
      //  $lottery->updateStatusFail($param['isfail'],$param['coupon_number'],$param['fbId']); 
 
   ///////發信程式START/////////////////////////////
        $Body=
'<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>桂冠 :::簡單做開心吃 快樂料理在我家:::</title>
</head>
<body style="margin:0; padding:0;">
<table width="760" border="0" cellspacing="0" cellpadding="0" style="margin:auto;">
    <tr>
        <td width="760" height="352"><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_01.png" alt="輕鬆做擁有好心情" width="760" height="352" style="display:block; line-height:0;"></td>
    </tr>
    <tr>
        <td width="760" height="39"><table width="760" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="418" height="39"><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_02.png" alt="輕鬆做擁有好心情" width="418" height="39" style="display:block; line-height:0;" ></td>
                    <td width="101" height="39" bgcolor="#fae9cc" style="font-size:18px; color:#f49d36; font-weight:bold;">'.$param['coupon_number'].'</td>
                    <td width="241" height="39"><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_10.png" alt="輕鬆做擁有好心情" width="241" height="39" style="display:block; line-height:0;" ></td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td width="760" height="188" ><table width="760" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="217" height="188" ><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_03.png" alt="複製編號" width="217" height="188" style="display:block; line-height:0;"></td>
                    <td width="172" height="188" ><a href="http://my.laurel.com.tw/" title="登入線上購物去" target="_blank" style="border:0 none;"><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_04.png" alt=" 登入線上購物去" width="172" height="188" style="display:block; line-height:0;border:0 none;"></a></td>
                    <td width="171" height="188" ><img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_06.png" alt=" 購滿$500" width="171" height="188" style="display:block; line-height:0;"></td>
                    <td width="200" height="" background="http://event.laurel.com.tw/2013Q4hmr/images/edm_07.png" style="font-size:16px; color:#f49d36; font-weight:bold; padding:22px 0 0 95px;" >'.$param['coupon_number'].'</td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td width="760" style="padding:10px 50px; color:#f49d36; " height="207" bgcolor="#fdfbec"> 本券使用說明：<br>
            1. 本券僅限<a href="http://my.laurel.com.tw/" title="登入線上購物去" target="_blank" style="border:0 none;"><img src="http://event.laurel.com.tw/2013Q4hmr/images/Mylaurel.png" alt="My Laurel" width="68" height="15" align="absmiddle" style="line-height:0;border:0 none;"></a>線上購物使用，不得要求兌換現金。<br>
            2. 使用時間至：2014/2/28 PM24:00止，逾期等同作廢。<br>
            3. 本券折價編號僅限用一次，單次消費滿$500以上，方可使用。<br>
            4. 於線上購物結帳時，在結帳頁面輸入【折價券編號】即可享有折價優惠。<br>
            5. 請妥善保存本券編號，如因個人行為導致編號遺失，恕不補發。<br>
            6.「桂冠實業股份有限公司」保留修改活動之權利。<br></td>
    </tr>
    <tr>
        <td width="760" height="61" > <img src="http://event.laurel.com.tw/2013Q4hmr/images/edm_05.png" alt="輕鬆做擁有好心情" width="760" height="61" style="display:block; line-height:0;"> </td>
    </tr>
</table>
</body>
</html>';
//此段為電子郵件資料，能顯示會員帳號並分行，再加上一段超連結供會員點選

//此段能顯示電子郵件出處，且中文資料不會出現亂碼
$Type = "Content-Type: text/html; charset=UTF-8\r\n";



$Form ="From:"."桂冠家庭代餐-活動小組".'<john_lin@hiiir.com>'."\r\n";
//此段是要設定資料的類型
$Header=$Type.$Form;
//此段為檔頭設定
$Subject="=?UTF-8?B?" . base64_encode("桂冠家庭代餐-Coupon通知信")."?=";
//此段為郵件的主旨設定
mail($status["email"], $Subject,$Body,$Header);
//此處以會員電子郵件當作寄出位置}}
   ///////發信程式END///////////////////////////// 
   ///發信完就刪除特定酷朋序號 
      $coupon->deleteEmailCoupon($getcoupon["coupon"]);

        }else if($status["isfail"] == 1 && $status["issuccess"] != 1){
        //假如isfail = 1存在,就更新issuccess = 1 
        $lottery->updateStatusSuccess($param['issuccess'],$param['fbId']);

        }
       return;
    }
?>