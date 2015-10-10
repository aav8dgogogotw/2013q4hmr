<?php

class BaseDB
{
	protected $pdo; // pdo object
	protected $logger;
	protected $error;

	/**
	 * global use pdo
	 *
	 * @param object $pdo
	 */
	public function set_pdo($pdo)
	{
		$this->pdo = $pdo;
	}

	public function set_logger($logger)
	{
		$this->logger = $logger;
	}

	public function log_info($text)
	{
		if (is_object($this->logger))
			$this->logger->info($text);
	}

	public function log_debug($text)
	{
		if (is_object($this->logger))
			$this->logger->debug($text);
	}

	public function log_error($text)
	{
		if (is_object($this->logger))
			$this->logger->error($text);
	}

	/**
	 * in case when pdo is not used globally or not set.
	 *
	 */
	protected function connect()
	{
		$this->pdo = new PDO(
			'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB,
			MYSQL_LN,
			MYSQL_PW,
			Array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES `UTF8`',
				PDO::ATTR_TIMEOUT => 5)
		);
	}

    /**
     * 記錄PDO錯誤訊息
     *
     * @return boolean
     */
    protected function logPDOError($tableName, $functionName, $fault)
    {
    	$err_log_str = date("Y-m-d H:i:s")." $functionName (PDOException) > ".print_r($fault ,true)."\n\n";
    	$err_log_dir = ERR_LOG_PATH . 'Table/' . $tableName . '/' . date("Y") . '/' . date("m") . '/';
        
        if (!is_dir($err_log_dir)) { mkdir( $err_log_dir, 0777, true ); }
        error_log($err_log_str, 3, $err_log_dir . date("Y-m-d-H-i") . "_error.log");

        return true;
    }

    /**
     * 記錄資料錯誤訊息
     *
     * @return boolean
     */
    protected function logResError($tableName, $functionName, $fault)
    {
        $err_log_str = date("Y-m-d H:i:s")." $functionName (res) > ".print_r($fault ,true)."\n\n";
        $err_log_dir = ERR_LOG_PATH . 'Table/' . $tableName . '/' . date("Y") . '/' . date("m") . '/';

        if (!is_dir($err_log_dir)) { mkdir( $err_log_dir, 0777, true ); }
        error_log($err_log_str, 3, $err_log_dir . date("Y-m-d-H-i") . "_error.log");
        
        return true;
    }
}
?>