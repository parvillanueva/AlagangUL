<!-- INSERT AUDIT TRAL -->
<script type="text/javascript">
    function add_audit_trail(action){
        var el = document.createElement('a');
        el.href = window.location.href;
        console.log(el.href);
        var data = {action:action,uri:el.href};
        aJax.post(
            "<?=base_url('content_management/global_controller/audit_trail')?>",
            data,
            function(data){} 
        );
    }

</script>
<!-- UPLOAD MODAL -->
<!-- MODAL -->
<div id="ckeditor_filemanager_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">File Manager : </h4>
            </div>
            <div class="modal-body">
                <?php if($this->uri->segment(2) != "file_manager"){ $this->load->view("content_management/filemanager/browser"); }?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- FOR YOUTUBE EMBED -->
<div id="youtube_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Embed Youtube </h4>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="usr">URL:</label>
                    <input type="text" class="form-control" id="youtube_url">
                </div>
                <div class="form-group col-md-6">
                    <label for="usr">Width:</label>
                    <input type="number" class="form-control" id="youtube_width" value="560">
                </div>
                <div class="form-group col-md-6">
                    <label for="usr">Height:</label>
                    <input type="number" class="form-control" id="youtube_height" value="315">
                </div>
                <div class="form-group col-md-12">
                    <label for="usr"></label>
                    <label class="checkbox-inline"><input type="checkbox" value="" id="youtube_responsive">Responsive (fit to screen width)</label>
                    <label class="checkbox-inline"><input type="checkbox" value="" id="youtube_autoplay">Auto Play</label>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="youtube_insert" class="btn btn-primary" >Insert</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "#youtube_responsive", function(){
        if($(this).is(':checked')){
            $('#youtube_width').attr("disabled",true);
            $('#youtube_height').attr("disabled",true);

            $('#youtube_width').val("");
            $('#youtube_height').val("");
        } else {
            $('#youtube_width').attr("disabled",false);
            $('#youtube_height').attr("disabled",false);

            $('#youtube_width').val("560");
            $('#youtube_height').val("315");
        }
    });
</script>

<!-- FOR YOUTUBE INPUT -->
<div id="youtube_input" class="modal fade" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Embed Youtube </h4>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="usr">URL:</label>
                    <input type="text" class="form-control" id="youtube_url_input">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="youtube_insert_input" class="btn btn-primary" >Insert</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "#youtube_insert_input", function(e){

        var data_id = $(this).attr("identifier");
        var youtube_url = $("#youtube_url_input").val();

        if(match_youtube_url(youtube_url)){
            $('.youtube-iframe-container').remove();
            //generate preview
            var html = "";
            html += '<div class="youtube-iframe-container" style="position: relative;padding-bottom: 56.25%;padding-top: 25px;height: 0;">';
            html += '<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;" src="https://www.youtube.com/embed/'+youtube_parser(youtube_url)+'" frameborder="0" allowfullscreen></iframe>';
            html += '</div>';

            $('.'+data_id).next('.youtube_preview').remove();
            $('#'+data_id).val("https://www.youtube.com/embed/"+youtube_parser(youtube_url));
            $(html).insertAfter('.'+data_id);

            //close modal
            $("#youtube_input").modal("hide");
        } else {
            modal.alert("Invalid Youtube URL");
        }
    });

    function match_youtube_url(url) {
        var p = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
        if(url.match(p)){
            return url.match(p)[1];
        }
        return false;
    }

</script>