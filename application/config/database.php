<?php defined("BASEPATH") OR exit("No direct script access allowed");


	
$active_group = 'default';
$query_builder = TRUE;
$root = $_SERVER['HTTP_HOST'];
switch ($root) {
	case 'alagangunilab.webqa.unilab.com.ph':
		$db_host = 'app-wpsi-2-cbg-server-02.cklr8bwd3nrd.ap-southeast-1.rds.amazonaws.com:3306';
		$db_username =  'alaga_user';
		$db_password = '@Rn06ro8';
		$db_database = 'alagangunilab_db';
		break;
	case 'alagangunilab.unilab.com.ph':
		$db_host = 'cbg.ckzpvfwtpnna.ap-southeast-1.rds.amazonaws.com:3306';
		$db_username =  'alaga_user';
		$db_password = '65q5*Wpy';
		$db_database = 'alagangunilab_db';
		break;
	case '52.77.135.207':
		$db_host = 'app-wpsi-2-cbg-server-02.cklr8bwd3nrd.ap-southeast-1.rds.amazonaws.com:3306';
		$db_username =  'alaga_user2';
		$db_password = '*Cnj28o6';
		$db_database = 'alagangunilab2_db';
		break;
	
	default:
		$db_host = "172.29.70.125";
		$db_username = "phpdevsite";
		$db_password = "unilab123";
		$db_database = "teamapp_db";
		break;
}
		

		$active_group = "default";
		$query_builder = TRUE;
		$db["default"] = array(
			"dsn"	=> "",
			"hostname" => $db_host,
			"username" => $db_username,
			"password" => $db_password,
			"database" => $db_database,
			"dbdriver" => "mysqli",
			"dbprefix" => "",
			"pconnect" => FALSE,
			"db_debug" => (ENVIRONMENT !== "production"),
			"cache_on" => FALSE,
			"cachedir" => "",
			"char_set" => "utf8",
			"dbcollat" => "utf8_general_ci",
			"swap_pre" => "",
			"encrypt" => FALSE,
			"compress" => FALSE,
			"stricton" => FALSE,
			"failover" => array(),
			"save_queries" => TRUE
		);



		