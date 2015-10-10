<?php 
/*
 * 這是子目錄的程式碼
 */

if(!is_object($menu)){
    include_once(LIB_PATH . "Table/Menu.class.php");
    $menu = new Menu();
}
    
$my_place = explode( '/', $_GET['page']); //抓取目前現在的目錄位置
$sub_menu = $menu->listByMenuLink($my_place[0]); //主要目錄

if(empty($permissioin)){
    if(!is_object($tb_permission)){
        include_once(LIB_PATH . "Table/Permission.class.php");
        $tb_permission = new Permission();
    }
    $permission = $tb_permission->getPermissionById($_SESSION['adm_id']);
    $permission = explode(',', $permission['menu_id']);
}
?>

<?php
    if(sizeof($sub_menu)):
        foreach($sub_menu as $row):
            if(in_array($row['menu_id'], $permission)):
                $sub_place = explode('/', $row['menu_link']);
                if(isset($my_place[1]) && isset($sub_place[1]) && $my_place[1] == $sub_place[1]):
?>
    <a id='account-menu-on' href="index.php?page=<?=$row['menu_def_link']?>&return_url=<?php echo $this->return_url;?>" ><?=$row['menu_name']?></a>
<? else: ?>
    <a id='account-menu' href="index.php?page=<?=$row['menu_def_link']?>&return_url=<?php echo $this->return_url;?>" ><?=$row['menu_name']?></a>
<?php endif; endif; endforeach; endif;?>