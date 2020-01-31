<div class="box">
	<?php	
		$data["buttons"] = ["add","search"]; // add, save, update
		$this->load->view("content_management/template/buttons", $data);
	?>	
		<div class="box-body">   
    		<!-- LIST TABLE -->
    		<table class="table table-bordered">
    			<thead>
    				<tr>
                        <th><input class="selectall" type = "checkbox"></th>
    					<th>Thumbnail</th>
    					<th>Title</th>
    					<th>Description</th>
    					<th>User</th>
                        <th>Status</th>
                        <th>Modified</th>
                        <th>Action</th>
    				</tr>
    			</thead>
    			<tbody class="table_body">
    				
    			</tbody>
    		</table>

    		<!-- PAGINATION -->
    		<div class="list_pagination"></div>
		</div>
 </div>

 <script type="text/javascript">

    AJAX.config.base_url(base_url);
	
    var limit = 10;

    $(document).ready(function(){
        get_data();
    });

    $(document).on('keypress', '#search_query' function(e) {                          
        if (e.keyCode == 13) {
            var keyword = $(this).val()
            query = "{search_query}";
            get_data();
        }
    });

    function get_data()
    {
        modal.loading(true); //show loading

        AJAX.select.table("{table}");
        AJAX.select.select("{table}.*, cms_users.name as author");
        AJAX.select.where.greater_equal("{table}.status", 0);
        AJAX.select.offset(offset);
        AJAX.select.limit(limit);
        AJAX.select.order.desc("update_date");
        AJAX.select.join.left("cms_users", "cms_users.id", "{table}.user");

        //get list
        AJAX.select.exec(function(result){
        	var obj = result; //check if result is valid JSON format, Format to JSON if not
        	var html = "";
            if(obj.length > 0){
                $.each(obj, function(x,y){
                    if(y.status==1){
                      var status = "Published";
                    }
                    else{
                      var status = "Unpublished";
                    }

                    html += "<tr>";
                    html += "   <td><input class=select type=checkbox data-id="+y.id+" data-title="+y.title+"></td>";
                    html += "   <td><img src=" +y.thumbnail+ " width=100px;/></td>";
                    html += "   <td>" +y.title+ "</td>";
                    html += "   <td>" +y.short_description+ "</td>";
                    html += "   <td>" +y.author+ "</td>";
                    html += "   <td>" +status+ "</td>";
                    html += "   <td>" + moment(y.update_date).format("LLL")+ "</td>";
                    html += "   <td><a href='<?= base_url("content_management/{table}/update/"); ?>"+y.id+"' class='edit' data-status='"+y.state+"' id='"+y.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
                    html += "</tr>";
                })
            } else {
                html = '<tr><td colspan=8 style="text-align: center;">No Record Found</td></tr>';
            }
        	
        	$(".table_body").html(html);
            modal.loading(false); //hide loading
        }, function(obj){
            pagination.generate(obj.total_page, ".list_pagination", get_data);
        });
    }

    pagination.onchange(function(){
        offset = $(this).val();
        get_data();
    })

    $(document).on("click", "#btn_add", function(e){
		location.href = "<?=base_url("content_management/site_{menu}/add");?>";
	});

    $(document).on("click", ".btn_status", function(e){
        var status = $(this).attr("data-status");
        var id = "";
        var title = "";
        modal.confirm("Are you sure you want to update selected records?",function(result){
            if(result){
                $('.selectall').prop('checked', false);
                $('.select:checked').each(function(index) { 
                    id = $(this).attr('data-id');
                    title = $(this).attr('data-title');
  
                    AJAX.update.table("{table}");
                    AJAX.update.where("id", id);
                    AJAX.update.params("title", title);
                    AJAX.update.params("status", status);
                    AJAX.update.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

                    AJAX.update.exec(function(result){
                        //code here
                        //reload listing
                        get_data();

                    });
                });
            }
        });
    });

</script>