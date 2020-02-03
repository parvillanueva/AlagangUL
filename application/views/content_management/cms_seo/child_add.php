<div class="box">
    <?php $data["buttons"] = ["save","close"]; ?>
    <?php $this->load->view("content_management/template/buttons", $data); ?>

    <div class="box-body">
        <div class="form-group">
            <label class="control-label meta_url_label col-sm-2">Meta Url<span style="color: red;">*</span> :</label>
            <div class = "col-sm-10">
                <div class="input-group ">
                    <span class="input-group-addon" id="basic-addon3" ><?=base_url().$fixed_url;?></span>
                    <input type="text" name="meta_url" value="" class="form-control meta_url_input required_input" data-url="url" id="meta_url" maxlength="255" placeholder="Meta Url" label="Meta Url">
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- <div class="form-group">
            <label class="control-label col-sm-2">Meta Tags</label>
            <div class="col-sm-10">
                <select type = "dropdown" class="form-control required_input" id = "metaparent" >
                    <option value = "main">Main Menu</option>
                <?php
                    foreach ($metatags as $key => $value) {
                ?>
                    <option value="<?=$value->id?>"><?=$value->meta_title?></option>
                <?php }
                ?>
                </select>
            </div>
            <div class="clearfix"></div>
        </div> -->
        <?php
            $inputs = [
                // 'meta_url',
                'meta_title',
                'meta_description',
                'meta_keyword',
                'meta_image',
                'status',

            ];

            $this->standard->inputs($inputs);
        ?>

        <div class="form-group div_type">
            <label class="col-sm-2 control-label">Type</label>
            <div class="col-sm-10">
                <select class="form-control menu_type required_input">
                    <option selected disabled>Select..</option>
                    <option value = '1'>Parent</option>
                    <option value = '2'>Child</option>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php
            $inputs = [
                'asc_ref',   
            ];

            $this->standard->inputs($inputs);
        ?>
    </div>
</div> 

<script type="text/javascript">
    var parent_id = "<?=$menu_id;?>";
    var level = '<?=$menu_level;?>';
    var fixed_url = '<?=$fixed_url."/";?>';
     $(document).on('click', '#btn_save', function(){   
        // var alias = $('#title').val().replace(/[, !]+/g,"-").toLowerCase();
       if(validate.standard()){
            if(is_exists('cms_metatags', 'meta_url', fixed_url+$('#meta_url').val(), 'meta_status') != 0){
                var error_message = "<span class='validate_error_message' style='color: red;'>The information already exists.<br></span>";
                $('#meta_url').css('border-color','red');
                $(error_message).insertAfter($('#meta_url'));
            }else{
                var modal_obj = '<?= $this->standard->confirm("confirm_add"); ?>'; 
                modal.standard(modal_obj, function(result){
                   
                    if(result){
                        modal.loading(true);
                        var url = "<?= base_url('content_management/global_controller');?>"; 
                        var data = {
                            event : "insert",
                            table : "cms_metatags", 
                            field : "id", 
                            data : {
                                    meta_parent_id:parent_id,
                                    meta_url : fixed_url+$('#meta_url').val(),
                                    meta_title : $('#meta_title').val(),
                                    meta_description : $('#meta_description').val(),
                                    meta_keyword : $('#meta_keyword').val(),
                                    meta_image : $('#meta_img').val(),
                                    meta_status : $('#status').val(),
                                    meta_type:$('.menu_type').val(),
                                    meta_level:parseInt(level)+1,
                                    asc_ref_code : $('#asc_ref').val(),
                                    meta_created_date :  moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),

                           }  
                        }

                        aJax.post(url,data,function(result){
                            modal.loading(false);
                            modal.alert("<?= $this->standard->dialog("add_success"); ?>", function(){
                                location.href = '<?=base_url("content_management/site_meta/child/").$menu_id."/".$menu_group;?>';
                            });
                        })
                    }
                });
            }
        }
    }); 

     $(document).on('click', '#btn_close', function(e){
        location.href = '<?=base_url("content_management/site_meta/child/").$menu_id."/".$menu_group;?>';
    });

</script>