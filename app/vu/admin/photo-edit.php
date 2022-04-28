<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
    <div id="loading"></div>
      <div class="card-header">
        <h3 class="card-title">Add Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/photo/update', array('id'=>'photoupdate')); ?>		
       <input type="hidden" name="hid" id="hid" value="<?php echo $photos->photo_id; ?>">   
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="photoname" id="photoname" tabindex="1" class="form-control" value="<?php echo $photos->photo_nm; ?>" maxlength="100" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Photo" class="col-sm-4">Photo</label>
              <?php
			  if($photos->photo_path)
			  {
				  ?>
                  <img src="<?php echo base_url($photos->photo_path); ?>" class="col-sm-2">
                  <?php
			  }
			  ?>
              <div class="col-sm-4">
              	 <input type="file" name="photo" id="photo" placeholder="Include Photo" >
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Category" class="col-sm-4">Category</label>
              <div class="col-sm-8">
              	 <select name="category" id="category" class="form-control select2" tabindex="2">
                   <option value=""> </option>
                   <?php
                    foreach($categorys as $category)
                    {                                       
                        ?>
                        <option value="<?php echo $category['cat_id']; ?>" <?php if($photos->cat_id==$category['cat_id']){ echo "SELECTED"; } ?>>
                            <?php echo $category['cat_nm']; ?>
                        </option>
                        <?php
                    }
                    ?>                                   
                 </select>
               </div>
            </div>
         </div> 
         <div class="col-md-12">
            <textarea id="ckeditor" name="ckeditor" rows="10" cols="100" tabindex="6"><?php echo $photos->photo_content; ?></textarea> 
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
include('include/photo.php');

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