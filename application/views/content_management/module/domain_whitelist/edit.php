<div class="box">
	<?php
		$data['buttons'] = ['update','close'];
		$this->load->view("content_management/template/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$id = $this->uri->segment(4);
            $top_details = $this->load->details("tbl_email_domain_whitelist", $id);
			$inputs = [
                'domain',
            ];

            $values = [
                $top_details[0]->domain,
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

        if(validate.all()){
                var domain = $('#domain').val();
                var re = /^(?!(https:\/\/|http:\/\/|www\.|mailto:|smtp:|ftp:\/\/|ftps:\/\/))(((([a-zA-Z0-9])|([a-zA-Z0-9][a-zA-Z0-9\-]{0,86}[a-zA-Z0-9]))\.(([a-zA-Z0-9])|([a-zA-Z0-9][a-zA-Z0-9\-]{0,73}[a-zA-Z0-9]))\.(([a-zA-Z0-9]{2,12}\.[a-zA-Z0-9]{2,12})|([a-zA-Z0-9]{2,25})))|((([a-zA-Z0-9])|([a-zA-Z0-9][a-zA-Z0-9\-]{0,162}[a-zA-Z0-9]))\.(([a-zA-Z0-9]{2,12}\.[a-zA-Z0-9]{2,12})|([a-zA-Z0-9]{2,25}))))$/g;

                var domainFormat = re.test(domain);

            if (domainFormat) {
                if((!is_exist('tbl_email_domain_whitelist', 'domain', $('#domain').val(),table_id) != 0)){
                    var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>'; 
                    modal.standard(modal_obj, function(result){
                        if(result){
                            modal.loading(true);

                            AJAX.update.table("tbl_email_domain_whitelist");
                            AJAX.update.where("id",table_id);
                            $.each(form_data, function(a,b) {
                                AJAX.update.params(a, b);
                            });
                            
                            AJAX.update.exec(function(result){
                                modal.loading(false);
                                modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                                    location.href = '<?=base_url("content_management/site_domain_whitelist") ?>';
                                });
                            })
                        }
                    });          
                }
                else{
                    var error_message1 = "<span class='validate_error_message' style='color: red;'>Domain Already Exist<br></span>"
                    $('#domain').css('border-color','red');
                    $(error_message1).insertAfter($('#domain'));
                }
            }
            else{
                var error_message2 = "<span class='validate_error_message' style='color: red;'>Invalid Domain<br></span>"
                $('#domain').css('border-color','red');
                $(error_message2).insertAfter($('#domain'));
            }
        }
});


$(document).on('click','#btn_close',function(e){
    location.href = '<?=base_url("content_management/site_domain_whitelist") ?>';
});
function is_exist(table, field, value,table_id){
    var query = ""+ field +" = '" + value + "' AND id != "+table_id+"" ;
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