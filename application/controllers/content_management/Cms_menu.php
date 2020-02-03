
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_menu extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if($this->session->userdata('sess_email')=='' ) { 
			redirect(base_url("content_management/login"));
		}

		$this->hasUnder = array();
	}

	public function menu($id=null,$group=null)
	{
		$data['menu_group'] = '';
		$data['menu_id'] = '';
		if($id)
		{
			$data['menu_id'] = $this->uri->segment(4);
			$data['menu_group'] = $this->uri->segment(5);
		}
		
		$data['title'] = "Content Management - Navigation Menu";
		$data['PageName'] = "Navigation Menu";
		$data['content'] = "content_management/cms_navigation/list";
		$data["breadcrumb"] = array('Navigation Menu' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function menu_add()
	{
		$data['title'] = "Content Management - Navigation Menu";
		$data['PageName'] = "Create Cms Menu";
		$data['content'] = "content_management/cms_navigation/add";
		$data["breadcrumb"] = array('Navigation Menu' => base_url('content_management/cms_menu/menu'),'Create Cms Menu' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function menu_update()
	{
		$this->check_if_has_Under($this->uri->segment(4));
		$data['details'] 	= $this->load->details("cms_menu",$this->uri->segment(4));
		$data['menus']		= $this->Global_model->get_by_list_where_not_in('cms_menu',$this->hasUnder,array('menu_type' => 1));
		$data['hasUnder'] 	= $this->Global_model->get_list_query('cms_menu','menu_status = "1" AND menu_parent_id = "'.$this->uri->segment(4).'"');
		$data['title'] 		= "Content Management - Navigation Menu";
		$data['PageName'] 	= "Update Cms Menu";
		$data['content'] 	= "content_management/cms_navigation/update";
		$data["breadcrumb"] = array('Navigation Menu' => base_url('content_management/cms_menu/menu'),'Update Cms Menu' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function check_if_has_Under($id)
	{
		array_push($this->hasUnder, $id);
		$result = $this->Global_model->get_list_query('cms_menu','menu_parent_id = '.$id);
		if($result)
		{
			foreach ($result as $key => $value) 
			{
				$this->check_if_has_Under($value->id);
			}
		}
	}

    public function update_routes()
    {
        $controller = $_POST['controller'];

        $autoload = '<?php defined("BASEPATH") OR exit("No direct script access allowed");
        //Modified : '.date('Y-m-d H:i:s').'
        $route["default_controller"] = "'.$controller.'";
        $route["content_management"] = "content_management/home";
        $route["404_override"] = "";
        $route["translate_uri_dashes"] = TRUE;
        ';
        $file_handle1 = fopen('./application/config/routes.php', 'w'); 
        fwrite($file_handle1, $autoload);
        fclose($file_handle1);
    }

    public function rename_table()
    {
    	$this->load->dbforge();
    	$this->dbforge->rename_table($_POST['name'],$_POST['name'].date('_Ymd_Hmi'));
    }

}