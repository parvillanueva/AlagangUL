<div class="box">
    <?php $data["buttons"] = ["search"]; ?>  
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">   
        <!-- LIST TABLE -->
        <div class="table-responsive tbl-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 50px"><center><i class="glyphicon glyphicon-th-list"></i></center></th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Overview</th>
                        <!-- <th>Color</th> -->
                        <th>Headline</th>
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
        AJAX.select.table('tbl_programs'); //selecting table
        AJAX.select.select('id,image_thumbnail,name,overview,headline,area_covered,status,create_date'); //selecting result : 

        if(keyword) {
            AJAX.select.query(" (name like '%"+keyword+"%' OR overview like '%"+keyword+"%' OR headline like '%"+keyword+"%') and status >= 0");
        }else{
            AJAX.select.where.greater_equal("status",0); 
        }

        AJAX.select.order.asc("create_date"); 
        AJAX.select.exec(function(result){
           var obj = result;
           var html = '';
           if(obj.length > 0){
             $.each(obj,function(x,y){
                var status = (y.status === "1") ? status = "Active" : status = "Inactive";
                html += '<tr>';
                html+="     <td class='text-center'><i class='glyphicon glyphicon-th'></i></td>";
                html += '   <td>'+y.name+'</td>';
                html += '   <td><img src="<?= base_url()?>'+y.image_thumbnail+'" alt ="" style="max-width: 100px;"></td>';
                html += '   <td>'+y.overview+'</td>';
				html += '   <td>'+y.headline+'</td>';
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

    /* $(document).on('click','.status_action',function(e){
        var status = $(this).attr("data-status");
        var id = "";
        var name = "";

        modal.confirm("Are you sure you want to Update this record?",function(result){
            if(result){
                $('.selectall_user').prop('checked', false);
                $('.select:checked').each(function(index) {
                    id = $(this).attr('data-id');
                    // name = $(this).attr('data-name');

                    AJAX.update.table("tbl_badges");
                    AJAX.update.where("id",id);

                    AJAX.update.params("status",status);

                    AJAX.update.exec(function(result){
                        get_data(keyword);
                    });
                });
            }
        })
    }); */

</script>

