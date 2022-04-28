<?php 
class Dashboard extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();

        $this->load->helper('file');
        $this->load->helper('download');
		$this->load->library('zip');
	 }
	public function index()
	{
		 $username = $this->session->userdata('user_id');
		 $chk_id = $this->session->userdata('chk_id');
		 $user_type = $this->session->userdata('user_type');


		if($username=='')
		{
			return redirect('admin/login');
		}else{
		$param1='admin/dashboard';
		$data['parent'] = $this->menus->dtls_parent($param1);
		$data['soft']  = $this->soft->soft_dtls();
		$this->load->model('admin/loginmodel');
		$data['login']  = $this->loginmodel->log_time($chk_id);
		$this->load->view('admin/dashboard', $data);
		}
	}
	
	public function dtls($id)
	{
		 $param1='dashboard';
		 $param2='dashboard/dtls';
		 $data['parent'] = $this->menus->dtls_parent($param1);
		 $data['child'] = $this->menus->dtls_method($param2);
		 $contact[] = $this->contacts->dtls($id);
		 $data['contacts'] = $contact;
		 $this->load->view('contact-details',$data);
	}
	
	public function backup()
	{
		$DBUSER=$this->db->username;
        $DBPASSWD=$this->db->password;
        $DATABASE=$this->db->database;
    
        $filename = $DATABASE . "-" . date("Y-m-d_H-i-s") . ".sql";
    
        $this->load->dbutil();
        $db_format=array('format'=>'zip','filename'=>$filename);
        $backup=$this->dbutil->backup($db_format);
        $dbname='backup-on-'.date('Y-m-d').'.zip';
        $save='asset/backup/'.$dbname;
        write_file($save,$backup);
        force_download($dbname,$backup);
	}

}
?>