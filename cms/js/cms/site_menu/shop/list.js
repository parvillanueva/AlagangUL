AJAX.config.base_url(base_url);
 
$(document).ready(function(){
    $('#btn_add').removeAttr('id');
});

$(document).on('click', '.btn_add', function(e) {
    e.preventDefault();
    if(shop_menu() > 1){
        modal.alert("Maximum Buy Now Button is 2",function(){ });
    }else{
        location.href = content_management + '/site_menu/shop_add';
    }
});

$(document).on('click', '.edit', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    location.href = content_management + '/site_menu/shop_edit/' + id;
});

$(document).on('click', '#btn_close', function() {
    location.href = content_management + '/site_menu/menu';
});

function shop_menu(){
    var count = 0;
    AJAX.select.table("site_shop_now");
    AJAX.select.select("id, status");
    AJAX.select.where.greater_equal("status", 0);

    AJAX.select.exec(function(result){
        var obj = result;
        count = obj.length;
    });

    return count;
}