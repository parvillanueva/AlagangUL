CKEDITOR.plugins.add('typographic', {
    icons : "icons",
    init: function (editor) {
        var cmd = editor.addCommand('cmd_b', { exec: cmd_b });
        editor.ui.addButton('typo_Bold', {
            label: 'Bold',
            command: 'cmd_b',
            icon: CKEDITOR.plugins.getPath('typographic') + 'icons/bold.png'
        });
    }
});

var editor = null;
function cmd_b(e) {
	
    editor = e;
}