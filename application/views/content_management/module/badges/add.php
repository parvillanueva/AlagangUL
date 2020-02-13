<div class="box">
		<?php	
			$data['buttons'] = ['save','close']; // add, save, update
			$this->load->view("content_management/template/buttons", $data);
		?>	
		<form id="submit_form">
	 		<div class="box-body">   
	 			<div id = "badge" class="form-horizontal">
		            <div class="form-group">
		              	<label class="col-sm-2 control-label">Badge Name</label>
		              	<div class="col-sm-5">
		                	<input id="name" name="name" class="form-control required_input" placeholder="Badge Name">
		              	</div>
		            </div>
		            <div class="form-group">
		              	<label class="col-sm-2 control-label">Icon</label>
		              	<div class="col-sm-5">
		              		<div class="input-group"> 
			                	<input id="icon" class="form-control required_input" name="icon" placeholder="Click to Pick" readonly>
			                	<span class="input-group-addon icon_preview"></span>
			              	</div>
		              	</div>
		            </div>
		            <div class="form-group">
		              	<label class="col-sm-2 control-label">Color:</label>
		              	<div class="col-sm-5">
		                	<input id="color" name="color" class="form-control required_input jscolor" placeholder="Color">
		              	</div>
		            </div>
		            <div class="form-group">
		              	<label class="col-sm-2 control-label">Required Points</label>
		              	<div class="col-sm-5">
		                	<input type="number" id="minimum_points" name="minimum_points" class="form-control required_input" placeholder="Required Points">
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

<div id="iconPicker" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Icon Picker</h4>
			</div>
			<div class="modal-body" style="max-height: 390px; overflow-y: scroll;">
				<div >
					<ul class="icon-picker-list"></ul>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.icon-picker-list .glyphicon {
	    font-size: 23px;
	    margin-bottom: 10px;
    	margin-top: 5px;
	}
	.icon-picker-list .fas {
	    font-size: 23px;
	    margin-bottom: 10px;
    	margin-top: 5px;
	}
</style>

<script type="text/javascript">
	
	var icons = [{ icon: 'fas fa-glass' },	 { icon: 'fas fa-music' },	 { icon: 'fas fa-search' },	 { icon: 'fas fa-heart' },	 { icon: 'fas fa-star' },	 { icon: 'fas fa-user' },	 { icon: 'fas fa-film' },	 { icon: 'fas fa-th-large' },	 { icon: 'fas fa-th' },	 { icon: 'fas fa-th-list' },	 { icon: 'fas fa-check' },	 { icon: 'fas fa-times' },	 { icon: 'fas fa-search-plus' },	 { icon: 'fas fa-search-minus' },	 { icon: 'fas fa-power-off' },	 { icon: 'fas fa-signal' },	 { icon: 'fas fa-cog' },	 { icon: 'fas fa-home' },	 { icon: 'fas fa-clock-o' },	 { icon: 'fas fa-road' },	 { icon: 'fas fa-download' },	 { icon: 'fas fa-inbox' },	 { icon: 'fas fa-repeat' },	 { icon: 'fas fa-refresh' },	 { icon: 'fas fa-list-alt' },	 { icon: 'fas fa-lock' },	 { icon: 'fas fa-flag' },	 { icon: 'fas fa-headphones' },	 { icon: 'fas fa-volume-off' },	 { icon: 'fas fa-volume-down' },	 { icon: 'fas fa-volume-up' },	 { icon: 'fas fa-qrcode' },	 { icon: 'fas fa-barcode' },	 { icon: 'fas fa-tag' },	 { icon: 'fas fa-tags' },	 { icon: 'fas fa-book' },	 { icon: 'fas fa-bookmark' },	 { icon: 'fas fa-print' },	 { icon: 'fas fa-camera' },	 { icon: 'fas fa-font' },	 { icon: 'fas fa-bold' },	 { icon: 'fas fa-italic' },	 { icon: 'fas fa-text-height' },	 { icon: 'fas fa-text-width' },	 { icon: 'fas fa-align-left' },	 { icon: 'fas fa-align-center' },	 { icon: 'fas fa-align-right' },	 { icon: 'fas fa-align-justify' },	 { icon: 'fas fa-list' },	 { icon: 'fas fa-outdent' },	 { icon: 'fas fa-indent' },	 { icon: 'fas fa-video-camera' },	 { icon: 'fas fa-picture-o' },	 { icon: 'fas fa-map-marker' },	 { icon: 'fas fa-adjust' },	 { icon: 'fas fa-tint' },	 { icon: 'fas fa-step-backward' },	 { icon: 'fas fa-fast-backward' },	 { icon: 'fas fa-backward' },	 { icon: 'fas fa-play' },	 { icon: 'fas fa-pause' },	 { icon: 'fas fa-stop' },	 { icon: 'fas fa-forward' },	 { icon: 'fas fa-fast-forward' },	 { icon: 'fas fa-step-forward' },	 { icon: 'fas fa-eject' },	 { icon: 'fas fa-chevron-left' },	 { icon: 'fas fa-chevron-right' },	 { icon: 'fas fa-plus-circle' },	 { icon: 'fas fa-minus-circle' },	 { icon: 'fas fa-times-circle' },	 { icon: 'fas fa-check-circle' },	 { icon: 'fas fa-question-circle' },	 { icon: 'fas fa-info-circle' },	 { icon: 'fas fa-crosshairs' },	 { icon: 'fas fa-ban' },	 { icon: 'fas fa-arrow-left' },	 { icon: 'fas fa-arrow-right' },	 { icon: 'fas fa-arrow-up' },	 { icon: 'fas fa-arrow-down' },	 { icon: 'fas fa-share' },	 { icon: 'fas fa-expand' },	 { icon: 'fas fa-compress' },	 { icon: 'fas fa-plus' },	 { icon: 'fas fa-minus' },	 { icon: 'fas fa-asterisk' },	 { icon: 'fas fa-exclamation-circle' },	 { icon: 'fas fa-gift' },	 { icon: 'fas fa-leaf' },	 { icon: 'fas fa-fire' },	 { icon: 'fas fa-eye' },	 { icon: 'fas fa-eye-slash' },	 { icon: 'fas fa-exclamation-triangle' },	 { icon: 'fas fa-plane' },	 { icon: 'fas fa-calendar' },	 { icon: 'fas fa-random' },	 { icon: 'fas fa-comment' },	 { icon: 'fas fa-magnet' },	 { icon: 'fas fa-chevron-up' },	 { icon: 'fas fa-chevron-down' },	 { icon: 'fas fa-retweet' },	 { icon: 'fas fa-shopping-cart' },	 { icon: 'fas fa-folder' },	 { icon: 'fas fa-folder-open' },	 { icon: 'fas fa-bar-chart' },	 { icon: 'fas fa-camera-retro' },	 { icon: 'fas fa-key' },	 { icon: 'fas fa-cogs' },	 { icon: 'fas fa-comments' },	 { icon: 'fas fa-star-half' },	 { icon: 'fas fa-thumb-tack' },	 { icon: 'fas fa-trophy' },	 { icon: 'fas fa-upload' },	 { icon: 'fas fa-lemon-o' },	 { icon: 'fas fa-phone' },	 { icon: 'fas fa-unlock' },	 { icon: 'fas fa-credit-card' },	 { icon: 'fas fa-rss' },	 { icon: 'fas fa-hdd-o' },	 { icon: 'fas fa-bullhorn' },	 { icon: 'fas fa-bell' },	 { icon: 'fas fa-certificate' },	 { icon: 'fas fa-hand-o-right' },	 { icon: 'fas fa-hand-o-left' },	 { icon: 'fas fa-hand-o-up' },	 { icon: 'fas fa-hand-o-down' },	 { icon: 'fas fa-arrow-circle-left' },	 { icon: 'fas fa-arrow-circle-right' },	 { icon: 'fas fa-arrow-circle-up' },	 { icon: 'fas fa-arrow-circle-down' },	 { icon: 'fas fa-globe' },	 { icon: 'fas fa-wrench' },	 { icon: 'fas fa-tasks' },	 { icon: 'fas fa-filter' },	 { icon: 'fas fa-briefcase' },	 { icon: 'fas fa-arrows-alt' },	 { icon: 'fas fa-users' },	 { icon: 'fas fa-link' },	 { icon: 'fas fa-cloud' },	 { icon: 'fas fa-flask' },	 { icon: 'fas fa-scissors' },	 { icon: 'fas fa-files-o' },	 { icon: 'fas fa-paperclip' },	 { icon: 'fas fa-floppy-o' },	 { icon: 'fas fa-square' },	 { icon: 'fas fa-bars' },	 { icon: 'fas fa-list-ul' },	 { icon: 'fas fa-list-ol' },	 { icon: 'fas fa-strikethrough' },	 { icon: 'fas fa-underline' },	 { icon: 'fas fa-table' },	 { icon: 'fas fa-magic' },	 { icon: 'fas fa-truck' },	 { icon: 'fas fa-money' },	 { icon: 'fas fa-caret-down' },	 { icon: 'fas fa-caret-up' },	 { icon: 'fas fa-caret-left' },	 { icon: 'fas fa-caret-right' },	 { icon: 'fas fa-columns' },	 { icon: 'fas fa-sort' },	 { icon: 'fas fa-sort-desc' },	 { icon: 'fas fa-sort-asc' },	 { icon: 'fas fa-envelope' },	 { icon: 'fas fa-undo' },	 { icon: 'fas fa-gavel' },	 { icon: 'fas fa-bolt' },	 { icon: 'fas fa-sitemap' },	 { icon: 'fas fa-umbrella' },	 { icon: 'fas fa-clipboard' },	 { icon: 'fas fa-lightbulb-o' },	 { icon: 'fas fa-user-md' },	 { icon: 'fas fa-stethoscope' },	 { icon: 'fas fa-suitcase' },	 { icon: 'fas fa-coffee' },	 { icon: 'fas fa-hospital-o' },	 { icon: 'fas fa-ambulance' },	 { icon: 'fas fa-medkit' },	 { icon: 'fas fa-fighter-jet' },	 { icon: 'fas fa-beer' },	 { icon: 'fas fa-h-square' },	 { icon: 'fas fa-plus-square' },	 { icon: 'fas fa-angle-double-left' },	 { icon: 'fas fa-angle-double-right' },	 { icon: 'fas fa-angle-double-up' },	 { icon: 'fas fa-angle-double-down' },	 { icon: 'fas fa-angle-left' },	 { icon: 'fas fa-angle-right' },	 { icon: 'fas fa-angle-up' },	 { icon: 'fas fa-angle-down' },	 { icon: 'fas fa-desktop' },	 { icon: 'fas fa-laptop' },	 { icon: 'fas fa-tablet' },	 { icon: 'fas fa-mobile' },	 { icon: 'fas fa-quote-left' },	 { icon: 'fas fa-quote-right' },	 { icon: 'fas fa-spinner' },	 { icon: 'fas fa-circle' },	 { icon: 'fas fa-smile-o' },	 { icon: 'fas fa-frown-o' },	 { icon: 'fas fa-meh-o' },	 { icon: 'fas fa-gamepad' },	 { icon: 'fas fa-keyboard-o' },	 { icon: 'fas fa-flag-checkered' },	 { icon: 'fas fa-terminal' },	 { icon: 'fas fa-code' },	 { icon: 'fas fa-reply-all' },	 { icon: 'fas fa-location-arrow' },	 { icon: 'fas fa-crop' },	 { icon: 'fas fa-code-fork' },	 { icon: 'fas fa-chain-broken' },	 { icon: 'fas fa-question' },	 { icon: 'fas fa-info' },	 { icon: 'fas fa-exclamation' },	 { icon: 'fas fa-superscript' },	 { icon: 'fas fa-subscript' },	 { icon: 'fas fa-eraser' },	 { icon: 'fas fa-puzzle-piece' },	 { icon: 'fas fa-microphone' },	 { icon: 'fas fa-microphone-slash' },	 { icon: 'fas fa-calendar-o' },	 { icon: 'fas fa-fire-extinguisher' },	 { icon: 'fas fa-rocket' },	 { icon: 'fas fa-chevron-circle-left' },	 { icon: 'fas fa-chevron-circle-right' },	 { icon: 'fas fa-chevron-circle-up' },	 { icon: 'fas fa-chevron-circle-down' },	 { icon: 'fas fa-anchor' },	 { icon: 'fas fa-unlock-alt' },	 { icon: 'fas fa-bullseye' },	 { icon: 'fas fa-ellipsis-h' },	 { icon: 'fas fa-ellipsis-v' },	 { icon: 'fas fa-rss-square' },	 { icon: 'fas fa-play-circle' },	 { icon: 'fas fa-minus-square' },	 { icon: 'fas fa-check-square' },	 { icon: 'fas fa-pencil-square' },	 { icon: 'fas fa-share-square' },	 { icon: 'fas fa-compass' },	 { icon: 'fas fa-caret-square-o-down' },	 { icon: 'fas fa-caret-square-o-up' },	 { icon: 'fas fa-caret-square-o-right' },	 { icon: 'fas fa-eur' },	 { icon: 'fas fa-gbp' },	 { icon: 'fas fa-usd' },	 { icon: 'fas fa-inr' },	 { icon: 'fas fa-jpy' },	 { icon: 'fas fa-rub' },	 { icon: 'fas fa-krw' },	 { icon: 'fas fa-file' },	 { icon: 'fas fa-file-text' },	 { icon: 'fas fa-sort-alpha-asc' },	 { icon: 'fas fa-sort-alpha-desc' },	 { icon: 'fas fa-sort-amount-asc' },	 { icon: 'fas fa-sort-amount-desc' },	 { icon: 'fas fa-sort-numeric-asc' },	 { icon: 'fas fa-sort-numeric-desc' },	 { icon: 'fas fa-thumbs-up' },	 { icon: 'fas fa-thumbs-down' },	 { icon: 'fas fa-female' },	 { icon: 'fas fa-male' },	 { icon: 'fas fa-sun-o' },	 { icon: 'fas fa-moon-o' },	 { icon: 'fas fa-archive' },	 { icon: 'fas fa-bug' },	 { icon: 'fas fa-caret-square-o-left' },	 { icon: 'fas fa-dot-circle-o' },	 { icon: 'fas fa-wheelchair' },	 { icon: 'fas fa-try' },	 { icon: 'fas fa-space-shuttle' },	 { icon: 'fas fa-envelope-square' },	 { icon: 'fas fa-language' },	 { icon: 'fas fa-fax' },	 { icon: 'fas fa-building' },	 { icon: 'fas fa-child' },	 { icon: 'fas fa-paw' },	 { icon: 'fas fa-cube' },	 { icon: 'fas fa-cubes' },	 { icon: 'fas fa-recycle' },	 { icon: 'fas fa-car' },	 { icon: 'fas fa-taxi' },	 { icon: 'fas fa-tree' },	 { icon: 'fas fa-database' },	 { icon: 'fas fa-file-pdf-o' },	 { icon: 'fas fa-file-word-o' },	 { icon: 'fas fa-file-excel-o' },	 { icon: 'fas fa-file-powerpoint-o' },	 { icon: 'fas fa-file-image-o' },	 { icon: 'fas fa-file-archive-o' },	 { icon: 'fas fa-file-audio-o' },	 { icon: 'fas fa-file-video-o' },	 { icon: 'fas fa-file-code-o' },	 { icon: 'fas fa-life-ring' },	 { icon: 'fas fa-circle-o-notch' },	 { icon: 'fas fa-paper-plane' },{ icon: 'fas fa-history' },	 { icon: 'fas fa-header' },	 { icon: 'fas fa-paragraph' },	 { icon: 'fas fa-sliders' },	 { icon: 'fas fa-share-alt' },	 { icon: 'fas fa-share-alt-square' },	 { icon: 'fas fa-bomb' },	 { icon: 'fas fa-futbol-o' },	 { icon: 'fas fa-tty' },	 { icon: 'fas fa-binoculars' },	 { icon: 'fas fa-plug' },	 { icon: 'fas fa-newspaper-o' },	 { icon: 'fas fa-wifi' },	 { icon: 'fas fa-calculator' },	 { icon: 'fas fa-bell-slash' },	 { icon: 'fas fa-trash' },	 { icon: 'fas fa-copyright' },	 { icon: 'fas fa-at' },	 { icon: 'fas fa-eyedropper' },	 { icon: 'fas fa-paint-brush' },	 { icon: 'fas fa-birthday-cake' },	 { icon: 'fas fa-area-chart' },	 { icon: 'fas fa-pie-chart' },	 { icon: 'fas fa-line-chart' },	 { icon: 'fas fa-toggle-off' },	 { icon: 'fas fa-toggle-on' },	 { icon: 'fas fa-bicycle' },	 { icon: 'fas fa-bus' },	 { icon: 'fas fa-cc' },	 { icon: 'fas fa-ils' },	 { icon: 'fas fa-cart-plus' },	 { icon: 'fas fa-cart-arrow-down' },	 { icon: 'fas fa-ship' },	 { icon: 'fas fa-user-secret' },	 { icon: 'fas fa-motorcycle' },	 { icon: 'fas fa-street-view' },	 { icon: 'fas fa-heartbeat' },	 { icon: 'fas fa-venus' },	 { icon: 'fas fa-mars' },	 { icon: 'fas fa-mercury' },	 { icon: 'fas fa-transgender' },	 { icon: 'fas fa-transgender-alt' },	 { icon: 'fas fa-venus-double' },	 { icon: 'fas fa-mars-double' },	 { icon: 'fas fa-venus-mars' },	 { icon: 'fas fa-mars-stroke' },	 { icon: 'fas fa-mars-stroke-v' },	 { icon: 'fas fa-mars-stroke-h' },	 { icon: 'fas fa-neuter' },	 { icon: 'fas fa-server' },	 { icon: 'fas fa-user-plus' },	 { icon: 'fas fa-user-times' },	 { icon: 'fas fa-bed' },	 {icon : 'glyphicon glyphicon-asterisk'},{ icon : 'glyphicon glyphicon-plus'},{ icon : 'glyphicon glyphicon-minus'},{ icon : 'glyphicon glyphicon-eur'},{ icon : 'glyphicon glyphicon-euro'},{ icon : 'glyphicon glyphicon-cloud'},{ icon : 'glyphicon glyphicon-envelope'},{ icon : 'glyphicon glyphicon-pencil'},{ icon : 'glyphicon glyphicon-glass'},{ icon : 'glyphicon glyphicon-music'},{ icon : 'glyphicon glyphicon-search'},{ icon : 'glyphicon glyphicon-heart'},{ icon : 'glyphicon glyphicon-star'},{ icon : 'glyphicon glyphicon-star-empty'},{ icon : 'glyphicon glyphicon-user'},{ icon : 'glyphicon glyphicon-film'},{ icon : 'glyphicon glyphicon-th-large'},{ icon : 'glyphicon glyphicon-th'},{ icon : 'glyphicon glyphicon-th-list'},{ icon : 'glyphicon glyphicon-ok'},{ icon : 'glyphicon glyphicon-remove'},{ icon : 'glyphicon glyphicon-zoom-in'},{ icon : 'glyphicon glyphicon-zoom-out'},{ icon : 'glyphicon glyphicon-off'},{ icon : 'glyphicon glyphicon-signal'},{ icon : 'glyphicon glyphicon-cog'},{ icon : 'glyphicon glyphicon-trash'},{ icon : 'glyphicon glyphicon-home'},{ icon : 'glyphicon glyphicon-file'},{ icon : 'glyphicon glyphicon-time'},{ icon : 'glyphicon glyphicon-road'},{ icon : 'glyphicon glyphicon-download-alt'},{ icon : 'glyphicon glyphicon-download'},{ icon : 'glyphicon glyphicon-upload'},{ icon : 'glyphicon glyphicon-inbox'},{ icon : 'glyphicon glyphicon-play-circle'},{ icon : 'glyphicon glyphicon-repeat'},{ icon : 'glyphicon glyphicon-refresh'},{ icon : 'glyphicon glyphicon-list-alt'},{ icon : 'glyphicon glyphicon-lock'},{ icon : 'glyphicon glyphicon-flag'},{ icon : 'glyphicon glyphicon-headphones'},{ icon : 'glyphicon glyphicon-volume-off'},{ icon : 'glyphicon glyphicon-volume-down'},{ icon : 'glyphicon glyphicon-volume-up'},{ icon : 'glyphicon glyphicon-qrcode'},{ icon : 'glyphicon glyphicon-barcode'},{ icon : 'glyphicon glyphicon-tag'},{ icon : 'glyphicon glyphicon-tags'},{ icon : 'glyphicon glyphicon-book'},{ icon : 'glyphicon glyphicon-bookmark'},{ icon : 'glyphicon glyphicon-print'},{ icon : 'glyphicon glyphicon-camera'},{ icon : 'glyphicon glyphicon-font'},{ icon : 'glyphicon glyphicon-bold'},{ icon : 'glyphicon glyphicon-italic'},{ icon : 'glyphicon glyphicon-text-height'},{ icon : 'glyphicon glyphicon-text-width'},{ icon : 'glyphicon glyphicon-align-left'},{ icon : 'glyphicon glyphicon-align-center'},{ icon : 'glyphicon glyphicon-align-right'},{ icon : 'glyphicon glyphicon-align-justify'},{ icon : 'glyphicon glyphicon-list'},{ icon : 'glyphicon glyphicon-indent-left'},{ icon : 'glyphicon glyphicon-indent-right'},{ icon : 'glyphicon glyphicon-facetime-video'},{ icon : 'glyphicon glyphicon-picture'},{ icon : 'glyphicon glyphicon-map-marker'},{ icon : 'glyphicon glyphicon-adjust'},{ icon : 'glyphicon glyphicon-tint'},{ icon : 'glyphicon glyphicon-edit'},{ icon : 'glyphicon glyphicon-share'},{ icon : 'glyphicon glyphicon-check'},{ icon : 'glyphicon glyphicon-move'},{ icon : 'glyphicon glyphicon-step-backward'},{ icon : 'glyphicon glyphicon-fast-backward'},{ icon : 'glyphicon glyphicon-backward'},{ icon : 'glyphicon glyphicon-play'},{ icon : 'glyphicon glyphicon-pause'},{ icon : 'glyphicon glyphicon-stop'},{ icon : 'glyphicon glyphicon-forward'},{ icon : 'glyphicon glyphicon-fast-forward'},{ icon : 'glyphicon glyphicon-step-forward'},{ icon : 'glyphicon glyphicon-eject'},{ icon : 'glyphicon glyphicon-chevron-left'},{ icon : 'glyphicon glyphicon-chevron-right'},{ icon : 'glyphicon glyphicon-plus-sign'},{ icon : 'glyphicon glyphicon-minus-sign'},{ icon : 'glyphicon glyphicon-remove-sign'},{ icon : 'glyphicon glyphicon-ok-sign'},{ icon : 'glyphicon glyphicon-question-sign'},{ icon : 'glyphicon glyphicon-info-sign'},{ icon : 'glyphicon glyphicon-screenshot'},{ icon : 'glyphicon glyphicon-remove-circle'},{ icon : 'glyphicon glyphicon-ok-circle'},{ icon : 'glyphicon glyphicon-ban-circle'},{ icon : 'glyphicon glyphicon-arrow-left'},{ icon : 'glyphicon glyphicon-arrow-right'},{ icon : 'glyphicon glyphicon-arrow-up'},{ icon : 'glyphicon glyphicon-arrow-down'},{ icon : 'glyphicon glyphicon-share-alt'},{ icon : 'glyphicon glyphicon-resize-full'},{ icon : 'glyphicon glyphicon-resize-small'},{ icon : 'glyphicon glyphicon-exclamation-sign'},{ icon : 'glyphicon glyphicon-gift'},{ icon : 'glyphicon glyphicon-leaf'},{ icon : 'glyphicon glyphicon-fire'},{ icon : 'glyphicon glyphicon-eye-open'},{ icon : 'glyphicon glyphicon-eye-close'},{ icon : 'glyphicon glyphicon-warning-sign'},{ icon : 'glyphicon glyphicon-plane'},{ icon : 'glyphicon glyphicon-calendar'},{ icon : 'glyphicon glyphicon-random'},{ icon : 'glyphicon glyphicon-comment'},{ icon : 'glyphicon glyphicon-magnet'},{ icon : 'glyphicon glyphicon-chevron-up'},{ icon : 'glyphicon glyphicon-chevron-down'},{ icon : 'glyphicon glyphicon-retweet'},{ icon : 'glyphicon glyphicon-shopping-cart'},{ icon : 'glyphicon glyphicon-folder-close'},{ icon : 'glyphicon glyphicon-folder-open'},{ icon : 'glyphicon glyphicon-resize-vertical'},{ icon : 'glyphicon glyphicon-resize-horizontal'},{ icon : 'glyphicon glyphicon-hdd'},{ icon : 'glyphicon glyphicon-bullhorn'},{ icon : 'glyphicon glyphicon-bell'},{ icon : 'glyphicon glyphicon-certificate'},{ icon : 'glyphicon glyphicon-thumbs-up'},{ icon : 'glyphicon glyphicon-thumbs-down'},{ icon : 'glyphicon glyphicon-hand-right'},{ icon : 'glyphicon glyphicon-hand-left'},{ icon : 'glyphicon glyphicon-hand-up'},{ icon : 'glyphicon glyphicon-hand-down'},{ icon : 'glyphicon glyphicon-circle-arrow-right'},{ icon : 'glyphicon glyphicon-circle-arrow-left'},{ icon : 'glyphicon glyphicon-circle-arrow-up'},{ icon : 'glyphicon glyphicon-circle-arrow-down'},{ icon : 'glyphicon glyphicon-globe'},{ icon : 'glyphicon glyphicon-wrench'},{ icon : 'glyphicon glyphicon-tasks'},{ icon : 'glyphicon glyphicon-filter'},{ icon : 'glyphicon glyphicon-briefcase'},{ icon : 'glyphicon glyphicon-fullscreen'},{ icon : 'glyphicon glyphicon-dashboard'},{ icon : 'glyphicon glyphicon-paperclip'},{ icon : 'glyphicon glyphicon-heart-empty'},{ icon : 'glyphicon glyphicon-link'},{ icon : 'glyphicon glyphicon-phone'},{ icon : 'glyphicon glyphicon-pushpin'},{ icon : 'glyphicon glyphicon-usd'},{ icon : 'glyphicon glyphicon-gbp'},{ icon : 'glyphicon glyphicon-sort'},{ icon : 'glyphicon glyphicon-sort-by-alphabet'},{ icon : 'glyphicon glyphicon-sort-by-alphabet-alt'},{ icon : 'glyphicon glyphicon-sort-by-order'},{ icon : 'glyphicon glyphicon-sort-by-order-alt'},{ icon : 'glyphicon glyphicon-sort-by-attributes'},{ icon : 'glyphicon glyphicon-sort-by-attributes-alt'},{ icon : 'glyphicon glyphicon-unchecked'},{ icon : 'glyphicon glyphicon-expand'},{ icon : 'glyphicon glyphicon-collapse-down'},{ icon : 'glyphicon glyphicon-collapse-up'},{ icon : 'glyphicon glyphicon-log-in'},{ icon : 'glyphicon glyphicon-flash'},{ icon : 'glyphicon glyphicon-log-out'},{ icon : 'glyphicon glyphicon-new-window'},{ icon : 'glyphicon glyphicon-record'},{ icon : 'glyphicon glyphicon-save'},{ icon : 'glyphicon glyphicon-open'},{ icon : 'glyphicon glyphicon-saved'},{ icon : 'glyphicon glyphicon-import'},{ icon : 'glyphicon glyphicon-export'},{ icon : 'glyphicon glyphicon-send'},{ icon : 'glyphicon glyphicon-floppy-disk'},{ icon : 'glyphicon glyphicon-floppy-saved'},{ icon : 'glyphicon glyphicon-floppy-remove'},{ icon : 'glyphicon glyphicon-floppy-save'},{ icon : 'glyphicon glyphicon-floppy-open'},{ icon : 'glyphicon glyphicon-credit-card'},{ icon : 'glyphicon glyphicon-transfer'},{ icon : 'glyphicon glyphicon-cutlery'},{ icon : 'glyphicon glyphicon-header'},{ icon : 'glyphicon glyphicon-compressed'},{ icon : 'glyphicon glyphicon-earphone'},{ icon : 'glyphicon glyphicon-phone-alt'},{ icon : 'glyphicon glyphicon-tower'},{ icon : 'glyphicon glyphicon-stats'},{ icon : 'glyphicon glyphicon-sd-video'},{ icon : 'glyphicon glyphicon-hd-video'},{ icon : 'glyphicon glyphicon-subtitles'},{ icon : 'glyphicon glyphicon-sound-stereo'},{ icon : 'glyphicon glyphicon-sound-dolby'},{ icon : 'glyphicon glyphicon-sound-5-1'},{ icon : 'glyphicon glyphicon-sound-6-1'},{ icon : 'glyphicon glyphicon-sound-7-1'},{ icon : 'glyphicon glyphicon-copyright-mark'},{ icon : 'glyphicon glyphicon-registration-mark'},{ icon : 'glyphicon glyphicon-cloud-download'},{ icon : 'glyphicon glyphicon-cloud-upload'},{ icon : 'glyphicon glyphicon-tree-conifer'},{ icon : 'glyphicon glyphicon-tree-deciduous'},{ icon : 'glyphicon glyphicon-cd'},{ icon : 'glyphicon glyphicon-save-file'},{ icon : 'glyphicon glyphicon-open-file'},{ icon : 'glyphicon glyphicon-level-up'},{ icon : 'glyphicon glyphicon-copy'},{ icon : 'glyphicon glyphicon-paste'},{ icon : 'glyphicon glyphicon-alert'},{ icon : 'glyphicon glyphicon-equalizer'},{ icon : 'glyphicon glyphicon-king'},{ icon : 'glyphicon glyphicon-queen'},{ icon : 'glyphicon glyphicon-pawn'},{ icon : 'glyphicon glyphicon-bishop'},{ icon : 'glyphicon glyphicon-knight'},{ icon : 'glyphicon glyphicon-baby-formula'},{ icon : 'glyphicon glyphicon-tent'},{ icon : 'glyphicon glyphicon-blackboard'},{ icon : 'glyphicon glyphicon-bed'},{ icon : 'glyphicon glyphicon-apple'},{ icon : 'glyphicon glyphicon-erase'},{ icon : 'glyphicon glyphicon-hourglass'},{ icon : 'glyphicon glyphicon-lamp'},{ icon : 'glyphicon glyphicon-duplicate'},{ icon : 'glyphicon glyphicon-piggy-bank'},{ icon : 'glyphicon glyphicon-scissors'},{ icon : 'glyphicon glyphicon-bitcoin'},{ icon : 'glyphicon glyphicon-yen'},{ icon : 'glyphicon glyphicon-ruble'},{ icon : 'glyphicon glyphicon-scale'},{ icon : 'glyphicon glyphicon-ice-lolly'},{ icon : 'glyphicon glyphicon-ice-lolly-tasted'},{ icon : 'glyphicon glyphicon-education'},{ icon : 'glyphicon glyphicon-option-horizontal'},{ icon : 'glyphicon glyphicon-option-vertical'},{ icon : 'glyphicon glyphicon-menu-hamburger'},{ icon : 'glyphicon glyphicon-modal-window'},{ icon : 'glyphicon glyphicon-oil'},{ icon : 'glyphicon glyphicon-grain'},{ icon : 'glyphicon glyphicon-sunglasses'},{ icon : 'glyphicon glyphicon-text-size'},{ icon : 'glyphicon glyphicon-text-color'},{ icon : 'glyphicon glyphicon-text-background'},{ icon : 'glyphicon glyphicon-object-align-top'},{ icon : 'glyphicon glyphicon-object-align-bottom'},{ icon : 'glyphicon glyphicon-object-align-horizontal'},{ icon : 'glyphicon glyphicon-object-align-left'},{ icon : 'glyphicon glyphicon-object-align-vertical'},{ icon : 'glyphicon glyphicon-object-align-right'},{ icon : 'glyphicon glyphicon-triangle-right'},{ icon : 'glyphicon glyphicon-triangle-left'},{ icon : 'glyphicon glyphicon-triangle-bottom'},{ icon : 'glyphicon glyphicon-triangle-top'},{ icon : 'glyphicon glyphicon-console'},{ icon : 'glyphicon glyphicon-superscript'},{ icon : 'glyphicon glyphicon-subscript'},{ icon : 'glyphicon glyphicon-menu-left'},{ icon : 'glyphicon glyphicon-menu-right'},{ icon : 'glyphicon glyphicon-menu-down'},{ icon : 'glyphicon glyphicon-menu-up'}];
	var html = "";
	$.each(icons, function(x,y){
		html += '<li>';
		html += '	<a data-class="'+y.icon+'" class="font_select">';
		html += '		<span class="'+y.icon+'"></span>';
		html += '	</a>';
		html += '</li>';
	})

	<?php 
        $url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

        $urls = explode('/', $escaped_url);
        array_pop($urls);
    ?>

    $('.icon-picker-list').html(html);

	$(document).on('click', '#icon', function(e){
		modal.custom("#iconPicker","show");
	});

	$(document).on('click', '.font_select', function(e){
		modal.custom("#iconPicker","hide");
		var font_value = $(this).attr("data-class");
		$('#icon').val(font_value);
		$('.icon_preview').html('<i class="' +font_value + ' fa-lg"></i>');
	});

	$(document).on('click', '#btn_save', function(e){

		if(validate.all()){
			// if(is_exists('cms_menu', 'menu_name', $('#menu_name').val().toLowerCase(), 'menu_status') != 0)
			// {
   //              var error_message = "<span class='validate_error_message' style='color: red;'>The information already exists.<br></span>";
   //              $('#menu_name').css('border-color','red');
   //              $(error_message).insertAfter($('#menu_name'));
   //          }
   //          else
   //          {
            	modal.confirm("Are you sure you want to save this record?", function(result){
					if(result)
					{
                        modal.loading(true);
                        var form = $('#submit_form')[0]; // You need to use standard javascript object here
                        var formData = new FormData(form);
                        $.ajax({
                              url:"<?= base_url('content_management/site_badges/insert');?>",
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
                                    location.href = '<?=base_url("content_management/site_badges") ?>';
                                });
                              },
                        }); 
					}
				})
			// }
		}
	});

	$(document).on('click', '#btn_close', function(e){
	    location.href = '<?=base_url("content_management/site_badges"); ?>';
	});

</script>


<style type="text/css">
</style>
