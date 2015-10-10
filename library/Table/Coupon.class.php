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
class Coupon extends BaseDB {
    
    protected $_name = 'tb_coupon';

    function __construct() {
        
    }


 

       /**
     * 取出隨機一筆酷朋券的號碼
     * select * from <table name> order by rand() limit 1;
     * @return array
     * @access public
     */
    public function getByRandCoupon() 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT  *  FROM $this->_name order by rand() limit 1 ";
            $stmt = $this->pdo->prepare($query);

           // $stmt->bindParam(":fbId", $fbId);
           // $stmt->bindParam(":today", $today);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "getByRandCoupon", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "getByRandCoupon", $e);
            return false;
        }
        return $result;
    }

   


    /**
     * 刪除已經發出的酷朋券
     * 
     * @return int $affectedRow
     * @access public
     */
    public function deleteEmailCoupon($coupon) 
    {
        

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            
            $query = "DELETE FROM $this->_name WHERE `coupon` = :coupon";
            $stmt = $this->pdo->prepare($query);   
            $stmt->bindParam(":coupon", $coupon);      
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "deleteEmailCoupon", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "deleteEmailCoupon", $e);
            return false;
        }
        return $result;
    }




     



    

    

    
   




}
?>