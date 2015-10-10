<?php 

          $host = 'localhost';
          $user = 'root';
          $pass = '1234';
          
        $db = 'maritimeera';
        $table = 'tb_lottery';
    //    $table2 = 'tb_user_keyin';
        $file = '桂冠十分輕鬆料理填表名單';
        mysql_connect($host, $user, $pass) or die("主機連線錯誤：" . mysql_error());
        mysql_query("SET NAMES utf8");
        mysql_query("CHARACTER SET utf8");
        mysql_query("SET COLLATION_CONNECTION=utf8_general_ci");
        mysql_query("SET CHARACTER_SET_CLIENT =utf8");
        mysql_query("SET CHARACTER_SET_RESULTS =utf8");
        mysql_query("SET CHARACTER_SET_SERVER = utf8");
        mysql_query("SET character_set_connection=utf8");
        mysql_select_db($db) or die("資料庫無法開啟");
        $result = mysql_query("show columns from " . $table . "");
        $i = 0;
        $title = "<table><tr><td width=200px>桂冠十分輕鬆料理填表名單</td></tr><table>";
        $csv_output = utf8_to_big5($title) . "\n\n";  //只要在第一行把點拿掉就能解決問題
       
            while ($row = mysql_fetch_array($result)) {
                $csv_output = utf8_to_big5($title) . "\n\n";
                $csv_output .= utf8_to_big5("抽獎編號") . ", ";
                $csv_output .= utf8_to_big5("臉書ID") . ", ";
                $csv_output .= utf8_to_big5("姓名") . ", ";
                $csv_output .= utf8_to_big5("電話") . ", ";
                $csv_output .= utf8_to_big5("電子郵件") . ", ";
                $csv_output .= utf8_to_big5("地址") . ", ";
                $csv_output .= utf8_to_big5("更新時間") . ", ";
                $csv_output .= utf8_to_big5("填表日期") . ", ";
                $csv_output .= utf8_to_big5("填表時間") . ", ";
                $csv_output .= utf8_to_big5("是否領取參加獎") . ", ";
                $csv_output .= utf8_to_big5("到貨時間") . ", ";
                $csv_output .= utf8_to_big5("家裡是否有小朋友") . ", ";
                $csv_output .= utf8_to_big5("是否買過微波食品") . ", ";
                $csv_output .= utf8_to_big5("是否勾選同意條款") . ", ";
                $csv_output .= utf8_to_big5("是否勾選服務條款") . ", ";
                $csv_output .= utf8_to_big5("是否具備抽獎資格") . ", ";
                $csv_output .= utf8_to_big5("小朋友歲數") . ", ";
                $csv_output .= utf8_to_big5("是否在上班") . ", ";
                $csv_output .= utf8_to_big5("喜歡的桂冠食品種類") . ", ";
                $csv_output .= utf8_to_big5("喜歡的桂冠食品細項") . ", ";
                $csv_output .= utf8_to_big5("何時開火") . ", ";
                $csv_output .= utf8_to_big5("目前所擁有COUPON序號") . ", ";
                $csv_output .= utf8_to_big5("遊戲成功次數") . ", ";
                $i++;
            }
      
        $csv_output .= "\n";
        $values = mysql_query("
            SELECT
  a.lottery_id,a.fb_id,a.name,a.tel,a.email,
  a.addr,a.update_time,a.create_date,a.create_time,a.isfail,
  a.attend_time,a.isfriend,a.isfood,a.agreedata,a.readservice,
  a.issuccess,a.friendyears,a.iswork,a.foodspecies,a.fooditems,
  a.howfire,a.coupon_number,
COUNT(b.fb_id) 
FROM tb_lottery AS a,
  log_share AS b
WHERE a.fb_id = b.fb_id
GROUP BY b.fb_id
            ");
        while ($rowr = mysql_fetch_row($values)) {
            for ($j = 0; $j < 23; $j++) {
            	if($j == 0){
                    //ID編號
                    $rowr[$j] = $rowr[$j];
                }
                if($j == 1){
                    //臉書ID
                    $rowr[$j] = $rowr[$j]."'";
                }
                if($j == 3){
                    //電話
                    $rowr[$j] = $rowr[$j]."'";
                }

                //是否領取參加獎

                if($rowr[9] == "1"){
                    
                    $rowr[9] = "有";
                }

                if($rowr[9] == "0" OR $rowr[9] == ""){
                    $rowr[9] = "沒有";
                }

                //到貨時間
                if($rowr[10] == "1"){
                    
                    $rowr[10] = "中午前";
                }
                if($rowr[10] == "2"){
                    
                    $rowr[10] = "12-17時";
                }
                if($rowr[10] == "3"){
                    
                    $rowr[10] = "17-20時";
                }

                //家裡是否有小朋友
                 if($rowr[11] == "1"){
                    
                    $rowr[11] = "有";
                }
                if($rowr[11] == "0"){
                    
                    $rowr[11] = "沒有";
                }
                //是否常吃微波食品
                 if($rowr[12] == "1"){
                    
                    $rowr[12] = "有";
                }
                if($rowr[12] == "0"){
                    
                    $rowr[12] = "沒有";
                }
                //是否勾選同意條款
                if($rowr[13] == "1"){
                    
                    $rowr[13] = "有";
                }
                if($rowr[13] == "0"){
                    
                    $rowr[13] = "沒有";
                }
                //是否勾選服務條款
                if($rowr[14] == "1"){
                    
                    $rowr[14] = "有";
                }
                if($rowr[14] == "0"){
                    
                    $rowr[14] = "沒有";
                }
                //是否具備抽獎資格
                if($rowr[15] == "1"){
                    
                    $rowr[15] = "有";
                }
                if($rowr[15] == "0"){
                    
                    $rowr[15] = "沒有";
                }
                //是否在上班
                if($rowr[17] == "1"){
                    
                    $rowr[17] = "家管";
                }
                if($rowr[17] == "2"){
                    
                    $rowr[17] = "上班族";
                }

                //何時開火
                 if($rowr[20] == "1"){
                    
                    $rowr[20] = "平日";
                }
                if($rowr[20] == "2"){
                    
                    $rowr[20] = "假日";
                }
                if($rowr[20] == "3"){
                    
                    $rowr[20] = "都有";
                }
                if($rowr[20] == "4"){
                    
                    $rowr[20] = "都沒";
                }

                $csv_output .= utf8_to_big5($rowr[$j]) . ", ";
              //  $csv_output = $csv_output.str_replace("/", "", $csv_output);
            }
            $csv_output .= "\n";
        }
        ini_set('date.timezone', 'Asia/Taipei');
        $filename = $file . "_" . date("y-m-d_h-i", time());
        header("Content-type: text/x-csv");
        header("content-disposition: filename=" . $filename . ".csv");
        echo $csv_output;
        exit;



    function utf8_to_big5($utfs) {
        $i = 0;
        $len = strlen($utfs);
        $big5s = "";
        for ($i = 0; $i < $len; $i++) {
            $sbit = ord(substr($utfs, $i, 1));
            if ($sbit < 128) {
                $big5s.=substr($utfs, $i, 1);
            } else if ($sbit > 191 && $sbit < 224) {
                $new1 = iconv("UTF-8", "Big5", substr($utfs, $i, 2));
                $big5s.=($new1 == "") ? ".." : $new1;
                $i++;
            } else if ($sbit > 223 && $sbit < 240) {
                $new1 = iconv("UTF-8", "Big5", substr($utfs, $i, 3));
                $big5s.=($new1 == "") ? ".." : $new1;
                $i+=2;
            } else if ($sbit > 239 && $sbit < 248) {
                $new1 = iconv("UTF-8", "Big5", substr($utfs, $i, 4));
                $big5s.=($new1 == "") ? ".." : $new1;
                $i+=3;
            }
        }
        return $big5s;
    }

?>