AJAX.config.base_url(base_url);

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

    image_thumbnail = image_thumbnail.replace(base_url,"");

    if(allowed_extensions_img.exec(image_thumbnail)){
        $('#'+data_identifier+'_alt').val(image_alt);
        $('#'+data_identifier+'_img').val(image_thumbnail);
        $('#'+data_identifier+'_container').html('<img src="'+base_url+image_thumbnail+'" alt="" class="img-responsive">');
    }else{
        $('#'+data_identifier+'_alt').val(image_alt);
        $('#'+data_identifier+'_img').val(image_thumbnail);
        $('#'+data_identifier+'_container').html('<img src="'+base_url+'assets/images/times.png" alt="" class="img-responsive">');
    }

    $(".bootbox").modal("hide");
    $("#ckeditor_filemanager_modal").modal("hide");
});

$('.div_default').hide();
// $('.div_meta').hide();
$(document).on('change', '.menu_type', function(e){
    $('#default').prop('checked',false);
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

    if(selected != "Buy Now" && buy_counter > 0){
        for (var i = 0; i < buy_counter; i++) {
                $('.added_buy_now_container_'+i).remove();
        }
        buy_counter = 0;
    }
    $(html).insertAfter('.div_type');
});

$(document).on('click', '#btn_save', function(e){

    local_url = '';
    if(parent_id)
    {
        local_url = '/'+parent_id+'/'+menu_group;
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

            //var url = global_controller;
            var default_menu = 0;
            if ($('#default').prop('checked')) {
                default_menu = 1;

                AJAX.update.table("site_menu");
                AJAX.update.where("default_menu", 1);
                AJAX.update.params("default_menu", 0);

                AJAX.update.exec(function(result){
                    //update routes
                    var routes_url = content_management + '/site_menu/update_routes';
                    var routes_data = {
                        controller : value
                    }
                    aJax.post_async(routes_url,routes_data,function(result){})

                });

            }

            if($(".menu_type").val() == "Module"){

                AJAX.insert.table("site_menu");
                AJAX.insert.params("menu_name", $('#menu_name').val().toLowerCase());
                AJAX.insert.params("menu_url", value);
                AJAX.insert.params("menu_status", $('#status').val());
                AJAX.insert.params("menu_orders", parseInt(menu_orders)+1);
                AJAX.insert.params("menu_level", parseInt(menu_level)+1);
                AJAX.insert.params("menu_parent_id", parent_id);
                AJAX.insert.params("default_menu", default_menu);
                AJAX.insert.params("menu_type", $('.menu_type').val());
                AJAX.insert.params("menu_created_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                AJAX.insert.params("modified_by", sess_uid);

                AJAX.insert.exec(function(result){

                    var menu_id = result;
                    var data_view = {
                        name : value,
                        title : $('#menu_name').val(),
                        menu_id : menu_id,
                        table : 'site_menu'
                    }

                    aJax.post(content_management+'/preference/create_view',data_view,function(result){
                        setTimeout(function(){
                            modal.loading(false);
                            modal.alert(add_success, function(){ 
                                location.href = content_management+'/site_menu/menu'+local_url;
                            });
                        }, 1000);
                    });  
                }); 

            }else if($(".menu_type").val() == "Buy Now"){
                     var url = global_controller;

                    AJAX.insert.table("site_menu");
                    AJAX.insert.params("menu_name", $('#menu_name').val().toLowerCase());
                    AJAX.insert.params("menu_url", '#');
                    AJAX.insert.params("menu_status", $('#status').val());
                    AJAX.insert.params("menu_orders", parseInt(menu_orders)+1);
                    AJAX.insert.params("menu_level", parseInt(menu_level)+1);
                    AJAX.insert.params("menu_parent_id", parent_id);
                    AJAX.insert.params("default_menu", default_menu);
                    AJAX.insert.params("menu_type", $('.menu_type').val());
                    AJAX.insert.params("menu_created_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                    AJAX.insert.params("menu_updated_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                    AJAX.insert.params("modified_by", sess_uid);

                    AJAX.insert.exec(function(result){
                        if(buy_counter > 0){
                            //added field 
                            for (var i = 0; i < buy_counter; i++) {

                                AJAX.insert.table("site_shop_now");
                                AJAX.insert.params("url", $('#redirect_url_'+i+'').val());
                                AJAX.insert.params("img_banner", $('#image_banner_'+i+'').val());
                                AJAX.insert.params("status", $('#status').val());
                                AJAX.insert.params("create_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                                AJAX.insert.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

                                AJAX.insert.exec(function(result){
                                });
                            }

                            AJAX.insert.table("site_shop_now");
                            AJAX.insert.params("url", $('#redirect_url').val());
                            AJAX.insert.params("img_banner", $('#image_banner').val());
                            AJAX.insert.params("status", $('#status').val());
                            AJAX.insert.params("create_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                            AJAX.insert.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

                            AJAX.insert.exec(function(result){
                            //aJax.post(url,data_default,function(result){
                                setTimeout(function(){
                                    modal.loading(false);
                                    modal.alert(add_success, function(){ 
                                        location.href = content_management + '/site_menu/menu' + local_url;
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
                                    status :  $('#status').val(),
                                    create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                                    update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                                }
                            }

                            aJax.post_async(url,data_default,function(result){
                          //   AJAX.insert.exec(function(result){
                                setTimeout(function(){
                                    modal.loading(false);
                                    modal.alert(add_success, function(){ 
                                        location.href = content_management + '/site_menu/menu' + local_url;
                                    });
                                }, 1000);
                            });
                        }
                    }); 
            }else{

                AJAX.insert.table("site_menu");
                AJAX.insert.params("menu_name", $('#menu_name').val().toLowerCase());
                AJAX.insert.params("menu_url", $('#url').val());
                AJAX.insert.params("menu_status", $('#status').val());
                AJAX.insert.params("menu_orders", parseInt(menu_orders)+1);
                AJAX.insert.params("menu_level", parseInt(menu_level)+1);
                AJAX.insert.params("menu_parent_id", parent_id);
                AJAX.insert.params("default_menu", default_menu);
                AJAX.insert.params("menu_type", $('.menu_type').val());
                AJAX.insert.params("menu_created_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                AJAX.insert.params("menu_updated_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                AJAX.insert.params("modified_by", sess_uid);

                AJAX.insert.exec(function(result){
                    setTimeout(function(){
                        modal.loading(false);
                        modal.alert(add_success, function(){
                            location.href = content_management + '/site_menu/menu' + local_url;
                        });
                    }, 1000);
                }); 
            }
        }   
    }
});

$(document).on('click', '#btn_close', function(e){
    location.href = content_management + '/site_menu/menu';
});

function is_exists(table, field, value, status){

     var exists = 0;

    AJAX.select.table(table);
    AJAX.select.select(field);
    AJAX.select.where.equal(field, value);
    AJAX.select.where.greater_equal(status, "0");

    AJAX.select.exec(function(result){
        var obj = result;
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
    AJAX.select.table("site_menu");
    AJAX.select.select("id,menu_url,menu_name,menu_type,menu_status");
    AJAX.select.where.equal("menu_type", "Buy Now");
    AJAX.select.where.greater_equal("menu_status", "0");

    AJAX.select.exec(function(result){
        var obj = result;
        if(obj.length > 0 ){
            $(".menu_type option[value='Buy Now']").remove();
        }
    });
}