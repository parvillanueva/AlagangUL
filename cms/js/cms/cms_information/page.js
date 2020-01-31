AJAX.config.base_url(base_url);

if(sess_role > 4){
    //$('.edit_header_label_label').parent().show();
}else{
    //$('.edit_header_label_label').parent().hide();
}

$(document).ready(function(){
    get_data();
});

function get_data(){

    AJAX.select.table("cms_preference");
    AJAX.select.select("id, cms_title, cms_skin, cms_edit_label, ad_authentication");
    AJAX.select.where.equal("id", 1);
    AJAX.select.exec(function(result){
    	var obj = result; 
    	$.each(obj, function(x,y){
    		$('#cms_title').val(y.cms_title);
            $('#skin').val(y.cms_skin);
            //$('#edit_header_label').val(y.cms_edit_label);
            $('#ad_authentication').val(y.ad_authentication);
    	});
    });
}

function load_skins(current){
    aJax.post(
        content_management + '/file_manager/files',
        { path: "./cms/css/skins" },
        function(data){

            var obj = is_json(data); 
            var html ='';
            for (var key in obj) {
                if(obj[key].text != null){
                    parts = obj[key].text.split('.');
                    x = parts[0];
                    if(x == current){
                        html += '<option selected>' + x + '</option>'
                    } else {
                        html += '<option>' + x + '</option>'
                    }
                }   
            }
            $('.theme').html(html);
        }
    )
}

$(document).on('click', '#btn_update', function(e){
	if(validate.standard(display)){
        modal.standard(confirm_update, function(result){
            if(result){

                AJAX.update.table("cms_preference");
                AJAX.update.where("id", 1);
                AJAX.update.params("cms_title", $('#cms_title').val());
                AJAX.update.params("cms_skin", $('#skin').val());
                AJAX.update.params("ad_authentication", $('#ad_authentication').val());

                AJAX.update.exec(function(result){
                    modal.alert(update_success, function(){
                        location.reload();  
                    });
                });
            }
        });
    }
});

$(document).on('keypress', 'textarea', function(e){
    if(e.which == 13){ 
       e.preventDefault();
    }
});