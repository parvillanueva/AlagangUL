
<?php
    $files2 = $this->ftp->list_files('httpdocs/cms_quickinstall/packages/');
?>

<style type="text/css" media="screen">
  .documentation {
    margin-top: 100px;
  }
</style>
<div class="content documentation">

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  <?php foreach($files2 as $value) {
   $val =  str_replace('.zip', '', $value);
   $folder_name = str_replace(' ', '_',$val);

   $pkg_exists = $this->Custom_model->check_pkg($val); 
   $folder_title = str_replace('httpdocs/cms_quickinstall/packages/', '', $val);
   $pckg_title = str_replace('_', ' ', $folder_title);
    $accrdion_id = str_replace(' ', '_', $pckg_title);
  ?>
  
  <div class="panel panel-default">
    
    <div class="panel-heading" role="tab">
      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?= $accrdion_id; ?>" aria-expanded="true" aria-controls="<?= $accrdion_id; ?>">
      <h4 class="panel-title">
        
          <?= preg_replace('/\\.[^.\\s]{3,4}$/', '',ucfirst($pckg_title));?>
        
      </h4>
      </a>
    </div>
    
    <div id="<?= $accrdion_id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <?php
             $img_files = $this->ftp->list_files(strtolower(str_replace('packages', 'screenshots', $folder_name)));
        ?>
        <div class="col-md-5">
        <?php
          $description_files = $this->ftp->list_files(strtolower(str_replace('packages', 'descriptions', $folder_name)));
          foreach((array)$description_files as $description_file) {
            $handle = file_get_contents('http://172.29.70.126/'.str_replace('httpdocs','',$description_file), "r");
          ?>

          <fieldset>
            <legend>Descriptions</legend>
            <p><?= $handle;?></p>
          </fieldset>

          <?php } ?>
        </div>
        <div class="col-md-7">
          
          <fieldset>
            <div class="row">
            <legend>Screenshots</legend>
            <?php foreach((array)$img_files as $img_value){
                $img_value = str_replace("httpdocs/", '', $img_value); ?>
              
                <div class="col-md-4">
                  <div style="height: 100px; width: 150px;">
                    <a href="#" class="thumb">
                    <img class="img-responsive" src="http://172.29.70.126/<?=$img_value;?>" style="height: 100%; width: 100%;">

                    </a>
                  </div>
                  
                </div>
                    
                
            <?php }?>
            </div>
          </fieldset>

        </div>

      </div>
    </div>
  </div>

  <?php } ?>

</div>

</div>

<div class="modal fade modal-profile" tabindex="-1" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal">×</button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>

<script>
  $(document).ready(function() {

    var segment = "<?=$this->uri->segment(4)?>";

    if(segment != ''){
      $("#"+segment).addClass("in");

      $('html, body').animate({
          scrollTop: $("#"+segment).offset().top - 150
      }, 2000);
    }

    $(document).on('click', 'a.thumb', function(event){
      event.preventDefault();
      var content = $('.modal-body');
      content.empty();
        var title = $(this).attr("title");
        $('.modal-title').html(title);        
        content.html($(this).html());
        $(".modal-profile").modal({show:true});
    });

  });
</script>