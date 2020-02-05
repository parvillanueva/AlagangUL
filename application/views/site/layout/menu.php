<?php 
$this->config->load('site_assets');
if($this->config->item("violator_include")) { ?>
<div class="col-md-12 pad-0 violator">
    <img src="<?= base_url();?>assets/img/violator.png" class="img-responsive violator-img" alt="violator" height="218">
    <a href="<?= $this->config->item("violator_url");?>" target="_blank">
        <img src="<?= base_url();?>assets/img/right-unilab-logo.png" class="img-responsive violator-logo" alt="Unilab Logo" height="60px">
    </a>
</div>
<?php } ?>

<style type="text/css">
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }
</style>
<!--- FOR TOP BAR MENU -->
<?php if($this->config->item("nav_toggle") == "top") { ?>

    <?php if($this->config->item("nav_fixed_top")) { ?>
        <nav class="navbar navbar-default navbar-fixed-top">
    <?php } else { ?>
        <nav class="navbar navbar-default">
    <?php } ?>
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="<?= base_url();?>"><?php echo $this->load->site_title(); ?></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <?=$this->load->site_menu();?>
                </ul>
            </div>
        </div>
    </nav>
<?php } ?>

<!--- FOR SIDE BAR MENU -->
<?php if($this->config->item("nav_toggle") == "side") { ?>

    <div id="mySidenav" class="sidenav" style="background-color: <?= $this->config->item("side_bar_color");?>">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <?php 
            $site_menu = $this->load->site_menu();
            $urls = $this->uri->segment(1);
            foreach ($site_menu as $key => $value) {
                if($value->default != 1){
                    if (filter_var($value->url, FILTER_VALIDATE_URL) === FALSE) {
                        echo '<a href="'.base_url($value->url).'">'.strtoupper($value->menu).'</a>' . "\n";
                    } else {
                        echo '<a href="'.$value->url.'" target="_blank">'.strtoupper($value->menu).'</a>' . "\n";
                    }
                }
            }
        ?>
    </div>

     <?php if($this->config->item("nav_fixed_top")) { ?>
        <nav class="navbar navbar-default navbar-fixed-top">
    <?php } else { ?>
        <nav class="navbar navbar-default">
    <?php } ?>
        <div class="container-fluid">
            <div class="navbar-header">
                <span style="font-size:30px;cursor:pointer; margin: 20px;color: #777;" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i></span>
                <a class="navbar-brand-side" href="<?= base_url();?>"><?php echo $this->load->site_title(); ?></a>
            </div>
        </div>
    </nav>
    
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

<?php } ?>


<!-- Start Promo Campaign -->
<div class="modal fade" id="promo_campaign" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content"  >              
          <div id="promo_campaign_body" class="modal-body">
                <button id="promo_campaign_close" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                <a id="promo_redirect" href="" target="_blank">
                    <img src="" id="promo_banner_image" style="width: 100%;" >
                </a>
            </div> 
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
         aJax.get("<?= base_url("promo_campaign") ;?>", function(data) {
            var url = data.url;
            var image = data.photo;
            if(url != null || image != null){
                $('#promo_banner_image').attr('src', image);
                $('#promo_redirect').attr('href', url);
                $('#promo_campaign').modal('show'); 
            }
        });
    });
</script>

<style type="text/css">
#promo_campaign{z-index:999999;}#promo_campaign_close{background:#fff;color:#422bb7;width:28px;height:28px;border-radius:50%;opacity:1;position:absolute;right:-10px;top:-10px;font-size:20px;}#promo_campaign_close:active{transform:translateY(4px);color:#422bb7;}#promo_campaign_close:hover{color:#422bb7;}#promo_campaign_body{padding:0;}body.modal-open{padding-right:0;}#promo_campaign{text-align:center;padding:0;}
</style>
<!-- End Promo Campaign -->
