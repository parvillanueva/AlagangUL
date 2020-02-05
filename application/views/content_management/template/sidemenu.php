<style type="text/css">
  
      a.disabled {
         pointer-events: none;
         cursor: default;
      }
      body .skin-black .skin-blue .skin-green .skin-red .skin-yellow .skin-purple .main-sidebar .sidebar-menu > li a.active_side_menu{
        color: #ffffff;
          background: #1e282c;
          border-left-color: #ffffff;
      }
      body .skin-black .skin-blue .skin-green .skin-red .skin-yellow .skin-purple .main-sidebar .main-sidebar .sidebar-menu > li a.group_active_side_menu {
          color: #ffffff;
      }

      ul.treeview-menu.sub_menu.active {
          display: block;
      }
      .sidebar-menu .active > a > .fa-angle-left,
      .sidebar-menu .active > a > .pull-right-container > .fa-angle-left {
        -webkit-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
      }

</style>

<?php
      //get url for db table checking on user role
      $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
      $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
      $urls = explode('/', $escaped_url);
      $remove_base_url = array_splice($urls,4);
      $limit_url = count($remove_base_url);
      $combine_url ="";
      if($limit_url >= 3 ){
        if($remove_base_url[1] == 'cms_menu' || $remove_base_url[1] == 'site_menu' || $remove_base_url[1] == 'preference' || $remove_base_url[1] == 'documentation'){
              $combine_url = $remove_base_url[0].'/'.$remove_base_url[1].'/'.$remove_base_url[2];
              if($remove_base_url[2] == 'menu_add' || $remove_base_url[2] == 'menu_update'){
                 $set_last_index = 'menu';
                 $combine_url = $remove_base_url[0].'/'.$remove_base_url[1].'/'.$set_last_index;
              }
        }else{
          $combine_url = $remove_base_url[0].'/'.$remove_base_url[1];
        }
      }else{
        $combine_url = implode("/",$remove_base_url);
      }

  ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper" style="height: auto; min-height: 100%;">
  <div class="main-container">
    <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url()."content_management/"?>" style="height: 54px;" class="logo">
      <span class="logo-mini"></span>
      <span class="logo-lg"></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" id="sidebar_toggle" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <label> Hi  </label> <?php  echo ucwords($this->session->userdata('sess_name')); ?>!
            </a>

            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-footer">
                <a href="<?=base_url()?>content_management/login/unset_session">Sign out</a>
              </li>
              <li class="user-footer">
                <a href="<?=base_url()?>content_management/change_password" class="change-password">Change Password</a>
              </li>

            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu"></ul>
    </section>
  </aside>

  <script type="text/javascript">
  //Set Idle Time of User
   $(document).ready(function () {
        // 300000 milliseconds = 5 minutes
        var idleState = false;
        var idleTimer = null;
        $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
            clearTimeout(idleTimer);
            idleState = false;
            idleTimer = setTimeout(function () { 
                  modal.alert("Session has been idle over its time limit. You will be logged off automatically. ",function(){
                    location.href = "<?= base_url('content_management/login/unset_session');?>";    
                  });
                idleState = true; 
            }, 300000);
            ///300000
        });
        $("body").trigger("mousemove"); 
    });
    htm = '';
    //cms title
    aJax.get("<?= base_url('content_management/cms_preference/get_title');?>",function(data){
      $('.logo-lg').html(data);
    })

    //cms title logo-small
    aJax.get("<?= base_url('content_management/cms_preference/get_logo');?>",function(data){
      $('.logo-mini').html(data);
    })

    //cms title logo-small
    aJax.get("<?= base_url('content_management/cms_preference/get_skin');?>",function(data){
      $('body').addClass(data);
    })

    //cms side menu
    aJax.get("<?= base_url('content_management/cms_preference/get_menu');?>",function(data){
        var obj = is_json(data);
        if (/MSIE 9/i.test(navigator.userAgent)) {
            var new_obj = obj.replace(/\\/g, "");
            $('.sidebar-menu').html(new_obj);
        }else{
            $('.sidebar-menu').html(obj);
        } 
    })






    //side menu arrow down
/*    $(document).on('click', '.treeview a', function() {
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

      var menu_url = '<?= $combine_url; ?>';
      var user_role = '<?= $this->session->userdata('sess_role')?>';
        var url = '<?= base_url('content_management/global_controller');?>';
        var data = {
                event : "list", // list, insert, update, delete
                select : "cms_menu.id as menu_id, menu_url,menu_parent_id,menu_level ,menu_status, role_id,cms_menu_roles.menu_id as menu_roles_id,menu_role_read,menu_role_write,menu_role_delete", //select
                query : 'menu_url = "'+menu_url+'" AND  menu_status = 1 AND role_id = '+user_role+'' ,//query
                table : "cms_menu", // table
                join: [
                  {
                    table : 'cms_menu_roles',
                    query : 'cms_menu_roles.menu_id = cms_menu.id',
                    type : "left"
                  }

                ]
            }

          //get list
          aJax.post(url, data, function(result){
              var obj = is_json(result);
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

                   if ($("table td:nth-child(2)").has("span.move-menu").length > 0) {
                        $('tbody').sortable('disable');
                        $("table th:first-child,td:nth-child(2)").remove();
                   }
                   if ($("table td:nth-child(2)").has("input.select").length > 0) {
                       $("table th:first-child,td:nth-child(2)").remove();
                   }
                   if($('table td:last-child').has(".edit").length > 0){
                     $('table th:last-child,td:last-child').remove();
                   }

              }else if (role_write == 0 && role_delete == 1){
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

                   if ($("table td:first-child").has("input.select").length > 0) {
                      $("th :input").removeAttr('disabled');
                      $(".select").removeAttr('disabled');
                   }
                   if ($("table td:nth-child(2)").has("span.move-menu").length > 0) {
                      $('tbody').sortable('disable');
                      $("table th:first-child,td:nth-child(2)").remove();
                   }
                   if ($("table td:nth-child(2)").has("input.select").length > 0) {
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



  </script>

<?php $this->load->view("content_management/template/version_patch"); ?>
