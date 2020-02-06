<div class="container">
    <?php
        $inputs = [
            'program_team',
            'program_image',
            'program_name',
            'program_short_description',
            'program_overview',
            'area_covered',
            'join_points',
        ];

        $id1 = $this->standard->inputs($inputs);
    ?>
</div>

<button id="submit_form">Submit</button>

<script type="text/javascript">
    AJAX.config.base_url("<?= base_url();?>");

    $(document).ready(function(){
        get_teams();
    });

    $(document).on("click", "#submit_form", function(e){
        e.preventDefault();
        save();
    });

    function get_teams(){
        var teams = <?= json_encode($teams);?>;
        var html = "<option selected disabled>Select..</option>";
        $.each(teams, function(x, y){
            html += '<option value='+y.id+'>' + y.team_name+ '</option>';
        });  
        $("#program_team").html(html);
    }
    

    function save(){
        if(validate.standard("<?= $id1;?>")){
            var modal_obj = '<?= $this->standard->confirm("confirm_save_program"); ?>'; 
            modal.standard(modal_obj, function(result){
                if(result){
                    modal.loading(true);
                    AJAX.insert.table("tbl_programs");

                    AJAX.insert.params("team_id",$("#program_team").val());
                    AJAX.insert.params("image_thumbnail",$("#program_image").val());
                    AJAX.insert.params("name",$("#program_name").val());
                    AJAX.insert.params("short_description",$("#program_short_description").val());
                    AJAX.insert.params("overview",$("#program_overview").val());
                    AJAX.insert.params("area_covered",$("#area_covered").val());
                    AJAX.insert.params("join_points",$("#join_points").val());
                    AJAX.insert.params("created_by",1);
                    AJAX.insert.params("create_date", '<?= date("Y-m-d H:i:s");?>');

                    AJAX.insert.exec(function(result){
                        modal.loading(false);
                    }); 
                }
            });
        }
    }

    
    
</script>