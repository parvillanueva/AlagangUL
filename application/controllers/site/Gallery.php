<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends GS_Controller {

	public function view()
	{

		$event_id =  $this->uri->segment(5);
		$data['content'] = "site/gallery/default";
		$data['meta'] = array(
			"title"         =>  "Gallery",
			"description"   =>  "",
			"keyword"       =>  ""
		);
		
		$data['fb_og'] = array(
			// "type"          =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_type'),
			// "title"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_title'),
			// "description"         =>  $this->Global_model->site_meta_og(38, 'site_menu', 'og_description'),
			// "image"         =>  base_url().$this->Global_model->site_meta_og(38, 'site_menu', 'og_image'),
		);

		$data['active_menu'] = "events";

		$data['photos'] = $this->db->query("SELECT * FROM tbl_program_event_gallery WHERE event_id = " . $event_id)->result();
		
		$this->parser->parse("site/layout/template",$data);
	}

}
