<?php
/*
|--------------------------------------------------------------------------
| DIALOG Standards
|--------------------------------------------------------------------------
|
| Sample Calling function :
|   <script>
|        var message = '<?= $this->standard->dialog("add_success"); ?>';
|        modal.alert(message);
|    </script>
|
| you can add your own custom
|
*/

// ALERT
$config['add_success']          = "<b>Success!</b> Record has been added.";
$config['save_success']         = "<b>Success!</b> Record has been saved.";
$config['update_success']       = "<b>Success!</b> Record has been updated.";
$config['delete_success']       = "<b>Success!</b> Record(s) have been deleted.";
$config['activate_success']     = "<b>Success!</b> Record(s) have been activated.";
$config['deactivate_success']   = "<b>Success!</b> Record(s) have been deactivated.";
$config['save_draft_success']   = "<b>Success!</b> Record has been saved as draft.";
$config['sent_success']         = "<b>Success!</b> Record has been sent.";
$config['submitted_success']    = "<b>Success!</b> Record has been submitted.";
$config['cancelled_success']    = "<b>Success!</b> Record has been cancelled.";
$config['declined_success']     = "<b>Success!</b> Record has been declined.";
$config['package_success']      = "<b>Success!</b> Package has been installed.";

//VALIDATION
$config['data_exist']           = "The information already exists.";
$config['email_exist']          = "This email address is already registered.";
$config['mobile_exist']         = "This mobile number is already registered.";
$config['username_exist']       = "Username already exists.";
$config['hasUnder']             = "Meta has under links, Can't change to child type!";
$config['menu_hasUnder']        = "Menu has under links, Can't change to module type!";
$config['package_field_duplicate']  = "Required fields has duplicate values.";



//ERRORS
$config['invalid_user_password']        = "Invalid username and password. Please try again.";
$config['invalid_password']             = "Incorrect password. Please try again.";

//CUSTOM MESSAGE
$config['newsletter_subscribed']       = "Success!<br>You have subscribed to our newsletter.";
$config['newsletter_unsubscribed']     = "Thank you!<br>You have unsubscribed from our news and updates.";
$config['category_limit']              = "Maximum Category";
$config['package_empty']                = "Package builder is empty.";
//FORM VALIDATION
//Note : Declare your custom dialog in your header if you are using javascript
//Ex : var form_invalid_email = '<php $this->standard->dialog('form_invalid_email') >';
$config['form_empty']               = "This field is required."; // do not remove, required in custom.js
$config['form_invalid_email']       = "Please enter a valid email address."; // do not remove, required in custom.js
$config['form_script']              = "Javascript and PHP Script are not allowed."; // do not remove, required in custom.js
$config['form_invalid_mobile_no']   = "Invalid mobile number. Required format : 09XXXXXXXXX"; // do not remove, required in custom.js
$config['form_nohtml']              = "HTML Tags are not allowed"; // do not remove, required in custom.js
$config['form_invalid_extension']   = "File type is not supported."; // do not remove, required in custom.js
$config['form_max_size']            = "Maximum file size exceeded"; // do not remove, required in custom.js
$config['form_invalid_captcha']     = "Invalid Captcha"; // do not remove, required in custom.js`


/*
|--------------------------------------------------------------------------
| Modal Confirmation Standards
|--------------------------------------------------------------------------
|
| Sample calling function :
|    <script>
|        var modal_obj = '<?= $this->standard->confirm("confirm_update"); ?>';
|        modal.standard(modal_obj, function(result){
|            if(result){
|                  //your code here
|            }
|        });
|    </script>
|
| $this->standard->confirm("add_success");
|
| you can add your own custom
|
*/
$config['confirm_add'] = array(
                            "message"  => "Are you sure you want to add this record?",
                            "confirm"  => "Add",
                            "cancel"   => "Cancel",
                        );


$config['confirm_update'] = array(
                            "message"  => "Are you sure you want to update this record?",
                            "confirm"  => "Update",
                            "cancel"   => "Cancel",
                        );

$config['confirm_delete'] = array(
                            "message"  => "Are you sure you want to delete this record?",
                            "confirm"  => "Delete",
                            "cancel"   => "Cancel",
                        );



$config['confirm_save'] = array(
                            "message"  => "Are you sure you want to save this record?",
                            "confirm"  => "Save",
                            "cancel"   => "Cancel",
                        );

$config['confirm_draft'] = array(
                            "message"  => "Are you sure you want to save this record as draft?",
                            "confirm"  => "Save as Draft",
                            "cancel"   => "Cancel",
                        );

$config['confirm_upload'] = array(
                            "message"  => "Are you sure you want to upload this file?",
                            "confirm"  => "Upload",
                            "cancel"   => "Cancel",
                        );

$config['confirm_activate'] = array(
                            "message"  => "Are you sure you want to activate this record?",
                            "confirm"  => "Activate",
                            "cancel"   => "Cancel",
                        );

$config['confirm_deactivate'] = array(
                            "message"  => "Are you sure you want to deactivate this record?",
                            "confirm"  => "Deactivate",
                            "cancel"   => "Cancel",
                        );

$config['confirm_send'] = array(
                            "message"  => "Are you sure you want to send this record?",
                            "confirm"  => "Send",
                            "cancel"   => "Cancel",
                        );

$config['confirm_submit'] = array(
                            "message"  => "Are you sure you want to submit this record?",
                            "confirm"  => "Submit",
                            "cancel"   => "Cancel",
                        );

$config['confirm_cancel'] = array(
                            "message"  => "Are you sure you want to cancel this record?",
                            "confirm"  => "Yes",
                            "cancel"   => "No",
                        );

$config['confirm_publish'] = array(
                            "message"  => "Are you sure you want to publish this record?",
                            "confirm"  => "Publish",
                            "cancel"   => "Cancel",
                        );

$config['confirm_unpublish'] = array(
                            "message"  => "Are you sure you want to unpublish this record?",
                            "confirm"  => "Unpublish",
                            "cancel"   => "Cancel",
                        );

$config['package_install'] = array(
                            "message"  => "Are you sure you want to install this package?",
                            "confirm"  => "Install",
                            "cancel"   => "Cancel",
                        );

$config['confirm_export'] = array(
                            "message"  => "Are you sure  you want to extract this file?",
                            "confirm"  => "Export",
                            "cancel"   => "Cancel",
                        );

$config['confirm_edit'] = array(
                            "message"  => "Are you sure you want to edit this record?",
                            "confirm"  => "Yes",
                            "cancel"   => "Cancel",
                        );

$config['confirm_publish_meta'] = array(
                            "message"  => "Are you sure you want to publish this record? The records under this will also be published.",
                            "confirm"  => "Publish",
                            "cancel"   => "Cancel",
                        );

$config['confirm_unpublish_meta'] = array(
                            "message"  => "Are you sure you want to unpublish this record? The records under this will also be unpublished.",
                            "confirm"  => "Unpublish",
                            "cancel"   => "Cancel",
                        );

$config['confirm_delete_meta'] = array(
                            "message"  => "Are you sure you want to delete this record? The records under this will also be deleted.",
                            "confirm"  => "Delete",
                            "cancel"   => "Cancel",
                        );


$config['confirm_delete_file'] = array(
                            "message"  => "Are you sure you want to remove this file?",
                            "confirm"  => "Remove",
                            "cancel"   => "Cancel",
                        );

$config['confirm_save_program'] = array(
                            "message"  => "Are you sure you want to save this program?",
                            "confirm"  => "Save",
                            "cancel"   => "Cancel",
                        );




/*
|--------------------------------------------------------------------------
| Input Standards
|--------------------------------------------------------------------------
|
|   $config = array(
|        'type'         => (string),        // text, email, dropdown, radio, textarea, filemanager, ckeditor, timepicker, date, mobile_number, youtube, captcha
|        'name'         => (string),        // element name
|        'form-align'   => (string),        // vertical, horizontal : default is vertical
|        'id'           => (string),        // element id
|        'max'          => (int),           // max length
|        'required'     => (boolean),       // if input is required
|        'alphaonly'    => (boolean),       // if input requires alpha only A-Z
|        'class'        => (string),        // adding custom class
|        'placeholder'  => (string),        // input placeholder
|        'label'        => (string),        // input label text
|        'accept'       => (string),        // accepted characters *for TYPE:TEXT only ex : /[^a-zA-Z .,-]/g
|        'rows'         => (int),           // no of rows for TYPE: TEXTAREA only
|        'note'         => (string),        // input note
|        'minDate'      => (date),          // minimum date for TYPE: DATE format(mm-dd-yyyy)
|        'maxDate'      => (date),          // minimum date for TYPE: DATE format(mm-dd-yyyy)
|        'yearRange'    => (date : date),   // minimum date range for TYPE: DATE : ex. '2013 : 2018'
|        'list_value'   => (array()),       // array list of values for TYPE: DROPDOWN & RADIO only
|        'youtube'      => (boolean),       // include youtube for CKEditor Only *True Default
|        'filemanager'  => (boolean),       // include filemanger for CKEditor Only *True Default
|        'source'       => (boolean),       // include source for CKEditor Only *True Default
|        'list_style'   => (boolean),       // include list style for CKEditor Only *True Default
|        'no_html'      => (boolean),       // if HTML TAg not allowed for text and textarea type only
|        'accept'       => (string),        // a comma separated file type for filemanager only. ex. jpg,gif,png,jpeg
|        'max_size'     => (int)            // maximum file size to accept in MB for filemanager only
|        'preview'      => (boolean)        // display video preview for youtube only, default is true
|        'captcha'      => (string)         // captcha option if : codeigniter or google
|        'site_key'     => (string)         // for google recaptcha : site key (required)
|   );
|
| you can add your custom input
|
|
| Note : To validate all inputs generated by this function
|
|   Sample Code :
|
|   <?php
|       //to display
|       $inputs = ['first_name','middle_name',];
|       $this->standard->inputs($inputs);
|   ?>
|
|   <script>
|       $('.btn_save').on('click', function(){
|           if(validate.standard()){
|               //your code here
|           }
|       });
|   </script>
*/

$config['[separator]']      = array(
                                'type'          => 'separator',
                                'id'            => 'separator'
                            );

$config['captcha']       = array(
                                'type'          => 'captcha',
                                'name'          => 'captcha',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'captcha',
                                'required'      => true,
                                'maxlength'     => 8,
                                'placeholder'   => 'Enter above text',
                                'label'         => 'Captcha',
                                
                            );


$config['meta_title']       = array(
                                'type'          => 'text',
                                'name'          => 'meta_title',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'meta_title',
                                'required'      => true,
                                'maxlength'     => 255,
                                'alphaonly'     => true,
                                'accept'        => '/[^a-zA-Z .,-]/g',
                                'placeholder'   => 'Meta Title',
                                'label'         => 'Meta Title'
                            );

$config['meta_description'] = array(
                                'type'          => 'textarea',
                                'name'          => 'meta_description',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control meta_description_input',
                                'id'            => 'meta_description',
                                'required'      => true,
                                'maxlength'     => 255,
                                'placeholder'   => 'Meta Description',
                                'label'         => 'Meta Description'
                            );

$config['meta_keyword'] = array(
                                'type'          => 'textarea',
                                'name'          => 'meta_keyword',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control meta_keyword_input',
                                'id'            => 'meta_keyword',
                                'required'      => true,
                                'maxlength'     => 255,
                                'placeholder'   => 'Meta Keyword',
                                'label'         => 'Meta Keyword'
                            );

$config['meta_image'] = array(
                                'type'          => 'filemanager',
                                'name'          => 'meta_img',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'meta_img',
                                'accept'        => 'jpg,png,jpeg',
                                'max_size'      => '5',
                                'required'      => true,
                                'placeholder'   => 'Meta Image',
                                'label'         => 'Meta Image',
                            );

$config['asc_ref']       = array(
                                'type'          => 'textarea',
                                'name'          => 'asc_ref',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'asc_ref',
                                'required'      => false,
                                'alphaonly'     => true,
                                'placeholder'   => 'ASC Ref Code',
                                'label'         => 'ASC Ref Code'
                            );


$config['first_name']       = array(
                                'type'          => 'text',
                                'name'          => 'first_name',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'first_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'alphaonly'     => true,
                                'accept'        => '/[^a-zA-Z .,-]/g',
                                'placeholder'   => 'First Name',
                                'label'         => 'First Name',
                                'align'         => 'vertical',
                                
                            );

$config['middle_name']      = array(
                                'type'          => 'text',
                                'name'          => 'middle_name',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'middle_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'alphaonly'     => true,
                                'placeholder'   => 'Middle Name',
                                'label'         => 'Middle Name',
                                
                            );

$config['last_name']        = array(
                                'type'          => 'text',
                                'name'          => 'last_name',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'last_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'alphaonly'     => true,
                                'placeholder'   => 'Last Name',
                                'label'         => 'Last Name',
                                
                            );

$config['suffix_name']      = array(
                                'type'          => 'text',
                                'name'          => 'suffix_name',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'suffix_name',
                                'maxlength'     => 10,
                                'required'      => false,
                                'alphaonly'     => true,
                                'placeholder'   => 'Suffix',
                                'label'         => 'Suffix',
                                
                            );

$config['civil_status']     = array(
                                'type'          => 'dropdown',
                                'name'          => 'civil_status',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'civil_status',
                                'required'      => true,
                                'placeholder'   => 'Civil Status',
                                'label'         => 'Civil Status',
                                'list_value'    => array(
                                                    'Single'    => 'Single',
                                                    'Married'   => 'Married',
                                                    'Separated' => 'Separated',
                                                    'Divorced'  => 'Divorced',
                                                    'Widowed'   => 'Widowed',
                                                ),
                                
                            );

$config['gender']           = array(
                                'type'          => 'dropdown',
                                'name'          => 'gender',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'gender',
                                'required'      => true,
                                'placeholder'   => 'Gender',
                                'label'         => 'Gender',
                                'list_value'    => array(
                                                    'Male'     => 'Male',
                                                    'Female'     => 'Female'
                                                ),
                                
                            );

$config['status']           = array(
                                'type'          => 'dropdown',
                                'name'          => 'status',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control status_input',
                                'id'            => 'status',
                                'required'      => true,
                                'placeholder'   => 'Status',
                                'label'         => 'Status',
                                'list_value'    => array(
                                                    '0'     => 'Inactive',
                                                    '1'     => 'Active'
                                                )
                            );

$config['birthday']        = array(
                                'type'          => 'date',
                                'name'          => 'birthday',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'birthday',
                                'required'      => true,
                                'placeholder'   => 'Birth Date',
                                'label'         => 'Birthday',
                                'yearRange'     => '-100:+0',
                                'maxDate'       => '0',
                                
                            );

$config['email_address']    = array(
                                'type'          => 'email',
                                'name'          => 'email_address',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'email_address',
                                'required'      => true,
                                'maxlength'     => 250,
                                'placeholder'   => 'Email Address',
                                'label'         => 'Email Address'
                            );

$config['password']         = array(
                                'type'          => 'password',
                                'name'          => 'password',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'password',
                                'required'      => true,
                                'placeholder'   => 'Password',
                                'label'         => 'Password'
                            );

$config['home_address']          = array(
                                'type'          => 'ckeditor',
                                'name'          => 'home_address',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'home_address',
                                'required'      => true,
                                'youtube'       => false,
                                'filemanager'   => false,
                                'maxlength'     => 500,
                                'placeholder'   => 'House No. and Street Address',
                                'label'         => 'House No. and Street Address',
                                
                            );

$config['timepicker']       = array(
                                'type'          => 'timepicker',
                                'name'          => 'timepicker',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'timepicker',
                                'required'      => true,
                                'placeholder'   => 'Time Picker',
                                'label'         => 'Time Picker',
                                
                            );

$config['image']           = array(
                                'type'          => 'filemanager',
                                'name'          => 'image',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'image',
                                'accept'        => 'jpg,gif,png,jpeg,mp4',
                                'max_size'      => '50',
                                'required'      => true,
                                'placeholder'   => 'Image',
                                'label'         => 'Image',
                                
                            );

$config['image_banner']           = array(
                                'type'          => 'filemanager',
                                'name'          => 'image_banner',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'image_banner',
                                'accept'        => 'jpg,gif,png,jpeg',
                                'required'      => true,
                                'placeholder'   => 'Image Banner',
                                'label'         => 'Image Banner',
                            );

$config['image_thumbnail']          = array(
                                'type'          => 'filemanager',
                                'name'          => 'banner_thumbnail',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'banner_thumbnail',
                                'accept'        => 'jpg,gif,png,jpeg',
                                'max_size'      => '5',
                                'required'      => true,
                                'placeholder'   => 'Image Thumbnail',
                                'label'         => 'Image Thumbnail',
                                
                            );

$config['date_start']        = array(
                                'type'          => 'date',
                                'name'          => 'date_start',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'date_start',
                                'required'      => true,
                                'minDate'       => '0',
                                'placeholder'   => 'Start Date',
                                'label'         => 'Start Date',
                                
                            );


$config['date_end']        = array(
                                'type'          => 'date',
                                'name'          => 'date_end',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'date_end',
                                'required'      => true,
                                'minDate'       => '0',
                                'placeholder'   => 'End Date',
                                'label'         => 'End Date',
                                
                            );

$config['article_body']          = array(
                                'type'          => 'ckeditor',
                                'name'          => 'article_body',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'article_body',
                                'required'      => true,
                                'placeholder'   => 'Article Body',
                                'label'         => 'Article Body',
                                
                            );

$config['mobile_number']       = array(
                                'type'          => 'mobile_number',
                                'name'          => 'mobile_number',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'mobile_number',
                                'required'      => true,
                                'placeholder'   => 'Mobile Number',
                                'label'         => 'Mobile Number',
                                'maxlength'     => 11,
                                'note'          => 'Required Format : 09XXXXXXXXX',
                            );

$config['zip_code']       = array(
                                'type'          => 'text',
                                'name'          => 'zip_code',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'zip_code',
                                'maxlength'     => 5,
                                'accept'        => '/[^0-9]/g',
                                'placeholder'   => 'Zip Code',
                                'label'         => 'Zip Code',
                                
                            );


$config['youtube']       = array(
                                'type'          => 'youtube',
                                'name'          => 'youtube',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'youtube',
                                'required'      => true,
                                'placeholder'   => 'Youtube Video',
                                'label'         => 'Youtube Video',
                                
                            );


//STANDARD FOR HOME
$config['title']       = array(
                                'type'          => 'text',
                                'name'          => 'title',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'title',
                                'maxlength'     => 255,
                                'required'      => true,
                                'placeholder'   => 'Title',
                                'label'         => 'Title',
                            );


$config['description']      = array(
                                'type'          => 'ckeditor',
                                'name'          => 'description',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'description',
                                'required'      => true,
                                'no_html'      => false,
                                'filemanager'   => false,
                                'youtube'       => false,
                                'placeholder'   => 'Description',
                                'label'         => 'Description',
                            );

$config['product_title']    = array(
                                'type'          => 'text',
                                'name'          => 'product_title',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'product_title',
                                'maxlength'     => 255,
                                'required'      => true,
                                'placeholder'   => 'Product Title',
                                'label'         => 'Product Title',
                                
                            );


$config['product_description'] = array(
                                'type'          => 'ckeditor',
                                'name'          => 'product_description',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'product_description',
                                'required'      => true,
                                'filemanager'   => false,
                                'youtube'       => false,
                                'placeholder'   => 'Product Description',
                                'label'         => 'Product Description',
                                
                            );

$config['product_image']       = array(
                                'type'          => 'filemanager',
                                'name'          => 'product_image',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'product_image',
                                'accept'        => 'jpg,gif,png,jpeg',
                                'max_size'      => '5',
                                'required'      => true,
                                'placeholder'   => 'Product Image',
                                'label'         => 'Product Image',
                                
                            );


$config['privacy_title']       = array(
                                'type'          => 'text',
                                'name'          => 'privacy_title',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'privacy_title',
                                'maxlength'     => 255,
                                'required'      => true,
                                'placeholder'   => 'Privacy Policy Title',
                                'label'         => 'Privacy Policy Title',
                                
                            );


$config['privacy_statement']    = array(
                                'type'          => 'ckeditor',
                                'name'          => 'privacy_statement',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'privacy_statement',
                                'required'      => true,
                                'filemanager'   => false,
                                'youtube'       => false,
                                'placeholder'   => 'Privacy Policy Statement',
                                'label'         => 'Privacy Policy Statement',
                                
                            );

$config['terms_title']       = array(
                                'type'          => 'text',
                                'name'          => 'terms_title',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'terms_title',
                                'maxlength'     => 255,
                                'required'      => true,
                                'placeholder'   => 'Terms of Use - Title',
                                'label'         => 'Terms of Use - Title',
                                
                            );


$config['terms_statement']    = array(
                                'type'          => 'ckeditor',
                                'name'          => 'terms_statement',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'terms_statement',
                                'required'      => true,
                                'filemanager'   => false,
                                'youtube'       => false,
                                'placeholder'   => 'Terms of Use Statement',
                                'label'         => 'Terms of Use Statement',
                                
                            );

$config['brief_description'] = array(
                                'type'          => 'textarea',
                                'name'          => 'brief_description',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control brief_description_input',
                                'id'            => 'brief_description',
                                'required'      => true,
                                'no_html'      => true,
                                'maxlength'     => 500,
                                'placeholder'   => 'Brief Description',
                                'label'         => 'Brief Description',
                                
                            );

$config['question']       = array(
                                'type'          => 'text',
                                'name'          => 'question',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control question_input',
                                'id'            => 'question',
                                'required'      => true,
                                'placeholder'   => 'Question',
                                'label'         => 'Question'
                            );

$config['answer']       = array(
                                'type'          => 'ckeditor',
                                'name'          => 'answer',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control answer_input',
                                'id'            => 'answer',
                                'required'      => true,
                                'placeholder'   => 'Answer',
                                'label'         => 'Answer',
                                'youtube'       => false
                            );

$config['article_date_start']        = array(
                                'type'          => 'date',
                                'name'          => 'article_date_start',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'article_date_start',
                                'minDate'       => '0',
                                'placeholder'   => 'Start Date',
                                'label'         => 'Start Date',
                                'note'          => 'Leave blank if no Expiration/Duration'
                            );


$config['article_date_end']        = array(
                                'type'          => 'date',
                                'name'          => 'article_date_end',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'article_date_end',
                                'minDate'       => '0',
                                'placeholder'   => 'End Date',
                                'label'         => 'End Date',
                                'note'          => 'Leave blank if no Expiration/Duration'
                            );

$config['contact_inquiry'] = array(
                                'type'          => 'textarea',
                                'name'          => 'inquiry',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'inquiry',
                                'required'      => true,
                                'placeholder'   => 'Inquiry',
                                'label'         => 'Inquiry',
                                
                            );

$config['contact_mobile_number']       = array(
                                'type'          => 'mobile_number',
                                'name'          => 'mobile_number',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'mobile_number',
                                'required'      => true,
                                'placeholder'   => 'Mobile Number',
                                'label'         => 'Mobile Number',
                                'maxlength'     => 11,
                                'note'          => 'Required Format : 09XXXXXXXXX',
                            );
$config['contact_email_address']    = array(
                                'type'          => 'email',
                                'name'          => 'email_address',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'email_address',
                                'required'      => true,
                                'maxlength'     => 250,
                                'placeholder'   => 'Email Address',
                                'label'         => 'Email Address',
                                
                            );

$config['contact_first_name']       = array(
                                'type'          => 'text',
                                'name'          => 'first_name',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'first_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'alphaonly'     => true,
                                'accept'        => '/[^a-zA-Z .,-]/g',
                                'placeholder'   => 'First Name',
                                'label'         => 'First Name',
                                'align'         => 'vertical',
                                
                            );

$config['contact_middle_name']      = array(
                                'type'          => 'text',
                                'name'          => 'middle_name',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'middle_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'alphaonly'     => true,
                                'placeholder'   => 'Middle Name',
                                'label'         => 'Middle Name',
                                
                            );

$config['contact_last_name']        = array(
                                'type'          => 'text',
                                'name'          => 'last_name',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'last_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'alphaonly'     => true,
                                'placeholder'   => 'Last Name',
                                'label'         => 'Last Name',
                                
                            );

$config['contact_captcha']       = array(
                                'type'          => 'captcha',
                                'captcha'       => 'google',
                                'site_key'      => '6Lf8i2cUAAAAACaKQohJ3nFyBCGHMmDVQBK4sjVK',
                                'name'          => 'captcha',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'captcha',
                                'required'      => true,
                                'maxlength'     => 8,
                                'placeholder'   => 'Enter above text',
                                'label'         => 'Captcha',
                                
                            );



$config['sign_up_first_name']       = array(
                                'type'          => 'text',
                                'name'          => 'first_name',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'first_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'alphaonly'     => true,
                                'accept'        => '/[^a-zA-Z .,-]/g',
                                'placeholder'   => 'First Name',
                                'label'         => 'First Name',
                                'align'         => 'vertical',
                                
                            );

$config['sign_up_middle_name']      = array(
                                'type'          => 'text',
                                'name'          => 'middle_name',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'middle_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'alphaonly'     => true,
                                'placeholder'   => 'Middle Name',
                                'label'         => 'Middle Name',
                                
                            );

$config['sign_up_last_name']        = array(
                                'type'          => 'text',
                                'name'          => 'last_name',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'last_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'alphaonly'     => true,
                                'placeholder'   => 'Last Name',
                                'label'         => 'Last Name',
                                
                            );

$config['sign_up_civil_status']     = array(
                                'type'          => 'dropdown',
                                'name'          => 'civil_status',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'civil_status',
                                'required'      => true,
                                'placeholder'   => 'Civil Status',
                                'label'         => 'Civil Status',
                                'list_value'    => array(
                                                    'Single'    => 'Single',
                                                    'Married'   => 'Married',
                                                    'Separated' => 'Separated',
                                                    'Divorced'  => 'Divorced',
                                                    'Widowed'   => 'Widowed',
                                                ),
                                
                            );

$config['sign_up_gender']           = array(
                                'type'          => 'dropdown',
                                'name'          => 'gender',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'gender',
                                'required'      => true,
                                'placeholder'   => 'Gender',
                                'label'         => 'Gender',
                                'list_value'    => array(
                                                    'Male'     => 'Male',
                                                    'Female'     => 'Female'
                                                ),
                                
                            );

$config['sign_up_birthday']        = array(
                                'type'          => 'date',
                                'name'          => 'birthday',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'birthday',
                                'required'      => true,
                                'placeholder'   => 'Birth Date',
                                'label'         => 'Birthday',
                                'yearRange'     => '-100:+0',
                                'maxDate'       => '0',
                                
                            );

$config['sign_up_mobile_number']       = array(
                                'type'          => 'mobile_number',
                                'name'          => 'mobile_number',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'mobile_number',
                                'required'      => true,
                                'placeholder'   => 'Mobile Number',
                                'label'         => 'Mobile Number',
                                'maxlength'     => 11,
                                'note'          => 'Required Format : 09XXXXXXXXX',
                            );

$config['sign_up_email_address']    = array(
                                'type'          => 'email',
                                'name'          => 'email_address',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'email_address',
                                'required'      => true,
                                'maxlength'     => 250,
                                'placeholder'   => 'Email Address',
                                'label'         => 'Email Address',
                                
                            );

$config['sign_up_country']     = array(
                                'type'          => 'dropdown',
                                'name'          => 'country',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'country',
                                'required'      => true,
                                'placeholder'   => 'Country',
                                'label'         => 'Country',
                                'list_value'    => array(
                                                    'PH'    => 'Philippines',
                                                ),
                                
                            );

$config['sign_up_region']     = array(
                                'type'          => 'dropdown',
                                'name'          => 'region',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'region',
                                'required'      => true,
                                'placeholder'   => 'Region',
                                'label'         => 'Region',
                                'list_value'    => array(),
                                
                            );

$config['sign_up_province']     = array(
                                'type'          => 'dropdown',
                                'name'          => 'province',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'province',
                                'required'      => true,
                                'placeholder'   => 'Province',
                                'label'         => 'Province',
                                'list_value'    => array(),
                                
                            );

$config['sign_up_city']     = array(
                                'type'          => 'dropdown',
                                'name'          => 'city',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'city',
                                'required'      => true,
                                'placeholder'   => 'City',
                                'label'         => 'City',
                                'list_value'    => array(),
                                
                            );

$config['sign_up_captcha']   = array(
                                'type'          => 'captcha',
                                'name'          => 'captcha',
                                'captcha'          => 'codeigniter',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'captcha',
                                'required'      => true,
                                'maxlength'     => 8,
                                'placeholder'   => 'Enter above text',
                                'label'         => 'Captcha',
                                
                            );

$config['video_type'] = array(
                                'type'          => 'radio',
                                'name'          => 'video_type',
                                'form-align'    => 'horizontal',
                                'class'         => 'video_type',
                                'id'            => 'video_type',
                                'required'      => true,
                                'placeholder'   => 'Video Type',
                                'label'         => 'Video Type',
                                'list_value'    => array(
                                                    '0'     => 'Upload Video',
                                                    '1'     => 'Youtube Video'
                                                ),
                                
                            );


$config['upload_video'] = array(
                                'type'          => 'filemanager',
                                'name'          => 'upload_video',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'upload_video',
                                'required'      => true,
                                'placeholder'   => 'Upload Video',
                                'label'         => 'Upload Video'
                            );


$config['upload_thumbnail'] = array(
                                'type'          => 'filemanager',
                                'name'          => 'upload_thumbnail',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'upload_thumbnail',
                                'required'      => true,
                                'placeholder'   => 'Upload Video Thumbnail',
                                'label'         => 'Upload Video Thumbnail',
                                
                            );

$config['banner_type'] = array(
                                'type'          => 'radio',
                                'name'          => 'banner_type',
                                'form-align'    => 'horizontal',
                                'class'         => 'banner_type',
                                'id'            => 'banner_type',
                                'required'      => true,
                                'placeholder'   => 'Image/Video/Youtube link',
                                'label'         => 'Image/Video/Youtube link',
                                'list_value'    => array(
                                                    '0'     => 'Image / Video Upload',
                                                    '1'     => 'Youtube Link',

                                                ),
                            );

$config['image_video_banner']           = array(
                                'type'          => 'filemanager',
                                'name'          => 'image_video',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'image_video',
                                'accept'        => 'jpg,gif,png,jpeg,mp4',
                                'required'      => true,
                                'placeholder'   => 'Image / Video Upload',
                                'label'         => 'Image / Video Upload'
                            );



/* Custom Config */


$config['banner']           = array(
                                'type'          => 'filemanager',
                                'name'          => 'banner',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control ',
                                'id'            => 'banner_img',
                                'accept'        => 'jpg,gif,png,jpeg,mp4',
                                'required'      => true,
                                'placeholder'   => 'Banner',
                                'label'         => 'Banner',

                            );


$config['thumbnail']          = array(
                                'type'          => 'filemanager',
                                'name'          => 'banner_thumbnail',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'banner_thumbnail',
                                'accept'        => 'jpg,gif,png,jpeg',
                                'max_size'      => '5',
                                'required'      => true,
                                'placeholder'   => 'Image Thumbnail',
                                'label'         => 'Image Thumbnail',
                            );

$config['url']              = array(
                                'type'          => 'text',
                                'name'          => 'url',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'url',
                                'required'      => true,
                                'placeholder'   => 'URL',
                                'label'         => 'URL'
                            );


$config['start']            = array(
                                'type'          => 'date',
                                'name'          => 'date_start',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control start_input',
                                'id'            => 'date_start',
                                'minDate'       => '0',
                                'placeholder'   => '',
                                'label'         => '',
                                
                            );

$config['end']              = array(
                                'type'          => 'date',
                                'name'          => 'date_end',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control end_input',
                                'id'            => 'date_end',
                                'minDate'       => '0',
                                'placeholder'   => '',
                                'label'         => '',
                                
                            );


$config['redirect_url']      = array(
                                'type'          => 'text',
                                'name'          => 'redirect_url',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control redirect_url_input',
                                'id'            => 'redirect_url',
                                'placeholder'   => 'Redirect URL',
                                'required'      => true,
                                'label'         => 'Redirect URL',
                                
                            );

$config['statement']        = array(

                                'type'          => 'ckeditor', 
                                'name'          => 'statement',
                                'form-align'    => 'horizontal', 
                                'class'         => 'form-control statement_input', 
                                'id'            => 'statement', 
                                'filemanager'   => false, 
                                'youtube'       => false, 
                                'placeholder'   => '', 
                                'label'         => 'Statement',
                            );

$config['name']             = array(
                                'type'          => 'text',
                                'name'          => 'name',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'accept'        => '/[^a-zA-Z0-9\u00f1\u00d1 .,-\/\']/g',
                                'placeholder'   => 'Name',
                                'label'         => 'Name'
                            );

$config['username']         = array(
                                'type'          => 'text',
                                'name'          => 'username',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'username',
                                'maxlength'     => 25,
                                'required'      => true,
                                'alphaonly'     => true,
                                'placeholder'   => 'Username',
                                'label'         => 'Username'
                            );

$config['role']             = array(
                                'type'          => 'dropdown',
                                'name'          => 'role',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control role',
                                'id'            => 'role',
                                'required'      => true,
                                'placeholder'   => 'Role',
                                'label'         => 'User Role',
                                'list_value'    => array()
                            );

$config['dd_user_sign_up']         = array(
                                    'type'          => 'dropdown',
                                    'name'          => 'dd_user_sign_up',
                                    'form-align'    => 'horizontal',
                                    'class'         => 'form-control dd_user_sign_up',
                                    'id'            => 'dd_user_sign_up',
                                    'required'      => true,
                                    'placeholder'   => 'User Signup',
                                    'label'         => 'User Signup',
                                    'list_value'    => array(
                                                        '0'     => 'Disable',
                                                        '1'     => 'Enable'
                                                    )
                                );

$config['dd_contact_us']           = array(
                                    'type'          => 'dropdown',
                                    'name'          => 'dd_contact_us',
                                    'form-align'    => 'horizontal',
                                    'class'         => 'form-control dd_contact_us',
                                    'id'            => 'dd_contact_us',
                                    'required'      => true,
                                    'placeholder'   => 'Contact Us',
                                    'label'         => 'Contact Us',
                                    'list_value'    => array(
                                                        '0'     => 'Disable',
                                                        '1'     => 'Enable'
                                                    )
                                );

$config['dd_notif_login']           = array(
                                    'type'          => 'dropdown',
                                    'name'          => 'dd_notif_login',
                                    'form-align'    => 'horizontal',
                                    'class'         => 'form-control dd_notif_login',
                                    'id'            => 'dd_notif_login',
                                    'required'      => true,
                                    'placeholder'   => 'Login',
                                    'label'         => 'Login',
                                    'list_value'    => array(
                                                        '0'     => 'Disable',
                                                        '1'     => 'Enable'
                                                    )
                                );

$config['dd_privacy_statement_option']         = array(
                                    'type'          => 'dropdown',
                                    'name'          => 'dd_privacy_statement_option',
                                    'form-align'    => 'horizontal',
                                    'class'         => 'form-control dd_privacy_statement_option',
                                    'id'            => 'dd_privacy_statement_option',
                                    'required'      => true,
                                    'placeholder'   => 'Privacy Statement Option',
                                    'label'         => 'Privacy Statement Option',
                                    'list_value'    => array(
                                                        '0'     => 'Redirect Url',
                                                        '1'     => 'Page'
                                                    )
                                );

$config['crs_host']       = array(
                                'type'          => 'text', 
                                'name'          => 'crs_host', 
                                'form-align'    => 'horizontal', 
                                'class'         => 'form-control', 
                                'id'            => 'crs_host', 
                                'required'      => true, 
                                'maxlength'     => 255, 
                                'alphaonly'     => false, 
                                'placeholder'   => 'Host', 
                                'label'         => 'Host'
                            );

$config['crs_token']       = array(
                                'type'          => 'text', 
                                'name'          => 'crs_token', 
                                'form-align'    => 'horizontal', 
                                'class'         => 'form-control', 
                                'id'            => 'crs_token', 
                                'required'      => true, 
                                'maxlength'     => 255, 
                                'alphaonly'     => false, 
                                'placeholder'   => 'Token', 
                                'label'         => 'Token'
                            );


$config['link_type']        = array(
                                'type'          => 'dropdown',
                                'name'          => 'link_type',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'link_type',
                                'required'      => true,
                                'placeholder'   => 'Link Type',
                                'label'         => 'Link Type',
                                'list_value'    => array(
                                                    'Parent'     => '1',
                                                    'Child'     => '2'
                                                )
                            );

$config['domain']             = array(
                                'type'          => 'text',
                                'name'          => 'domain',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'domain',
                                'maxlength'     => 250,
                                'required'      => true,
                                'accept'        => '/[^a-zA-Z0-9\u00f1\u00d1 .,-\/\']/g',
                                'placeholder'   => 'Domain',
                                'label'         => 'Domain'
                            );


















//custom_standard_config
$config['program_team']        = array(
                                'type'          => 'dropdown',
                                'name'          => 'program_team',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control',
                                'id'            => 'program_team',
                                'required'      => true,
                                'placeholder'   => 'Team',
                                'label'         => 'Team',
                                'list_value'    => array()
                            );

$config['program_name']       = array(
                                'type'          => 'text', 
                                'name'          => 'program_name', 
                                'form-align'    => 'vertical', 
                                'class'         => 'form-control', 
                                'id'            => 'program_name', 
                                'required'      => true, 
                                'maxlength'     => 255, 
                                'alphaonly'     => false, 
                                'placeholder'   => 'Program Name', 
                                'label'         => 'Program Name'
                            );

$config['program_short_description'] = array(
                                'type'          => 'textarea',
                                'name'          => 'program_short_description',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control ',
                                'id'            => 'program_short_description',
                                'required'      => true,
                                'maxlength'     => 255,
                                'placeholder'   => 'Short Description',
                                'label'         => 'Short Description'
                            );

$config['program_overview'] = array(
                                'type'          => 'textarea',
                                'name'          => 'program_overview',
                                'form-align'    => 'vertical',
                                'class'         => 'form-control ',
                                'id'            => 'program_overview',
                                'required'      => true,
                                'maxlength'     => 255,
                                'placeholder'   => 'Overview',
                                'label'         => 'Overview'
                            );
$config['area_covered']       = array(
                                'type'          => 'text', 
                                'name'          => 'area_covered', 
                                'form-align'    => 'vertical', 
                                'class'         => 'form-control', 
                                'id'            => 'area_covered', 
                                'required'      => true, 
                                'maxlength'     => 255, 
                                'alphaonly'     => false, 
                                'placeholder'   => 'Area Covered', 
                                'label'         => 'Area Covered'
                            );
$config['join_points']       = array(
                                'type'          => 'number', 
                                'name'          => 'join_points', 
                                'form-align'    => 'vertical', 
                                'class'         => 'form-control', 
                                'id'            => 'join_points', 
                                'required'      => true, 
                                'maxlength'     => 10, 
                                'alphaonly'     => false, 
                                'placeholder'   => 'Reward Points', 
                                'label'         => 'Reward Points'
                            );
$config['program_image']       = array(
                                'type'          => 'file', 
                                'name'          => 'program_image', 
                                'form-align'    => 'vertical', 
                                'class'         => 'form-control', 
                                'id'            => 'program_image', 
                                'required'      => true, 
                                'maxlength'     => 10, 
                                'alphaonly'     => false, 
                                'accept'        => "image/*", 
                                'placeholder'   => 'Program Image', 
                                'label'         => 'Program Image'
                            );

$config['user_firstname']       = array(
                                'type'          => 'text', 
                                'name'          => 'user_firstname', 
                                'form-align'    => 'horizontal', 
                                'class'         => 'form-control', 
                                'id'            => 'user_firstname', 
                                'required'      => true, 
                                'maxlength'     => 255, 
                                'alphaonly'     => false, 
                                'placeholder'   => 'First Name', 
                                'label'         => 'First Name'
                            );
$config['user_lastname']       = array(
                                'type'          => 'text', 
                                'name'          => 'user_lastname', 
                                'form-align'    => 'horizontal', 
                                'class'         => 'form-control', 
                                'id'            => 'user_lastname', 
                                'required'      => true, 
                                'maxlength'     => 255, 
                                'alphaonly'     => false, 
                                'placeholder'   => 'Last Name', 
                                'label'         => 'Last Name'
                            );
$config['user_mobile']       = array(
                                'type'          => 'text', 
                                'name'          => 'user_mobile', 
                                'form-align'    => 'horizontal', 
                                'class'         => 'form-control', 
                                'id'            => 'user_mobile', 
                                'required'      => true, 
                                'maxlength'     => 10, 
                                'alphaonly'     => false, 
                                'placeholder'   => 'Mobile Number', 
                                'label'         => 'Mobile Number'
                            );
$config['user_password']         = array(
                                'type'          => 'password',
                                'name'          => 'user_password',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'user_password',
                                'required'      => true,
                                'placeholder'   => 'Password',
                                'label'         => 'Password'
                            );
$config['user_confirm_password']         = array(
                                'type'          => 'password',
                                'name'          => 'user_confirm_password',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'user_confirm_password',
                                'required'      => true,
                                'placeholder'   => 'Confirm Password',
                                'label'         => 'Confirm Password'
                            );							
$config['user_gender']       = array(
                            'type'          => 'dropdown',
                            'name'          => 'user_gender',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control user_gender',
                            'id'            => 'user_gender',
                            'required'      => true,
                            'placeholder'   => 'Gender',
                            'label'         => 'Gender',
                            'list_value'    => array(
                                                'M'     => 'Male',
                                                'F'     => 'Female'
                                            )
							);
$config['user_email']       = array(
                                'type'          => 'text', 
                                'name'          => 'user_email', 
                                'form-align'    => 'horizontal', 
                                'class'         => 'form-control', 
                                'id'            => 'user_email', 
                                'required'      => true, 
                                'maxlength'     => 255, 
                                'alphaonly'     => false, 
                                'placeholder'   => 'Email Address', 
                                'label'         => 'Email Address'
                            );
$config['user_birthday']       = array(
                                'type'          => 'date', 
                                'name'          => 'user_birthday', 
                                'form-align'    => 'horizontal', 
                                'class'         => 'form-control', 
                                'id'            => 'user_birthday', 
                                'required'      => true, 
                                'maxlength'     => 255, 
                                'alphaonly'     => false, 
                                'placeholder'   => 'Birthday', 
                                'label'         => 'Birthday'
                            );
                                              
$config['banner_title']       = array(
                            'type'          => 'text',
                            'name'          => 'banner_title',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control',
                            'id'            => 'banner_title',
                            'required'      => true,
                            'maxlength'     => 255,
                            'label'         => 'Title'
                        );

$config['banner_description'] = array(
                            'type'          => 'textarea',
                            'name'          => 'banner_description',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control meta_description_input',
                            'id'            => 'banner_description',
                            'required'      => true,
                            'maxlength'     => 500,
                            'label'         => 'Description'
                        );


$config['banner_media_web'] = array(
                            'type'          => 'filemanager',
                            'name'          => 'banner_media_web',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control',
                            'id'            => 'banner_media_web',
                            'accept'        => 'jpg,png,jpeg',
                            'max_size'      => '50',
                            'required'      => true,
                            'label'         => 'Banner Media (Web)',
                        );



$config['banner_media_tablet'] = array(
                            'type'          => 'filemanager',
                            'name'          => 'banner_media_tablet',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control',
                            'id'            => 'banner_media_tablet',
                            'accept'        => 'jpg,png,jpeg',
                            'max_size'      => '50',
                            'label'         => 'Banner Media (Tablet)',
                        );

$config['banner_media_mobile'] = array(
                            'type'          => 'filemanager',
                            'name'          => 'banner_media_mobile',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control',
                            'id'            => 'banner_media_mobile',
                            'accept'        => 'jpg,png,jpeg',
                            'max_size'      => '50',
                            'required'      => true,
                            'label'         => 'Banner Media (Mobile)',
                        );

$config['banner_logo'] = array(
                            'type'          => 'filemanager',
                            'name'          => 'banner_logo',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control',
                            'id'            => 'banner_logo',
                            'accept'        => 'jpg,png,jpeg',
                            'max_size'      => '5',
                            'required'      => false,
                            'label'         => 'Banner Logo',
                        );


$config['banner_button_url']      = array(
                            'type'          => 'text',
                            'name'          => 'banner_button_url',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control redirect_url_input',
                            'id'            => 'banner_button_url',
                            'label'         => 'Button Redirect URL',
                        );

$config['banner_button_text']  = array(
                            'type'          => 'text',
                            'name'          => 'banner_button_text',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control',
                            'id'            => 'banner_button_text',
                            'maxlength'     => 50,
                            'label'         => 'Button Text'
                        );

$config['banner_navigation_text']  = array(
                            'type'          => 'text',
                            'name'          => 'banner_navigation_text',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control',
                            'id'            => 'banner_navigation_text',
                            'maxlength'     => 50,
                            'label'         => 'Navigation Text'
                        );

$config['banner_navigation_url']      = array(
                            'type'          => 'text',
                            'name'          => 'banner_navigation_url',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control redirect_url_input',
                            'id'            => 'banner_navigation_url',
                            'label'         => 'Navigation Redirect URL',
                        );


$config['banner_status']           = array(
                            'type'          => 'dropdown',
                            'name'          => 'banner_status',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control status_input',
                            'id'            => 'banner_status',
                            'required'      => true,
                            'placeholder'   => 'Status',
                            'label'         => 'Status',
                            'list_value'    => array(
                                                '1'     => 'Active',
                                                '0'     => 'Inactive'
                                            )
                        );
$config['team_name']             = array(
                                'type'          => 'text',
                                'name'          => 'team_name',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'team_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                'accept'        => '/[^a-zA-Z0-9\u00f1\u00d1 .,-\/\']/g',
                                'placeholder'   => 'Team Name',
                                'label'         => 'Team Name'
                            );




$config['reward_name']      = array(
                                'type'          => 'text',
                                'name'          => 'reward_name',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'reward_name',
                                'maxlength'     => 250,
                                'required'      => true,
                                // 'accept'        => '/[^a-zA-Z0-9\u00f1\u00d1 .,-\/\']/g',
                                'placeholder'   => 'Reward Name',
                                'label'         => 'Reward Name'
                            );

$config['reward_image']     = array(
                                'type'          => 'filemanager',
                                'name'          => 'reward_image',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'reward_image',
                                'accept'        => 'jpg,gif,png,jpeg',
                                'max_size'      => '50',
                                'required'      => true,
                                'placeholder'   => 'Reward Image',
                                'label'         => 'Reward Image',
                                
                            );

$config['reward_description'] = array(
                                'type'          => 'textarea',
                                'name'          => 'reward_description',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control reward_description_input',
                                'id'            => 'reward_description',
                                'required'      => true,
                                'maxlength'     => 255,
                                'placeholder'   => 'Reward Description',
                                'label'         => 'Reward Description'
                              );

$config['reward_points_needed']       = array(
                                'type'          => 'text',
                                'name'          => 'points_needed',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'points_needed',
                                'required'      => true,
                                'accept'        => '/[^0-9]/g',
                                'placeholder'   => 'Points Needed',
                                'label'         => 'Points Needed'
                                // 'maxlength'     => 11
                                // 'note'          => 'Required Format : 09XXXXXXXXX',
                            );

$config['reward_rating']  = array(
                                'type'          => 'text',
                                'name'          => 'reward_rating',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'reward_rating',
                                'required'      => true,
                                'accept'        => '/[^0-9]/g',
                                'placeholder'   => 'Reward Rating',
                                'label'         => 'Reward Rating',
                                // 'maxlength'     => 11
                            );

$config['category_select']    = array(
                                'type'          => 'dropdown', 
                                'name'          => 'category_id',
                                'form-align'    => 'horizontal', 
                                'class'         => 'form-control category_id', 
                                'id'            => 'category_id', 
                                'required'      => true, 
                                'filemanager'   => false, 
                                'youtube'       => false, 
                                'placeholder'   => 'Category',
                                'label'         => 'Category',
                                'maxlength'     => 255,
                                'note'          => 'Required field',
                                // 'select2'       => true
                                // 'list_value'    => array()
                       );


$config['initial_stock']  = array(
                                'type'          => 'text',
                                'name'          => 'initial_stock',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'initial_stock',
                                'required'      => true,
                                'accept'        => '/[^0-9]/g',
                                'placeholder'   => 'Initial Stock',
                                'label'         => 'Initial Stock',
                                // 'maxlength'     => 11
                            );


$config['category_name']      = array(
                                'type'          => 'text',
                                'name'          => 'name',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'name',
                                'maxlength'     => 250,
                                'required'      => true,
                                // 'accept'        => '/[^a-zA-Z0-9\u00f1\u00d1 .,-\/\']/g',
                                'placeholder'   => 'Category Name',
                                'label'         => 'Category Name'
                            );


$config['division_name']      = array(
                                'type'          => 'text',
                                'name'          => 'name',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'name',
                                'maxlength'     => 250,
                                'required'      => true,
                                // 'accept'        => '/[^a-zA-Z0-9\u00f1\u00d1 .,-\/\']/g',
                                'placeholder'   => 'Division Name',
                                'label'         => 'Division Name'
                            );
$config['user_otp'] = array(
                            'type'          => 'text',
                            'name'          => 'user_otp',
                            'form-align'    => 'horizontal',
                            'class'         => 'form-control meta_description_input',
                            'id'            => 'user_otp',
                            'required'      => true,
                            'maxlength'     => 6,
                            'label'         => 'OTP'
                        );	


$config['content']      = array(
                                'type'          => 'ckeditor',
                                'name'          => 'content',
                                'form-align'    => 'horizontal',
                                'class'         => 'form-control',
                                'id'            => 'content',
                                'required'      => true,
                                'no_html'      => false,
                                'filemanager'   => false,
                                'youtube'       => false,
                                'placeholder'   => 'Content',
                                'label'         => 'Content',
                            );
?>