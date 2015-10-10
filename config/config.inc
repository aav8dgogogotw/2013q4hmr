<?php
	defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

	// Report simple running errors
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	//DB帳號設定
	switch(APPLICATION_ENV)
	{
		// case 'STA':
		/*
		case "development":
			// STA DB設定
			define("MYSQL_HOST", "192.168.0.252");
			define("MYSQL_DB", "2013q4hmr");
			define("MYSQL_LN", "2013q4hmrsta");
			define("MYSQL_PW", "Ra6fET1z0ebNbl2K");

			// STA 相關資料夾路徑
			define("DOC_ROOT", '/var/www/html/2013q4hmrsta.hiiir.com/trunk/public/');
			define("ACTION_PATH", DOC_ROOT.'action');
			define("CONFIG_PATH", '/var/www/html/2013q4hmrsta.hiiir.com/trunk/config/');
			define("LIB_PATH", '/var/www/html/2013q4hmrsta.hiiir.com/trunk/library/');
			define("ERR_LOG_PATH", '/var/www/html/2013q4hmrsta.hiiir.com/trunk/error_log/');

			// STA PNS推播設定
			// define('PNS_KEY', '8b3b0321b4506dffe3274a6121e73097');
			// define('PNS_MASTER', '651ae189eb7389dbc48dacbe3f65627d');
			
			// STA FB APP設定
			define('APP_ID', '241705639316957');
			define('APP_SECRECT', '720549d887c25664f0ae4e645c7ecea0');
			
			// STA CACHE 設定
			define('CACHE_IP', "192.168.0.252"); 	//Memcache IP
			define('CACHE_NAME', "2013q4hmr_");			//Cache名稱Staging
			
			$SERVICE = '簡單做 開心吃 快樂料理在我家';
			$SERVICE_NAME = '簡單做 開心吃 快樂料理在我家';//View Title Name
			$SERVER_HOST = 'http://2013q4hmrsta.hiiir.com/';
			break;
		//case 'TEST':

			//測試站 DB設定
		/*
			define('MASTER_HOST', '');
			define('MASTER_NAME', '');
			define('MASTER_USER', '');
			define('MASTER_PASS', '');
			define("DOC_ROOT", '');
			//測試站 PNS推播設定
			define('PNS_KEY', '');
			define('PNS_MASTER', '');
			//測試站 FB APP設定
			define('APP_ID', '');
			define('APP_SECRECT', '');
			//測試站 CACHE 設定
			define('CACHE_IP', ''); 	//Memcache IP
			define('CACHE_NAME', 'TEST_');	//Cache名稱測試站
			
			$SERVER_HOST = 'http://';
		*/
			//break;

		case 'development':
			//正式站 DB設定
		
			define("MYSQL_HOST", "localhost");
			define("MYSQL_DB", "2013q4hmr");
			define("MYSQL_LN", "root");
			define("MYSQL_PW", "");


			// STA 相關資料夾路徑
			define("DOC_ROOT", 'C:/wamp/www/2013q4hmr/public/');
			define("ACTION_PATH", DOC_ROOT.'action');
			define("CONFIG_PATH", 'C:/wamp/www/2013q4hmr/config/');
			define("LIB_PATH", 'C:/wamp/www/2013q4hmr/library/');
			define("ERR_LOG_PATH", 'C:/wamp/www/2013q4hmr/error_log/');

			// STA PNS推播設定
			// define('PNS_KEY', '8b3b0321b4506dffe3274a6121e73097');
			// define('PNS_MASTER', '651ae189eb7389dbc48dacbe3f65627d');
			
			// STA FB APP設定
			define('APP_ID', '768202943230773');
			define('APP_SECRECT', 'f9cf20b5318d0d25e2f10ef75e807731');
			
			// STA CACHE 設定
			define('CACHE_IP', "localhost"); 	//Memcache IP
			define('CACHE_NAME', "2013q4hmr_");			//Cache名稱Staging
			
			$SERVICE = '桂冠十分輕鬆料理';
			$SERVICE_NAME = '桂冠十分輕鬆料理';//View Title Name
			$SERVER_HOST = 'http://2013q4hmr/';
		
			break;
	}	
	
	// define('SMS_USER', '410800');
	// define('SMS_PASS', 'sym410800');
	
	$ROOTURL = $SERVER_HOST;
	$IMGURL  = $SERVER_HOST."images/";
	$INDEX   = "index.php";

	//呼叫facebook lib用
	$FBArr = array(
		'appId' => APP_ID,
		'secret' => APP_SECRECT,
		'cookie' => true,
   	);
		
	$scope = 'email,read_stream,publish_stream,user_photos,user_likes,offline_access';/*針對每個app須修改的scope*/

	//粉絲頁ID
	$fansId = "132732963433172";  // 桂冠輕鬆生活粉絲頁 Id
	$fansUrl = "https://www.facebook.com/laurel.hmr?fref=ts"; // 桂冠輕鬆生活粉絲頁 Id
?>