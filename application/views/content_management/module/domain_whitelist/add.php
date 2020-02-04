<div class="box">
	<?php
		$data['buttons'] = ['save','close'];
		$this->load->view("content_management/template/buttons",$data);
	?>
	<div class="box-body">
		<?php
			$inputs = [
                'name',

            ];
            $top_content = $this->standard->inputs($inputs);
		?>
	</div>
</div>
