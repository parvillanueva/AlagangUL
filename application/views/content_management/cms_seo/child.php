<div class="box">
    <?php $data["buttons"] = ["add","close"]; ?>
    <?php $this->load->view("content_management/template/buttons", $data); ?>
    <div class="box-body">   
        <!-- LIST TABLE -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 50px"><input class="selectall" type = "checkbox"></th>
                        <th>Url</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Link Type</th>
                        <th>Status</th>
                        <th style="width: 50px;">Action</th>
                    </tr>
                </thead>
                <tbody class="table_body"></tbody>
            </table>
            <!-- PAGINATION -->
            <div class="list_pagination"> </div>
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
    var parent_id = "<?=$menu_id;?>";
    var query = "cms_metatags.meta_status >= 0 AND cms_metatags.meta_parent_id = "+ parent_id;
    var limit = 10;

    $(document).ready(function(){
        get_data();
        get_pagination();
    });

    // $('.search-query').on("keypress", function(e) {                          
    //     if (e.keyCode == 13) {
    //         var keyword = $(this).val()
    //         query = "(cms_metatags.meta_url like '%" + keyword + "%' OR cms_metatags.meta_keyword like '%" + keyword + "%' OR cms_metatags.meta_title like '%" + keyword + "%' OR cms_metatags.meta_description like '%" + keyword + "%') AND cms_metatags.meta_status >= 0";
    //         offset = 1;
    //         get_data();
    //         get_pagination();
    //     }
    // });

    function get_data(){
        var url = "<?= base_url("content_management/global_controller");?>";
        var data = {
            event : "list", // list, insert, update, delete
            select : "id, meta_url, meta_title, meta_description, meta_status, meta_type", //select
            query : query, //query
            offset : offset, // offset or start
            limit : limit, // limit
            table : "cms_metatags", // table
            order : {
                field : "id", //field to order
                order : "desc" //asc or desc
            }
        }

        //get list
        aJax.post(url,data,function(result){
            var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
            var html = "";
            if(obj.length > 0){
                $.each(obj, function(x,y){
       
                    var status = ( y.meta_status == 1 ) ? meta_status = "Active" : meta_status = "Inactive";
                    var type = ( y.meta_type == 2 ) ? "Child" : "Url";
                    var title = strip_tags(y.meta_title);
                    var description = strip_tags(y.meta_description);
                    var url = y.meta_url.split("/");
                    var last_item = url.pop();   
                    html += "<tr>";
                    html += "   <td><input class=select type=checkbox data-id="+y.id+" onchange=check_box_check()></td>";
                    if(y.meta_type == 1)
                    {
                        html += "   <td><a href='<?= base_url('content_management/site_meta/child');?>/"+y.id+"/"+last_item+"' class='edit' data-status='"+y.meta_status+"' id='"+y.id+"' title='edit'>" +y.meta_url+ "</a></td>";
                    }
                    else
                    {
                        html += "   <td>" +y.meta_url+ "</td>";
                    }
                    
                    html += "   <td>" +title+ "</td>";
                    html += "   <td>" +description+ "</td>";
                    html += "   <td>" +type+ "</a></td>";
                    html += "   <td>" +status+ "</a></td>";
                    html += "   <td><a href='<?= base_url('content_management/site_meta/edit');?>/"+y.id+"/"+last_item+"' class='edit' data-status='"+y.meta_status+"' id='"+y.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                    html += "</tr>";
                    
                })
            } else {
                html = '<tr><td colspan=8 style="text-align: center;">No records to show.</td></tr>';
            }
            

            $(".table_body").html(html);

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
            table : "cms_metatags" // table
        }

        //get list
        aJax.post(url,data,function(result){
            var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
            console.log(obj);
            if(obj.total_page > 1){
                pagination.generate(obj.total_page, ".list_pagination", get_data);
            }
        });
    }

    pagination.onchange(function(){
        offset = $(this).val();
        modal.loading(true);
        get_data();
        modal.loading(false);
    });

    function check_box_check() {
        var checkbox_count = document.querySelectorAll('input[class="select"]').length;
        var checked_checkboxes_count = document.querySelectorAll('input[class="select"]:checked').length;

        if (checkbox_count == checked_checkboxes_count) {
            $(".selectall").prop("checked", true);
        } else {
            $(".selectall").prop("checked", false);
        }
    }

    $(document).on("click", "#btn_add", function(e){
        location.href = '<?=base_url("content_management/site_meta/child_add/").$menu_id."/".$menu_group;?>';
    });

    $(document).on('click', '#btn_close', function(e){
        location.href = '<?=base_url("content_management/site_meta");?>';
    });

    //Update status
    $(document).on('click','.btn_status',function(e){
        var status = $(this).attr("data-status");
        var id = "";

        if(status == 0){
            var modal_obj = '<?= $this->standard->confirm("confirm_unpublish_meta"); ?>'; 
        }
        if(status == 1){
            var modal_obj = '<?= $this->standard->confirm("confirm_publish_meta"); ?>'; 
        }
        if(status == -2){
            var modal_obj = '<?= $this->standard->confirm("confirm_delete_meta"); ?>'; 
        }

        var result_message = "";
        modal.standard(modal_obj, function(result){
            modal.loading(true);
            if(result  == true){
                $('.selectall').prop('checked', false);
                $('.select:checked').each(function(index) { 
                    id = $(this).attr('data-id');
                    var url = "<?= base_url("content_management/global_controller");?>";
                    var data = {
                        event : "update",
                        table : "cms_metatags", 
                        field : "id", 
                        where : id, 
                        data  : {
                            meta_status : status,
                            meta_updated_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                        }, 
                    }

                    aJax.post(url,data,function(result){
                        var obj = is_json(result);
                        result_message = obj;
                        url = "<?= base_url("content_management/site_meta/updateMetaStatus");?>/"+id+'/'+status;
                        aJax.post(url,null,function(result){
                            modal.loading(false);
                        });
                    });
                });

                modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                    get_data();
                    get_pagination();
                    $('.btn_status').hide();    
                });
            }
            else
            {
                modal.loading(false);
            }

        })
    });

    //generate sitemap
    $(document).on('click','#btn_sitemap',function(){
        var url = "<?= base_url('content_management/site_meta/sitemap_html');?>";
        var data = {}
        aJax.post(url,data,function(result){ 
            window.open("<?= base_url('sitemap.html');?>", "_blank");
            window.open("<?= base_url('sitemap.xml');?>", "_blank");
        });
    });
    
</script>