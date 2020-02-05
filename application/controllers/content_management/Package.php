<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('sess_email')=='' ) { 
            redirect(base_url("content_management/login"));
        }
    }

    public function install()
    {
        $this->tmp_dir = './tmp';
        @mkdir($this->tmp_dir);

        $tmp_file = $_FILES['package']['tmp_name'];
        $module_path = $_POST['module_path'];
        $filepath = $this->tmp_dir . '/' .  $_FILES['package']['name'];
        move_uploaded_file($tmp_file,$filepath);

        $this->unzip($filepath,$module_path);

        $this->exec_SQL($module_path);

        $table_sql = "select table_name from information_schema.TABLES where table_schema = '".$this->db->database."' order by CREATE_TIME desc limit 1";
        $table = $this->db->query($table_sql);   

        $result_array = $table->result_array();

        $this->config_controller($module_path,$_POST['reload_path']);

        $this->delete_recursively($module_path);

        /* Update Package Column in CMS Menu */
        $main_menu_sql = "select id, menu_url from cms_menu where menu_url = '".$this->input->post('slug')."'";
        $main_menu_table = $this->db->query($main_menu_sql);
        /* $sub_menu_sql = "select * from cms_menu_sub where url = '".$this->input->post('slug')."'";
        $sub_menu_table = $this->db->query($sub_menu_sql);*/
        $package = str_replace('.zip', '', $_FILES['package']['name']);

        if(count($main_menu_table->result_array()) >= 1){
            $data = array( 'menu_package' => $package );
            $this->db->where('menu_url', $this->input->post('slug'));
            $this->db->update('cms_menu', $data);
        }/*else if(count($sub_menu_table->result_array()) >= 1){
            $data = array( 'package' => $package );
            $this->db->where('url', $this->input->post('slug'));
            $this->db->update('cms_menu_sub', $data);
        }*/

        redirect($_POST['reload_path'], 'refresh');
    }

    public function install_builder()
    {

        $pkg_db = $this->input->post('package_db');
        $pkg_listing = $this->input->post('package_listing');
        $slug = $this->input->post('slug');
        $module_path = $this->input->post('module_path');
        $reload_path = $this->input->post('reload_path');
        $input_arr = [];
        $input_arr2 = [];
        $form_arr = [];
        $custom_input_arr = [];

        $input_data = json_decode($_POST['input_data']);

        foreach($input_data as $id) {
            array_push($input_arr, str_replace(' ', '_', $id->value));
            if ($this->db->table_exists($pkg_db)) {
                array_push($input_arr2, "\$details[0]->".(str_replace(' ', '_', $id->value)));
            } else {
                array_push($input_arr2, "\$details[0]->".(str_replace(' ', '_', $id->value)));
            }
        }

        $builder_arr = [];
        $builder = json_decode($_POST['databuilder']);
        foreach($builder as $bp) {
            array_push($builder_arr, $bp->value);
        }


        $input_values = "";
        foreach($input_arr2 as $value) {
            $input_values .= $value.',';
        }

        $display_arr = [];
        $display = json_decode($_POST['display']);
        foreach($display as $dp) {
            array_push($display_arr, $dp->value);
        }

        $required_arr = [];
        $required = json_decode($_POST['required']);
        foreach($required as $req) {
            array_push($required_arr, $req->value);
        }

        $datatype_arr = [];
        $datatype = json_decode($_POST['datatype']);
        foreach($datatype as $dt) {
            array_push($datatype_arr, $dt->value);   
        }

        $arr_container = array_combine($input_arr, $datatype_arr);
        $arr_container2 = array_combine($input_arr, $display_arr);

        $table_arr = [];
        $display_filtered = array_keys($arr_container2, '1');
        foreach($display_filtered as $df) {
            array_push($table_arr, "<th class='th-setter'>".ucwords(str_replace("_", " ", $df))."</th>");
        }

        $table_head = "";
        foreach($table_arr as $value) {
            $table_head .= $value;
             end($table_arr);
        }

        $label_arr = [];
        $label = json_decode($_POST['input_label']);

        foreach($label as $lbl) {
            array_push($label_arr, ucwords($lbl->value));
        }

        $placeholder_arr = [];
        $placeholder = json_decode($_POST['input_placeholder']);
        foreach($placeholder as $ph) {
            array_push($placeholder_arr, ucwords($ph->value));
        }

        $maxlength_arr = [];
        $maxlength = json_decode($_POST['maxlength']);
        foreach($maxlength as $ml) {
            array_push($maxlength_arr, $ml->value);
        }

        $note_arr = [];
        $note = json_decode($_POST['note']);
        foreach($note as $nt) {
            array_push($note_arr, trim(ucfirst($nt->value)));
        }
        
        $ids_arr = [];
        $ids = json_decode($_POST['input_id']);
        foreach($ids as $id) {
            array_push($ids_arr, str_replace(' ', '_', $id->value));
        }

        $class_arr = [];
        $class = json_decode($_POST['input_class']);
        foreach($class as $cl) {
            array_push($class_arr, str_replace(' ', '_', $cl->value));
        }

        $selected_pckg_arr = [];
        $selected_pckg = json_decode($_POST['selected_pckg']);
        foreach ($selected_pckg as $sp) {
            array_push($selected_pckg_arr, $sp->value);
        }

        // generate table
        $field_name = "";
        $datatype_value = "";
        $result = "";

        foreach($arr_container as $key => $value) {
            $field_name = $key;
            $datatype_value = strtoupper($value);
           // $add_field_name .= $field_name.",";

            if (array_key_exists('status', $arr_container)) {
                $result .= $field_name." ".$datatype_value."(255) DEFAULT NULL,";
            } else {
                $result .= $field_name." ".$datatype_value."(255) DEFAULT NULL,";
                end($arr_container);
                if ($key === key($arr_container)) {
                    $result .= "status INT(2) NOT NULL DEFAULT '1', ";
                }
            }
        }

        $sql_query =  "CREATE TABLE IF NOT EXISTS ".$pkg_db." (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ".
                      substr($result, 0, -1)." create_date DATETIME NOT NULL, update_date DATETIME NOT NULL, orders INT(6) UNSIGNED DEFAULT NULL)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1;";

        $table = $this->db->query($sql_query);
        $final_data = array(
            'id' => $ids_arr,
            'type' => $selected_pckg_arr,
            'name' => $input_arr,
            'class' => $class_arr,
            'required' => $required_arr,
            'placeholder' => $placeholder_arr,
            'label' => $label_arr,
            'max_length' => $maxlength_arr,
            'note' => $note_arr,
            'builder' => $builder_arr
        );



        $selected_pckg_counter = count($selected_pckg_arr);
        $singleArray = array();

        for ($i=0; $i < $selected_pckg_counter; $i++) { 
            foreach ($final_data as $key => $value){
                $singleArray[$key] = $value[$i];
            }

                if($singleArray['builder'] == 0){
                        $custom_input_name = 'custom_'.$singleArray['name'];
                        array_push($custom_input_arr, $custom_input_name);
                        $query = 'standard_name = "'.$custom_input_name.'"';
                        $check_standard = count($this->Global_model->get_list_query('cms_standard_config',$query));

                        if($check_standard == 0){

                            $data['standard_name'] = $custom_input_name;
                            $data['created_date'] = date('Y-m-d H:m:i');
                            $this->Global_model->save_data("cms_standard_config",$data);
                            $this->config_standard($module_path, $singleArray['id'],$singleArray['type'],$singleArray['name'],$custom_input_name,$singleArray['class'],$singleArray['required'],$singleArray['placeholder'],$singleArray['label'],$singleArray['max_length'],$singleArray['note']);
                        }
                }

                if($singleArray['builder'] == 1){
                    $standard_input_name = $singleArray['name'];
                    array_push($custom_input_arr, $standard_input_name); 

                }
        }




        if ($pkg_listing === "0") {

            $generated_column = array();
            $insert_default_data = array();

            foreach($arr_container as $k => $v ) {
                $generated_column[$k] = $v;
                $insert_default_data["'".$k."'"] = $v;
            }

            $save_sql_query =  "INSERT INTO ".$pkg_db." ( " . implode(', ',array_keys($generated_column)) . ") VALUES (" . implode(', ',array_keys($insert_default_data)) . ")";
            $this->db->query($save_sql_query);

            $view_tmpl = file_get_contents('./cms/templates/builder/views/page.php');
            $view_tmpl = str_replace("{table_name}", $pkg_db, $view_tmpl);
            $view_tmpl = str_replace("{input_data}", json_encode($input_arr), $view_tmpl);
            $view_tmpl = str_replace("{required_field}", json_encode($required_arr), $view_tmpl);
            $view_tmpl = str_replace("{input_label}", json_encode($label_arr), $view_tmpl);
            $view_tmpl = str_replace("{input_custom_data}", json_encode($custom_input_arr), $view_tmpl);
            $view_tmpl = str_replace("{input_placeholder}", json_encode($placeholder_arr), $view_tmpl);
            $view_tmpl = str_replace("{input_maxlength}", json_encode($maxlength_arr), $view_tmpl);
            $view_tmpl = str_replace("{input_note}", json_encode($note_arr), $view_tmpl);
            $view_tmpl = str_replace("{input_id}", json_encode($ids_arr), $view_tmpl);
            $view_tmpl = str_replace("{input_class}", json_encode($class_arr), $view_tmpl);
            $view_tmpl = str_replace("{input_countx}", count($label_arr), $view_tmpl);
            $view_tmpl = str_replace("{input_value}", $input_values, $view_tmpl);

            //standard js
            $view_js_tmpl = file_get_contents('./cms/templates/builder/views/standardconfig.js');
            $view_js_tmpl = str_replace("{input_data}", json_encode($input_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{required_field}", json_encode($required_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_label}", json_encode($label_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_placeholder}", json_encode($placeholder_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_maxlength}", json_encode($maxlength_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_note}", json_encode($note_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_id}", json_encode($ids_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_class}", json_encode($class_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_countx}", count($label_arr), $view_js_tmpl);

            write_file($module_path.'/standardconfig.js', $view_js_tmpl);
            write_file($module_path.'/page.php', $view_tmpl);

            redirect($_POST['reload_path'], 'refresh');

        } elseif ($pkg_listing === "1") {

            $generated_column = array();
            $insert_default_data = array();

            foreach($arr_container as $k => $v ) {
                $generated_column[$k] = $v;
                $insert_default_data["'".$k."'"] = $v;
            }
            


            $save_sql_query =  "INSERT INTO ".$pkg_db." ( " . implode(', ',array_keys($generated_column)) . ") VALUES (" . implode(', ',array_keys($insert_default_data)) . ")";
            $this->db->query($save_sql_query);
            $config = "./cms/templates/builder/views/listing/config.ctr";


            //set data to select field 
            $custom_table_field = array_keys($generated_column);
            array_unshift($custom_table_field, 'id','update_date','status');
            $string_table_field = implode(', ' ,$custom_table_field);


            if (file_exists($config)) {
                $script = file_get_contents($config);
                $exploded = explode('/', $slug); 
                $controller = end($exploded);
       
                $view_list = file_get_contents('./application/controllers/content_management/'.ucfirst($controller).'.php');
                $view_list = str_replace("//controller_config", $script, $view_list );
                $view_list = str_replace("{title_header}", ucwords(str_replace("_", " ", substr($controller, 5))), $view_list );
                $view_list = str_replace("{dir}", substr($controller, 5), $view_list );

                write_file('./application/controllers/content_management/'.ucfirst($controller).'.php', $view_list);
            }
   
            $page_view_tmpl = file_get_contents('./cms/templates/builder/views/listing/page.php');
            $page_view_tmpl = str_replace("{table_name}", $pkg_db, $page_view_tmpl);
            $page_view_tmpl = str_replace("{th_data}", $table_head, $page_view_tmpl);
            $page_view_tmpl = str_replace("{page}", $controller, $page_view_tmpl);
            $page_view_tmpl = str_replace("{input_data}", json_encode($input_arr), $page_view_tmpl);
            $page_view_tmpl = str_replace("{input_custom_table_field}", json_encode($string_table_field), $page_view_tmpl);
            $page_view_tmpl = str_replace("{module}", substr($slug, 19), $page_view_tmpl);

            $add_view_tmpl = file_get_contents('./cms/templates/builder/views/listing/add.php');
            $add_view_tmpl = str_replace("{table_name}", $pkg_db, $add_view_tmpl);
            $add_view_tmpl = str_replace("{input_data}", json_encode($input_arr), $add_view_tmpl);
            $add_view_tmpl = str_replace("{required_field}", json_encode($required_arr), $add_view_tmpl);
            $add_view_tmpl = str_replace("{input_label}", json_encode($label_arr), $add_view_tmpl);
            $add_view_tmpl = str_replace("{input_custom_data}", json_encode($custom_input_arr), $add_view_tmpl);
            $add_view_tmpl = str_replace("{input_placeholder}", json_encode($placeholder_arr), $add_view_tmpl);
            $add_view_tmpl = str_replace("{input_countx}", count($label_arr), $add_view_tmpl);
            $add_view_tmpl = str_replace("{module}", substr($slug, 19), $add_view_tmpl);

            $edit_view_tmpl = file_get_contents('./cms/templates/builder/views/listing/edit.php');
            $edit_view_tmpl = str_replace("{table_name}", $pkg_db, $edit_view_tmpl);
            $edit_view_tmpl = str_replace("{input_data}", json_encode($input_arr), $edit_view_tmpl);
            $edit_view_tmpl = str_replace("{required_field}", json_encode($required_arr), $edit_view_tmpl);
            $edit_view_tmpl = str_replace("{input_label}", json_encode($label_arr), $edit_view_tmpl);
            $edit_view_tmpl = str_replace("{input_custom_data}", json_encode($custom_input_arr), $edit_view_tmpl);
            $edit_view_tmpl = str_replace("{input_placeholder}", json_encode($placeholder_arr), $edit_view_tmpl);
            $edit_view_tmpl = str_replace("{input_countx}", count($label_arr), $edit_view_tmpl);
            $edit_view_tmpl = str_replace("{input_value}", $input_values, $edit_view_tmpl);
            $edit_view_tmpl = str_replace("{module}", substr($slug, 19), $edit_view_tmpl);


            //standard js
            $view_js_tmpl = file_get_contents('./cms/templates/builder/views/standardconfig.js');
            $view_js_tmpl = str_replace("{input_data}", json_encode($input_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{required_field}", json_encode($required_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_label}", json_encode($label_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_placeholder}", json_encode($placeholder_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_maxlength}", json_encode($maxlength_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_note}", json_encode($note_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_id}", json_encode($ids_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{ainput_class}", json_encode($class_arr), $view_js_tmpl);
            $view_js_tmpl = str_replace("{input_countx}", count($label_arr), $view_js_tmpl);

            write_file($module_path.'/standardconfig.js', $view_js_tmpl);
            write_file($module_path.'/add.php', $add_view_tmpl);
            write_file($module_path.'/edit.php', $edit_view_tmpl);
            write_file($module_path.'/page.php', $page_view_tmpl);

            redirect($_POST['reload_path'], 'refresh');
        }

    }

    public function package_install()
    {
        $this->tmp_dir = './tmp';
        @mkdir($this->tmp_dir);

        $package_name = $_POST['package'];
        $package_name = str_replace(" ", "%20", $package_name);  

        /*
            for development
            $url = 'http://127.0.0.1/packages/'.$package_name;
        */
        $url = 'http://172.29.70.126/cms_quickinstall/packages/'.$package_name;

        $module_path = $_POST['module_path'];
        $reload_path = $this->input->post('reload_path');
        $filepath = $this->download($url);
        $this->unzip($filepath,$module_path);

        $this->exec_SQL($module_path);

        $table_sql = "select table_name from information_schema.TABLES where table_schema = '".$this->db->database."' order by CREATE_TIME desc limit 1";
        $table = $this->db->query($table_sql);   

        $result_array = $table->result_array();

        $this->config_controller($module_path,$_POST['reload_path']);

        if ($package_name == 'CRS%20Config.zip') {
            $crs_controller = fopen('./application/controllers/CRS_api.php', 'w');
            $controller_content = file_put_contents('./application/controllers/CRS_api.php', '//controller_config');
            $crs_model = fopen('./application/models/CRS_model.php', 'w');
            $controller_content = file_put_contents('./application/models/CRS_model.php', '//model_config');

            $crs_controller_remote = $module_path . "/" . "CRS_api.php";
            $exploded_dir = explode('\\', $module_path);
            $view_folder = end($exploded_dir);

            $crs_model_remote = $module_path . "/" . "CRS_model.php";
            $exploded_dir = explode('\\', $module_path);
            $view_folder = end($exploded_dir);

            $c_script = file_get_contents('./application/controllers/CRS_api.php');
            $c_exploded = explode('/', $reload_path);
            $controller = ucfirst(end($c_exploded));
            $c_view_list = file_get_contents('./cms/templates/api/CRS_api.php');
            $c_view_list = str_replace("//controller_config",$c_script, $c_view_list );
            $controller_file_handle = fopen('./application/controllers/CRS_api.php', 'w'); 
            fwrite($controller_file_handle, $c_view_list);
            fclose($controller_file_handle);

            $m_script = file_get_contents('./application/models/CRS_model.php');
            $m_exploded = explode('/', $reload_path);
            $model = ucfirst(end($m_exploded));
            $m_view_list = file_get_contents('./cms/templates/api/CRS_model.php');
            $m_view_list = str_replace("//model_config",$m_script, $m_view_list );
            $model_file_handle = fopen('./application/models/CRS_model.php', 'w'); 
            fwrite($model_file_handle, $m_view_list);
            fclose($model_file_handle);

            unlink($module_path . "/" . "CRS_api.php");
            unlink($module_path . "/" . "CRS_model.php");
        }

        $this->delete_recursively($module_path);

        /* Update Package Column in CMS Menu */
        $main_menu_sql = "select id, menu_url from cms_menu where menu_url = '".$this->input->post('slug')."'";
        $main_menu_table = $this->db->query($main_menu_sql);
        $package = str_replace('.zip', '', $this->input->post('package'));

        if(count($main_menu_table->result_array()) >= 1){
            $data = array( 'menu_package' => $package );
            $this->db->where('menu_url', $this->input->post('slug'));
            $this->db->update('cms_menu', $data);
        }

        redirect($_POST['reload_path'], 'refresh');
    }


    function config_standard($module_path, $id,$type,$name,$custom_name,$class,$required,$placeholder,$label,$max_length,$note)
    {

        $new_required = ($required == 1 ) ? 'true' : 'false';
        $new_maxlength = ($max_length == '') ? "''" : $max_length;

        $config = './cms/templates/builder/views/standardconfig.ctr';
        $exploded_dir = explode('\\', $module_path);
        $view_folder = end($exploded_dir);

        if (file_exists($config)) {
            $script = file_get_contents($config);
            $view_list1 = file_get_contents('./application/config/standard.php');
            $view_list1 = str_replace("//custom_standard_config",$script, $view_list1);
            $view_list1 = str_replace("{id}",$id, $view_list1);
            $view_list1 = str_replace("{type}",strtolower($type), $view_list1);
            $view_list1 = str_replace("{custom_name}",$custom_name, $view_list1);
            $view_list1 = str_replace("{name}",$name, $view_list1);
            $view_list1 = str_replace("{class}",$class , $view_list1);
            $view_list1 = str_replace("{required}",$new_required , $view_list1);
            $view_list1 = str_replace("{placeholder}",$placeholder , $view_list1);
            $view_list1 = str_replace("{label}",$label , $view_list1);
            $view_list1 = str_replace("{maxlength}",$new_maxlength , $view_list1);
            $view_list1 = str_replace("{note}",$note , $view_list1);
            $file_handle2 = fopen('./application/config/standard.php', 'w'); 
            fwrite($file_handle2, $view_list1);
            fclose($file_handle2);

        }
    }

    function config_controller($module_path, $reload_path)
    {
        $config = $module_path . "/" . "config.ctr";

        $exploded_dir = explode('\\', $module_path);
        $view_folder = end($exploded_dir);

        if (file_exists($config)) {
            $script = file_get_contents($config);

            $exploded = explode('/', $reload_path);
            $controller = ucfirst(end($exploded));

            
            $view_list = file_get_contents('./application/controllers/content_management/'.$controller .".php");
            $view_list = str_replace("//controller_config",$script, $view_list );
            $view_list = str_replace("{dir}",$view_folder, $view_list );

            $file_handle2 = fopen('./application/controllers/content_management/'.$controller .".php", 'w'); 
            fwrite($file_handle2, $view_list);
            fclose($file_handle2);
        }

    }

    function delete_recursively($path)
    {
       unlink($path . "/" . "table.sql");
    }

    private function exec_SQL($module_path){
        $sql = $module_path . "/" . "table.sql";
        $script = file_get_contents($sql);

        $sqls = explode(';', $script);
        array_pop($sqls);

        foreach($sqls as $statement){
            $statement = $statement . ";";
            $this->db->query($statement);   
        }

    }

    private function download_from_github()
    {
        $url = "https://github.com/kenjis/codeigniter-composer-installer/archive/v0.5.0.zip";
        $filepath = $this->download($url);
        $this->unzip($filepath);
    }

    private function download($url)
    {
        $file = file_get_contents($url);
        if ($file === false) {
            throw new RuntimeException("Can't download: $url");
        }
        echo 'Downloaded: ' . $url . PHP_EOL;
        
        $urls = parse_url($url);
        $filepath = $this->tmp_dir . '/' . basename($urls['path']);
        file_put_contents($filepath, $file);
        
        return $filepath;
    }

    private function unzip($filepath,$module_path)
    {
        $zip = new ZipArchive();
        if ($zip->open($filepath) === TRUE) {
            $tmp = explode('/', $zip->getNameIndex(0));
            $dirname = $tmp[0];
            $zip->extractTo($module_path);
            $zip->close();
        } else {
            throw new RuntimeException('Failed to unzip: ' . $filepath);
        }
        
        return $dirname;
    }

    public function edit_title()
    {
        $new_title = $_POST['title'];
        $module = $_POST['module_path'];
        $old_title = $_POST['old_title'];
        $breadcrumb_key = $_POST['breadcrumb_key'];
        $breadcrumb_title = $_POST['breadcrumb_title'];
        echo $breadcrumb_key;
        echo $breadcrumb_title;
       // $this->config_title($module,$_POST['reload_path'],$new_title,$old_title,$breadcrumb_key,$breadcrumb_title);    
    }

    public function check_title_avalibility()
    {  
        $title = $_POST['title'];
        if($this->validate_name($title)){  
             echo '<label class="text-success"><span class="glyphicon glyphicon-ok success_title"></span></label>'; 

        }
        else {  
               echo '<label class="text-danger"><span class="glyphicon glyphicon-remove error_title"></span></label>';  
        }  
    }

   public function validate_name($title) {
        if (!preg_match("/^[A-Za-z\\-\\., \']+$/",$title)) {
            $isValid = false;
        }
        else {
            $isValid = true;
        }
        return $isValid;
    }

    function config_title($module_path, $reload_path , $new_title,$old_title,$breadcrumb_title)
    {

        $exploded_dir = explode('\\', $module_path);
        $view_folder = end($exploded_dir);
        $script = '$data["PageName"] = ('.'"'.$new_title.'"'.');';
        $breadcrumb_script = '$data["breadcrumb"] = array("'.$new_title.'" => "");';
        $exploded = explode('/', $reload_path);
        $controller = ucfirst(end($exploded));
        $view_list = file_get_contents('./application/controllers/content_management/'.$controller .".php");
        $view_list = str_replace('$data["PageName"] = ("'.$old_title.'");',$script, $view_list );
        $view_list = str_replace('$data["breadcrumb"] = array("'.$breadcrumb_title.'" => "");',$breadcrumb_script, $view_list);
        $view_list = str_replace("{dir}",$view_folder, $view_list );

        $file_handle2 = fopen('./application/controllers/content_management/'.$controller .".php", 'w'); 
        fwrite($file_handle2, $view_list);
        fclose($file_handle2);
   
    }

}
