<?php
    $files2 = $this->ftp->list_files('httpdocs/cms_quickinstall/packages/');
    $files3 = $this->ftp->list_files('httpdocs/cms_quickinstall/screenshots/');
    /* Uri segment of current CMS Menu */
    $snum = $this->uri->total_segments(); 
    $last = $this->uri->segment($snum); 
    $before = $this->uri->segment($snum-1); 
    $slug = $before.'/'.$last;
?>

    <div class="box main-page-install">
    <div class="box-body">
        <h2><strong>WORKING FILES</strong></h2>
        <p> 
          Controller : ./application/controllers/content_management/site_Sample_Module<br>
          Model : ./application/models/content_management/Custom_model<br>
          View : ./application/views/content_management/module/Sample_Module/page.php
        </p>

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading_one">
              <h4 class="panel-title accord_h4">
                <a role="button" id="quick_install_package" data-toggle="collapse" data-parent="#accordion" href="#collapse_one" aria-expanded="true" aria-controls="collapse_one">
                  Quick Install Package
                </a>
              </h4>
            </div>
            <div id="collapse_one" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_one">
              <div class="panel-body">
                <?php foreach((array)$files2 as $value) {
                   $val =  str_replace('.zip', '', $value);
                   $exploded_val = explode('/', $val);
                   $folder_name = str_replace(' ', '_',$val);

                   $pkg_exists = $this->Custom_model->check_pkg(end($exploded_val)); 
                   $folder_title = str_replace('httpdocs/cms_quickinstall/packages/', '', $val);
                   $pckg_title = str_replace('_', ' ', $folder_title);
                ?> 
                    <div class="col-xs-6 col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-body"><?= preg_replace('/\\.[^.\\s]{3,4}$/', '',ucfirst($pckg_title));?>
                                <a href="<?=base_url()?>content_management/documentation/package/<?=$folder_name?>" class="info pull-right" title="Package Documentation">
                                <span class="glyphicon glyphicon-info-sign" style="font-size: 22px; color: #333;"></span>
                                </a>
                                     <div class="modal-body">
                                        <div class="form-group col-md-12">
                                        <?php
                                            $img_files = $this->ftp->list_files(strtolower(str_replace('packages', 'screenshots', $folder_name)));
                                            
                                            $counter = 0;
                                        ?>
                                        <div id="inner_carousel_<?=$folder_name;?>" class="carousel slide" data-ride="carousel">
                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner carousel-inner-panel">
                                                <?php foreach((array)$img_files as $img_value) : ?>
                                                    <?php
                                                        $counter++;
                                                        if($counter == 1){
                                                            echo '<div class="item carousel-inner-item active">';
                                                        }else{
                                                            echo '<div class="item carousel-inner-item">';
                                                        }

                                                        $img_value = str_replace("httpdocs/", '', $img_value);
                                                    ?>
                                                        <img class="img-responsive" src="http://172.29.70.126/<?= $img_value;?>" style="width: 100%; height: auto;">
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <?php 
                                $foldername = explode("/", $folder_name); 
                                $foldername = $foldername[count($foldername) - 1]; 
                            ?>
                            <div class="panel-footer">
                                <button id="install_view" class="btn  btn-primary btn-sm btn-block install_view" data-view='<?=$pkg_exists;?>' data-toggle="modal" data-target="#package_input_<?= $foldername;?>"/>INSTALL PACKAGE</button>
                            </div>
                        </div>
                    </div>
              </div>
                    <div id="package_input_<?= $foldername;?>" class="modal fade package-modal" role="dialog">
                        <div class="modal-dialog modal-lg" >
                               <div class="modal-content">
                                <div class="modal-header">
                                    <i class="glyphicon glyphicon-resize-full pull-right package-full" data-full-view='<?= $val;?>'></i>
                                    <i class="glyphicon glyphicon-resize-small pull-right package-min" data-full-view='<?= $val;?>'></i>
                                    
                                        <h4 class="modal-title packag-modal-title"><?= $folder_title;?></h4>

                                </div>
                                <div class="modal-body pakage-modal-body">
                                    <div class="form-group col-md-12">
                                    <?php
                                        $img_files = $this->ftp->list_files(strtolower(str_replace('packages', 'screenshots', $folder_name)));
                                        $img_counter = count($img_files);
                                        $counter = 0;
                                    ?>
                                    <div id="my_carousel_<?=$foldername;?>" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            <?php foreach((array)$img_files as $img_value) : ?>
                                                <?php
                                                    $counter++;
                                                    if($counter == 1){
                                                        echo '<div class="item carousel-inner-item active">';
                                                    }else{
                                                        echo '<div class="item carousel-inner-item">';
                                                    }
                                                    $img_value = str_replace("httpdocs/", '', $img_value)
                                                ?>
                                                  <img class="img-responsive" src="http://172.29.70.126/<?= $img_value;?>"" style="width: 100%; height: auto;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <?php if($img_counter != 1) : ?>
                                            <!-- Left and right controls -->
                                            <a class="left carousel-control" href="#my_carousel_<?=$foldername;?>" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#my_carousel_<?=$foldername;?>" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="package_cancel" class="btn btn-default package-cancel" data-dismiss="modal">Cancel</button>
                                    <button type="button" id="package_insert_input" class="btn btn-primary" data-toggle="modal" data-target="#package_input_install_<?= $foldername;?>">Install</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="package_input_install_<?= $foldername;?>" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="bootbox-body">Are you sure you want to install this package?</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="btn_close_modals" class="btn btn-default btn-close-modals" data-dismiss="modal">Close</button>
                                    <form id="package_form" action="<?= base_url("content_management/package/package_install");?>" method="post" enctype="multipart/form-data">
                                        <?php
                                        
                                            $values = explode("/", $value); 
                                            $values = $values[count($values) - 1]; 
                                        ?>
                                        <input type="text" class="form-control hidden required_input" name="slug" id="slug" value="<?= $slug; ?>">
                                        <input type="text" class="form-control hidden required_input" name="package" id="file" value="<?= $values;?>" />
                                        <input type="text" class="form-control hidden" name="module_path" value="<?= dirname(__FILE__);?>" />
                                        <input type="text" class="form-control hidden" name="reload_path" value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" />
                                        <input class="btn btn-primary" id="package_install" package="<?= $values;?>" type="submit"  value="INSTALL PACKAGE"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading_two">
              <h4 class="panel-title accord_h4">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_two" aria-expanded="false" aria-controls="collapse_two">
                  Package Builder
                </a>
              </h4>
            </div>
            <div id="collapse_two" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_two">
              <div class="panel-body">
                
                <div class="container">
                <div class="row">
                    <div class="col-md-5">
                    <div class="border">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#p_standards" aria-expanded="true">Standards</a>
                                </li>
                                <li class=""><a data-toggle="tab" href="#p_custom" aria-expanded="false">Custom</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="p_standards" class="tab-pane active">
                                    <div class="panel-body">
                                       <div class="tabs-container">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#m_about" aria-expanded="true">About</a>
                                                </li>
                                                <li class=""><a data-toggle="tab" href="#m_article" aria-expanded="true">Article</a>
                                                </li>
                                                <li class=""><a data-toggle="tab" href="#m_banners" aria-expanded="true">Banners</a>
                                                </li>
                                                <li class=""><a data-toggle="tab" href="#m_faqs" aria-expanded="false">FAQs</a>
                                                </li>
                                                <li class=""><a data-toggle="tab" href="#m_product" aria-expanded="false">Product</a>
                                                </li>
                                                <li class=""><a data-toggle="tab" href="#m_privacy_policy" aria-expanded="false">Privacy Statement</a>
                                                </li>                                   
                                                <li class=""><a data-toggle="tab" href="#m_terms_of_use" aria-expanded="false">Terms of Use</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="m_about" class="tab-pane active">
                                                    <div class="panel-body">
                                                       <div class="alert alert-info" data-id="s_title">Title<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_description">Description<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_banner">Banner<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                    </div>
                                                </div>
                                                <div id="m_article" class="tab-pane">
                                                    <div class="panel-body">
                                                       <div class="alert alert-info" data-id="s_title">Title<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_brief_description">Brief Description<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_image_banner">Image Banner<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_image_thumbnail">Image Thumbnail<i class="glyphicon glyphicon-chevron-right pull-right"></i></div> 
                                                        <div class="alert alert-info" data-id="s_article_body">Article Body<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_status">Status<i class="glyphicon glyphicon-chevron-right pull-right"></i></div> 
                                                        <div class="alert alert-info" data-id="s_meta_description">Meta Description<i class="glyphicon glyphicon-chevron-right pull-right"></i></div> 
                                                        <div class="alert alert-info" data-id="s_meta_keyword">Meta Keyword<i class="glyphicon glyphicon-chevron-right pull-right"></i></div> 
                                                    </div>
                                                </div>
                                                <div id="m_banners" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="alert alert-info" data-id="s_title">Title<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_description">Description<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_redirect_url">Redirect URL<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_image_banner">Image Banner<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_status">Status<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                    </div>
                                                </div>
                                                <div id="m_contact_us" class="tab-pane">
                                                    <div class="panel-body">
                                                        
                                                    </div>
                                                </div>
                                                <div id="m_faqs" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="alert alert-info" data-id="s_question">Question<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_answer">Answer<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                    </div>
                                                </div>
                                                <div id="m_product" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="alert alert-info" data-id="s_title">Title<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_description">Description<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_image">Image<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                    </div>
                                                </div>
                                                <div id="m_privacy_policy" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="alert alert-info" data-id="s_title">Title<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_statement">Statement<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                    </div>
                                                </div>  
                                                <div id="m_signup" class="tab-pane">
                                                    <div class="panel-body">
                                                        
                                                    </div>
                                                </div>
                                                <div id="m_terms_of_use" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="alert alert-info" data-id="s_title">Title<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                        <div class="alert alert-info" data-id="s_statement">Statement<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="p_custom" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="alert alert-info" data-id="s_textfield">Text<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                        <div class="alert alert-info" data-id="s_textarea">Textarea<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                        <div class="alert alert-info" data-id="s_ckeditor">CKEditor<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                        <div class="alert alert-info" data-id="s_dropdown">Dropdown<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                        <div class="alert alert-info" data-id="s_checkbox">Checkbox<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                        <div class="alert alert-info" data-id="s_radio">Radio<i class="glyphicon glyphicon-chevron-right pull-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-5">
                        <div id="custom_package_form">
                        <div id="drop_area_div">
                            <h3>Package Form</h3>
                            <div class="row db_prefix">
                                <input type="text" class="form-control hidden required_input" name="slug" id="slug" value="<?= $slug; ?>">
                                <input type="text" class="form-control hidden" name="module_path" value="<?= dirname(__FILE__);?>" />
                                <input type="text" class="form-control hidden" name="reload_path" value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" />
                                <div class="form-group">
                                    <label class="control-label col-md-4">Package Database</label>
                                    <div class="col-md-8">
                                    <input type="textbox" name="pkg_database"  class="form-control" readonly="" value="pckg_<?=substr($slug, 24);?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Listing</label>
                                    <div class="col-md-8">
                                    <select class="form-control" name="pkg_listing" >
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div id="drop_area"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <button id="remove_all" class="btn btn-default remove-all"><i class="glyphicon glyphicon-trash"></i> Clear</button>
                                    <button id="btn_save" class="btn btn-primary btn-save" type="button"><i class="glyphicon glyphicon-floppy-saved"></i> Install</button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading_three">
              <h4 class="panel-title accord_h4">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Upload Package
                </a>
              </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_three">
              <div class="panel-body">
                <form id="package_form" action="<?= base_url("content_management/package/install");?>" method="post" enctype="multipart/form-data">
                    <div class="input-group col-md-5">
                        <input type="text" class="form-control hidden required_input" name="slug" id="slug" value="<?= $slug; ?>">
                        <input type="file" class="form-control required_input" name="package" id="file" accept=".zip" />
                        <input type="text" class="form-control hidden" name="module_path" value="<?= dirname(__FILE__);?>" />
                        <input type="text" class="form-control hidden" name="reload_path" value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" />
                        <div class="input-group-btn">
                            <button class="btn btn-primary" id="package_submit" type="submit">
                                INSTALL
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
              </div>
            </div>
          </div>
        </div>   
        <div class="clearfix"></div>
    </div>
</div>

<style type="text/css">
.accord_h4 {
    font-size: 25px;
    font-weight: bold;
}

.box-body {
    padding-top: 0px;
}

.packag-modal-title{
    text-align: center;
}

.package-img img {
    width:100%;
}

.package-full {
    top: 2px;
    right: 5px;
    cursor: pointer;
}

.package-min {
    top: 2px;
    right: 5px;
    cursor: pointer;
    font-size: 18px;
}

body .package-modal-active {
    width: 90vw;
    margin: 20px auto;
    height: 100%;
    transition: width 200ms !important;
    overflow-x: auto;
}

body .package-modal-inactive {
    margin: 30px auto;
    transition: width 200ms !important;
    overflow-x: auto;
}

/* width */
.package-modal ::-webkit-scrollbar {
    width: 10px;
}

/* Track */
.package-modal ::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
 
/* Handle */
.package-modal ::-webkit-scrollbar-thumb {
    background: #888; 
}

/* Handle on hover */
.package-modal ::-webkit-scrollbar-thumb:hover {
    background: #555; 
}

#package_form {
    display: inline;
}

.carousel-control span {
    -webkit-text-stroke: 1px black;
    color: white;
    text-shadow: 3px 3px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}

.panel-heading i {
    margin: 0px 3px;
    cursor: pointer;
    font-size: 18px;
}

.cp-settings {
    padding: 20px;
    display: none;
}

#drop_area_div {
    border: 1px solid #cccccc;
    border-radius: 3px;
    margin-top: 3px;
    margin-bottom: 10px;
    padding: 0px 10px 20px 10px;
}

#drop_area_div h3 {
    border-bottom: 1px solid #cccccc;
}

.panel {
    margin-bottom: 5px;
}

.panel-body {
    padding: 5px !important;
}

.panel-group .panel {
    margin-bottom: 5px;
}

.panel-settings .panel-body {
    padding: 0px !important;
}

.panel-settings {
    cursor: move;
    margin-bottom: 5px;
}

.db_prefix {
    margin-bottom: 10px;
}

.form-control {
    margin-bottom: 5px;
}

.border {
    margin-top: 9px;
}
.alert {
    margin: 5px 0px;
    cursor: pointer;
    padding: 10px;
}

.carousel-inner-panel .carousel-inner-item {
        height: 100px;
}

.pakage-modal-body {
    height: 550px;
    overflow: auto;  
}
</style>

<div class="row">
    <div class="col-md-12">
    </div>
</div>

<script type="text/javascript">

    $(function(){
        pkg_install_button();
        $('.info').powerTip();
    });

    $(document).on('change', '#file', function(){
        pkg_install_button();
    });

    /* Disables install button if no file is selected */
    function pkg_install_button(){
        var file = $('#file').val().trim();

        if(file == '' | file == null){
            $('#package_submit').attr('disabled', 'disabled');
        }else{
            $('#package_submit').removeAttr('disabled');
        }
    }

    $(document).ready(function(){
        $('.install_view').each(function(){
            var pkg_exists = $(this).attr('data-view');
            if(pkg_exists > 0){
                $(this).removeClass('btn-primary');
                $(this).addClass('btn-gray');
                $(this).attr('disabled', 'disabled');
                $(this).text('INSTALLED');
            }
        });
    });
    
    $(document).on('submit','form',function(){
        var theForm = $(this);
        e.preventDefault();
        if(validate.standard()){
            var modal_obj = '<?= $this->standard->confirm("package_install"); ?>'; 
            modal.standard(modal_obj, function(result){
                if(result){
                    $(theForm).submit();
                }
            });
        }
    });

    $( document ).ready(function() {
        $('.package-full').show();
        $('.package-min').hide();
        $('.package-modal .modal-dialog').addClass('package-modal-inactive');
        $('.package-modal .modal-dialog').removeClass('package-modal-active');
    });

    $(document).on('click', '.package-full', function(){
        $('.package-modal .modal-dialog').addClass('package-modal-active');
        $('.package-modal .modal-dialog').removeClass('package-modal-inactive');
        $('.package-full').hide();
        $('.package-min').show();
    });

    $(document).on('click', '.package-min', function(){
        $('.package-modal .modal-dialog').addClass('package-modal-inactive');
        $('.package-modal .modal-dialog').removeClass('package-modal-active');
        $('.package-full').show();
        $('.package-min').hide();
    });

    $(document).on('click', '#package_cancel', function(){
        $('.package-modal .modal-dialog').addClass('package-modal-inactive');
        $('.package-modal .modal-dialog').removeClass('package-modal-active');
        $('.package-full').show();
        $('.package-min').hide();
    });

    $(document).on('click', '#btn_close_modals', function(){
        $('.modal').modal('hide');
    });

</script>
<script>
    var counter = 1;
    var counter_attr = 0;

    $( function() {
        $( "#drop_area" ).sortable();
        $( "#drop_area" ).disableSelection();
    } );

    $(document).on('click', '.alert', function(){

        var obj_data_type = '<div class="form-group">';
        obj_data_type += '<label class="control-label col-md-3">Data Type</label>';
        obj_data_type += '<div class="col-md-9">';
        obj_data_type += '<select class="form-control" name="datatype_'+counter_attr+'">';
        obj_data_type +=     '<option value="char">Char</option>';
        obj_data_type +=     '<option value="varchar">Varchar</option>';
        obj_data_type +=     '<option value="text">Text</option>';
        obj_data_type +=     '<option value="blob">Blob</option>';
        obj_data_type +=     '<option value="int">Int</option>';
        obj_data_type +=     '<option value="big int">Big Int</option>';
        obj_data_type +=     '<option value="float">Float</option>';
        obj_data_type +=     '<option value="double">Double</option>';
        obj_data_type +=     '<option value="decimal">Decimal</option>';
        obj_data_type +=     '<option value="date">Date</option>';
        obj_data_type +=     '<option value="datetime">Datetime</option>';
        obj_data_type +=     '<option value="timestamp">Timestamp</option>';
        obj_data_type += '</select>';
        obj_data_type += '<input type = "hidden" name="databuilder_'+counter_attr+'" class="input_databuilder_'+counter_attr+'" value="0">';
        obj_data_type += '</div>';
        obj_data_type += '</div>';

        var obj_display = '<div class="form-group">';
        obj_display += '<label class="control-label col-md-3">Display</label>';
        obj_display += '<div class="col-md-9">';
        obj_display += '<select class="form-control" name="display_'+counter_attr+'"><option value="1">Yes</option><option value="0">No</option></select>';
        obj_display += '</div>';
        obj_display += '</div>';

        var obj_required = '<div class="form-group">';
        obj_required += '<label class="control-label col-md-3">Required</label>';
        obj_required += '<div class="col-md-9">';
        obj_required += '<select class="form-control" name="required_'+counter_attr+'"><option value="1">Yes</option><option value="0">No</option></select>';
        obj_required += '</div>';
        obj_required += '</div>';

        var obj_label = '<div class="form-group">';
        obj_label += '<label class="control-label col-md-3">Label*</label>';
        obj_label += '<div class="col-md-9">';
        obj_label += '<input type="textbox" class="form-control input_label'+counter_attr+' requ" name="label_'+counter_attr+'" placeholder="Enter Label">';
        obj_label += '</div>';
        obj_label += '</div>';

        var obj_name = '<div class="form-group">';
        obj_name += '<label class="control-label col-md-3">Name*</label>';
        obj_name += '<div class="col-md-9">';
        if ($('.border > .tabs-container > .nav-tabs > li:nth-child(1)').hasClass('active')) {
            obj_name += '<input type="textbox" name="name_'+counter_attr+'" class="form-control input_name'+counter_attr+' requ" placeholder="Enter Name" readonly>';
        } else {
            obj_name += '<input type="textbox" name="name_'+counter_attr+'" class="form-control input_name'+counter_attr+' requ" placeholder="Enter Name">';
        }
        obj_name += '</div>';
        obj_name += '</div>';

        var obj_id = '<div class="form-group">';
        obj_id += '<label class="control-label col-md-3">ID*</label>';
        obj_id += '<div class="col-md-9">';
        if ($('.border > .tabs-container > .nav-tabs > li:nth-child(1)').hasClass('active')) {
            obj_id += '<input type="textbox" class="form-control input_id'+counter_attr+' requ" name="id_input_'+counter_attr+'" placeholder="Enter ID" readonly>';
        } else {
            obj_id += '<input type="textbox" class="form-control input_id'+counter_attr+' requ" name="id_input_'+counter_attr+'" placeholder="Enter ID">';
        }
        obj_id += '</div>';
        obj_id += '</div>';

        var obj_class = '<div class="form-group">';
        obj_class += '<label class="control-label col-md-3">Class*</label>';
        obj_class += '<div class="col-md-9">';
        if ($('.border > .tabs-container > .nav-tabs > li:nth-child(1)').hasClass('active')) {
            obj_class += '<input type="textbox" class="form-control input_class'+counter_attr+' requ"  name="input_class_'+counter_attr+'" placeholder="Enter Class" readonly>';
        } else {
            obj_class += '<input type="textbox" class="form-control input_class'+counter_attr+' requ" name="input_class_'+counter_attr+'" placeholder="Enter Class">';
        }
        obj_class += '</div>';
        obj_class += '</div>';

        var obj_placeholder = '<div class="form-group">';
        obj_placeholder += '<label class="control-label col-md-3">Placeholder</label>';
        obj_placeholder += '<div class="col-md-9">';
        obj_placeholder += '<input type="textbox" class="form-control input_placeholder'+counter_attr+'" name="placeholder_'+counter_attr+'" placeholder="Enter Placeholder">';
        obj_placeholder += '</div>';
        obj_placeholder += '</div>';

        var obj_maxlength = '<div class="form-group" id="remove_maxlength">';
        obj_maxlength += '<label class="control-label col-md-3">Max Length</label>';
        obj_maxlength += '<div class="col-md-9">';
        obj_maxlength += '<input type="number" class="form-control input_maxlength'+counter_attr+'"  min="0" onkeypress="check_max_length_input('+counter_attr+')" onpaste="return false;" name="maxlength_'+counter_attr+'" placeholder="Enter Maxlength">';
        obj_maxlength += '</div>';
        obj_maxlength += '</div>';

        var obj_note = '<div class="form-group">';
        obj_note += '<label class="control-label col-md-3">Note</label>';
        obj_note += '<div class="col-md-9">';
        obj_note += '<input type="textbox" class="form-control input_note'+counter_attr+'" name="note_'+counter_attr+'" placeholder="Enter Note">';
        obj_note += '</div>';
        obj_note += '</div>';

        /* CUSTOM INPUTS */
        var obj_type = '<div class="form-group">';
        obj_type += '<label class="control-label col-md-3">Type</label>';
        obj_type += '<div class="col-md-9">';
        obj_type += '<select class="form-control"><option value="textbox">Textbox</option><option value="password">Password</option><option value="email">Email</option><option value="number">Number</option></select>';
        obj_type += '</div>';
        obj_type += '</div>';

        var input = $(this).data('id');
        switch(input) {
            case 's_title':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Title';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'title',
                        name:'id_title'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'title',
                        name:'name_title'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Title',
                        name:'label_title'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'title_input',
                        name:'class_title'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Title',
                        name:'placeholder_title'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_title'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_title'
                    });
                     
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_description':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Description';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'description',
                        name:'id_description'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'description',
                        name:'name_description'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Description',
                        name:'label_description'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'description_input',
                        name:'class_description'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Description',
                        name:'placeholder_description'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_description'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_description'
                    });       
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_banner':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Banner';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'banner',
                        name:'id_banner'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'banner',
                        name:'name_banner'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Banner',
                        name:'label_banner'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'banner_input',
                        name:'class_banner'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Banner',
                        name:'placeholder_banner'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_banner'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_banner'
                    });  
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_brief_description':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Brief Description';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'brief_description',
                        name:'id_brief_description'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'brief_description',
                        name:'name_brief_description'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Brief Description',
                        name:'label_brief_description'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'brief_description_input',
                        name:'class_brief_description'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Brief Description',
                        name:'placeholder_brief_description'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_brief_description'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_brief_description'
                    });  
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_image_banner':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Image Banner';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'image_banner',
                        name:'id_image_banner'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'image_banner',
                        name:'name_image_banner'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Image banner',
                        name:'label_image_banner'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'image_banner_input',
                        name:'class_image_banner'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Image Banner',
                        name:'placeholder_image_banner'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_image_banner'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_image_banner'
                    });
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_image_thumbnail':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Image Thumbnail';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'image_thumbnail',
                        name:'id_image_thumbnail'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'banner_thumbnail',
                        name:'name_image_thumbnail'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Image Thumbnail',
                        name:'label_image_thumbnail'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'image_thumbnail_input',
                        name:'class_image_thumbnail'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Image Thumbnail',
                        name:'placeholder_image_thumbnail'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_image_thumbnail'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_image_thumbnail'
                    });  
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_image':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Image';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'image',
                        name:'id_image'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'image',
                        name:'name_image'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Image',
                        name:'label_image'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'image_input',
                        name:'class_image'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Image',
                        name:'placeholder_image'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_image'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_image'
                    });
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_article_body':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Article Body';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'article_body',
                        name:'id_article_body'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'article_body',
                        name:'name_article_body'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Article Body',
                        name:'label_article_body'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'article_body_input',
                        name:'class_article_body'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Article Body',
                        name:'placeholder_article_body'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_article_body'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_article_body'
                    });
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_status':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Status';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'status',
                        name:'id_status' 
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'status',
                        name:'name_status'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Status',
                        name:'label_status'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'status_input',
                        name:'class_status'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Status',
                        name:'placeholder_status'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_status'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_status'
                    }); 
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_meta_description':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Meta Description';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'meta_description',
                        name:'id_meta_description'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'meta_description',
                        name:'name_meta_description'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Meta Description',
                        name:'label_meta_description'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'meta_description_input',
                        name:'class_meta_description'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Meta Description',
                        name:'placeholder_meta_description'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_meta_description'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_meta_description'
                    });  
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_meta_keyword':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Meta Keyword';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'meta_keyword',
                        name:'id_meta_keyword'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'meta_keyword',
                        name:'name_meta_keyword'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Meta Keyword',
                        name:'label_meta_keyword'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'meta_keyword_input',
                        name:'class_meta_keyword'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Meta Keyword',
                        name:'placeholder_meta_keyword'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_meta_keyword'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_meta_keyword'
                    });
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_redirect_url':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Redirect URL';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'redirect_url',
                        name:'id_redirect_url'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'redirect_url',
                        name:'name_redirect_url'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'redirect URL',
                        name:'label_redirect_url'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'redirect_url_input',
                        name:'class_redirect_url'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Redirect URL',
                        name:'placeholder_redirect_url'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_redirect_url'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_redirect_url'
                    });
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_question':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Question';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'question',
                        name:'id_question'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'question',
                        name:'name_question'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Question',
                        name:'label_question'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'question_input',
                        name:'class_question'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Question',
                        name:'placeholder_question'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_question'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_question'
                    });
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_answer':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Answer';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'answer',
                        name:'id_answer'
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'answer',
                        name:'name_answer'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Answer',
                        name:'label_answer'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'answer_input',
                        name:'class_answer'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Answer',
                        name:'placeholder_answer'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_answer'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_answer'
                    });
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_statement':
                var check = validate_title($(this));
                if(!check){
                    var name = 'Statement';
                    var obj = [
                        obj_data_type,
                        obj_display,
                        obj_required,
                        obj_label,
                        obj_name,
                        obj_id,
                        obj_class,
                        obj_placeholder,
                        obj_maxlength,
                        obj_note
                    ];
                    obj_builder(obj,name);
                    $('.input_databuilder_'+counter_attr).attr({
                        value:'1'
                    });
                    $('.input_id'+counter_attr).attr({
                        value:'statement',
                        name:'id_statement',
                    });
                    $('.input_name'+counter_attr).attr({
                        value:'statement',
                        name:'name_statement'
                    });
                    $('.input_label'+counter_attr).attr({
                        value:'Statement',
                        name:'label_statement'
                    });
                    $('.input_class'+counter_attr).attr({
                        value:'statement_input',
                        name:'class_statement'
                    });
                    $('.input_placeholder'+counter_attr).attr({
                        value:'Statement',
                        name:'placeholder_statement'
                    });
                    $('.input_maxlength'+counter_attr).attr({
                        value:'255',
                        name:'maxlength_statement'
                    });
                    $('.input_note'+counter_attr).attr({
                        value:' ',
                        name:'note_statement'
                    });
                }else{
                   modal.alert('Already Used! Go to custom input builder.', function(){});
                }

                break;
            case 's_textfield':
                var name = 'Text';
                var obj = [
                    obj_data_type,
                    obj_display,
                    obj_required,
                    obj_type,
                    obj_label,
                    obj_name,
                    obj_id,
                    obj_class,
                    obj_placeholder,
                    obj_maxlength,
                    obj_note
                ];

                obj_builder(obj,name);
                break;
            case 's_textarea':
                var name = 'Textarea';
                var obj = [
                    obj_data_type,
                    obj_display,
                    obj_required,
                    obj_label,
                    obj_name,
                    obj_id,
                    obj_class,
                    obj_placeholder,
                    obj_maxlength,
                    obj_note
                ];
                obj_builder(obj,name);
                break;
            case 's_ckeditor':
                var name = 'CKEditor';
                var obj = [
                    obj_data_type,
                    obj_display,
                    obj_required,
                    obj_label,
                    obj_name,
                    obj_id,
                    obj_class,
                    obj_placeholder,
                    obj_maxlength,
                    obj_note
                ];
                obj_builder(obj,name);
                break;
            case 's_dropdown':
                var name = 'Dropdown';
                var obj = [
                    obj_data_type,
                    obj_display,
                    obj_required,
                    obj_label,
                    obj_name,
                    obj_id,
                    obj_class,
                    obj_placeholder,
                    obj_maxlength,
                    obj_note
                ];
                obj_builder(obj,name);
                break;
            case 's_checkbox':
                var name = 'Checkbox';
                var obj = [
                    obj_data_type,
                    obj_display,
                    obj_required,
                    obj_label,
                    obj_name,
                    obj_id,
                    obj_class,
                    obj_placeholder,
                    obj_maxlength,
                    obj_note
                ];
                obj_builder(obj,name);
                break;
            case 's_radio':
                var name = 'Radio';
                var obj = [
                    obj_data_type,
                    obj_display,
                    obj_required,
                    obj_label,
                    obj_name,
                    obj_id,
                    obj_class,
                    obj_placeholder,
                    obj_maxlength,
                    obj_note
                ];
                obj_builder(obj,name);
                break;
            default:
        }

        counter_attr++;
    });
    
    duplicate_field_name = 0;

    $('body').on('click', '.cp-settings-btn', function() {
        var di = $(this).data('id');
        $content = $('.settings-opt[data-panel='+di+']');
        $content.slideToggle(500, function () {});
        return false;
    });

    $('body').on('click', '.cp-remove-btn', function() {
        count = $(this).parent().next().find('.error_message').length;
        if(duplicate_field_name > 0)
        {
            duplicate_field_name = duplicate_field_name-count;
        }

        var di = $(this).data('id');
        $('.panel-settings[data-panel='+di+']').fadeOut(200, function() { $(this).remove(); });
        return false;
    });

    $('body').on('click', '#remove-all', function() {
        $('.panel-settings').fadeOut(200, function() { $(this).remove(); });
        $('#drop_area input').val("");
        return false;
    });
    
    $('body').on('click', '.down', function() {
        var di = $(this).data('id');
        var e = $('.panel-settings[data-panel='+di+']');
        e.next().insertBefore(e);
    });

    $('body').on('click', '.up', function() {
        var di = $(this).data('id');
        var e = $('.panel-settings[data-panel='+di+']');
        e.prev().insertAfter(e);
    });

     $('body').on('click', '#btn_save', function(event) {
        console.log(duplicate_field_name);
        if ($('#drop_area .panel-settings').length > 0) {
            $('.panel-default').css('border-color','#ccc');
            if(validate.required('.requ') == 0){
                if(duplicate_field_name == 0){
                    modal.standard('<?= $this->standard->confirm("package_install"); ?>', function(result) {
                        if (result) {
                            modal.loading(true);
                            var url = "<?=base_url('content_management/package/install_builder')?>";
                            var data = {
                                package_db: $("input[name='pkg_database']").val(),
                                package_listing: $("select[name='pkg_listing']").val(),
                                slug: $("input[name='slug']").val(),
                                module_path: $("input[name='module_path']").val(),
                                reload_path: $("input[name='reload_path']").val(),
                                selected_pckg : JSON.stringify($('input[name*="selected_pckg_"]').serializeArray()),
                                input_id: JSON.stringify($('.cp-settings :input[name*="id_"]').serializeArray()),
                                input_class: JSON.stringify($('.cp-settings :input[name*="class_"]').serializeArray()),
                                input_data: JSON.stringify($('.cp-settings :input[name*="name_"]').serializeArray()),
                                input_label: JSON.stringify($('.cp-settings :input[name*="label_"]').serializeArray()),
                                input_placeholder: JSON.stringify($('.cp-settings :input[name*="placeholder_"]').serializeArray()),
                                datatype: JSON.stringify($('.cp-settings :input[name*="datatype_"]').serializeArray()),
                                databuilder: JSON.stringify($('.cp-settings :input[name*="databuilder_"]').serializeArray()), 
                                display: JSON.stringify($('.cp-settings :input[name*="display_"]').serializeArray()),
                                required: JSON.stringify($('.cp-settings :input[name*="required_"]').serializeArray()),
                                maxlength: JSON.stringify($('.cp-settings :input[name*="maxlength_"]').serializeArray()),
                                note: JSON.stringify($('.cp-settings :input[name*="note_"]').serializeArray()),
                            }
                            
                            aJax.post(url,data,function(result){
                                modal.loading(false);
                                modal.alert("<?= $this->standard->dialog("package_success") ?>", function() {
                                    location.reload();
                                });
                            });
                        }
                    });
                }else{
                    modal.alert("<?= $this->standard->dialog('package_field_duplicate')?>");
                }
            }
            else
            {
                // panel-default
                $('.validate_error_message').closest('.panel-default').css('border-color','red');
            }
           
        } else {
            modal.alert("<?= $this->standard->dialog('package_empty')?>");
        }
    });

    $(document).on("focusout",':input[name*="id_input_"]',function(){
        if($(this).val() != '')
        {
            id_result = check_duplicate_in_object('value',$('.cp-settings :input[name*="id_"]').serializeArray());
            path = this;
            validating_field(id_result,'ID');
            $('.error_message').closest('.panel-default').css('border-color','red');
        }
    });

    $(document).on("focusout",':input[name*="name_"]',function(){
        if($(this).val() != '')
        {
            name_result = check_duplicate_in_object('value',$('.cp-settings :input[name*="name_"]').serializeArray());
            path = this;
            validating_field(name_result,'Name');
            $('.error_message').closest('.panel-default').css('border-color','red');
        }
    });
    
    $(document).on("click",'div[data-id="s_image_banner"], div[data-id="s_banner"], div[data-id="s_image"], div[data-id="s_status"], div[data-id="s_image_thumbnail"]',function(){
        $('#remove_maxlength').remove();       
    });

    function validating_field(data,field)
    {
        var error_message = "<span class='error_message' style='color: red;'>"+field+" already exists.<br></span>";
        $(path).css({'border-color':'#ccc'});
        $(path).parent().find('span').remove();
        if(data != false){
            $(path).css('border-color','red');
            $(error_message).insertAfter(path);
            duplicate_field_name++;
        }else{
            if(duplicate_field_name > 0)
            {
                duplicate_field_name--;
            }
        }
    }

    function check_duplicate_in_object(propertyName, inputArray) {
        var seen_duplicate = false,
        test_object = {};

        inputArray.map(function(item) {
            var itemPropertyName = item[propertyName]; 
            if (itemPropertyName in test_object) {
                test_object[itemPropertyName].duplicate = true;
                item.duplicate = true;
                seen_duplicate = [true,test_object];
            }else {
                test_object[itemPropertyName] = item;
                delete item.duplicate;
            }
        });

        return seen_duplicate;
    }

    function obj_builder(obj,name){
        var form_obj = '';
        input_id = 'sample';
        $.each(obj, function(index, value) {
            form_obj += value;
        });

        var attr_ui = '<div class="panel-settings" data-panel="'+counter+'">';
        attr_ui +='<div class="panel panel-default">';
        attr_ui +='<div class="panel-heading">';
        attr_ui += '<span class="o_title" name="selected_pckg_'+counter+'" value='+name+'>'+name+'</span>';
        attr_ui += '<input type="hidden" class="form-control o_title" name="selected_pckg_'+counter+'" value='+name+'>';
        attr_ui +='<i class="glyphicon glyphicon-remove pull-right cp-remove-btn" data-id="'+counter+'" title="Remove"></i>';
        attr_ui +='<i class="glyphicon glyphicon-edit pull-right cp-settings-btn" data-id="'+counter+'" title="Edit"></i>';
        attr_ui +='<i class="glyphicon glyphicon-chevron-up pull-right up" data-id="'+counter+'" title="Move Up"></i>';
        attr_ui +='<i class="glyphicon glyphicon-chevron-down pull-right down" data-id="'+counter+'" title="Move Down"></i>';
        attr_ui +='</div>';
        attr_ui +='<div class="panel-body">';
        attr_ui +='<div class="cp-settings settings-opt" data-panel="'+counter+'">';

        attr_ui += form_obj;

        attr_ui +='</div>';
        attr_ui +='</div>';
        attr_ui +='</div>';
        attr_ui +='</div>';

        $('#drop_area').append(attr_ui);
        counter++;
    }

    function validate_title(selector){
        var is_contains = $('.o_title').text().indexOf(selector.text()) > -1;
        return is_contains;
    }

    function check_max_length_input(counter){
        $(document).on('keypress', '.input_maxlength'+counter, function(event) {
            if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {
                return false;
            }
        });
    }

</script>