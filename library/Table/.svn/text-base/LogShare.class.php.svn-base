<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . 'Table/BaseDB.class.php');

/**
 * 分享至塗鴉牆人數 LOG記錄資料表
 *
 * @package Hiiir\Table\Admin
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class LogShare extends BaseDB {
    
    protected $_name = 'log_share';

    function __construct() {
        
    }


    /**
     * LOG 列表
     * 
     * @param array $param 
     * @return array $result
     * @access public
     */
    public function listLoginShare($offset=0, $limit=5000) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name LIMIT :offset, :limit";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindValue(":offset", $offset);
            $stmt->bindValue(":limit", $limit);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "listLoginShare", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listLoginShare", $e);
            return false;
        }
        return $result;
    }


    /**
     * 計算LOG資料筆數
     * 
     * @param array $param 
     * @return int $Counts
     * @access public
     */
    public function countLoginShare() 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT COUNT(*) AS `Counts` FROM $this->_name LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countLoginShare", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countLoginShare", $e);
            return false;
        }
        return $result["Counts"];
    }


    /**
     * 計算某日的LOG資料筆數
     * 
     * @param array $param 
     * @return int $Counts
     * @access public
     */
    public function countLoginShareByDate($date) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT COUNT(*) AS `Counts` FROM $this->_name WHERE $log_date = :log_date LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":log_date", $date);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countLoginShare", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countLoginShare", $e);
            return false;
        }
        return $result["Counts"];
    }


    /**
     * 新增 LOG
     * 
     * @param array $param 
     * @return int $LastInsertId
     * @access public
     */
    public function addShareLog($param) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name(`fb_id`, `ip`, `log_date`) VALUES(?, ?, ?)";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(1, $param["fb_id"]);
            $stmt->bindParam(2, $param["ip"]);
            $stmt->bindParam(3, $param["today"]);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $this->pdo->lastInsertId();
            } else {
                
                // log it
                parent::logResError($this->_name, "addShareLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addShareLog", $e);
            return false;
        }
        return $result;
    }

}
?>