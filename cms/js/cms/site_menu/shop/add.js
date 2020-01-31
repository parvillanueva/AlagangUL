AJAX.config.base_url(base_url);

function save_data() {
    AJAX.insert.table("site_shop_now");
    AJAX.insert.params("url", $('#redirect_url').val());
    AJAX.insert.params("img_banner", $('#image_banner').val());
    AJAX.insert.params("status", 1);
    AJAX.insert.params("create_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
    AJAX.insert.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

    AJAX.insert.exec(function(result){
        var obj = result;
        modal.loading(true);
        modal.loading(false);
        modal.alert(add_success, function(){
            location.href = content_management + '/site_menu/menu';
        });
    });
}

$(document).on('click', '#btn_save', function(){
    if (validate.standard(input_content)) {
        modal.standard(confirm_add, function(result){
            if(result){  
                save_data();
            }
        });
    }
});

$(document).on('click', '#btn_close', function(e) {
    location.href = content_management + '/site_menu/menu';
});