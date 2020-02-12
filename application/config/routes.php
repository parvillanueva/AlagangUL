<?php defined("BASEPATH") OR exit("No direct script access allowed");
		

		$route["default_controller"] = "homeindex";
		$route["login"] = "site/login";
		$route["signup"] = "site/sign_up";
		$route["login_otp"] = "site/login_otp";
		$route["user_profile/(:any)"] = "site/user/view/$1";
		$route["home"] = "site/home";
		$route["forgot_password"] = "site/login/forgot_password";
		$route["login_otp_fpw"] = "site/login_otp/otp_fpw";
		$route["reset_password/(:any)"] = "site/login/reset_password/$1";
		$route["about"] = "site/about";
		$route["programs"] = "site/programs";

		$route["events/upload"] = "site/events/upload";
		$route["events/get_gallery"] = "site/events/get_gallery";

		$route["events"] = "site/events";
		$route["get-rewards"] = "site/get_rewards";
		$route["profile"]  = "site/profile";
		$route["submit"]  = "site/user/submit";
		$route["terms-and-conditions"] = "site/terms_and_condition";
		$route["privacy-statement"] = "site/privacy_policy";
		$route["log-out"] = "site/logout";
		$route["already-xist"] = "site/logout/already_exist";
		$route["create-program"] = "site/create_program";

		$route["programs/(:any)/(:any)"] = "site/programs/view/$1/$2";
		$route["programs/(:any)/(:any)/update"] = "site/programs/update/$1/$2";
		$route["programs/(:any)/(:any)/event/(:any)/(:any)"] = "site/events/view/$1/$3/$4";




		$route["content_management"] = "content_management/home";
		$route["404_override"] = "";
		$route["translate_uri_dashes"] = FALSE;
