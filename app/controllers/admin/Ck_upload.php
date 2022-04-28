<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ck_upload extends SM_Controller
{

    public function __construct()
    {
        parent::__construct();
		
    }

    ##############################################################################################################
    ## Upload form CKeditor
    ##############################################################################################################
    public function upload_ck()
    {
       // ob_get_level();
       // $getpath = $this->input->get('media');
        $path = 'uploads/media/';

        $config['upload_path']   = './uploads/media/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp|tiff';
        $config['max_size']             = 6000;
		 /*$config['max_width']            = 1024;
		$config['max_height']           = 768;*/

      //  $config['file_name'] = 'file_name';
        $config['remove_spaces'] = TRUE;

        //Form Upload, Drag & Drop
        $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
        if(empty($CKEditorFuncNum))
        {
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            // Drag & Drop
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            header('Content-Type: application/json');

            $this->load->library('upload', $config);
			$this->upload->initialize($config);
            if (!$this->upload->do_upload("upload"))
            {
                $jsondata = array('uploaded'=> 0, 'fileName'=> 'null', 'url'=> 'null');
                echo json_encode($jsondata);
            }
            else
            {
                $img_data = $this->upload->data();
				
                // JPG compression
               /* if($this->upload->data('file_ext') === '.jpg') {
                    $filename = $this->upload->data('full_path');
                    $img = imagecreatefromjpeg($filename);
                    imagejpeg($img, $filename, 80);
                }*/

                $filename = $img_data['file_name'];
                $url =trim(base_url().$path.$filename);
				
				$this->load->model('admin/medias','medias');
				$data=array(
				'media_path'=>'/uploads/media/'.$filename,
				'med_extn'=>$img_data['file_ext']
				);
				$this->medias->add_data($data);
                
                $jsondata = array('uploaded'=> 1, 'fileName'=> $filename, 'url'=> $url);
                echo json_encode($jsondata);
            }
        }
        else
        {
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            // Form Upload
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            $this->load->library('upload', $config);
            if ( !$this->upload->do_upload("upload"))
            {
                echo "<script>alert('Send Fail".$this->upload->display_errors('','')."')</script>";
            }
            else
            {
                $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
                $img_data = $this->upload->data();

                // JPG compression
             /*   if($this->upload->data('file_ext') === '.jpg') {
                    $filename = $this->upload->data('full_path');
                    $img = imagecreatefromjpeg($filename);
                    imagejpeg($img, $filename, 80);
                }*/
				$filename = $img_data['file_name'];
				$this->load->model('admin/medias','medias');
				$data=array(
				'media_path'=>'/uploads/media/'.$filename,
				'med_extn'=>$img_data['file_ext']
				);
				$this->medias->add_data($data);
                $url =trim(base_url().$path.$filename);
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', 'Send OK')</script>";
            }
        }

       // ob_end_flush();
    }
	
	##############################################################################################################
    ## Upload form CKeditor File
    ##############################################################################################################
    public function upload_file()
    {
       // ob_get_level();
       // $getpath = $this->input->get('media');
        $path = 'uploads/media/';

        $config['upload_path']   = './uploads/media/';
        $config['allowed_types'] = 'xls|xlsx|doc|docx|txt|zip|pdf|rar|png|gif|jpg|jpeg|png|bmp|tiff';
        $config['max_size']             = 10000;
		 /*$config['max_width']            = 1024;
		$config['max_height']           = 768;*/

      //  $config['file_name'] = 'file_name';
        $config['remove_spaces'] = TRUE;

        //Form Upload, Drag & Drop
        $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
        if(empty($CKEditorFuncNum))
        {
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            // Drag & Drop
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            header('Content-Type: application/json');

            $this->load->library('upload', $config);
			$this->upload->initialize($config);
            if (!$this->upload->do_upload("upload"))
            {
                $jsondata = array('uploaded'=> 0, 'fileName'=> 'null', 'url'=> 'null');
                echo json_encode($jsondata);
            }
            else
            {
                $img_data = $this->upload->data();
				
                // JPG compression
               /* if($this->upload->data('file_ext') === '.jpg') {
                    $filename = $this->upload->data('full_path');
                    $img = imagecreatefromjpeg($filename);
                    imagejpeg($img, $filename, 80);
                }*/

                $filename = $img_data['file_name'];
                $url =trim(base_url().$path.$filename);
				
				$this->load->model('admin/medias','medias');
				$data=array(
				'media_path'=>'/uploads/media/'.$filename,
				'med_extn'=>$img_data['file_ext']
				);
				$this->medias->add_data($data);
                
                $jsondata = array('uploaded'=> 1, 'fileName'=> $filename, 'url'=> $url);
                echo json_encode($jsondata);
            }
        }
        else
        {
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            // Form Upload
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            $this->load->library('upload', $config);
            if ( !$this->upload->do_upload("upload"))
            {
                echo "<script>alert('Send Fail".$this->upload->display_errors('','')."')</script>";
            }
            else
            {
                $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
                $img_data = $this->upload->data();

                // JPG compression
             /*   if($this->upload->data('file_ext') === '.jpg') {
                    $filename = $this->upload->data('full_path');
                    $img = imagecreatefromjpeg($filename);
                    imagejpeg($img, $filename, 80);
                }*/
				$filename = $img_data['file_name'];
				$this->load->model('admin/medias','medias');
				$data=array(
				'media_path'=>'/uploads/media/'.$filename,
				'med_extn'=>$img_data['file_ext']
				);
				$this->medias->add_data($data);
                $url =trim(base_url().$path.$filename);
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', 'Send OK')</script>";
            }
        }

       // ob_end_flush();
    }
}
