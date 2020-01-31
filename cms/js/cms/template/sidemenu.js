//Set Idle Time of User
AJAX.config.base_url(base_url);

$(document).ready(function(){
    // 900000 milliseconds = 5 minutes
    var idleState = false;
    var idleTimer = null;
    $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
        clearTimeout(idleTimer);
        idleState = false;
        idleTimer = setTimeout(function(){
            aJax.get(content_management + '/login/unset_session', function(){});
                modal.alert("Session has been idle over its time limit. You will be logged off automatically. ", function(){
                    location.href = content_management + '/login/unset_session';
                });
            idleState = true;
        }, 900000);
        ///300000
    });
    $("body").trigger("mousemove");
});

htm = '';
//cms title
aJax.get(content_management + '/cms_preference/get_title', function(data){
    $('.logo-lg').html(data);
})

//cms title logo-small
aJax.get(content_management + '/cms_preference/get_logo', function(data){
    $('.logo-mini').html(data);
});

//cms title logo-small
aJax.get(content_management + '/cms_preference/get_skin', function(data){
    $('body').addClass(data);
});

//cms side menu
aJax.get(content_management + '/cms_preference/get_menu', function(data){
    var obj = is_json(data);
    if(/MSIE 9/i.test(navigator.userAgent)){
        var new_obj = obj.replace(/\\/g, "");
        $('.sidebar-menu').html(new_obj);
    }else{
        $('.sidebar-menu').html(obj);
    }
});

//side menu arrow down
/*$(document).on('click', '.treeview a', function() {
  var current_class = $(this).find('.fa-angle-left').attr('class');
  if(current_class == "fa fa-angle-left pull-right"){
    $(this)
      .parent()
      .find('.fa-angle-left')
      .removeClass('fa fa-angle-left pull-right')
      .addClass('fa fa-angle-down pull-right');
  } else {
    $(this)
      .parent()
      .find('.fa-angle-down')
      .removeClass('fa fa-angle-down pull-right')
      .addClass('fa fa-angle-left pull-right');
  }
});*/

$(document).on('click', '.side_drop', function(e){
    e.stopPropagation();
});

$(document).on('click', '#sidebar_toggle', function(){
    var logo_mini = $('.main-header .logo .logo-mini').css('display');
});

$(document).on('resize', window, function(){
    var logo_mini = $('.main-header .logo .logo-mini').css('display');
});

$(window).on('load', function(){
    user_role_editor();
});

function user_role_editor(){

    AJAX.select.table("cms_menu");
    AJAX.select.select("cms_menu.id as menu_id, menu_url,menu_parent_id,menu_level ,menu_status, role_id,cms_menu_roles.menu_id as menu_roles_id,menu_role_read,menu_role_write,menu_role_delete");
    AJAX.select.where.equal("menu_url", menu_url);
    AJAX.select.where.equal("menu_status", 1);
    AJAX.select.where.equal("role_id", user_role);
    AJAX.select.join.left("cms_menu_roles", "cms_menu_roles.menu_id", "cms_menu.id");
    //get list
    AJAX.select.exec(function(result){
        var obj = result;
        $.each(obj,function(x,y){
            var role_read = y.menu_role_read;
            var role_write = y.menu_role_write;
            var role_delete = y.menu_role_delete;

            if(y.menu_level == 1){
                if(y.menu_url == menu_url){
                    $('.menu_checker_'+y.menu_id+' a').addClass('active_side_menu');
                }
            }else{
                $('.menu_checker_'+y.menu_parent_id+'').addClass('active');
                if(y.menu_url == menu_url){
                    $('.menu_checker_'+y.menu_id+' a').addClass('group_active_side_menu');
                }
            }

            $('li.treeview ul>li>a.group_active_side_menu').parentsUntil('.sidebar-menu').addClass('active');

            //User can't delete
            if(role_delete == 0){
                $('.btn_trash').remove();
                $('#btn_delete').remove();
            }

            //User read only
            if(role_write == 0 && role_delete == 0){
                $('.btn_add').remove();
                $('.btn_update').remove();
                $('.btn_save').remove();
                $('.btn_add_folder').remove();
                $('.btn_upload').remove();
                $('.btn_sitemap').remove();
                $("body :input").prop("disabled", true);
                $("a.edit").addClass('disabled');
                $("tbody tr").removeClass('ui-sortable-handle');
                $('tbody').removeClass('ui-sortable');
                $('table').removeClass('sorted_table');

                if($("table td:nth-child(2)").has("span.move-menu").length > 0){
                    $('tbody').sortable('disable');
                    $("table th:first-child,td:nth-child(2)").remove();
                }
                if($("table td:nth-child(2)").has("input.select").length > 0){
                    $("table th:first-child,td:nth-child(2)").remove();
                }
                if($('table td:last-child').has(".edit").length > 0){
                    $('table th:last-child,td:last-child').remove();
                }

            }else if(role_write == 0 && role_delete == 1){
                $('.btn_add').remove();
                $('.box-header a[data-status="1"]').remove();
                $('.box-header a[data-status="0"]').remove();
                $('.btn_update').remove();
                $('.btn_save').remove();
                $('.btn_add_folder').remove();
                $('.btn_upload').remove();
                $('.btn_sitemap').remove();
                $("body :input").prop("disabled", true);
                $("a.edit").addClass('disabled');
                $("tbody tr").removeClass('ui-sortable-handle');
                $('tbody').removeClass('ui-sortable');
                $('table').removeClass('sorted_table');

                if($("table td:first-child").has("input.select").length > 0){
                    $("th :input").removeAttr('disabled');
                    $(".select").removeAttr('disabled');
                }
                if($("table td:nth-child(2)").has("span.move-menu").length > 0) {
                    $('tbody').sortable('disable');
                    $("table th:first-child,td:nth-child(2)").remove();
                }
                if($("table td:nth-child(2)").has("input.select").length > 0) {
                    $("th :input").removeAttr('disabled');
                    $(".select").removeAttr('disabled');
                }
                if($('table td:last-child').has(".edit").length > 0){
                    $('table th:last-child').hide();
                    $('table td:last-child').hide();
                }
            }
        });
    });
}