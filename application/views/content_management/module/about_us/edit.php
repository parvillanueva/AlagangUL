<div class="box">
    <?php   
        $data['buttons'] = ['update','close']; // add, save, update
        $this->load->view("content_management/template/buttons", $data);
        $badge_id = $this->uri->segment(4);
    ?>  

    <form id="submit_form">
        <div class="box-body">   
            <div id = "badge" class="form-horizontal">
                <input id="id" name="id" value="<?=$details[0]->id?>" type="hidden">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-5">
                        <input id="title" name="title" class="form-control required_input" placeholder="Title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-5">
                            <textarea class="form-control" rows="5" name="description" id="description"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-5">
                        <select id="status" name="status" class="form-control">
                            <option value=1>Active</option>
                            <option value=0>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        get_data();
    })


    // get data
    function get_data() {
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "list",
            select : "id,title,description,status",
            query : "id = <?= $this->uri->segment(4);?>", 
            table : "tbl_about_us"
        }

        aJax.post(url,data,function(result){
            var obj = is_json(result); 
            $.each(obj,function(x,y){
                $('#title').val(y.title);
                $('#description').val(y.description);
                $('#status').val(y.status);
            })

            // get_roles();
        });

    }


    $(document).on('click','#btn_update', function(){   
        if(validate.all()){
                modal.confirm("Are you sure you want to update this record?", function(result){
                    if(result)
                    {
                        modal.loading(true);
                        var form = $('#submit_form')[0]; // You need to use standard javascript object here
                        var formData = new FormData(form);
                        $.ajax({
                              url:"<?= base_url('content_management/site_about_us/update_data');?>",
                              type:"POST",
                              dataType:"json",
                              processData: false,
                              contentType: false,
                              data:formData,
                              beforeSend: function() {
                              modal.loading(true);
                              },
                              success: function(data) {
                              },
                              complete: function(data) {
                                modal.loading(false);
                                modal.alert("<?= $this->standard->dialog("add_success"); ?>", function(){
                                    location.href = '<?=base_url("content_management/site_about_us") ?>';
                                });
                              },
                        }); 
                    }
                })
        }
    }); 





    $(document).on('click', '#btn_close', function(e){
        location.href = '<?=base_url("content_management/site_about_us"); ?>';
    });


</script>