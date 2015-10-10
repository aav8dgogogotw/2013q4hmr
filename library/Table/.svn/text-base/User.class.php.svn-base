<?php

/**
 * Base Database
 * PDO 連結 Database 的基本設定
 */
include_once (LIB_PATH . "Table/BaseDB.class.php");

/**
 * 使用者資料表
 *
 * @package Hiiir\Table\User
 * @author Hugo Wang <hugo_wang@hiiir.com>
 * @version 1.0
 */
class User extends BaseDB 
{
    
    /**
     * @var string 資料表名稱
     * @access protected
     */
    protected $_name = "tb_user";

    function __construct() 
    {
        
    }

    /**
     * 使用者列表
     * 
     * @param string 略過筆數
     * @param string 取出筆數
     * @return array
     * @access public
     */
    public function listUser($offset = 0, $limit = 5000) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT * FROM $this->_name ORDER BY `user_id` DESC LIMIT :offset, :limit";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
            $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "listUser", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listUser", $e);
            return false;
        }
        return $result;
    }


    /**
     * 使用者資料總筆數
     * 
     * @return int
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
     * 取得 already join = 0 的使用者數
     * 
     * @param string facebook id
     * @return boolean
     * @access public
     */
    public function checkUserAlreadyJoin($fbId) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT `fb_id` FROM $this->_name 
                        WHERE `fb_id` = :fbId AND `already_join` = '0' LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":fbId", $fbId);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                /*if ($result_data) {
                    $result = true;
                } else {
                    $result = false;
                }
                */
            } else {
                
                // log it
                parent::logResError($this->_name, "checkUserAlreadyJoin", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "checkUserAlreadyJoin", $e);
            return false;
        }
        return $result;
    }

    /**
     * 使用者登錄資訊
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
            $query = "INSERT INTO $this->_name (fb_id, user_name, email, sex, already_join, game_join, create_date, create_time) 
                        VALUES (:fbId, :name, :email, :sex, :join, :join, :createDate, :createTime)";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $data["fbId"]);
            $stmt->bindParam(":name", $data["name"]);
            $stmt->bindParam(":email", $data["email"]);
            $stmt->bindParam(":sex", $data["sex"]);
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

    /**
     * 取得使用者資訊
     * 
     * @param string 資料流水號 
     * @return array
     * @access public
     */
    public function get($id) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT user_id, fb_id, user_name, act1, act2, act3, act4, act5, act6  FROM $this->_name WHERE user_id = :id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":id", $id);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "get", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "get", $e);
            return false;
        }
        return $result;
    }

    /**
     * 取得使用者資訊 by FB ID
     * 
     * @param string Facebook Id 
     * @return array
     * @access public
     */
    public function getByFbId($fbId) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT user_id, fb_id, user_name, act1, act2, act3, act4, act5, act6  FROM $this->_name WHERE fb_id = :fbId";
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
     * 更新使用者資訊
     * 
     * @param array 資料陣列
     * @param int 資料流水號 
     * @return int
     * @access public
     */
    public function update($data, $id) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "UPDATE $this->_name SET user_name = :name, email = :email, sex = :sex, game_join = :join WHERE user_id = :id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":sex", $data['sex']);
            $stmt->bindParam(":join", $data['join']);
            $stmt->bindParam(":id", $id);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "update", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "update", $e);
            return false;
        }
        return $result;
    }

    /**
     * 更新使用者資訊 By FB ID
     * 
     * @param array 資料陣列 
     * @param string Facebook ID
     * @return int
     * @access public
     */
    public function updateByFbId($data, $fbId) 
    {
        $now = date('Y-m-d H:i:s');

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "UPDATE $this->_name SET user_name = :name, email = :email, sex = :sex, game_join = :join WHERE fb_id = :fbId";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":sex", $data['sex']);
            $stmt->bindParam(":join", $data['join']);
            $stmt->bindParam(":fbId", $fbId);
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
     * 更新使用者過關資訊 By FB ID
     * 
     * @param string 關卡名稱
     * @param string Facebook ID
     * @return int
     * @access public
     */
    public function updateActByFbId($act, $num, $fbId) 
    {
        $now = date('Y-m-d H:i:s');

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = sprintf("UPDATE IGNORE $this->_name SET %s = %s WHERE fb_id = :fbId AND %s = 0 LIMIT 1", $act, $num, $act);
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $fbId);
            $res = $stmt->execute();

            if ($res === true) {

                $result = $stmt->rowCount();
            } else {
                // log it
                parent::logResError($this->_name, "updateActByFbId", $res);
                return false;
            }
        } catch (PDOException $e) {
            
            // log it
            parent::logPDOError($this->_name, "updateActByFbId", $e);
            return false;
        }
        return $result;
    }

    /**
     * 更新使用者過關資訊 By FB ID
     * 
     * @param string 關卡名稱
     * @param string max
     * @return int
     * @access public
     */
    public function actMax($act) 
    {
        $now = date('Y-m-d H:i:s');

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = sprintf("SELECT MAX(%s) as max FROM $this->_name", $act);
            $stmt = $this->pdo->prepare($query);

            $res = $stmt->execute();

            if ($res === true) {

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                // log it
                parent::logResError($this->_name, "actMax", $res);
                return false;
            }
        } catch (PDOException $e) {
            
            // log it
            parent::logPDOError($this->_name, "actMax", $e);
            return false;
        }
        return $result;
    }

    /**
     * 取得過關人數 ID
     * 
     * @param array $param_array 
     * @return boolean
     * @access public
     */
    public function passCount($stage) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = sprintf("SELECT COUNT(user_id) as num FROM $this->_name WHERE %s = 1", $stage);
            $stmt = $this->pdo->prepare($query);
            
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "passCount", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "passCount", $e);
            return false;
        }
        return $result;
    }


    /**
     * 使用者列表
     * 
     * @return array $result
     * @access public
     */
    public function listFbidByCreateDate($date) 
    {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT `fb_id` FROM $this->_name WHERE `create_date` = :create_date";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":create_date", $date);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                
                // log it
                parent::logResError($this->_name, "listFbidByCreateDate", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "listFbidByCreateDate", $e);
            return false;
        }
        return $result;
    }


    /**
     * 依是否加入遊戲來取得好友列表
     * 
     * @param array $param_array 
     * @return boolean
     * @access public
     */
    public function listByJoin($join) {
        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "SELECT fb_id, user_name, email, sex FROM $this->_name WHERE game_join = :join GROUP BY fb_id";
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
     * 更新使用者加入進戲資訊
     * 
     * @param array $param_array 
     * @return boolean
     * @access public
     */
    public function updateUserJoin($fbId) {        

        if (!is_object($this->pdo))
            $this->connect($DBConfig["Master"]);

        try {
            $query = "UPDATE $this->_name SET game_join = 1 WHERE fb_id = :fbId";
                        
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(":fbId", $fbId);
            $res = $stmt->execute();

            if ($res === true) {
                $result = $stmt->rowCount();
            } else {
                
                // log it
                parent::logResError($this->_name, "updateUserJoin", $res);
                return false;
            }
        } catch (PDOException $e) {

            // log it
            parent::logPDOError($this->_name, "updateUserJoin", $e);
            return false;
        }

        return $result;
    }
}
?>