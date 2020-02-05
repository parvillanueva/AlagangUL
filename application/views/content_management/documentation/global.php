<!-- <link rel=stylesheet href="<?= base_url();?>vendor/codemirror/doc/docs.css"> -->
<link rel="stylesheet" href="<?= base_url();?>vendor/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="<?= base_url();?>vendor/codemirror/addon/fold/foldgutter.css">
<link rel="stylesheet" href="<?= base_url();?>vendor/codemirror/addon/dialog/dialog.css">
<link rel="stylesheet" href="<?= base_url();?>vendor/codemirror/theme/monokai.css">
<script src="<?= base_url();?>vendor/codemirror/lib/codemirror.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/search/searchcursor.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/search/search.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/dialog/dialog.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/edit/matchbrackets.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/edit/closebrackets.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/comment/comment.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/wrap/hardwrap.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/fold/foldcode.js"></script>
<script src="<?= base_url();?>vendor/codemirror/addon/fold/brace-fold.js"></script>
<script src="<?= base_url();?>vendor/codemirror/mode/javascript/javascript.js"></script>
<script src="<?= base_url();?>vendor/codemirror/keymap/sublime.js"></script>

<style type="text/css">
  .CodeMirror {border-top: 1px solid #eee; border-bottom: 1px solid #eee; line-height: 1.3; height: auto;}
  .CodeMirror-linenumbers { padding: 0 8px; }
  strong { font-size: 14px;  }
  .title { font-size: 18px;  margin-top: 15px; }
  .content.documentation {margin-top: 5em;}
</style>
<div class="content documentation">

	<label class="title">Global Controller Link <br><small><?= base_url('content_management/global_controller');?></small></label><br>
	<br><strong>Get List (javascript): </strong>
	<textarea id="code5">
		var url = "<?= base_url('content_management/global_controller');?>"; //URL OF CONTROLLER
    var data = {
    		event : "list", // list, insert, update, delete
        select : "[field select]", //select
        query : "[sql query]", //query
        offset : "[offset]", // offset or start
        limit : "[limit]", // limit
        table : "[table]", // table
        group : "[group]", // optional
        order : { //optional
            field : "[field to order]", //field to order
            order : "[order type]" //asc or desc
        },
        join : [ //optional
        	{
            	table : "[table to join]", //table
            	query : "[join query]", //join query
            	type : "[join type]" //type of join
            }
        ]
    }

    aJax.post(url,data,function(result){
    	var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
    	console.log(obj); //display result
    });
	</textarea>

	<strong>Save Data (javascript): </strong>
	<textarea id="code6">
		var url = "<?= base_url('content_management/global_controller');?>"; //URL OF CONTROLLER
    var data = {
    		event : "insert", // list, insert, update, delete
        table : "[table]", //table
        data : "[data]", //data to insert
    }

    aJax.post(url,data,function(result){
    	//success code here
    	//will return id of inserted value
    });
	</textarea>

	<strong>Update Data (javascript): </strong>
	<textarea id="code7">
		var url = "<?= base_url('content_management/global_controller');?>"; //URL OF CONTROLLER
    var data = {
    		event : "update", // list, insert, update, delete
        table : "[table]", //table
        field : "[field name]", //field name
        where : "[where value]", //equals to
        data : "[data]", //data to insert
    }

    aJax.post(url,data,function(result){
    	//code here
    	//will return "Success" or "Failed"
    });
	</textarea>

	<strong>Delete Data (javascript): </strong>
	<textarea id="code8">
		var url = "<?= base_url('content_management/global_controller');?>"; //URL OF CONTROLLER
    var data = {
    		event : "delete", // list, insert, update, delete
        table : "[table]", //table
        id : "[id]", //id to delete
    }

    aJax.post(url,data,function(result){
    	//code here
    	//will return "Success" or "Failed"
    });
	</textarea>

    <strong>Total Page Number for Pagination (javascript): </strong>
    <textarea id="code9">
    var url = "<?= base_url('content_management/global_controller');?>"; //URL OF CONTROLLER
    var data = {
        event : "pagination", // list, insert, update, delete
        select : "[field select]", //select
        query : "[sql query]", //query
        table : "[table]", // table
        join : [ //optional
            {
                table : "[table to join]", //table
                query : "[join query]", //join query
                type : "[join type]" //type of join
            }
        ]
    }

    aJax.post(url,data,function(result){
        //success code here
        //will return total number of page and record_count
        var obj = is_json(result);

        ///to get total record count 
        console(obj.total_record);

        ///to get total page :  
        console(obj.total_page); // page number will depend on the limit
    });
    </textarea>

</div>

<script>

	text_code("code5");
	text_code("code6");
	text_code("code7");
    text_code("code8");
	text_code("code9");

	function text_code(id){
		var editor = CodeMirror.fromTextArea(document.getElementById(id), {
		    lineNumbers: true,
		    mode: "javascript",
		    keyMap: "sublime",
		    autoCloseBrackets: true,
		    matchBrackets: true,
		    showCursorWhenSelecting: true,
		    theme: "monokai",
		    tabSize: 2
		  });
	}
  
</script>