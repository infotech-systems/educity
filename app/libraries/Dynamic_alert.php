<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
 * CodeIgniter
 *
 * @package     Dynamic Alert
 * @author      Surajit Mondal
 * @copyright           Copyright (c) 2017, Infotech Systems.
 * @license     
 * @link        http://www.infotechsystems.in
 * @since       Version 1.0
 * @filesource
 */

 class Dynamic_alert
 {
	 private $ci;

	    function __construct()
		{
			$this->ci =& get_instance();    // get a reference to CodeIgniter.
		}
	 public function build_info()
	 {  

		$html_out = "";
       

          /******************* Start Blog Comment *******************************/
	 	  $blog_array = array();
         $query5=$this->ci->db->select('id,commenter_photo,commenter_nm,comment_time,comments')
                              ->where('approval_status','N')
                              ->get('blog_comments');
         $total_blog= $query5->num_rows();                  
                              
         $query6=$this->ci->db->select('id,commenter_photo,commenter_nm,comment_time,comments')
                              ->where('approval_status','N')
                              ->order_by('comment_time','desc')
                              ->limit('3')
                              ->get('blog_comments');
          if ($query6->num_rows() > 0)
         {
             
             foreach ($query6->result() as $row)
             {
                 $blog[$row->id]['id']                = $row->id;
                 $blog[$row->id]['commenter_nm']   = $row->commenter_nm;
                 $blog[$row->id]['commenter_photo']   = $row->commenter_photo;
                 $blog[$row->id]['comment_time']      = $row->comment_time;
                 $blog[$row->id]['comments']          = $row->comments;
             }
         }
         $query6->free_result();
         $blog_array=  $query6->result();  
         if (is_array($blog_array))
         {
             $html_out .= '<li class="nav-item dropdown">';
             $html_out .= '<a class="nav-link" data-toggle="dropdown" href="#">';
             $html_out .= '<i class="fa  fa-comments"></i>';
             $html_out .= '<span class="badge badge-danger navbar-badge">'.$total_blog.'</span>';
             $html_out .= '</a>';
             $html_out .= '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">';
             foreach ($query6->result() as $blog)
             {
                $comment_url=base_url('admin/comment/pedit/'.md5($blog->id)); 
               
                 if(empty($blog->commenter_photo))
                 {
                     $commenter_photo=base_url('uploads/commenter.jpg');
                 }else
                 {
                     $commenter_photo=base_url($blog->commenter_photo);
                 }
              
 
                  $post_date =strtotime($blog->comment_time);
                  $now = time();
                 $units = 4;
                 $ago_time= timespan($post_date, $now, $units);
                  
                 $html_out .= '<a href="'.$comment_url.'" class="dropdown-item">';
                 $html_out .= '  <div class="media">';
                 $html_out .= '      <img src="'.$commenter_photo.'" alt="'.$blog->commenter_nm.'" class="img-size-50 mr-3 img-circle">';
                 $html_out .= '      <div class="media-body">';
                 $html_out .= '          <h3 class="dropdown-item-title">'.$blog->commenter_nm;
                 $html_out .= '              <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>';
                 $html_out .= '          </h3>';
                 $html_out .= '     <p class="text-sm">'.word_limiter($blog->comments,6).'</p>';
                 $html_out .= '     <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> '.$ago_time.'</p>';
                 $html_out .= '   </div>';
                 $html_out .= ' </div>';
                 $html_out .= '</a>';
                 $html_out .= '<div class="dropdown-divider"></div>';                
              }
              $comment_all=base_url('admin/comment/blog'); 
              $html_out .= '<a href="'.$comment_all.'" class="dropdown-item dropdown-footer">See All Messages</a>'; 
              $html_out .='</div>'."\n"; 
              $html_out .='</li>'."\n";   
         }
         /******************************** End Blog Comment *****************************/

        /******************* Start Mailbox Comment *******************************/
	 	/*$project_array = array();
         $query2=$this->ci->db->select('id,commenter_photo,commenter_nm,comment_time,comments')
                              ->where('approval_status','N')
                              ->get('project_comments');
         $total_project= $query2->num_rows();                  
                              
         $query=$this->ci->db->select('id,commenter_photo,commenter_nm,comment_time,comments')
                              ->where('approval_status','N')
                              ->order_by('comment_time','desc')
                              ->limit('3')
                              ->get('project_comments');
          if ($query->num_rows() > 0)
         {
             
             foreach ($query->result() as $row)
             {
                 $project[$row->id]['id']                = $row->id;
                 $project[$row->id]['commenter_nm']   = $row->commenter_nm;
                 $project[$row->id]['commenter_photo']   = $row->commenter_photo;
                 $project[$row->id]['comment_time']      = $row->comment_time;
                 $project[$row->id]['comments']          = $row->comments;
             }
         }
         $query->free_result();
         $html_out = "";
         $project_array=  $query->result();  
         if (is_array($project_array))
         {
             $html_out .= '<li class="nav-item dropdown">';
             $html_out .= '<a class="nav-link" data-toggle="dropdown" href="#">';
             $html_out .= '<i class="fa fa-commenting"></i>';
             $html_out .= '<span class="badge badge-danger navbar-badge">'.$total_project.'</span>';
             $html_out .= '</a>';
             $html_out .= '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">';
             foreach ($query->result() as $project)
             {
                $comment_url=base_url('admin/comment/pedit/'.md5($project->id)); 
                $comment_all=base_url('admin/comment/project'); 
                 if(empty($project->blogo_photo))
                 {
                     $commenter_photo=base_url('uploads/commenter.jpg');
                 }else
                 {
                     $commenter_photo=base_url($project->commenter_photo);
                 }
               
                  $post_date =strtotime($project->comment_time);
                  $now = time();
                 $units = 4;
                 $ago_time= timespan($post_date, $now, $units);
                  
                 $html_out .= '<a href="'.$comment_url.'" class="dropdown-item">';
                 $html_out .= '  <div class="media">';
                 $html_out .= '      <img src="'.$commenter_photo.'" alt="'.$project->commenter_nm.'" class="img-size-50 mr-3 img-circle">';
                 $html_out .= '      <div class="media-body">';
                 $html_out .= '          <h3 class="dropdown-item-title">'.$project->commenter_nm;
                 $html_out .= '              <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>';
                 $html_out .= '          </h3>';
                 $html_out .= '     <p class="text-sm">'.word_limiter($project->comments,6).'</p>';
                 $html_out .= '     <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> '.$ago_time.'</p>';
                 $html_out .= '   </div>';
                 $html_out .= ' </div>';
                 $html_out .= '</a>';
                 $html_out .= '<div class="dropdown-divider"></div>';                
              }
              $html_out .= '<a href="'.$comment_all.'" class="dropdown-item dropdown-footer">See All Messages</a>'; 
              $html_out .='</div>'."\n"; 
              $html_out .='</li>'."\n";   *
         }*/
         /******************************** End Mailbox Comment *****************************/
        return $html_out;
    } 
 }
 
  
 
 ?>