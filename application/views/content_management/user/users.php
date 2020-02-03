<div class="box">
    <?php
        $data['buttons'] = ['add', 'search'];
        $this->load->view("content_management/template/buttons",$data);
    ?>

  <div class="box-body">
    <div class="col-md-12 list-data tbl-content" id="list-data">
         <table class= "table listdata table-striped">
           <thead>
              <tr>
                <th><input class ="selectall_user" type ="checkbox"></th>
                    <th class='center-content'>Name</th>
                    <th class='center-content'>Username</th>
                    <th class='center-content'>Email Address</th>
                    <th class='center-content'>User Role</th>
                    <th class='center-content'>Status</th>
                    <th class='center-content'>Signup <i class="glyphicon glyphicon-bell"></i> </th>
                    <th class='center-content'>Contact Us <i class="glyphicon glyphicon-bell"></i> </th>
                    <th class='center-content'>Login <i class="glyphicon glyphicon-bell"></i> </th>
                    <th class='center-content'>Edit</th>
                </tr>  
             </thead>
            <tbody></tbody>

         </table>
    </div>
      <div class="list_pagination"> </div>
   </div>
   
</div>

<script type="text/javascript">
    var role = "<?=$this->session->userdata('sess_role');?>";
    var limit = 10;
    var query = "cms_users.status >= 0";
    var offset = 1;

    $(document).ready(function(){
        $('.search-query').on("keypress", function(e) {
            if (e.keyCode == 13) {
                var keyword = $(this).val()
                query = "(cms_users.username LIKE '%" + keyword + "%' OR cms_users.name LIKE '%" + keyword + "%' OR cms_users.email LIKE '%" + keyword + "%') AND cms_users.status >= 0";

                get_list();
                get_pagination();
            }
        });

        get_list();
        get_pagination();

        $('.selectall_user').prop('checked', false);

        if(role == 6 || role == 7){
            $( '<a href="#" id="btn_unblock" data-status=0 class=" btn_status btn-sm btn btn-default cms-btn" style="display: none;"> Unblock </a>' ).insertAfter( $( ".btn_trash" ) );
        }


    });

    function get_list(){
        modal.loading(true);

        var url = "<?= base_url('content_management/global_controller');?>";

        if(role <= 3 || role == 6){
                query = "cms_user_roles.id = cms_users.role AND cms_users.role != 7 AND cms_users.role != 4 AND cms_users.role != 5";
        }else if (role == 4 || role == 5){
            query = "cms_users.role < 1";
        }
        var data = {
            event : 'list',
            select : "cms_users.id AS id, username, cms_users.name AS name, cms_user_roles.id AS role,cms_user_roles.name as role_name, email, cms_users.status AS status, notif_signup, notif_contactus,notif_login,user_block_logs",
            query : query,
            offset : offset,
            limit : limit,
            table : 'cms_users',
            join : [ //optional
                {
                    table : "cms_user_roles", //table
                    query : "cms_user_roles.id = cms_users.role", //join query
                    type : "left" //type of join
                }
            ]
        }

        aJax.post_async(url, data, function(result){
            var obj = is_json(result);
            var htm = '';
   

            $.each(obj, function(x,y){
                var status = (y.status == 1) ? status = "Active" : status = "Inactive";
       
                htm+="  <tr>";
                htm+="    <td><input class = 'select'  data-id = '"+y.id+"' data-name='"+y.name+"' data-logs='"+y.user_block_logs+"' type ='checkbox'></td>";
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

                htm+="    <td class='center-content'><a href='<?= base_url()."content_management/"?>users/edit_users/"+y.id+"' class='edit' data-status='"+y.status+"' id='"+y.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
                htm+="  </tr>";
            });

            $('.listdata tbody').html(htm);

            modal.loading(false);
        });
    }

    function get_pagination(){
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "pagination",
            select : "id",
            query : "status >= 0",
            offset : offset,
            limit : limit,
            table : "cms_users",
        }

        aJax.post(url,data,function(result){
            var obj = is_json(result);

            modal.loading(false);
            pagination.generate(obj.total_page, '.list_pagination', get_list);
        });
    }

    pagination.onchange(function(){
        offset = $(this).val();
        get_list();
    })

    //Add user
    $(document).on('click', '#btn_add', function(e){
        location.href = ('<?= base_url()."content_management/"?>users/add_users');
    });

  $(document).on('click', '#btn_unblock', function(e){
       var status = $(this).attr("data-status");
         modal.confirm("Are you sure you want to Unblock this record?",function(result){
            if(result){
                $('.selectall_user').prop('checked', false);
                $('.check_user_block:checked').each(function(index) {
                    id = $(this).attr('data-id');
                    name = $(this).attr('data-name');

                    var url = "<?= base_url("content_management/global_controller");?>";
                    var data = {
                        event : "update",
                        table : "cms_users",
                        field : "id",
                        where : id,
                        data : {
                            name : name,
                            user_error_logs : 0,
                            user_block_logs : 0,
                            user_lock_time : '0000-00-00 00:00:00'
                        },
                    }

                    aJax.post(url,data,function(result){
                        var obj = is_json(result);
                        modal.alert("<?= $this->standard->dialog("update_success"); ?>",function(){
                                get_list();
                                get_pagination();
                                $('.btn_status').hide();   
                        })
                    });
                });
            }
        })
    });


    //Update status
    $(document).on('click','.status_action',function(e){
        var status = $(this).attr("data-status");
        var id = "";
        var name = "";

        modal.confirm("Are you sure you want to Update this record?",function(result){
            if(result){
                $('.selectall_user').prop('checked', false);
                $('.select:checked').each(function(index) {
                    id = $(this).attr('data-id');
                    name = $(this).attr('data-name');

                    var url = "<?= base_url("content_management/global_controller");?>";
                    var data = {
                        event : "update",
                        table : "cms_users",
                        field : "id",
                        where : id,
                        data : {
                            name : name,
                            status : status,
                            update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                        },
                    }

                    aJax.post(url,data,function(result){
                        var obj = is_json(result);

                        if (obj == "success") {
                            get_list();
                            get_pagination();
                            $('.btn_status').hide();   
                        }
                    });
                });
            }
        })
    });


    $(document).on('change', '.selectall_user', function(){
      var del = 0;
      if(this.checked) { 
        $('.select').each(function() { 
          this.checked = true;  
          $('.btn_status').show();  
          $('#btn_unblock').hide();       
        });
      }else{
        $('.select').each(function() { 
          $('.btn_status').hide();
          
          this.checked = false;                 
        });         
      }
    });


    $(document).on('change', '.select', function(){
      $('.select').each(function() {  
            if (this.checked==true) { 
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


</script>

