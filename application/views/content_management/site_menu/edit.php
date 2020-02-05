<div class="box">
    <?php   
        $data['buttons'] = ['update','close']; // add, save, update
        $this->load->view("content_management/template/buttons", $data);
    ?>  
    <div class="box-body">   
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Group</label>
                <div class="col-sm-5">
                    <select class="form-control" id = "parent">
                        <option value = "0" data-level = '0' selected>Main Menu</option>
                    <?php
                        foreach ($menus as $key => $value) {
                    ?>
                        <option value="<?=$value->id?>" data-level = "<?=$value->menu_level?>" <?=($details[0]->menu_parent_id == $value->id) ? "selected" : "";?> >
                            <?=$value->menu_name?>
                        </option>
                    <?php }
                    ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Menu Name</label>
                <div class="col-sm-5">
                    <input id="menu_name" class="form-control required">
                </div>
            </div>
            <div class="form-group div_type">
                <label class="col-sm-2 control-label">Type</label>
                <div class="col-sm-5">
                    <select class="form-control menu_type required">
                        <option selected disabled>Select..</option>
                        <option value = "Module">Module</option>
                        <option value = "Url">Url</option>
                        <option value = "Group Menu">Group Menu</option>
                        <option value = "Buy Now">Buy Now</option>
                    </select>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-5">
                    <select id="status" class="form-control">
                        <option value=1>Active</option>
                        <option value=0>Inactive</option>
                    </select>
                </div>
            </div> -->
            <!--  <div class="form-group">
                <label class="col-sm-2 control-label">URL</label>
                <div class="col-sm-5 url"></div>
            </div> -->
            <div class="form-group div_default">
                <label class="col-sm-2 control-label"></label>
                <div class="col-md-5 checkbox">
                    <label><input id="default" type="checkbox" value="">Set as Default</label>
                </div>
            </div>
            <!-- div class="form-group div_type">
                <label class="col-sm-2 control-label"></label>
                <div class="col-md-5 checkbox">
                    <label><input id="default" type="checkbox" value="">Set as Default</label>
                </div>
            </div> -->
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
</style>

<script type="text/javascript">
old_title = '<?=$details[0]->menu_name?>';
console.log(old_title);
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
    
$(document).ready(function(){
    get_data();

})

//get data
function get_data() {
    modal.loading(true); //show loading
    var url = "<?= base_url('content_management/global_controller');?>";
    var data = {
        event : "list",
        select : "id, menu_url, menu_name, menu_type",
        query : "id = <?= $this->uri->segment(4);?>", 
        table : "site_menu"
    }

    aJax.post(url,data,function(result){
        var obj = is_json(result); 
        $.each(obj,function(x,y){
            $('#menu_name').val(y.menu_name);
            $('.menu_type').val(y.menu_type);

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
        })
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
    } else if(selected  == "Group Menu") {
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
        var html = '';
        html += '<div class="form-group div_template">';
        html += '   <label class="col-sm-2 control-label">Url</label>';
        html += '   <div class="col-sm-5">';
        html += '       <input id="url" class="form-control" readonly value="#" />';
        html += '   </div>';
        html += '</div>';
        html += '<div class="template_div"></div>';
        $(".div_default").hide();
    } else {
        $('.div_template').remove();
        $(".div_default").show();
    }

    $(html).insertAfter('.div_type');

    hasUnder = '<?=count($hasUnder);?>';
    if(hasUnder != 0)
    {
        modal.alert("<?= $this->standard->dialog("hasUnder"); ?>", function(){
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
    modal.confirm("Are you sure you want to update this record?", function(result){
        if(result){
            modal.loading(true);
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

                var data = {
                    event : "update", // list, insert, update, delete
                    table : "site_menu", //table
                    field : "id", //field name
                    where : "<?= $this->uri->segment(4); ?>",
                    data : {
                        menu_name : $('#menu_name').val(),
                        menu_url : value,
                        menu_level : parseInt($('#parent').find(':selected').data('level'))+1,
                        menu_parent_id : $('#parent').val(),
                        default_menu : default_menu,
                        menu_type : $('.menu_type').val(),
                        menu_updated_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                        modified_by : '<?=$this->session->userdata("sess_uid");?>'
                    }
                }

                aJax.post(url,data,function(result){
                    var menu_id = is_json(result);
                    var data_view = {
                        name : value,
                        title : $('#menu_name').val(),
                        menu_id : menu_id,
                        table : 'site_menu'
                    }
                    aJax.post("<?= base_url('content_management/preference/create_view');?>",data_view,function(result){
                            setTimeout(function(){
                                modal.loading(false);
                                modal.alert("Successfuly updated Site Menu",function(){ 
                                    location.reload();
                                });
                            }, 1000);
                    });
                    
                }); 
            } 
            else 
            {
                var url = "<?= base_url('content_management/global_controller');?>";
                var data = {
                    event : "update", // list, insert, update, delete
                    table : "site_menu", //table
                    field : "id", //field name
                    where : "<?= $this->uri->segment(4); ?>",
                    data : {
                        menu_name : $('#menu_name').val(),
                        menu_url : $('#url').val(),
                        menu_level : parseInt($('#parent').find(':selected').data('level'))+1,
                        menu_parent_id : $('#parent').val(),
                        menu_type : $('.menu_type').val(),
                        menu_updated_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                        modified_by : '<?=$this->session->userdata("sess_uid");?>'
                    }, //data to insert
                }

                aJax.post(url,data,function(result){

                    setTimeout(function(){
                        modal.loading(false);
                        modal.alert("Successfuly updated Site Menu.",function(){ 
                            location.reload();
                        });
                    }, 1000);
                    
                }); 
            }
        }
    })
}

$(document).on('click', '#btn_close', function(e){
    location.href = '<?=base_url("content_management/site_menu/menu");?>';
});



function is_exists(table, field, value, status){
    var query = ""+ field +" = '" + value + "' AND "+status+" >= 0";
    var exists = 0;
    var url = base_url+"content_management/global_controller";
    var data = {
        event : "list", 
        select : ""+field+", "+status+"",
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
</script>