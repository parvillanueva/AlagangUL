<footer class="au-footer">
    <div class="container-fluid">
        <div class="au-container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-6">					
                    <img src="<?=base_url()?>assets/site/img/au_unilab_trusted.png" alt="Unilab" width="200px" class="au-footerimg">
                </div>
                <div class="col-md-6 au-footer-details">
                        <div class="au-footer-links">
                    <?php
                        if($this->session->userdata("user_sess_email") != ""){
                    ?>
                            <span class="au-pf"><a href="<?= base_url("terms-and-conditions");?>">Terms and Conditions</a></span>
                            <span class="au-pf"><a href="<?= base_url("privacy-statement");?>">Privacy Statement</a></span>
                    <?php
                    }?>
                        </div>
                    <span class="au-pf">2020 All Rights Reserved © Unilab, Inc.</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade text-center" id="defaultModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="au-modalbtn text-center">
                    <button type="button" class="au-btn au-btnyellow" data-dismiss="modal">Close</button>
                    <button type="button" class="au-btn" id="btnsubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-center" id="usertimeout">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <span class="au-h4">You have been logged out.</span>
                    <span class="au-p6">Due to inactivity, you have been logged out from the website.</span>
                    <div class="au-modalbtn text-center">
                        <button type="button" class="au-btn" id="modalClose" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</div>


<script src="<?=base_url()?>assets/site/js/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/site/js/popper.min.js" text="type/javascript"></script>
<script src="<?=base_url()?>assets/site/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url();?>assets/site/js/ekko-lightbox.js"></script>
<script src="<?=base_url()?>assets/site/js/script.js"></script>
<script src="<?=base_url()?>assets/site/js/moment.min.js" type="text/javascript" ></script>
<script src="<?=base_url()?>assets/site/js/daterangepicker.js" type="text/javascript" ></script>
<script src="<?=base_url()?>assets/site/slick/slick.js"></script>
<script src="<?= base_url();?>assets/site/js/bootstrap-show-modal.js"></script>


<?php if(!empty($js)) : ?>
    <?php foreach($js as $path) : ?>
        <script type="text/javascript" src="<?= base_url() . $path; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function(){
    // 900000 milliseconds = 5 minutes
    var idleState = false;
    var idleTimer = null;
    $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
        clearTimeout(idleTimer);
        idleState = false;
        idleTimer = setTimeout(function(){
            aJax.get('<?= base_url()?>site/logout/unset_session', function(){});
            $('#usertimeout').modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
            idleState = true;
        }, 1800000);

        $(document).on('click','#modalClose',function(){
            location.href = "<?= base_url('log-out')?>"
        })
        ///300000
    });
    $("body").trigger("mousemove");
});
</script>