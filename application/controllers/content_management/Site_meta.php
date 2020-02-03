
<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Site_meta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("sess_email")=="" ) { 
			redirect(base_url("content_management/login"));
		}
		$this->hasUnder = array();
		$this->metatags = $this->Global_model->get_list_query('cms_metatags','meta_status = "1" && meta_type != "2"');
	}

	public function index()
	{
		$data["title"] = "Content Management";
		$data["PageName"] = ("SEO - ASC");
		$data['edit_title'] = true;
		$data["breadcrumb"] = array('SEO - ASC' => '');
		$data["content"] = "content_management/cms_seo/page";
		$this->load->view("content_management/template/layout", $data);	
	}

	public function add()
	{
		$data["title"] 		= "Content Management";
		$data["PageName"] 	= ucfirst("Add Meta Tags");
		$data['metatags']	= $this->metatags;
		$data["breadcrumb"] = array('SEO - ASC' => base_url('content_management/site_meta'),'Add Meta Tags' => '');
		$data["content"] = "content_management/cms_seo/add";
		$this->load->view("content_management/template/layout", $data);	
	}

	public function edit($id){
		$this->check_if_has_Under($this->uri->segment(4));
		$data['details'] 	= $this->load->details("cms_metatags",$id);
		$data['fixed_url'] 	= '';
		$explodeUrl 		= explode('/', $data['details'][0]->meta_url);
		if(count($explodeUrl) > 1)
		{
			array_pop($explodeUrl);
			$data['fixed_url'] 	= implode('/', $explodeUrl);
		}
		$data["title"] 		= "Content Management";
		$data['menu_id'] 	= $this->uri->segment(4);
		$data['metatags']	= $this->Global_model->get_by_list_where_not_in('cms_metatags',$this->hasUnder,'meta_type = 1');
		$data['hasUnder'] 	= $this->Global_model->get_list_query('cms_metatags','meta_status = "1" AND meta_parent_id = "'.$this->uri->segment(4).'"');
		$data["PageName"] 	= ucfirst("Update Meta Tags") . " - Update";
		$data["breadcrumb"] = array('SEO - ASC' => base_url('content_management/site_meta'),'Update Meta Tags' => '');
		$data["content"] 	= "content_management/cms_seo/edit";
		$this->load->view("content_management/template/layout", $data);	
	}

	public function child()
	{
		$data['title'] 		= "Content Management - Navigation Sub-Menu";
		$data['menu_group'] = $this->uri->segment(5);
		$data['menu_id'] 	= $this->uri->segment(4);
		$data['PageName'] 	= str_replace('%20', ' ', $this->uri->segment(5)) ." - Group Menu";
		$data['content'] 	= "content_management/cms_seo/child";
		$this->load->view('content_management/template/layout', $data);
	}

	public function child_add()
	{
		$data['fixed_url']	= $this->Global_model->get_list_query('cms_metatags','id = '. $this->uri->segment(4))[0]->meta_url;
		$data['title'] 		= "Content Management - Navigation Sub-Menu";
		$data['menu_group'] = $this->uri->segment(5);
		$data['menu_id'] 	= $this->uri->segment(4);
		$data['menu_level']	= $this->Global_model->get_list_query('cms_metatags','id = '. $this->uri->segment(4))[0]->meta_level;
		$data['PageName'] 	= str_replace('%20', ' ', $this->uri->segment(5)) ." - Create Sub Menu";
		$data['content'] 	= "content_management/cms_seo/child_add";
		$this->load->view('content_management/template/layout', $data);
	}

	public function check_if_has_Under($id)
	{
		array_push($this->hasUnder, $id);
		$result = $this->Global_model->get_list_query('cms_metatags','meta_parent_id = '.$id);
		if($result)
		{
			foreach ($result as $key => $value) 
			{
				$this->check_if_has_Under($value->id);
			}
		}
	}

	public function update_meta_level($id,$level,$lastarr='')
	{
		$level = $level+1;
		$this->Global_model->update_data('cms_metatags',array("meta_level" 	=> $level),'id',$id);
		$withChild = $this->Global_model->get_list_query($_POST['table'],'meta_parent_id = "'.$id.'"','meta_level','asc');
		if($withChild)
		{
			foreach ($withChild as $key => $value) 
			{
				$explodeUrl = explode('/', $value->meta_url);
				array_shift($explodeUrl);
				$currentArr = implode('/', $explodeUrl);
				$this->update_meta_level($value->id,$level);
				$data = array(	'meta_level' 	=> $level,
								'meta_url'		=> $_POST['url'].$currentArr);
				$this->Global_model->update_data($_POST['table'],$data,'id',$value->id);
			}
		}
	}

	public function update_meta_tatus($id,$status)
	{
		$withChild = $this->Global_model->get_list_query('cms_metatags','meta_parent_id = "'.$id.'"');
		if($withChild)
		{
			foreach ($withChild as $key => $value) 
			{
				$data = array(	'meta_status' 	=> $status);
				$this->Global_model->update_data('cms_metatags',$data,'id',$value->id);
				$this->update_meta_tatus($value->id,$status);
			}
		}
	}

	//controller_config
}
	    