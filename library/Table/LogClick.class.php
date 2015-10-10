<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . "Table/BaseDB.class.php");

/**
 * 分享至塗鴉牆人數 LOG記錄資料表
 *
 * @package Hiiir\Table\LogClick
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class LogClick extends BaseDB 
{    
    /**
     * @var string 資料表名稱
     * @access protected
     */
    protected $_name = "log_click";

    function __construct() 
    {
        
    }

    /**
     * LOG 列表
     * 
     * @param string 略過筆數
     * @param string 取出筆數
     * @return array
     * @access public
     */
    public function listClickLog($offset = 0, $limit = 5000) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name ORDER BY `log_date` DESC LIMIT :offset, :limit";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
            $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "listClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * Count Total
     * 
     * @return int
     * @access public
     */
    public function countClickLog() 
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
                parent::logResError($this->_name, "listClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listClickLog", $e);
            return false;
        }
        return $result['Counts'];
    }

    /**
     * 新增 活動首頁 LOG
     * 
     * @return int
     * @access public
     */
    public function addIndexClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `index_click`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `index_click` = `index_click` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addIndexClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addIndexClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 新增 遊戲介紹頁 LOG
     * 
     * @return int
     * @access public
     */
    public function addIntroClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `intro_click`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `intro_click` = `intro_click` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addIntroClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addIntroClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 導覽(活動辦法) LOG
     * 
     * @return int
     * @access public
     */
    public function addActiveClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `active_click`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `active_click` = `active_click` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addActiveClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addActiveClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 導覽(料理照片募集) LOG
     * 
     * @return int
     * @access public
     */
    public function addPictureClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `picture_share`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `picture_share` = `picture_share` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "aaddPictureClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addPictureClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 新增 FACEBOOK分享 LOG
     * 
     * @return int
     * @access public
     */
    public function addFacebookShareLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `facebook_share`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `facebook_share` = `facebook_share` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addFacebookShareLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addFacebookShareLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 分享影片的按鈕(FB分享 拿料理箱) LOG
     * 
     * @return int 
     * @access public
     */
    public function addYoutudeClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `youtude_share`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `youtude_share` = `youtude_share` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addYoutudeClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addYoutudeClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 新增 尋寶去 LOG
     * 
     * @return int
     * @access public
     */
    public function addStartGameClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `start_game`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `start_game` = `start_game` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addStartGameClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addStartGameClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 開始的按鈕(玩遊戲 抽獎去)
     * 
     * @return int
     * @access public
     */
    public function addMissionStartClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `mission_start`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `mission_start` = `mission_start` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addMissionStartClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addMissionStartClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 表單填寫完submit  LOG
     * 
     * @return int
     * @access public
     */
    public function addSuccessClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `success_submit`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `success_submit` = `success_submit` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addSuccessClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addSuccessClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 領取參加獎按鈕(領取參加獎)LOG
     * 
     * @return int
     * @access public
     */
    public function addJoinPrizeClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `join_prize`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `join_prize` = `join_prize` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addJoinPrizeClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addJoinPrizeClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 表單填寫完submit LOG
     * 
     * @return int
     * @access public
     */
    public function addFailClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `fail_submit`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `fail_submit` = `fail_submit` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addFailClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addFailClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 新增 前往粉絲團(對照Hero) LOG
     * 
     * @return int
     * @access public
     */
    public function addFansClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `fans_click`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `fans_click` = `fans_click` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addFansClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addFansClickLog", $e);
            return false;
        }
        return $result;
    }

    /**
     * 新增 LOGIN 點擊 LOG
     * 
     * @return int
     * @access public
     */
    public function addLoginClickLog() 
    {
        $today = date("Y-m-d");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT INTO $this->_name (`log_date`, `login_click`) VALUES (:today, 1) 
                      ON DUPLICATE KEY UPDATE `login_click` = `login_click` + 1 ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "addLoginClickLog", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "addLoginClickLog", $e);
            return false;
        }
        return $result;
    }
}
?>