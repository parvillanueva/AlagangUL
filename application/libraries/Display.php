<?php

class Display {

	public function faqs()
	{
		$CI =& get_instance();
		$faqs = $CI->load->active_list("pckg_faqs", "faqs_status = 1", "id", "asc");

		echo "<div id='accordion' class='faqs-content'>";

		foreach ($faqs as $key => $value) {
			echo "    <h4 class='faqs-question'>".$value->faqs_question."</h4>";
			echo "    <div class='panel-body faqs-answer'>";
			echo "        <p>".$value->faqs_answer."</p>";
			echo "    </div>";
		}

		echo "</div>";

		echo "<script>";
  		echo "  $( function() {";
    	echo "      $( '#accordion' ).accordion({";
      	echo "          collapsible: true";
    	echo "      });";
		echo "	});";
  		echo "</script>";
	}

	public function privacy_policy()
	{
		$CI =& get_instance();
		$privacy_policy = $CI->load->active_list("pckg_privacy_policy", "id = 1");

		foreach ($privacy_policy as $key => $value) {
			echo "<div class='privacy-policy-content'>";
			echo "    <h2 class='privacy-policy-title'>".$value->privacy_policy_title."</h2>";
			echo "    <hr />";
			echo "    <div class='privacy-policy-text'>".$value->privacy_policy_statement."</div>";
			echo "</div>";
		}
	}

	public function contact_us()
	{
		echo '<div id="contact_us_form_div" class="contact_us_form_div">';
		echo '<form class="contact_us_form" id="contact_us_form" action="" method="POST">';
		$CI =& get_instance();
	    $inputs = [
	        'contact_first_name',
	        'contact_middle_name',
	        'contact_last_name', 
	        'contact_mobile_number', 
	        'contact_email_address', 
	        'contact_inquiry' ,
	        'contact_captcha'
	    ];
	    $CI->standard->inputs($inputs);
		
		echo "</form>";
		echo "<button class='contact_us_submit' id='contact_us_submit'>Submit</button>";
		echo "</div>";

		echo "<div id='modal_loading' class='modal' role='dialog'>";
	  	echo "    <div class='modal-dialog'>";
	    echo '		  <img class="loader" src="'.base_url() . 'assets/img/loader.gif' .'" style="height: 100px; width: 100px; margin: auto; left: 0; right: 0; display: table-cell; vertical-align: middle;" />';
		echo "	  </div>";
		echo "</div>";

		echo "<div id='thank_you_message' class='col-md-6 col-md-offset-3' style='margin-top: 5%; display: none;'>";
		echo "    <div class='panel panel-primary'>";
		echo "        <div class='panel-heading'>";
		echo "            <h4><b>Thank you for contacting us</b></h4>";
		echo "		  </div>";
		echo "		  <div class='panel-body'>";
		echo "			  We have received your request and will get back to you as soon as possible.";
		echo "		  </div>";
		echo "    </div>";
		echo "</div>";

		echo "<script>";
		echo "	$('#contact_us_submit').on('click', function(e){";
		echo "		e.preventDefault();";
		echo "		if(validate.standard()){";
		echo "			var modal_obj = '". $CI->standard->confirm_return("confirm_submit") . "'; ";
		echo "			modal.confirm('Are you sure you want to save this record?',function(result){";
		echo "				if(result){";
		echo "					$('#modal_loading').modal('show');";
		echo "					var url ='" . base_url('global_controller/contact_us') . "'; ";
		echo "					var data = { data : { ";
		echo "						contact_us_create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),";
		echo "						contact_us_update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),";
		echo "						contact_us_first_name : $('#first_name').val(),";
		echo "						contact_us_middle_name : $('#middle_name').val(),";
		echo "						contact_us_last_name : $('#last_name').val(),";
		echo "						contact_us_mobile_number : $('#mobile_number').val(),";
		echo "						contact_us_email_address : $('#email_address').val(),";
		echo "						contact_us_inquiry : $('#inquiry').val()";
		echo "					}};";
		echo "					aJax.post(url,data,function(result){";
		echo "						var full_name = $('#first_name').val() +' '+ $('#last_name').val(); ";
		echo "						var email_notif_url = '" . base_url('content_management/global_controller/send_contact_us_email_notif') . "'; ";
		echo "						var email_notif_url_data = { ";
		echo "							contact_us_full_name : full_name,";
		echo "							contact_us_first_name : $('#first_name').val(),";
		echo "							contact_us_middle_name : $('#middle_name').val(),";
		echo "							contact_us_last_name : $('#last_name').val(),";
		echo "							contact_us_mobile_number : $('#mobile_number').val(),";
		echo "							contact_us_email_address : $('#email_address').val(),";
		echo "						};";
        echo "						aJax.post(email_notif_url,email_notif_url_data,function(result){";
        echo "							if(result){";
        echo "								$('#modal_loading').modal('hide');";
		echo '  							$("#contact_us_form_div").html("");';
		echo '								document.getElementById("thank_you_message").style.display = "block";';
        echo "						    }";
        echo "						});";
		echo "					});";
		echo "				}";
		echo "			});";
		echo "		}";
		echo "	});";
		echo "</script>";
	}

	public function sign_up()
	{
		echo '<div id="signup_form_div">';
		echo '<form class="sign_up_form" id="sign_up_form" action="" method="POST">';
		$CI =& get_instance();
	    $inputs = [
	        'sign_up_first_name',
	        'sign_up_middle_name',
	        'sign_up_last_name', 
	        'sign_up_civil_status', 
	        'sign_up_gender', 
	        'sign_up_birthday', 
	        'sign_up_mobile_number',  
	        'sign_up_email_address', 
	        'sign_up_country',
	        'sign_up_region',
	        'sign_up_province',
	        'sign_up_city',
	        'sign_up_captcha'
	    ];
	    $CI->standard->inputs($inputs);
		
		echo "</form>";
		echo "<button class='sign_up_submit' id='sign_up_submit'>Submit</button>";
		echo "</div>";

		echo "<div id='modal_loading' class='modal' role='dialog'>";
	  	echo "    <div class='modal-dialog'>";
	    echo '		  <img class="loader" src="'.base_url() . 'assets/img/loader.gif' .'" style="height: 100px; width: 100px; margin: auto; left: 0; right: 0; display: table-cell; vertical-align: middle;" />';
		echo "	  </div>";
		echo "</div>";

		echo "<div id='thank_you_message' class='col-md-6 col-md-offset-3' style='margin-top: 5%; display: none;'>";
		echo "    <div class='panel panel-primary'>";
		echo "        <div class='panel-heading'>";
		echo "            <h4><b>Congratulations!</b></h4>";
		echo "		  </div>";
		echo "		  <div class='panel-body'>";
		echo "			  Thank you for signing up to our website. Please check your email to activate your account.";
		echo "		  </div>";
		echo "    </div>";
		echo "</div>";

		echo "<script>";
		
		echo "  $(document).ready(function(){";
       	echo '		$("#birthday").on("keydown",function(e) {';
        echo "			e.preventDefault();";
       	echo "		});";
       	echo "	});";

		echo "  $('#country').change(function(){";
        echo "      var selected_country = $('#country').val();";
        echo "      var query = ". '"' . "country_id ='" . '"' ."+selected_country+".'"'.  "'" . '";';
        echo '		var url = "'.base_url('content_management/global_controller').'";';
        echo "		var data = {";
        echo "		    event : 'list',";
        echo "		    select : '*',";
        echo "		    query : query,";
        echo "		    table : 'pckg_region'";
        echo "		};";
        echo "		aJax.post(url,data,function(result){";
        echo "    		var obj = isJson(result);";
        echo "			var htm = '';";
        echo "				htm += '<option value=" . '""' . " selected disabled>Select..</option>';";
        echo "			$.each(obj, function(x,y){";
        echo "				var test = y.region_name;";
        echo '				htm += "<option data-id="+y.region_id+">"+y.region_name+"</option>";';
        echo "			});";
        echo "			$('#region').html(htm);";
        echo "		});";
    	echo "	});";

	    echo "  $('#region').change(function(){";
        echo "		var selected_region = $('#region option:selected').attr('data-id');";
        echo "		var query = ". '"' . "region_id ='" . '"' ."+selected_region+".'"'.  "'" . '";';
        echo '		var url = "'.base_url('content_management/global_controller').'";';
        echo "		var data = {";
		echo "      	event : 'list',";
	    echo "          select : '*',";
	    echo "			query : query,";
	    echo "			table : 'pckg_province'";
	    echo "	    };";
	    echo "    	aJax.post(url,data,function(result){";
	    echo "        	var obj = isJson(result);";
        echo "			var htm = '';";
        echo "				htm += '<option value=" . '""' . " selected disabled>Select..</option>';";
	    echo "        	$.each(obj, function(x,y){";
        echo '				htm += "<option data-id="+y.province_id+">"+y.province_name+"</option>";';
        echo "			});";
        echo "			$('#province').html(htm);";
        echo "		});";
	    echo "	});";

	    echo "	$('#province').change(function(){";
        echo "		var selected_province = $('#province option:selected').attr('data-id');";
        echo "		var query = ". '"' . "province_id ='" . '"' ."+selected_province+".'"'.  "'" . '";';
        echo '		var url = "'.base_url('content_management/global_controller').'";';
        echo "		var data = {";
        echo "			event : 'list',";
        echo "			select : '*',";
        echo "			query : query,";
        echo "			table : 'pckg_city'";
	    echo "	    };";
        echo "		aJax.post(url,data,function(result){";
        echo "			var obj = isJson(result);";
        echo "			var htm = '';";
        echo "				htm += '<option value=" . '""' . " selected disabled>Select..</option>';";
        echo "			$.each(obj, function(x,y){";
        echo '				htm += "<option data-id="+y.id+">"+y.city_name+"</option>"';
        echo "			});";
        echo "			$('#city').html(htm);";
        echo "		});";
	    echo "	});";

		echo "	$('#sign_up_submit').on('click', function(e){";
		echo "		e.preventDefault();";
		echo "		if(validate.standard()){";
		echo "			var modal_obj = '". $CI->standard->confirm_return("confirm_submit") . "'; ";
		echo "			modal.standard(modal_obj,function(result){";
		echo "				if(result){";
		echo "					$('#modal_loading').modal('show');";
		echo "					var url ='" . base_url('content_management/global_controller') . "'; ";
		echo "					var sign_up_token = sha1(moment(new Date()).format('YYYY-MM-DD HH:mm:ss L')); ";
		echo "					var data = { ";
		echo "						event : 'insert',";
		echo "						table : 'pckg_sign_up',";
		echo "						data : { ";
		echo "							sign_up_create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),";
		echo "							sign_up_update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),";
		echo "							sign_up_token : sign_up_token,";
		echo "							sign_up_first_name : $('#first_name').val(),";
		echo "							sign_up_middle_name : $('#middle_name').val(),";
		echo "							sign_up_last_name : $('#last_name').val(),";
		echo "							sign_up_civil_status : $('#civil_status').val(),";
		echo "							sign_up_gender : $('#gender').val(),";
		echo "							sign_up_birthday : moment($('#birthday').val()).format('YYYY-MM-DD'),";
		echo "							sign_up_mobile_number : $('#mobile_number').val(),";
		echo "							sign_up_email_address : $('#email_address').val(),";
		echo "							sign_up_country : $('#country').val(),";
		echo "							sign_up_region : $('#region').val(),";
		echo "							sign_up_province : $('#province').val(),";
		echo "							sign_up_city : $('#city').val()";
		echo "						}";
		echo "					};";
		echo "					aJax.post(url,data,function(result){";
		echo "						var full_name = $('#first_name').val() +' '+ $('#last_name').val(); ";
		echo "						var email_notif_url = '" . base_url('content_management/global_controller/send_sign_up_email_notif') . "'; ";
		echo "						var email_notif_url_data = { ";
		echo "							sign_up_token : sign_up_token,";
		echo "							sign_up_full_name : full_name,";
		echo "							sign_up_first_name : $('#first_name').val(),";
		echo "							sign_up_middle_name : $('#middle_name').val(),";
		echo "							sign_up_last_name : $('#last_name').val(),";
		echo "							sign_up_civil_status : $('#civil_status').val(),";
		echo "							sign_up_gender : $('#gender').val(),";
		echo "							sign_up_birthday : moment($('#birthday').val()).format('YYYY-MM-DD'),";
		echo "							sign_up_mobile_number : $('#mobile_number').val(),";
		echo "							sign_up_email_address : $('#email_address').val(),";
		echo "							sign_up_country : $('#country').val(),";
		echo "							sign_up_region : $('#region').val(),";
		echo "							sign_up_province : $('#province').val(),";
		echo "							sign_up_city : $('#city').val()";
		echo "						};";
        echo "						aJax.post(email_notif_url,email_notif_url_data,function(result){";
        echo "							if(result){";
        echo "								$('#modal_loading').modal('hide');";
		echo '  							$("#signup_form_div").html("");';
		echo '								document.getElementById("thank_you_message").style.display = "block";';
        echo "						    }";
        echo "						});";
		echo "					});";
		echo "				}";
		echo "			});";
		echo "		}";
		echo "	});";
		echo "</script>";
	}

	public function terms_of_use()
	{
		$CI =& get_instance();
		$terms_of_use = $CI->load->active_list("pckg_terms_of_use", "id = 1");

		foreach ($terms_of_use as $key => $value) {
			echo "<div class='terms-of-use-content'>";
			echo "    <h2 class='terms-of-use-title'>".$value->terms_of_use_title."</h2>";
			echo "    <hr />";
			echo "    <div class='terms-of-use-text'>".$value->terms_of_use_statement."</div>";
			echo "</div>";
		}
	}

	public function crs()
	{
		$CI =& get_instance();

        $crs = $CI->Global_model->get_list_all("pckg_crs_config");

        foreach ($crs as $key => $value) {
        	echo '<iframe id="signup-iframe" src="'.$value->host.'" scrolling="no" style="overflow: hidden; height: 900px;" width="100%" frameborder="0"></iframe>';
        }
	}
}
?>