AJAX.config.base_url(base_url);

$('.status_banner').hide();
var limit = 10;

$(document).ready(function(){
    get_data();
    disable_used();
});

$(document).on("click", "#btn_add", function(e){
    location.href = current_url + "/add";
});

$('.search-query').on("keypress", function(e){
    if (e.keyCode == 13){
        var keyword = $(this).val();
        get_data(keyword);
        disable_used();
    }
});

function get_data(keyword){

    AJAX.select.table("cms_user_roles");
    AJAX.select.select("id, name,status,update_date");
    AJAX.select.where.greater_equal("status", 0);
    AJAX.select.offset(offset);
    AJAX.select.limit(limit);
    AJAX.select.order.desc("update_date");

    if(keyword){
        
        AJAX.select.where.like("name", encode_Html(keyword));
        AJAX.select.where.greater_equal("status", 0);
        
    }
    //get list
    AJAX.select.exec(function(result){
        var obj = result; //check if result is valid JSON format, Format to JSON if not
        var html = "";
        if(obj.length > 0){
            $.each(obj, function(x,y){
                var status = ( y.status == 1 ) ? status = "Active" : status = "Inactive";

                html += "<tr>";
                html += "   <td><input class='select' type=checkbox data-id="+y.id+" onchange=checkbox_check()></td>";
                html += "   <td>" + decode_Html(y.name) + "</td>";
                html += "   <td>"+moment(y.update_date).format("LLL")+  "</td>";
                html += "   <td>" +status+ "</td>";
                html += "   <td><a href='"+current_url +"/edit/"+y.id+"' class='edit' data-status='"+y.status+"' id='"+y.id+"' title='edit' ><span class='glyphicon glyphicon-pencil'></span></td>";
                html += "</tr>";
            });
        }else{
            html = '<tr><td colspan=8 style="text-align: center;">No records to show.</td></tr>';
        }

        $(".table_body").html(html);
        
        if(role != 7){
            $("a[id=4]").removeAttr("href");
            $("a[id=5]").removeAttr("href");
            $("a[id=7]").removeAttr("href");
        }
    }, function(obj){
         pagination.generate(obj.total_page, ".list_pagination", get_data);       
       });
}

pagination.onchange(function(){
    offset = $(this).val();
    modal.loading(true);
    get_data();
    disable_used();
    modal.loading(false);
})

//Remove check on selectall checkbox when not all listed records are selected
function checkbox_check(){
    var checkbox_count = document.querySelectorAll('input[class="select"]').length;
    var checked_checkboxes_count = document.querySelectorAll('input[class="select"]:checked').length;

    if (checkbox_count == checked_checkboxes_count) {
        $(".selectall").prop("checked", true);
    } else {
        $(".selectall").prop("checked", false);
    }
}

function disable_used(){
    
    AJAX.select.table("cms_users");
    AJAX.select.select("id,role,status");
    AJAX.select.where.greater_equal("status", 0);

    AJAX.select.exec(function(result){
        var obj = result;
        $.each(obj, function(x,y){
            $("input[data-id="+y.role+"]").prop('disabled',true);
            $("input[data-id="+y.role+"]").removeClass('select');
        })
    });
}

//Update status
$(document).on('click','.btn_status',function(e){
    var status = $(this).attr("data-status");
    if(status == -2){
        var modal_obj = confirm_delete; 
    }else{
        var modal_obj = confirm_update; 
    }

    var result_message = "";
    modal.standard(modal_obj, function(result){
        if(result){
            $('.selectall').prop('checked', false);
            $('.select:checked').each(function(index){ 
                // modal.loading(true);
                id = $(this).attr('data-id');
                AJAX.update.table("cms_user_roles");
                AJAX.update.where("id", id);
                AJAX.update.params("status", status);
                AJAX.update.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

                AJAX.update.exec(function(result){
                    var obj = result;
                    result_message = obj;
                    modal.loading(false);
                });
            });

            modal.alert(update_success, function(){
                get_data();
                disable_used();
                $('.btn_status').hide();    
            });
        }
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