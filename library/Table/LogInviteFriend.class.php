<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . 'Table/BaseDB.class.php');

/**
 * 按讚 LOG記錄資料表
 *
 * @package Hiiir\Table\Admin
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class LogInviteFriend extends BaseDB {
    
    protected $_name = 'log_invite_friend';

    function __construct() {
        
    }

    /**
     * 新增 LOG 
     * 重覆的不過濾，繼續往下記錄。
     * 
     * @param array $param 
     * @return int LastInsertId
     * @access public
     */
    public function addInviteFriendLog($param) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name(`fb_id`, `ip`, `friend_id`, `log_date`) VALUES(?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(1, $param["fb_id"]);
            $stmt->bindParam(2, $param["ip"]);
            $stmt->bindParam(3, $param["friend_id"]);
            $stmt->bindParam(4, $param["today"]);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $this->pdo->lastInsertId();
            } else {
                
                // log it
                parent::logResError($this->_name, "addInviteFriendLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addInviteFriendLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 取得某日的 LOG 數
     * 
     * @param string $date 
     * @return int $counts
     * @access public
     */
    public function countInviteFriendLogByDate($date) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT COUNT(*) AS `Counts` FROM $this->_name 
            WHERE `log_date` = :log_date LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":log_date", $date);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countInviteFriendLogByDate", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countInviteFriendLogByDate", $e);
            return false;
        }
        return $result['Counts'];
    }

    /**
     * 取得某日的 LOG 數
     * 
     * @param string $date 
     * @return int $counts
     * @access public
     */
    public function listFriendEnterGameByDate($date) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT `friend_id` FROM $this->_name 
            WHERE `friend_enter_date` = :friend_enter_date GROUP BY `friend_id`";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":friend_enter_date", $date);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "listFriendEnterGameByDate", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listFriendEnterGameByDate", $e);
            return false;
        }
        return $result;
    }

    /**
     * 取得某日的 LOG 數
     * 
     * @param string $date 
     * @return int $counts
     * @access public
     */
    public function listInviteFriend() 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT `friend_id` FROM $this->_name GROUP BY `friend_id`";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":friend_enter_date", $date);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "listInviteFriend", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listInviteFriend", $e);
            return false;
        }
        return $result;
    }
}
?>