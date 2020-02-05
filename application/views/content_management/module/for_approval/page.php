<div class="box">
    <?php $data["buttons"] = ["search"]; ?>  
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">   
        <!-- LIST TABLE -->
        <div class="table-responsive tbl-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <!-- <th style="width: 50px"><input class="selectall" type = "checkbox"></th> -->
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Contact Number</th>
                        <th>Status</th>
                        <th style="width: 50px;">Action</th>
                    </tr>
                </thead>
                <tbody class="table_body"></tbody>
            </table>
        </div>

        <div class="list_pagination"> </div>
<!--Modal: Login with Avatar Form-->
        <div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
            <!--Content-->
            <div class="modal-content">
              <div class="modal-body text-center mb-1">
                <div class="md-form ml-0 mr-0">
                  <span>Confirm Approve</span>
                  <input type="password" type="text" id="user_password" class="form-control form-control-sm validate ml-0">
                  <label data-error="wrong" data-success="right" for="user_password" class="ml-0">Enter password</label>
                </div>
                <div class="text-center mt-4">
                  <button class="btn btn-cyan mt-1 btn_confirm">Confirm</button>
                  <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Cancel</button>
                </div>
              </div>

            </div>
            <!--/.Content-->
          </div>
        </div>
    </div>
</div> 

<script type="text/javascript">
    var base_url = '<?=base_url();?>';
    var user_id = '<?= $this->session->userdata("sess_uid");?>';
    var keyword  = '';
    var offset   = 1;
    var limit    = 10;
    var id       = 0;
    AJAX.config.base_url(base_url);
    $(document).ready(function(){
        // alert(user_id);
        get_data(keyword);
    });
    function get_data(keyword){
        AJAX.select.offset(offset); //offset or Start
        AJAX.select.limit(limit); //limit result
        AJAX.select.table('tbl_users'); //selecting table
        AJAX.select.select('id,CONCAT(first_name,"",last_name) as full_name,email_address,mobile_number,status'); //selecting result : not accepting *

        // AJAX.select.where.equal("approved_status",0); 
        if(keyword) {
            AJAX.select.query(" (first_name like '%"+keyword+"%' OR last_name like '%"+keyword+"%' OR mobile_number like '%"+keyword+"%' OR email_address like '%"+keyword+"%' ) AND status = 0");
        }else{
            AJAX.select.where.equal("status", 0);
        }


        AJAX.select.order.asc("full_name"); 
        AJAX.select.exec(function(result){
           var obj = result;
           var html = '';
           if(obj.length > 0){
             $.each(obj,function(x,y){
                var status = (y.status === "1") ? status = "Active" : status = "Inactive";
                html += '<tr>';
                // html+="      <td class='text-center'><input class = 'select'  data-id = '"+y.id+"' data-name='"+y.full_name+"' type ='checkbox'></td>";
                html += '   <td>'+y.full_name+'</td>';
                html += '   <td>'+y.email_address+'</td>';
                html += '   <td>'+y.mobile_number+'</td>';
                html += '   <td>'+status+'</td>';
                html += '   <td><a href = "javascript:void(0)" data-id ="'+y.id+'" class="app_class">Approve</a></td>'
                html += '</tr>'
             });

             $('.table_body').html(html);
           }

        }, function(obj){
            pagination.generate(obj.total_page, ".list_pagination",10, 'table_body', 5);
            // console.log(result);
        }); 
        
    }

    $(document).on('click','.app_class',function(e){
        id = $(this).attr('data-id');
        $('#confirm_modal').modal('show');
    })

    $(document).on('click','.btn_confirm',function(e){
        password = $('#user_password').val();
        $('.validate_error_message').remove();
        $('#user_password').css('border-color','black');
        var error_message1 = "<span class='validate_error_message' style='color: red;'>"+form_empty_error+"<br></span>"
        if(password == ''){
            $('#user_password').css('border-color','red');
            $(error_message1).insertAfter($('#user_password'));
        }
        else{
            url = "<?= base_url("content_management/site_for_approval/validate_password");?>";
            type = "POST"
            data = 
                  {
                    password:$('#user_password').val()
                  };

            aJax.post(url,data,function(result){
                if(result == 1){
                    AJAX.update.table("tbl_users");
                    AJAX.update.where("id",id);

                    AJAX.update.params("status",1);
                    AJAX.update.params("approved_by",user_id);
                    AJAX.update.params("approved_date",moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

                    AJAX.update.exec(function(result){
                        modal.alert('Approved Successfully');
                        $('#confirm_modal').modal('hide');
                        get_data();
                    });

                }
                else{
                    var error_message2 = "<span class='validate_error_message' style='color: red;'>Incorrect Password<br></span>"
                    $('#user_password').css('border-color','red');
                    $(error_message2).insertAfter($('#user_password'));

                }
            });

        }
    });
</script>

