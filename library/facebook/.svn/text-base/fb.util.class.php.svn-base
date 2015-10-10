<?php
include_once (MOD_LIB_DIR . 'facebook/facebook.php');

class FbUtil
{
	private $facebook;
	private $fbId;
	private $accessToken;
	
	public function setFacebook($fbArray)
	{
		if (!is_object($this->facebook))
			$this->facebook = new facebook($fbArray);
		
		$this->fbId = $this->facebook->getUser();
		$this->accessToken = $_SESSION["access_token"];
	}
	
	// 使用者Facebook ID
	public function getFbId()
	{
		return $this->fbId;
	}
	
	public function fbLogin()
	{
		//代表第一次登入,且不是同一個人
		if($this->fbId != '')
		{	
		    $param['method'] = 'fql.query';
		    $param['query'] = 'Select uid,sex,email,name,pic_square from user where uid = me()';
		    $myinfo = $this->facebook->api($param);
		    
		    //$me = $facebook->api('/me');//抓取用戶資訊
		    $_SESSION["fb_id"] = $this->fbId;
		    $_SESSION["fb_name"] = $myinfo[0]['name'];
		    $_SESSION["fb_email"] = $myinfo[0]['email'];
		    $_SESSION['user_img'] = $myinfo[0]['pic_square'];
		    $_SESSION['access_token'] = $this->facebook->getAccessToken();
		    $this->accessToken = $_SESSION['access_token'];
		    
		    return true;
		}
		else
		    return false;
	}
	//
	//public function checkLogin()
	//{
	//	if($_POST['fb_session']){
	//		$sessionJson =  str_replace("\\", "", $_POST['fb_session']);
	//		$fbSessionArr = json_decode($sessionJson);
	//		try
	//		{
	//			foreach($fbSessionArr as $key => $val)
	//			{
	//				$sessionRow = $sessionRow.'&'.$key.'='.htmlspecialchars($val);
	//			}
	//			//將FB的COOKIE 寫進去 Safari用
	//			setcookie("fbs_".$fbArr['appId'], $sessionRow, time()+315360000,'/',$_SERVER['HTTP_HOST']);
	//			//Safari 判斷用戶非重複登入
	//			setcookie("uid", $fbSessionArr->uid, time()+315360000,'/',$_SERVER['HTTP_HOST']);
	//		}
	//		catch (Exception $e){
	//			//錯誤的session登入	
	//		}
	//	}
	//	
	//	$fbUid = $this->facebook->getUser();//抓取uid值
	//	if(!$fbUid)
	//		return false;
	//	else
	//		return true;
	//}

	//上傳照片
	public function addPhoto($content, $img)
	{
		$this->facebook->setAccessToken($this->accessToken);
		$this->facebook->setFileUploadSupport(true);

		$photos_detail = array( 'message'=>$content, 'image'=>'@'.$img );
		
		$photo = $this->facebook->api('/'.$this->fbId.'/photos', 'POST', $photos_detail);

		if(empty($photo))
			return false;
		else
			return $photo;
	}
}

?>