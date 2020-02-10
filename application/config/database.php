<?php defined("BASEPATH") OR exit("No direct script access allowed");
		$whitelist = array(
		    "127.0.0.1",
		    "172.29.70.126",
		    "::1"
		);

		if(in_array($_SERVER["REMOTE_ADDR"], $whitelist)){
		    $db_host = "172.29.70.125";
			$db_username = "phpdevsite";
			$db_password = "unilab123";
			$db_database = "teamapp_db";
		}else{
			$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
			if (strpos($url,"webqa.unilab.com.ph") !== false) {
				/* WEBQA Credentials */
			    $db_host = preg_replace("(^https?://)", "", base_url() );
				$db_username = "";
				$db_password = "";
				$db_database = "";
			} else {
				/* PRODUCTION Credentials */
			    $db_host = preg_replace("(^https?://)", "", base_url() );
				$db_username = "";
				$db_password = "";
				$db_database = "";
			}
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