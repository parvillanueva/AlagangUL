<div class="box">
	<?php
		$data['buttons'] = ['save','close'];
		$this->load->view("content_management/template/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$inputs = [
                'domain',
            ];
            $top_content = $this->standard->inputs($inputs);
		?>
	</div>
</div>

<script type="text/javascript">
var base_url = '<?=base_url();?>';
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

        // form_data["orders"] = 1;
        // form_data["create_date"] = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');
        // form_data["update_date"] = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');

        if(validate.all()){
            // var pattern = /^[a-zA-Z\-]{3,}(\.(com|net))?$/;
                var domain = $('#domain').val();
                var re = /^(?!(https:\/\/|http:\/\/|www\.|mailto:|smtp:|ftp:\/\/|ftps:\/\/))(((([a-zA-Z0-9])|([a-zA-Z0-9][a-zA-Z0-9\-]{0,86}[a-zA-Z0-9]))\.(([a-zA-Z0-9])|([a-zA-Z0-9][a-zA-Z0-9\-]{0,73}[a-zA-Z0-9]))\.(([a-zA-Z0-9]{2,12}\.[a-zA-Z0-9]{2,12})|([a-zA-Z0-9]{2,25})))|((([a-zA-Z0-9])|([a-zA-Z0-9][a-zA-Z0-9\-]{0,162}[a-zA-Z0-9]))\.(([a-zA-Z0-9]{2,12}\.[a-zA-Z0-9]{2,12})|([a-zA-Z0-9]{2,25}))))$/g;

                var domainFormat = re.test(domain);// this return result in boolean type

                if (domainFormat) {
                    if(!is_exists('tbl_email_domain_whitelist', 'domain', $('#domain').val()) != 0){
                      var modal_obj = '<?= $this->standard->confirm("confirm_save"); ?>'; 
                        modal.standard(modal_obj, function(result){
                            if(result){
                                modal.loading(true);

                                AJAX.insert.table("tbl_email_domain_whitelist");
                                $.each(form_data, function(a,b) {
                                    AJAX.insert.params(a, b);
                                });

                                AJAX.insert.exec(function(result){
                                    modal.loading(false);
                                    modal.alert("<?= $this->standard->dialog("add_success"); ?>", function(){
                                        location.href = '<?=base_url("content_management/site_domain_whitelist") ?>';
                                    });
                                })
                            }
                        });
                    }
                    else{
                        var error_message2 = "<span class='validate_error_message' style='color: red;'>Domain Exists<br></span>"
                        $('#domain').css('border-color','red');
                        $(error_message2).insertAfter($('#domain'));
                    }
                }
                else{
                    var error_message2 = "<span class='validate_error_message' style='color: red;'>Invalid Domain<br></span>"
                    $('#domain').css('border-color','red');
                    $(error_message2).insertAfter($('#domain'));
                }
        }
});



function is_exists(table, field, value){
    var query = ""+ field +" = '" + value + "'";
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
</script>
