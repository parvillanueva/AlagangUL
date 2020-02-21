
<?php 

$config['title'] = "dlasdlkasjdasda";
$config['url'] = "dlasdlkasjdasda";
$config['image'] = "dlasdlkasjdasda";
$this->load->facebook_og($config); 

$audit_trail_count = $this->load->active_list("cms_audit_trail");
$installed_packages_count = $this->load->active_list("cms_menu", "menu_package != ''");

$site_menu_count = $this->load->active_list("site_menu");
$cms_menu_count = $this->load->active_list("cms_menu", "menu_status = 1");
$file_count = count(scandir('./uploads'));

$role = $this->session->userdata('sess_role');


if($role <= 3 || $role == 6){
  $users_count = $this->load->active_list("cms_users", "status != -2 AND role != 4 AND role != 5 AND role != 7");
}else if ($role == 4 || $role == 5){
  $users_count = $this->load->active_list("cms_users", "status != -2 AND role < 1");
}else{
  $users_count = $this->load->active_list("cms_users", "status != -2");
}
?>

<style>
  .box-body {
    padding-top: 20px;
  }
  .cms-home-first-panel {
      margin-bottom: 15px;
  }
  .dashboard-panel {
    background: #ecf0f5;
    margin: 0;
  }
  .cms-home-third-panel{
    margin-top: 15px;
  }

  .info-box:hover {
    background: #ddd;
    color: #fff;
    cursor: pointer;
  }

  .info-box-text {
    margin-top: 15px;
  }

  .date_time {
    font-size: 15px;
  }

  .close-panel {
    margin-top: 5px;
    cursor: pointer;
  }

  .info-box:after {
    content: '';
    position: absolute;
    top: 0;
    left: 4%;
    width: 0;
    height: 85%;
    background-color: rgba(255,255,255,0.4);
    -webkit-transition: none;
    -moz-transition: none;
    transition: none;
  }
  .info-box:hover:after {
    width: 100% !important;
    background-color: rgba(255,255,255,0); 
    -webkit-transition: all 0.4s ease-in-out;
    -moz-transition: all 0.4s ease-in-out;
    transition: all 0.4s ease-in-out;
  }


</style>

<div class="box">
  <div class="box-body  chart-responsive">
    <div class="cms-home-first-panel">
      <label style="font-size: 24px;">Welcome</label><br>
      <span>Content Management System (CMS) a web application that allows publishing, editing and modifying content, organizing, deleting as well as maintenance from a central interface. Such systems of content management provide procedures to manage workflow in a collaborative environment</span>
    </div>
    <div class="dashboard-panel panel panel-default">
      <div class="panel-heading">
        <a class="btn btn-default collapse_btn" data-toggle="collapse" href="#collapse_panel">Hide Panels</a>
        <a class="pull-right close-panel" data-toggle="close"><i class="fa fa-close"></i></a>
      </div>
      <div class="panel-body panel-collapse collapse" id="collapse_panel">
        <div class="row">
          <div class="col-sm-4">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-center"><b>Users</b></span>
                <span class="info-box-number text-center users_count">Loading...</span>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-archive"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-center"><b>Installed Packages</b></span>
                <span class="info-box-number text-center installed_packages_count">Loading...</span>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="info-box">
              <span class="info-box-icon bg-olive"><i class="fa fa-list-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-center"><b>Audit Trail</b></span>
                <span class="info-box-number text-center audit_trail_count">Loading...</span>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="info-box">
              <span class="info-box-icon bg-purple"><i class="fa fa-bars"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-center"><b>Site Menu</b></span>
                <span class="info-box-number text-center site_menu_count">Loading...</span>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="info-box">
              <span class="info-box-icon bg-maroon"><i class="fa fa-tachometer"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-center"><b>CMS Menu</b></span>
                <span class="info-box-number text-center cms_menu_count">Loading...</span>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="info-box">
              <span class="info-box-icon bg-teal"><i class="fa fa-files-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-center"><b>Filemanager Files</b></span>
                <span class="info-box-number text-center file_count">Loading...</span>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="info-box">
              <span class="info-box-icon bg-navy"><i class="fa fa-clock-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-center"><b>Date & Time</b></span>
                <span class="info-box-number text-center date_time">
                  <div class="dashboard-date">Loading...</div>
                  <div class="dashboard-time">
                    <div id="am_pm">Loading...</div>
                  </div>
                </span>
              </div>
            </div>
          </div>

           <div class="col-sm-4">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-code-fork"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-center"><b>CMS Version</b></span>
                <span class="info-box-number text-center version_id">Loading...</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pull-right">
      <div class="col-md-6 form-group">
        <select class="form-control chart_filter hidden">
          <option>Show All</option>
          <option>URL</option>
        </select>
      </div>
      <div class="col-md-6 form-group">
        <select class="form-control chart_limit hidden">
          <option value=7>7 Days</option>
          <option value=14>2 Weeks</option>
          <option value=30>1 Month</option>
        </select>
      </div>
    </div>
    <div class="cms-home-third-panel">
      <label style="font-size: 24px;">Site Visitor</label><small> ( For the Last 7 Days )</small><br>
      <a class="btn btn-xs" style="color: #fff; background-color: #3c8dbc; border-color: #3c8dbc; cursor: default; padding: 4px 10px;">Unique Global Visitor</a>
      <a class="btn btn-xs" style="color: #fff; background-color: #41b36a; border-color: #41b36a; cursor: default; padding: 4px 10px;">Unique Visitor / Page</a>
      <a class="btn btn-xs" style="color: #fff; background-color: #ffa500; border-color: #ffa500; cursor: default; padding: 4px 10px;">Daily Visitor / Page</a>
      <div class="chart" id="line-chart" style="height: 300px;"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
  var uri = "";
  var days = 7;
  $(document).ready(function(){
    $('#breadcrumb').remove();
    get_urls();
    // get_analytics();

    $('.collapse').collapse()

    $('.site_menu_count').text("<?=count($site_menu_count);?>");
    $('.cms_menu_count').text("<?=count($cms_menu_count);?>");
    $('.installed_packages_count').text("<?=count($installed_packages_count);?>");
    $('.audit_trail_count').text("<?=count($audit_trail_count);?>");
    $('.users_count').text("<?=count($users_count);?>");
    $('.file_count').text("<?=$file_count;?>");
    $('.version_id').text($('#version_patch h2 > b').text());
  });

  $(document).on('change', '.chart_limit', function(e){
    days = $(this).val();
    // get_analytics();
  });

  $(document).on('change', '.chart_filter', function(e){
    uri = $(this).val();
    // get_analytics();
  });

  //get report analytics
  function get_analytics()
  { 
    var url = "<?= base_url("content_management/global_controller/get_analytics");?>"; //URL OF CONTROLLER
    var data = {
        url : uri,
        days : days,
    }

    aJax.post(url,data,function(result){
      var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
     
      var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: obj,
        xkey: 'date',
        xLabelFormat: function(date) {
          return moment(date).format("L"); 
        },
        xLabels:'day',
        ykeys: ['global','unique','daily'],
        lineColors: ['#3c8dbc','#41b36a','#ffa500'],
        hideHover: 'auto'
      });
    })
  }

  //get all urls
  function get_urls()
  {
    var url = "<?= base_url("content_management/global_controller");?>"; //URL OF CONTROLLER
    var data = {
        event : "list", // list, insert, update, delete
        select : "url", //select
        query : "", //select
        group : "url", //group
        table : "site_analytics", // table
    }

    aJax.post(url,data,function(result){
      var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
      
      var html = '<option value="">Show All</option>';
      $.each(obj, function(x,y){
        html += '<option value="'+y.url+'">'+y.url+'</option>';
      });
      $('.chart_filter').html(html);

    });
  }


  $('.dashboard-date').text(moment(new Date()).format("LL"));

  function real_time_clock() {
    var date = moment(new Date()).format("hh:mm:ss A");
    $('.dashboard-time').text(date);
  }

  var time = setInterval(real_time_clock,1000);

  $('.collapse_btn').on('click', function() {
    if ($(this).html() == "Hide Panels") {
      $(this).html('Show Panels');
    } else {
      $(this).html('Hide Panels');
    }
  });

  $('.close-panel').on('click', function() {
    $(this).parent().parent().remove();
  });

</script>