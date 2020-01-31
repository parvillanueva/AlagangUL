
CKEDITOR.editorConfig = function( config )
{
	config.toolbarCanCollapse = false;
	config.resize_enabled = false;
	config.readOnly = false;
	config.removePlugins = 'elementspath';
    config.ForceSimpleAmpersand = true;
	
    config.toolbar = 'MyToolbar';


    config.toolbar_MyToolbar =
    [
        ['Source'],
        ['Styles','Format','Font','FontSize'],
         '/',
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        ['Undo','Redo'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Filemanager','Youtube']
    ];

    config.extraPlugins = 'font,filemanager,youtube,typographic';
    config.allowedContent = true;

};


CKEDITOR.on( 'instanceReady', function( ev )
{
     ev.editor.dataProcessor.writer.setRules( 'p',
                {
                    indent :           false,
                    breakBeforeOpen :  true,
                    breakAfterOpen :   false,
                    breakBeforeClose : false,
                    breakAfterClose :  true
                });
     ev.editor.dataProcessor.writer.setRules( 'p',
                {
                    indent :           false,
                    breakBeforeOpen :  false,
                    breakAfterOpen :   false,
                    breakBeforeClose : false,
                    breakAfterClose :  false
                });
});
