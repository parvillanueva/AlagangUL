<?php defined("BASEPATH") OR exit("No direct script access allowed");
		

		$route['404_override'] = 'welcome/_404';


		$route["default_controller"] = "homeindex";
		$route["login"] = "site/login";
		$route["signup"] = "site/sign_up";
		$route["login_otp"] = "site/login_otp";
		$route["user_profile/(:any)"] = "site/user/view/$1";
		$route["user_profile"] = "site/user/view";
		$route["home"] = "site/home";
		$route["forgot_password"] = "site/login/forgot_password";
		$route["login_otp_fpw"] = "site/login_otp/otp_fpw";
		$route["successfull_register"] = "site/user/successfull_register";
		$route["reset_password/(:any)"] = "site/login/reset_password/$1";
		$route["guidelines"] = "site/guidelines";
		$route["programs"] = "site/programs";
		
		$route["userlist"] = "site/user/listview";
		
		$route["registered_volunteered"] = "site/report/registered_volunteered";
		$route["volunteered_division"] = "site/report/volunteered_division";
		$route["volunteered_program"] = "site/report/volunteered_program";
		$route["volunteer_type"] = "site/report/volunteer_type";
		$route["registered"] = "site/report/registered";
		$route["volunteered"] = "site/report/volunteered";

		$route["events/upload"] = "site/events/upload";
		$route["events/get_gallery"] = "site/events/get_gallery";
		$route["events/volunteer"] = "site/events/volunteer";
		$route["events/signature"] = "site/events/signature";

		$route["events"] = "site/events";
		$route["get-rewards"] = "site/get_rewards";
		$route["profile"]  = "site/profile";
		$route["profile/reset"]  = "site/profile/reset";
		$route["change_pfw_message"]  = "site/login/fpw_message_success";

		$route["profile/(:any)"]  = "site/profile/view/$1";
		$route["update-profile"]  = "site/profile/update";
		$route["submit"]  = "site/user/submit";
		$route["terms-and-conditions"] = "site/terms_and_condition";
		$route["privacy-statement"] = "site/privacy_policy";
		$route["log-out"] = "site/logout";
		$route["already-xist"] = "site/logout/already_exist";
		$route["create-program"] = "site/create_program";
		$route["delete-user/(:any)"] = "site/logout/delete_user_email/$1";
		$route["programs/(:any)/(:any)"] = "site/programs/view/$1/$2";
		$route["programs/(:any)/(:any)/add_event"] = "site/events/add_event/$1/$2";
		$route["programs/(:any)/(:any)/update"] = "site/programs/update/$1/$2";
		$route["programs/add"] = "site/programs/add";
		$route["programs/(:any)/(:any)/publish"] = "site/programs/publish/$1/$2";
		$route["programs/(:any)/(:any)/unpublish"] = "site/programs/unpublish/$1/$2";
		$route["programs/(:any)/(:any)/event/(:any)/(:any)"] = "site/events/view/$1/$3/$4";
		$route["programs/(:any)/(:any)/event/(:any)/(:any)/update"] = "site/events/update/$1/$2/$3/$4";
		$route["programs/(:any)/(:any)/event/(:any)/(:any)/manage"] = "site/events/manage/$1/$3/$4";
		$route["programs/(:any)/(:any)/event/(:any)/(:any)/publish/(:any)"] = "site/events/publish/$1/$2/$3/$4/$5";

		$route["programs/(:any)/(:any)/event/(:any)/(:any)/gallery"] = "site/gallery/view/$1/$2/$3/$4";

		$route["job"] = "site/job";
		$route["job/test_email"] = "site/job/test_email";
		$route["job/download"] = "site/job/download";

		$route["manage"] = "site/manage";
		$route["cron"] = "site/cron";
		$route["manage/program_list"] = "site/manage/program_list";
		$route["manage/event_list"] = "site/manage/get_event_list";
		$route["manage/(:any)/(:any)"] = "site/manage/events/$1/$2";
		$route["volunteers/(:any)"] = "site/manage/volunteers/$1";


		$route["content_management"] = "content_management/home";
		$route["404_override"] = "";
		$route["translate_uri_dashes"] = FALSE;
