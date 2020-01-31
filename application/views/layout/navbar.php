<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-10">
                <a href="javascript:void(0)l" onclick="menuBtn();" class="menu-open hide animated fadeIn">
                    <i class="far fa-bars"></i>
                </a>
            </div>
            <div class="col-xs-2">
                <div class="ic-header-wrapper">
                    <a href="#" id="ad_logout" class="ic-header" title="Logout">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<script type="text/javascript">
    $(document).on("click","#ad_logout", function(e){
        e.preventDefault();
        var modal_obj = '<?= $this->standard->confirm("confirm_logout"); ?>';
        modal.standard(modal_obj, function(result){
            if(result){
                location.href = "<?= base_url('azure_login/destroy');?>";
            }
        });
    });
    
</script>
