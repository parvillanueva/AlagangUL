<div class="box">
    <?php $data["buttons"] = ["add","search"]; ?>  
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">   
        <!-- LIST TABLE -->
        <div class="table-responsive tbl-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class = "w-10"></th>
                        <th class = "w-10 center-align-format"><input class ="selectall" type ="checkbox"></th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date Modified</th>
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
        get_data(keyword);
    });
    
    function get_data(keyword){
        AJAX.select.offset(offset); 
        AJAX.select.limit(limit); 
        AJAX.select.table('tbl_banner_list'); 
        AJAX.select.select('id,title, description, updated_date, status');

        if(keyword) {
           // AJAX.select.query(" (first_name like '%"+keyword+"%' OR last_name like '%"+keyword+"%' OR mobile_number like '%"+keyword+"%' OR email_address like '%"+keyword+"%' ) AND status = 1");
        }else{
            AJAX.select.where.equal("status", 1);
        }


        AJAX.select.order.asc("title"); 
        AJAX.select.exec(function(result){
           var obj = result;
           var html = '';
           if(obj.length > 0){
             $.each(obj,function(x,y){
                var status = (y.status === "1") ? status = "Active" : status = "Inactive";
                html += '<tr>';
                html += '<td class="hide"><p class="order" data-order="" data-id='+y.id+'></p></td>';
                html += '<td class="list-bg-color"><span class="list-span-color move-menu glyphicon glyphicon-th"></span></td>';
                html +="      <td class='text-center'><input class = 'select'  data-id = '"+y.id+"' data-name='"+y.title+"' type ='checkbox'></td>";
                html += '   <td>'+y.title+'</td>';
                html += '   <td>'+y.description+'</td>';
                html += '   <td>'+y.updated_date+'</td>';
                html += '   <td>'+status+'</td>';
                html += "<td class = 'center-align-format' ><a href='<?= base_url()."content_management/Site_banner/edit"?>/"+y.id+"'  class='edit' title='edit'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                html += '</tr>'
             });

             $('.table_body').html(html);
           }

        }, function(obj){
            pagination.generate(obj.total_page, ".list_pagination",10, 'table_body', 7);
        }); 
        
    }

    $(document).on('click', '#btn_add', function(e) {
            location.href = '<?=base_url("content_management/Site_banner/add");?>';
    });

</script>
