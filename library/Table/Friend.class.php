<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . 'Table/BaseDB.class.php');

/**
 * 朋友關係資料表
 *
 * @package Hiiir\Table\Friend
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class Friend extends BaseDB 
{
    
    /**
     * @var string 資料表名稱
     * @access protected
     */
    protected $_name = "tb_relation";

    function __construct() 
    {
        
    }

    /**
     * 朋友關係資料總筆數
     * 
     * @return int $counts
     * @access public
     */
    public function countUser() 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT COUNT(*) AS `Counts` FROM $this->_name";
            $stmt = $this->pdo->prepare($query);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countUser", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countUser", $e);
            return false;
        }
        return $result['Counts'];
    }

    /**
     * 邀請好友並已登錄資訊
     * 
     * @param array 資料陣列 
     * @return int
     * @access public
     */
    public function addJoin($data)
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (fb_id, friend_id, game_join, create_date, create_time) 
                        VALUES (:fbId, :friendId, -1, :createDate, :createTime)";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $data['fbId']);
            $stmt->bindParam(":friendId", $data['friendId']);
            $stmt->bindParam(":createDate", $data['today']);
            $stmt->bindParam(":createTime", $data['now']);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $this->pdo->lastInsertId();
            } else {
                
                // log it
                parent::logResError($this->_name, "add", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "add", $e);
            return false;
        }
        return $result;
    }

    /**
     * 邀請好友登錄資訊
     * 
     * @param array 資料陣列 
     * @return int
     * @access public
     */
    public function add($data)
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (fb_id, friend_id, create_date, create_time) 
                        VALUES (:fbId, :friendId, :createDate, :createTime)";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $data['fbId']);
            $stmt->bindParam(":friendId", $data['friendId']);
            $stmt->bindParam(":createDate", $data['today']);
            $stmt->bindParam(":createTime", $data['now']);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $this->pdo->lastInsertId();
            } else {
                
                // log it
                parent::logResError($this->_name, "add", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "add", $e);
            return false;
        }
        return $result;
    }

    /**
     * 取得好友邀請數量資訊資訊
     * 
     * @param string Facebook ID 
     * @return array
     * @access public
     */
    public function getInviteNum($fbId)
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT friend_id FROM $this->_name WHERE fb_id = :fbId GROUP BY friend_id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $fbId);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "getInviteNum", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "getInviteNum", $e);
            return false;
        }
        return $result;
    }

    /**
     * 取得加入遊戲好友人數資訊
     * 
     * @param string Facebook ID
     * @return array
     * @access public
     */
    public function getGameNum($fbId)
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT friend_id FROM $this->_name WHERE fb_id = :fbId AND game_join = 1 GROUP BY friend_id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $fbId);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "getInviteNum", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "getInviteNum", $e);
            return false;
        }
        return $result;
    }

    /**
     * 更新好友加入遊戲資訊
     * 
     * @param string Facebook ID 
     * @return int
     * @access public
     */
    public function updateFriendJoin($fbId, $time)
    {

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {

            $query = "UPDATE $this->_name SET game_join = -1 WHERE friend_id = :fbId AND game_join = 0 AND create_time > :time";
                        
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $fbId);
            $stmt->bindParam(":time", date("Y-m-d H:i:s", $time));
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "updataFriendJoin", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "updataFriendJoin", $e);
            return false;
        }

        return $result;
    }

    /**
     * 更新好友加入遊戲資訊
     * 
     * @param string Facebook ID 
     * @return int
     * @access public
     */
    
    public function updateFriendInvite($fbId, $senderId)
    {

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {

            $query = "UPDATE $this->_name SET game_join = 1 WHERE fb_id = :senderId AND friend_id = :fbId";
                        
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $fbId);
            $stmt->bindParam(":senderId", $senderId);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "updateFriendInvite", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "updateFriendInvite", $e);
            return false;
        }

        return $result;
    }

    /**
     * 依是否加入遊戲來取得好友列表
     * 
     * @param int Flag Join  
     * @return array
     * @access public
     */
    public function listByJoin($join)
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT friend_id FROM $this->_name WHERE game_join = :join GROUP BY friend_id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":join", $join);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "listByJoin", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listByJoin", $e);
            return false;
        }
        return $result;
    }

    /**
     * 取得好友列表
     * 
     * @param int Flag Join  
     * @return array
     * @access public
     */
    public function listFriend($fbId)
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT friend_id FROM $this->_name WHERE fb_id = :fbId GROUP BY friend_id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $fbId);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
                foreach($result as $row) {
                    $list[] = intval($row['friend_id']);
                }
            } else {
                
                // log it
                parent::logResError($this->_name, "listFriend", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listFriend", $e);
            return false;
        }
        return $list;
    }    
}
?>