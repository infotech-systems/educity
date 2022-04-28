<?php 
class Signout extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	 }
	public function index()
	{
		 $this->session->sess_destroy();
		 return redirect('admin/login');
		
		
	}
}
?>