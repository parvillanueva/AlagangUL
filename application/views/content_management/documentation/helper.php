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

	<label class="title">Adding CMS Audit Trail</label><br>
	<strong> Javascript: </strong>
	<textarea id="code2">
	add_audit_trail("[Action]"); //this is for custom action only

	// Standard Action for insert, update, and delete is in global_controller 
	// you must use the Global in every transaction of your function
	</textarea>

	<label class="title">JSON Validation</label><br>
	<strong> check if valid JSON Javascript: </strong>
	<textarea id="code0">
	is_json([JSON]); // it also convert if the json is string
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
	modal.alert("[message]",function(){ //show alert message
		location.reload();
	})

	//Show
	modal.show("[message]","[size]",function(){ //value for size are small or large
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


	<label class="title">Date Format</label><br>
	<strong>Javascript (MomentJS) : </strong>
	<textarea id="code5">
	moment("[date]").format('MMMM Do YYYY, h:mm:ss a'); // February 1st 2018, 1:23:42 pm
	moment("[date]").format('dddd');                    // Thursday
	moment("[date]").format("MMM Do YY");               // Feb 1st 18

	moment("[date]").format('LT');   // 1:24 PM
	moment("[date]").format('LTS');  // 1:24:04 PM
	moment("[date]").format('L');    // 02/01/2018
	moment("[date]").format('l');    // 2/1/2018
	moment("[date]").format('LL');   // February 1, 2018
	moment("[date]").format('ll');   // Feb 1, 2018
	moment("[date]").format('LLL');  // February 1, 2018 1:24 PM
	moment("[date]").format('lll');  // Feb 1, 2018 1:24 PM
	moment("[date]").format('LLLL'); // Thursday, February 1, 2018 1:24 PM
	moment("[date]").format('llll'); // Thu, Feb 1, 2018 1:24 PM                       
	</textarea>

	<label class="title">Pagination</label><br>
	<strong>Javascript : </strong>
	<textarea id="code6">
		//required is total number of page and the element you want to append the pagination
		pagination.generate([total_page], '.list_pagination');         

		//check if pagination is triggered
		pagination.onchange(function(){
	        //your ajax code here
	        //pagination will return the page number
	        var pagenumber = $(this).val();
	        console.log(pagenumber)
	    })            
	</textarea>

	<label class="title">FileManager Modal</label><br>
    <strong>Javascript : </strong>
    <textarea id="code7">
        //to simply open filemanager modal
        modal.file_manager(data_id); //open filemanager modal       

        //add identifier 
        //for this example we use :
        //int 1 = image thumbnail
        //int 2 = immage banner
        modal.file_manager(1); //open filemanager modal

        //getting data
        $(document).on("click", ".btn_insert", function(e){
            var data_identifier = $(this).attr("identifier");
            if(data_identifier == 1){
                //your code passing image_path to image thumbnail input / src
                var image_thumbnail = $('#file_url').val();
            }

            if(data_identifier == 2){
                //your code passing image_path to image banner input / src
                var image_banner = $('#file_url').val();
            }
        });

    </textarea>

    <label class="title">Strip Tags</label><br>
    <strong>Javascript : to prevent code injection </strong>
    <textarea id="code8">
    //do not use in ckeditor data value

        strip_tags(string); //will remove all html tags

            
    </textarea>

    <label class="title">Validate Required</label><br>
    <strong>Javascript : to  field </strong>
    <textarea id="code9">
    //check if valid email
    validate.email("[email_address]"); // return true or false

    //example 
    if(validate.email("php.developer@gmail.com"){
        //code for valid email
    }

    //check each required fields
    //this is not applicable for CKeditor
    validate.required("[group_class]"); //return true or false

    // example
    if(validate.required(".required_fields")){
        //code for success
    }
            
    </textarea>

</div>

<script>

	text_code("code0");
	text_code("code2");
	text_code("code3");
	text_code("code4");
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