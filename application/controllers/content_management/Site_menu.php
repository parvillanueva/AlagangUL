
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('sess_email')=='' ) { 
			redirect(base_url("content_management/login"));
		}

		$this->hasUnder = array();
	}
	
	public function menu($id=null,$group=null){
		$data['menu_group'] = '';
		$data['menu_id'] = '';
		if($id){
			$data['menu_id'] = $this->uri->segment(4);
			$data['menu_group'] = $this->uri->segment(5);
		}
		$data['title'] = "Content Management - Site Menu";
		$data['PageName'] = "Site Menu";
		$data['content'] = "content_management/site_menu/list";
		$data["breadcrumb"] = array('Site Menu' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function menu_add()
	{
		$data['order'] 		= 0;
		$data['parentid']	= 0;
		$data['level']		= 0;
		$data['menu_group']	= 0;
		$data['menu_type'] = "";

		if($this->uri->segment(4))
		{
			$result = $this->Global_model->get_list_query('site_menu','id = "'.$this->uri->segment(4).'"');
			$data['parentid']	= $this->uri->segment(4);
			$data['order'] 		= $result[0]->menu_orders;
			$data['level'] 		= $result[0]->menu_level;
			$data['menu_group'] = $result[0]->menu_name;
			$data['menu_type']	= $result[0]->menu_type;
		}

		$data['title'] = "Content Management - Navigation Menu";
		$data['PageName'] = "Create Site Menu";
		$data['content'] = "content_management/site_menu/add";
		$data["breadcrumb"] = array('Site Menu' => base_url('content_management/site_menu/menu'),'Create Site Menu' => '');
		$this->load->view('content_management/template/layout', $data);
	}

	public function menu_update()
	{
		$result = $this->Global_model->get_list_query('site_menu','id = "'.$this->uri->segment(4).'"');
			$data['parentid']	= $this->uri->segment(4);
			$data['order'] 		= $result[0]->menu_orders;
			$data['level'] 		= $result[0]->menu_level;
			$data['menu_group'] = $result[0]->menu_name;
			$data['menu_type']	= $result[0]->menu_type;

			$this->check_if_has_Under($this->uri->segment(4));
			$data['details'] 	= $this->load->details("site_menu",$this->uri->segment(4));
			$data['menus']		= $this->Global_model->get_by_list_where_not_in('site_menu',$this->hasUnder,array('menu_type' => "Group Menu"));
			$data['hasUnder'] 	= $this->Global_model->get_list_query('site_menu','menu_status = "1" AND menu_parent_id = "'.$this->uri->segment(4).'"');

			$data['title'] = "Content Management - Navigation Menu";
			$data['PageName'] = "Update Site Menu";
			$data['content'] = "content_management/site_menu/edit";
			$data["breadcrumb"] = array('Site Menu' => base_url('content_management/site_menu/menu'),'Update Site Menu' => '');
		$this->load->view('content_management/template/layout', $data);
	}


	public function shop_list(){
		$data['title'] = "Content Management - Shop List";
		$data['PageName'] = "Shop List";
		$data["breadcrumb"] = array('Shop List' => '');
		$data['content'] = "content_management/site_menu/shop/list";
		$this->load->view('content_management/template/layout', $data);
	}

	public function shop_add(){
		$data['title'] = "Content Management - Shop Now";
		$data['PageName'] = "Create Shop Now";
		$data["breadcrumb"] = array('Shop List' => base_url('content_management/site_menu/shop_list'),'Create Shop Now' => '');
		$data['content'] = "content_management/site_menu/shop/add";
		$this->load->view('content_management/template/layout', $data);
	}

	public function shop_edit()
	{
		$data['title'] = "Content Management - Shop Now";
		$data['PageName'] = "Update Shop Now";
		$data["breadcrumb"] = array('Shop List' => base_url('content_management/site_menu/shop_list'),'Update Shop Now' => '');
		$data['content'] = "content_management/site_menu/shop/edit";
		$this->load->view('content_management/template/layout', $data);
	}

	public function check_if_has_Under($id)
	{
		array_push($this->hasUnder, $id);
		$result = $this->Global_model->get_list_query('site_menu','menu_parent_id = '.$id);
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

}