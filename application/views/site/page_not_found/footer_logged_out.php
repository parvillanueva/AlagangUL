<footer class="au-footer">
    <div class="container-fluid">
        <div class="au-container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-6">					
                    <img src="<?=base_url()?>assets/site/img/au_unilab_trusted.png" alt="Unilab" width="200px" class="au-footerimg">
                </div>
                <div class="col-md-6 au-footer-details">
                    <div class="au-footer-links">
                    </div>
                    <span class="au-pf">2020 All Rights Reserved © Unilab, Inc.</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="<?=base_url()?>assets/site/js/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/site/js/popper.min.js" text="type/javascript"></script>
<script src="<?=base_url()?>assets/site/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/site/js/script.js"></script>
<script src="<?=base_url()?>assets/site/js/moment.min.js" type="text/javascript" ></script>
<script src="<?=base_url()?>assets/site/js/daterangepicker.js" type="text/javascript" ></script>
<script src="<?=base_url()?>assets/site/slick/slick.js"></script>

<?php if(!empty($js)) : ?>
    <?php foreach($js as $path) : ?>
        <script type="text/javascript" src="<?= base_url() . $path; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
