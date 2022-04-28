<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
 * CodeIgniter
 *
 * @package     Dynamic Page Menu
 * @author      Surajit Mondal
 * @copyright           Copyright (c) 2017, Infotech Systems.
 * @license     
 * @link        http://www.infotechsystems.in
 * @since       Version 1.0
 * @filesource
 */

class Dynamic_email
{
	private $ci;
	function __construct()
	{
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
    }
	public function send_email($to_nm,$to_email,$subject,$content,$attachments)
	{
         $query2=$this->ci->db->select('cont_per_email')
		                      ->get('orgn_mas');
		 if($query2->num_rows())
		 {
			 $cont_per_email=$query2->row('cont_per_email');
			 
		 }
   
        $this->ci->load->library('email'); // Note: no $config param needed
    	$this->ci->email->from($to_email, $to_nm);
    
    	$this->ci->email->to($cont_per_email);
    	$this->ci->email->subject($subject);
    	$this->ci->email->message($content);
    	$res_email=$this->ci->email->send();
    	return $res_email;
    } 
 }
 
  
 
 ?>