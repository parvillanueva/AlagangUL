AJAX.config.base_url(base_url);

var add_data = "";
var limit ='10';
$('.btn_close').hide();

if(menu_id){
    $('.btn_close').show();
    AJAX.select.where.greater_equal("menu_status", 0);
    AJAX.select.where.equal("menu_parent_id", menu_id);
    add_data = menu_id + '/' + menu_group;
}

$(document).ready(function(){
    $('.selectall').prop('checked', false);
    get_data();
    var sort_table = $('tbody').sortable();

    $('tbody').bind('sortupdate', function(event, ui){
        var order = 0;
        $('.order').each(function(){  
            order ++;
            $(this).attr("data-order",order);
        });
        save_sort();
    });           
});

$(document).on('keypress', '#search_query', function(e) {  
    if(e.keyCode == 13){
        var keyword = $(this).val();
        get_data(keyword);
    }
});

$(document).on('click', '#btn_close', function(e){
    location.href = content_management + '/cms_menu/menu';
});

$(document).on("change", ".record-entries select", function(e){
    $(".record-entries option").removeAttr("selected");
    $(".record-entries select").val($(this).val());
    $(".record-entries option:selected").attr("selected","selected");
    var record_entries = $(this).prop("selected", true).val();
    limit = parseInt(record_entries);
    offset = '1';
    get_data();
});

function save_sort(){
    $('.order').each(function(){       
        var orders = $(this).attr("data-order");

        AJAX.update.table("cms_menu");
        AJAX.update.where("id", $(this).attr("data-id"));
        AJAX.update.params("menu_orders", orders);

        AJAX.update.exec(function(result){});
    });
}
                    
function get_data(keyword){
    modal.loading(true); //show loading

    AJAX.select.table("cms_menu");
    AJAX.select.select("id, menu_name, menu_type, menu_url, menu_icon, menu_updated_date, menu_status, menu_package");
    AJAX.select.where.greater_equal("menu_status", 0);
    
        if(menu_id == ''){
            AJAX.select.where.less("menu_parent_id", 1);
        }else{
            AJAX.select.where.equal("menu_parent_id", menu_id);
        }

    AJAX.select.offset(offset);
    AJAX.select.limit(limit);
    AJAX.select.order.asc("menu_orders");

        if(keyword){
            AJAX.select.where.like("cms_menu.menu_url", encode_Html(keyword));
            AJAX.select.where.or.like("cms_menu.menu_name", encode_Html(keyword));
            AJAX.select.where.greater_equal("menu_status", 0);
        }

    AJAX.select.exec(function(result){
        var obj = result; //check if result is valid JSON format, Format to JSON if not
        var html = '';
        var pack = '';
        if(obj.length > 0){

            $.each(obj, function(x,y){
                html += '<tr>';
                html += ' <td class="hide"><p class="order" data-order="" data-id='+y.id+'></p></td>';
                html += ' <td style="background-color:  #c3c3c3;"><span style="color: #fff;" class="move-menu glyphicon glyphicon-th"></span></td>';
                html += ' <td><input class = "select"  data-id="'+y.id+'" data-menu="'+y.menu_name+'" data-menutype="'+y.menu_type+'" type ="checkbox"></td>';
            
                if(y.menu_url == "#"){
                    html += ' <td><a class="text-primary" href="'+content_management+'/cms_menu/menu/'+y.id+'/'+y.menu_name+'">'+y.menu_name+'</a></td>';
                }else{
                    html += ' <td>' +y.menu_name+ '</td>';
                }

                html += ' <td><i class="' +y.menu_icon+ ' fa-lg"></i></td>';
                html += ' <td>' +y.menu_url+ '</td>';

                if(y.menu_url == "#"){
                    html += '<td>Group Menu </td>';
                }else{
                    html += '<td>Module</td>';
                }
            
                html += ' <td>' + moment(y.menu_updated_date).format('LLL')+ '</td>';

                if(y.menu_status == 1){
                    status = 'Active';
                }else{
                    status = 'Inactive';
                }

                if(y.menu_package == null){
                    pack = '';
                }else{
                    pack = y.menu_package;
                }

                html += '<td>'+status+'</td>';
                html += '<td>'+pack+'</td>';
                html +=" <td><a href='"+content_management+"/cms_menu/menu_update/"+y.id+"' class='edit' title='edit'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                html += '</tr>';

            });
        }else{
            html = '<tr><td colspan=12 style="text-align: center;">No records to show.</td></tr>';
        }
        
        $('.table_body').html(html);
        modal.loading(false); //hide loading
    }, function (obj){
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

//update status
$(document).on('click','.btn_status',function(e){
    var status = $(this).attr("data-status");
    var id = "";
    var menu = "";

    var modal_obj = confirm_update; 
    var result_message = "";
    modal.standard(modal_obj, function(result){
        if(result){
            $('.selectall').prop('checked', false);
            $('.select:checked').each(function(index){
                id = $(this).attr('data-id');
                menu = $(this).attr('data-menu').replace(/ /g, "_");
                menutype = $(this).attr('data-menutype');
                //alert(menutype);

                AJAX.update.table("cms_menu");
                AJAX.update.where("id", id);
                AJAX.update.params("menu_name", menu);
                AJAX.update.params("menu_status", status);
                AJAX.update.params("menu_updated_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

                AJAX.update.exec(function(obj){
                    //result_message = obj;
                    if(menutype == 2){
                        var url = content_management + '/cms_menu/rename_table';
                        var data = {
                            name : 'pckg_'+menu, 
                        }
                        aJax.post(url,data,function(result){});
                    }
                });
            });

            modal.alert(update_success, function(){ 
                location.href = content_management + '/cms_menu/menu';  
            });
        }
    });
});

$(document).on('click', '#btn_add', function(e){
    location.href = content_management + '/cms_menu/menu_add/' + add_data;
});