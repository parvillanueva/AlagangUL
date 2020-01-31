AJAX.config.base_url(base_url);

var limit = 10;

$(document).ready(function(){
    get_data();
});

// $('.search-query').on("keypress", function(e) {                          
//     if (e.keyCode == 13) {
//         var keyword = $(this).val()
//         query = "(cms_metatags.meta_url like '%" + keyword + "%' OR cms_metatags.meta_keyword like '%" + keyword + "%' OR cms_metatags.meta_title like '%" + keyword + "%' OR cms_metatags.meta_description like '%" + keyword + "%') AND cms_metatags.meta_status >= 0";
//         offset = 1;
//         get_data();
//         get_pagination();
//     }
// });

function get_data(){

    AJAX.select.table("cms_metatags");
    AJAX.select.select("id, meta_url, meta_title, meta_description, meta_status, meta_type");
    AJAX.select.where.greater_equal("cms_metatags.meta_status", 0);
    AJAX.select.where.equal("cms_metatags.meta_parent_id", parent_id);
    AJAX.select.offset(offset);
    AJAX.select.limit(limit);
    AJAX.select.order.desc("id");

    AJAX.select.exec(function(result){
        var obj = result; //check if result is valid JSON format, Format to JSON if not
        var html = "";
        if(obj.length > 0){
            $.each(obj, function(x,y){
   
                var status = ( y.meta_status == 1 ) ? meta_status = "Active" : meta_status = "Inactive";
                var type = ( y.meta_type == 2 ) ? "Child" : "Url";
                var title = strip_tags(y.meta_title);
                var description = strip_tags(y.meta_description);
                var url = y.meta_url.split("/");
                var last_item = url.pop();   
                html += "<tr>";
                html += "   <td><input class=select type=checkbox data-id="+y.id+" onchange=check_box_check()></td>";
                if(y.meta_type == 1)
                {
                    html += "   <td><a href='"+content_management+"/site_meta/child/"+y.id+"/"+last_item+"' class='edit' data-status='"+y.meta_status+"' id='"+y.id+"' title='edit'>" +y.meta_url+ "</a></td>";
                }
                else
                {
                    html += "   <td>" +y.meta_url+ "</td>";
                }
                
                html += "   <td>" +title+ "</td>";
                html += "   <td>" +description+ "</td>";
                html += "   <td>" +type+ "</a></td>";
                html += "   <td>" +status+ "</a></td>";
                html += "   <td><a href='"+content_management+"/site_meta/edit/"+y.id+"/"+last_item+"' class='edit' data-status='"+y.meta_status+"' id='"+y.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                html += "</tr>";
                
            })
        } else {
            html = '<tr><td colspan=8 style="text-align: center;">No records to show.</td></tr>';
        }
        

        $(".table_body").html(html);
    }, function (obj){
        pagination.generate(obj.total_page, ".list_pagination", get_data);
    });
}

pagination.onchange(function(){
    offset = $(this).val();
    modal.loading(true);
    get_data();
    modal.loading(false);
});

function check_box_check() {
    var checkbox_count = document.querySelectorAll('input[class="select"]').length;
    var checked_checkboxes_count = document.querySelectorAll('input[class="select"]:checked').length;

    if (checkbox_count == checked_checkboxes_count) {
        $(".selectall").prop("checked", true);
    } else {
        $(".selectall").prop("checked", false);
    }
}

$(document).on("click", "#btn_add", function(e){
    location.href = content_management + '/site_meta/child_add/' + parent_id + '/' + menu_group;
});

$(document).on('click', '#btn_close', function(e){
    location.href = content_management + '/site_meta';
});

//Update status
$(document).on('click','.btn_status',function(e){
    var status = $(this).attr("data-status");
    var id = "";

    if(status == 0){
        var modal_obj = confirm_unpublish_meta; 
    }
    if(status == 1){
        var modal_obj = confirm_publish_meta; 
    }
    if(status == -2){
        var modal_obj = confirm_delete_meta; 
    }

    var result_message = "";
    modal.standard(modal_obj, function(result){
        modal.loading(true);
        if(result  == true){
            $('.selectall').prop('checked', false);
            $('.select:checked').each(function(index) { 
                id = $(this).attr('data-id');

                AJAX.update.table("cms_metatags");
                AJAX.update.where("id", id);
                AJAX.update.params("meta_status", status);
                AJAX.update.params("meta_updated_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

                AJAX.update.exec(function(result){
                    var obj = result;
                    result_message = obj;
                    url = content_management + '/site_meta/updateMetaStatus/' + id + '/' + status;
                    aJax.post(url,null,function(result){
                        modal.loading(false);
                    });
                });
            });

            modal.alert(update_success, function(){
                get_data();
                $('.btn_status').hide();    
            });
        }
        else
        {
            modal.loading(false);
        }

    })
});

//generate sitemap
$(document).on('click','#btn_sitemap',function(){
    var url = content_management + '/site_meta/sitemap_html';
    var data = {}
    aJax.post(url,data,function(result){ 
        window.open(sitemap_html, "_blank");
        window.open(sitemap_xml, "_blank");
    });
});