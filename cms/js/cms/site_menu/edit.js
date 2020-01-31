AJAX.config.base_url(base_url);

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
        $('#'+data_identifier+'_container').html(base_url+'assets/images/times.png" alt="" class="img-responsive">');
    }

    $(".bootbox").modal("hide");
    $("#ckeditor_filemanager_modal").modal("hide");
});
    
$(document).ready(function(){
    get_data();
});

//get data
function get_data(){
    modal.loading(true); //show loading

    AJAX.select.table("site_menu");
    AJAX.select.select("id, menu_url, menu_name, menu_type,menu_status");
    AJAX.select.where.equal("id", segment_4);

    AJAX.select.exec(function(result){
        var obj = result; 
        $.each(obj,function(x,y){
            $('#menu_name').val(y.menu_name);
            $('.menu_type').val(y.menu_type);
            $('#status option[value='+y.menu_status+']').attr('selected','selected');
            $(".div_template").remove();
            if(y.menu_type  == "Url"){
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
            } else  if(y.menu_type  == "Group Menu") {
                $('.div_template').remove();
                var html = '';
                html += '<div class="form-group div_template">';
                html += '   <label class="col-sm-2 control-label">Url</label>';
                html += '   <div class="col-sm-5">';
                html += '       <input id="url" class="form-control" readonly />';
                html += '   </div>';
                html += '</div>';
                html += '<div class="template_div"></div>';
                $(".div_default").hide();
            } else if (y.menu_type == "Buy Now") {
                $('.div_template').remove();
                var html = '';
                $(".menu_type").prop('disabled',true);
                $(".div_default").hide();
            }  else {
                $(".div_default").show();
            }

            $(html).insertAfter('.div_type');

                if(y.menu_type == 'Module'){      
                    $('.url').html('<input id="url" class="form-control req">');
                    $('.div_type').show();
                }else if(y.menu_type == 'Group Menu'){
                    $('.url').html('<input id="url" class="form-control" readonly value="#" />');
                    $('.div_type').remove();
                    $('.div_meta').remove();
                }else if(y.menu_type == 'Url'){
                    $('.url').html('<input id="url" class="form-control req">');
                    $('.div_type').show();
                    $('.div_meta').remove();
                }

            $('#url').val(y.menu_url);
        });
        modal.loading(false); //hide loading
    });
}

$('.div_default').hide();

$(document).on('change', '.menu_type', function(e){
    var selected = $(this).val();
    $(".div_template").remove();
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
    }else if(selected  == "Group Menu"){
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
    }else if (selected == "Buy Now"){
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
    }else{
        $('.div_template').remove();
        $(".div_default").show();
    }

    $(html).insertAfter('.div_type');

    if(hasUnder_count != 0)
    {
        modal.alert(hasUnder, function(){
            $('.menu_type option[value="Group Menu"]').prop("selected", true);
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
            $(html).insertAfter('.div_type');
        });
    }
});

$(document).on('click', '#btn_update', function(){   
    if(validate.required('#menu_name')==0){
        if(old_title == $('#menu_name').val()){
            update_data();
        }else{
            if(is_exists('site_menu', 'menu_name', $('#menu_name').val(), 'menu_status') != 0){
                var error_message = "<span class='validate_error_message' style='color: red;'>The information already exists.<br></span>";
                $('#menu_name').css('border-color','red');
                $(error_message).insertAfter($('#menu_name'));
            }else{
                update_data();
            }
        }
    }
});
    
//update data
function update_data(){

    // if(validate.required('#menu_name')==0){
    modal.standard(confirm_update, function(result){
        if(result){
            modal.loading(true);
            var url = global_controller;
            var default_menu = 0;
            if ($('#default').prop('checked')) {
                default_menu = 1;
                
                AJAX.update.table("site_menu");
                AJAX.update.params("default_menu", 0);

                AJAX.update.exec(function(result){
                    //update routes
                    var routes_url = content_management + '/site_menu/update_routes';
                    var routes_data = {
                        controller : $('#url').val()
                    }
                    aJax.post_async(routes_url,routes_data,function(result){})   
                });
            }

            if($(".menu_type").val() == "Module"){
                var value = $('#menu_name').val();
                if (value != "") {
                    value = value.replace(/[^a-zA-Z0-9]/g, '_')
                                 .replace(/\-{2,}/g, '_')
                                 .toLowerCase();
                }

                AJAX.update.table("site_menu");
                AJAX.update.where("id", segment_4);
                AJAX.update.params("menu_name", $('#menu_name').val());
                AJAX.update.params("menu_url", value);
                AJAX.update.params("menu_level", parseInt($('#parent').find(':selected').data('level'))+1);
                AJAX.update.params("menu_parent_id", $('#parent').val());
                AJAX.update.params("default_menu", default_menu);
                AJAX.update.params("menu_type", $('.menu_type').val());
                AJAX.update.params("menu_updated_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                AJAX.update.params("modified_by", sess_uid);

                AJAX.update.exec(function(result){
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
                                modal.alert(update_success, function(){ 
                                    location.reload();
                                });
                            }, 1000);
                    });
                    
                }); 
            } 
            else 
            {

                AJAX.update.table("site_menu");
                AJAX.update.where("id", segment_4);
                AJAX.update.params("menu_name", $('#menu_name').val());
                AJAX.update.params("menu_url", $('#url').val());
                AJAX.update.params("menu_level", parseInt($('#parent').find(':selected').data('level'))+1);
                AJAX.update.params("menu_parent_id", $('#parent').val());
                AJAX.update.params("menu_type", $('.menu_type').val());
                AJAX.update.params("menu_updated_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                AJAX.update.params("modified_by", sess_uid);

                AJAX.update.exec(function(result){

                    setTimeout(function(){
                        modal.loading(false);
                        modal.alert(update_success, function(){ 
                            location.reload();
                        });
                    }, 1000);
                    
                }); 
            }
        }
    })
}

$(document).on('click', '#btn_close', function(e){
    location.href = content_management + '/site_menu/menu';
});

function is_exists(table, field, value, status){

     var exists = 0;

    AJAX.select.table(table);
    AJAX.select.select(field,status);
    AJAX.select.where.equal(field, value);
    AJAX.select.where.greater_equal(status, 0);

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