AJAX.config.base_url(base_url);

$(document).ready(function(){
    $('#asc_ref').attr("onkeyup", "this.value=this.value.replace(/[^a-zA-Z0-9\u00f1\u00d1 .@#$_,-\/]/g,'');");
});

propag = 0;
$(document).on('click', '#btn_save', function(){   
    // var alias = $('#title').val().replace(/[, !]+/g,"-").toLowerCase();
    if(validate.standard()){
        if(is_exists('cms_metatags', 'meta_url', fixed_url+$('#meta_url').val(), 'meta_status') != 0){
            var error_message = "<span class='validate_error_message' style='color: red;'>The information already exists.<br></span>";
            $('#meta_url').css('border-color','red');
            $(error_message).insertAfter($('#meta_url'));
        }else{
            modal.standard(confirm_add, function(result){
                propag++;
                if(result){
                    if(propag == 1){
                        modal.loading(true);

                        AJAX.insert.table("cms_metatags");
                        AJAX.insert.params("meta_parent_id", parent_id);
                        AJAX.insert.params("meta_url", fixed_url+$('#meta_url').val());
                        AJAX.insert.params("meta_title", $('#meta_title').val());
                        AJAX.insert.params("meta_description", $('#meta_description').val());
                        AJAX.insert.params("meta_keyword", $('#meta_keyword').val());
                        AJAX.insert.params("meta_image", $('#meta_img').val());
                        AJAX.insert.params("meta_status", $('#status').val());
                        AJAX.insert.params("meta_type", $('.menu_type').val());
                        AJAX.insert.params("meta_level", parseInt(level)+1);
                        AJAX.insert.params("asc_ref_code", $('#asc_ref').val());
                        AJAX.insert.params("meta_created_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

                        //aJax.post(url,data,function(result){
                        AJAX.insert.exec(function(result){
                            modal.loading(false);
                            modal.alert(add_success, function(){
                                location.href = content_management + '/site_meta/child/' + parent_id + '/' + menu_group;
                            });
                        })
                    }
                }
            });
        }
    }
});

$(document).on('click', '#btn_close', function(e){
    location.href = content_management + '/site_meta/child/' + parent_id + '/' + menu_group;
});