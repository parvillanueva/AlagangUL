AJAX.config.base_url(base_url);

var old_title = $('#meta_url').val();
$('.og-type option[value="'+og_type+'"]').prop("selected", true);

$(document).ready(function(){
    $('#asc_ref').attr("onkeyup", "this.value=this.value.replace(/[^a-zA-Z0-9\u00f1\u00d1 .@#$_,-\/]/g,'');");
});

$(document).on('click', '#btn_update', function(){   
    if(validate.standard(id1) && validate.standard(id2)){
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
    location.href = content_management + '/site_meta';
});

$(document).on('change','#meta_parent',function(){
    fixed_url = $(this).find(':selected').attr('data-url');
});

function update_data(){
    var modal_obj = confirm_update; 
    modal.standard(modal_obj, function(result){
        var meta_description = $('#meta_description').val();
        var meta_desc_escaped = encode_Html(meta_description);
        var meta_keyword = $('#meta_keyword').val();
        var meta_keyword_escaped = encode_Html(meta_keyword);
        meta_level = $('#meta_parent').find(':selected').attr('data-level');
        if(result){

            AJAX.update.table("cms_metatags");
            AJAX.update.where("id", segment_4);
            AJAX.update.params("meta_parent_id", $('#meta_parent').val());
            AJAX.update.params("meta_url", fixed_url+$('#meta_url').val());
            AJAX.update.params("meta_title", $('#meta_title').val());
            AJAX.update.params("meta_description", meta_desc_escaped);
            AJAX.update.params("meta_keyword", meta_keyword_escaped);
            AJAX.update.params("meta_image", $('#meta_img').val());
            AJAX.update.params("meta_status", $('#status').val());
            AJAX.update.params("meta_level", parseInt(meta_level)+1);
            AJAX.update.params("meta_type", $('.menu_type').val());
            AJAX.update.params("asc_ref_code", $('#asc_ref').val());
            AJAX.update.params("meta_updated_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

            AJAX.update.exec(function(result){
                var obj = result;
                if(result.success){
                    var url = content_management+'/site_meta/update_meta_level/'+segment_4+'/'+meta_level; 
                    var data = {
                        table   : "cms_metatags", 
                        url     : fixed_url
                    }
                    // +$('#meta_url').val()
                    aJax.post(url,data,function(result){
                        modal.loading(false);
                        modal.alert(update_success, function(){
                            location.href = content_management + '/site_meta';
                        });
                    });
                }
            });
        }
    });
}

$(document).on('change','.menu_type',function(){
    if(has_under_count != 0){
        modal.alert(has_under, function(){
            $('.menu_type option[value="1"]').prop("selected", true);
        });
    }
});