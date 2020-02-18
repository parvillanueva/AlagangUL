<div class="box">
    <?php
        $data['buttons'] = ['update','close'];
        $this->load->view("content_management/template/buttons",$data);
    ?>
    <form id="submit_form">
	    <div class="box-body">
	        <?php
	            $id = $this->uri->segment(4);
	            $top_details = $this->load->details("tbl_badges", $id);
	            $inputs = [
	                'badge_name',
	                'badge_icon',
	                'badge_image',
	                'badge_color',
	                'badge_required_points',
	                'status'
	            ];

	            $values = [
	                $top_details[0]->name,
	                $top_details[0]->icon_image,
	                $top_details[0]->image,
	                $top_details[0]->color,
	                $top_details[0]->minimum_points,
	                $top_details[0]->status,
	            ];

	            $top_content = $this->standard->inputs($inputs, $values);
	        ?>
	        <input id="id" value="<?= $this->uri->segment(4);?>" name="id" type="hidden">
	    </div>
	</form>
</div>

<script type="text/javascript">
var base_url = '<?=base_url();?>';
var table_id = "<?=  $this->uri->segment(4);?>"
AJAX.config.base_url(base_url);


	$(document).on('click','#btn_update', function(){   
	    if(validate.all()){
            	modal.confirm("Are you sure you want to update this record?", function(result){
					if(result)
					{
                        modal.loading(true);
                        var form = $('#submit_form')[0]; // You need to use standard javascript object here
                        var formData = new FormData(form);
                        $.ajax({
                              url:"<?= base_url('content_management/site_badges/update_data');?>",
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
                                    location.href = '<?=base_url("content_management/site_badges") ?>';
                                });
                              },
                        }); 
					}
				})
	    }
	}); 



$(document).on('click','#btn_close',function(e){
    location.href = '<?=base_url("content_management/site_badges") ?>';
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