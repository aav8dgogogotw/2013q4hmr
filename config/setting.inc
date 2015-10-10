<?php
	include_once 'config.inc';	

	include_once LIB_PATH.'Savant3-3.0.1/Savant3.php';
	
//	include_once LIB_PATH.'/mem_cache_session_handler.php';

	$tpl = new Savant3();
	$tpl->setErrorText('該頁面不存在');
	$tpl->setEscape('stripslashes', 'htmlspecialchars');

	//啟動session
	if(!isset($_SESSION))
		session_start();
	
	$tpl->SERVER_HOST = $SERVER_HOST;
	$tpl->SERVICE = $SERVICE;
	$tpl->SERVICE_NAME = $SERVICE_NAME;
	// $tpl->INDEX = $INDEX;
	// $tpl->ROOTURL = $ROOTURL;
	// $tpl->IMGURL = $IMGURL;
	// $tpl->FBURL = $FBURL;
	$tpl->redirectURL = $SERVER_HOST."?page=home";	
	$tpl->fansUrl = $fansUrl;

	//設定facebook
	$tpl->FbArr = $FBArr;
	$tpl->scope = $scope;
	$tpl->appId = APP_ID;
	$tpl->fansId = $fansId;

	//$Login = 0;
	/***********防止變數汙染設定開始************/
	require_once(LIB_PATH.'Tools.class.php');
	$tools_obj = new tools();
	$tpl->tools_obj = $tools_obj;
	//die(var_dump("11111"));
	//用來阻擋變數被污染
	//$tools_obj->chk_var_type($_GET,$_POST,$_COOKIE);	
	
	/***********以下開始程式設定***************/
	//預設頁	

	/******控制哪些頁面不需經過chklogin:開始********/
	//設定需要加入chklogin的判斷
	$login_arr = array('map');
	if(in_array($_GET['page'], $login_arr)){
		include_once(LIB_PATH.'facebook/chklogin.php');
	}
//	$tpl->Login = $Login;
	/******控制哪些頁面需經過chklogin:結束********/
?>