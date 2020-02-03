<div class="box">

	<?php	
		$data['buttons'] = ['add', 'search','close']; // add, save, update
		$this->load->view("content_management/template/buttons", $data);
	?>	
		<div class="box-body">

      <div class="col-md-12 list-data tbl-content" id="list-data">
 		<!-- LIST TABLE -->
    		<table class="table table-bordered sorted_table">
    			<thead>
    				<tr id="sortable">
                <th style="width: 10px;"></th>
                <th><input class ="selectall" type ="checkbox"></th>
      					<th>Menu</th>
      					<th>Icon</th>
      					<th>Url</th>
      					<th>Type</th>
                <th>Modified</th>
                <th>Status</th>
                <th>Package</th>
                <th>Edit</th>
    				</tr>
    			</thead>
    			<tbody class="table_body">
    				
    			</tbody>
    		</table>
      </div>
		</div>
</div>

<script type="text/javascript">
  var query  = 'menu_status >= 0 AND menu_parent_id < 1';
    var menu_id = "<?=$menu_id;?>";
    var add_data = "";
    $('.btn_close').hide();
    if(menu_id)
    {
        $('.btn_close').show();
        query  = "menu_status >= 0 AND menu_parent_id = "+menu_id;
        add_data = "/<?=$menu_id;?>/<?=$menu_group;?>";
    }
    var limit = 999;

    $(document).ready(function(){

        $('.selectall').prop('checked', false);

        get_data();
 
         var sort_table = $('tbody').sortable();
          $('tbody').bind('sortupdate', function(event, ui) {
            var order = 0;

                $('.order').each(function() {  
                    order ++;
                    $(this).attr("data-order",order);
                });

            save_sort();

         });           
    });

    $(document).on('keypress', '#search_query', function(e) {                          
      if (e.keyCode == 13) {
          var keyword = $(this).val();
          query = "( cms_menu.menu_url like '%" + keyword + "%' OR cms_menu.menu_name like '%" + keyword + "%') AND menu_status >= 0";
          get_data();
      }
    });

    $(document).on('click', '.btn_close', function(e){
        location.href = '<?=base_url("content_management/cms_menu/menu");?>';
    });


    function save_sort() {
     $('.order').each(function() {       
        var orders = $(this).attr("data-order");
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "update", 
            table : "cms_menu",
            field : "id", 
            where : $(this).attr("data-id"), 
            data : {menu_orders : orders} 
        }

        aJax.post(url,data,function(result){ });
      });

    }


    function get_data() {
        modal.loading(true); //show loading
      var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "list", // list, insert, update, delete
            select : "id, menu_name, menu_type, menu_url, menu_icon, menu_updated_date, menu_status, menu_package", //select
            query : query, //query
            offset : offset, // offset or start
            limit : limit, // limit
            table : "cms_menu", // table
            order : {
                field : "menu_orders", //field to order
                order : "ASC" //asc or desc
            }
        }


      //get list
        aJax.post(url,data,function(result){
            var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
            var html = '';
            var pack = '';
            if(obj.length > 0){
                $.each(obj, function(x,y){
                  
                html += '<tr>';
                html += ' <td class="hide"><p class="order" data-order="" data-id='+y.id+'></p></td>';
                html += ' <td style="background-color:  #c3c3c3;"><span style="color: #fff;" class="move-menu glyphicon glyphicon-th"></span></td>';
                html +=  '<td><input class = "select"  data-id="'+y.id+'" data-menu="'+y.menu_name+'" data-menutype="'+y.menu_type+'" type ="checkbox"></td>';
                
              if(y.menu_url == "#"){
                html += ' <td><a class="text-primary" href="<?= base_url('content_management/cms_menu/menu/');?>'+y.id+'/'+y.menu_name+'" >'+y.menu_name+'</a></td>';
              } else {
                html += ' <td>' +y.menu_name+ '</td>';
              }

                html += ' <td><i class="' +y.menu_icon+ ' fa-lg"></i></td>';
                html += ' <td>' +y.menu_url+ '</td>';

                if(y.menu_url == "#"){
                    html += '<td>Group Menu </td>';
                } else {
                    html += '<td>Module</td>';
                }
                
                html += ' <td>' + moment(y.menu_updated_date).format('LLL')+ '</td>';

              if(y.menu_status == 1){
                  status = 'Active';
              }else{
                  status = 'Inactive';
              }

              if(y.menu_package == null){
                pack = '';
              }else{
                pack = y.menu_package;
              }

              html += '<td>'+status+'</td>';
              html += '<td>'+pack+'</td>';
              html +=" <td><a href='<?= base_url()."content_management/cms_menu/menu_update"?>/"+y.id+"' class='edit' title='edit'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                html += '</tr>';

            });
            } else {
                html = '<tr><td colspan=12 style="text-align: center;">No records to show.</td></tr>';
            }
            

        $('.table_body').html(html);
        modal.loading(false); //hide loading
      });


    }

     //update status
  $(document).on('click','.btn_status',function(e){
          var status = $(this).attr("data-status");
          var id = "";
          var menu = "";

            var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>'; 
            var result_message = "";
            modal.standard(modal_obj, function(result){
               if(result){
                $('.selectall').prop('checked', false);
                $('.select:checked').each(function(index) { 
                    id = $(this).attr('data-id');
                    menu = $(this).attr('data-menu').replace(/ /g, "_");
                    menutype = $(this).attr('data-menutype');
                    var url = "<?= base_url("content_management/global_controller");?>";
                    var data = {
                        event : "update",
                        table : "cms_menu", 
                        field : "id", 
                        where : id, 
                        data : {
                              menu_name : menu, 
                              menu_status : status,
                              menu_updated_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                        }, 
                    }
                    aJax.post(url,data,function(result){
                        var obj = is_json(result);
                        result_message = obj;
                        if(menutype == 2)
                        {
                            var url = "<?= base_url("content_management/cms_menu/rename_table");?>";
                            var data = {
                                name : 'pckg_'+menu, 
                            }

                            aJax.post(url,data,function(result){
                            });
                        }
                    });

                });

                modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                  location.href = '<?=base_url("content_management/cms_menu/menu");?>';  

                });
            }

           })
  });
   

  $(document).on('click', '#btn_add', function(e){
    location.href = '<?=base_url("content_management/cms_menu/menu_add");?>'+add_data;
  });

</script>