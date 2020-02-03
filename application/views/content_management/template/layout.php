<!-- HTML Header -->
<?php $this->load->view("content_management/template/header"); ?>

<!-- Nav Menu-->
<?php $this->load->view("content_management/template/modals"); ?>

<!-- side Menu-->
<?php $this->load->view("content_management/template/sidemenu"); ?>

<div class="content-wrapper">
    <section class="content-header">
    	<?php

    	$pref = $this->load->active_list('cms_preference', 'cms_edit_label = 1');
    	$edit_icon = '';
    	if (!empty($pref)){
			$edit_icon = '<i id="edit_title" class="glyphicon glyphicon-pencil edit-title"></i>';
		}
    	// load Breadcrumbs
    	$breadcrumb_html ='';
    	$output='';
    	if(isset($breadcrumb)){
    		$breadcrumb_html .= '<ul id="breadcrumb">';
    		$breadcrumb_html .=  '<li><a href="'.base_url("content_management").'"><span class="glyphicon glyphicon-home"></span></a></li>';
		         foreach ($breadcrumb as $key => $value) {
		         	if($value != ''){
		         			$breadcrumb_html .= '<li><a href='.$value.'>'.$key.'</a></li>';
		         	}else{
/*		    			if(isset($edit_title)){
					    	if($edit_title == true){
					 			$breadcrumb_html .= '<li><a href="#" id="edit_breadcrumb_title">'.$key.$edit_icon.'</a></li>';
					 			$output .= '<div class="package-title-containter">';
								$output .= '	<form id="package_form">';
								$output .= "		<input type='text' id='edit_package_title' class='form-control edit-package-title req'  value='".$PageName."'>
													<input type='text' class='form-control hidden old_title' value='".$PageName."''>
													<input type='text' class='form-control hidden module_path'  value='dirname(__FILE__);'/>
						   						<input type='text' class='form-control hidden reload_path'  value= 'http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'/><span id='title_result'></span>
												<button type='button' id='edit_title_cancel' class='btn btn-default edit-title-cancel'>Cancel</button>
													<input class='btn btn-success btn-save-package-title' id='btn_save_package_title'  type='submit'  value='Save'/>";
								$output .= ' 	</form>';
								$output .= '</div>';

					 		}
		         		}else{*/
		         				$breadcrumb_html .= '<li><a href="#">'.$key.'</a></li>';
	/*	         		}*/
		  
		         	}
		         }
		    $breadcrumb_html .= '</ul>';
    	}else{
    		$breadcrumb_html .= '<h1>'.$PageName.'</h1>';
    	}
    	echo $breadcrumb_html;
    	echo $output;
?>



 	</section>
    <section class="content">
    	<?php $this->load->view($content); ?>
    </section>
</div>


<!-- Toast -->
<?php if($this->session->flashdata('toast_message')) : ?>
	<div class="toast">
		<i class="fa fa-times-circle close-toast"></i>
		<p><?=$this->session->flashdata('toast_message');?></p>
	</div>
<?php endif; ?>

<!-- footer Menu-->
<?php $this->load->view("content_management/template/footer"); ?>

<script type="text/javascript">

	var menu_session_role = "<?= $this->session->userdata('sess_role');?>";


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
		var modal_obj = '<?= $this->standard->confirm("confirm_edit"); ?>'; 
	    modal.standard(modal_obj, function(result){
		     if(result){
				$('.package-title-containter').show();
				$('#breadcrumb').hide();
			}
		});	
	});

    $(document).on('change', '#edit_package_title', function(){  
       var title = $('.edit-package-title').val();  
       if(title != '')  
       {  
            $.ajax({  
                 url:"<?= base_url('content_management/package/check_title_avalibility'); ?>",  
                 method:"POST",  
                 data:{title:title},  
                 success:function(data){  
                    $('#title_result').html(data); 
                   	if ($('#title_result span').hasClass('error_title')){
							$('.edit-package-title').addClass('error_title_msg');
							$('.edit-package-title').removeClass('success_title_msg');
					}
					 if ($('#title_result span').hasClass('success_title')){
							$('.edit-package-title').addClass('success_title_msg');
							$('.edit-package-title').removeClass('error_title_msg');
					}
                 }  
            });  
       }
  });  


	$(document).on('click', '#btn_save_package_title', function(){

		if ($('.edit-package-title').hasClass('error_title_msg')){
				event.preventDefault();
		}else if ($('.edit-package-title').hasClass('success_title_msg')){

			$.ajax({  
	             url:"<?= base_url('content_management/package/edit_title'); ?>",  
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

	<?php 
        $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

        $urls = explode('/', $escaped_url);
        array_pop($urls);
    ?>

  	$(document).on('click', '.close-toast', function(){
  		$('.toast').remove();
  	});

</script>

<style type="text/css">

.edit-title {
	font-size: 10px;
    position: relative;
    cursor:pointer;
    top: -10px;
    left: 5px;
}

.edit-package-title {
	width:50%;
	display: inline-block;
	vertical-align: top;
	margin-right: 5px;
}

.error_title_msg {
    border: 1px solid #f00;
}

.success_title_msg {
	border: 1px solid #00a65a;
}

.box-header.with-border {
    margin-top: 5px;
}


</style>