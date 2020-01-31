AJAX.config.base_url(base_url);

$(document).on('click', '#btn_update', function(){
    modal.standard(confirm_update, function(result){
        if(result){
            modal.loading(true);

            AJAX.update.table("site_themes");
            AJAX.update.where("id", 1);
            AJAX.update.params("navigation_position", $('input[type=radio]:checked').val());

            AJAX.update.exec(function(result){
                modal.loading(false);
                aJax.get(content_management+"/site_themes/set_menu_position");
                modal.alert(update_success, function(){
                    location.href = content_management+"/site_themes";
                });
            });
        }
    });
});

$(document).on('click', '#btn_cancel', function(e){
    modal.standard(confirm_cancel, function(result){
        if(result){
            location.reload();
        }
    });
});

$(document).on('click', '.navigation_position', function(){
    var pos = $(this).val();
    var image_url = base_url+'cms/images/menu_position/menu_'+pos+'.png';
    $('.position_image').attr('src', image_url);
});