<?php

/**
 * API用的工具箱
 *
 * @package Hiiir\Library
 * @author 
 * @version 1.0
 */
class Api
{
	private $response = 'JSON';
	private $output = array('message'=>'OK', 'detail'=>'initialize');
	private $flag = true;
	
    // private $ErrMsgAry = include_once (LIB_PATH . 'ErrorMessage.inc.php');

	public function __construct($response='') {
		if($response)
			$this->response = $response;
	}
	
	public function __destruct() {
		unset($this->response, $this->output);
	}
	
	public function setError($msg) {
		$this->output['message'] = 'ERR';
		$this->output['detail'] = $msg;
	}
    
    public function getMessage() {
        return $this->output['message'];
    }
	
	public function setOutput($msg, $data=array()) {
		$this->output['detail'] = $msg;
        if(!empty($data)) {
            foreach($data as $key=>$val){
                $this->output[$key] = $val;
            }
        }		
	}
	
	public function apiResponse() {
		if(!$this->flag)
			return;
        switch($this->response) {
            case "ARRAY":
                print_r($this->output);
                break;
            case "JSON":
                echo json_encode($this->output);
                break;
            case "BASE64":
                echo base64_encode($this->output);
                break;
        }
	}

	public function setResponse($flag){
		$this->flag = $flag;
	}





    /**
     * Error Log
     *
     * @param String $resource
     * @param Array $log_param
     * @return Boolean
     * @access public
     */
    public function setApiErrorLog($resource, $log_param)
    {
        $err_log_str = date("Y-m-d H:i:s")." $resource > ".print_r($log_param, true)."\n\n";
        $err_log_dir = ERR_LOG_PATH . "Api/$resource/" . date("Y") . '/' . date("m") . '/';
        if (!is_dir($err_log_dir)) { mkdir( $err_log_dir, 0777, true ); }
        error_log($err_log_str, 3, $err_log_dir . date("Y-m-d-H-i") . "_error.log");

        return true;
    }
}
?>
