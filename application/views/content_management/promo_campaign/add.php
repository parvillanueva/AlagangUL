<div class="box">
    <?php $data["buttons"] = ["save","close"]; ?>
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">
        <?php
            $inputs = [
                'url',
                'banner',
                'date_start',
                'date_end',
                'status'
            ];


            $content_id = $this->standard->inputs($inputs);

        ?>

    </div>
</div> 


<script type="text/javascript">
    <?php 
        $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

        $urls = explode('/', $escaped_url);
        array_pop($urls);
    ?>

    var current_url = "<?= $url;?>";

    $(document).on('click', '#btn_save', function(){     
       if(validate.standard("<?= $content_id; ?>")){
            var modal_obj = '<?= $this->standard->confirm("confirm_add"); ?>'; 
            modal.standard(modal_obj, function(result){
                if(result){
                    modal.loading(true);
                    var url = "<?= base_url('content_management/global_controller');?>"; 
                    var data = {
                        event : "insert",
                        table : "site_promo_campaign", 
                        data : {
                                redirect_url : $('#url').val(),
                                img_banner : $('#banner_img').val(),
                                start_date : $('#date_start').val(),
                                end_date :  $('#date_end').val(),
                                status : $('#status').val(),
                                create_date :  moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                                update_date :  moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                       }  
                    }
                    aJax.post(url,data,function(result){
                        modal.loading(false);
                        modal.alert("<?= $this->standard->dialog("add_success"); ?>", function(){
                            location.href = "<?= implode('/', $urls);?>";
                        });
                    });
                }
            });
        }
    }); 

</script>