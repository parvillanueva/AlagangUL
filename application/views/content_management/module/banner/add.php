<div class="box">
	<?php
		$data['buttons'] = ['save','close'];
		$this->load->view("content_management/template/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$inputs = [
                'banner_title',
                'banner_description',
                'banner_media_web',
                'banner_media_tablet',
                'banner_media_mobile',
                'banner_logo',
                'banner_button_url',
                'banner_button_text',
                'banner_navigation_text',
                'banner_navigation_url',
                'banner_status'
            ];
            $banner_details = $this->standard->inputs($inputs);
		?>
	</div>
</div>
<script type="text/javascript">

    $(document).on('click', '#btn_save', function() {
        var base_url = '<?=base_url();?>';  
        var user_id = '<?=$this->session->userdata("sess_uid");?>';
        var confirm_add = '<?= $this->standard->confirm("confirm_add"); ?>'; 
        var add_success = '<?= $this->standard->dialog("add_success"); ?>'; 

        var banner_title = $('#banner_title').val() ? strip_tags($('#banner_title').val()) : '';
        var banner_description = $('#banner_description').val() ? strip_tags($('#banner_description').val()) : '';
        var button_text =  $('#banner_button_text').val() ? strip_tags($('#banner_button_text').val()) : '';
        var banner_button_url =  $('#banner_button_url').val() ? strip_tags($('#banner_button_url').val()) : '';
        var banner_navigation_text =  $('#banner_navigation_text').val() ? strip_tags($('#banner_navigation_text').val()) : '';
        var banner_navigation_url =  $('#banner_navigation_url').val() ? strip_tags($('#banner_navigation_url').val()) : '';
        var banner_media_web =  $('#banner_media_web').val() ? $('#banner_media_web').val() : '';
        var banner_media_tablet =  $('#banner_media_tablet').val() ? $('#banner_media_tablet').val() : '';
        var banner_media_tablet =  $('#banner_media_mobile').val() ? $('#banner_media_mobile').val() : '';
        var banner_media_mobile = $('#banner_media_mobile').val() ? $('#banner_media_mobile').val() : '';
        var banner_logo = $('#banner_logo').val() ? $('#banner_logo').val() : '';
        var banner_status = $('#banner_status').val();

        AJAX.config.base_url(base_url);
            if (validate.standard('<?= $banner_details; ?>')) {
                modal.standard(confirm_add, function(result) {
                    if (result) {
                        modal.loading(true);
                        AJAX.insert.table("tbl_banner_list");
                        AJAX.insert.params("title", banner_title);
                        AJAX.insert.params("description", banner_description);
                        AJAX.insert.params("button_text", button_text);
                        AJAX.insert.params("button_url", banner_button_url);
                        AJAX.insert.params("navigation_text", banner_navigation_text);
                        AJAX.insert.params("navigation_url", banner_navigation_url);
                        AJAX.insert.params("banner_media_web", banner_media_web);
                        AJAX.insert.params("banner_media_tablet", banner_media_tablet);
                        AJAX.insert.params("banner_media_mobile", banner_media_mobile);
                        AJAX.insert.params("banner_logo", banner_logo);
                        AJAX.insert.params("status", banner_status);
                        AJAX.insert.params("created_by",user_id);
                        AJAX.insert.params("updated_by",user_id);
                        AJAX.insert.params("created_date",moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                        AJAX.insert.params("updated_date",moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                        AJAX.insert.exec(function(result) {
                            modal.loading(false);
                            if (parseInt(result.id) !== 0) {
                                modal.alert(add_success, function() {
                                    location.href = '<?=base_url("content_management/Site_banner");?>';
                                });
                            } else {
                                //add error message
                            }
                        });
                    }
                });
            }
        }); 
</script>