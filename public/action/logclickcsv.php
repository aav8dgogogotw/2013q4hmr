<?php
/*
require_once 'phpexecl.class.php';
$xls = new Excel('Sheet'); //构造函数，参数为第一个sheet名称

$xls->worksheets['Sheet']->addRow(array("品牌","種類","項目")); //添加一行，数据为1,2,3


for($i=0;$i<4;$i++)
{

$xls->worksheets['Sheet']->addRow(array($i,$i,$i));

}


$xls->addsheet('Test');//新建一个sheet，参数为sheet名称
$xls->worksheets['Test']->addRow(array("3","2","3"));//在第二个sheet添加一行
$xls->generate('my-test');//下载excel，参数为文件名
*/

header("Content-type:application/vnd.ms-excel");
$filename
header("Content-Disposition:filename=".$filename.".xls"); 
?>

<table width="100">
   <tr>
      <td colspan="3"  align="center"><span style="color:red;"><?php  echo utf8_to_big5("工資表");   ?></span></td>
   </tr>
   <tr>
      <td>编号</td><td>姓名</td><td>月薪(元)</td>
   </tr>
   <tr>
      <td>001</td><td>张三</td><td>8000</td>
   </tr>
   <tr>
      <td>002</td><td>李四</td><td>9000</td>
   </tr>
   <tr>
      <td colspan="2" align="center">小计</td><td>=SUM(C3:C4)</td>
   </tr>
</table>


<?php

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