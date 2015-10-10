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
class LogLike extends BaseDB {
    
    protected $_name = 'log_like';

    function __construct() {
        
    }


    /**
     * 新增 LOG
     * 
     * @param array $param 
     * @return int LastInsertId
     * @access public
     */
    public function addLikeLog($param) 
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
                parent::logResError($this->_name, "addLoginLike", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addLoginLike", $e);
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
    public function countLikeLogByDate($date) 
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
                parent::logResError($this->_name, "countLikeLogByDate", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countLikeLogByDate", $e);
            return false;
        }
        return $result['Counts'];
    }
}
?>