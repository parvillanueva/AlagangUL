<div class="box">
    <?php
        $data['buttons'] = ['update'];
        $this->load->view("content_management/template/buttons",$data);
    ?>
    <div class="box-body">
        <?php
            $id = 1;
            $top_details = $this->load->details("tbl_guidelines", $id);
            $inputs = [
                'title',
                'description',
                'status'
            ];

            $values = [
                $top_details[0]->title,
                $top_details[0]->description,
                $top_details[0]->status,
            ];

            $top_content = $this->standard->inputs($inputs, $values);
        ?>
    </div>
</div>

<script type="text/javascript">
var base_url = '<?=base_url();?>';
AJAX.config.base_url(base_url);

$(document).on('click', '#btn_update', function(){
        var form_data = {};
        $(':input[class*="_input"]').each(function() {
            var input_id = $(this).attr('id');
            var db_field = $(this).attr('name');

            if ($(this).attr('type') === 'ckeditor') {
                form_data[db_field] = eval("CKEDITOR.instances."+input_id+".getData()");
            } else {
                form_data[db_field] = eval("$('#"+input_id+"').val()");
            }
        });
        
        // form_data["update_date"] = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');

        if(validate.all()){;    
                // if((!is_exist('tbl_category', 'name', $('#name').val(),table_id) != 0)){
                    var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>'; 
                    modal.standard(modal_obj, function(result){
                        if(result){
                            modal.loading(true);

                            AJAX.update.table("tbl_guidelines");
                            AJAX.update.where("id",1);
                            $.each(form_data, function(a,b) {
                                AJAX.update.params(a, b);
                            });
                            
                            AJAX.update.exec(function(result){
                                modal.loading(false);
                                modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                                    location.href = '<?=base_url("content_management/site_guidelines") ?>';
                                });
                            })
                        }
                    });          
        }
});



</script>