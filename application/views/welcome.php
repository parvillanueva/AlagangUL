

<!-- HTML Header -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?= $this->load->site_title();?></title>
    <meta name="description" content="<?= $this->load->site_description();?>" />
    <meta name="keyword" content="<?= $this->load->site_keyword();?>" />
    <meta equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="robots" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge;" />

    <link rel="stylesheet" href="http://localhost/new_cms/cms/font-awesome/css/font-awesome.min.css">
    <link href="http://localhost/new_cms/cms/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/new_cms/cms/css/cms.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/new_cms/cms/css/style.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/new_cms/cms/css/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/new_cms/cms/css/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/new_cms/cms/css/iconpicker.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/new_cms/cms/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/new_cms/cms/css/datetimepicker.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="http://localhost/new_cms//cms/js/jquery.min.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/js/bootbox.min.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/js/moment.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/js/custom.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/js/dropzone.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/js/app.min.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/js/jquery-ui.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/js/numeral.min.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/js/iconpicker.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/js/datetimepicker.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/ckeditor/ckeditor.js" ></script>
    <script type="text/javascript" src="http://localhost/new_cms//cms/ckeditor/config.js" ></script>
  </head>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><?= $this->load->site_title();;?></a>
    </div>
    <ul class="nav navbar-nav">
      <?php 
        $site_menu = $this->load->site_menu();
        foreach ($site_menu as $value) {
          echo "<li><a href='". $value->url ."'>" . $value->menu . "</a></li>";
        }
      ?>
    </ul>
  </div>
</nav>