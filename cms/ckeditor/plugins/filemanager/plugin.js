CKEDITOR.plugins.add('filemanager', {
    icons : "folder",
    init: function (editor) {
        var cmd = editor.addCommand('open_filemanager', { exec: open_filemanager });
        editor.ui.addButton('Filemanager', {
            label: 'File Manager',
            command: 'open_filemanager',
            icon: CKEDITOR.plugins.getPath('filemanager') + 'folder.png'
        });
    }
});

var editor = null;
function open_filemanager(e) {
    $('#ckeditor_filemanager_modal').modal("show");
    $('#filemanager_identifier').val("ckeditor");
    editor = e;
}

function get_data(e){
    e.insertHtml(' Hello ');
}


element.click(".btn_insert", function(){
    if($('#filemanager_identifier').val() == "ckeditor"){
        var extension = base_url + $('#file_url').val();
        var ext =  extension.split('.').pop();
        switch(ext.toLowerCase()) {
            case 'jpg':
            case 'png':
            case 'gif':
                var html = '<img src="'+extension+'" alt="'+$('#file_alt').val()+'" style="width : '+$('#file_width').val()+'; height: '+$('#file_height').val()+'" />';
            break;                         // the alert ended with pdf instead of gif.
            case 'mp4':
                var html = '<video style="width : '+$('#file_width').val()+'; height: '+$('#file_height').val()+'" controls>';
                html += '<source src="'+extension+'" type="video/mp4">';
                html += 'Your browser does not support HTML5 video.';
                html += '</video>';
            break;
            default:
                var html = 'Download Link : <a href="'+extension+'" target="blank">'+filename(extension)+'</a>';

        }
        editor.insertHtml(html);
        $("#ckeditor_filemanager_modal").modal("hide");
    }
   
}); 


function filename(path){
    path = path.substring(path.lastIndexOf("/")+ 1);
    return (path.match(/[^.]+(\.[^?#]+)?/) || [])[0];
}
