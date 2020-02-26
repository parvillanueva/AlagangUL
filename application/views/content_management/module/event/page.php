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
                        <th>Title</th>
                        <th>Url Alias</th>
                        <th>Venue</th>
						<th>City</th>
                        <th>When</th>
						<th>Contact Person</th>
						<th>Creator</th>
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
        AJAX.select.table('tbl_program_events tblpe'); //selecting table
        AJAX.select.select('tblpe.id, title, url_alias, venue, city, when, contact_person, user_id, tblpe.status, tblpe.create_date, tbl_users.last_name, tbl_users.first_name'); //selecting result : 

        if(keyword) {
            AJAX.select.query(" (tbl_users.first_name like '%"+keyword+"%' OR tbl_users.last_name like '%"+keyword+"%' OR title like '%"+keyword+"%' OR url_alias like '%"+keyword+"%' OR city like '%"+keyword+"%' OR contact_person like '%"+keyword+"%' OR venue like '%"+keyword+"%') and tblpe.status >= 0");
        }else{
            AJAX.select.where.greater_equal("tblpe.status",0); 
        }
		AJAX.select.join.inner('tbl_users', 'tblpe.user_id', 'tbl_users.id'); 
        AJAX.select.order.asc("tblpe.create_date"); 
        AJAX.select.exec(function(result){
           var obj = result;
           var html = '';
           if(obj.length > 0){
             $.each(obj,function(x,y){
                var status = (y.status === "1") ? status = "Active" : status = "Inactive";
                html += '<tr>';
                html+="     <td class='text-center'><i class='glyphicon glyphicon-th'></i></td>";
                html += '   <td>'+y.title+'</td>';
                html += '   <td>'+y.url_alias+'</td>';
				html += '   <td>'+y.venue+'</td>';
				html += '   <td>'+y.city+'</td>';
				html += '   <td>'+y.when+'</td>';
				html += '   <td>'+y.contact_person+'</td>';
				html += '   <td>'+y.first_name+' '+y.last_name+'</td>';
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

