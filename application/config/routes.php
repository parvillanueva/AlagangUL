<?php defined("BASEPATH") OR exit("No direct script access allowed");
		

        $route["default_controller"] = "homeindex";
        $route["login"] = "site/login";
	$route["signup"] = "site/sign_up";
	$route["login_otp"] = "site/login_otp";
	$route["user_profile/(:any)"] = "site/user/view/$1";
        $route["home"] = "site/home";
        $route["about"] = "site/about";
        $route["programs"] = "site/programs";
        $route["events"] = "site/events";
        $route["get-rewards"] = "site/get_rewards";
        $route["profile"]  = "site/profile";
        $route["terms-and-conditions"] = "site/terms_and_condition";
        $route["privacy-statement"] = "site/privacy_policy";
        $route["log-out"] = "site/logout";


        $route["create-program"] = "site/create_program";
        $route["programs/(:any)/(:any)"] = "site/programs/view/$1/$2";

        $route["content_management"] = "content_management/home";
        $route["404_override"] = "";
        $route["translate_uri_dashes"] = FALSE;
