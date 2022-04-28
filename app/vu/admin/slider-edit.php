<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div id="loading"></div>
      <div class="card-header">
        <h3 class="card-title">Edit Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/slider/update', array('id'=>'sliderupdate')); ?>	
        <input type="hidden" name="hid" id="hid" value="<?php echo $sliders->slider_id; ?>">	
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="slidername" id="slidername" tabindex="1" class="form-control" value="<?php echo $sliders->slider_nm; ?>" maxlength="50" autofocus="autofocus" autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Publish" class="col-sm-4">Publish</label>
              <div class="col-sm-8">
              	 <select name="slider_publish" id="slider_publish" class="form-control select2" tabindex="5">
                   <option value="T" <?php if($sliders->show_tag=='T'){ echo "SELECTED"; } ?>>Yes </option>
                   <option value="F" <?php if($sliders->show_tag=='F'){ echo "SELECTED"; } ?>> No</option>
                </select>
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Photo" class="col-sm-4">Photo</label>
              <?php if(!empty($sliders->image_path))
			   {
				?>
				 <img src="<?php echo base_url($sliders->image_path); ?>" class="col-sm-2">
				
				<?php
			   }
			   ?>
              <div class="col-sm-6">
              	 <input type="file" name="slider_photo" id="slider_photo" placeholder="Include Photo" >
               </div>
            </div>
         </div> 
         <div class="col-md-12">
            <textarea id="ckeditor" name="ckeditor" rows="10" cols="100" tabindex="6"> <?php echo $sliders->slider_content; ?></textarea> 
         </div> 
      </div>
      <div class="card-footer">
            <input type="submit" name="submit" id="submit" class="btn btn-primary float-right" value="Edit">
           
      </div>
      <?php echo form_close(); ?>
    </div>   
  </div>
</div>

<?php
include('temp/footer.php');
include('include/slider.php');
?>

<script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js"></script> 
<script>
    CKEDITOR.replace( 'ckeditor', {
        extraPlugins : 'image2,codesnippet,uploadimage,filebrowser',
        codeSnippet_theme: 'monokai_sublime',
        height: 300,
        enterMode: CKEDITOR.ENTER_BR,
		filebrowserUploadUrl: '<?php echo base_url('admin/ck_upload/upload_file'); ?>/?type=file',
        filebrowserImageUploadUrl : '<?php echo base_url('admin/ck_upload/upload_ck'); ?>/?type=image&path=work',
		filebrowserBrowseUrl : '<?php echo base_url('admin/media/browser'); ?>/?type=image',
		//filebrowserBrowseUrl : '<?php echo base_url(); ?>assets/admin/plugins/ckeditor/plugins/imagebrowser/browser/browser.html?type=image',
	
		filebrowserWindowWidth: '640',
    	filebrowserWindowHeight: '480'
		
    });
</script>