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
       <?php echo form_open_multipart('admin/category/update', array('id'=>'categoryupdate')); ?>	
        <input type="hidden" name="hid" id="hid" value="<?php echo $categorys->cat_id; ?>">	
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="catname" id="catname" tabindex="1" class="form-control" value="<?php echo $categorys->cat_nm; ?>" maxlength="50" autofocus="autofocus" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Photo" class="col-sm-4">Photo</label>
              <?php if(!empty($categorys->photo))
			   {
				?>
				 <img src="<?php echo base_url($categorys->photo); ?>" class="col-sm-2">
				
				<?php
			   }
			   ?>
              <div class="col-sm-6">
              	 <input type="file" name="cat_photo" id="cat_photo" placeholder="Include Photo" >
               </div>
            </div>
         </div> 
         <div class="col-md-12">
            <textarea id="ckeditor" name="ckeditor" rows="10" cols="100" tabindex="6"> <?php echo $categorys->cat_content; ?></textarea> 
         </div> 
      </div>
      <div class="card-footer">
            <input type="submit" name="submit" id="submit" class="btn btn-primary float-right" value="Edit">
           
      </div>
    </div>   
  </div>
</div>

<?php
include('temp/footer.php');
include('include/category.php');

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