<?php 
    $this->config->load('cms_version'); 
    //checking updates
/*    $output = json_decode(file_get_contents("http://172.29.70.126/cms_patch?action=get_version"),true); 
;
*/
    if(FALSE !== ($content = @file_get_contents("http://172.29.70.126/cms_patch?action=get_version"))){ 
        $output = json_decode(file_get_contents("http://172.29.70.126/cms_patch?action=get_version"),true);
    }else{
        $output = '';
    }
?>
<div id="version_patch" class="modal fade" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Content Management</h4>
            </div>
            <div class="modal-body">
                <center>
                   <?php if($output){ ?>  
                        <h2>Version : <b><?= $this->config->item("version"); ?></b></h2>
                        <?php if($output['id'] > $this->config->item("version_id") ) {  ?>
                            <a href="<?= base_url("content_management/patch") . "?version=" . $this->config->item("version_id");?>" class="btn btn-primary">Update CMS (<?= $output['version_code'];?>)</a>
                        <?php } else { ?>
                            <label>No update available</label>
                        <?php } ?>
                    <?php }else{?>
                         <label>Network Error Connection</label>
                   <?php }?>
                </center>
            </div>
        </div>
    </div>
</div>
