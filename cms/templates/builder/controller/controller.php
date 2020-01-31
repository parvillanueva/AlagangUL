public function add()
{
	$data["title"] = "Content Management";
	$data["PageName"] = ("{title_header}");
	$data["content"] = "content_management/module/{title}/add";
	$this->load->view("content_management/template/layout", $data);	
}

public function update()
{
	$data["title"] = "Content Management";
	$data["PageName"] = ("{title_header}");
	$data["content"] = "content_management/module/{title}/edit";
	$this->load->view("content_management/template/layout", $data);	
}