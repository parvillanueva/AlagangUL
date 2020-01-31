AJAX.config.base_url(base_url);

$('.redirect_url').addClass('required_input');

function update_data() {
    AJAX.update.table("site_shop_now");
    AJAX.update.where("id", shop_id);
    AJAX.update.params("url", $('#redirect_url').val());
    AJAX.update.params("img_banner", $('#image_banner').val());
    AJAX.update.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

    AJAX.update.exec(function(result){
        var obj = result;
        modal.loading(true);
        modal.loading(false);
        modal.alert(update_success, function(){
            location.href = content_management + '/site_menu/menu';
        });
    });
}

$(document).on('click', '#btn_update', function(){
    if (validate.standard(input_content)) {
       modal.standard(confirm_update, function(result){
            if(result){
            	update_data();
            }
        });     
    }
});

$(document).on('click', '#btn_close', function(e) {
    e.preventDefault();
    location.href = content_management + '/site_menu/menu';
});