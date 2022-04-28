<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
 * CodeIgniter
 *
 * @package     Dynamic Recent Blog
 * @author      Surajit Mondal
 * @copyright           Copyright (c) 2017, Infotech Systems.
 * @license     
 * @link        http://www.infotechsystems.in
 * @since       Version 1.0
 * @filesource
 */

 class Dynamic_recent_blog
 {
	 private $ci;

	    function __construct()
		{
			$this->ci =& get_instance();    // get a reference to CodeIgniter.
		}
	 public function build_blog()
	 {
	 	$usefull = array();
		
		 $query=$this->ci->db->select('blog_id,blog_date,blog_title,blog_slug,blogo_photo')
		                     ->where('approval_status','Y')
                             ->order_by('blog_id','desc')
                             ->limit('2')
		                     ->get('blog_mas');
				   
							 
		 if ($query->num_rows() > 0)
        {
			
			foreach ($query->result() as $row)
            {
				$blog[$row->blog_id]['blog_id']           = $row->blog_id;
				$blog[$row->blog_id]['blog_date']         = $row->blog_date;
				$blog[$row->blog_id]['blog_title']        = $row->blog_title;
				$blog[$row->blog_id]['blog_slug']         = $row->blog_slug;
				$blog[$row->blog_id]['blogo_photo']       = $row->blogo_photo;
			}
		}
		 $query->free_result();
		 $html_out = "";
		  $blog_array=  $query->result();  
		 foreach ($query->result() as $blog)
         {

			 if (is_array($blog_array))
             {
               $blog_url=base_url('blog/details/'.$blog->blog_slug); 
                if(empty($blog->blogo_photo))
                {
                    $blogo_photo=base_url('uploads/blog.jpg');
                }else
                {
                    $blogo_photo=base_url($blog->blogo_photo);
                }
                $blog_date2= DateTime::createFromFormat('Y-m-d', $blog->blog_date); 
                 $blog_date= $blog_date2->format('d M Y');  
				 
                $html_out .= ' <div class="media mb-4">';
                $html_out .= '<a class="pr-3" href="'.$blog_url.'">';
                $html_out .= '<img src="'.$blogo_photo.'" alt="'.$blog->blog_title.'">';
                $html_out .= '</a>';
                $html_out .= '<div class="media-body align-self-center">';
                $html_out .= '<p><a href="'.$blog_url.'">'.$blog->blog_title.'</a></p>';
                $html_out .= '<p><i class="fa fa-calendar"></i>'.$blog_date.'</p>';
                $html_out .= '</div>';
                $html_out .='</div>'."\n";   
			 }
		 }
        return $html_out;
    } 
 }
 
  
 
 ?>