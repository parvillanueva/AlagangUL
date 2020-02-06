<div class="box">
    <?php $data["buttons"] = ["add","search"]; ?>  
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">   
        <!-- LIST TABLE -->
        <div class="table-responsive tbl-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Domain</th>
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
        get_data(keyword);
    });
    function get_data(keyword){
        AJAX.select.offset(offset); //offset or Start
        AJAX.select.limit(limit); //limit result
        AJAX.select.table('tbl_email_domain_whitelist'); //selecting table
        AJAX.select.select('id,domain'); //selecting result : not accepting *

        // AJAX.select.where.equal("approved_status",0); 
        if(keyword) {
            AJAX.select.query(" (domain like '%"+keyword+"%')");
        }

        AJAX.select.order.asc("domain"); 
        AJAX.select.exec(function(result){
           var obj = result;
           var html = '';
           if(obj.length > 0){
             $.each(obj,function(x,y){
                html += '<tr>';
                html += '   <td>'+y.domain+'</td>';
                html += '   <td><a  href="<?= base_url()."content_management/"?>site_domain_whitelist/update/'+y.id+'" data-id ="'+y.id+'" class="app_class">Edit</a> | <a  href="javascript:void(0)" data-id ="'+y.id+'" class="btn_delete">Delete</a></td>'
                html += '</tr>'
             });

             $('.table_body').html(html);
           }

        }, function(obj){
            pagination.generate(obj.total_page, ".list_pagination",10, 'table_body', 2);
            // console.log(result);
        }); 
        
    }

    $(document).on('click','.btn_add',function(e){
        location.href = ('<?= base_url()."content_management/"?>site_domain_whitelist/add');
    })

    $(document).on('click','.btn_delete',function(e){
        table_id = $(this).attr('data-id');
        var modal_obj = '<?= $this->standard->confirm("confirm_delete"); ?>'; 
        modal.standard(modal_obj, function(result){
            $.ajax({
                type : "POST",
                url  :  "<?= base_url('content_management/site_domain_whitelist/delete');?>",
                dataType : "JSON",
                data : {id:table_id,},
                  beforeSend: function() {
                  modal.loading(true);
                  },
                  success: function(data) {
                  },
                  complete: function(data){
                    modal.loading(false);
                    get_data(keyword);
                  }
            });
        });
    })


    
</script>

