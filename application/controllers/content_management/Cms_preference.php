<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_preference extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();

		$this->submenu = '';
		$this->role = $this->session->userdata('sess_role');
	}
	public function get_title()
	{
		$result = $this->Global_model->get_by_id("cms_preference",1);
		echo $result[0]->cms_title;
	}

	public function get_logo()
	{
		$result = $this->Global_model->get_by_id("cms_preference",1);
		echo $result[0]->cms_logo;
	}

	public function get_skin()
	{
		$result = $this->Global_model->get_by_id("cms_preference",1);
		echo $result[0]->cms_skin;
	}

	public function get_menu()
	{
		$select = 'cms_menu.id,menu_url,menu_name,menu_icon,menu_type,menu_parent_id,menu_level,menu_orders,menu_status,role_id,menu_id,menu_role_read,menu_role_write,menu_role_delete';
		$query = 'menu_status = 1 AND role_id = '.$this->role.' AND menu_level = 1 AND menu_role_read = 1';
		$result = $this->Custom_model->get_menu_list('cms_menu',$select,$query);
		$html = '';
		foreach ($result as $key => $value) 
		{
			$html .= '<li class="treeview menu_checker_'.$value->id.'">';
          	$html .= '<a class="side_drop " href="'.base_url().$value->menu_url.'">';
          	$html .= '  <i class="'.$value->menu_icon.'"></i> <span>'.strtoupper($value->menu_name).'</span>';
			if($value->menu_type == 1){
			    $html .= '  <span class="pull-right-container">';
			    $html .= '    <i class="fa fa-angle-left pull-right"></i>';
			    $html .= '  </span>';
			}
          	$html .= '</a>';
          	if($value->menu_type == 1)
          	{
          		$this->get_sub_menu($value->id);
            	$html .= $this->submenu;
			}
			$html .= '</li>';


		}
		if(	$this->role  == 7){
			$html .= '<li class="treeview">';
	        $html .= ' 	<a class="side_drop" target="_blank" href="' . base_url("content_management/cms_preference/backup") . '">';
	        $html .= '  <i class="fa fa-database"></i><span>DB Backup</span></a>';
	        $html .= '</li>';
			
			$html .= '<li class="treeview">';
	        $html .= ' 	<a class="side_drop" href="#version_patch" data-toggle="modal" data-target="#version_patch">';
	        $html .= ' <i class="fa fa-spinner"></i><span>Check for Updates</span></a>';
	        $html .= '</li>';
		}		


		echo json_encode($html);
	}

	public function get_sub_menu($id)
	{

		$select = 'cms_menu.id,menu_url,menu_name,menu_icon,menu_type,menu_parent_id,menu_level,menu_orders,menu_status,role_id,menu_id,menu_role_read,menu_role_write,menu_role_delete';
		$query = 'menu_status = 1 AND role_id = '.$this->role.' AND menu_role_read = 1 AND menu_parent_id ='.$id.'';
		$result = $this->Custom_model->get_menu_list('cms_menu',$select,$query);
		$html = '';

		$html .= '<ul class="treeview-menu sub_menu">';
        foreach ($result as $key => $value) 
		{
            $html .= '     <li class="treeview menu_checker_'.$value->id.'"><a class="side_drop " href="'.base_url().$value->menu_url.'"> ';
            $html .= '   <span>'.strtoupper($value->menu_name).'</span>';
            if($value->menu_type == 1){
				$html .= '  <span class="pull-right-container">';
				$html .= '    <i class="fa fa-angle-left pull-right"></i>';
				$html .= '  </span>';
            }
            $html .= '       </a>';
            if($value->menu_type == 1)
            {
            	$this->get_sub_menu($value->id);
                $html .= $this->submenu;
            }
            $html .= '     </li>';
        }
        $html .= '</ul>';

        $this->submenu = $html;
	}

    public function backup()
    {
        $result = $this->Global_model->get_by_id("site_information",1);
        $this->load->dbutil();
        $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'database.sql'
              );
        $backup =& $this->dbutil->backup($prefs); 
        $db_name = $result[0]->title . " " . date("Y-m-d H:i:s") .'.zip';
        $this->load->helper('download');
        force_download($db_name, $backup); 
    }

}
