<div class="box">
        <?php   
            $data['buttons'] = ['save','close'];
            $this->load->view("content_management/template/buttons", $data);
        ?>  
        <div class="box-body">   
            <div class="form-horizontal">
                <?php
                    $inputs = [
                        'redirect_url',
                        'image_banner',
                    ];

                    $input_content = $this->standard->inputs($inputs);
                ?>
            </div>
        </div>
 </div>

<script type="text/javascript">
    
    function save_data() {
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "insert",
            table : "site_shop_now",
            data : {
                url : $('#redirect_url').val(),
                img_banner : $('#image_banner').val(),
                status: 1,
                create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
            }
        }

        aJax.post_async(url,data,function(result){
            var obj = is_json(result);
            modal.loading(true);
            modal.loading(false);
            modal.alert("<?= $this->standard->dialog("add_success"); ?>",function(){
                location.href = '<?=base_url("content_management/site_menu/menu/"); ?>';
            });
        });
    }

    $(document).on('click', '#btn_save', function(){
        if (validate.standard("<?= $input_content; ?>")) {
            modal.confirm("Are you sure you want to save this record?",function(result){
                if(result){  
                    save_data();
                }
            });
        }
    });

    $(document).on('click', '#btn_close', function(e) {
        location.href = '<?=base_url("content_management/site_menu/menu");?>';
    });
</script>