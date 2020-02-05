<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(__DIR__ . "/vendor/autoload.php");
use GuillermoMartinez\Filemanager\Filemanager;
class File_manager extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if($this->session->userdata('sess_email')=='' ) { 
			redirect(base_url("content_management/login"));
		}
	}

	public function index()
	{
		$data['title'] = "Content Management";
		$data['PageName'] = "File Manager";
		$data['content'] = "content_management/filemanager/page";
		$data["breadcrumb"] = array('File Manager' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function init()
	{
		if(isset($_POST['path'])){
			if($_POST['path'] != ""){
				$path = $_POST['path'];
			} else {
				$path = "./uploads";
			}
			
		} else {
			$path = "./uploads";
		}
		

		$directories = glob($path . '/*' , GLOB_ONLYDIR);
		$result = array();
		foreach ($directories as $value) {
			$result[] = array(
				"name"=>basename($value),
				"text"=>basename($value),
				"iconCls"=>"fa fa-folder directory " . $value,
			);
		}
		echo json_encode($result);
	}

	public function files()
	{
		if(isset($_POST['path'])){
			if($_POST['path'] != ""){
				$path = $_POST['path'];
			} else {
				$path = "./uploads";
			}
			
		} else {
			$path = "./uploads";
		}
		
		$files = glob($path . "/*.*", GLOB_BRACE);

		$result = array();
		foreach ($files as $value) {
			$extension = pathinfo($value, PATHINFO_EXTENSION);
			switch (strtolower($extension)) {
				case 'jpg':
					$icon ='<img class="img-responsive" width=100% src="' . base_url() . '/' .$value.'" />';
					$path_extension = "img";
					break;
				case 'png':
					$icon ='<img class="img-responsive" width=100% src="' . base_url() . '/' .$value.'" />';
					$path_extension = "img";
					break;
				case 'mp4':
					$icon ='<img class="img-responsive" width="50px" src="' . base_url() . 'cms/extensions/'.strtolower($extension).'.png" />';
					$path_extension = "vid";
					# code...
					break;

				default:
					$icon ='<img class="img-responsive" width="50px" src="' . base_url() . 'cms/extensions/'.strtolower($extension).'.png" />';
					$path_extension = "other";
					break;
			}
	       $result[] = array(
				"icon"=>$icon,
				"text"=>basename($value),
				"size"=>$this->file_size_convert(filesize($value)),
				"path"=>$value,
				"file_type"=>$path_extension,
				"modified"=>date ("F d Y H:i:s", filemtime($value))			
			);
		}

		// print_r($result);
		echo json_encode($result);
	}

	public function make_dir()
	{
		$foldername = $_POST['folder'];
		if (!file_exists('./uploads/' . $foldername)) {
		    mkdir('./uploads/' . $foldername, 0777, true);
		    $result = array("status"=>"sucess","message"=>"");
		} else {
			$result = array("status"=>"failed","message"=>"Folder already exist.");
		}

		echo json_encode($result);
	}

	function file_size_convert($bytes)
	{
	    $bytes = floatval($bytes);
	        $arBytes = array(
	            0 => array(
	                "UNIT" => "TB",
	                "VALUE" => pow(1024, 4)
	            ),
	            1 => array(
	                "UNIT" => "GB",
	                "VALUE" => pow(1024, 3)
	            ),
	            2 => array(
	                "UNIT" => "MB",
	                "VALUE" => pow(1024, 2)
	            ),
	            3 => array(
	                "UNIT" => "KB",
	                "VALUE" => 1024
	            ),
	            4 => array(
	                "UNIT" => "B",
	                "VALUE" => 1
	            ),
	        );

	    foreach($arBytes as $arItem)
	    {
	        if($bytes >= $arItem["VALUE"])
	        {
	            $result = $bytes / $arItem["VALUE"];
	            $result = str_replace(".", "." , strval(round($result, 2)))." ".$arItem["UNIT"];
	            break;
	        }
	    }
	    return $result;
	}

	function upload()
	{
		ini_set('max_execution_time', 300);

		$ds = DIRECTORY_SEPARATOR;  //1
		$storeFolder = "./uploads".$_POST['folder'];
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
		    
		}
	}

	function remove_dir()
	{
		$path = "./uploads/" . $_POST['folder'];
		$this->rmdir_recursive($path);
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

	function remove_file()
	{
		$path = $_POST['path'];
		unlink($path);
	}
}
