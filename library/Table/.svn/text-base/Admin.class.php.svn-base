<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . "Table/BaseDB.class.php");

/**
 * 管理者資料表
 *
 * @package Hiiir\Table\Admin
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class Admin extends BaseDB 
{
    /**
     * @var string 資料表名稱
     * @access protected
     */
    protected $_name = "tb_admin";

    function __construct() 
    {
        
    }

    /**
     * 管理者登入資訊
     * 
     * @param srting 管理者帳號 
     * @return array
     * @access public
     */
    public function login($account) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name WHERE `account` = :account LIMIT 1";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":account", $account);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "login", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "login", $e);
            return false;
        }
        return $result;
    }

    /**
     * 紀錄管理者登入IP
     * 
     * @param string 管理者帳號
     * @param string IP Address
     * @return int
     * @access public
     */
    public function updateLoginIp($account, $ip) 
    {
        $now = date('Y-m-d H:i:s');

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "UPDATE $this->_name 
                SET `first_ip` = `last_ip`, `first_time` = `last_time`, `last_ip` = :ip, `last_time` = :now 
                WHERE `account` = :account LIMIT 1";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":account", $account);
            $stmt->bindParam(":ip", $ip);
            $stmt->bindParam(":now", $now);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "updateLoginIp", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "updateLoginIp", $e);
            return false;
        }
        return $result;
    }
}
?>