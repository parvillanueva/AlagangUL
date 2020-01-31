AJAX.config.base_url(base_url);

var limit = 10;
var offset = 1;

$(document).ready(function(){
    $("#search_query").on("keypress", function(e) {
        if (e.keyCode == 13) {
            var keyword = $(this).val()
            get_list(keyword);
        }
    });

    get_list();

    $('.selectall').prop('checked', false);

    if(role == 6 || role == 7){
        $( '<a href="#" id="btn_unblock" data-status=0 class=" btn_status btn-sm btn btn-default cms-btn" style="display: none;"> Unblock </a>' ).insertAfter( $( ".btn_trash" ) );
    }
});

function get_list(keyword){

    if(role <= 3 || role == 6){
        AJAX.select.where.equal("cms_user_roles.id", "cms_users.role");
        AJAX.select.where.not("cms_users.role", "7");
        AJAX.select.where.not("cms_users.role", "4");
        AJAX.select.where.not("cms_users.role", "5");
    }else if (role == 4 || role == 5){
         AJAX.select.where.less("cms_users.role", "1");
     }

    modal.loading(true);

    AJAX.select.table("cms_users");
    AJAX.select.select("cms_users.id AS id, username, cms_users.name AS name, cms_user_roles.id AS role,cms_user_roles.name as role_name, email, cms_users.status AS status, notif_signup, notif_contactus,notif_login,user_block_logs");
    AJAX.select.where.greater_equal("cms_users.status", 0);
    AJAX.select.offset(offset);
    AJAX.select.limit(limit);
    AJAX.select.join.left("cms_user_roles","cms_user_roles.id", "cms_users.role");

        if(keyword){
            AJAX.select.where.or.like("cms_users.name", encode_Html(keyword));
            AJAX.select.where.like("cms_users.username", encode_Html(keyword));
            AJAX.select.where.or.like("cms_users.email", encode_Html(keyword));
            AJAX.select.where.greater_equal("cms_users.status", 0);
        }

    AJAX.select.exec(function(result){
       var obj = result;
        var htm = '';
    if(obj.length > 0){
        $.each(obj, function(x,y){
            var status = (y.status == 1) ? status = "Active" : status = "Inactive";

            htm+="  <tr>";
            htm+="    <td><input class = 'select'  data-id = '"+y.id+"' data-name='"+y.name+"' data-logs='"+y.user_block_logs+"' type ='checkbox'></td>";
            // htm+="    <td class='center-content'>"+decode_Html(y.name)+"</td>";
            htm+="    <td class='center-content'>"+y.name+"</td>";
            htm+="    <td class='center-content'>"+y.username+"</td>";
            htm+="    <td class='center-content'>"+y.email+"</a></p></td>";
            htm+="    <td class='center-content'>"+y.role_name+"</a></p></td>";
            htm+="    <td class='center-content'>"+status+"</a></td>";

            if (y.notif_signup == 1) {
                htm+="    <td class='center-content'><i class='fa fa-check'></i></td>";
            } else {
                htm+="    <td class='center-content'><i class='fa fa-times'></i></td>";
            }

            if (y.notif_contactus == 1) {
                htm+="    <td class='center-content'><i class='fa fa-check'></i></td>";
            } else {
                htm+="    <td class='center-content'><i class='fa fa-times'></i></td>";
            }
            if (y.notif_login == 1) {
                htm+="    <td class='center-content'><i class='fa fa-check'></i></td>";
            } else {
                htm+="    <td class='center-content'><i class='fa fa-times'></i></td>";
            }

            htm+="    <td class='center-content'><a href='"+content_management+"/users/edit_users/"+y.id+"' class='edit' data-status='"+y.status+"' id='"+y.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
            htm+="  </tr>";
        });
    }else{
        htm = '<tr><td colspan=10 style="text-align: center;">No records to show.</td></tr>';
    }
        $('.listdata tbody').html(htm);

        modal.loading(false);
    }, function(obj){
        pagination.generate(obj.total_page, '.list_pagination', get_list);
       });
}

pagination.onchange(function(){
    offset = $(this).val();
    get_list();
})

//Add user
$(document).on('click', '#btn_add', function(e){
    location.href = content_management + '/users/add_users';
});

$(document).on('click', '#btn_unblock', function(e){
    var status = $(this).attr("data-status");
    modal.confirm("Are you sure you want to Unblock this record?",function(result){
        if(result){
            $('.selectall').prop('checked', false);
            $('.check_user_block:checked').each(function(index) {
                id = $(this).attr('data-id');
                name = $(this).attr('data-name');

                AJAX.update.table("cms_users");
                AJAX.update.where("id", id);
                AJAX.update.params("name", name);
                AJAX.update.params("user_error_logs", 0);
                AJAX.update.params("user_block_logs", 0);
                AJAX.update.params("user_lock_time", '0000-00-00 00:00:00');

                AJAX.update.exec(function(result){
                    var obj = result;
                    modal.alert(update_success, function(){
                        get_list();
                        $('.btn_status').hide();
                    });
                });
            });
        }
    });
});

//Update status
$(document).on('click', '.status_action', function(e){
    var status = $(this).attr("data-status");
    var id = "";
    var name = "";
    var obj;

    modal.standard(confirm_update, function(result){
        if(result){
            $('.selectall').prop('checked', false);
            $('.select:checked').each(function(index) {
                id = $(this).attr('data-id');
                name = $(this).attr('data-name');

                AJAX.update.table("cms_users");
                AJAX.update.where("id", id);
                AJAX.update.params("name", name);
                AJAX.update.params("status", status);
                AJAX.update.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

                AJAX.update.exec(function(result){
                   obj = result;
                    if(result.success){
                        modal.alert(update_success, function(){
                            get_list();
                            $('.btn_status').hide();
                        });
                    }
                });
            });
        }
    })
});


$(document).on('change', '.selectall', function(){
    var del = 0;
    if(this.checked){
        $('.select').each(function(){
            this.checked = true;
            $('.btn_status').show();
            $('#btn_unblock').hide();
        });
    }else{
        $('.select').each(function(){
            $('.btn_status').hide();
            this.checked = false;
        });
    }
});


$(document).on('change', '.select', function(){
    $('.select').each(function(){
        if(this.checked==true){
            var data_erro_logs = $(this).attr('data-logs');
            if(data_erro_logs == 3){
                $('#btn_unblock').show();
                $(this).addClass('check_user_block');
            }else{
                $('#btn_unblock').hide();
                $(this).removeClass('check_user_block');
            }
        }
    });
});