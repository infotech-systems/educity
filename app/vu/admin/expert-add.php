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
       <?php echo form_open_multipart('admin/expert/adds', array('id'=>'expertadd')); ?>	
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="teacher_nm" id="teacher_nm" tabindex="1" class="form-control" value="" maxlength="30" autofocus autocomplete="off">
               </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Expert</label>
              <div class="col-sm-8">
              	 <input type="text" name="faculty" id="faculty" tabindex="2" class="form-control" value="" maxlength="60" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Facebook</label>
              <div class="col-sm-8">
              	 <input type="text" name="facebook" id="facebook" tabindex="3" class="form-control" value=""  autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Twitter</label>
              <div class="col-sm-8">
              	 <input type="text" name="twitter" id="twitter" tabindex="4" class="form-control" value="" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Linkedin</label>
              <div class="col-sm-8">
              	 <input type="text" name="linkedin" id="linkedin" tabindex="5" class="form-control" value=""  autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Instagram</label>
              <div class="col-sm-8">
              	 <input type="text" name="instagram" id="instagram" tabindex="6" class="form-control" value="" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Photo" class="col-sm-4">Photo</label>
              <div class="col-sm-6">
              	 <input type="file" name="photo_path" id="photo_path" >
               </div>
            </div>
         </div> 
      </div>
      <div class="card-footer">
            <input type="submit" name="submit" id="submit" class="btn btn-primary float-right" value="Add">
           
      </div>
    </div>   
  </div>
</div>

<?php
include('temp/footer.php');
include('include/expert.php');

?>

<script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js"></script> 
<script>
    CKEDITOR.replace( 'ckeditor', {
        extraPlugins : 'image2,codesnippet,uploadimage',
        codeSnippet_theme: 'monokai_sublime',
        height: 300,
        enterMode: CKEDITOR.ENTER_BR,
        filebrowserImageUploadUrl : '<?php echo base_url('admin/ck_upload/upload_ck'); ?>/?type=image&path=work'
    });
</script>
