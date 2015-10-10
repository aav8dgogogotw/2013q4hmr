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
class Lottery extends BaseDB {
    
    protected $_name = 'tb_lottery';

    function __construct() {
        
    }


    /**
     * 寫入抽獎資料
     * 
     * @return int $affectedRow
     * @access public
     */
    public function add($data) 
    {
        $now = date("Y-m-d H:i:s");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "INSERT IGNORE INTO $this->_name (`fb_id`, `name`, `tel`, `email`, `addr`, `attend_time`, `isfriend`, `isfood`, `agreedata`,`readservice`,  `create_date`, `create_time`, `isfail`, `issuccess`, `friendyears`, `iswork`, `howfire`, `foodspecies`, `fooditems` , `coupon_number`) VALUES 
                    (:fbId, :name, :tel, :email, :addr, :attend_time,  :isfriend, :isfood, :agreedata, :readservice, :createDate, :createTime, :isfail, :issuccess, :friendyears, :iswork, :howfire, :foodspecies, :fooditems, :coupon_number)";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":fbId", $data['fbId']);
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":tel", $data['tel']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":addr", $data['addr']);
            $stmt->bindParam(":createDate", $data['today']);
            $stmt->bindParam(":createTime", $data['now']);
            $stmt->bindParam(":isfail", $data['isfail']);
            $stmt->bindParam(":issuccess", $data['issuccess']);
            $stmt->bindParam(":attend_time", $data['attend_time']);
            $stmt->bindParam(":isfriend", $data['isfriend']);
            $stmt->bindParam(":isfood", $data['isfood']);
            $stmt->bindParam(":agreedata", $data['agreedata']);
            $stmt->bindParam(":readservice", $data['readservice']);
            $stmt->bindParam(":friendyears", $data['friendyears']);
             $stmt->bindParam(":iswork", $data['iswork']);
              $stmt->bindParam(":howfire", $data['howfire']);
              $stmt->bindParam(":foodspecies", $data['foodspecies']);
              $stmt->bindParam(":fooditems", $data['fooditems']);
              $stmt->bindParam(":coupon_number", $data['coupon_number']);

//
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
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
     * getByFbId
     * 
     * @return array
     * @access public
     */
    public function getByFbId($fbId) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT  *  FROM $this->_name WHERE fb_id = :fbId ";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $fbId);
           // $stmt->bindParam(":today", $today);
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
     * getLottery
     * 
     * @return array
     * @access public
     */
    public function getByLotteryFbId($fbId) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT  *  FROM $this->_name WHERE fb_id = :fbId ";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $fbId);
           // $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "getByLotteryFbId", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "getByLotteryFbId", $e);
            return false;
        }
        return $result;
    }


    /**
     * isfail為1,則更新另外一項為1
     * 
     * @return int $affectedRow
     * @access public
     */
    public function updateStatusSuccess($successfail,$fbId) 
    {
        $now = date("Y-m-d H:i:s");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            
            $query = "UPDATE $this->_name SET `issuccess` = :issuccess WHERE `fb_id` = :fbId";
            $stmt = $this->pdo->prepare($query);   
            $stmt->bindParam(":fbId", $fbId);  
            $stmt->bindParam(":issuccess", $successfail);       
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "updateStatusSuccess", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "updateStatusSuccess", $e);
            return false;
        }
        return $result;
    }

    




      /**
     * issuccess為1,則更新另外一項為1
     * 
     * @return int $affectedRow
     * @access public
     */
    public function updateStatusFail($successfail,$coupon_number,$fbId) 
    {
        $now = date("Y-m-d H:i:s");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {

            $query = "UPDATE $this->_name SET `isfail` = :isfail,`coupon_number` = :coupon_number WHERE `fb_id` = :fbId";
            $stmt = $this->pdo->prepare($query);  
            $stmt->bindParam(":fbId", $fbId); 
            $stmt->bindParam(":isfail", $successfail);   
            $stmt->bindParam(":coupon_number", $coupon_number);        
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "updateStatusFail", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "updateStatusFail", $e);
            return false;
        }
        return $result;
    }



    /**
     * 更新抽獎資料
     * 
     * @return int $affectedRow
     * @access public
     */
    public function updateByFbId($data, $fbId) 
    {
        $now = date("Y-m-d H:i:s");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "UPDATE $this->_name SET `name = :name`, `tel` = :tel, `email` = :email, `addr` = :addr WHERE `fb_id` = :fbId";

            $stmt = $this->pdo->prepare($query);            
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":tel", $data['tel']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":addr", $data['addr']);
            $stmt->bindParam(":fbId", $data['fbId']);

            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
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
     * 更新抽獎資料
     * 
     * @return int $affectedRow
     * @access public
     */
    public function update($data, $id) 
    {
        $now = date("Y-m-d H:i:s");

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "UPDATE $this->_name SET `name = :name`, `tel` = :tel, `email` = :email, `addr` = :addr WHERE `id` = :id";

            $stmt = $this->pdo->prepare($query);            
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":tel", $data['tel']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":addr", $data['addr']);
            $stmt->bindParam(":id", $data['id']);

            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
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
     * 計算某日的新增資料筆數
     * 
     * @param array $param 
     * @return int $Counts
     * @access public
     */
    public function countLotteryByDate($date) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {

            $query = "SELECT COUNT(*) AS `Counts` FROM $this->_name 
            WHERE create_date = :create_date LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":create_date", $date);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countLotteryByDate", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countLotteryByDate", $e);
            return false;
        }
        return $result["Counts"];
    }

    /**
     * 計算該FB_ID是否有填寫過資料
     * 
     * @param array $param 
     * @return int $Counts
     * @access public
     */
    public function countLotteryFbid($fbid) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {

            $query = "SELECT COUNT(*) AS `Counts` FROM $this->_name 
            WHERE fb_id = :fbid ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":fbid", $fbid);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "countLotteryFbid", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "countLotteryFbid", $e);
            return false;
        }
        return $result["Counts"];
    }



    /**
     * 取出該FB_ID的電子信箱
     * 
     * @return array
     * @access public
     */
    public function getByLotteryEmail($fbId) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT  *  FROM $this->_name WHERE fb_id = :fbId ";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $fbId);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "getByLotteryEmail", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "getByLotteryEmail", $e);
            return false;
        }
        return $result;
    }





}
?>