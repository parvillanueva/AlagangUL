
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preference extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('sess_email')=='' ) { 
			redirect(base_url("content_management/login"));
		}
	}
	
	public function site()
	{
		$data['title'] = "Content Management - Site information";
		$data['PageName'] = "Site Information";
		$data['content'] = "content_management/site_information/page";
		$data["breadcrumb"] = array('Site Information' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function cms()
	{
		$data['title'] = "Content Management - Preference";
		$data['PageName'] = "Content Management Preferences";
		$data['content'] = "content_management/cms_information/page";
		$data["breadcrumb"] = array('Content Management Preferences' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function database_table()
	{
		$data['title'] = "Content Management - Database";
		$data['PageName'] = "Database Table Generator";
		$data['content'] = "content_management/cms_database/page";
		$data["breadcrumb"] = array('Database Table Generator' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function editor()
	{
		$data['title'] = "Content Management - Editor";
		$data['PageName'] = "Editor";
		$data['content'] = "content_management/cms_editor/page";
		$data["breadcrumb"] = array('Editor' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function navigation()
	{

		switch ($this->uri->segment(4)) {
			case '':
				$data['title'] = "Content Management - Navigation Menu";
				$data['PageName'] = "Content Management Navigation Menu";
				$data['content'] = "content_management/cms_navigation/list";
				$this->load->view('content_management/template/layout', $data);
				break;

			case 'add':
				$data['title'] = "Content Management - Navigation Menu";
				$data['PageName'] = "Create Navigation Menu";
				$data['content'] = "content_management/cms_navigation/add";
				$this->load->view('content_management/template/layout', $data);
				break;

			case 'update':
				$data['title'] = "Content Management - Navigation Menu";
				$data['PageName'] = "Update Navigation Menu";
				$data['content'] = "content_management/cms_navigation/update";
				$this->load->view('content_management/template/layout', $data);
				break;

			case 'child':
				$data['title'] = "Content Management - Navigation Menu";
				$data["menu_group"] = $this->uri->segment(6);
				$data["main_id"] = $this->uri->segment(5);
				$data['PageName'] = urldecode($this->uri->segment(6)) . " - Group Menu";
				$data['content'] = "content_management/cms_navigation/child";
				$this->load->view('content_management/template/layout', $data);
				break;

			case 'child_update':
				$data['title'] = "Content Management - Navigation Menu";
				$data["menu_group"] = $this->uri->segment(6);
				$data["main_id"] = $this->uri->segment(5);
				$data['PageName'] = urldecode($this->uri->segment(6)) . " - Update Sub Menu";
				$data['content'] = "content_management/cms_navigation/child_update";
				$this->load->view('content_management/template/layout', $data);
				break;

				case 'child_add':
				$data['title'] = "Content Management - Navigation Menu";
				$data["menu_group"] = $this->uri->segment(6);
				$data["main_id"] = $this->uri->segment(5);
				$data['PageName'] = urldecode($this->uri->segment(6)) . " - Create Sub Menu";
				$data['content'] = "content_management/cms_navigation/child_add";
				$this->load->view('content_management/template/layout', $data);
				break;

			case 'template':
				$this->load->view('content_management/cms_navigation/template/' . $_POST['template']);
				break;

			case 'save':


				$template = $_POST['template'];
				$menu = $_POST['menu'];
				$icon = $_POST['icon'];
				$data['menu_name'] = strtolower($menu);
				$data['menu_icon'] = $icon;
				if($template == "group"){
					$data['menu_url'] = '#';
					$data['menu_type'] = 1;
				} else {
					$data['menu_type'] = 2;
					$data['menu_url'] = 'content_management/site_' . str_replace(" ", "_", strtolower($menu));
				}
				
				$data['menu_orders'] 		= 1;
				$data['menu_level'] 		=  $_POST['menu_level'];
				$data['menu_created_date'] 	= date('Y-m-d H:i:s');
				$data['menu_updated_date'] 	= date('Y-m-d H:i:s');
				$data['menu_status'] 		= 1;
				$data['menu_parent_id']		= $_POST['parent_id'];

				$data_id = $this->Global_model->save_data("cms_menu",$data);
				echo json_encode($data_id);

				$this->audit_trail_controller("Create", $data);

				$this->load->dbforge();
				if($template == "article_list"){
					$table =  str_replace(" ", "_", $_POST['table']);
					$this->article_list("site_" . $table,str_replace(" ", "_", $menu));
				}

				if($template == "article_date"){
					$table =  str_replace(" ", "_", $_POST['table']);
					$this->article_date("site_" . $table,str_replace(" ", "_", $menu));
				}

				if($template == "article_single"){
					$table =  str_replace(" ", "_", $_POST['table']);
					$this->article_single("site_" . $table,str_replace(" ", "_", $menu));
				}

				if($template == "article_single_banner"){
					$table =  str_replace(" ", "_", $_POST['table']);
					$this->article_single_banner("site_" . $table,str_replace(" ", "_", $menu));
				}

				if($template == "blank"){
					$this->blank("",str_replace(" ", "_", $menu));
				}

				if($template == "simple_crud"){
					$table =  str_replace(" ", "_", $_POST['table']);
					$details = $_POST['form_data'];
					$this->crud($table,str_replace(" ", "_", $menu),$details);
				}


				break;

			case 'update_menu':
				$menu = $_POST['menu'];
				$this->load->dbforge();
				$this->blank("",str_replace(" ", "_", $menu));
				break;

			case 'save_sub':


				$template = $_POST['template'];
				
				$menu = strtolower($_POST['menu']);
				$icon = $_POST['icon'];
				$role = $_POST['role'];
				$status = $_POST['status'];

				$data['menu'] = ucwords($menu);
				if($template == "group"){
					$data['url'] = '#';
				} else {
					$data['url'] = 'content_management/site_' . str_replace(" ", "_", $menu);
				}
				
				$data['orders'] = 1;
				$data['menu_id'] =  $_POST['sub_id'];
				$data['create_date'] = date('Y-m-d H:i:s');
				$data['update_date'] = date('Y-m-d H:i:s');
				$data['status'] = $status;
				$data['role'] = $role;


				$this->Global_model->save_data("cms_menu_sub",$data);
				$this->audit_trail_controller("Create", $data);

				$this->load->dbforge();
				if($template == "article_list"){
					$table =  str_replace(" ", "_", $_POST['table']);
					$this->article_list("site_" . $table,str_replace(" ", "_", $menu));
				}

				if($template == "article_date"){
					$table =  str_replace(" ", "_", $_POST['table']);
					$this->article_date("site_" . $table,str_replace(" ", "_", $menu));
				}

				if($template == "article_single"){
					$table =  str_replace(" ", "_", $_POST['table']);
					$this->article_single("site_" . $table,str_replace(" ", "_", $menu));
				}

				if($template == "article_single_banner"){
					$table =  str_replace(" ", "_", $_POST['table']);
					$this->article_single_banner("site_" . $table,str_replace(" ", "_", $menu));
				}

				if($template == "blank"){
					$this->blank("",str_replace(" ", "_", $menu));
				}

				if($template == "simple_crud"){
					$table =  str_replace(" ", "_", $_POST['table']);
					$details = $_POST['form_data'];
					$this->crud($table,str_replace(" ", "_", $menu),$details);
				}


				break;
			
			default:
				# code...
				break;
		}
		
		
	}

	public function recycler_module($table, $menu)
	{
		$data['table'] = $table;
		$data['module'] = $menu;
		$data['create_date'] = date('Y-m-d H:i:s');
		$data['update_date'] = date('Y-m-d H:i:s');
		$this->Global_model->save_data("cms_module_recycler",$data);
	}

	public function article_date($table,$menu)
	{
		$this->dbforge->add_field(array(
	        'id' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'unsigned' => TRUE,
	            'auto_increment' => TRUE
	        ),
	        'date_from' => array(
	            'type' => 'DATE',
	            'null' => TRUE,
	        ),
	        'date_to' => array(
	            'type' => 'DATE',
	            'null' => TRUE,
	        ),
	        'title' => array(
	            'type' => 'VARCHAR',
	            'constraint' => '255',
	        ),
	        'alias' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'short_description' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'body' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'thumbnail' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'banner_img' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'create_date' => array(
	            'type' => 'DATETIME',
	            'null' => TRUE,
	        ),
	        'update_date' => array(
	            'type' => 'DATETIME',
	            'null' => TRUE,
	        ),
	        'user' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'null' => TRUE,
	        ),
	        'status' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'null' => TRUE,
	        ),
	    ));

		$this->dbforge->add_key('id', TRUE);

		//create table
	    $this->dbforge->create_table($table);

	    //create folders
	    if (!file_exists('./application/views/content_management/module/' . $menu)) {
		    mkdir('./application/views/content_management/module/' . $menu, 0777, true);
		}

	    //create controller
	    $controller = file_get_contents('./cms/templates/article_date/controller/controller.php');
		$controller = str_replace("{title}",strtolower($menu), $controller );
		$controller = str_replace("{title_header}",str_replace('_', ' ', $menu), $controller );
		$controller = str_replace("{table}",$table, $controller );

		$file_handle1 = fopen('./application/controllers/content_management/Site_'.strtolower($menu).'.php', 'w'); 
		fwrite($file_handle1, $controller);
		fclose($file_handle1);

	    //create views
	    $file_handle2 = fopen('./application/views/content_management/module/'.$menu.'/list.php', 'w'); 
	    $file_handle3 = fopen('./application/views/content_management/module/'.$menu.'/add.php', 'w'); 
	    $file_handle4 = fopen('./application/views/content_management/module/'.$menu.'/edit.php', 'w'); 



	    $view_list = file_get_contents('./cms/templates/article_date/views/list.php');
		$view_list = str_replace("{table}",$table, $view_list );
		$view_list = str_replace("{menu}",$menu, $view_list );
	    fwrite($file_handle2, $view_list);
	    fclose($file_handle2);

	    $view_add = file_get_contents('./cms/templates/article_date/views/add.php');
		$view_add = str_replace("{table}", $table, $view_add );
		$view_add = str_replace("{menu}", $menu, $view_add );
	    fwrite($file_handle3, $view_add);
	    fclose($file_handle3);

	    $view_edit = file_get_contents('./cms/templates/article_date/views/edit.php');
		$view_edit = str_replace("{table}", $table, $view_edit );
		$view_edit = str_replace("{menu}", $menu, $view_edit );
	    fwrite($file_handle4, $view_edit);
	    fclose($file_handle4);
	}

	public function crud($table,$menu,$form)
	{

		//create folders
	    if (!file_exists('./application/views/content_management/module/' . $menu)) {
		    mkdir('./application/views/content_management/module/' . $menu, 0777, true);
		}

		//create controller
	    $controller = file_get_contents('./cms/templates/crud/controller/controller.php');
		$controller = str_replace("{title}",strtolower($menu), $controller );
		$controller = str_replace("{title_header}",str_replace('_', ' ', $menu), $controller );
		$controller = str_replace("{table}",$table, $controller );

		$file_handle1 = fopen('./application/controllers/content_management/Site_'.strtolower($menu).'.php', 'w'); 
		fwrite($file_handle1, $controller);
		fclose($file_handle1);


		//create list views
		$html_head = "";
		$html_body = "";
		foreach ($form as $key => $value) {
			if($value['list'] == 1){
				$html_head .= "\n\t\t\t\t\t" . '<th>'.ucwords($value['label']).'</th>';
				$html_body .= "\n\t\t\t\t\t" . 'html += "   <td>" +y.'.$value['field'].'+ "</td>";';
			}
		}

		echo $html_body;

		$file_handle2 = fopen('./application/views/content_management/module/'.$menu.'/list.php', 'w'); 
	    $view_list = file_get_contents('./cms/templates/crud/views/list.php');
		$view_list = str_replace("{table_head}",$html_head, $view_list );
		$view_list = str_replace("{table_body}",$html_body, $view_list );
		$view_list = str_replace("{table}",$table, $view_list );
		$view_list = str_replace("{menu}",$menu, $view_list );
	    fwrite($file_handle2, $view_list);
	    fclose($file_handle2);


	    //create add view
	    $form_body = "";
	    $ckeditor_js = "";
	    $table_field = "";
		foreach ($form as $key => $value) {
			if($value['create'] == 1){

				$required = "";
				if($value['required'] == 1){
					$required = "required";
				}

				if($value['input'] == "textarea"){

					$form_body .=  "\n\t\t\t" . '<div class="form-group">';
					$form_body .=  "\n\t\t\t" . '	<label class="col-sm-2 control-label">'.ucwords($value['label']).'</label>';
					$form_body .=  "\n\t\t\t\t" . '	<div class="col-sm-10">';
					$form_body .=  "\n\t\t\t" . '		<textarea id="'.$value['field'].'" class="form-control '.$required.'" '.$required.' rows=3></textarea>';
					$form_body .=  "\n\t\t\t" . '	</div>';
					$form_body .= "\n\t\t\t" .  '</div>';
					$table_field .= "\n\t\t\t\t\t\t" . $value['field'].' : $("#'.$value['field'].'").val(),';

				} else if ($value['input'] == "date") {
					$form_body .=  "\n\t\t\t" . '<div class="form-group">';
					$form_body .=  "\n\t\t\t" . '	<label class="col-sm-2 control-label">'.ucwords($value['label']).'</label>';
					$form_body .=  "\n\t\t\t\t" . '	<div class="col-sm-7">';
					$form_body .=  "\n\t\t\t" . '		<input type="text" id="'.$value['field'].'" class="form-control '.$required.'" '.$required.' placeholder="'.ucwords($value['label']).'">';
					$form_body .=  "\n\t\t\t" . '	</div>';
					$form_body .= "\n\t\t\t" .  '</div>';
					$ckeditor_js .= "\n\t\t" . "$('#".$value['field']."').datepicker({dateFormat: 'yy-mm-dd',});";
					$table_field .= "\n\t\t\t\t\t\t" . $value['field'].' : $("#'.$value['field'].'").val(),';

				} else if ($value['input'] == "ckeditor") {
					$form_body .=  "\n\t\t\t" . '<div class="form-group">';
					$form_body .=  "\n\t\t\t" . '	<label class="col-sm-2 control-label">'.ucwords($value['label']).'</label>';
					$form_body .=  "\n\t\t\t\t" . '	<div class="col-sm-10">';
					$form_body .=  "\n\t\t\t" . '		<textarea id="ck_'.$value['field'].'" class="form-control '.$required.'" '.$required.' rows=3></textarea>';
					$form_body .=  "\n\t\t\t" . '	</div>';
					$form_body .= "\n\t\t\t" .  '</div>';
					$ckeditor_js .= "\n\t\t" . "CKEDITOR.replace( 'ck_".$value['field']."',{height: '500px'});";
					$table_field .= "\n\t\t\t\t\t\t" . $value['field'].' : CKEDITOR.instances.ck_'.$value['field'].'.getData(),';

				} else {
					$form_body .=  "\n\t\t\t" . '<div class="form-group">';
					$form_body .=  "\n\t\t\t" . '	<label class="col-sm-2 control-label">'.ucwords($value['label']).'</label>';
					$form_body .=  "\n\t\t\t\t" . '	<div class="col-sm-7">';
					$form_body .=  "\n\t\t\t" . '		<input type="'.$value['input'].'" id="'.$value['field'].'" class="form-control '.$required.'" '.$required.' placeholder="'.ucwords($value['label']).'">';
					$form_body .=  "\n\t\t\t" . '	</div>';
					$form_body .= "\n\t\t\t" .  '</div>';
					$table_field .= "\n\t\t\t\t\t\t" . $value['field'].' : $("#'.$value['field'].'").val(),';
				}


				
				
			}
		}

		$file_handle3 = fopen('./application/views/content_management/module/'.$menu.'/add.php', 'w'); 
	    $view_add = file_get_contents('./cms/templates/crud/views/add.php');
		$view_add = str_replace("{form}",$form_body, $view_add );
		$view_add = str_replace("{ckeditor}",$ckeditor_js, $view_add );
		$view_add = str_replace("{table_field}",$table_field, $view_add );
		$view_add = str_replace("{table}",$table, $view_add );
		$view_add = str_replace("{menu}",$menu, $view_add );
	    fwrite($file_handle3, $view_add);
	    fclose($file_handle3);





	    //create edit view
	    $form_body = "";
	    $ckeditor_js = "";
	    $table_field = "";
		foreach ($form as $key => $value) {
			if($value['update'] == 1){

				$required = "";
				if($value['required'] == 1){
					$required = "required";
				}

				if($value['input'] == "textarea"){

					$form_body .=  "\n\t\t\t" . '<div class="form-group">';
					$form_body .=  "\n\t\t\t" . '	<label class="col-sm-2 control-label">'.ucwords($value['label']).'</label>';
					$form_body .=  "\n\t\t\t\t" . '	<div class="col-sm-10">';
					$form_body .=  "\n\t\t\t" . '		<textarea id="'.$value['field'].'" class="form-control '.$required.'" '.$required.' rows=3><?= $details[0]->'.$value['field'].'; ?>"></textarea>';
					$form_body .=  "\n\t\t\t" . '	</div>';
					$form_body .= "\n\t\t\t" .  '</div>';
					$table_field .= "\n\t\t\t\t\t\t" . $value['field'].' : $("#'.$value['field'].'").val(),';

				} else if ($value['input'] == "date") {
					$form_body .=  "\n\t\t\t" . '<div class="form-group">';
					$form_body .=  "\n\t\t\t" . '	<label class="col-sm-2 control-label">'.ucwords($value['label']).'</label>';
					$form_body .=  "\n\t\t\t\t" . '	<div class="col-sm-7">';
					$form_body .=  "\n\t\t\t" . '		<input type="text" id="'.$value['field'].'" class="form-control '.$required.'" '.$required.' placeholder="'.ucwords($value['label']).'" value="<?= $details[0]->'.$value['field'].'; ?>">';
					$form_body .=  "\n\t\t\t" . '	</div>';
					$form_body .= "\n\t\t\t" .  '</div>';
					$ckeditor_js .= "\n\t\t" . "$('#".$value['field']."').datepicker({dateFormat: 'yy-mm-dd',});";
					$table_field .= "\n\t\t\t\t\t\t" . $value['field'].' : $("#'.$value['field'].'").val(),';

				} else if ($value['input'] == "ckeditor") {
					$form_body .=  "\n\t\t\t" . '<div class="form-group">';
					$form_body .=  "\n\t\t\t" . '	<label class="col-sm-2 control-label">'.ucwords($value['label']).'</label>';
					$form_body .=  "\n\t\t\t\t" . '	<div class="col-sm-10">';
					$form_body .=  "\n\t\t\t" . '		<textarea id="ck_'.$value['field'].'" class="form-control '.$required.'" '.$required.' rows=3><?= $details[0]->'.$value['field'].'; ?></textarea>';
					$form_body .=  "\n\t\t\t" . '	</div>';
					$form_body .= "\n\t\t\t" .  '</div>'; 
					$ckeditor_js .= "\n\t\t" . "CKEDITOR.replace( 'ck_".$value['field']."',{height: '500px'});";
					$ckeditor_js .= "\n\t\t" . 'CKEDITOR.instances.ck_'.$value['field'].'.setData("<?= $details[0]->'.$value['field'].'; ?>");';
					$table_field .= "\n\t\t\t\t\t\t" . $value['field'].' : CKEDITOR.instances.ck_'.$value['field'].'.getData(),';

				} else {
					$form_body .=  "\n\t\t\t" . '<div class="form-group">';
					$form_body .=  "\n\t\t\t" . '	<label class="col-sm-2 control-label">'.ucwords($value['label']).'</label>';
					$form_body .=  "\n\t\t\t\t" . '	<div class="col-sm-7">';
					$form_body .=  "\n\t\t\t" . '		<input type="'.$value['input'].'" id="'.$value['field'].'" class="form-control '.$required.'" '.$required.' placeholder="'.ucwords($value['label']).'" value="<?= $details[0]->'.$value['field'].'; ?>">';
					$form_body .=  "\n\t\t\t" . '	</div>';
					$form_body .= "\n\t\t\t" .  '</div>';
					$table_field .= "\n\t\t\t\t\t\t" . $value['field'].' : $("#'.$value['field'].'").val(),';
				}


				
				
			}
		}

		$file_handle4 = fopen('./application/views/content_management/module/'.$menu.'/edit.php', 'w'); 
	    $view_edit = file_get_contents('./cms/templates/crud/views/edit.php');
		$view_edit = str_replace("{form}",$form_body, $view_edit );
		$view_edit = str_replace("{ckeditor}",$ckeditor_js, $view_edit );
		$view_edit = str_replace("{table_field}",$table_field, $view_edit );
		$view_edit = str_replace("{table}",$table, $view_edit );
		$view_edit = str_replace("{menu}",$menu, $view_edit );
	    fwrite($file_handle4, $view_edit);
	    fclose($file_handle4);


	} 

	public function blank($table,$menu)
	{
	    //create folders
	    if (!file_exists('./application/views/content_management/module/' . strtolower($menu))) {
		    mkdir('./application/views/content_management/module/' . strtolower($menu), 0777, true);
		}

	    //create controller
	    $controller = file_get_contents('./cms/templates/blank/controller/controller.php');
		$controller = str_replace("{title}",strtolower($menu), $controller );
		$controller = str_replace("{title_header}",str_replace('_', ' ', $menu), $controller );

		$file_handle1 = fopen('./application/controllers/content_management/Site_'.strtolower($menu).'.php', 'w'); 
		fwrite($file_handle1, $controller);
		fclose($file_handle1);

	    //create views
	    $file_handle2 = fopen('./application/views/content_management/module/'.strtolower($menu).'/page.php', 'w'); 
	    $view_list = file_get_contents('./cms/templates/blank/views/page.php');
		$view_list = str_replace("{menu}",$menu, $view_list );
	    fwrite($file_handle2, $view_list);
	    fclose($file_handle2);
	}

	public function article_single_banner($table,$menu)
	{
		$this->dbforge->add_field(array(
	        'id' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'unsigned' => TRUE,
	            'auto_increment' => TRUE
	        ),
	        'body' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'banner_img' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'create_date' => array(
	            'type' => 'DATETIME',
	            'null' => TRUE,
	        ),
	        'update_date' => array(
	            'type' => 'DATETIME',
	            'null' => TRUE,
	        ),
	        'user' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'null' => TRUE,
	        )
	    ));

		$this->dbforge->add_key('id', TRUE);

		//create table
	    $this->dbforge->create_table($table);

	    //add sample data 
	    $sample_data['body'] = "";
	    $sample_data['banner_img'] = "";
	    $sample_data['create_date'] = date('Y-m-d H:i:s');
	    $sample_data['update_date'] = date('Y-m-d H:i:s');
	    $sample_data['user'] = $this->session->userdata('sess_uid');
	    $this->Global_model->save_data($table,$sample_data);


	    //create folders
	    if (!file_exists('./application/views/content_management/module/' . $menu)) {
		    mkdir('./application/views/content_management/module/' . $menu, 0777, true);
		}

	    //create controller
	    $controller = file_get_contents('./cms/templates/article_single_banner/controller/controller.php');
		$controller = str_replace("{title}",strtolower($menu), $controller );
		$controller = str_replace("{title_header}",str_replace('_', ' ', $menu), $controller );
		$controller = str_replace("{table}",$table, $controller );

		$file_handle1 = fopen('./application/controllers/content_management/Site_'.strtolower($menu).'.php', 'w'); 
		fwrite($file_handle1, $controller);
		fclose($file_handle1);

	    //create views
	    $file_handle2 = fopen('./application/views/content_management/module/'.$menu.'/page.php', 'w'); 

	    $view_list = file_get_contents('./cms/templates/article_single_banner/views/page.php');
		$view_list = str_replace("{table}",$table, $view_list );
		$view_list = str_replace("{menu}",$menu, $view_list );
	    fwrite($file_handle2, $view_list);
	    fclose($file_handle2);
	}

	public function article_single($table,$menu)
	{
		$this->dbforge->add_field(array(
	        'id' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'unsigned' => TRUE,
	            'auto_increment' => TRUE
	        ),
	        'body' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'create_date' => array(
	            'type' => 'DATETIME',
	            'null' => TRUE,
	        ),
	        'update_date' => array(
	            'type' => 'DATETIME',
	            'null' => TRUE,
	        ),
	        'user' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'null' => TRUE,
	        )
	    ));

		$this->dbforge->add_key('id', TRUE);

		//create table
	    $this->dbforge->create_table($table);

	    //add sample data 
	    $sample_data['body'] = "";
	    $sample_data['create_date'] = date('Y-m-d H:i:s');
	    $sample_data['update_date'] = date('Y-m-d H:i:s');
	    $sample_data['user'] = $this->session->userdata('sess_uid');
	    $this->Global_model->save_data($table,$sample_data);


	    //create folders
	    if (!file_exists('./application/views/content_management/module/' . $menu)) {
		    mkdir('./application/views/content_management/module/' . $menu, 0777, true);
		}

	    //create controller
	    $controller = file_get_contents('./cms/templates/article_single/controller/controller.php');
		$controller = str_replace("{title}",strtolower($menu), $controller );
		$controller = str_replace("{title_header}",str_replace('_', ' ', $menu), $controller );
		$controller = str_replace("{table}",$table, $controller );

		$file_handle1 = fopen('./application/controllers/content_management/Site_'.strtolower($menu).'.php', 'w'); 
		fwrite($file_handle1, $controller);
		fclose($file_handle1);

	    //create views
	    $file_handle2 = fopen('./application/views/content_management/module/'.$menu.'/page.php', 'w'); 

	    $view_list = file_get_contents('./cms/templates/article_single/views/page.php');
		$view_list = str_replace("{table}",$table, $view_list );
		$view_list = str_replace("{menu}",$menu, $view_list );
	    fwrite($file_handle2, $view_list);
	    fclose($file_handle2);
	}

	public function article_list($table,$menu)
	{
		$this->dbforge->add_field(array(
	        'id' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'unsigned' => TRUE,
	            'auto_increment' => TRUE
	        ),
	        'title' => array(
	            'type' => 'VARCHAR',
	            'constraint' => '255',
	        ),
	        'alias' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'short_description' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'body' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'thumbnail' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'banner_img' => array(
	            'type' => 'TEXT',
	            'null' => TRUE,
	        ),
	        'create_date' => array(
	            'type' => 'DATETIME',
	            'null' => TRUE,
	        ),
	        'update_date' => array(
	            'type' => 'DATETIME',
	            'null' => TRUE,
	        ),
	        'user' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'null' => TRUE,
	        ),
	        'status' => array(
	            'type' => 'INT',
	            'constraint' => 5,
	            'null' => TRUE,
	        ),
	    ));

		$this->dbforge->add_key('id', TRUE);

		//create table
	    $this->dbforge->create_table($table);

	    //create folders
	    if (!file_exists('./application/views/content_management/module/' . $menu)) {
		    mkdir('./application/views/content_management/module/' . $menu, 0777, true);
		}

	    //create controller
	    $controller = file_get_contents('./cms/templates/article_list/controller/controller.php');
		$controller = str_replace("{title}",strtolower($menu), $controller );
		$controller = str_replace("{title_header}",str_replace('_', ' ', $menu), $controller );
		$controller = str_replace("{table}",$table, $controller );

		$file_handle1 = fopen('./application/controllers/content_management/Site_'.strtolower($menu).'.php', 'w'); 
		fwrite($file_handle1, $controller);
		fclose($file_handle1);

	    //create views
	    $file_handle2 = fopen('./application/views/content_management/module/'.$menu.'/list.php', 'w'); 
	    $file_handle3 = fopen('./application/views/content_management/module/'.$menu.'/add.php', 'w'); 
	    $file_handle4 = fopen('./application/views/content_management/module/'.$menu.'/edit.php', 'w'); 



	    $view_list = file_get_contents('./cms/templates/article_list/views/list.php');
		$view_list = str_replace("{table}",$table, $view_list );
		$view_list = str_replace("{menu}",$menu, $view_list );
	    fwrite($file_handle2, $view_list);
	    fclose($file_handle2);

	    $view_add = file_get_contents('./cms/templates/article_list/views/add.php');
		$view_add = str_replace("{table}", $table, $view_add );
		$view_add = str_replace("{menu}", $menu, $view_add );
	    fwrite($file_handle3, $view_add);
	    fclose($file_handle3);

	    $view_edit = file_get_contents('./cms/templates/article_list/views/edit.php');
		$view_edit = str_replace("{table}", $table, $view_edit );
		$view_edit = str_replace("{menu}", $menu, $view_edit );
	    fwrite($file_handle4, $view_edit);
	    fclose($file_handle4);
	}

	public function audit_trail_controller($action, $new_data = null, $old_data = null)
	{
	    $data2['user_id'] = $this->session->userdata('sess_uid');
	  	$data2['url'] =str_replace(base_url("content_management") . '/', "", $_SERVER['HTTP_REFERER']); ;
	  	$data2['action'] = strip_tags(ucwords($action));
	  	if($new_data != null){
	  		$data2['new_data'] = json_encode($new_data);
	  	}

	  	if($old_data != null){
	  		$data2['old_data'] = json_encode($old_data);
	  	}
	  	
	  	$data2['create_date'] = date('Y-m-d H:i:s'); 
	  	$this->Global_model->save_data('cms_audit_trail',$data2);
	}

	public function get_table_fields()
	{
		$table = $_POST['table'];
		if ($this->db->table_exists($table) )
		{
		  	echo json_encode($this->db->list_fields($table));
		}
	}

	public function create_table()
	{
		$this->load->dbforge();

		//$fields = $_POST['fields'];
		//$fields = json_decode($fields,true);
		//print_r($_POST);

		$dataArray = array();
		$x = 0;
		while($x<$_POST['rowCount']){
			$array[$_POST['field'][$x]] = array(
				'type' => $_POST['type'][$x],
				'constraint' => $_POST['length'][$x],
				);
			if($_POST['null'][$x]=='TRUE'){
				$array[$_POST['field'][$x]]['null'] = TRUE;
			}
			else{
				$array[$_POST['field'][$x]]['null'] = FALSE;
			}
			if($_POST['field'][$x]=='id'){
				$array[$_POST['field'][$x]]['auto_increment'] = TRUE;
			}
			$x++;
		}
		//$array = json_decode(json_encode($fields), true);
		$this->dbforge->add_field($array);
		$this->dbforge->add_key('id', TRUE);

		// //create table
	    $this->dbforge->create_table($_POST['table_name']);
	}

    public function create_view()
    {
        $name = $this->input->post('name');
        $title = $this->input->post('title');
        $menu_id = $this->input->post('menu_id');
        $table = $this->input->post('table');

        //create folders
        if (!file_exists('./application/views/site/' . strtolower($name))) {
            mkdir('./application/views/site/' . strtolower($name), 0777, true);
            mkdir('./application/views/site/' . strtolower($name) . "/asset", 0777, true);
        }

        //create controller
        $controller = file_get_contents('./cms/templates/site/controller.php');
        $controller = str_replace("{folder}", strtolower($name), $controller );
        $controller = str_replace("{name}", ucfirst(strtolower($name)), $controller );
        $controller = str_replace("[Page Title]", ucfirst(strtolower($title)), $controller );
        $controller = str_replace("[page title]", ucfirst(strtolower($title)), $controller );
        $controller = str_replace("{menu_id}", $menu_id, $controller );
        $controller = str_replace("{table}", $table, $controller );

        $file_handle1 = fopen('./application/controllers/'.ucfirst(strtolower($name)).'.php', 'w'); 
        fwrite($file_handle1, $controller);
        fclose($file_handle1);

        //create default.php
        $file_handle2 = fopen('./application/views/site/' . strtolower($name) . "/default.php", 'w'); 
        $view_list = file_get_contents('./cms/templates/site/default.php');
        fwrite($file_handle2, $view_list);
        fclose($file_handle2);

        //create style css
        $file_handle3 = fopen('./application/views/site/' . strtolower($name) . "/asset/style.css", 'w'); 
        $view_list1 = file_get_contents('./cms/templates/site/asset/style.css');
        fwrite($file_handle3, $view_list1);
        fclose($file_handle3);

        //create responsive css
        $file_handle4 = fopen('./application/views/site/' . strtolower($name) . "/asset/responsive.css", 'w'); 
        $view_list2 = file_get_contents('./cms/templates/site/asset/responsive.css');
        fwrite($file_handle4, $view_list2);
        fclose($file_handle4);

        //create js function
        $file_handle5 = fopen('./application/views/site/' . strtolower($name) . "/asset/function.js", 'w'); 
        $view_list3 = file_get_contents('./cms/templates/site/asset/function.js');
        fwrite($file_handle5, $view_list3);
        fclose($file_handle5);
    }

    public function config_email()
    {
    	$protocol = $_POST['protocol'];
    	$host = $_POST['host'];
    	$email = $_POST['email'];
    	$email_sendmail = $_POST['email_sendmail'];
    	$password = $_POST['password'];
    	$port = $_POST['port'];

    	if($protocol == "sendmail"){
    		$config = '<?php defined("BASEPATH") OR exit("No direct script access allowed.");
			$config["protocol"] = "sendmail";
			$config["mailpath"] = "/usr/sbin/sendmail";
			$config["charset"] = "iso-8859-1";
			$config["wordwrap"] = TRUE;
			$config["mailtype"] = "html";
			$config["default_email"] = "'.$email_sendmail.'";';
    	}


    	if($protocol == "smtp"){
    		$config = '<?php defined("BASEPATH") OR exit("No direct script access allowed.");
			$config["useragent"]        = "PHPMailer";
			$config["protocol"]         = "smtp";
			$config["mailpath"]         = "/usr/sbin/sendmail";
			$config["smtp_host"]        = "'.$host.'";
			$config["smtp_user"]        = "'.$email.'";
			$config["default_email"]        = "'.$email.'";
			$config["smtp_pass"]        = "'.$password.'";
			$config["smtp_port"]        = '.$port.';
			$config["smtp_timeout"]     = 300;
			$config["smtp_crypto"]      = "ssl";
			$config["smtp_debug"]       = 3; 
			$config["debug_output"]     = "";
			$config["smtp_auto_tls"]    = true;
			$config["smtp_conn_options"] = array("ssl" => array("verify_peer"=> false,"verify_peer_name" => false,"allow_self_signed" => true)); 
			$config["wordwrap"]         = true;
			$config["wrapchars"]        = 76;
			$config["mailtype"]         = "html";
			$config["charset"]          = "iso-8859-1";
			$config["validate"]         = true;
			$config["priority"]         = 3;
			$config["crlf"]             = "\n";
			$config["newline"]          = "\r\n";
			$config["bcc_batch_mode"]   = false;
			$config["bcc_batch_size"]   = 200;
			$config["encoding"]         = "8bit";
			$config["dkim_domain"]      = "";
			$config["dkim_private"]     = "";
			$config["dkim_private_string"] = "";
			$config["dkim_selector"]    = "";
			$config["dkim_passphrase"]  = ""; 
			$config["dkim_identity"]    = "";';
    	}


    	$file_handle1 = fopen('./application/config/email.php', 'w'); 
		fwrite($file_handle1, $config);
		fclose($file_handle1);
    }

}
