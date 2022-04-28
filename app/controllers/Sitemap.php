<?php 
class Sitemap extends SM_Controller
{
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('admin/pages');
	   $this->load->model('admin/services');
	   $this->load->model('admin/products');
	   $this->load->model('admin/projects');
	}
	public function index()
	{
		$data['pages']=$this->pages->page_dtls();
		$data['services'] = $this->services->dtls();
		$data['products'] = $this->products->dtls('4');
		$data['projects'] = $this->projects->dtls('4');
		$this->load->view('sitemap',$data);
	}

}
?>