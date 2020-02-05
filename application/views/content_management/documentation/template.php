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
  .content.documentation {margin-top: 6em;}
</style>
<div class="content documentation">
	<label class="title">Adding CMS Template Controller</label><br>
	<strong>Controller PHP : </strong>
	<textarea id="code">
	public function index()
	{ // all required
		$data['title'] = "Content Management"; //this is for html header title
		$data['PageName'] = "Developers Documentation"; //Page Title/Name
		$data['content'] = "content_management/documentation/page"; //Path file for View
		$this->load->view('content_management/template/layout', $data); //Template
	}
	</textarea>

	<strong>View HTML/PHP : </strong>
	<textarea id="code2">
	<div class="box">
		&lt;&#63;php	
			$data['buttons'] = ['add', 'save', 'update', 'search']; // add, save, update, search box
			$this->load->view("content_management/template/buttons", $data);
		&#63;&gt;	
 		<div class="box-body">   

 		<!-- your HTML CONTENT here -->

 		</div>
 </div>
	</textarea>


	<label class="title">Adding button to content</label><br>
	<strong>PHP : </strong>
	<textarea id="code3">

$data['buttons'] = ['add', 'save', 'update', 'search'];
$this->load->view("content_management/template/buttons", $data);
	</textarea>

</div>

<script>

	text_code("code");
	text_code("code2");
	text_code("code3");

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