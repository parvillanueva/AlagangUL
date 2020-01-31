$(document).on('click', '#btn_install', function(){
	if(validate.required('.required') == 0){
		modal.confirm("Continue with installation?", function(result){
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
					  		modal.loading(true);
			            	setTimeout(function(){
			            		modal.loading(false);
			            		$('#AD_modal').modal('show');
			            	}, 800);
					  	}else{
					  		modal.alert("Cannot connect to the database!",function(){});
					  	} 
				  	},
				  	error: function(XMLHttpRequest, textStatus, errorThrown){
		        		alert("Status: " + textStatus); alert("Error: " + errorThrown); 
		    		} 
				});
    		}
    	});
	}
});

function install_cms(){
	var data = $('#setup_form').serialize();
	aJax.post_async(
		content_management + '/install/submit',
		data,
		function(data){
			if(data){
				setTimeout(function(){
					modal.loading(false);
					modal.alert("Setup Complete!",function(){
						location.href = (content_management + '/login');
					});
				}, 1000);
			}
		}
	);
}

$(document).on('click', '#btn_authenticate', function(){
	clear_ad_modal();

	var ad_email = $('#ad_email').val();
	var ad_password = $('#ad_password').val();
	var field_required = '<span class="ad_error_msg" style="color:red;">This field is required.</span>';
	var not_permitted = '<span class="ad_error_msg" style="color:red;">This email is not permitted.</span>';
	var login_failed = '<span class="ad_error_msg" style="color:red;">Authentication failed.</span>';
	var login_success = '<span class="ad_error_msg" style="color:green;">Authentication success.</span>';
	var counter = 0;

	if(ad_email.trim() == ''){
		$(field_required).insertAfter($('#ad_email').parent());
		$('#ad_email').css('border-color', 'red');
		counter++;
	}else if(check_permitted() == 0){
		$(not_permitted).insertAfter($('#ad_email').parent());
		$('#ad_email').css('border-color', 'red');
		counter++;
	}

	if(ad_password.trim() == ''){
		$(field_required).insertAfter($('#ad_password').parent());
		$('#ad_password').css('border-color', 'red');
		counter++;
	}

	if(counter == 0){
		modal.loading(true);
		setTimeout(function(){
			if(ad_authentication() == 'success'){
				$(login_success).insertAfter($('#ad_password').parent());
				install_cms();
    		}else{
    			modal.loading(false);
    			$(login_failed).insertAfter($('#ad_password').parent());
    		}
		}, 600);
	}
});

function clear_ad_modal(){
	$('.ad_input').css('border-color', '#ccc');
	$('.ad_error_msg').remove();
}

function ad_authentication(){
    var url = azure_pwgrant;
    var data = {
        email: $('#ad_email').val(), 
        password: $('#ad_password').val()
    }

    var result = '';

    aJax.post(url, data, function(data){
        var obj = is_json(data);
        result = obj.status;
    });

    return result;
}

$(document).on('focus, input', '#ad_password', function(){
    var password = $(this).val();

    if(password.length == 0 || password == ''){
        $(this).removeClass('masked-password');
    }else{
        $(this).addClass('masked-password');
    }
});

function check_permitted(){
	var permitted = 0;
	var data = { ad_email: $('#ad_email').val() }

	aJax.post(content_management + '/install/check_permitted', data, function(result){
		permitted = is_json(result);
	});

	return permitted;
}

$(document).on("keypress", "#ad_email, #ad_password", function(e){             
    if(e.keyCode == 13){
        $("#btn_authenticate").click();
    }
});