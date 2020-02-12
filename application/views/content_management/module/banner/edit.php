<div class="box">
    <?php
        $this->load->view("content_management/template/buttons", $buttons);
    ?> 
 	<div class="box-body">
        <?php
            $banner_details =  $this->load->details("tbl_banner_list", $id);
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
            $values = [
                $banner_details[0]->title,
                $banner_details[0]->description,
                $banner_details[0]->banner_media_web,
                $banner_details[0]->banner_media_tablet,
                $banner_details[0]->banner_media_mobile,
                $banner_details[0]->banner_logo,
                $banner_details[0]->button_url,
                $banner_details[0]->button_text,
                $banner_details[0]->navigation_text,
                $banner_details[0]->navigation_url,
                $banner_details[0]->status,

            ];
            $banners = $this->standard->inputs($inputs, $values);
        ?> 
    </div>
</div>

<script type="text/javascript">

function update_date(){
    var id = '<?=$id;?>';
    var user_id = '<?=$this->session->userdata("sess_uid");?>';
    var confirm_update = '<?= $this->standard->confirm("confirm_update"); ?>'; 
    var success_update_message = '<?= $this->standard->dialog("update_success"); ?>'; 

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
        if (validate.standard('<?=$banners;?>')) {
       
            modal.standard(confirm_update, function(result) {
                if (result) {
                    modal.loading(true);
                    AJAX.update.table("tbl_banner_list");
                    AJAX.update.params("title", banner_title);
                    AJAX.update.params("description", banner_description);
                    AJAX.update.params("button_text", button_text);
                    AJAX.update.params("button_url", banner_button_url);
                    AJAX.update.params("navigation_text", banner_navigation_text);
                    AJAX.update.params("navigation_url", banner_navigation_url);
                    AJAX.update.params("banner_media_web", banner_media_web);
                    AJAX.update.params("banner_media_tablet", banner_media_tablet);
                    AJAX.update.params("banner_media_mobile", banner_media_mobile);
                    AJAX.update.params("banner_logo", banner_logo);
                    AJAX.update.params("status", banner_status);
                    AJAX.update.params("updated_by",user_id);
                    AJAX.update.params("updated_date",moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));  
                    AJAX.update.where("id", id);                     

                    AJAX.update.exec(function(result) {
                        modal.loading(false);
                        if (result.message === "success") {
                            modal.alert(success_update_message, function() {
                                location.href = '<?=base_url("content_management/Site_banner");?>';
                            });
                        } else {
                           // modal.alert(failed_transaction_message, function() {
                           // });
                        }
                    });
                }
            });
        }
}

$(document).on('click', '#btn_save', function() {
    update_date();
});
</script>
