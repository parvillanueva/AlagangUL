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
                    </tr>
                </thead>
                <tbody class="table_body"></tbody>
            </table>
        </div>

        <div class="list_pagination"> </div>
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
            AJAX.select.query(" (first_name like '%"+keyword+"%' OR last_name like '%"+keyword+"%' OR mobile_number like '%"+keyword+"%' OR email_address like '%"+keyword+"%' ) AND status = 1");
        }else{
            AJAX.select.where.equal("status", 1);
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
                html += '</tr>'
             });

             $('.table_body').html(html);
           }

        }, function(obj){
            pagination.generate(obj.total_page, ".list_pagination",10, 'table_body', 4);
            // console.log(result);
        }); 
        
    }


</script>

