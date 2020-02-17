<div class="au-wrapper">
   <?php 
        $this->load->view("site/profile/profile-heading-other.php"); 
        $this->load->view("site/profile/profile-details.php"); 
   ?>
</div>

<?php
        $this->load->view("site/profile/profile-modal-edit.php"); 
?>

<script>
    var calendar_data = '<?= json_encode($events)?>';
    
    if(calendar_data != null || calendar_data != '')
    {
        var obj = JSON.parse(calendar_data);
        var events = [];
        
        for(var i=0; i < obj.length; i++)
        {
            events[i] = {
                allDay : true,
                url: '#activity' + obj[i].program_id,
                start: new Date(obj[i].when),
                className: 'activity-date'
            };
        }

    }

   
    
    $(document).ready(function() {
        var total_points = <?=$profile->total_points?>;
        var current_points = <?=$profile->current_points?>;
        var point_level = (current_points/total_points) * 100;
		progressBar('#progress1', point_level);
	});
</script>