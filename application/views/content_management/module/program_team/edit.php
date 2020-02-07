<div class="box">
	<?php
		$data['buttons'] = ['update','close'];
		$this->load->view("content_management/template/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$id = $this->uri->segment(4);
            $top_details = $this->load->details("tbl_program_teams", $id);
			$inputs = [
                'team_name',
                'status'
            ];

            $values = [
                $top_details[0]->team_name,
                $top_details[0]->status,
            ];

            $top_content = $this->standard->inputs($inputs, $values);
		?>
	</div>
</div>

<script type="text/javascript">
var base_url = '<?=base_url();?>';
var table_id = "<?=  $this->uri->segment(4);?>"
AJAX.config.base_url(base_url);

$(document).on('click', '#btn_update', function(){
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
        
        // form_data["update_date"] = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');

        if(validate.all()){;    
                if((!is_exist('tbl_program_teams', 'team_name', $('#team_name').val(),table_id) != 0)){
                    var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>'; 
                    modal.standard(modal_obj, function(result){
                        if(result){
                            modal.loading(true);

                            AJAX.update.table("tbl_program_teams");
                            AJAX.update.where("id",table_id);
                            $.each(form_data, function(a,b) {
                                AJAX.update.params(a, b);
                            });
                            
                            AJAX.update.exec(function(result){
                                modal.loading(false);
                                modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                                    location.href = '<?=base_url("content_management/site_program_team") ?>';
                                });
                            })
                        }
                    });          
                }
                else{
                    var error_message1 = "<span class='validate_error_message' style='color: red;'>Team Name Exists<br></span>"
                    $('#team_name').css('border-color','red');
                    $(error_message1).insertAfter($('#team_name'));
                }
        }
});


$(document).on('click','#btn_close',function(e){
    location.href = '<?=base_url("content_management/site_program_team") ?>';
});

function is_exist(table, field, value,table_id){
    var query = ""+ field +" = '" + value + "' AND status >=0 AND id != "+table_id+"" ;
    var exists = 0;
    var url = base_url+"content_management/global_controller";
    var data = {
        event : "list", 
        select : ""+field+"",
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
</script>