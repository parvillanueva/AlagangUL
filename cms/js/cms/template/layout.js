$(document).ready(function(){
	$('.package-title-containter').hide();	
	if(menu_session_role <= 4){
		$('.edit-title').remove();
	}
});

$(document).on('click', '#edit_title_cancel', function(){
	$('.package-title-containter').hide();
	$('#breadcrumb').show();
});

$(document).on('click', '#edit_title', function(){
	var modal_obj = confirm_edit; 
    modal.standard(modal_obj, function(result){
	    if(result){
			$('.package-title-containter').show();
			$('#breadcrumb').hide();
		}
	});	
});

$(document).on('change', '#edit_package_title', function(){  
   	var title = $('.edit-package-title').val();  
   	if(title != ''){  
        $.ajax({   
            url:content_management + '/package/check_title_avalibility',  
            method:"POST",  
            data:{title:title},  
            success:function(data){  
                $('#title_result').html(data); 
               	if($('#title_result span').hasClass('error_title')){
					$('.edit-package-title').addClass('error_title_msg');
					$('.edit-package-title').removeClass('success_title_msg');
				}
				if($('#title_result span').hasClass('success_title')){
					$('.edit-package-title').addClass('success_title_msg');
					$('.edit-package-title').removeClass('error_title_msg');
				}
            }  
        });  
   	}
});  


$(document).on('click', '#btn_save_package_title', function(){

	if($('.edit-package-title').hasClass('error_title_msg')){
		event.preventDefault();
	}else if($('.edit-package-title').hasClass('success_title_msg')){

		$.ajax({   
            url:content_management + '/package/edit_title',  
            method:"POST",  
               	data : {
	                title :  $('.edit-package-title').val(),
	                old_title : $('.old_title').val(),
	                module_path : $('.module_path').val(),
	                reload_path : $('.reload_path').val()
	          	}, 
            success:function(data){
                 location.reload();
            }  
        }); 
	}else{
		return false;
	}
});

$(document).on('click', '.close-toast', function(){
	$('.toast').remove();
});