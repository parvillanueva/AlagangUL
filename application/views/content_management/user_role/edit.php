<style type="text/css">
    
.module_content{
    overflow: auto;
    height: 300px;
}
.menu_header_ul {
    padding: 0;
    display: block;
    vertical-align: middle;
    margin: 0;
}
.menu_header_ul li{
    display: inline-block;
    width:15%;
    text-align: center;
}

.menu_header_ul li:first-child {
    width: 50%;
    text-align: left;
}

.menu_header_li span {
    padding-left: 10px;
}

.module_header_container {
    position: absolute;
    width: 100%;
    padding: 9px 0px;
    overflow: hidden;
    background: #222d32;
    color: #fff;
    font-weight: 600;
    font-size: 15px;
    z-index: 1;
}
.module_body_container {
    padding-top: 40px;
    width: 100%;
    position: relative;
}

.module_col {
    position: relative;
    width: 100%;
    overflow: hidden;
}
ul.parent_menu {
    padding: 0;
    display: block;
    vertical-align: middle;
    margin: 0;
    font-size: 16px;
}

ul.child_menu {
    padding: 0;
    display: block;
    vertical-align: middle;
    margin: 0;
}


.menu_title {
    display: inline-block;
    width: 52%;
    background: rgba(44, 59, 65, 0.15);
    color: #000;
    font-weight: 500;
    font-size : 17px;
}

.menu_title span {
    padding-left: 10px;
}

.menu_chkbx {
    display: inline-block;
    width: 16%;
    text-align: center;
    background: rgba(44, 59, 65, 0.15);
    font-size: 17px;
}



.sub_menu_title {
    display: inline-block;
    width: 52%;
}

.sub_menu_title span {
    padding-left: 20px;
}

.sub_menu_chkbx {
    display: inline-block;
    width: 16%;
    text-align: center;
}



</style>


<div class="box">
    <?php $data["buttons"] = ["update","close"]; ?>
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">
        <?php
            $role_id = $this->uri->segment(4);
            $content_details = $this->load->details("cms_user_roles", $role_id);

            $inputs = [
                'name',
                'status'
            ];

            $values = [
                $content_details[0]->name,
                $content_details[0]->status
            ];

            $content_id = $this->standard->inputs($inputs,$values);
        ?>

        <div class="form-group">
            <label class="control-label status_label col-sm-2">Display</label>
            <div class="col-sm-10">
                <div class="module_col">
                        <div class="module_content">
                                <div class= "module_header_container">
                                        <ul class= "menu_header_ul">
                                            <li class="menu_header_li"><span>Modules</span></li>
                                            <li class="menu_header_li"><input class="select_all_read" type = "checkbox"><span> Read</span></li>
                                            <li class="menu_header_li"><input class="select_all_write" type = "checkbox"><span> Write</span></li>
                                            <li class="menu_header_li"><input class="select_all_delete" type = "checkbox"><span> Delete</span></li>
                                        </ul>
                                  </div> 
                                <div class="module_body_container">
                              </div>
                        </div>
     
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div> 



<script type="text/javascript">

    <?php 
        $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

        $urls = explode('/', $escaped_url);
        array_pop($urls);
    ?>

    var current_url = "<?= $url;?>";
    var menu_role_id = "<?= $role_id; ?>";
    var counter = 0;
    var role = "<?=$this->session->userdata('sess_role');?>";
    var query = '';

    $(document).ready(function(){
        get_data();
    });

    function get_data(){

        if(role == 7){
          query = "role_id = "+menu_role_id+" AND menu_level = 1 AND menu_status = 1 ";
        }else{
           query = "role_id = "+menu_role_id+" AND menu_level = 1 AND menu_status = 1 AND menu_id != 8 AND menu_id != 6";
        } 

        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
             event: "list",
             select: "cms_menu.id as menu_id,menu_name,menu_type,menu_parent_id,menu_level,menu_status,menu_orders,role_id,cms_menu_roles.menu_id as roles_menu_id,menu_role_read,menu_role_write,menu_role_delete",
             table: "cms_menu",
             query: query,
             join : [ //optional
                {
                    table : "cms_menu_roles", //table
                    query : "cms_menu_roles.menu_id = cms_menu.id", //join query
                    type : "left" //type of join
                }
            ],
             order: {
                field: "menu_orders",
                order: "asc"
             }
        }

        aJax.post_async(url,data,function(result){
            var obj = is_json(result);
            var htm = '';

           if(obj.length > 0){  
                $.each(obj,function(x,y){
                    var checked_read = ( y.menu_role_read == 1 ) ? checked_read = "checked" : checked_read = "";
                    var checked_write = ( y.menu_role_write == 1 ) ? checked_write = "checked" : checked_write = "";
                    var checked_delete = ( y.menu_role_delete == 1 ) ? checked_delete = "checked" : checked_delete = "";

                    htm += "<ul class='parent_menu'>";
                        if(y.menu_level == 1){
                          htm += "<li class='main_menu_"+y.menu_id+"'>";
                          htm += "<div class='menu_title'><input type='hidden' class='menu_id_"+counter+"' data-id="+y.menu_id+"><span>"+y.menu_name+"</span></div>"; 
                          htm += "<div class='menu_chkbx'><input class='chckbx_menu  read_"+counter+" chckbx_menu_read parent_chckbox_read_"+y.menu_id+"' type = 'checkbox'  name='menu_role_read' data-id="+y.menu_id+" value="+y.menu_role_read+" onchange='chckbox_parent_menu("+y.menu_id+")' "+checked_read+"></div>";
                          htm += "<div class='menu_chkbx'><input class='chckbx_menu write_"+counter+" chckbx_menu_write parent_chckbox_write_"+y.menu_id+"' name='menu_role_write' type = 'checkbox' data-id="+y.menu_id+" value="+y.menu_role_write+" onchange='chckbox_parent_menu("+y.menu_id+")'  "+checked_write+"></div>";
                          htm += "<div class='menu_chkbx'><input class='chckbx_menu delete_"+counter+" chckbx_menu_delete parent_chckbox_delete_"+y.menu_id+"' name='menu_role_delete' type = 'checkbox' data-id="+y.menu_id+" value="+y.menu_role_delete+" onchange='chckbox_parent_menu("+y.menu_id+")' "+checked_delete+"></div>";
                          htm += "</li>";
                            get_sub_menu(y.menu_id);
                        }
                    htm += "</ul>";
                    counter++;
                });



             }else{
                htm += '    <ul>';
                htm += '        <li style="text-align: center;">No Results Found.</li>';
                htm += '    </ul>';
             }
            $('.module_body_container').html(htm);

        });
    }


    function get_sub_menu(id){
        if(role == 7){
          query = "role_id = "+menu_role_id+" AND menu_parent_id = "+id+" AND menu_level = 2 AND menu_status = 1";
        }else{
           query = "role_id = "+menu_role_id+" AND menu_parent_id = "+id+" AND menu_level = 2 AND menu_status = 1 AND menu_id != 14 AND menu_id != 15 AND menu_id != 22";
        } 

        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event:"list",
            select:"cms_menu.id as menu_id,menu_name,menu_type,menu_parent_id,menu_level,menu_status,menu_orders,role_id,cms_menu_roles.menu_id as roles_menu_id,menu_role_read,menu_role_write,menu_role_delete",
            table: "cms_menu",
            query: query,
             join : [ //optional
                {
                    table : "cms_menu_roles", //table
                    query : "cms_menu_roles.menu_id = cms_menu.id", //join query
                    type : "left" //type of join
                }
            ],
            order:{
                field: "menu_orders",
                order: "asc"
             }

        }

        aJax.post_async(url,data,function(result){
            var obj = is_json(result);
              console.log(obj);
            var htm = '';
            if(obj.length > 0){
                 $.each(obj,function(a,b){  
                      var checked_read = ( b.menu_role_read == 1 ) ? checked_read = "checked" : checked_read = "";
                      var checked_write = ( b.menu_role_write == 1 ) ? checked_write = "checked" : checked_write = "";
                      var checked_delete = ( b.menu_role_delete == 1 ) ? checked_delete = "checked" : checked_delete = "";

                      htm += "<ul class='child_menu'>";
                          if(b.menu_level == 2){
                              htm += "<li class='sub_menu_"+b.menu_id+"'>";
                              htm += "<div class='sub_menu_title'><input type='hidden' class='menu_id_"+counter+"' data-id="+b.menu_id+"><span>"+b.menu_name+"</span></div>";
                              htm += "<div class='sub_menu_chkbx'><input class='chckbx_menu read_"+counter+" chckbx_menu_read sub_checker_read_"+id+" sub_chckbox_read_"+counter+"' name='menu_role_read' type = 'checkbox' data-id="+b.menu_id+" value="+b.menu_role_read+" onchange='chckbox_sub_menu("+counter+","+id+")' "+checked_read+"></div>";
                              htm += "<div class='sub_menu_chkbx'><input class='chckbx_menu write_"+counter+" chckbx_menu_write sub_checker_write_"+id+" sub_chckbox_write_"+counter+"' name='menu_role_write' type = 'checkbox' data-id="+b.menu_id+" value="+b.menu_role_write+" onchange='chckbox_sub_menu("+counter+","+id+")' "+checked_write+"></div>";
                              htm += "<div class='sub_menu_chkbx'><input class='chckbx_menu delete_"+counter+" chckbx_menu_delete sub_checker_delete_"+id+" sub_chckbox_delete_"+counter+"' name='menu_role_delete' type = 'checkbox' data-id="+b.menu_id+" value="+b.menu_role_delete+" onchange='chckbox_sub_menu("+counter+","+id+")' "+checked_delete+"></div>";
                              htm += "</li>";
                          }
                      htm += "</ul>";

                    counter++;
                     
                });

                $(htm).insertAfter( $('.main_menu_'+id+'') );
                //Select all Read
                select_read();
                //Select all Write
                select_write();
                //Select all Delete
                select_delete();
            }

    });

   }


   function select_read(){
        var read_checkbox_count = $('input[name="menu_role_read"]').length;
        var read_checked_checkboxes_count = $('input[name="menu_role_read"]:checked').length;
        if (read_checkbox_count == read_checked_checkboxes_count) {
            $(".select_all_read").prop("checked", true);
        } else {
            $(".select_all_read").prop("checked", false);
        }

   }


   function select_write(){
        var write_checkbox_count = $('input[name="menu_role_write"]').length;
        var write_checked_checkboxes_count = $('input[name="menu_role_write"]:checked').length;
        if (write_checkbox_count == write_checked_checkboxes_count) {
            $(".select_all_write").prop("checked", true);
        } else {
            $(".select_all_write").prop("checked", false);
            $('.select_all_read').attr('disabled',false);
        }
   }


   function select_delete(){
        var delete_checkbox_count = $('input[name="menu_role_delete"]').length;
        var delete_checked_checkboxes_count = $('input[name="menu_role_delete"]:checked').length;
        if (delete_checkbox_count == delete_checked_checkboxes_count) {
            $(".select_all_delete").prop("checked", true);
        } else {
            $(".select_all_delete").prop("checked", false);
            $('.select_all_read').attr('disabled',false);
        }   
   }


   //Set Value of checkbox
    $(document).on('change', '.chckbx_menu', function(){
        if (this.checked==true) { 
            $(this).val(1);
        } else {
            $(this).val(0);
        }

        //Select all Read
        select_read();
        //Select all Write
        select_write();
        //Select all Delete
        select_delete();

    });


    function chckbox_sub_menu(count_id,id){
         //check parent menu read column
         if($('input.sub_chckbox_read_'+count_id+'').is(':checked')){
              $('.parent_chckbox_read_'+id+'').prop("checked", true).val(1);

         }

         //check parent menu read column if write and delete is checked
         if (($('input.sub_chckbox_write_'+count_id+'').is(':checked'))) {
              $('.sub_chckbox_read_'+count_id+'').prop("checked", true).attr('disabled',true).val(1);
              $('.parent_chckbox_read_'+id+'').prop("checked", true).attr('disabled',true).val(1);
              $('.parent_chckbox_write_'+id+'').prop("checked", true).val(1);
  
          } else {
             $('.sub_chckbox_read_'+count_id+'').attr('disabled',false);
             $('.parent_chckbox_read_'+id+'').attr('disabled',false);
          }


         //check parent menu read column if write and delete is checked
         if (($('input.sub_chckbox_delete_'+count_id+'').is(':checked'))) {
              $('.sub_chckbox_read_'+count_id+'').prop("checked", true).attr('disabled',true).val(1);
              $('.parent_chckbox_read_'+id+'').prop("checked", true).attr('disabled',true).val(1);
              $('.parent_chckbox_delete_'+id+'').prop("checked", true).val(1);
  
          } else {
             $('.sub_chckbox_read_'+count_id+'').attr('disabled',false);
             $('.parent_chckbox_read_'+id+'').attr('disabled',false);
          }



       /// Unchecked parent menu  if all sub menu value is 0 
         if(($('.sub_checker_read_'+id+':checked').length) == 0){
             $('.parent_chckbox_read_'+id+'').prop("checked", false).val(0);
         }


       /// Unchecked parent menu  if all sub menu value is 0 
         if(($('.sub_checker_write_'+id+':checked').length) == 0){
             $('.parent_chckbox_write_'+id+'').prop("checked", false).val(0);
         }

      
         if(($('.sub_checker_delete_'+id+':checked').length) == 0){
             $('.parent_chckbox_delete_'+id+'').prop("checked", false).val(0);
         }


    }



    function chckbox_parent_menu(id){
        if(($('input.parent_chckbox_read_'+id+'').is(':checked'))){
            $('.sub_checker_read_'+id+'').prop("checked", true).val(1);
        }else{
            $('.sub_checker_read_'+id+'').prop("checked", false).val(0);
        }

        //check  read column if write  is checked
         if (($('input.parent_chckbox_write_'+id+'').is(':checked'))) {
              $('.sub_checker_write_'+id+'').prop("checked", true).val(1);
              $('.parent_chckbox_read_'+id+'').prop("checked", true).val(1);
              $('.sub_checker_read_'+id+'').prop("checked", true).attr('disabled',true).val(1);    
          } else {
             $('.sub_checker_write_'+id+'').prop("checked", false).val(0);
             $('.parent_chckbox_read_'+id+'').attr('disabled',false);
             $('.sub_checker_read_'+id+'').attr('disabled',false);
          }

         if (($('input.parent_chckbox_delete_'+id+'').is(':checked'))) {
              $('.sub_checker_delete_'+id+'').prop("checked", true).val(1);
              $('.parent_chckbox_read_'+id+'').prop("checked", true).val(1);
              $('.sub_checker_read_'+id+'').prop("checked", true).attr('disabled',true).val(1);    
          } else {
             $('.sub_checker_delete_'+id+'').prop("checked", false).val(0);
             $('.parent_chckbox_read_'+id+'').attr('disabled',false);
             $('.sub_checker_read_'+id+'').attr('disabled',false);
          }


    }

    //Select all function for Read
    $(document).on('change', '.select_all_read', function(){
      if(this.checked) { 
        $('.chckbx_menu_read').each(function() { 
          this.checked = true; 
          this.value = 1;      
        });
      }else{
        $('.chckbx_menu_read').each(function() { 
          this.checked = false; 
          this.value = 0;                
        });         
      }
    });

    //Select all function for write
    $(document).on('change', '.select_all_write', function(){
      if(this.checked) { 
        $('.chckbx_menu_write').each(function() { 
          this.checked = true; 
          this.value = 1; 
            $('.chckbx_menu_read').each(function() { 
              this.checked = true; 
              this.value = 1;      
            });
            $('.select_all_read').prop("checked", true);  
            $('.select_all_read').attr('disabled',true);
            $('.chckbx_menu_read').attr('disabled',true);  
        });
      }else{
        $('.chckbx_menu_write').each(function() { 
          this.checked = false; 
          this.value = 0;                
        });    
        $('.select_all_read').attr('disabled',false);
        $('.chckbx_menu_read').attr('disabled',false);      
      }


    });

    //Select all function for delete
    $(document).on('change', '.select_all_delete', function(){
      if(this.checked) { 
        $('.chckbx_menu_delete').each(function() { 
          this.checked = true; 
          this.value = 1; 
            $('.chckbx_menu_read').each(function() { 
              this.checked = true; 
              this.value = 1;      
            });
            $('.select_all_read').prop("checked", true);  
            $('.select_all_read').attr('disabled',true);
            $('.chckbx_menu_read').attr('disabled',true);  
        });
      }else{
        $('.chckbx_menu_delete').each(function() { 
          this.checked = false; 
          this.value = 0;                
        });    
        $('.select_all_read').attr('disabled',false);
        $('.chckbx_menu_read').attr('disabled',false);      
      }


    });


    function save_role_module(role_id){
        var url = "<?= base_url('content_management/user_role/update_role');?>";
        for (var i = 0; i < counter; i++) {
            var menu_id = $('.menu_id_'+i+'').attr('data-id');
             var data = {
                 table : "cms_menu_roles",
                 where : "role_id = "+role_id+" AND menu_id = "+menu_id+"",
                 data : {
                        menu_role_read: $('.read_'+i+'').val(),
                        menu_role_write: $('.write_'+i+'').val(),
                        menu_role_delete: $('.delete_'+i+'').val(),
                        menu_role_updated_date: moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                        menu_role_created_date: moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                }

             }
            aJax.post(url ,data ,function(result){
                modal.loading(false);
                modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                    location.href = '<?=base_url("content_management/user_role") ?>';

                }); 
            });
        } 
    }


    $(document).on('click', '#btn_update', function(){  
        if(validate.standard("<?= $content_id;?>")){
            var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>'; 
            modal.standard(modal_obj, function(result){
                if(result){
                    modal.loading(true);
                    var url = "<?= base_url('content_management/global_controller');?>";
                    var data = {
                        event : "update",
                        table : "cms_user_roles",
                        field : "id",
                        where : menu_role_id,
                        data : {

                                name : $('#name').val(),
                                status : $('#status').val(),
                                create_date :  moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                                update_date :  moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                       }  
                    }

                    aJax.post(url,data,function(result){ 
                        var obj = is_json(result);          
                        save_role_module(menu_role_id);
                    });
                }
            });
        }
    }); 




    $(document).on('click', '#btn_close', function(e){
        location.href = '<?=base_url("content_management/user_role") ?>';
    });

</script>