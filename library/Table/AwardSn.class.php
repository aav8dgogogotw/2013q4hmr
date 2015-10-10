<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . "Table/BaseDB.class.php");

/**
 * 獎品序號資料表
 *
 * @package Hiiir\Table\AwardSn
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class AwardSn extends BaseDB 
{
    /**
     * @var string 資料表名稱
     * @access protected
     */
    protected $_name = "tb_award_sn";

    function __construct() 
    {
        
    }

    /**
     * 新增 SN
     * 
     * @param string 關卡
     * @param string 序號
     * @param string 維護人
     * @return int
     * @access public
     */
    public function addAwardSn($stage, $sn, $user) 
    {
        $now = date("Y-m-d H:i:s");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`stage`, `sn`, `receive`, `create_id`, `create_time`, `update_id`) 
                      VALUES (:stage, :sn, 'N', :user, :now, :user) 
                      ON DUPLICATE KEY UPDATE `update_id` = :user";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":stage", $stage);
            $stmt->bindParam(":sn", $sn);
            $stmt->bindParam(":user", $user);
            $stmt->bindParam(":now", $now);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addAwardSn", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addAwardSn", $e);
            return false;
        }
        return $result;
    }

    /**
     * 每關卡序號資料筆數
     *
     * @param string 關卡
     * @return int
     * @access public
     */
    public function countAwardSnByStage($stage) 
    {
       if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT COUNT(*) AS `Counts` FROM $this->_name WHERE `stage` = :stage LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":stage", $stage);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countAwardSnByStage", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countAwardSnByStage", $e);
            return false;
        }
        return $result["Counts"];
    }
    
    /**
     * 每關卡序號被領取資料筆數
     *
     * @param string 關卡
     * @return int
     * @access public
     */
    public function countAwardSnByStageUserGet($stage) 
    {
       if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT COUNT(*) AS `Counts` FROM $this->_name WHERE `receive` = 'N' AND `stage` = :stage LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":stage", $stage);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countAwardSnByStage", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countAwardSnByStage", $e);
            return false;
        }
        return $result["Counts"];
    }

    /**
     * LIST
     * 
     * @param string 關卡
     * @return array
     * @access public
     */
    public function listAwardSnByStage($stage) 
    {
       if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name WHERE `stage` = :stage";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":stage", $stage);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countAwardSnByStage", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countAwardSnByStage", $e);
            return false;
        }
        return $result;
    }

    /**
     * 抽一筆序號出來當獎品
     * 
     * @param string 關卡
     * @param string Facebook ID
     * @return int $rowCount
     * @access public
     */
    public function receiveAwardSn($stage, $fbId)
    {
       if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "UPDATE IGNORE $this->_name SET receive = 'Y', fb_id = :fbId, get_time = :getTime 
                      WHERE `stage` = :stage AND receive = 'N' LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":fbId", $fbId);
            $stmt->bindParam(":getTime", date("Y-m-d H:i:s"));
            $stmt->bindParam(":stage", $stage);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "receiveAwardSn", $res);
                return false;
            }
        } catch (PDOException $e) {
            
            // log it
            parent::logPDOError($this->_name, "receiveAwardSn", $e);
            return false;
        }
        return $result;
    }

    /**
     * 使用者在關卡完成後得到的獎品
     * 
     * @param string 關卡
     * @param string Facebook ID
     * @return array
     * @access public
     */
    public function getAwardSn($stage, $fbId) 
    {
       if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name WHERE `stage` = :stage AND `fb_id` = :fbId LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":stage", $stage);
            $stmt->bindParam(":fbId", $fbId);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "getAwardSn", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "getAwardSn", $e);
            return false;
        }
        return $result;
    }
}
?>