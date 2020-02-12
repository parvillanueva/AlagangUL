<div class="box">
    <?php $data["buttons"] = ["add","search"]; ?>  
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">   
        <!-- LIST TABLE -->
        <div class="table-responsive tbl-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <!-- <th class = "w-10"></th> -->
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
   
    function get_data(keyword){
        AJAX.select.offset(offset); 
        AJAX.select.limit(limit); 
        AJAX.select.table('tbl_banner_list'); 
        AJAX.select.select('id,title, description, updated_date, status');

        
        if(keyword) {
           AJAX.select.query(" (title like '%"+keyword+"%' OR description like '%"+keyword+"%') AND status >= 0");
        //    AJAX.select.where.greater_equal("status",0);
        //    AJAX.select.where.or.like("title", keyword);
        //    AJAX.select.where.or.like("description", keyword);

        }else{
            AJAX.select.where.greater_equal("status",0);
        }


        AJAX.select.order.asc("title"); 
        AJAX.select.exec(function(result){
           var obj = result;
           var html = '';
           if(obj.length > 0){
             $.each(obj,function(x,y){
                var status = (y.status === "1") ? status = "Active" : status = "Inactive";
                html += '<tr>';
                // html += '<td class="hide"><p class="order" data-order="" data-id='+y.id+'></p></td>';
                // html += '<td class="list-bg-color"><span class="list-span-color move-menu glyphicon glyphicon-th"></span></td>';
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

    $(document).ready(function(){
        get_data(keyword);
    });

    $(document).on('keypress', '#search_query', function(e) {               
        if (e.keyCode === 13) {
            var keyword = $(this).val().trim();
            offset = 1;
            get_data(keyword);
        }
    });
    
    $(document).on('click', '#btn_add', function(e) {
        location.href = '<?=base_url("content_management/Site_banner/add");?>';
    });

    $(document).on('click','.btn_status',function(e) {
        var status = $(this).attr("data-status");
        var id = "";
        var id_array = [];
        var modal_obj = "";
        var modal_alert = "";
        if (parseInt(status) === -2) {
            modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>';
            modal_alert_success = "success_delete_message";
            offset = 1;
        } else if(parseInt(status) === 1) {
            modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>';
            modal_alert_success = "success_publish_message";
        } else  {
            modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>';
            modal_alert_success = "success_unpublish_message";
        }
        modal.standard(modal_obj, function(result) {
            if (result) {
                $('.selectall').prop('checked', false);
                $('.select:checked').each(function(index) { 
                    id = $(this).attr('data-id');
                    id_array.push(id);
                });

                modal.loading(true);
                AJAX.batch_update.table("tbl_banner_list");
                AJAX.batch_update.field("id");
                AJAX.batch_update.where_in(id_array);
                AJAX.batch_update.params("status", status);
                AJAX.batch_update.params("updated_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
                AJAX.batch_update.params("updated_by", user_id);
                AJAX.batch_update.exec(function(result) {
                    modal.loading(false);
                    if (result.message === "success") {
                        modal.alert(modal_alert_success, function() {
                            location.href = '<?=base_url("content_management/Site_banner");?>';
                        });
                    } else {
                        modal.alert(failed_transaction_message, function() {
                        });
                    }
                });
            }
        });
    });

</script>
