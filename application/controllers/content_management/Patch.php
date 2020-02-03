<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patch extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('sess_email')=='' ) { 
			redirect(base_url("content_management/login"));
		}

		//create table if not exist
		$query = 'CREATE TABLE IF NOT EXISTS cms_version (
			    id INT AUTO_INCREMENT,
			    version_id VARCHAR(255) NOT NULL,
			    PRIMARY KEY (id)
			)  ENGINE=INNODB;';	

		$this->db->query($query);

	}

	public function index()
	{
		
		$this->tmp_dir = './tmp';
		$patch_url = "http://172.29.70.126/cms_patch/?action=update&version=" . $this->input->get("version");
		$response = json_decode(file_get_contents($patch_url),true);
		foreach ($response as $key => $value) {
			$zip_file = "http://172.29.70.126/cms_patch/patch/" . $value[0]['source_path'];

			//download patch
			$this->download($zip_file);


			//extract patch
			$filepath = $this->tmp_dir . "/" . $value[0]['source_path'];
			$destination = './';
			$this->unzip($filepath,$destination);

			//sql patch
			if($value[0]['sql_path']){
				$sql_path = "http://172.29.70.126/cms_patch/patch/" . $value[0]['sql_path'];
				$this->download($sql_path);
				$sqlpathtemp = $this->tmp_dir . "/" . $value[0]['sql_path'];
				$this->run_sql($sqlpathtemp);
			}
			
		}

		//update version in config
		$version_config = '<?php
			$config["version_id"] = "'.$value[0]['version_id'].'";
			$config["version"] = "'.$value[0]['version_code'].'";
		?>';
		$file_handle = fopen('./application/config/cms_version.php', 'w'); 
		fwrite($file_handle, $version_config);
		fclose($file_handle);

		redirect(base_url("content_management"), 'refresh');
	}

	private function run_sql($filepath){
		$sql = file_get_contents($filepath);
		$sqls = explode(';', $sql);
		array_pop($sqls);

		foreach($sqls as $statement){
		    $statment = $statement . ";";
		    $this->db->query($statement);   
		}

		unlink($filepath);
	}

	private function unzip($filepath,$destination)
    {
        $zip = new ZipArchive();
        if ($zip->open($filepath) === TRUE) {
            $tmp = explode('/', $zip->getNameIndex(0));
            $dirname = $tmp[0];
            $zip->extractTo($destination);
            $zip->close();
            unlink($filepath);
             echo 'Patch Extracted : ' . $filepath . PHP_EOL . "<br>";
        } else {
            throw new RuntimeException('Failed to unzip: ' . $filepath);
        }
        
        return $dirname;
    }

	private function download($url)
    {
        $file = file_get_contents($url);
        if ($file === false) {
            throw new RuntimeException("Can't download: $url");
        }
        echo 'Patch Downloaded: ' . $url . PHP_EOL . "<br>";
        
        $urls = parse_url($url);
        $filepath = $this->tmp_dir . '/' . basename($urls['path']);
        file_put_contents($filepath, $file);
        
        return $filepath;
    }

	public function indexz()
	{
		$protected_files = array();

		$count = $this->db->query("SELECT version_id FROM cms_version")->result();
		if(count($count)>0){
			$version_id = $count[0]->version_id;
		} else {
			$version_id = 0;
		}

		$patch_url = "http://10.10.182.80/cmspatch?version=" . $version_id;
		$response = json_decode(file_get_contents($patch_url),true);

		foreach ($response['patch'] as $key => $value) {
			$source = $value['source'];
			$source_size = $this->retrieve_remote_file_size($source);
			$source_content = file_get_contents($source);

			$destination = $value['destination'];
			$destination_size = $this->retrieve_remote_file_size($destination);

			//copy to destination if file not exist
			if(!file_exists($destination)){
				// echo $this->get_path($destination) . "<br>";
				$this->replace($source,$destination);
				echo "Download : " . $destination . "<br>";
			} else {
				//check if conflict on exisiting file
				$destination_content = file_get_contents($destination);
				if($destination_content == $source_content){
					$this->replace($source,$destination);
					echo "Replace : " . $destination . "<br>";
				} else {

					//check if file is important
					if(in_array($destination, $protected_files)){
						echo "Conflict Protected File : " . $destination . "<br>";
					} else {
						$this->replace($source,$destination);
						echo "Replace : " . $destination . "<br>";
					}
					
				}
			}
			
		}

		if($version_id == 0){
			$data = array("version_id"=>1);
		} else {
			$data = array("version_id"=>$response['new_version']);
		}
		$this->db->insert("cms_version", $data); //update new version in database

	}

	function replace($source, $destination)
	{
		$file_handle = fopen($destination, 'w'); 
	    $view_add = file_get_contents($source);
	    fwrite($file_handle, $view_add);
	    fclose($file_handle);
	}

	function get_path($the_url)
	{
	    $array = explode("/", $the_url);
	    $path = array_pop($array);
	    $url = "";
	    for ($j = 0; $j < count($array); $j++) {
		    $url .= $array[$j] . "/";
		}
		return $url;
	}

	function retrieve_remote_file_size($url)
	{
     $ch = curl_init($url);

     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
     curl_setopt($ch, CURLOPT_HEADER, TRUE);
     curl_setopt($ch, CURLOPT_NOBODY, TRUE);

     $data = curl_exec($ch);
     $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

     curl_close($ch);
     return $size;
}

