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
                        <th>Reward Name</th>
                        <th>Reward Image</th>
                        <th>Current Stock</th>
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
        AJAX.select.table('tbl_reward_products'); //selecting table
        AJAX.select.select('tbl_reward_products.id,reward_name,reward_image,tbl_reward_products.status,current_stocks'); //selecting result : not accepting *
        AJAX.select.join.left("tbl_reward_inventory", "tbl_reward_inventory.id","tbl_reward_products.id"); 
        if(keyword) {
            AJAX.select.query(" (reward_name like '%"+keyword+"%' OR current_stocks like '%"+keyword+"%') and tbl_reward_products.status >= 0");
        }else{
            AJAX.select.where.greater_equal("tbl_reward_products.status",0); 
        }

        AJAX.select.order.asc("reward_name"); 
        AJAX.select.exec(function(result){
           var obj = result;
           var html = '';
           if(obj.length > 0){
             $.each(obj,function(x,y){
                var status = (y.status === "1") ? status = "Active" : status = "Inactive";
                html += '<tr>';
                html+="      <td class='text-center'><input class = 'select'  data-id = '"+y.id+"' data-name='"+y.reward_name+"' type ='checkbox'></td>";
                html += '   <td>'+y.reward_name+'</td>';
                // console.log(y.reward_image);
                html += '   <td>';
                    if (y.reward_image != '' ) {
                        // alert(1);
                html += "<img style='max-width:200px;' src='<?= base_url()."/"?>"+y.reward_image+"'>";
                        // status_action = 1;
                    }
                html += '   </td>';
                html += '   <td>'+y.current_stocks+'</td>';
                html += '   <td>'+status+'</td>';
                html += '   <td><center><a  href="javascript:void(0)" class="btn_add_stock" data-id ="'+y.id+'" class="app_class "><i class="fas fa-plus"></i></a>&nbsp&nbsp|&nbsp&nbsp<a  href="<?= base_url()."content_management/"?>site_reward_products/update/'+y.id+'" data-id ="'+y.id+'" class="app_class"><i class="fas fa-edit"></i></a></center></td>'
                html += '</tr>'
             });

             $('.table_body').html(html);
           }

        }, function(obj){
            pagination.generate(obj.total_page, ".list_pagination",10, 'table_body', 5);
            // console.log(result);
        }); 
        
    }

    $(document).on('click','.btn_add',function(e){
        location.href = ('<?= base_url()."content_management/"?>site_reward_products/add');
    })

    $(document).on('click','.btn_add_stock',function(e){
        // location.href = ('<?= base_url()."content_management/"?>site_reward_products/add');
        id = $(this).attr('data-id');
        AJAX.select.table('tbl_reward_inventory');
        AJAX.select.select('id,current_stocks,total_stocks');  
        AJAX.select.where.equal("product_id",id); 
        AJAX.select.exec(function(result){
            var obj = result;
            // var total_stocks;
            $.each(obj,function(x,y){
                var modal_obj = '<b>Add Stock</b><br>Current Stock:'+y.current_stocks;
                var total_stocks = parseInt(y.total_stocks);
                var total_current_stocks = parseInt(y.current_stocks); 
                modal.input(modal_obj,'number',function(result){
                    if(result){
                        var modal_obj2 = '<?= $this->standard->confirm("confirm_update"); ?>'; 
                        modal.standard(modal_obj2, function(result2){
                            if(result2){
                                total_stocks = total_stocks + parseInt(result);
                                total_current_stocks = total_current_stocks + parseInt(result);
                                    AJAX.update.table("tbl_reward_inventory");
                                    AJAX.update.where("product_id",1);

                                    AJAX.update.params("current_stocks",total_current_stocks);
                                    AJAX.update.params("total_stocks",total_stocks);

                                    AJAX.update.exec(function(result){
                                         get_data(keyword);
                                    });
                            }
                        });
                    }
                });     
            });
        });
    })
</script>

