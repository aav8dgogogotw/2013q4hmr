<?php

include_once(LIB_PATH . "Table/User.class.php");
$tb_user = new User();

$list = $tb_user->listUser();
/*
if ($list) {
    foreach ($list as $key => $value) {
        $date = $value['log_time'];



    }    
}
*/

$tpl->list = $list;  
?>