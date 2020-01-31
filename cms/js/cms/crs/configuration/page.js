AJAX.config.base_url(base_url);

$(document).on('click', '#btn_update', function(){   
    if(validate.standard(form_id)){
        var modal_obj = confirm_update; 
        modal.standard(modal_obj, function(result){
            if(result){
                modal.loading(true);

                    AJAX.update.table("pckg_crs_config");
                    AJAX.update.where("id", 1);
                    AJAX.update.params("host", $('#crs_host').val());
                    AJAX.update.params("token", $('#crs_token').val());
                    AJAX.update.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                
                    AJAX.update.exec(function(result){
                        modal.loading(false);
                        modal.alert(update_success, function(){
                            location.reload();
                    });
                })
            }
        });
    }
});