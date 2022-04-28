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

 class Dynamic_site_menu
 {
	 private $ci;

	    function __construct()
		{
			$this->ci =& get_instance();    // get a reference to CodeIgniter.
		}
	 public function build_page($cur_id2,$cur_id3)
	 {
		$cur_id='';
	 	$page = array();
		if(!empty($cur_id3))
		{
		$cur_id=$cur_id3;
		}
		else
		{
			$query2=$this->ci->db->select('page_id')
		                     ->where(array('page_link'=>$cur_id2))
		                      ->get('page_master');
		 if($query2->num_rows())
		 {
			 $cur_id=$query2->row('page_id');
			 
		 }
		}
		//echo $branch_path;
		 $query=$this->ci->db->select('page_id,page_name,page_link,parent_id,show_tag,is_parent,page_slug')
		                     ->where(array('show_tag'=>'T'))
							//  ->like('dyn_group_id',$hmenu)
							 ->order_by('srl asc')
		                   ->get('page_master');
			//	print_r($query->result());	   
		//	echo $this->ci->db->last_query();				 
		 if ($query->num_rows() > 0)
        {
			
			foreach ($query->result() as $row)
            {
				$page[$row->page_id]['page_id']         = $row->page_id;
				$page[$row->page_id]['page_name']       = $row->page_name;
				$page[$row->page_id]['page_link']       = $row->page_link;
				$page[$row->page_id]['parent_id']       = $row->parent_id;
				$page[$row->page_id]['is_parent']       = $row->is_parent;
				$page[$row->page_id]['page_slug']       = $row->page_slug;
			}
		}
		 $query->free_result();
		 $html_out = "";
		  $menu_array=  $query->result();  
		 foreach ($query->result() as $menu)
         {
			
			 if (is_array($menu_array))
             {
				 if($menu->parent_id == 0)
                 {
					 
					 if($menu->page_link == '')
					 {
						
						 $page_link='/page/details/'.$menu->page_slug;
					 }
					 else
					 {
						 $page_link=$menu->page_link;
					 }
					 if($menu->is_parent)
					 {
						  $page_link='#';
					 }
					if($cur_id==$menu->page_id)
					{
						$current='class="current"';
					}
					else
					{
						$current='';
					}
					
						if($menu->is_parent)
						{
							$html_out .= "\t\t".'<li '.$current.'><a href="#'.url_title($menu->page_name, 'dash', true).'">'.$menu->page_name.' <i class="fa fa-angle-down"></i></a>';
							$parent_id=$menu->page_id;
							$html_out .= $this->get_childs($menu_array,$parent_id);
						}
						else
						{
							 $html_out .= "\t\t".'<li '.$current.'>'.anchor($page_link,$menu->page_name);
						}
						$html_out .="\t".'</li>'."\n";

					}
					
				
				  
			 }
		 }
        return $html_out;
    }  
	
	
	function get_childs($menu_array,$parent_id)
    {
		$has_subcats = FALSE;
        $html_out  = '';
        $html_out .= "\t\t\t\t".'<ul>'."\n";
        
       foreach ($menu_array as $menu2)
       {
			if ($menu2->show_tag=='T' && $menu2->parent_id == $parent_id)    
			{
				$has_subcats = TRUE;
				
				if($menu2->page_link == '')
				{
					$page_link2='/page/details/'.$menu2->page_slug;
				}
				else
				{
					$page_link2=$menu2->page_link;
				}
				if($menu2->is_parent)
				{
					  $page_link2='#';
				}
				
				$html_out .= "\t\t\t\t\t\t".'<li>'.anchor($page_link2,$menu2->page_name);
				$html_out .="\t\t\t\t\t\t".'</li>'."\n";
			}
       }
       $html_out .= "\t\t\t\t\t".'</ul>' . "\n";
       return ($has_subcats) ? $html_out : FALSE;
    }
	
 }
 
  
 
 ?>