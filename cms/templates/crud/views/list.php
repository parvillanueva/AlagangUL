<div class="box">
	<?php	
		$data["buttons"] = ["add", "search"]; // add, save, update
		$this->load->view("content_management/template/buttons", $data);
	?>	
		<div class="box-body">   
 		<!-- LIST TABLE -->
		<table class="table table-bordered">
			<thead>
				<tr>
                    <th><input class="selectall" type = "checkbox"></th>{table_head}
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
	var query = "{table}.status >= 0";
    var limit = 10;

    $(document).ready(function(){
        get_data();
        get_pagination();
    });

    $(document).on('keypress', '#search_query', function(e) {                          
        if (e.keyCode == 13) {
            var keyword = $(this).val()
            query = "{search_query}";
            get_data();
            get_pagination();
        }
    });
    
    function get_data()
    {
        modal.loading(true); //show loading
    	var url = "<?= base_url("content_management/global_controller");?>";
        var data = {
        	event : "list", // list, insert, update, delete
            select : "{table}.*, cms_users.name as author", //select
            query : query, //query
            offset : offset, // offset or start
            limit : limit, // limit
            table : "{table}", // table
            order : {
                field : "update_date", //field to order
                order : "desc" //asc or desc
            },
            join : [ //optional
                {
                    table : "cms_users", //table
                    query : "cms_users.id = {table}.user", //join query
                    type : "left" //type of join
                }
            ]
        }

        //get list
        aJax.post(url,data,function(result){
        	var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
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
                    html += "   <td><input class=select type=checkbox data-id="+y.id+"></td>";{table_body}
                    html += "   <td>" +y.author+ "</td>";
                    html += "   <td>" +status+ "</td>";
                    html += "   <td>" + moment(y.update_date).format("LLL")+ "</td>";
                    html += "   <td><a href='<?= base_url("content_management/site_{menu}/update/"); ?>"+y.id+"' class='edit' data-status='"+y.state+"' id='"+y.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
                    html += "</tr>";
                })
            } else {
                html = '<tr><td colspan=8 style="text-align: center;">No Record Found</td></tr>';
            }
        	
        	$(".table_body").html(html);
            modal.loading(false); //hide loading
        });
    }

    function get_pagination()
    {
        var url = "<?= base_url("content_management/global_controller");?>";
        var data = {
        	event : "list", // list, insert, update, delete
            select : "{table}.*, cms_users.name as author", //select
            query : query, //query
            offset : offset, // offset or start
            limit : limit, // limit
            table : "{table}", // table
            order : {
                field : "update_date", //field to order
                order : "desc" //asc or desc
            },
            join : [ //optional
                {
                    table : "cms_users", //table
                    query : "cms_users.id = {table}.user", //join query
                    type : "left" //type of join
                }
            ]
        }

        //get list
        aJax.post(url,data,function(result){
            var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
            console.log(obj);
            modal.loading(false);
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
                    var url = "<?=base_url();?>content_management/global_controller"; //URL OF CONTROLLER
                    var data = {
                        event : "update", // list, insert, update, delete
                        table : "{table}", //table
                        field : "id", //field name
                        where : id, //equals to
                        data : {
                            status : status,
                            update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                        }, //data to insert
                    }

                    aJax.post(url,data,function(result){
                        //code here
                        //reload listing
                        get_data();
                        get_pagination();
                        $('.btn_status').hide();

                    });
                });
            }
        });
    });

</script>