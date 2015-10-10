<?php 

if(!isset($_SESSION['adm_id'])){
    session_unregister('adm_id');
    session_unregister('adm_name');
    session_unregister('adm_email');
    session_unregister('adm_ip');
    header("Location: ?page=login");
    exit();
}
?>