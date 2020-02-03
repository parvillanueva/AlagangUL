<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_manager_2 extends CI_Controller {

	public function get()
	{
		header('Content-Type: application/json');

		$path = "./uploads";
		if(isset($_POST['path'])){
			if($_POST['path'] != ""){
				$path = $_POST['path'];
			}
		}

		$directories = glob($path . '/*' , GLOB_ONLYDIR);
		$result_directories = array();
		foreach ($directories as $value) {
			$result_directories[] = array(
				"value"	=> basename($value)
			);
		}

		$files = glob($path . '/*.*' , GLOB_BRACE);
		$result_files = array();
		foreach ($files as $value) {
			$result_files[] = array(
				"value"	=> basename($value)
			);
		}

		$path = str_replace("./", "", $path);
		$path_array = explode("/", $path);
		$result_path = array();
		$path_actual = ".";
		foreach ($path_array as $key => $value) {
			$path_actual .=  "/" . $value;
			$result_path[] = array(
				"path"	=> $path_actual,
				"value"	=> $value,
			);
		}

		$return = array(
			'current_path' 	=> $path_actual, 
			'path' 			=> $result_path, 
			'directories' 	=> $result_directories, 
			'files' 		=> $result_files, 
		);
		
		echo json_encode($return);
	}

	public function create_folder()
	{
		header('Content-Type: application/json');

		$foldername = preg_replace('/[^A-Za-z0-9\-]/', '_', $_POST['folder']);
		$path = $_POST['path'];
		$data = $_POST['data'];
		if (!file_exists($path . "/" . $foldername)) {
		    mkdir($path . "/" . $foldername, 0777, true);
		    $result = array("success" => true,"path" => $path );
		    $this->file_manager_audit_trail("Create", $data);
		} else {
			$result = array("success" => false,"message" => "Folder already exist.");
		}

		echo json_encode($result);
	}

	public function search_file($folder, $pattern) {
        $rdi = new RecursiveDirectoryIterator($folder);

        foreach(new RecursiveIteratorIterator($rdi) as $file){
            if(strpos($file , $pattern) !== false){
               return $file;
            }
        }

        return false;
    }

	public function rename_file()
	{
		header('Content-Type: application/json');

		$file_name = $_POST['file_name'];

		$new_file_name = $_POST['new_file_name'];
		$path = $_POST['path'];

		$old_data = [['path' => $path, 'file_name' => strtolower($file_name)]];
		$new_data = ['path' => $path, 'file_name' => strtolower($new_file_name)];

		$count = 0;
		$in_use = 0;
		$counter_checker = [];
		
		$table = $this->db->list_tables();
		foreach ($table as $tbl) {
			$db_fields = $this->db->list_fields($tbl);
			if ($tbl == 'cms_audit_trail') {
				continue;
			}

			foreach($db_fields as $dbf) {
				$this->db->select("*");
				$this->db->from($tbl);
				$this->db->like($dbf, $file_name);
				$query = $this->db->get();
				$count = $query->num_rows();
				array_push($counter_checker, $count);
			}
		}

		if (in_array(1, $counter_checker)) {
			$in_use = 1;	
		} else {
			$in_use = 0;
		}

		if (!empty($new_file_name) || $new_file_name !== NULL) {

			$searched_file = $this->search_file('uploads/', $new_file_name);
			$filtered_files = (string) $searched_file;

			if ($in_use == 1) {
				$result = array("success" => false,"message" => "This file is in use currently.", "in_use" => $in_use);
			} else {
				if (!empty($filtered_files)) {
					$result = array("success" => false,"message" => "Filename already exist.");
				} else {
					if (file_exists($path . "/" . $file_name)) {
						rename($path . "/" . $file_name, $path . "/" . $new_file_name);
						$result = array("success" => true,"path" => $path, "new_file_name" => $new_file_name);
						$this->file_manager_audit_trail("Rename", $new_data, $old_data);
					} else {
						$result = array("success" => false,"message" => "File does not exist.");
					}
				}
			}

			echo json_encode($result);
		}
	}

	function upload()
	{
		ini_set('max_execution_time', 300);

		$ds = DIRECTORY_SEPARATOR;  //1
		$storeFolder = $_POST['path'];
		$data = ['data' => ['path' => $storeFolder]];
		echo $storeFolder;
		if (!empty($_FILES)) {
		    $tempFile = $_FILES['file']['tmp_name'];          //3             
		    $targetPath =  $storeFolder . $ds;  //4
		    $targetFile =  $targetPath. str_replace(" ", "_", strtolower($_FILES['file']['name']));  //5
		    move_uploaded_file($tempFile,$targetFile); //6
		    $browser = get_browser(null, true);
		    if($browser == "IE"){
		    	redirect(base_url("content_management/file_manager"));
		    }

		    $this->file_manager_audit_trail("Create", $data);
		}
	}

	function upload_compress()
	{
		ini_set('max_execution_time', 300);
		$this->load->library('Compress');

		$ds = DIRECTORY_SEPARATOR;
		$storeFolder = $this->input->post('path');
		$data = ['path' => $storeFolder, 'filename' => strtolower($_FILES['file']['name'])];
		echo $storeFolder;
		if (!empty($_FILES)) {

			//Setting values
		    $file = $_FILES['file']['tmp_name'];
		    $new_file = str_replace(" ", "_", strtolower($_FILES['file']['name']));
		    $quality = $this->input->post('quality');
			$png_quality = 9;
			$destination = $storeFolder . $ds;

			//Uploading first
			$target_file = $destination . $new_file;
		    move_uploaded_file($file,$target_file);

		    if($quality != 0){
			    //Then compressing the uploaded
				$compress = new Compress();
				$compress->file_url = base_url() . $destination . $new_file;
				$compress->new_name_image = $new_file;
				$compress->quality = $quality;
				$compress->pngQuality = $png_quality;
				$compress->destination = base_url() . $destination;
				$result = $compress->compress_image();
			}

		    $browser = get_browser(null, true);
		    if($browser == "IE"){
		    	redirect(base_url("content_management/file_manager"));
		    }

		    $this->file_manager_audit_trail("Create", $data);
		}
	}

	function remove_file()
	{
		$path = $_POST['path'];
		$data = $_POST['data'];
		$file_name = basename($data['path']);
		$old_data = [['path' => dirname($path), 'file_name' => $file_name]];
		$new_data = ['path' => dirname($path), 'file_name' => $file_name.' (deleted)'];

		$count = 0;
		$in_use = 0;
		$counter_checker = [];
		
		$table = $this->db->list_tables();
		foreach ($table as $tbl) {
			$db_fields = $this->db->list_fields($tbl);
			if ($tbl == 'cms_audit_trail') {
				continue;
			}
			
			foreach($db_fields as $dbf) {
				$this->db->select("*");
				$this->db->from($tbl);
				$this->db->like($dbf, $file_name);
				$query = $this->db->get();
				$count = $query->num_rows();
				array_push($counter_checker, $count);
			}
		}

		if (in_array(1, $counter_checker)) {
			$in_use = 1;	
		} else {
			$in_use = 0;
		}

		if ($in_use == 1) {
			$result = array("success" => false,"message" => "This file is in use currently.", "in_use" => $in_use);
		} else {
			unlink($path);
			$result = array("success" => true,"message" => "File deleted.", "in_use" => $in_use);
			$this->file_manager_audit_trail("Delete", $new_data, $old_data);
		}

		echo json_encode($result);
	}

	function remove_dir()
	{
		$path = $_POST['path'];
		$data = $_POST['data'];
		$folder_name = basename($data['path']);
		$old_data = [['path' => dirname($path), 'folder_name' => $folder_name]];
		$new_data = ['path' => dirname($path), 'folder_name' => $folder_name.' (deleted)'];

		$count = 0;
		$in_use = 0;
		$counter_checker = [];
		
		$table = $this->db->list_tables();
		foreach ($table as $tbl) {
			$db_fields = $this->db->list_fields($tbl);
			if ($tbl == 'cms_audit_trail') {
				continue;
			}
			foreach($db_fields as $dbf) {
				$this->db->select("*");
				$this->db->from($tbl);
				$this->db->like($dbf, $folder_name);
				$query = $this->db->get();
				$count = $query->num_rows();
				array_push($counter_checker, $count);
			}
		}

		if (in_array(1, $counter_checker)) {
			$in_use = 1;	
		} else {
			$in_use = 0;
		}

		if ($in_use == 1) {
			$result = array("success" => false,"message" => "This file is in use currently.", "in_use" => $in_use);
		} else {
			$this->rmdir_recursive($path);
			$result = array("success" => true,"message" => "File deleted.", "in_use" => $in_use);
			$this->file_manager_audit_trail("Delete", $new_data, $old_data);
		}

		echo json_encode($result);
	}

	function rmdir_recursive($dir)
	{
	    $it = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
	    $it = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
	    foreach($it as $file) {
	        if ($file->isDir()) rmdir($file->getPathname());
	        else unlink($file->getPathname());
	    }
	    rmdir($dir);
	}

	public function file_manager_audit_trail($action, $new_data = null, $old_data = null)
	{
	    $data2['user_id'] = $this->session->userdata('sess_uid');
	  	$data2['url'] =str_replace(base_url("content_management") . '/', "", $_SERVER['HTTP_REFERER']);
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

	public function audit_trail()
	{
	    $data['user_id'] = $this->session->userdata('sess_uid');
	  	$data['url'] =str_replace(base_url("content_management") . '/', "", rtrim($_POST['uri'],"#")); ;
	  	$data['action'] = strip_tags(ucwords($_POST['action']));
	  	$data['create_date'] = date('Y-m-d H:i:s'); 
	  	$table = 'cms_audit_trail';
	  	$this->Global_model->save_data($table,$data);
	}

	public function check_mime($file){

		$mimes = array(
			'image/png',
			'image/x-png',
			'image/jpeg',
			'image/pjpeg',
			'image/gif',
			'video/mp4',
			'application/pdf',
			'application/force-download',
			'application/x-download',
			'binary/octet-stream',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/zip',
			'application/msword',
			'application/x-zip',
			'text/plain',
			'application/vnd.ms-excel',
			'application/msexcel',
			'application/x-msexcel',
			'application/x-ms-excel',
			'application/x-excel',
			'application/x-dos_ms_excel',
			'application/xls',
			'application/x-xls',
			'application/excel',
			'application/download',
			'application/vnd.ms-office',
			'text/x-comma-separated-values',
			'text/comma-separated-values',
			'application/octet-stream',
			'application/x-csv',
			'text/x-csv',
			'text/csv',
			'application/csv',
			'application/vnd.msexcel',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
		);

		$foo = 0;

		foreach($mimes as $mime){
			if(mime_content_type($file)  == $mime){
				$foo++;
			}
		}

		return $foo;
	}
	
}