AJAX.config.base_url(base_url);

$('#link_type').val(1);
    var propag = 0;

$(document).ready(function(){
    $('#asc_ref').attr("onkeyup", "this.value=this.value.replace(/[^a-zA-Z0-9\u00f1\u00d1 .@#$_,-\/]/g,'');");
});

$(document).on('click', '#btn_save', function(){   

    if(validate.standard(id1) && validate.standard(id2)){

        if(is_exists('cms_metatags', 'meta_url', $('#meta_url').val(), 'meta_status') != 0){
            var error_message = "<span class='validate_error_message' style='color: red;'>The information already exists.<br></span>";
            $('#meta_url').css('border-color','red');
            $('#meta_url').parent().parent().append(error_message);
            propag++;
        }else if($('#meta_url').val().trim() == ''){
            var error_message = "<span class='validate_error_message' style='color: red;'>This field is required.<br></span>";
            $('#meta_url').css('border-color','red');
            $('#meta_url').parent().parent().append(error_message);
        }else{
        
                var modal_obj = confirm_add; 
            modal.standard(modal_obj, function(result){
                var meta_description = $('#meta_description').val();
                var meta_desc_escaped = encode_Html(meta_description);
                var meta_keyword = $('#meta_keyword').val();
                var meta_keyword_escaped = encode_Html(meta_keyword);

                propag++;
                if(result){
                    modal.loading(true);
                    if(propag == 1){
                        AJAX.insert.table("cms_metatags");
                        AJAX.insert.params("meta_parent_id", '');
                        AJAX.insert.params("meta_url", $('#meta_url').val());
                        AJAX.insert.params("meta_title", $('#meta_title').val());
                        AJAX.insert.params("meta_description", meta_desc_escaped);
                        AJAX.insert.params("meta_keyword", meta_keyword_escaped);
                        AJAX.insert.params("meta_image", $('#meta_img').val());
                        AJAX.insert.params("meta_status", 1);
                        AJAX.insert.params("meta_type", $('.menu_type').val());
                        AJAX.insert.params("meta_level", 1);
                        AJAX.insert.params("asc_ref_code", $('#asc_ref').val());                    
                        AJAX.insert.params("meta_created_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

                        AJAX.insert.exec(function(result){
                            modal.loading(false);
                            modal.alert(add_success, function(){
                                location.href = return_url;
                            });
                        }); 
                    }else{
                        modal.loading(false);
                        modal.alert(message);
                    }
                }
            });   
        }
    }
}); 

$(document).on('click', '#btn_close', function(e){
    location.href = content_management + '/site_meta';
});