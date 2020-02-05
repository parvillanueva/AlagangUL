<div class="box">
 <?php $data["buttons"] = ["save","close"]; ?>
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">
        <div class="form-group">
            <label class="control-label meta_url_label col-sm-2">Meta Url<span style="color: red;">*</span> :</label>
            <div class = "col-sm-10">
                <div class="input-group ">
                    <span class="input-group-addon" id="basic_addon3" ><?=base_url();?></span>
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
                // 'status',

            ];

            $id1 = $this->standard->inputs($inputs);
        ?>
        <!-- <div class="form-group div_meta">
            <label class="control-label col-sm-2">Meta Type</label>
            <div class="col-sm-10">
                <select class="form-control og-type">
                    <option selected disabled>Select..</option>
                    <option value="article">article</option>
                    <option value="book">book</option>
                    <option value="books.author">books.author</option>
                    <option value="books.book">books.book</option>
                    <option value="books.genre">books.genre</option>
                    <option value="business.business">business.business</option>
                    <option value="fitness.course">fitness.course</option>
                    <option value="game.achievement">game.achievement</option>
                    <option value="music.album">music.album</option>
                    <option value="music.playlist">music.playlist</option>
                    <option value="music.radio_station">music.radio_station</option>
                    <option value="music.song">music.song</option>
                    <option value="place">place</option>
                    <option value="product">product</option>
                    <option value="product.group">product.group</option>
                    <option value="product.item">product.item</option>
                    <option value="profile">profile</option>
                    <option value="restaurant.menu">restaurant.menu</option>
                    <option value="restaurant.menu_item">restaurant.menu_item</option>
                    <option value="restaurant.menu_section">restaurant.menu_section</option>
                    <option value="restaurant.restaurant">restaurant.restaurant</option>
                    <option value="video.episode">video.episode</option>
                    <option value="video.movie">video.movie</option>
                    <option value="video.other">video.other</option>
                    <option value="video.tv_show">video.tv_show</option>
                </select>
            </div>
            <div class="clearfix"></div>
        </div> -->
      

        <!-- <div class="form-group div_type">
            <label class="col-sm-2 control-label">Type</label>
            <div class="col-sm-10">
                <select id="menu_type" class="form-control menu_type required_input">
                    <option value = '0' selected disabled>Select..</option>
                    <option value = '1'>Parent</option>
                    <option value = '2'>Child</option>
                </select>
            </div>       
            <div class="clearfix"></div>     
        </div> -->

        <?php
            $inputs = [
                'link_type',
                'asc_ref',   
            ];

            $id2 = $this->standard->inputs($inputs);
        ?>
        


   
    </div>

    

</div> 

<script type="text/javascript">

     $(document).on('click', '#btn_save', function(){   
        // var alias = $('#title').val().replace(/[, !]+/g,"-").toLowerCase();
       if(validate.standard('<?= $id1; ?>') && validate.standard('<?= $id2; ?>')){

            if(is_exists('cms_metatags', 'meta_url', $('#meta_url').val(), 'meta_status') != 0){
                var error_message = "<span class='validate_error_message' style='color: red;'>The information already exists.<br></span>";
                $('#meta_url').css('border-color','red');
                $('#meta_url').parent().parent().append(error_message);
                // $(error_message).insertAfter();
            }else if($('#meta_url').val().trim() == ''){
                var error_message = "<span class='validate_error_message' style='color: red;'>This field is required.<br></span>";
                $('#meta_url').css('border-color','red');
                $('#meta_url').parent().parent().append(error_message);
            }else{

                var modal_obj = '<?= $this->standard->confirm("confirm_add"); ?>'; 
                modal.standard(modal_obj, function(result){
                   
                    if(result){
                        modal.loading(true);
                        var url = "<?= base_url('content_management/global_controller');?>"; 
                        var data = {
                            event : "insert",
                            table : "cms_metatags", 
                            data : {
                                    meta_parent_id:'',
                                    meta_url : $('#meta_url').val(),
                                    meta_title : $('#meta_title').val(),
                                    meta_description : $('#meta_description').val(),
                                    meta_keyword : $('#meta_keyword').val(),
                                    meta_image : $('#meta_img').val(),
                                    meta_status : 1,
                                    meta_type : $('.menu_type').val(),
                                    meta_level : 1,
                                    asc_ref_code : $('#asc_ref').val(),
                                    meta_created_date :  moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),

                           }  
                        }

                        aJax.post(url,data,function(result){
                            modal.loading(false);
                            modal.alert("<?= $this->standard->dialog("add_success"); ?>", function(){
                                <?php 
                                    $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                                    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

                                    $urls = explode('/', $escaped_url);
                                    array_pop($urls);
                                ?>
            
                                location.href = "<?= implode('/', $urls);?>";
                            });
                        })
                    }
                });

            }

        }
    }); 

    $(document).on('click', '#btn_close', function(e){
        location.href = '<?=base_url("content_management/site_meta");?>';
    });

</script>