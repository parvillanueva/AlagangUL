<div class="au-wrapper">
   <?php 
        $this->load->view("site/profile/profile-heading.php"); 
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
                url: '#activity' + obj[i].id,
                start: new Date(obj[i].when),
                className: 'activity-date'
            };
        }

    }

    $(document).ready(function() {
		progressBar('#progress1', <?=$profile->total_points?>);
	});
</script>