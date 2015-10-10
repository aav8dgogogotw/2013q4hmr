<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . 'Table/BaseDB.class.php');

/**
 * 管理者資料表
 *
 * @package Hiiir\Table\Admin
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class Menu extends BaseDB {
    
    protected $_name = 'tb_menu';

    function __construct() {
        
    }

    /**
     * 使用者登入資訊
     * 
     * @param array $param_array 
     * @return boolean
     * @access public
     */
    public function getMenuList() 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name 
                        WHERE `flag_delete` = 'N' AND `status` = 'Y' AND `type` = '1' AND `parent_id` = '0' 
                        ORDER BY `sort` ASC";
            $stmt = $this->pdo->prepare($query);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "getMenuList", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "getMenuList", $e);
            return false;
        }
        return $result;
    }


    /**
     * 
     * 
     * @param array $param_array 
     * @return boolean
     * @access public
     */
    public function getMenuByLink($link) {
        if(!is_object($this->pdo))
            $this->connect();

        try {
            $query = "SELECT `menu_id` FROM $this->_name 
                        WHERE `flag_delete` = 'N' AND `status` = 'Y' AND `menu_def_link` = ? 
                        ORDER BY `sort` ASC, `menu_id` ASC 
                        LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(1, $link);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch(PDOException $e) {
            
            // log it
            parent::logPDOError($this->_name, "getMenuList", $e);
            return false;
        }

        return $result;
    }


    /**
     * 
     * 
     * @param array $param_array 
     * @return boolean
     * @access public
     */
    public function listByMenuLink($menuLink) {
        if(!is_object($this->pdo))
            $this->connect();

        try {
            $query = "SELECT * FROM $this->_name 
                        WHERE `menu_link` = :menu_link AND `parent_id` <> '0' AND `type` = '1' 
                        ORDER BY `sort` ASC, `menu_id` ASC";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":menu_link", $menuLink);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch(PDOException $e) {
            
            // log it
            parent::logPDOError($this->_name, "getMenuList", $e);
            return false;
        }

        return $result;
    }
}
?>