<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . 'Table/BaseDB.class.php');

/**
 * 管理者資料表
 *
 * @package Hiiir\Table\Permission
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class Permission extends BaseDB {
    
    protected $_name = 'tb_permission';

    function __construct() {
        
    }

    /**
     * 使用者功能權限
     * 
     * @param array $param_array 
     * @return boolean
     * @access public
     */
    public function getPermissionById($admin_id) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name WHERE `admin_id` = :admin_id LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":admin_id", $admin_id);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "getPermissionById", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "getPermissionById", $e);
            return false;
        }
        return $result;
    }
}
?>