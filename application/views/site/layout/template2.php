	<?php $this->load->view("site/login_layout/header"); ?>
	<body>
		<div class="preloader-wrapper" style="display: none;"><div class="preloader"><div class="loader"></div></div></div>
		<header class="au-header">
			<div class="au-navigation au-container">
				<nav class="au-navbar navbar navbar-expand-lg">
					<div>
						<!-- <button type="button" class="au-navbar-toggler navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
							<img src="assets/img/au-menu.svg" width="28px" height="28px">
						</button> -->
					</div>
					<a href="<?= base_url();?>" class="au-navbar-brand navbar-brand">
						<img src="<?php echo base_url().'assets/img/au-logo.png'?>" alt="Alagang Unilab Logo" class="au-logo">
					</a>
					<div class="d-lg-none">
						<!-- <img src="assets/img/au-avatar.svg" class="au-avatar"> -->
					</div>

					<div class="collapse navbar-collapse" id="navbarCollapse">
						<div class="au-navbar-nav navbar-nav ml-auto flex-column-reverse flex-lg-row">
						</div>
					</div>
				</nav>
			</div>
		</header>
		<div class="au-wrapper">
		<div class="container-fluid au-heading au-wrapper au-flexcenter">
			<div class="au-container au-padding">
				<div class="row au-userbox au-fullheight">					
					<?php $this->load->view($content); ?>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			responsive();
		});
		$(window).resize(function() {
			responsive();
		});

		function responsive() {
			//minimum height for hero banner
			var maxHeight = -1;
			$('.au-hero-container .carousel-item').each(function() {
				if ($(this).outerHeight(true) > maxHeight) {
					maxHeight = $(this).outerHeight(true) + 64;
				}
			});
			$('.au-hero-bg').css("min-height", maxHeight);

			var headerheight = $('.au-header').outerHeight(true);;
			var footerheight = $('.au-footer').outerHeight(true);

			//full height hero banner
			$(".au-hero-bg").css("height", "calc(100vh - " + headerheight + "px)");
			$(".au-wrapper").css("min-height", "calc(100vh - " + (headerheight + footerheight) + "px)");
		}
	</script>
	<?php $this->load->view("site/login_layout/footer"); ?>
        
    </body>
</html>