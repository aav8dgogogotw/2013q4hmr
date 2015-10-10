<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . 'Table/BaseDB.class.php');

/**
 * 使用者資料表
 *
 * @package Hiiir\Table\Admin
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class LogActFinish extends BaseDB {
    
    protected $_name = 'log_act_finish';

    function __construct() {
        
    }    


    /**
     * 使用者資料總筆數
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
     * 使用者登錄資訊
     * 
     * @param array $param_array 
     * @return boolean
     * @access public
     */
    public function add($data) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT IGNORE INTO log_act_finish (fb_id, ip, act, log_date) 
                        VALUES (:fbId, :ip, :act, :log_date)";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $data['fbId']);
            $stmt->bindParam(":ip", $data['ip']);
            $stmt->bindParam(":act", $data['log']);
            $stmt->bindParam(":log_date", $data['today']);
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
     * 取得某日的人數
     * 
     * @param string $date 
     * @return int $counts
     * @access public
     */
    public function countActFinishLogByDate($date) 
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
                parent::logResError($this->_name, "countActFinishLogByDate", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countActFinishLogByDate", $e);
            return false;
        }
        return $result['Counts'];
    }

    /**
     * 取得某日的人數
     * 
     * @param string $date 
     * @return int $counts
     * @access public
     */
    public function countActFinishLogByDateAndAct($date, $act) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT COUNT(*) AS `Counts` FROM $this->_name 
            WHERE `log_date` = :log_date AND `act` = :act LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":log_date", $date);
            $stmt->bindParam(":act", $act);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countActFinishLogByDateAndAct", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countActFinishLogByDateAndAct", $e);
            return false;
        }
        return $result['Counts'];
    }
}
?>