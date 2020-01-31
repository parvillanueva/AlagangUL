<br>
<div class="box">
	<?php
		$data['buttons'] = ['save','cancel'];
		$this->load->view("layout/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$inputs = [
				'user_firstname',
				'user_middlename',
				'user_lastname',
				'user_email',
            ];

            $id = $this->standard->inputs($inputs);
		?>
	</div>
</div>

<script>
	$(document).on('click', '#btn_save', function(){
		var url = '<?php echo base_url()."api" ?>';
		var data = {
			token:'<?php echo $token ?>'
		}
		aJax.post(url, data, function(result){
			console.log(result);
		});
	});
</script>