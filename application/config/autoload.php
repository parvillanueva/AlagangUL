<?php defined("BASEPATH") OR exit("No direct script access allowed");
		$autoload["packages"] = array();
		$autoload["libraries"] = array("database", "sndgrd", "form_validation", "session","standard","minify","user_agent","display","social","send","form_table", "parser", "audit_trail_lib");
		$autoload["drivers"] = array();
		$autoload["helper"] = array("url","html","file","captcha","cookie");
		$autoload["config"] = array();
		$autoload["language"] = array();
		$autoload["model"] = array("content_management/Global_model","content_management/Custom_model","Site_model","Gmodel");