<style type="text/css">
    th:first-child{
        width:20px;   
    }

    th:last-child{
        width: 30px;
    }

    td:last-child{
        text-align: center;
    }
</style>

<div class="box">
    <?php $data["buttons"] = ["add","close","search"]; ?>
    <?php $this->load->view("content_management/template/buttons", $data); ?>

    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th><input class="selectall" type = "checkbox"></th>
                        <th>User Role</th>
                        <th>Date Modified</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table_body"></tbody>
            </table>
            <div class="list_pagination"></div>
        </div>
    </div>

</div>


<script type="text/javascript">

    <?php 
        $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

        $urls = explode('/', $escaped_url);
        array_pop($urls);
    ?>

    var current_url = "<?= $url;?>";

    $(document).on("click", "#btn_add", function(e){
        location.href = current_url + "/add";
    });

    $('.status_banner').hide();
    var query = "status >= 0";
    var limit = 10;
    var role = "<?=$this->session->userdata('sess_role');?>";

    $(document).ready(function(){
        get_data();
        get_pagination();
        disable_used();
    });



    $('.search-query').on("keypress", function(e) {
        if (e.keyCode == 13) {
            var keyword = $(this).val()
            query = "(name LIKE '%" + keyword + "%') AND status >= 0";

            get_data();
            get_pagination();
            disable_used();
        }
    });



    function get_data(){
        var url = "<?= base_url("content_management/global_controller");?>";
        var data = {
            event : "list", // list, insert, update, delete
            select : "id, name,status,update_date", //select
            query : query, //query
            offset : offset, // offset or start
            limit : limit, // limit
            table : "cms_user_roles", // table
            order : {
                field : "update_date", //field to order
                order : "desc" //asc or desc
            }
        }

        //get list
        aJax.post(url,data,function(result){
            var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
            var html = "";
            if(obj.length > 0){
                $.each(obj, function(x,y){
       
                    var status = ( y.status == 1 ) ? status = "Active" : status = "Inactive";

                    html += "<tr>";
                    html += "   <td><input class='select' type=checkbox data-id="+y.id+" onchange=checkbox_check()></td>";
                    html += "   <td>" + y.name + "</td>";
                    html += "   <td>"+moment(y.update_date).format("LLL")+  "</td>";
                    html += "   <td>" +status+ "</td>";
                    html += "   <td><a href='"+current_url +"/edit/"+y.id+"' class='edit' data-status='"+y.status+"' id='"+y.id+"' title='edit' ><span class='glyphicon glyphicon-pencil'></span></td>";
                    html += "</tr>";
                })
            } else {
                html = '<tr><td colspan=8 style="text-align: center;">No records to show.</td></tr>';
            }

            $(".table_body").html(html);
            
            if(role != 7){
                $("a[id=4]").removeAttr("href");
                $("a[id=5]").removeAttr("href");
                $("a[id=7]").removeAttr("href");
            }

        });
    }

    function get_pagination(){
        var url = "<?= base_url("content_management/global_controller");?>";
        var data = {
            event : "pagination", // list, insert, update, delete
            select : "id", //select
            query : query, //query
            offset : offset, // offset or start
            limit : limit, // limit
            table : "cms_user_roles" // table
        }

        //get list
        aJax.post(url,data,function(result){
            var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
            if(obj.total_page > 1){
                pagination.generate(obj.total_page, ".list_pagination", get_data);
            }
        });
    }

    pagination.onchange(function(){
        offset = $(this).val();
        modal.loading(true);
        get_data();
        disable_used();
        modal.loading(false);
    })

    //Remove check on selectall checkbox when not all listed records are selected
    function checkbox_check() {
        var checkbox_count = document.querySelectorAll('input[class="select"]').length;
        var checked_checkboxes_count = document.querySelectorAll('input[class="select"]:checked').length;

        if (checkbox_count == checked_checkboxes_count) {
            $(".selectall").prop("checked", true);
        } else {
            $(".selectall").prop("checked", false);
        }
    }

    function disable_used(){
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "list",
            select : "id,role,status",
            query : "status >= 0",
            table : "cms_users"
        }
        aJax.post(url,data,function(result){
            var obj = is_json(result);
            $.each(obj, function(x,y){
                $("input[data-id="+y.role+"]").prop('disabled',true);
                $("input[data-id="+y.role+"]").removeClass('select');
            })
        });
    }



       //Update status
    $(document).on('click','.btn_status',function(e){
        var status = $(this).attr("data-status");
        if(status == -2){
            var modal_obj = '<?= $this->standard->confirm("confirm_delete"); ?>'; 
        }else{
            var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>'; 
        }

        var result_message = "";
             modal.standard(modal_obj, function(result){
                if(result){
                        $('.selectall').prop('checked', false);
                        $('.select:checked').each(function(index) { 
                           // modal.loading(true);
                            id = $(this).attr('data-id');
                            var url = "<?= base_url("content_management/global_controller");?>";
                            var data = {
                                event : "update",
                                table : "cms_user_roles", 
                                field : "id", 
                                where : id, 
                                data  : {
                                    status : status,
                                    update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                                }, 
                            }

                            aJax.post(url,data,function(result){
                                var obj = is_json(result);
                                result_message = obj;
                                modal.loading(false);
                            });
                        });

                        modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                            get_data();
                            get_pagination();
                            disable_used();
                            $('.btn_status').hide();    
                        });
                }
            }) 
    });










</script>
