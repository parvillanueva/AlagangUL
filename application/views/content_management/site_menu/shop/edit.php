<div class="box">
        <?php   
            $data['buttons'] = ['update','close'];
            $this->load->view("content_management/template/buttons", $data);
        ?>  
        <div class="box-body">   
            <div class="form-horizontal">
                <?php
                	$shop_id = $this->uri->segment(4);
            		$shop = $this->load->details("site_shop_now", $shop_id);

                    $inputs = [
                        'redirect_url',
                        'image_banner',
                    ];

                    $values = [
                		$shop[0]->url,
                		$shop[0]->img_banner
            		];

                    $input_content = $this->standard->inputs($inputs, $values);
                ?>
            </div>
        </div>
 </div>

<script type="text/javascript">
    $('.redirect_url').addClass('required_input');

    function update_data() {
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "update",
            table : "site_shop_now",
            field : "id",
			where : "<?=$shop_id?>",
            data : {
                url : $('#redirect_url').val(),
                img_banner : $('#image_banner').val(),
                update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
            }
        }

        aJax.post_async(url,data,function(result){
            var obj = is_json(result);
            modal.loading(true);
            modal.loading(false);
            modal.alert("<?= $this->standard->dialog("update_success"); ?>",function(){
                location.href = '<?=base_url("content_management/site_menu/menu/"); ?>';
            });
        });
    }

    $(document).on('click', '#btn_update', function(){
	    if (validate.standard("<?= $input_content; ?>")) {
	       modal.confirm("Are you sure you want to update this record?",function(result){
	            if(result){
	            	update_data();
	            }
	        });     
	    }
    });

    $(document).on('click', '#btn_close', function(e) {
        e.preventDefault();
        location.href = '<?=base_url("content_management/site_menu/menu");?>';
    });
</script>