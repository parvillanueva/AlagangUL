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
<script src="<?= base_url();?>vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="<?= base_url();?>vendor/codemirror/keymap/sublime.js"></script>

<style type="text/css">
  .CodeMirror {border-top: 1px solid #eee; border-bottom: 1px solid #eee; line-height: 1.3; height: auto;}
  .CodeMirror-linenumbers { padding: 0 8px; }
  strong { font-size: 14px;  }
  .title { font-size: 18px;  margin-top: 15px; }
  .content.documentation {margin-top: 5em;}
</style>
<div class="content documentation">

<label class="title">Sending Email</label>
<br>Set Email Protocol and Configuration @ <strong> Preferences > Content Management </strong>
<textarea id="email_code">
//send single email
$email['to_email'] = "sender@gmail.com";
$email['subject'] = "EMAIL SUBJECT";
$email['body'] = "<h1>HTML BODY</h1>";
$this->send->email($email);

//sending multiple email to multiple address
$email['to_email'] = array("receiver1@gmail.com","receiver2@gmail","receiver3@gmail.com");
$email['subject'] = "EMAIL SUBJECT";
$email['body'] = "<h1>HTML BODY</h1>";
$this->send->email($email);
</textarea>

<label class="title">Site Social Media Accounts</label>
<br>Assign Social Media Account Link in <strong> Preferences > Site Information </strong>
<textarea id="code111">
//echo one of this function to return the links provided in Site Information
//note : will return null if no assignment of URL from Site Information
$this->social->facebook();
$this->social->twitter();
$this->social->instagram();
$this->social->pinterest();
$this->social->linkedin();
$this->social->tumblr();
$this->social->youtube();
</textarea>

<label class="title">Site Social Media Share Buttons</label>
<br>To add Social Media share buttons on Articles or Page
<textarea id="code1111">
$this->social->share(); //add value on ->share("[url]") if has custom URL to share
</textarea>


<label class="title">Get List</label>
<br><strong>Get List Loader : html/php</strong>
<textarea id="code11">
$this->load->active_list($table, $query = "", $order_field = null, $order_type = null);
//will return array;
</textarea>

<label class="title">Get Details</label>
<br><strong>Get Details Loader : html/php</strong>
<textarea id="code22">
$this->load->details($table,$id);
//will return array;
</textarea>

<label class="title">Shop URL</label>
<br><strong>Get Shop URL : html/php</strong>
<textarea id="code12">
echo $this->load->shop_url(); 
//Return link to url provided </i>;
</textarea>

<label class="title">Standards Configuration</label>
<p>Config File : application/config/standard.php</p>

<label class="title">Set Alert configuration</label>
<br><strong>To set new alert in config.php</strong>
<textarea id="code-d">
$config['[standard_name]'] = "[Message]";
</textarea>

<strong>To Display Alert using php and javascript</strong>
<textarea id="code-a">
<script type="text/javascript">
    //use this function to get details : $this->standard->dialog([config_name]);
    var message = '&lt;&#63;php $this->standard->dialog("add_success"); &#63;&gt;'; 
    modal.alert(message); //to show the modal with your message
</script>
</textarea>

<br>
<label class="title">Standard Modal Configuration</label>
<br><strong>To Assign new modal dialog standard in config.php</strong>
<textarea id="code-b">
$config['[standard_name]'] = array(
                            "message"  => "[text]", // Dialog message
                            "confirm"  => "[text]", // Label for Confirm Button
                            "cancel"   => "[text]", // Lbael for Cancel Button
                        );
</textarea>

<strong>To Display confirm dialog using php and javascript</strong>
<textarea id="code-c">
<script type="text/javascript">
    //use this function to get details : $this->standard->confirm([config_name]);
    var modal_obj = '&lt;&#63;php $this->standard->confirm("confirm_update"); &#63;&gt;'; 
    modal.standard(modal_obj, function(result){ //to display the confirm modal dialog
        if(result){
            //your code here
        }
    });
</script>
</textarea>


<br>
<label class="title">Standard Inputs Configuration</label>
<br><strong>To Assign new modal dialog standard in config.php</strong>
<textarea id="code-ddd">
$config['[standard_name]'] = array(
        'type'         => (string),        // (required) text, email, dropdown, radio, textarea, filemanager, ckeditor, timepicker, date, mobile_number, youtube,captcha
        'name'         => (string),        // (required) element name
        'form-align'   => (string),        // (required) vertical, horizontal : default is vertical
        'id'           => (string),        // (required) element id
        'max'          => (int),           // max length
        'required'     => (boolean),       // if input is required
        'alphaonly'    => (boolean),       // if input requires alpha only A-Z
        'class'        => (string),        // adding custom class
        'placeholder'  => (string),        // (required) input placeholder
        'label'        => (string),        // (required) input label text
        'accept'       => (string),        // accepted characters *for TYPE:TEXT only ex : /[^a-zA-Z .,-]/g
        'rows'         => (int),           // no of rows for TYPE: TEXTAREA only
        'note'         => (string),        // input note
        'minDate'      => (date),          // minimum date for TYPE: DATE format(mm-dd-yyyy)
        'maxDate'      => (date),          // minimum date for TYPE: DATE format(mm-dd-yyyy)
        'yearRange'    => (date : date),   // minimum date range for TYPE: DATE : ex. '2013 : 2018'
        'list_value'   => (array()),       // array list of values for TYPE: DROPDOWN & RADIO only
        'youtube'      => (boolean),       // include youtube for CKEditor Only *True Default
        'filemanager'  => (boolean),       // include filemanger for CKEditor Only *True Default
        'source'       => (boolean),       // include source for CKEditor Only *True Default
        'list_style'   => (boolean),       // include list style for CKEditor Only *True Default
        'no_html'      => (boolean),       // if HTML TAg not allowed for text and textarea type only
        'accept'       => (string),        // a comma separated file type for filemanager only. ex. jpg,gif,png,jpeg
        'max_size'     => (int)            // maximum file size to accept in MB for filemanager only
        'preview'      => (boolean)        // display video preview for youtube only, default is true
);
</textarea>

<strong>To Display inputs, values and validation</strong>
<textarea id="code-dddd">
//to display
&lt;&#63;php 
    $inputs = ['first_name','middle_name',]; //array of input config
    $id = $this->standard->inputs($inputs);
&#63;&gt;

//adding value to inputs
&lt;&#63;php 
    $inputs = ['first_name','last_name',]; //array of input config
    $values = ['King','Villanueva',]; //array of values
    $id = $this->standard->inputs($inputs, $values);
&#63;&gt;

//to validate all inputs from standard library

<script type="text/javascript">

    $(document).on('click', '#btn_save', function(){ 
        if(validate.standard("&lt;&#63;= $id; &#63;&gt;")){
            //your code here
        }
    }
</script>
</textarea>
<br>

<label class="title">New Date & Time Picker</label>
<textarea id="date_picker">

<input type="text" name="birthdate" id="birthdate">
</textarea>
    <label class="title">Generate Table Listing</label>
    <br><strong>Get Table Library : html/php</strong>
    <textarea id="code23">
&lt;&#63;php 
    /**
        @title       Form Table Library
        @method      display_data

        @var   array    $data['table']            Associative array of table name and prefix
        @example                                  value: ['table_name' => 'prefix_name']

        @var   array    $data['sortable']         Array of sorting through row or column
        @example                                  value: ['row', 'column']

        @var   int      $data['checkbox']         Display status of checkbox listing
        @example                                  value: (1 = show, 0 = hide)

        @var   array    $data['order']            Associative array of ascending or descending order with field value
        @example                                  value: ['asc' => 'id']
        
        @var   array    $data['join']             Associative array of table join settings
        @example                                  value: [0 => [table, query, type] ] (0 = hide, 1 = show)

        @var   array    $data['display_fields']   Associative array of database field names with <th> settings
        @example                                  value: ['databse field' => [
                                                                                'alternative_name', 
                                                                                'column size px', 
                                                                                 max character length (int)
                                                                            ] 
                                                        ]
                                                  Note: If the database field content is greater than the max character length, then the ellipsis will be showed. 

        @var   array    $data['search_keyword']   Array of keywords used for searching
        @example                                  value: ['search1', 'search2']

        @var   string   $data['query']            Initialize custom query on page load
        @example                                  value: "status >= 0"

        @var   array    $data['custom_action']    Associative array of custom action button settings
        @example                                  value: [1 => [
                                                                    'type' => 'icon',
                                                                    'id' => 'sample-id', 
                                                                    'class' => 'sample-class', 
                                                                    'icon' => 'fa fa-cog', 
                                                                    'value' => '', 
                                                                    'function' => 'view_sample'
                                                                ]
                                                        ] (0 = hide, 1 = show) (type = icon/button)

        @var   array    $data['button']           Array of cms standard buttons
        @example                                  value: ['add', 'close', 'search', 'export']

        @var array      $data['export_name']      Array of alternative name for pdf and excel export
        @example                                  value: ['ID', 'First Name', "Last Name", "Status"]
                                                  Note: Export name must follow the database field order arrangement


        @var   array    $data['date_field_format']    Associative array of custom start date and end date
        @example                                      value: [
                                                            'start_date' => 'LL',
                                                            'end_date' => 'LL'
                                                        ] 

        @return  string                           Display the html table listing

    */

            $data['table'] = ['cms_sample' => 'cms_'];
            $data['order'] = ['desc' => 'update_date'];
            $data['join'] = [];

            $data['checkbox'] = 1; // 1 or 0
            $data['display_fields'] = [
                                       'image' => ['Display', '200']
                                       'title' => [''],
                                       'description'  => ['', '200', 150], 
                                       'status'     => [''],
                                       'update_date' => [''],
                                      ];
                            
            $data['search_keyword'] = ['title', 'description'];
            $data['query'] = "status >= 0";
            $data['sortable'] = ["column"]; // column or row
            $data['custom_action'] = [1 => [
                                            'type' => 'icon', // icon or button
                                            'id' => 'view_history', // #view_history 
                                            'class' => 'view-history btn btn-default', // .view-history .btn .btn-default
                                            'icon' => 'fa fa-eye', //<i class="fa fa-eye"></i>
                                            'value' => 'View', 
                                            'function' => 'view_history' //view_history()
                                            ]];

            $data['date_field_format'] = [
                                            'start_date' => 'LL',
                                            'end_date' => 'LL'
                                         ];

            $data['export_name'] = ['ID', 'Image', 'Title', 'Description', 'Status', 'Orders', 'Date Created', 'Date Updated'];
            $data['button'] = ['add', 'search', 'export', 'date_range'];
    
    // returns the generated table listing
    $this->form_table->display_data($data); 
&#63;&gt;

<script>
    // activate $data['custom_action'] using your defined function or
    function view_history() { 
        alert('Welcome to CMS.');
    }

    // by declaring class or id 
    $(document).on('click', '#view_history', function() {
        var id = $(this).attr('data-id');
        window.location.href = "<?base_url()?>content_management/site_sample/view/"+id;
    });
</script>
    </textarea>

<script type="text/javascript">
    //Initialize the date & time picker
    $('#birthdate').materialDatePicker();

    //Date picker only
    $('#birthdate').materialDatePicker({
        time : false,
        format: 'YYYY-MM-DD',
        clearButton: true
    });

    //Time picker only
    $('#birthdate').materialDatePicker({
        date : false,
        shorTime : false
    });

    //Lists of available config
    $('#birthdate').materialDatePicker({
        date: true,             //display date
        time: true,             //display time
        format: 'YYYY-MM-DD',   //set date & time format
        minDate: null,          //set minimum date
        maxDate: null,          //set maximum time
        currentDate: null,      //set current date
        weekStart: 0,           //set the start of week
        disabledDays: [],       //disables mon,tues,weds,thurs,fri,sat,sun eg. [2,4] tues & thurs is disabled
        shortTime: true,        //if true 12 hour format, if false 24 hour format
        clearButton: false,     //sets if clear button is shown or not
        nowButton: false,       //sets the if now button(current date) is shown or not
        cancelText: 'Cancel',   //sets the text of cancel button
        okText: 'OK',           //sets the text of ok button
        clearText: 'Clear',     //sets the text of clear button
        nowText: 'Now',         //sets the text of now button
        switchOnClick: false,   //Switches to timepicker(if enabled) on click of date
        triggerEvent: 'focus',  //Trigger event
        year:true               //shows year picker on click of year
    });
</script>
</textarea>


</div>

<script>

    text_code("email_code");
    text_code("code111");
    text_code("code1111");
    text_code("code11");
    text_code("code12");
    text_code("code22");
    text_code("code23");
    text_code("code-a");
    text_code("code-b");
    text_code("code-c");
    text_code("code-d");
    text_code("code-ddd");
    text_code("code-dddd");
	text_code("date_picker");


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