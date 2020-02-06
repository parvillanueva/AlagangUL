<div class="box">
	<?php
		$data['buttons'] = ['save','close'];
		$this->load->view("content_management/template/buttons",$data);
	?>
    <form id="submit_form">
    	<div class="box-body">
    		<?php
    			$inputs = [
                    'reward_name',
                    'reward_image',
                    'reward_description',
                    'reward_points_needed',
                    'reward_rating',
                    'category_select',
                    'initial_stock',
                    'status'
                ];
                $top_content = $this->standard->inputs($inputs);
    		?>
    	</div>
    </form>
</div>

<script type="text/javascript">
var base_url = '<?=base_url();?>';
var user_id = '<?= $this->session->userdata("sess_uid");?>';
AJAX.config.base_url(base_url);

$(document).ready(function(){
    get_category();
})


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

        form_data["create_by"]  = user_id;
        form_data["update_by"]  = user_id;
        form_data["create_date"] = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');
        form_data["update_date"] = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');

        if(validate.all()){
            $('#reward_name').css('border-color','');
            $('.validate_error_message').remove();
            if(!is_exists('tbl_reward_products', 'reward_name', $('#reward_name').val(), 'status') != 0){
                    if(validate.all()){
                            var modal_obj = '<?= $this->standard->confirm("confirm_save"); ?>'; 
                            modal.standard(modal_obj, function(result){
                                if(result){
                                    modal.loading(true);
                                    var form = $('#submit_form')[0]; // You need to use standard javascript object here
                                    var formData = new FormData(form);
                                    $.ajax({
                                          url:"<?= base_url('content_management/site_reward_products/insert');?>",
                                          type:"POST",
                                          dataType:"json",
                                          processData: false,
                                          contentType: false,
                                          data:formData,
                                          beforeSend: function() {
                                          modal.loading(true);
                                          },
                                          success: function(data) {
                                          },
                                          complete: function(data) {
                                            modal.loading(false);
                                            modal.alert("<?= $this->standard->dialog("add_success"); ?>", function(){
                                                location.href = '<?=base_url("content_management/site_reward_products") ?>';
                                            });
                                          },
                                    }); 
                                }
                            });
                    }   
            }
            else{
                    var error_message2 = "<span class='validate_error_message' style='color: red;'>Reward Exists<br></span>"
                    $('#reward_name').css('border-color','red');
                    $(error_message2).insertAfter($('#reward_name'));
            }
        }
});


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
                var obj = result.responseJSON; //check if result is valid JSON format, Format to JSON if not
                console.log(obj)
                html += '<option disabled selected>Choose Category</option>'
                $.each(obj, function(x,y){
                    html += '<option value="'+y.id+'">'+y.name.toUpperCase()+'</option>';
                });

                $('.category_id').html(html);
              },
        }); 
    }

</script>
