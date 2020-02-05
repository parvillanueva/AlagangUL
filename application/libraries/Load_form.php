<?php

class Load_form {

	public function contact_us()
	{
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

		echo "<script>";
		echo "	$('#contact_us_submit').on('click', function(e){";
		echo "		e.preventDefault();";
		echo "		if(validate.standard()){";
		echo "			var modal_obj = '". $CI->standard->confirm_return("confirm_submit") . "'; ";
		echo "			modal.confirm('Are you sure you want to save this record?',function(result){";
		echo "				if(result){";
		echo "					var url ='" . base_url('global_controller/contact_us') . "'; ";
		echo "					var data = { data : { ";
		echo "						contact_us_create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),";
		echo "						contact_us_update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),";
		echo "						contact_us_first_name : $('#first_name').val(),";
		echo "						contact_us_middle_name : $('#middle_name').val(),";
		echo "						contact_us_last_name : $('#last_name').val(),";
		echo "						contact_us_mobile_number : $('#mobile_number').val(),";
		echo "						comtact_us_email_address : $('#email_address').val(),";
		echo "						contact_us_inquiry : $('#inquiry').val()";
		echo "					}};";
		echo "					aJax.post(url,data,function(result){";
		echo "						modal.alert('" . $CI->standard->dialog_return("sent_success") . "', function(){";
		echo "							location.reload();";
		echo "						});";
		echo "					});";
		echo "				}";
		echo "			});";
		echo "		}";
		echo "	});";
		echo "</script>";
	}

	public function faqs()
	{
		$CI =& get_instance();
		$faqs = $CI->load->active_list("pckg_faqs", "faqs_status = 1", "id", "asc");

		echo "<divid='accordion' class='faqs-content'>";

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
}
?>