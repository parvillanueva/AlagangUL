<div class="box">
	<?php
		$data['buttons'] = ['save','close'];
		$this->load->view("content_management/template/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$inputs = [
                'team_name',
                'status'
            ];
            $top_content = $this->standard->inputs($inputs);
		?>
	</div>
</div>

<script type="text/javascript">
var base_url = '<?=base_url();?>';
var user_id = '<?= $this->session->userdata("sess_uid");?>';
AJAX.config.base_url(base_url);

$(document).on('click', '#btn_save', function(){
        var form_data = {};
        $(':input[class*="_input"]').each(function() {
            var input_id = $(this).attr('id');
            var db_field = $(this).attr('name');

            if ($(this).attr('type') === 'ckeditor') {
                form_data[db_field] = eval("CKEDITOR.instances."+input_id+".getData()");
            } else {
                form_data[db_field] = eval("$('#"+input_id+"').val()");
            }
        });

        form_data["created_by"]  = user_id;
        form_data["create_date"] = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');
        form_data["update_date"] = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');

        if(validate.all()){
            if(!is_exists('tbl_program_teams', 'team_name', $('#team_name').val(), 'status') != 0){
              var modal_obj = '<?= $this->standard->confirm("confirm_save"); ?>'; 
                modal.standard(modal_obj, function(result){
                    if(result){
                        modal.loading(true);

                        AJAX.insert.table("tbl_program_teams");
                        $.each(form_data, function(a,b) {
                            AJAX.insert.params(a, b);
                        });

                        AJAX.insert.exec(function(result){
                            modal.loading(false);
                            modal.alert("<?= $this->standard->dialog("add_success"); ?>", function(){
                                location.href = '<?=base_url("content_management/site_program_team") ?>';
                            });
                        })
                    }
                });
            }
            else{
                    var error_message2 = "<span class='validate_error_message' style='color: red;'>Team Name Exists<br></span>"
                    $('#team_name').css('border-color','red');
                    $(error_message2).insertAfter($('#team_name'));
            }
        }
});

</script>
