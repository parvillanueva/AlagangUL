<?php

class Standard {

    /*
    |--------------------------------------------------------------------------
    | DIALOG Standards
    |--------------------------------------------------------------------------
    */

    function dialog($config){
        $CI =& get_instance();
        $CI->config->load('standard');
        echo $CI->config->item($config);
    }

    function dialog_return($config){
        $CI =& get_instance();
        $CI->config->load('standard');
        return $CI->config->item($config);
    }

    /*
    |--------------------------------------------------------------------------
    | MODAL Confirmation Standards
    |--------------------------------------------------------------------------
    */

    function confirm($config){
        $CI =& get_instance();
        $CI->config->load('standard');
        echo json_encode((object) $CI->config->item($config));
    }

    function confirm_return($config){
        $CI =& get_instance();
        $CI->config->load('standard');
        return json_encode((object) $CI->config->item($config));
    }

    /*
    |--------------------------------------------------------------------------
    | Input Standards
    |--------------------------------------------------------------------------
    */

    function inputs($list,$values=null)
    {

        $counter = 0;
        $input_val = null;
        $CI =& get_instance();
        $CI->config->load('standard');
        $CI->load->helper('string');
        $element_id = random_string();
        $generated_id = $element_id.time();
        echo '<div id="'.$generated_id.'">';
        foreach ($list as $key => $value) {
            if ($CI->config->item($value)) {
                if($values != null){
                    $input_val = $values[$key];
                }
                $this->input($CI->config->item($value),$input_val);
            } else {
                echo "<b style='color:red;'>Error : </b><b>" . $value . "</b> not defined in application/config/standard.php file" . "<br>";
            }
        }

        echo '<script type="text/javascript" src="' . base_url() . 'cms/js/filemanager_select.js" ></script>';
        echo '</div>';
        return $generated_id;
    }

    public function input($config = null, $value = null)
    {

        $CI =& get_instance();
        $CI->load->helper('form');

        $config["value"] = null;
        echo '<!--- ' . $config["id"] . ' --->' . "\n";

        echo '<div class="form-group">';
        if($config != null){
            
            //build input
            switch ($config['type']) {
                case 'separator':
                    echo "<hr>";
                    break;
                case 'file':
                    if($value != null){
                        $config["value"] = $value; 
                    }

                    $label_col = "";
                    $input_col = "";
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input hidden";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    $file_required = "";

                    if(isset($config["required"])){
                        if($config["required"]){
                             $file_required = "required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                            unset($config["required"]);
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    $id_input =  $config['id'] . "_file_input";
                    $id_input_path =  $config['id'];

                    $config['id'] = $id_input;
                    $config['data-id'] = $id_input_path;

                    echo '<div class="'.$input_col.'">';
                    $config['onchange'] = 'readURLImgStandardPreview(this);';
                    echo form_input($config);

                    $config['readonly'] = 'readonly';
                    $config['id'] = $id_input_path;

                    $config['class'] = $config['id'] . "_input_result " .$config['id'] .  "_input form-control " . $file_required;
                    $config['type'] = "text";

                    $hidden = "inline-block";
                    if(trim($config["value"])==""){
                        $hidden = "none";
                    }

                    echo '<div class="input-group"> ' . form_input($config) . '
                            <span class="input-group-btn">
                                <button data-id="'.$config['id'].'" class="btn btn-primary browse_file">Browse</button>
                                <button data-path="'.$config['value'].'" data-id="'.$config['id'].'" class="btn btn-danger delete_file  delete_'.$config['id'].'" style="display : '.$hidden.'">Remove</button>
                            </span>
                        </div>';
                    
                    if(isset($config['note'])){
                        echo "<small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).". ,</i></small>";
                    }
                    echo "<br>";
                    echo '<img id="img_banner_preview_'.$config["id"].'" width="50%"/>';

                    echo '</div>';
                    echo '<div class="clearfix"></div>';

                    echo "<script>";
                    echo 'function readURLImgStandardPreview(input) {
                            modal.loading(true);
                            var id = $(input).attr("data-id");
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var extension = input.files[0].name.split('.').pop().toLowerCase();
                                    var base64 = e.target.result;

                                    var url = "' .base_url() .'content_management/gcontroller/upload_file";
                                    var data = {
                                        base64 : base64,
                                        extension : extension
                                    }
                                    aJax.post(url,data,function(result){
                                        modal.loading(false);
                                        console.log(result.path);
                                        $("." + id + "_input_result").val(result.path);
                                        $("#img_banner_preview_"+id).attr("src", result.fullpath);
                                        $(".delete_"+id).show();
                                        $(".delete_"+id).attr("data-path", result.path);

                                    });

                                    
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }';

                    echo "$(document).on('click', '.delete_file', function(){
                            var path = $(this).attr('data-path');
                            var id = $(this).attr('data-id');
                            var element = $(this);
                            var modal_obj = '";
                    $CI->standard->confirm("confirm_delete_file");

                    echo "'";

                    echo '; 

                            console.log(modal_obj);
                            modal.standard(modal_obj, function(result){
                                if(result){
                                    element.hide();
                                    $("." + id + "_input_result").val("");
                                    $("#img_banner_preview_" + id).attr("src", "");
                                }
                            });
                        });
                    ';

                    echo '$(document).on("click", ".browse_file", function(){
                        var id = $(this).attr("data-id");
                        $("#" + id + "_file_input").click();
                    });';
                    echo "</script>";

                    break;
                case 'number':
                    if($value != null){
                        $config["value"] = $value; 
                    }

                    $label_col = "";
                    $input_col = "";
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    if(isset($config["alphaonly"])){
                        if($config["alphaonly"]){
                            $config['class'] = $config['class'] . " alphaonly";
                        }
                        unset($config["alphaonly"]);
                    }

                    if(isset($config["accept"])){
                        if($config["accept"]){
                            $config['onkeyup'] = "this.value=this.value.replace(".$config["accept"].",'');";
                        }
                        unset($config["alphaonly"]);
                    }


                    if(isset($config["no_html"])){
                        if($config["no_html"]){
                            $config['class'] = $config['class'] . " no_html";
                            
                        }
                        unset($config["no_html"]);
                    }

                    echo '<div class="'.$input_col.'">';
                    echo form_input($config);
                    
                    if(isset($config['note'])){
                        echo "<small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).". ,</i></small>";
                    }

                    
                    if(isset($config['maxlength'])){
                        echo "<small class='standard-max'><i>Maximum character count is ".$config['maxlength'].".</i></small>";
                    }
                    


                    echo '</div>';
                    echo '<div class="clearfix"></div>';

                    break;
                case 'text':
                    if($value != null){
                        $config["value"] = $value; 
                    }

                    $label_col = "";
                    $input_col = "";
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    if(isset($config["alphaonly"])){
                        if($config["alphaonly"]){
                            $config['class'] = $config['class'] . " alphaonly";
                        }
                        unset($config["alphaonly"]);
                    }

                    if(isset($config["accept"])){
                        if($config["accept"]){
                            $config['onkeyup'] = "this.value=this.value.replace(".$config["accept"].",'');";
                        }
                        unset($config["alphaonly"]);
                    }


                    if(isset($config["no_html"])){
                        if($config["no_html"]){
                            $config['class'] = $config['class'] . " no_html";
                            
                        }
                        unset($config["no_html"]);
                    }

                    echo '<div class="'.$input_col.'">';
                    echo form_input($config);
                    
                    if(isset($config['note'])){
                        echo "<small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).". ,</i></small>";
                    }

                    
                    if(isset($config['maxlength'])){
                        echo "<small class='standard-max'><i>Maximum character count is ".$config['maxlength'].".</i></small>";
                    }
                    


                    echo '</div>';
                    echo '<div class="clearfix"></div>';

                    break;
                
                case 'email':
                    if($value != null){
                        $config["value"] = $value;
                    }

                    $config['class'] = $config['class'] . " email";
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }


                    echo '<div class="'.$input_col.'">';
                    echo form_input($config);
                    if(isset($config['note'])){
                        echo "<br><small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }
                    echo '</div>';
                    echo '<div class="clearfix"></div>';
                    break;

                case 'password':


                    if($value != null){
                        $config["value"] = $value;
                    }
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";


                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    echo '<div class="'.$input_col.'">';
                    echo form_input($config);
                    if(isset($config['note'])){

                        echo "<br><small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }
                    echo '</div>';
                    echo '<label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                                <div id="password_chcklist">
                                    <p>Password Must:</p>
                                    <div class="password_chcklist_contanier">
                                        <input type="checkbox"  id="min_ten_chckbx_p" class="min_ten_chckbx password_checkbox required_input hidden"> 
                                       <i class="fas fa-check-square min_ten_chck" ></i> <p class="min_ten_chckbx_p">Minimum of 10 characters</p>
                                    </div>
                                    <div class="password_chcklist_contanier">
                                        <input type="checkbox" id="special_chckbx_p" class="special_chckbx password_checkbox required_input hidden"> 
                                      <i class="fas fa-check-square special_chck"></i> <p class="special_chckbx_p">Atleast 1 Special Characters</p>
                                    </div>
                                    <div class="password_chcklist_contanier">
                                        <input type="checkbox" id="upper_chckbx_p" class="upper_chckbx password_checkbox required_input hidden"> 
                                      <i class="fas fa-check-square upper_chck"></i> <p class="upper_chckbx_p">Atleast 1 Uppercase</p>
                                    </div>
                                    <div class="password_chcklist_contanier">
                                        <input type="checkbox" id="number_chckbx_p" class="number_chckbx password_checkbox required_input hidden"> 
                                      <i class="fas fa-check-square number_chck"></i> <p class="number_chckbx_p">Atleast 1 Number</p>
                                    </div>
                                 </div>
                            </div>';
                    echo '<div class="clearfix"></div>';
                    break;
                
                case 'dropdown':
                    $set_value ="";
                    if($value != null){
                        $set_value = $value;
                    }
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    if(isset($config["list_value"])){
                        $list_value = $config['list_value'];
                    } else {
                        $list_value = array(''=>"");
                    }
                    
                    unset($config['list_value']);

                    echo '<div class="'.$input_col.'">';
                    echo form_dropdown($config['name'], $list_value, $set_value, $config);
                    if(isset($config['note'])){
                        echo "<br><small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }
                    echo '</div>';
                    echo '<div class="clearfix"></div>';
                    break;
                
                case 'radio':
                    $set_value ="";
                    if($value != null){
                        $set_value = $value;
                    }
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    
                    $list_value = $config['list_value'];
                    unset($config['list_value']);

                    echo '<div class="'.$input_col.'">';
                    foreach ($list_value as $k => $v) {
                        $is_checked = false;
                        if($k == $set_value){
                            $is_checked = true;
                        }
                        echo '<div class="radio-inline">';
                        echo '  <span>' . form_radio($config['name'], $k, $is_checked, $config) . " " . $v . '</span>';
                        echo '</div>';
                    }
                    if(isset($config['note'])){
                        echo "<br><small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }
                    echo '</div>';
                    echo '<div class="clearfix"></div>';
                    break;

                case 'checkbox':
                    $set_value ="";
                    if($value != null){
                        $set_value = $value;
                    }
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    
                    $list_value = $config['list_value'];
                    unset($config['list_value']);

                    echo '<div class="'.$input_col.'">';
                    foreach ($list_value as $k => $v) {
                        $is_checked = false;
                        if($k == $set_value){
                            $is_checked = true;
                        }
                        echo '<div class="radio-inline">';
                        echo '  <span>' . form_checkbox('gender', $k, $is_checked, $config) . " " . $v . '</span>';
                        echo '</div>';
                    }
                    if(isset($config['note'])){
                        echo "<br><small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }
                    echo '</div>';
                    echo '<div class="clearfix"></div>';
                    break;

                case 'textarea':
                    if($value != null){
                        $config["value"] = $value;
                    }
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    if(isset($config["alphaonly"])){
                        if($config["alphaonly"]){
                            $config['class'] = $config['class'] . " alphaonly";
                        }
                        unset($config["alphaonly"]);
                    }

                    if(isset($config["no_html"])){
                        if($config["no_html"]){
                            $config['class'] = $config['class'] . " no_html";
                        }
                        unset($config["no_html"]);
                    }

                    echo '<div class="'.$input_col.'">';
                    echo form_textarea($config);



                    if(isset($config['maxlength'])){
                        echo "<small class='standard-max'><i>Maximum character count is ".$config['maxlength'].".</i></small>";
                    }



                    if(isset($config['note'])){
                        echo "<br><small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }

                    echo '</div>';
                    echo '<div class="clearfix"></div>';
                    break;   

                case 'date':
                    if($value != null){
                        $config["value"] = $value;
                    }
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    $config['type'] = "text";
                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    echo '<div class="'.$input_col.'">';
                    
                    echo form_input($config);

                    echo "<script>$('#".$config['id']."').materialDatePicker({time : false,weekStart : 0});$(document).on('cut copy paste input', '#".$config['id']."', function(e) {e.preventDefault();});</script>";
                    if(isset($config['note'])){
                        echo "<small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }

                    echo '</div>';
                    echo '<div class="clearfix"></div>';
                    break;  

                case 'timepicker':
                    if($value != null){
                        $config["value"] = $value;
                    }

                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    $config['type'] = "text";
                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    echo '<div class="'.$input_col.'">';
                    
                    echo form_input($config);
                    echo "<script>$('#".$config['id']."').materialDatePicker({date : false});$(document).on('cut copy paste input', '#".$config['id']."', function(e) {e.preventDefault();});</script>";
                    if(isset($config['note'])){
                        echo "<small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }

                    echo '</div>';
                    echo '<div class="clearfix"></div>';
                    break;   

                case 'filemanager':
                    if($value != null){
                        $config["value"] = $value;
                    } else {
                        $config["value"] = "";
                    }

                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    $config['type'] = "text";
                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    $is_required = "";
                    if(isset($config["required"])){
                        if($config["required"]){
                            $is_required = "required_input";
                        }
                    }

                    $filter = "";
                    $accept = "";
                    if(isset($config["accept"])){
                        if($config["accept"]){
                            $filter = "ext_filter";
                            $accept = $config["accept"];
                        }
                    }


                    $max_size_class = "";
                    $max_size = "";
                    if(isset($config["max_size"])){
                        if($config["max_size"]){
                            $max_size_class = "size_filter";
                            $max_size = $config["max_size"];
                        }
                    }

                    unset($config["required"]);
                    echo '<div class="'.$input_col.'">';
                    echo '<div class="input-group '.$config['id'].'"> ';
                    echo '  <input id="'.$config['id'].'" class="form-control '.$is_required.' ' . $filter . ' ' . $max_size_class . '" readonly value="'.$config["value"].'" accept="'.$accept.'" name="'.$config['name'].'" max_size="'.$max_size.'" />';
                    echo '      <span class="input-group-btn">';
                    echo '          <button type="button" data-id="'.$config['id'].'" class="file_manager_'.$config['id'].' btn btn-info btn-flat">Open File Manager</button>';
                    echo '      </span>';
                    echo '  </div>';                   

                    //put preview here
                    if($config["value"] != ""){
                        $ext = pathinfo($config["value"], PATHINFO_EXTENSION);
                        switch ($ext) {
                            case 'jpg':
                            case 'jpeg':
                            case 'gif':
                            case 'png':
                                echo '<img class="img_banner_preview" src="'. base_url() . $config["value"].'" width="100%" />';
                                break;

                            case 'mp4':
                                echo '<video class="img_banner_preview" style="width : 100%" controls>';
                                echo '  <source src="' . base_url() . $config["value"].'" type="video/mp4"';
                                echo '  Your browser does not support HTML5 video.';
                                echo '</video>';
                                break;
                            
                            default:
                                echo '<span class="img_banner_preview"></span>';
                                break;
                        }
                    }


                    if(isset($config['max_size'])){
                        if($config['max_size'] != ""){
                            echo "<i> <b>Max Size : </b> ".strtoupper($config['max_size'])."MB.</i><br>";
                        }
                    }

                    if(isset($config['accept'])){
                        if($config['accept'] != ""){
                            echo "<i> <b>Accept : </b> ".strtoupper($config['accept']).".</i><br>";
                        }
                    }

                    if(isset($config['note'])){
                        
                        echo "<small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }

                    echo '</div>';

                    
                    echo '<script>';
                    echo "  $(document).on('click', '.file_manager_".$config['id']."', function(e){";
                    echo '      var data_id ="'.$config['id'].'";';
                    echo '      modal.file_manager(data_id);';
                    echo '  });';
                    echo '</script>';

                    echo '<div class="clearfix"></div>';
                    break;         

                case 'ckeditor':
                    $remove_plugin = "";
                    if($value != null){
                        $config["value"] = $value;
                    }

                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $config['class'] = $config['class'] . " ckeditor_input";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }


                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    echo '<div class="'.$input_col.'">';
                    echo form_textarea($config);
                    if(isset($config["youtube"])){
                        if($config["youtube"] == false){
                            $remove_plugin .= "youtube,";
                        } 
                    }

                    if(isset($config["filemanager"])){
                        if($config["filemanager"] == false){
                            $remove_plugin .= "filemanager,";
                        } 
                    }
                    if(isset($config["list_style"])){
                        if($config["list_style"] == false){
                            $remove_plugin .= "list,";
                        } 
                    }

                    if(isset($config["source"])){
                        if($config["source"] == false){
                            $remove_plugin .= "sourcearea,";
                        } 
                    } 

                    echo '<script>CKEDITOR.replace("'.$config['id'].'",{height: "500px", removePlugins : "'.$remove_plugin.'"});</script>';
                    echo '<script>CKEDITOR.instances.'.$config['id'].'.on("change", function() { $("#'.$config['id'].'").val(CKEDITOR.instances.'.$config['id'].'.getData().replace(/(<([^>]+)>)/ig,"")); });</script>';
                        


                    if(isset($config['note'])){
                        echo "<br><small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }

                    echo '</div>';
                    echo '<div class="clearfix"></div>';
                    break; 

                case 'mobile_number':
                    if($value != null){
                        $config["value"] = $value; 
                    }

                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        unset($config["required"]);
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    echo '<div class="'.$input_col.'">';
                    $config['class'] = $config['class'] . " mobile_number";

                    $config['onkeyup'] = "this.value=this.value.replace(/[^0-9]/g,'');";

                    echo form_input($config);
                    
                    if(isset($config['note'])){
                        echo "<small class='standard-note'><i> <b>Note:</b> ".ucfirst($config['note']).".</i></small>";
                    }

                    echo '</div>';
                    echo '<div class="clearfix"></div>';

                    break;
                
                case 'youtube':
                    if($value != null){
                        $config["value"] = $value;
                    } else {
                        $config["value"] = "";
                    }

                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input no_html";

                    $label_col = "";
                    $input_col = "";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    $config['type'] = "text";
                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    $is_required = "";
                    if(isset($config["required"])){
                        if($config["required"]){
                            $is_required = "required_input";
                        }
                        unset($config["required"]);
                    }

                    unset($config["required"]);
                    echo '<div class="'.$input_col.'">';
                    echo '<div class="input-group '.$config['id'].'"> ';
                    echo '  <input id="'.$config['id'].'" class="form-control '.$is_required.'" readonly value="'.$config["value"].'"/>';
                    echo '      <span class="input-group-btn">';
                    echo '          <button type="button" data-id="'.$config['id'].'" class="youtube_'.$config['id'].' btn btn-danger btn-flat">Add Youtube Link</button>';
                    echo '      </span>';
                    echo '  </div>';

                    echo '</div>';

                    echo '<script>';
                    echo "  $(document).on('click', '.youtube_".$config['id']."', function(e){";
                    echo '      var data_id ="'.$config['id'].'";';
                    echo '      modal.youtube(data_id);';
                    echo '  });';
                    echo '</script>';

                    echo '<div class="clearfix"></div>';
                    break;  


                case 'captcha':
                    if($value != null){
                        $config["value"] = $value; 
                    }

                    $label_col = "";
                    $input_col = "";
                    $config['class'] = $config['class'] . " " . $config['id'] .  "_input captcha_ci";

                    if(isset($config["form-align"])){
                        if($config["form-align"] == "horizontal"){
                            $label_col = "col-sm-2";
                            $input_col = "col-sm-10";
                        }
                        unset($config["form-align"]);
                    }

                    if(isset($config["required"])){
                        if($config["required"]){
                            $config['class'] = $config['class'] . " required_input";
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].'<span style="color: red;">*</span> :</label>';
                        } else {
                            echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                        }
                        
                    } else {
                        echo '<label class="control-label '.$config['id'].'_label '.$label_col.'">'.$config['label'].':</label>';
                    }

                    //checking if recaptcha
                    if(isset($config['captcha'])){
                        if($config['captcha'] == "codeigniter"){
                            $is_required = "";
                            if(isset($config["required"])){
                                if($config["required"]){
                                    $is_required = "required_input";
                                }
                            }
                            unset($config["required"]);
                            echo '<div class="'.$input_col.'">';
                            echo '  <div class="captcha_ci_image"></div>';
                            echo '  <div class="input-group '.$config['id'].'" style="max-width: 300px; margin-top: 5px;"> ';
                            echo '      <input id="'.$config['id'].'" class="form-control '.$is_required.' captcha_ci captcha_ci_input" placeholder="'.$config['placeholder'].'" value="'.$config["value"].'"/>';
                            echo '      <span class="input-group-btn">';
                            echo '          <button type="button" data-id="'.$config['id'].'" class="captcha_ci_refresh '.$config['id'].' btn btn-warning btn-flat"><i class="fa fa-refresh" aria-hidden="true"></i></button>';
                            echo '      </span>';
                            echo '  </div>';
                            echo '</div>';
                            echo '<div class="clearfix"></div>';

                            echo '<script>';
                            echo '      $(document).ready(function(){';
                            echo '          var url ="' . base_url("content_management/global_controller/captcha_ci") . '";';
                            echo '          aJax.get(url,function(result){';
                            echo '              var obj = isJson(result);';
                            echo '              $(".captcha_ci_input").attr("cpt-val",obj.cpt_val);';
                            echo '              $(".captcha_ci_image").html(obj.cpt_image);';
                            echo '          });';
                            echo '      });';
                            echo '      $(document).on("click",".captcha_ci_refresh", function(e){';
                            echo '          var url ="' . base_url("content_management/global_controller/captcha_ci") . '";';
                            echo '          aJax.get(url,function(result){';
                            echo '              var obj = isJson(result);';
                            echo '              $(".captcha_ci_input").attr("cpt-val",obj.cpt_val);';
                            echo '              $(".captcha_ci_image").html(obj.cpt_image);';
                            echo '          });';
                            echo '      });';
                            echo '</script>';
                        }

                        if($config['captcha'] == "google"){
                            $site_key = "6Lf8i2cUAAAAACaKQohJ3nFyBCGHMmDVQBK4sjVK";
                            if(isset($config['site_key'])){
                                $site_key = $config['site_key'];
                            }
                            echo '<div class="'.$input_col.'">';
                            echo '<div class="g-recaptcha" data-sitekey="'.$site_key.'"></div>';
                            echo '</div>';
                            echo '<div class="clearfix"></div>';
                        }
                    } else {
                        echo "CAPTCHA IS NOT SET IN STANDARD CONFIG";
                    }
                    

                    

                    break;
                

                default:
                    # code...
                    break;
            }
    
            echo '</div>'  ."\n\n";

            echo '<script></script>';
        } else {
            echo "Error : Input config not defined.";
        }
    }

}



