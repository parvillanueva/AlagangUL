<div class="box">
        <?php   
            $data['buttons'] = ['save','close']; // add, save, update
            $this->load->view("content_management/template/buttons", $data);
        ?>  
        <div class="box-body">   
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Menu Name</label>
                    <div class="col-sm-5">
                        <input id="menu_name" class="form-control required" placeholder="Menu Name">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-5 ">
                        <select id="status" class="form-control required">
                            <option value="" selected disabled>Select..</option>
                            <option value=1>Active</option>
                            <option value=0>Inactive</option>
                        </select>
                    </div>
                </div> -->
                <div class="form-group div_type">
                    <label class="col-sm-2 control-label">Type</label>
                    <div class="col-sm-5">
                        <select class="form-control menu_type required">
                            <option selected disabled>Select..</option>
                            <option value='Module' >Module</option>
                            <option value='Url' >Url</option>
                            <option value='Group Menu'>Group Menu</option>
                            <option value='Buy Now'>Buy Now</option>
                        </select>
                    </div>
                     <div id="buy_now_add" class="buy_now_add_btn" style="display: none;"><span class="fa fa fa-plus "></span></div>
                </div>

                <div class="form-group div_default">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-md-5 checkbox">
                        <label><input id="default" type="checkbox" value="">Set as Default</label>
                    </div>
                </div>
                <div class="buy_now_container" style="display: none;">

                    <?php
                        $inputs = [
                            'redirect_url',
                            'image_banner',
                        ];

                        $buy_now_content = $this->standard->inputs($inputs);
                    ?>

                </div>
                <!-- <div class="form-group div_meta">
                    <label class="col-sm-2 control-label">Meta Keywords</label>
                    <div class="col-sm-7">
                        <textarea id="keyword" class="text form-control" rows="10" placeholder=""></textarea>
                    </div>
                </div>
                <div class="form-group div_meta">
                    <label class="col-sm-2 control-label">Meta Description</label>
                    <div class="col-sm-7">
                        <textarea id="description" class="text form-control" rows="10" placeholder=""></textarea>
                    </div>
                </div>
                <hr>
            <div class="form-group div_meta">
                <label class="control-label col-sm-2">OG Type</label>
                <div class="col-sm-5">
                    <select class="form-control og-type">
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
            </div>
            <div class="form-group div_meta">
                <label class="control-label col-sm-2">OG Title</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control og-title" rows="5">
                </div>
            </div>
            <div class="form-group div_meta">
                <label class="control-label col-sm-2">OG Image</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input class="form-control og-img" readonly value="" id="og_image_img" required>
                        <input type="hidden" id="og_image_alt">
                        <span class="input-group-btn ">
                            <button type="button" class="btn btn-primary open_filemanager" data-id="og_image">Open File Manager</button>
                        </span>
                    </div>
                    <small><strong>Note:</strong> Acceptable file types are jpg, jpeg and png.</small>
                    <div id="og_image_container">

                    </div>
                    <span id="og_image_img_err" class="error-msg"></span>
                </div>
            </div> -->
            </div>
        </div>
 </div>

<style type="text/css">
    .icon-picker-list .glyphicon {
        font-size: 23px;
        margin-bottom: 10px;
        margin-top: 5px;
    }

    .buy_now_add_btn {
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        position: relative;
        background: #60c0ef;
        cursor: pointer;
    }

    .buy_now_add_btn span {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        color: #fff;
        text-align: center;
        font-size: 15px;
        width: 16px;
        height: 15px;
        cursor: pointer;
    }

    .buy_now_add_btn:active {
      background-color: #5cabd2;
      transform: translateY(4px);
    }

    .remove_buy_now_btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        position: absolute;
        background: #60c0ef;
        cursor: pointer;
        right: 0;
        top: -15px;
    }

    .remove_buy_now_btn span {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        color: #fff;
        text-align: center;
        font-size: 15px;
        width: 16px;
        height: 15px;
        cursor: pointer;
    }

    .remove_buy_now_btn:active {
      background-color: #5cabd2;
      transform: translateY(4px);
    }

    .buy_now_div {
        padding: 20px 0px;
        position: relative;
    }

</style>

<script type="text/javascript">


    var buy_counter = 0;

    $(document).ready(function(){
        is_exists_buy_now();
    });

    $(document).on('click', '.open_filemanager', function(e){
        $('#file_url').val('');
        $('#file_alt').val('');
        var data_id = $(this).attr("data-id");
        modal.file_manager(data_id);
    });

    $(document).on("click", ".btn_insert", function(e){
        var data_identifier = $(this).attr("identifier");
        var image_thumbnail = $('#file_url').val();
        var image_alt = $('#file_alt').val();
        var allowed_extensions_img = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        image_thumbnail = image_thumbnail.replace("<?= base_url();?>","");

        if(allowed_extensions_img.exec(image_thumbnail))
        {
            $('#'+data_identifier+'_alt').val(image_alt);
            $('#'+data_identifier+'_img').val(image_thumbnail);
            $('#'+data_identifier+'_container').html('<img src="<?= base_url(); ?>'+image_thumbnail+'" alt="" class="img-responsive">');
        }else{
            $('#'+data_identifier+'_alt').val(image_alt);
            $('#'+data_identifier+'_img').val(image_thumbnail);
            $('#'+data_identifier+'_container').html('<img src="<?= base_url(); ?>assets/images/times.png" alt="" class="img-responsive">');
        }

        $(".bootbox").modal("hide");
        $("#ckeditor_filemanager_modal").modal("hide");

    });
    
    $('.div_default').hide();
    // $('.div_meta').hide();
    $(document).on('change', '.menu_type', function(e){
        var selected = $(this).val();
        $('.buy_now_container').hide();
        $('.buy_now_add_btn').hide();
        $('#redirect_url').removeClass('required');
        $('#image_banner').removeClass('required');
        $(".div_template").remove();
        // $(".div_meta").hide();
        if(selected  == "Url"){
            $('.div_template').remove();
            var html = '';
            html += '<div class="form-group div_template">';
            html += '   <label class="col-sm-2 control-label">Url</label>';
            html += '   <div class="col-sm-5">';
            html += '       <input id="url" class="form-control " placeholder="Enter Complete Url" />';
            html += '   </div>';
            html += '</div>';
            html += '<div class="template_div"></div>';
            $(".div_default").hide();
        } else  if(selected  == "Group Menu") {
            $('.div_template').remove();
            var html = '';
            html += '<div class="form-group div_template">';
            html += '   <label class="col-sm-2 control-label">Url</label>';
            html += '   <div class="col-sm-5">';
            html += '       <input id="url" class="form-control" readonly value="#" />';
            html += '   </div>';
            html += '</div>';
            html += '<div class="template_div"></div>';
            $(".div_default").hide();
        } else if (selected == "Buy Now") {
            $('.div_template').remove();
            $('.buy_now_add_btn').show();
            $('.buy_now_container').show();
            $('#redirect_url').addClass('required');
            $('#image_banner').addClass('required');
            $(".div_default").hide();
        } else {
            $('.div_template').remove();
            $(".div_default").show();
            // $(".div_meta").show();
        }

        $(html).insertAfter('.div_type');
    });

    $(document).on('click', '#btn_save', function(e){
        parent_id = "<?=$parentid;?>";
        menu_orders = "<?=$order;?>";
        menu_level = "<?=$level;?>";
        local_url = '';
        if(parent_id)
        {
            local_url = "/<?=$parentid;?>/<?=$menu_group;?>";
        }

        e.preventDefault();
        if(validate.required('.required')==0){
            if(is_exists('site_menu', 'menu_name', $('#menu_name').val(), 'menu_status') != 0)
            {
                var error_message = "<span class='validate_error_message' style='color: red;'>The information already exists.<br></span>";
                $('#menu_name').css('border-color','red');
                $(error_message).insertAfter($('#menu_name'));

            }else{
                modal.loading(true);

                var value = $('#menu_name').val().toLowerCase();
                if (value != "") {
                    value = value.replace(/[^a-zA-Z0-9]/g, '_')
                                 .replace(/\-{2,}/g, '_')
                                 .toLowerCase();
                }

                var url = "<?= base_url('content_management/global_controller');?>";
                var default_menu = 0;
                if ($('#default').prop('checked')) {
                    default_menu = 1;

                    var data2 = {
                        event : "update", // list, insert, update, delete
                        table : "site_menu", //table
                        field : "default_menu", //field name
                        where : 1, //equals to
                        data : {
                                default_menu : 0
                            }, //data to insert
                    }

                    aJax.post_async(url,data2,function(result){

                        //update routes
                        var routes_url ="<?= base_url('content_management/site_menu/update_routes');?>";
                        var routes_data = {
                            controller : value
                        }
                        aJax.post_async(routes_url,routes_data,function(result){})

                    });

                }

                if($(".menu_type").val() == "Module"){
                    var data = {
                        event : "insert", // list, insert, update, delete
                        table : "site_menu", //table
                        data : {
                            menu_name : $('#menu_name').val().toLowerCase(),
                            menu_url : value,
                            menu_status : 1,
                            menu_orders : parseInt(menu_orders)+1,
                            menu_level : parseInt(menu_level)+1,
                            menu_parent_id : parent_id,
                            default_menu : default_menu,
                            menu_type : $('.menu_type').val(),
                            menu_created_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                            modified_by : '<?=$this->session->userdata("sess_uid");?>'
                        }, //data to insert
                    }

                    aJax.post(url,data,function(result){

                        var menu_id = is_json(result);

                        // $.get("<?= base_url("sitemap/xml");?>");
                        // $.get("<?= base_url("sitemap/html");?>");

                        var data_view = {
                            name : value,
                            title : $('#menu_name').val(),
                            menu_id : menu_id,
                            table : 'site_menu'
                        }
                        aJax.post("<?= base_url('content_management/preference/create_view');?>",data_view,function(result){
                                setTimeout(function(){
                                    modal.loading(false);
                                    modal.alert("Successfuly added Site Menu",function(){ 
                                        location.href = "<?= base_url('content_management/site_menu/menu');?>"+local_url;
                                    });
                                }, 1000);
                    });
                        
                    }); 

                }else if($(".menu_type").val() == "Buy Now"){
                        var url = "<?= base_url('content_management/global_controller');?>";
                        var data = {
                            event : "insert", // list, insert, update, delete
                            table : "site_menu", //table
                            data : {
                                menu_name : $('#menu_name').val().toLowerCase(),
                                menu_url : '#',
                                menu_status : 1,
                                menu_orders : parseInt(menu_orders)+1,
                                menu_level : parseInt(menu_level)+1,
                                menu_parent_id : parent_id,
                                default_menu : default_menu,
                                menu_type : $('.menu_type').val(),
                                menu_created_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                                menu_updated_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                                modified_by : '<?=$this->session->userdata("sess_uid");?>'
                            }, //data to insert
                        }

                        aJax.post(url,data,function(result){
                            if(buy_counter > 0){
                                //added field 
                                for (var i = 0; i < buy_counter; i++) {
                                    var data_counter = {
                                        event : "insert",
                                        table : "site_shop_now",
                                        data : {
                                            url : $('#redirect_url_'+i+'').val(),
                                            img_banner : $('#image_banner_'+i+'').val(),
                                            status : 1,
                                            create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                                            update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                                        }
                                    }
                                    aJax.post(url,data_counter,function(result){
                                    });
                                }
                                //for default field
                                var data_default = {
                                    event : "insert",
                                    table : "site_shop_now",
                                    data : {
                                        url : $('#redirect_url').val(),
                                        img_banner : $('#image_banner').val(),
                                        status : 1,
                                        create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                                        update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                                    }
                                }
                                aJax.post(url,data_default,function(result){
                                    setTimeout(function(){
                                        modal.loading(false);
                                        modal.alert("Successfuly added Site Menu.",function(){ 
                                            location.href = "<?= base_url('content_management/site_menu/menu');?>"+local_url;
                                        });
                                    }, 1000);
                                }); 

                            }else{
                                //save if default field only
                                var data_default = {
                                    event : "insert",
                                    table : "site_shop_now",
                                    data : {
                                        url : $('#redirect_url').val(),
                                        img_banner : $('#image_banner').val(),
                                        status : 1,
                                        create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                                        update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                                    }
                                }
                                aJax.post(url,data_default,function(result){
                                    setTimeout(function(){
                                        modal.loading(false);
                                        modal.alert("Successfuly added Site Menu.",function(){ 
                                            location.href = "<?= base_url('content_management/site_menu/menu');?>"+local_url;
                                        });
                                    }, 1000);
                                });
                            }
                        }); 
                }else{
                   var url = "<?= base_url('content_management/global_controller');?>";
                    var data = {
                        event : "insert", // list, insert, update, delete
                        table : "site_menu", //table
                        data : {
                            menu_name : $('#menu_name').val().toLowerCase(),
                            menu_url : $('#url').val(),
                            menu_status : 1,
                            menu_orders : parseInt(menu_orders)+1,
                            menu_level : parseInt(menu_level)+1,
                            menu_parent_id : parent_id,
                            default_menu : default_menu,
                            menu_type : $('.menu_type').val(),
                            menu_created_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                            menu_updated_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                            modified_by : '<?=$this->session->userdata("sess_uid");?>'
                        }, //data to insert
                    }

                    aJax.post(url,data,function(result){
                        setTimeout(function(){
                            modal.loading(false);
                            modal.alert("Successfuly added Site Menu.",function(){ 
                                location.href = "<?= base_url('content_management/site_menu/menu');?>"+local_url;
                            });
                        }, 1000);
                    }); 
                }
            }
            
        }
    });

    $(document).on('click', '#btn_close', function(e){
        location.href = "<?= base_url('content_management/site_menu/menu');?>";
    });

    function is_exists(table, field, value, status){
        var query = ""+ field +" = '" + value + "' AND "+status+" >= 0";
        var exists = 0;
        var url = base_url+"content_management/global_controller";
        var data = {
            event : "list", 
            select : field,
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

    
    $(document).on('click', '#buy_now_add', function(){
        var htm = '';
        if(buy_counter > 0){
            modal.alert("Maximum Buy Now Button is 2",function(){ });
        }else{

            htm += '<div class="buy_now_div added_buy_now_container_'+buy_counter+'">';
            htm += '<div id="remove_buy_now_container" data-id="'+buy_counter+'" class="remove_buy_now_btn" ><span class="fa fa fa-close"></span></div>';    

              //redirect_url
            htm += '<div class="form-group">';
            htm += '    <label class="control-label redirect_url_label col-sm-2">Redirect URL<span style="color: red;">*</span>:</label>';
            htm += '    <div class="col-sm-10">';
            htm += '        <input type="text" name="redirect_url" value="" class="form-control redirect_url_input redirect_url_input required" id="redirect_url_'+buy_counter+'" placeholder="Redirect URL" label="Redirect URL" note="">';
            htm += '    </div>';
            htm += '   <div class="clearfix"></div>';
            htm += ' </div>';

            // image_banner
            htm += '<div class="form-group">';
            htm += '    <label class="control-label image_banner_label col-sm-2">Image Banner<span style="color: red;">*</span>:</label>';
            htm += '    <div class="col-sm-10">';
            htm += '        <div class="input-group image_banner_'+buy_counter+'">';
            htm += '            <input id="image_banner_'+buy_counter+'" class="form-control required ext_filter " readonly="" value="" accept="jpg,gif,png,jpeg" name="image_banner" min_size="" max_size="">';
            htm += '            <span class="input-group-btn"> '; 
            htm += '                <button type="button" data-id="image_banner_'+buy_counter+'" class="file_manager_image_banner_buy btn btn-info btn-flat">Open File Manager</button>';
            htm += '            </span>';
            htm += '        </div>';
            htm += '        <i> <b>Accept : </b> JPG,GIF,PNG,JPEG.</i><br>';
            htm += '        </div>';
            htm += '        <div class="clearfix"></div>';
            htm += '    </div>';
            htm += '</div>';
            $(htm).insertAfter('.buy_now_container');
            buy_counter += 1;  
        }
    });


    $(document).on('click', '.file_manager_image_banner_buy', function(e){   
        var data_id = $(this).attr("data-id");    
        modal.file_manager(data_id);
    });


    $(document).on('click', '#remove_buy_now_container', function(e){   
            var data_id = $(this).attr("data-id");
            buy_counter -= 1;  
            $('.added_buy_now_container_'+data_id).remove();
    });
    

    function is_exists_buy_now(){
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "list",
            select : "id,menu_url,menu_name,menu_type,menu_status",
            query : 'menu_type = "Buy Now" AND menu_status >= 0',
            table : "site_menu"
        }

        aJax.post(url,data,function(result){
            var obj = is_json(result);
            if(obj.length > 0 ){
                $(".menu_type option[value='Buy Now']").remove();
            }
        });
    }
</script>







