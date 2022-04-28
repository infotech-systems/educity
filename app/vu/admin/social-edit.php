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
       <?php echo form_open_multipart('admin/social/update', array('id'=>'socialupdate')); ?>	
       <input type="hidden" name="hid" id="hid" value="<?php echo $socials->social_id; ?>">   
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="socialname" id="socialname" tabindex="1" class="form-control" value="<?php echo $socials->social_nm; ?>" maxlength="25" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="icon" class="col-sm-4">icon</label>
              <div class="col-sm-8">
              	 <input type="text" name="social_path" id="social_path" tabindex="3" class="form-control" value="<?php echo $socials->social_path; ?>" maxlength="25" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Url" class="col-sm-4">Url</label>
              <div class="col-sm-8">
              	 <input type="text" name="social_url" id="social_url" tabindex="2" class="form-control" value="<?php echo $socials->social_url; ?>" autocomplete="off">
               </div>
            </div>
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
include('include/social.php');

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
