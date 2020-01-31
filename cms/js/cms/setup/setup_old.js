$("#password").on("change keydown paste input", function(event) { 
		var password_input = $(this).val();
		var min_ten_Regex = new RegExp("^(?=.{10,})");
		var special_char_Regex =  new RegExp('\\W|_');
		var upper_char_Regex = new RegExp("^(?=.*?[A-Z])");
		var number_Regex = new RegExp("^(?=.*[0-9])");

		if(min_ten_Regex.test(password_input)){
			$('.min_ten_chck').addClass('password_checker');
			$('.min_ten_chckbx').prop('checked', true);
		}else{
			$('.min_ten_chckbx').prop('checked', false);
			$('.min_ten_chck').removeClass('password_checker');
		}

		if (special_char_Regex.test(password_input)){
			$('.special_chck').addClass('password_checker');
			$('.special_chckbx').prop('checked', true);
		}else{
			$('.special_chckbx').prop('checked', false);
			$('.special_chck').removeClass('password_checker');
		}

		if(upper_char_Regex.test(password_input)){
			$('.upper_chck').addClass('password_checker');
			$('.upper_chckbx').prop('checked', true);
		}else{
			$('.upper_chckbx').prop('checked', false);
			$('.upper_chck').removeClass('password_checker');
		}

		if (number_Regex.test(password_input)){
			$('.number_chck').addClass('password_checker');
			$('.number_chckbx').prop('checked', true);
		}else{
			$('.number_chckbx').prop('checked', false);
			$('.number_chck').removeClass('password_checker');
		}
   
});


$(document).on('click', '#btn_install', function(){
	modal.confirm("continue with installation?", function(result){
		if(result){ 
			var url = global_controller + '/check_database'; 
            var data = {
                hostname : $("#db_host").val(),
                username : $("#db_user").val(),
                password : $("#db_pass").val(),
                database : $("#db_default").val(),
            }

            $.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  cache: false,
			  success: function(result){
			  	if(result.trim() == 'success'){
                	if(validate.required('.required') == 0){
	    				var email = $('.admin_email').val();
	    				var password = $('#password').val().trim();
	    				var confirm_password = $('.confirm_password').val().trim();
	    				var counter = 0;
	    				var password_miss_match_message = "<span class='validate_error_message' style='color: red;'>Password is not matched with Confirm password.<br></span>";
	    					$('.password_checkbox').each(function(){
								var id = $(this).attr("id");
								if(!$(this).is(':checked')) {
									counter++;
									$("."+id+"").css('color','red');
								}else{
									$("."+id+"").css('color','#333');
								}
							});
	    					if(password != confirm_password){
								$('.password_error').html(password_miss_match_message);
								$('#password').css('border-color','red');
								$('.confirm_password').css('border-color','red');
								counter++;
							}
	    					modal.loading(false);
		    				if(counter == 0){
		    					modal.loading(true);
			    				if(validate.email_address(email)){
			    					modal.loading(true);
			    					var data = $('#setup_form').serialize();
			    					aJax.post_async(
			    						content_management + '/install/submit',
			    						data,
			    						function(data){
			    							if(data){
			    								modal.loading(true);
			    								setTimeout(function(){
					    							modal.alert("Setup Complete!",function(){
					    								location.href = (content_management + '/login');
					    							});
				    							}, 2000);
			    							}
			    						}
			    					);
			    				} else {
			    				  modal.loading(false);
						          $('.admin_email').css('border-color','red');
						        }
		    				}
	    			}
	    			modal.loading(false);
			  	}else{
			  		modal.loading(false);
			  		modal.alert("Cannot connect to the database!",function(){});
			  	} 
			  }
			});
		}
	});
});