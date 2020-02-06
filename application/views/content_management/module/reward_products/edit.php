<div class="box">
	<?php
		$data['buttons'] = ['update','close'];
		$this->load->view("content_management/template/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$id = $this->uri->segment(4);
            $top_details = $this->load->details("tbl_reward_products", $id);
			$inputs = [
                'reward_name',
                'reward_image',
                'reward_description',
                'reward_points_needed',
                'reward_rating',
                'category_select',
                'status'
            ];

            $values = [
                $top_details[0]->reward_name,
                $top_details[0]->reward_image,
                $top_details[0]->reward_description,
                $top_details[0]->points_needed,
                $top_details[0]->reward_rating,
                '',
                $top_details[0]->status
            ];

            $top_content = $this->standard->inputs($inputs, $values);
		?>
	</div>
</div>

<script type="text/javascript">
var base_url = '<?=base_url();?>';
var table_id = "<?=  $this->uri->segment(4);?>"
var category_table_id = "<?=$top_details[0]->category_id?>";
AJAX.config.base_url(base_url);

$(document).ready(function(){
    get_category();
})

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
                if((!is_exist('tbl_reward_products', 'reward_name', $('#reward_name').val(),table_id) != 0)){
                    var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>'; 
                    modal.standard(modal_obj, function(result){
                        if(result){
                            modal.loading(true);

                            AJAX.update.table("tbl_reward_products");
                            AJAX.update.where("id",table_id);
                            $.each(form_data, function(a,b) {
                                AJAX.update.params(a, b);
                            });
                            
                            AJAX.update.exec(function(result){
                                modal.loading(false);
                                modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                                    location.href = '<?=base_url("content_management/site_reward_products") ?>';
                                });
                            })
                        }
                    });          
                }
                else{
                    var error_message1 = "<span class='validate_error_message' style='color: red;'>Reward Exists<br></span>"
                    $('#reward_name').css('border-color','red');
                    $(error_message1).insertAfter($('#reward_name'));
                }
        }
});


$(document).on('click','#btn_close',function(e){
    location.href = '<?=base_url("content_management/site_reward_products") ?>';
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

function get_category(){
    $.ajax({
          url : "<?= base_url("content_management/site_reward_products/get_category");?>",
          type:"POST",
          dataType:"json",
          processData: false,
          contentType: false,
          data:{},
          beforeSend: function() {
          // modal.loading(true);
          },
          success: function(data) {
          },
          complete: function(result) {
            var html = '';
            var obj = result.responseJSON; //check if result is valid JSON format, Format to JSON if 
            // console.log(category_table_id);
            var selected = '';
            // alert(category_table_id);
                // cosno
            html += '<option disabled selected>Choose Category</option>'
            $.each(obj, function(x,y){
                    if(category_table_id == y.id){
                        selected = "selected"
                        html += '<option value="'+y.id+'" '+selected+' >'+y.name.toUpperCase()+'</option>';
                    }else{

                        selected = '';
                        html += '<option value="'+y.id+'" '+selected+'>'+y.name.toUpperCase()+'</option>';
                    }
            });

            $('.category_id').html(html);
          },
    }); 
}
</script>