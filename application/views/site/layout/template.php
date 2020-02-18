    <?php $this->load->view("site/layout/header", $meta); ?>

    <body>

    	<div class="preloader-wrapper" style="display: none;"><div class="preloader"><div class="loader"></div></div></div>

    	<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N9VJ329"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
    	<?php 
    		$site_info = $this->load->active_list("site_information");
    		if(isset($site_info[0]->google_tag_manager_body)){
    			echo ($site_info[0]->google_tag_manager_body);
    		}

    	 ?>
        <?php $this->load->view("site/layout/menu"); ?>

		<?php 
			
			if ($site_info[0]->notif_status == 1) {
				$position_style = "";
				$registered_browsers = [];

				if ($site_info[0]->notif_position == "top") {
					$position_style = "top:25px !important;";
				} else if ($site_info[0]->notif_position == "bottom") {
					$position_style = "";
				}

				$notif_browser =  json_decode($site_info[0]->notif_browser);
				foreach($notif_browser as $key => $val) {
					array_push($registered_browsers, $val->value);
				}

				$registered_browsers = json_encode($registered_browsers);
		?>

					<script>
						var current_browser = "";
						var registered_browsers = <?=$registered_browsers?>;
						if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ){
							<?php $current_browser = "opera";?>
							current_browser = "<?=$current_browser;?>";
				        }
				        else if(navigator.userAgent.indexOf("Chrome") != -1 ){
				        	<?php $current_browser = "google_chrome";?>
				        	current_browser = "<?=$current_browser;?>";
				        }
				        else if(navigator.userAgent.indexOf("Safari") != -1){
				        	<?php $current_browser = "safari";?>
				        	current_browser = "<?=$current_browser;?>";
				        }
				        else if(navigator.userAgent.indexOf("Firefox") != -1 ){
				        	<?php $current_browser = "mozilla_firefox";?>
				        	current_browser = "<?=$current_browser;?>";
				        }
				        else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )){
				        	<?php $current_browser = "internet_explorer";?>
				        	current_browser = "<?=$current_browser;?>";
				        }  
				        else{
				        	console.log('Unknown browser detected.');
				        }

					</script>
					
					<div class="modal fade" id="notificationModal" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="notificationModalLabel">
						<div class="modal-dialog modal-lg" role="document" style="<?=$position_style;?>">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close close-notif" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title text-center">Notification</h4>
								</div>
								<div class="modal-body ms-body">
									<p class="text-center"><?=$site_info[0]->notif_message.'.';?></p>
								</div>
							</div>
						</div>
					</div>
		<?php
			}

		?>
		<div class="au-wrapper">
			<?php $this->load->view($content); ?>
		</div>
        <?php $this->load->view("site/layout/footer"); ?>
        
    </body>
</html>