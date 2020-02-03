<div class="box">
    <?php $data["buttons"] = ["update","close"]; ?>
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">
        <?php
            $id = $this->uri->segment(4);
            $details = $this->load->details("site_promo_campaign",$id);
            $inputs = [
                'url',
                'banner',
                'date_start',
                'date_end',
                'status'
            ];

            $values = [
                $details[0]->redirect_url,
                $details[0]->img_banner,
                $details[0]->start_date,
                $details[0]->end_date,
                $details[0]->status
            ];
            
            $content_id = $this->standard->inputs($inputs, $values);

        ?>

    </div>
</div> 


<script type="text/javascript">


   <?php 
        $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

        $urls = explode('/', $escaped_url);
        array_pop($urls);
        array_pop($urls);
    ?>


    $(document).on('click', '#btn_update', function(){     
       if(validate.standard("<?= $content_id; ?>")){
            var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>'; 
            modal.standard(modal_obj, function(result){
                if(result){
                    modal.loading(true);
                    var url = "<?= base_url('content_management/global_controller');?>"; 
                    var data = {
                        event : "update",
                        table : "site_promo_campaign", 
                        field : "id", 
                        where : 1, 
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
                        modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                            location.reload();
                        });
                    });
                }
            });
        }
    }); 



    $(document).on('click', '#btn_close', function(e){
        location.href = "<?= implode('/', $urls);?>";
    });

</script>