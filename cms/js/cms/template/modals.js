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

$(document).on("click", "#youtube_responsive", function(){
    if($(this).is(':checked')){
        $('#youtube_width').attr("disabled",true);
        $('#youtube_height').attr("disabled",true);

        $('#youtube_width').val("");
        $('#youtube_height').val("");
    }else{
        $('#youtube_width').attr("disabled",false);
        $('#youtube_height').attr("disabled",false);

        $('#youtube_width').val("560");
        $('#youtube_height').val("315");
    }
});

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