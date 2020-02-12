<div class="box">
    <?php   
        $data['buttons'] = ['save','close']; // add, save, update
        $this->load->view("content_management/template/buttons", $data);
    ?>  
    <form id="submit_form">
        <div class="box-body">   
            <div id = "badge" class="form-horizontal">
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

    $(document).on('click', '#btn_save', function(e){

        if(validate.all()){

                modal.confirm("Are you sure you want to save this record?", function(result){
                    if(result)
                    {
                        modal.loading(true);
                        var form = $('#submit_form')[0]; // You need to use standard javascript object here
                        var formData = new FormData(form);
                        $.ajax({
                              url:"<?= base_url('content_management/site_about_us/insert');?>",
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
