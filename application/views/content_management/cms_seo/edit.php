    <div class="box">
         <?php $data["buttons"] = ["update","close"]; ?>
        <?php $this->load->view("content_management/template/buttons", $data); ?>

        <div class="box-body">
            <div class="form-group">
                <label class="control-label meta_url_label col-sm-2">Meta Url<span style="color: red;">*</span> :</label>
                <div class = "col-sm-10">
                    <div class="input-group ">
                        <span class="input-group-addon" id="basic-addon3" ><?=base_url().$fixed_url;?></span>
                        <input type="text" name="meta_url" value="<?=$this->uri->segment(5);?>" class="form-control meta_url_input required_input" data-url="url" id="meta_url" maxlength="255" placeholder="Meta Url" label="Meta Url">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
         <?php
                $inputs = [
                    // 'meta_url',
                    'meta_title',
                    'meta_description',
                    'meta_keyword',
                    'meta_image',
                    // 'status',

                ];
                $values = [
                    // $details[0]->meta_url,
                    $details[0]->meta_title,
                    $details[0]->meta_description,     
                    $details[0]->meta_keyword,
                    $details[0]->meta_image,
                    // $details[0]->meta_status,      
                ];
                $id1 = $this->standard->inputs($inputs, $values);
            ?>
     
            <div class="form-group div_type">
                <label class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select class="form-control menu_type ">
                        <option value = '1' <?=($details[0]->meta_type == 1) ? "selected" : "";?>>Parent</option>
                        <option value = '2' <?=($details[0]->meta_type == 2) ? "selected" : "";?>>Child</option>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group parent-menu">
                <label class="control-label col-sm-2">Parent Meta Tags</label>
                <div class="col-sm-10">
                    <select class="form-control" id = "meta_parent">
                        <option value = "" data-level = '0' data-url = '' selected>Main Menu</option>
                    <?php
                        foreach ($metatags as $key => $value) {
                    ?>
                        <option value="<?=$value->id?>" data-level = "<?=$value->meta_level?>" <?=($details[0]->meta_parent_id == $value->id) ? "selected" : "";?> data-url = "<?=$value->meta_url;?>/">
                            <?=$value->meta_url?>
                        </option>
                    <?php }
                    ?>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>

            <?php
                $inputs = [
                    'asc_ref',
                ];
                $values = [
                    $details[0]->asc_ref_code,   
                ];
                $id2 = $this->standard->inputs($inputs, $values);
            ?>
        </div>
    </div> 

    <script type="text/javascript">
        $('.og-type option[value="<?=$details[0]->og_type?>"]').prop("selected", true);
        var old_title = $('#meta_url').val();
        var level = "<?=$details[0]->meta_level;?>";
        var type = "<?=$details[0]->meta_type;?>";
        var fixed_url = "<?=$fixed_url;?>";
        // $(document).ready(function(){
        //     if(level == 1 && type == 1)
        //     {
        //         $('#meta_parent').removeClass('form-control');
        //         $('.menu_type').removeClass('form-control');
        //         $('.div_type').css('display','none');
        //         $('.parent-menu').css('display','none');
        //     }
        // });

        <?php 
            $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
            $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

            $urls = explode('/', $escaped_url);
            array_pop($urls);
            array_pop($urls);
        ?>

        var current_url = "<?= $url;?>";

        $(document).on('click', '#btn_update', function(){   
            if(validate.standard('<?= $id1; ?>') && validate.standard('<?= $id2; ?>')){
                if(old_title == fixed_url+$('#meta_url').val()){
                    update_data();
                }else{
                    if(is_exists('cms_metatags', 'meta_url', fixed_url+$('#meta_url').val(), 'meta_status') != 0){
                        var error_message = "<span class='validate_error_message' style='color: red;'>The information already exists.<br></span>";
                        $('#meta_url').css('border-color','red');
                        $('#meta_url').parent().parent().append(error_message)
                    }else if($('#meta_url').val().trim() == ''){
                        var error_message = "<span class='validate_error_message' style='color: red;'>This field is required.<br></span>";
                        $('#meta_url').css('border-color','red');
                        $('#meta_url').parent().parent().append(error_message);
                    }else{
                        update_data();
                    }
                }
            }
        }); 

        $(document).on('click', '#btn_close', function(e){
            location.href = '<?=base_url("content_management/site_meta");?>';
        });

        $(document).on('change','#meta_parent',function(){
            fixed_url = $(this).find(':selected').attr('data-url');
        });

        function update_data(){
            var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>'; 
            modal.standard(modal_obj, function(result){
                
                meta_level = $('#meta_parent').find(':selected').attr('data-level');
                if(result){
                    data ={
                            meta_parent_id : $('#meta_parent').val(),
                            meta_url : fixed_url+$('#meta_url').val(),
                            meta_title : $('#meta_title').val(),
                            meta_description : $('#meta_description').val(),
                            meta_keyword : $('#meta_keyword').val(),
                            meta_image : $('#meta_img').val(),
                            meta_status : $('#status').val(),
                            // og_type : $('.og-type').val(),
                            meta_level : parseInt(meta_level)+1,
                            meta_type : $('.menu_type').val(),
                            asc_ref_code : $('#asc_ref').val(),
                            meta_updated_date :  moment(new Date()).format('YYYY-MM-DD HH:mm:ss')};

                    modal.loading(true);
                    var url = "<?= base_url('content_management/global_controller');?>"; 
                    var data = {
                        event : "update",
                        table : "cms_metatags", 
                        field : "id", 
                        where : "<?= $this->uri->segment(4);?>", 
                        data
                    }

                    aJax.post(url,data,function(result){
                        var obj = is_json(result);
                        if(obj == "success"){
                            var url = "<?= base_url('content_management/site_meta/update_meta_level/').$this->uri->segment(4).'/';?>"+meta_level; 
                            var data = {
                                table   : "cms_metatags", 
                                url     : fixed_url
                            }
                            // +$('#meta_url').val()
                            aJax.post(url,data,function(result){
                                modal.loading(false);
                                modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                                    location.href = '<?=base_url("content_management/site_meta");?>';
                                });
                            });
                        }
                    });
                 }
            });
        }

        $(document).on('change','.menu_type',function(){
            has_under = '<?=count($hasUnder);?>';
            if(has_under != 0)
            {
                modal.alert("<?= $this->standard->dialog("hasUnder"); ?>", function(){
                    $('.menu_type option[value="1"]').prop("selected", true);
                });
            }
        });

    </script>