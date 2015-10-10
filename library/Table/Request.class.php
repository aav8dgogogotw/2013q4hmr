<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . "Table/BaseDB.class.php");

/**
 * 遊戲玩家資料表
 *
 * @package Hiiir\Table\Game
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class Request extends BaseDB
{
    /**
     * @var string 資料表名稱
     * @access protected
     */
    protected $_name = "tb_request";

    function __construct()
    {
        
    }

    /**
     * 取得資料 BY Facebook Id
     * 
     * @param string facebook id
     * @return int
     * @access public
     */
    public function listByFbId($fbId, $flag) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name WHERE fb_id = :fbId AND game_join = :join";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":fbId", $fbId);
            $stmt->bindParam(":join", $flag);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "listByFbId", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listByFbId", $e);
            return false;
        }
        return $result;
    }

    /**
     * 取得資料 BY Facebook Id
     * 
     * @param string facebook id
     * @return int
     * @access public
     */
    public function updateByFbId($fbId, $time, $join) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            if($join > 0)
                $query = "UPDATE $this->_name SET game_join = 1 WHERE fb_id = :fbId AND game_join = 0 AND create_time < :time";
            else
                $query = "UPDATE $this->_name SET game_join = -1 WHERE fb_id = :fbId AND game_join = 0 AND create_time > :time";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":fbId", $fbId);
            $stmt->bindParam(":time", date("Y-m-d H:i:s", $time));
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "updateByFbId", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "updateByFbId", $e);
            return false;
        }
        return $result;
    }

    /**
     * 新增資料
     * 
     * @param array 日期(Y-m-d)
     * @return int 最後一筆的ID
     * @access public
     */
    public function add($data) 
    {
        
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT IGNORE INTO $this->_name (fb_id, sender_id, game_join, create_date, create_time) 
                      VALUES (:fbId, :senderId, :join, :createDate, :createTime)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":fbId", $data["fbId"]);
            $stmt->bindParam(":senderId", $data["senderId"]);
            $stmt->bindParam(":join", $data["join"]);
            $stmt->bindParam(":createDate", $data["today"]);
            $stmt->bindParam(":createTime", $data["now"]);
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

        
}
?>