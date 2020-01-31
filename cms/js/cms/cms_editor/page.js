var g_link;
var content;
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
    lineNumbers: true,
    mode: "css",
    keyMap: "sublime",
    autoCloseBrackets: true,
    matchBrackets: true,
    showCursorWhenSelecting: true,
    theme: "monokai",
    tabSize: 2
});

function read_file(link){
    
    var file = base_url + link;
    g_link = link;
    var url = file;
    var last_segment = url.split('/').slice(-1).join(); 
    $("#fname").html(last_segment);
    $("#fpath").html(file);
    if (file.match(/\.(jpg|jpeg|png|gif)$/)) {
        $(".btn_update").hide();
        $("#txtcon").hide();
        $("#imgcon").show();
        $("#imgcon").html("<img src='"+file+"' class='img-responsive'>");
    }else{
        if(file.match(/\.(js)$/)){
            editor.setOption("mode", "javascript");
        }else{
            editor.setOption("mode", "css");
        }
        $(".btn_update").show();
        $("#txtcon").show();
        $.post(file, function(data) {
            $("#imgcon").hide();
            $("#code").html("");
            editor.getDoc().setValue(data);
            content = data;
        });
    }
}

$(document).on('click', '#btn_update', function(){
   
    if(validate.standard()){
        var modal_obj = confirm_update; 
        modal.standard(modal_obj, function(result){
            if(result){
                var url = content_management + '/write_data'; 
                var data = {
                    link : g_link,
                    content : editor.getDoc().getValue()
                }

                aJax.post(url,data,function(result){
                    modal.alert(update_success, function(){
                        // location.reload();
                    });
                });
            }
        });
    }
});

$(document).on('click', '#btn_close', function(){  
    window.location.replace(content_management);
});