//convert seo url

//youtube id parser 
function youtube_parser(url){
    var reg_exp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(reg_exp);
    return (match&&match[7].length==11)? match[7] : false;
}

//return if json
function is_json(str) {
    try {
	    if (/MSIE 9/i.test(navigator.userAgent)) {
	        return JSON.parse($.trim(str));
	    }else{
	        var jparse = JSON.parse($.trim(str));
	        if(Object.values(jparse)[0] == 'Asterisk is not allowed!'){
	        	alert(Object.values(jparse)[0]);
	        }else{
	        	return jparse;
	        }
	    }
    } catch (e) {
        return $.trim(str)
    }
} 

function check_field_status(pckg_name){
	var url = "content_management/global_controller";
	var data = {
		event: "list",
        table : "pckg_tables",
        select : "fields,display",
        query :"package = '"+pckg_name+"'",
	}

   	aJax.post_async(url,data,function(result){
   		var obj = is_json(result);
   		$.each(obj, function(x, y){
			if(y.display == 0){
				$('body .'+y.fields).hide();
			}
		})

		console.log(123);
	});
}

//return if json
function is_text(str) {
    try {
        return JSON.parse($.trim(str));
    } catch (e) {
        return $.trim(str)
    }
} 

//strip_html tags

function strip_tags(str){
	return str.replace(/<\/?[^>]+(>|$)/g, "");
}

//element action
var element = {
	click : function(element, cb){
		$(document).on('click', element, cb);
	},
	change : function(element, cb){
		$(document).on('change', element, cb);
	},
	html : function(element, value){
		$(element).html(value);
	},
	append : function(element, value){
		$(element).append(value);
	},
	show : function(element){
		$(element).show();
	},
	hide : function(element){
		$(element).hide();
	},
	remove : function(element){
		$(element).remove();
	}
}

//jquery helper
var jquery = {
	event : function(event,element,cb) {
		$(document).on(event, element, cb);
	}
}

//ajax
var aJax = {
  	post : function(url,data,cb){
	    $.ajax({
	      async: false,
	      cache: false,
	      type: 'POST',
	      url:url,
	      data:data,
	      success: cb
	    });
	},
	get : function(url,cb){
    	$.ajax({
      		type: 'GET',
      		url:url,
      		success: cb
    	});
  	},
  	post_async : function(url,data,cb){
	    $.ajax({
	      async: true,
	      cache: false,
	      type: 'POST',
	      url:url,
	      data:data,
	      success: cb
	    });
	}
}

//validation
var validate = {
	email_address : function(email){
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(email);
	},
	required: function(element){
		var counter = 0;
		$(".validate_error_message").remove();
		var error_message = "<span class='validate_error_message' style='color: red;'>"+form_empty_error+"<br></span>"
	    $(element).each(function(){
	    	if($(this).val() != null){
	    		var input = $(this).val().trim();
	          	if (input.length == 0) {
	          		$(this).css('border-color','red');
	          		$(error_message).insertAfter(this);
	            	counter++;
	          	}else{
	            	$(this).css('border-color','#ccc');
	              	$(this).next(".validate_error_message").remove();       	
	          	}
	    	} else {
	    		$(this).css('border-color','red');
	    		$(error_message).insertAfter(this);
	    	}
	          
				});

				//alpha only
				$(".alphaonly").each(function(){
					var str = $(this).val();
					if(/^[a-zA-Z -]*$/.test(str) == false) {
							counter++;
							$(this).css('border-color','red');
	          	$("<span class='validate_error_message' style='color: red;'>This field only required only Letters.<br></span>").insertAfter(this);
					}
				});

				//validate script tags
				$(".form-control").each(function(){
					if($(this).val().trim().indexOf("<script") != -1){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
					}

					if($(this).val().trim().indexOf("< script") != -1){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
					}


					if($(this).val().trim().indexOf("<?php") != -1){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
					}

					if($(this).val().trim().indexOf("<?=") != -1){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
					}
				});

				//test mobile number
				$(".mobile_number").each(function(){
					var number = $(this).val();
					if(/^09\d{9}$/.test(number) === false){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_invalid_mobile_no+"<br></span>").insertAfter(this);
					
					}
				});


				///email validator
				$(".email").each(function(){
					var email = $(this).val();
					var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
					if(!pattern.test(email)){
						counter++;
						$(this).css('border-color','red');
	          $("<span class='validate_error_message' style='color: red;'>"+form_invalid_email+"<br></span>").insertAfter(this);
					
					}
				});
	    return counter;
	},
	all: function(){
		var element = ".required_input";
		var counter = 0;
		$(".validate_error_message").remove();
		var error_message = "<span class='validate_error_message' style='color: red;'>"+form_empty_error+"<br></span>"
	    $(element).each(function(){
	    	if($(this).val() != null){
	    		var input = $(this).val().trim();
	          	if (input.length == 0) {
	          		$(this).css('border-color','red');
	          		$(error_message).insertAfter(this);
	            	counter++;
	          	}else{
	            	$(this).css('border-color','#ccc');
	              $(this).next(".validate_error_message").remove();       	
	          	}
	    	} else {
	    		$(this).css('border-color','red');
	    		$(error_message).insertAfter(this);
	    	}
	          
				});

				//alpha only
				$(".alphaonly").each(function(){
					var str = $(this).val();
					if(/^[a-zA-Z -]*$/.test(str) == false) {
							counter++;
							$(this).css('border-color','red');
	          	$("<span class='validate_error_message' style='color: red;'>This field only required only Letters.<br></span>").insertAfter(this);
					}
				});

				//validate script tags
				$(".form-control").each(function(){
					if($(this).val().trim().indexOf("<script") != -1){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
					}

					if($(this).val().trim().indexOf("< script") != -1){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
					}


					if($(this).val().trim().indexOf("<?php") != -1){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
					}

					if($(this).val().trim().indexOf("<?=") != -1
						){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
					}
				});

				//test mobile number
				$(".mobile_number").each(function(){
					var number = $(this).val();
					if(/^09\d{9}$/.test(number) === false){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_invalid_mobile_no+"<br></span>").insertAfter(this);
					
					}
				});


				///email validator
				$(".email").each(function(){
					var email = $(this).val();
					var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
					if(!pattern.test(email)){
						counter++;
						$(this).css('border-color','red');
	          $("<span class='validate_error_message' style='color: red;'>"+form_invalid_email+"<br></span>").insertAfter(this);
					
					}
				});
		if(counter == 0){
			return true;
		} else {
			return false;
		}
	},
	standard: function(element_id){
		
		var element = '#'+element_id+' .required_input';
		var counter = 0;
		$(this).css('border-color','#ccc');
		$(".validate_error_message").remove();
		var error_message = "<span class='validate_error_message' style='color: red;'>"+form_empty_error+"<br></span>"
	    $(element).each(function(){
	    	var type = $(this).attr("type");
			if(type != "ckeditor"){
		    	if($(this).val() != null){
		    		var input = $(this).val().trim();
		          	if (input.length == 0) {
		          		$(this).css('border-color','red');
		          		$(error_message).insertAfter(this);
		            	counter++;
		          	}else{
		            	$(this).css('border-color','#ccc');
		              	$(this).next(".validate_error_message").remove();       	
		          	}
		    	} else {
		    		$(this).css('border-color','red');
		    		$(error_message).insertAfter(this);
		    	}
		    }
		});

		//alpha only
		$(element).each(function(){
			$(this).css('border-color','#ccc');
		    if ($(this).hasClass("alphaonly")) {
				$(".alphaonly").each(function(){
					var str = $(this).val();
					if(/^[a-zA-Z -]*$/.test(str) == false) {
						counter++;
						$(this).css('border-color','red');
		  				$("<span class='validate_error_message' style='color: red;'>This field only required only Letters.<br></span>").insertAfter(this);
					}
				});
		    }
		});
		//validate script tags

		$(element).each(function(){
			if($(this).val()){
				if($(this).val().trim().indexOf("<script") != -1){
					counter++;
					$(this).css('border-color','red');
					$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
				}

				if($(this).val().trim().indexOf("< script") != -1){
					counter++;
					$(this).css('border-color','red');
					$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
				}


				if($(this).val().trim().indexOf("<?php") != -1){
					counter++;
					$(this).css('border-color','red');
					$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
				}

				if($(this).val().trim().indexOf("<?=") != -1){
					counter++;
					$(this).css('border-color','red');
					$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
				}
			}
		});

		//strip tags
		if ($(element).hasClass("no_html")){
			$(".no_html").each(function(){
				var type = $(this).attr("type");
				if(type != "ckeditor"){
					if(/<\/?[^>]*>/.test($(this).val().trim())){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_nohtml+"<br></span>").insertAfter(this);
					}
				}
			});
		}

		//test mobile number
		if ($(element).hasClass("mobile_number")){
			$(".mobile_number").each(function(){
				var number = $(this).val();
				if(/^09\d{9}$/.test(number) === false){
					counter++;
					$(this).css('border-color','red');
					$("<span class='validate_error_message' style='color: red;'>"+form_invalid_mobile_no+"<br></span>").insertAfter(this);
				
				}
			});
		}

		//captcha
		if ($(element).hasClass("captcha_ci")){
			$(".captcha_ci").each(function(){
				var captcha_val = $(this).attr("cpt-val");
				var input_val = sha1($(this).val().trim());
				if($(this).val().trim() != ""){
					if(captcha_val != input_val){
						counter++;
						$(this).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_invalid_captcha+"<br></span>").insertAfter(this);
					}
				}
				
			});
		}

		if ($(".g-recaptcha")[0]){
		    if(grecaptcha.getResponse().length == 0){
		    	$(".g-recaptcha").css('border-color','red');
				$("<span class='validate_error_message' style='color: red;'>"+form_invalid_captcha+"<br></span>").insertAfter(".g-recaptcha");
		    }
		}

		///filemanger extension filter validator
		$(".ext_filter").each(function(){
			if($(this).val() != ""){
				var value = $(this).val().split('.').pop();
				var accept = $(this).attr("accept");
				var extension = accept.split(',');
				if(!is_in_array(value,extension)){
					counter++;
					$(this).css('border-color','red');
					$("<span class='validate_error_message' style='color: red;'>"+form_invalid_extension+"<br></span>").insertAfter(this);
				}
			}
		});

		///filemanger extension filter validator
		$(".size_filter").each(function(){
			if($(this).val() != ""){
				var value = $(this).val();
				var this_element = $(this);
				var max = parseInt($(this).attr("max_size"));
				$.ajax(base_url + value, {
				    type: 'HEAD',
				    async: false,
				    success: function(d,r,xhr) {
				       	fileSize = xhr.getResponseHeader('Content-Length');
				       	var total_size_MB = fileSize / Math.pow(1024,2)
				      	if(max < total_size_MB){
				      		counter++;
							$(this_element).css('border-color','red');
							$("<span class='validate_error_message' style='color: red;'>"+form_max_size+"<br></span>").insertAfter(this_element);		
						}
				    }
				});
			}
		});

		///email validator
		if ($(element).hasClass("email")){
			$(".email").each(function(){
				if($(this).val() != ""){
					var email = $(this).val();
					var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
					if(!pattern.test(email)){
						counter++;
						$(this).css('border-color','red');
		      			$("<span class='validate_error_message' style='color: red;'>"+form_invalid_email+"<br></span>").insertAfter(this);
					}
				}
			});
		}

		//ckeditor
		if ($(element).hasClass("ckeditor_input")){
			$('.required_input').each(function(){
				var type = $(this).attr("type");
				var id = $(this).attr("id");
				$(".cke_editor_" + id).css('border-color','#ccc');
				if(type == "ckeditor"){
					var editor = CKEDITOR.instances[id].getData();
					if(editor.trim().length == 0){
						counter++;
						$(".cke_editor_" + id).css('border-color','red');
						$("<span class='validate_error_message' style='color: red;'>"+form_empty_error+"<br></span>").insertAfter(".cke_editor_" + id);
					}
				}
			});
		}

		$('.ckeditor_input').each(function(){
			var id = $(this).attr("id");
			var editor = html_decode(CKEDITOR.instances[id].getData());
			if(editor.trim().indexOf("<script") != -1){
				counter++;
				$(".cke_editor_" + id).css('border-color','red');
				$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(".cke_editor_" + id);
			}

			if(editor.trim().indexOf("< script") != -1){
				counter++;
				$(".cke_editor_" + id).css('border-color','red');
				$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(".cke_editor_" + id);
			}


			if(editor.trim().indexOf("<?php") != -1){
				counter++;
				$(".cke_editor_" + id).css('border-color','red');
				$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(".cke_editor_" + id);
			}

			if(editor.trim().indexOf("<?=") != -1){
				counter++;
				$(".cke_editor_" + id).css('border-color','red');
				$("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(".cke_editor_" + id);
			}	
		});
		

		$('.password_checkbox').each(function(){
			var id = $(this).attr("id");
			if(!$(this).is(':checked')) {
				counter++;
				$("."+id+"").css('color','red');
			}else{
				$("."+id+"").css('color','#333');
			}
		});


		if(counter == 0){
			return true;
		} else {
			return false;
		}
	},
	mobile : function(mobile){
		var pattern = /^09\d{9}$/;
		return pattern.test(mobile);
	}
}

function html_decode(s){
    window.HTML_ESC_MAP = {
    "nbsp":" ","iexcl":"¡","cent":"¢","pound":"£","curren":"¤","yen":"¥","brvbar":"¦","sect":"§","uml":"¨","copy":"©","ordf":"ª","laquo":"«","not":"¬","reg":"®","macr":"¯","deg":"°","plusmn":"±","sup2":"²","sup3":"³","acute":"´","micro":"µ","para":"¶","middot":"·","cedil":"¸","sup1":"¹","ordm":"º","raquo":"»","frac14":"¼","frac12":"½","frac34":"¾","iquest":"¿","Agrave":"À","Aacute":"Á","Acirc":"Â","Atilde":"Ã","Auml":"Ä","Aring":"Å","AElig":"Æ","Ccedil":"Ç","Egrave":"È","Eacute":"É","Ecirc":"Ê","Euml":"Ë","Igrave":"Ì","Iacute":"Í","Icirc":"Î","Iuml":"Ï","ETH":"Ð","Ntilde":"Ñ","Ograve":"Ò","Oacute":"Ó","Ocirc":"Ô","Otilde":"Õ","Ouml":"Ö","times":"×","Oslash":"Ø","Ugrave":"Ù","Uacute":"Ú","Ucirc":"Û","Uuml":"Ü","Yacute":"Ý","THORN":"Þ","szlig":"ß","agrave":"à","aacute":"á","acirc":"â","atilde":"ã","auml":"ä","aring":"å","aelig":"æ","ccedil":"ç","egrave":"è","eacute":"é","ecirc":"ê","euml":"ë","igrave":"ì","iacute":"í","icirc":"î","iuml":"ï","eth":"ð","ntilde":"ñ","ograve":"ò","oacute":"ó","ocirc":"ô","otilde":"õ","ouml":"ö","divide":"÷","oslash":"ø","ugrave":"ù","uacute":"ú","ucirc":"û","uuml":"ü","yacute":"ý","thorn":"þ","yuml":"ÿ","fnof":"ƒ","Alpha":"Α","Beta":"Β","Gamma":"Γ","Delta":"Δ","Epsilon":"Ε","Zeta":"Ζ","Eta":"Η","Theta":"Θ","Iota":"Ι","Kappa":"Κ","Lambda":"Λ","Mu":"Μ","Nu":"Ν","Xi":"Ξ","Omicron":"Ο","Pi":"Π","Rho":"Ρ","Sigma":"Σ","Tau":"Τ","Upsilon":"Υ","Phi":"Φ","Chi":"Χ","Psi":"Ψ","Omega":"Ω","alpha":"α","beta":"β","gamma":"γ","delta":"δ","epsilon":"ε","zeta":"ζ","eta":"η","theta":"θ","iota":"ι","kappa":"κ","lambda":"λ","mu":"μ","nu":"ν","xi":"ξ","omicron":"ο","pi":"π","rho":"ρ","sigmaf":"ς","sigma":"σ","tau":"τ","upsilon":"υ","phi":"φ","chi":"χ","psi":"ψ","omega":"ω","thetasym":"ϑ","upsih":"ϒ","piv":"ϖ","bull":"•","hellip":"…","prime":"′","Prime":"″","oline":"‾","frasl":"⁄","weierp":"℘","image":"ℑ","real":"ℜ","trade":"™","alefsym":"ℵ","larr":"←","uarr":"↑","rarr":"→","darr":"↓","harr":"↔","crarr":"↵","lArr":"⇐","uArr":"⇑","rArr":"⇒","dArr":"⇓","hArr":"⇔","forall":"∀","part":"∂","exist":"∃","empty":"∅","nabla":"∇","isin":"∈","notin":"∉","ni":"∋","prod":"∏","sum":"∑","minus":"−","lowast":"∗","radic":"√","prop":"∝","infin":"∞","ang":"∠","and":"∧","or":"∨","cap":"∩","cup":"∪","int":"∫","there4":"∴","sim":"∼","cong":"≅","asymp":"≈","ne":"≠","equiv":"≡","le":"≤","ge":"≥","sub":"⊂","sup":"⊃","nsub":"⊄","sube":"⊆","supe":"⊇","oplus":"⊕","otimes":"⊗","perp":"⊥","sdot":"⋅","lceil":"⌈","rceil":"⌉","lfloor":"⌊","rfloor":"⌋","lang":"〈","rang":"〉","loz":"◊","spades":"♠","clubs":"♣","hearts":"♥","diams":"♦","\"":"quot","amp":"&","lt":"<","gt":">","OElig":"Œ","oelig":"œ","Scaron":"Š","scaron":"š","Yuml":"Ÿ","circ":"ˆ","tilde":"˜","ndash":"–","mdash":"—","lsquo":"‘","rsquo":"’","sbquo":"‚","ldquo":"“","rdquo":"”","bdquo":"„","dagger":"†","Dagger":"‡","permil":"‰","lsaquo":"‹","rsaquo":"›","euro":"€"};
    if(!window.HTML_ESC_MAP_EXP)
        window.HTML_ESC_MAP_EXP = new RegExp("&("+Object.keys(HTML_ESC_MAP).join("|")+");","g");
    return s?s.replace(window.HTML_ESC_MAP_EXP,function(x){
        return HTML_ESC_MAP[x.substring(1,x.length-1)]||x;
    }):s;
}

function is_in_array(s,your_array) {
    for (var i = 0; i < your_array.length; i++) {
        if (your_array[i].toLowerCase() === s.toLowerCase()) return true;
    }
    return false;
}

//modals
var modal = {
	success : function(message){
		html = '<center><i class="text-success fa fa-5x fa-check-circle"></i><br><h2>'+message+'</h2></center>';
		bootbox.alert({
			closeButton: false,
				message: html,
				callback: function(){
					location.reload()
				}
		});
	},
	standard_confirm : function(message,btn,cb){
		bootbox.confirm({
		   	message: message,
		   	buttons: {
			   	confirm: {
				   label: btn,
				   className: 'btn-primary'
			   	},
			   	cancel: {
				   label: 'Cancel',
				   className: 'btn-default'
			   	}
		   	},
		   	callback: cb
		});
	},
	confirm : function(message,cb){
		bootbox.confirm({
		   	message: message,
		   	buttons: {
			   	confirm: {
				   label: 'Yes',
				   className: 'btn-primary'
			   	},
			   	cancel: {
				   label: 'No',
				   className: 'btn-default'
			   	}
		   	},
		   	callback: cb
		});
	},
	alert : function(message, cb){
		console.log(message);
		bootbox.alert({
		    message: message,
		    callback: cb,
		    buttons: {
		    	ok: {
		    		label: 'Ok'
		    	}
		    }
		});
	},
	show : function(message, size, cb){
		bootbox.alert({
		    message: message,
		    size: size,
		    callback: cb
		});
	},
	input : function(message,type, cb){
		bootbox.prompt({
		    title: message,
		    inputType: type,
		    callback: cb
		});
	},
	custom : function(modal, action){
		$(modal).modal(action);
	},
	loading : function(isloading){
		if(isloading){
			bootbox.dialog({ 
				message: '<center><i class="fa fa-spinner fa-spin" style="font-size:54px"></i><h2>Loading...</h2></center>', 
				closeButton: false 
			});
		} else {
			$('.bootbox').modal('hide');
		}
	},
	iframe : function(path, identifier){
		if(identifier == ""){
			var body = '<iframe src="'+path+'" width="100%" height="500px" style="border: none;">This browser does not support PDFs. Please download the PDF to view it: <a href="'+path+'">Download PDF</a></iframe><hr><button class="btn btn-danger" id="download_file" path="'+path.replace(base_url, "")+'">Download File</button>'
		} else {
			var src = path.replace(base_url, "");
			var body = '<iframe src="'+path+'" width="100%" height="500px" style="border: none;">This browser does not support PDFs. Please download the PDF to view it: <a href="'+path+'">Download PDF</a></iframe><hr><input id="file_url" value="'+src+'" class=" required hidden" style="width: 100%;" placeholder="Url"><input id="file_alt" class=" required hidden"  style="width: 100%;" placeholder="Image alt"><input id="file_width" class=" required hidden"  style="width: 100%;" value="100%"><input id="file_height" class=" required hidden"  style="width: 100%;" value="auto"><button class="btn btn-primary btn_insert" hidden identifier="'+identifier+'">Insert File</button>'
		}
		bootbox.dialog({ 
			message: body, 
			closeButton: true
		});
		
	},
	image_view : function(src, identifier){
		if(identifier == ""){
			var body = "<center><img src='"+src+"' style='width	: 100%; height: 100%;' /></center><hr><button class='btn btn-danger hidden' hidden id='download_file' path='"+src+"'>Download File</button>"
		} else {
			var body = "<center><img src='"+src+"' style='width	: 100%; height: 100%;' /></center><hr><input id='file_url' value='"+src.replace(base_url, "")+"' class=' required hidden' style='width: 100%;' placeholder='Url'><input id='file_alt' class=' required hidden'  style='width: 100%;' placeholder='Image alt'><input id='file_width' class=' required hidden'  style='width: 100%;' value='100%'><input id='file_height' class=' required hidden'  style='width: 100%;' value='auto'><button class='btn btn-primary btn_insert' hidden identifier='"+identifier+"'>Insert File</button>"

		}
		bootbox.dialog({
		    message: body,
		    closeButton: true 
		});
	},
	video_view : function(src, identifier){
		if(identifier != ""){
			var body = '<center><video style="width: 100%; "  controls>';
			body += '	<source src="'+src+'" type="video/mp4">';
			body += '</video></center><hr><input id="file_url" value="'+src.replace(base_url, "")+'" class=" required hidden" style="width: 100%;" placeholder="Url"><input id="file_alt" class=" required hidden"  style="width: 100%;" placeholder="Image alt"><input id="file_width" class=" required hidden"  style="width: 100%;" value="100%"><input id="file_height" class=" required hidden"  style="width: 100%;" value="auto"><button class="btn btn-primary btn_insert" identifier="'+identifier+'" hidden>Insert File</button>';
		} else {
			var body = '<center><video style="width: 100%; "  controls>';
			body += '	<source src="'+src+'" type="video/mp4">';
			body += '</video></center><hr><button class="btn btn-danger" id="download_file"  path="'+src+'">Download File</button>';
		}
		bootbox.dialog({
		    message: body,
		    closeButton: true 
		});
	},
	view_file : function(path){
		if(identifier == ""){
			var body = '<h3>"'+path+'"</h3><hr><button class="btn btn-danger" id="download_file" path="'+path+'">Download File</button>';
		} else {
			var body = '<h3>"'+path+'"</h3><hr><button class="btn btn-danger" id="download_file" path="'+path+'">Download File</button><input id="file_url" value="+src+" class=" required hidden" style="width: 100%;" placeholder="Url"><input id="file_alt" class=" required hidden"  style="width: 100%;" placeholder="Image alt"><input id="file_width" class=" required hidden"  style="width: 100%;" value="100%"><input id="file_height" class=" required hidden"  style="width: 100%;" value="auto"><button class="btn btn-primary btn_insert btn-sm" hidden identifier="'+identifier+'">Insert File</button>';
		}
		bootbox.dialog({ 
			message: body, 
			closeButton: true
		});
	},
	file_manager :function(element){
		$('#ckeditor_filemanager_modal').modal("show");
    	$('#filemanager_identifier').val(element);
	},
	standard : function(data,cb){
		var mdl_data = is_json(data) ;
		bootbox.confirm({
		   	message: mdl_data.message,
		   	buttons: {
			   	cancel: {
				   label: mdl_data.cancel,
				   className: 'btn-default'
			   	},
			   	confirm: {
				   label: mdl_data.confirm,
				   className: 'btn-primary'
			   	}
		   	},
		   	callback: cb
		});
	},
	youtube :function(element){
		$('#youtube_input').modal("show");
    	$('#youtube_insert_input').attr("identifier",element);
	}
}

function check_unique(element)
{
	var values = {};
	var countUnique = 0;
	var checks = $(element);
	checks.removeClass("error");

	checks.each(function(i, elem)
	{
	  if(elem.value in values) {
	    $(elem).css('border-color','red');
	    $(elem).next().html("Please enter a Unique Value.");
	    $(elem).next().show();
	    $(values[elem.value]).css('border-color','red');
	    $(values[elem.value]).next().html("Please enter a Unique Value.");
	    $(values[elem.value]).next().show();
	  } else {
	    values[elem.value] = elem;
	    ++countUnique;
	  }
	});

	if(countUnique == checks.size()) {
	  return 0;
	} else {
	  return 1;
	}
}

var pagination = {
	generate : function(total_page, element, limit, table_body, cols){
		window.tp_data = total_page;
		var total_parse = parseInt(total_page);
		if(total_parse >= 1){
		  var htm = '<div class="clearfix"></div>';
		  htm += '<br><center><div class="btn-group">';
		  htm += '  <button type="button" id="first_page" class="btn btn-default first-page">First</button>';
		  htm += '  <button type="button" id="prev_page" class="btn btn-default prev-page">Prev</button>';
		  htm += '  <div class="btn-group dropup">';
		  htm += '    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">';
		  htm += '      <span class="pager_no">Page 1</span>';
		  htm += '      <span class="glyphicon glyphicon-menu-down"></span>';
		  htm += '    </button>';
		  htm += '    <ul class="dropdown-menu" style="max-height: 200px; overflow: auto"">';
		  for(var x =1; x<=total_page; x++){
		    var pgno = x;
			if(pgno == 1){
				var determine_page = 'first';
			} else if(pgno == total_page){
				var determine_page = 'last';
			} else{
				var determine_page = 'mid';
			}
		    htm += '    <li><a style="margin-left: 0px;" class="pg_no" href="#" data-value='+pgno+' page-determine="'+determine_page+'">Page '+pgno+'</a></li>';
		  }
		  htm += '    </ul>';
		  htm += '  </div>';
		  htm += '  <button type="button" id="next_page" class="btn btn-default next-page">Next</button>';
		  htm += '  <button type="button" id="last_page" class="btn btn-default last-page">Last</button>';
		  htm += '</div></center>';

		  htm += '<select class="form-control pager_number input-sm hidden" style="width: 70px;">';
		  for(var x =1; x<=total_page; x++){
		    var pgno = x;
		    htm += "<option value='" + pgno + "'>" + pgno + "</option>";
		  }
		  htm += '</select>';
		  $(element).html(htm);
		  
		   if(total_page < 2){   
		     $(element).hide();			 
		   } else {
		     $(element).show();
		   }
		} else{
			var html = '<tr>';
				html += '<td colspan="'+cols+'"><center><b>No records to show!</b></center></td>';
				html += '</tr>';
				$('.'+table_body+'').html(html);
			  	$(element).hide();
		}
		var parsing = parseInt(limit);
		switch(parsing){
			case 10:
				$('#first_page').attr("disabled", 'disabled');
				$('#prev_page').attr("disabled", 'disabled');
				$('#last_page').attr("disabled", false);
				$('#next_page').attr("disabled", false);
			break;
			case 999:
				$('#last_page').attr("disabled", 'disabled');
				$('#next_page').attr("disabled", 'disabled');
			break;
			default:
				$('#last_page').attr("disabled", false);
				$('#next_page').attr("disabled", false);
				$('#first_page').attr("disabled", false);
				$('#prev_page').attr("disabled", false);
			break;
		}
	},
	onchange : function(cb){
		$(document).on('change','.pager_number', cb);
	}
}
var offset = 1;
$(document).on('change','.pager_number', function() {
	var page_number = parseInt($(this).val());
	offset = page_number
	$('.pager_no').html("Page " + numeral(page_number).format('0,0'));
});

$(document).on("change", ".record-entries", function(e) {
	$(".record-entries option").removeAttr("selected");
	$(".record-entries").val($(this).val());
	$(".record-entries option:selected").attr("selected","selected");
	var record_entries = $(this).prop( "selected",true ).val();
	limit = parseInt(record_entries);
	$('#search_query').val('');
	offset = 1;
	modal.loading(true);
	get_data();
	modal.loading(false);
});

$(document).on('keypress', '#search_query', function(e) {  
	if(e.keyCode == 13){
		var keyword = $(this).val();
		offset = 1;
		if(keyword.trim() == ''){
			location.reload();
		} else{
			get_data(keyword);
		}
	}
});

pagination.onchange(function(){
	offset = $(this).val();
	//limit = $(this).val() + 0;
	modal.loading(true);
	get_data();
	var search = $("#search_query");
	if(search.length == 1){
		var keyword = $('.search-query').val();
		search.val($.trim(keyword));
		get_data(keyword, true);
	}
	modal.loading(false);

});

$(document).on('click','#first_page', function() {
	var page_number = parseInt($('.page_number').val());
	if(page_number!=first()){
		//offset = first();
		$('.pager_number').val($('.pager_number option:first').val()).change();;
		$('.pager_no').html("Page " + numeral(first()).format('0,0'));
	}
	$('#last_page').attr("disabled", false);
	$('#next_page').attr("disabled", false);
	$('#first_page').attr("disabled", 'disabled');
	$('#prev_page').attr("disabled", 'disabled');
});


$(document).on('click','#prev_page', function() {
	var page_number = parseInt($('.pager_number').val());
	var prev = page_number -1;
	if(page_number!=first()){
		//offset = prev;
		$('.pager_number').val(prev).change();
		$('.pager_no').html("Page " + numeral(prev).format('0,0'));
	}
		if(prev == 1){
			$('#last_page').attr("disabled", false);
			$('#next_page').attr("disabled", false);
			$('#first_page').attr("disabled", 'disabled');
			$('#prev_page').attr("disabled", 'disabled');
		} else{
			$('#last_page').attr("disabled", false);
			$('#next_page').attr("disabled", false);
			$('#first_page').attr("disabled", false);
			$('#prev_page').attr("disabled", false);
		}
});

$(document).on('click','#next_page', function() {

	var page_number = parseInt($('.pager_number').val());
	var next = page_number +1;
	if(page_number!=last()){
		//offset = next;
		$('.pager_number').val(next).change();
		$('.pager_no').html("Page " + numeral(next).format('0,0') );
		
		if(tp_data == next){
			$('#last_page').attr("disabled", 'disabled');
			$('#next_page').attr("disabled", 'disabled');
			$('#first_page').attr("disabled", false);
			$('#prev_page').attr("disabled", false);
		} else{
			$('#last_page').attr("disabled", false);
			$('#next_page').attr("disabled", false);
			$('#first_page').attr("disabled", false);
			$('#prev_page').attr("disabled", false);
		}
	}
});

$(document).on('click','#last_page', function() {
	var page_number = parseInt($('.page-number').val());
	if(page_number!=last()){
		//offset = last();
		$('.pager_number').val($('.pager_number option:last').val()).change();
		$('.pager_no').html("Page " + numeral(last()).format('0,0'));
			$('#last_page').attr("disabled", 'disabled');
			$('#next_page').attr("disabled", 'disabled');
			$('#first_page').attr("disabled", false);
			$('#prev_page').attr("disabled", false);
	}
});

function first(){
	return parseInt($('.pager_number option:first').val());
}

function last(){
	return parseInt($('.pager_number option:last').val());
}

$(document).on('click', '.pg_no', function(e){
    e.preventDefault();
	var page_determine = $(this).attr('page-determine');
    var page_no = $(this).attr("data-value");
    $('.pager_number').val(page_no).change();
    if(page_determine == 'first'){
		$('#last_page').attr("disabled", false);
		$('#next_page').attr("disabled", false);
		$('#first_page').attr("disabled", 'disabled');
		$('#prev_page').attr("disabled", 'disabled');
	} else if(page_determine == 'last'){
		$('#last_page').attr("disabled", 'disabled');
		$('#next_page').attr("disabled", 'disabled');
		$('#first_page').attr("disabled", false);
		$('#prev_page').attr("disabled", false);
	} else{
		$('#last_page').attr("disabled", false);
		$('#next_page').attr("disabled", false);
		$('#first_page').attr("disabled", false);
		$('#prev_page').attr("disabled", false);
	}
});

$(document).on('change', '.selectall', function(){
	var del = 0;
	if(this.checked) { 
		$('.select').each(function() { 
			this.checked = true;  
			$('.btn_status').show();         
		});
	}else{
		$('.select').each(function() { 
			$('.btn_status').hide();
			this.checked = false;                 
		});         
	}
});

$(document).on('change', '.selectall_new', function(){
	var del = 0;
	if(this.checked) { 
		$('.selectt').each(function() { 
			this.checked = true;  
			$('.btn_status_ac').show();         
		});
	}else{
		$('.selectt').each(function() { 
			$('.btn_status_ac').hide();
			this.checked = false;                 
		});         
	}
});

$(document).on('change', '.select', function(){
	var del = 0;
	var x = 0;
	var select_count = $('.select').length;
	$('.select').each(function(){  
		var ischecked =  $(this).is(":checked");

		if(this.checked==true){ 
			x++;
		} 

		if(x > 0 ){
		  $('.btn_status').show();
		}else{
		  $('.btn_status').hide();
		  $('.selectall').prop('checked', true);
		}
	});


	if(select_count != x){
		$('.selectall').prop('checked', false);
	}else{
		$('.selectall').prop('checked', true);
	}
});

$(document).on('change', '.selectt', function(){
	var del = 0;
	var x = 0;
	var select_count = $('.selectt').length;
	$('.selectt').each(function(){  
		var ischecked =  $(this).is(":checked");

		if(this.checked==true){ 
			x++;
		} 

		if(x > 0 ){
		  $('.btn_status_ac').show();
		}else{
		  $('.btn_status_ac').hide();
		  $('.selectall_new').prop('checked', true);
		}
	});
	

	if(select_count != x){
		$('.selectall_new').prop('checked', false);
	}else{
		$('.selectall_new').prop('checked', true);
	}
});

$(document).on('change', '.select_export', function(){
	var a = $('.select_export').length;
	var b = 0;

	$('.select_export').each(function(){
		if(this.checked==true){ 
			b++;
		} 
	});

	if(a != b){
		$('#select_all_export').prop('checked', false);
	}else{
		$('#select_all_export').prop('checked', true);
	}
});

$(document).on('change', '.select-display', function(){
	if (this.checked==true) { 
	 	$(this).val(1);
	} else {
		$(this).val(0);
	}
});

var MD5 = function(s){function L(k,d){return(k<<d)|(k>>>(32-d))}function K(G,k){var I,d,F,H,x;F=(G&2147483648);H=(k&2147483648);I=(G&1073741824);d=(k&1073741824);x=(G&1073741823)+(k&1073741823);if(I&d){return(x^2147483648^F^H)}if(I|d){if(x&1073741824){return(x^3221225472^F^H)}else{return(x^1073741824^F^H)}}else{return(x^F^H)}}function r(d,F,k){return(d&F)|((~d)&k)}function q(d,F,k){return(d&k)|(F&(~k))}function p(d,F,k){return(d^F^k)}function n(d,F,k){return(F^(d|(~k)))}function u(G,F,aa,Z,k,H,I){G=K(G,K(K(r(F,aa,Z),k),I));return K(L(G,H),F)}function f(G,F,aa,Z,k,H,I){G=K(G,K(K(q(F,aa,Z),k),I));return K(L(G,H),F)}function D(G,F,aa,Z,k,H,I){G=K(G,K(K(p(F,aa,Z),k),I));return K(L(G,H),F)}function t(G,F,aa,Z,k,H,I){G=K(G,K(K(n(F,aa,Z),k),I));return K(L(G,H),F)}function e(G){var Z;var F=G.length;var x=F+8;var k=(x-(x%64))/64;var I=(k+1)*16;var aa=Array(I-1);var d=0;var H=0;while(H<F){Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=(aa[Z]| (G.charCodeAt(H)<<d));H++}Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=aa[Z]|(128<<d);aa[I-2]=F<<3;aa[I-1]=F>>>29;return aa}function B(x){var k="",F="",G,d;for(d=0;d<=3;d++){G=(x>>>(d*8))&255;F="0"+G.toString(16);k=k+F.substr(F.length-2,2)}return k}function J(k){k=k.replace(/rn/g,"n");var d="";for(var F=0;F<k.length;F++){var x=k.charCodeAt(F);if(x<128){d+=String.fromCharCode(x)}else{if((x>127)&&(x<2048)){d+=String.fromCharCode((x>>6)|192);d+=String.fromCharCode((x&63)|128)}else{d+=String.fromCharCode((x>>12)|224);d+=String.fromCharCode(((x>>6)&63)|128);d+=String.fromCharCode((x&63)|128)}}}return d}var C=Array();var P,h,E,v,g,Y,X,W,V;var S=7,Q=12,N=17,M=22;var A=5,z=9,y=14,w=20;var o=4,m=11,l=16,j=23;var U=6,T=10,R=15,O=21;s=J(s);C=e(s);Y=1732584193;X=4023233417;W=2562383102;V=271733878;for(P=0;P<C.length;P+=16){h=Y;E=X;v=W;g=V;Y=u(Y,X,W,V,C[P+0],S,3614090360);V=u(V,Y,X,W,C[P+1],Q,3905402710);W=u(W,V,Y,X,C[P+2],N,606105819);X=u(X,W,V,Y,C[P+3],M,3250441966);Y=u(Y,X,W,V,C[P+4],S,4118548399);V=u(V,Y,X,W,C[P+5],Q,1200080426);W=u(W,V,Y,X,C[P+6],N,2821735955);X=u(X,W,V,Y,C[P+7],M,4249261313);Y=u(Y,X,W,V,C[P+8],S,1770035416);V=u(V,Y,X,W,C[P+9],Q,2336552879);W=u(W,V,Y,X,C[P+10],N,4294925233);X=u(X,W,V,Y,C[P+11],M,2304563134);Y=u(Y,X,W,V,C[P+12],S,1804603682);V=u(V,Y,X,W,C[P+13],Q,4254626195);W=u(W,V,Y,X,C[P+14],N,2792965006);X=u(X,W,V,Y,C[P+15],M,1236535329);Y=f(Y,X,W,V,C[P+1],A,4129170786);V=f(V,Y,X,W,C[P+6],z,3225465664);W=f(W,V,Y,X,C[P+11],y,643717713);X=f(X,W,V,Y,C[P+0],w,3921069994);Y=f(Y,X,W,V,C[P+5],A,3593408605);V=f(V,Y,X,W,C[P+10],z,38016083);W=f(W,V,Y,X,C[P+15],y,3634488961);X=f(X,W,V,Y,C[P+4],w,3889429448);Y=f(Y,X,W,V,C[P+9],A,568446438);V=f(V,Y,X,W,C[P+14],z,3275163606);W=f(W,V,Y,X,C[P+3],y,4107603335);X=f(X,W,V,Y,C[P+8],w,1163531501);Y=f(Y,X,W,V,C[P+13],A,2850285829);V=f(V,Y,X,W,C[P+2],z,4243563512);W=f(W,V,Y,X,C[P+7],y,1735328473);X=f(X,W,V,Y,C[P+12],w,2368359562);Y=D(Y,X,W,V,C[P+5],o,4294588738);V=D(V,Y,X,W,C[P+8],m,2272392833);W=D(W,V,Y,X,C[P+11],l,1839030562);X=D(X,W,V,Y,C[P+14],j,4259657740);Y=D(Y,X,W,V,C[P+1],o,2763975236);V=D(V,Y,X,W,C[P+4],m,1272893353);W=D(W,V,Y,X,C[P+7],l,4139469664);X=D(X,W,V,Y,C[P+10],j,3200236656);Y=D(Y,X,W,V,C[P+13],o,681279174);V=D(V,Y,X,W,C[P+0],m,3936430074);W=D(W,V,Y,X,C[P+3],l,3572445317);X=D(X,W,V,Y,C[P+6],j,76029189);Y=D(Y,X,W,V,C[P+9],o,3654602809);V=D(V,Y,X,W,C[P+12],m,3873151461);W=D(W,V,Y,X,C[P+15],l,530742520);X=D(X,W,V,Y,C[P+2],j,3299628645);Y=t(Y,X,W,V,C[P+0],U,4096336452);V=t(V,Y,X,W,C[P+7],T,1126891415);W=t(W,V,Y,X,C[P+14],R,2878612391);X=t(X,W,V,Y,C[P+5],O,4237533241);Y=t(Y,X,W,V,C[P+12],U,1700485571);V=t(V,Y,X,W,C[P+3],T,2399980690);W=t(W,V,Y,X,C[P+10],R,4293915773);X=t(X,W,V,Y,C[P+1],O,2240044497);Y=t(Y,X,W,V,C[P+8],U,1873313359);V=t(V,Y,X,W,C[P+15],T,4264355552);W=t(W,V,Y,X,C[P+6],R,2734768916);X=t(X,W,V,Y,C[P+13],O,1309151649);Y=t(Y,X,W,V,C[P+4],U,4149444226);V=t(V,Y,X,W,C[P+11],T,3174756917);W=t(W,V,Y,X,C[P+2],R,718787259);X=t(X,W,V,Y,C[P+9],O,3951481745);Y=K(Y,h);X=K(X,E);W=K(W,v);V=K(V,g)}var i=B(Y)+B(X)+B(W)+B(V);return i.toLowerCase()};

//sha1 convert
function sha1(msg) {
  function rotate_left(n,s) {
    var t4 = ( n<<s ) | (n>>>(32-s));
    return t4;
  };
  function lsb_hex(val) {
    var str="";
    var i;
    var vh;
    var vl;
    for( i=0; i<=6; i+=2 ) {
      vh = (val>>>(i*4+4))&0x0f;
      vl = (val>>>(i*4))&0x0f;
      str += vh.toString(16) + vl.toString(16);
    }
    return str;
  };
  function cvt_hex(val) {
    var str="";
    var i;
    var v;
    for( i=7; i>=0; i-- ) {
      v = (val>>>(i*4))&0x0f;
      str += v.toString(16);
    }
    return str;
  };
  function Utf8_encode(string) {
    string = string.replace(/\r\n/g,"\n");
    var utftext = "";
    for (var n = 0; n < string.length; n++) {
      var c = string.charCodeAt(n);
      if (c < 128) {
        utftext += String.fromCharCode(c);
      }
      else if((c > 127) && (c < 2048)) {
        utftext += String.fromCharCode((c >> 6) | 192);
        utftext += String.fromCharCode((c & 63) | 128);
      }
      else {
        utftext += String.fromCharCode((c >> 12) | 224);
        utftext += String.fromCharCode(((c >> 6) & 63) | 128);
        utftext += String.fromCharCode((c & 63) | 128);
      }
    }
    return utftext;
  };
  var blockstart;
  var i, j;
  var W = new Array(80);
  var H0 = 0x67452301;
  var H1 = 0xEFCDAB89;
  var H2 = 0x98BADCFE;
  var H3 = 0x10325476;
  var H4 = 0xC3D2E1F0;
  var A, B, C, D, E;
  var temp;
  msg = Utf8_encode(msg);
  var msg_len = msg.length;
  var word_array = new Array();
  for( i=0; i<msg_len-3; i+=4 ) {
    j = msg.charCodeAt(i)<<24 | msg.charCodeAt(i+1)<<16 |
    msg.charCodeAt(i+2)<<8 | msg.charCodeAt(i+3);
    word_array.push( j );
  }
  switch( msg_len % 4 ) {
    case 0:
      i = 0x080000000;
    break;
    case 1:
      i = msg.charCodeAt(msg_len-1)<<24 | 0x0800000;
    break;
    case 2:
      i = msg.charCodeAt(msg_len-2)<<24 | msg.charCodeAt(msg_len-1)<<16 | 0x08000;
    break;
    case 3:
      i = msg.charCodeAt(msg_len-3)<<24 | msg.charCodeAt(msg_len-2)<<16 | msg.charCodeAt(msg_len-1)<<8  | 0x80;
    break;
  }
  word_array.push( i );
  while( (word_array.length % 16) != 14 ) word_array.push( 0 );
  word_array.push( msg_len>>>29 );
  word_array.push( (msg_len<<3)&0x0ffffffff );
  for ( blockstart=0; blockstart<word_array.length; blockstart+=16 ) {
    for( i=0; i<16; i++ ) W[i] = word_array[blockstart+i];
    for( i=16; i<=79; i++ ) W[i] = rotate_left(W[i-3] ^ W[i-8] ^ W[i-14] ^ W[i-16], 1);
    A = H0;
    B = H1;
    C = H2;
    D = H3;
    E = H4;
    for( i= 0; i<=19; i++ ) {
      temp = (rotate_left(A,5) + ((B&C) | (~B&D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B,30);
      B = A;
      A = temp;
    }
    for( i=20; i<=39; i++ ) {
      temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B,30);
      B = A;
      A = temp;
    }
    for( i=40; i<=59; i++ ) {
      temp = (rotate_left(A,5) + ((B&C) | (B&D) | (C&D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B,30);
      B = A;
      A = temp;
    }
    for( i=60; i<=79; i++ ) {
      temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B,30);
      B = A;
      A = temp;
    }
    H0 = (H0 + A) & 0x0ffffffff;
    H1 = (H1 + B) & 0x0ffffffff;
    H2 = (H2 + C) & 0x0ffffffff;
    H3 = (H3 + D) & 0x0ffffffff;
    H4 = (H4 + E) & 0x0ffffffff;
  }
  var temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);

  return temp.toLowerCase();
}

//for sorting of table
$('thead tr th').on("click", function(e) {  
    var selected = $(this);
    var index = selected[0].cellIndex;
    if(index > 0){
        var table = $(this).parents('table').eq(0)
        var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
        this.asc = !this.asc
        if (!this.asc){rows = rows.reverse()}
        for (var i = 0; i < rows.length; i++){table.append(rows[i])}
    }
});

function comparer(index) {
    return function(a, b) {
        var valA = get_cell_value(a, index), valB = get_cell_value(b, index)
        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
    }
}

function get_cell_value(row, index){ return $(row).children('td').eq(index).text() }

function is_exists(table, field, value, status){
    var query = ""+ field +" = '" + value + "' AND "+status+" >= 0";
    var exists = 0;
    var url = base_url+"content_management/global_controller";
    var data = {
        event : "list", 
        select : ""+field+", "+status+"",
        query : query, 
        table : table
    }
    aJax.post(url,data,function(result){
        var obj = is_json(result);
        if(obj.length != 0){
            exists = 1;
        }
        else{
            exists = 0;
        }
        
    });
    return exists;
}

var entityMap_e = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;'
};

function encode_Html (string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap_e[s];
  });
}

var entityMap_d = {
  '&amp;':  '&',
  '&lt;':   '<',
  '&gt;':   '>',
  '&quot;': '"',
  '&#39;':  "'",
  '&#x2F;': '/',
  '&#x60;': '`',
  '&#x3D;': '='
};

function decode_Html (string) {
  return String(string).replace('&amp;&lt;&gt;&quot;&#39;&#x2F;&#x60;&#x3D;', function (s) {
    return entityMap_d[s];
  });
}


