AJAX.config.base_url(base_url);

var offset = '1';
$(document).ready(function(){
    get_data();
});

$(document).on('keypress', '#search_query', function(e){                          
    if(e.keyCode == 13){
        var keyword = $(this).val();
        offset = 1;
        get_data(keyword);
    }
});

function get_data(keyword){

    AJAX.select.table("cms_metatags");
    AJAX.select.select("id, meta_url, meta_title, meta_description, meta_status, meta_type");
    AJAX.select.where.greater_equal("cms_metatags.meta_status", 0);
    AJAX.select.where.equal("cms_metatags.meta_parent_id", '');
    AJAX.select.limit(limit);
    AJAX.select.offset(offset);
    AJAX.select.order.desc("id");
        
        if(keyword){
            AJAX.select.where.like("cms_metatags.meta_url", encode_Html(keyword));
            AJAX.select.where.or.like("cms_metatags.meta_keyword", encode_Html(keyword));
            AJAX.select.where.or.like("cms_metatags.meta_title", encode_Html(keyword));
            AJAX.select.where.or.like("cms_metatags.meta_description", encode_Html(keyword));
            AJAX.select.where.or.greater_equal("cms_metatags.meta_status", 0);
        }   

    AJAX.select.exec(function(result){
        var obj = result; //check if result is valid JSON format, Format to JSON if not
        var html = "";
        if(obj.length > 0){
            $('.btn_sitemap').show();
            $.each(obj, function(x,y){
                var status = ( y.meta_status == 1 ) ? meta_status = "Active" : meta_status = "Inactive";
                var type = ( y.meta_type == 1 ) ? "Parent" : "Child";
                var title = strip_tags(y.meta_title);
                var description = strip_tags(y.meta_description);
                 var url = y.meta_url.split("/");
                var last_item = url.pop();   
                html += "<tr>";
                html += "   <td><input class=select type=checkbox data-id="+y.id+" onchange=check_box_check()></td>";
                if(y.meta_type == 1)
                {
                    html += "   <td><a href='"+current_url+"/child/"+y.id+"/"+last_item+"' class='edit' data-status='"+y.meta_status+"' id='"+y.id+"' title='edit'>" +y.meta_url+ "</a></td>";
                }
                else
                {
                    html += "   <td>" +y.meta_url+ "</td>";
                }

                html += "   <td>" +title+ "</td>";
                html += "   <td>" +decode_Html(description)+ "</td>";
                //html += "   <td>" +type+ "</a></td>";
                html += "   <td>" +status+ "</a></td>";
                html += "   <td><a href='"+current_url +"/edit/"+y.id+"/"+last_item+"' class='edit' data-status='"+y.meta_status+"' id='"+y.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                html += "</tr>";
                
            })
        } else {
            $('.btn_sitemap').hide();
            html = '<tr><td colspan=8 style="text-align: center;">No records to show.</td></tr>';
        }
    
        $(".table_body").html(html);
    }, function(obj){
        pagination.generate(obj.total_page, ".list_pagination", get_data);    
    });
}

pagination.onchange(function(){
    offset = $(this).val();
    modal.loading(true);
    get_data();
    $("#search_query").val("");
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
    location.href = current_url + "/add";
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
    modal.standard(confirm_update, function(result){
        modal.loading(true);
        if(result == true){
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
                    url = content_management+'/site_meta/update_meta_status/'+id+'/'+status;
                    aJax.post(url,null,function(result){});
                    modal.loading(false);
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
    var url = content_management + '/sitemap/html';
    var data = {}
    aJax.post(url,data,function(result){ 
        window.open(base_url + "sitemap.html", "_blank");
        window.open(base_url + "sitemap.xml", "_blank");
    });
});

$(document).on("change", ".record-entries", function(e) {
    $(".record-entries option").removeAttr("selected");
    $(".record-entries").val($(this).val());
    $(".record-entries option:selected").attr("selected","selected");
    var record_entries = $(this).prop( "selected",true ).val();
    limit = parseInt(record_entries);
    offset = '1';
    modal.loading(true);
    get_data();
    modal.loading(false);
});