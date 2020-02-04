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

<button id="submit_form">Submit</button>

<script type="text/javascript">
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

        }
    }
</script>