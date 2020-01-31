<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class {name} extends CI_Controller {

	public function index()
	{

		$data['content'] = "site/{folder}/default.php";
		$data['meta'] = array(
			// "title"         =>  "[Page Title]",
			// "description"   =>  $this->Global_model->site_meta_og({menu_id}, '{table}', 'meta_description'),
			// "keyword"       =>  $this->Global_model->site_meta_og({menu_id}, '{table}', 'meta_keywords')
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og({menu_id}, '{table}', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og({menu_id}, '{table}', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og({menu_id}, '{table}', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og({menu_id}, '{table}', 'og_image'),
		);
		$this->load->view("site/layout/template",$data);
	}

	/*{Additional Function}*/

}
