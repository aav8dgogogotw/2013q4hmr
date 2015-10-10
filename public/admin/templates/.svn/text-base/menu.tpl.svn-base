<?php 
/*
 * 這是主目錄的程式碼
 */

include_once(LIB_PATH . "Table/Menu.class.php");

$menu = new Menu();

// 主要目錄
$mainMenu = $menu->getMenuList();

// 抓取目前現在的目錄位置
$place = explode('/', $_GET['page']);

include_once(LIB_PATH . "Table/Permission.class.php");
$tb_permission = new Permission();
$permission = $tb_permission->getPermissionById($_SESSION['adm_id']);
$permission = explode(',', $permission['menu_id']);

if ($_GET['page'] != 'welcome' and $_GET['page'] != 'denied' and $_GET['page'] != 'login_off') {

    $res = $menu->getMenuByLink($_GET['page']);

    if (!in_array($res['menu_id'], $permission)) {
        header("Location: index.php?page=denied");
    }
}
unset($menu, $admin);
?>
<?php foreach($mainMenu as $row): ?>
    <?php if(in_array($row['menu_id'], $permission)): ?>
        <?php if($place[0] == $row['menu_link']): ?>
            <a id='account-menu-on' href="index.php?page=<?=$row['menu_def_link']?>" ><?php echo $row['menu_name']; ?></a>
        <?php else: ?>
            <a id='account-menu' href="index.php?page=<?=$row['menu_def_link']?>" ><?php echo $row['menu_name']; ?></a>
    <?php endif; endif; ?>
<?php endforeach; ?>