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
</style>
<div class="content">
	<label class="title">Adding CMS Template Controller</label><br>
	<strong>Controller : </strong>
	<textarea id="code">
	public function index()
	{ // all required
		$data['title'] = "Content Management"; //this is for html header title
		$data['PageName'] = "Developers Documentation"; //Page Title/Name
		$data['content'] = "content_management/documentation/page"; //Path file for View
		$this->load->view('content_management/template/layout', $data); //Template
	}
	</textarea>


	<label class="title">Adding CMS Audit Trail</label><br>
	<strong>Call Javascript function : </strong>
	<textarea id="code2">
	add_audit_trail("[Action]");

	// Standard Action : 
	// Insert : [input] added to [module] [remarks]
	// Update : [input] updated in [module] [remarks]
	// Delete : [input] deleted in [module] [remarks]

	// Example :
	// add_audit_trail("King Villanueva added to User as Super Admin");
	</textarea>


	<label class="title">Ajax Helper</label><br>
	<strong>Javascript : </strong>
	<textarea id="code3">
	//POST
	aJax.post("[url]","[data]", function(return){
		alert(return);
	});
	//GET
	aJax.get("[url]", function(return){
		alert(return);
	});
	</textarea>

	<label class="title">Modal Helper</label><br>
	<strong>Javascript : </strong>
	<textarea id="code4">
	//Alert
	modal.alert("[message]","[size]",function(){ //value for size are small or large
		location.reload();
	})

	//Confirm
	modal.confirm("[message]",function(result){
		if(result){ // if click yes
			//your code here
		}
	})

	//open Custom Bootstrap Modal
	modal.custom("[modal id]","[action]"); //action value are show or hide

	//Image view modal
	modal.image_view("[image url]"); //complete url of image is required

	//Video preview modal
	modal.video_view("[video url]"); //complete url of video is required, allowed file is mp4 only

	//Loading Modal
	modal.loading(action); //action value are TRUE for show and FALSE for hide

	</textarea>


	<label class="title">Global Controller / Model</label><br>
	<strong>Get List : </strong>
	<textarea id="code5">
		var url = "<?= base_url('content_management/global_controller');?>"; //URL OF CONTROLLER
    var data = {
    		event : "list", // list, insert, update, delete
        select : "[field select]", //select
        query : "[sql query]", //query
        offset : "[offset]", // offset or start
        limit : "[limit]", // limit
        table : "[table]", // table
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

	<strong>Save Data : </strong>
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

	<strong>Update Data : </strong>
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

	<strong>Delete Data : </strong>
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

</div>

<script>

	text_code("code");
	text_code("code2");
	text_code("code3");
	text_code("code4");
	text_code("code5");
	text_code("code6");
	text_code("code7");
	text_code("code8");

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