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
class Game extends BaseDB
{
    /**
     * @var string 資料表名稱
     * @access protected
     */
    protected $_name = "tb_game";

    function __construct()
    {
        
    }

    /**
     * 取得加入遊戲的玩家列表 BY Day
     * 
     * @param string 日期(Y-m-d)
     * @return array 
     * @access public
     */
    public function listGameUserByDate($date) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name WHERE `create_date` = :createDate";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":createDate", $date);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "listGameUserByDate", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listGameUserByDate", $e);
            return false;
        }
        return $result;
    }

    /**
     * 取得加入遊戲的玩家人數 BY Day
     * 
     * @param string 日期(Y-m-d) 
     * @return int
     * @access public
     */
    public function countGameUserByDate($date) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT COUNT(*) AS `Counts` FROM $this->_name WHERE `create_date` = :createDate LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":createDate", $date);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countGameUserByDate", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countGameUserByDate", $e);
            return false;
        }
        return $result['Counts'];
    }

    /**
     * 取得資料 BY Facebook Id
     * 
     * @param string facebook id
     * @return int
     * @access public
     */
    public function getByFbId($fbId) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name WHERE fb_id = :fbId LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":fbId", $fbId);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "getByFbId", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "getByFbId", $e);
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
            $query = "INSERT IGNORE INTO $this->_name (fb_id, gameacc, sid, name, join_time, create_date, create_time) 
                      VALUES (:fbId, :gameacc, :sid, :name, :joinTime, :createDate, :createTime)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":fbId", $data["fbId"]);
            $stmt->bindParam(":gameacc", $data["gameacc"]);
            $stmt->bindParam(":sid", $data["sid"]);
            $stmt->bindParam(":name", $data["gamename"]);
            $stmt->bindParam(":joinTime", date("Y-m-d H:i:s", $data["addtime"]));
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

    /**
     * 取得加入遊戲的玩家列表 BY Day
     * 
     * @param  
     * @return list
     * @access public
     */
    public function listGameUser($date) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT fb_id FROM $this->_name GROUP BY fb_id";
            $stmt = $this->pdo->prepare($query);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "listGameUser", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listGameUser", $e);
            return false;
        }
        return $result;
    }
        
}
?>