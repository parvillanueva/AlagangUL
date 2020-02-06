<div class="box">
    <?php $data["buttons"] = ["add","search"]; ?>  
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">   
        <!-- LIST TABLE -->
        <div class="table-responsive tbl-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 50px"><center><input class="selectall" type = "checkbox"></center></th>
                        <th>Name</th>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
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
        AJAX.select.table('tbl_category'); //selecting table
        AJAX.select.select('id,name,status'); //selecting result : not accepting *

        if(keyword) {
            AJAX.select.query(" (name like '%"+keyword+"%') and status >= 0");
        }else{
            AJAX.select.where.greater_equal("status",0); 
        }

        AJAX.select.order.asc("name"); 
        AJAX.select.exec(function(result){
           var obj = result;
           var html = '';
           if(obj.length > 0){
             $.each(obj,function(x,y){
                var status = (y.status === "1") ? status = "Active" : status = "Inactive";
                html += '<tr>';
                html+="      <td class='text-center'><input class = 'select'  data-id = '"+y.id+"' data-name='"+y.name+"' type ='checkbox'></td>";
                html += '   <td>'+y.name+'</td>';
                html += '   <td>'+status+'</td>';
                html += '   <td><a  href="<?= base_url()."content_management/"?>site_category/update/'+y.id+'" data-id ="'+y.id+'" class="app_class">Edit</a></td>'
                html += '</tr>'
             });

             $('.table_body').html(html);
           }

        }, function(obj){
            pagination.generate(obj.total_page, ".list_pagination",10, 'table_body', 4);
            // console.log(result);
        }); 
        
    }

    $(document).on('click','.btn_add',function(e){
        location.href = ('<?= base_url()."content_management/"?>site_category/add');
    })

    
</script>

