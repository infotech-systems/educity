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
       <?php echo form_open_multipart('admin/fact/update', array('id'=>'factupdate')); ?>	
        <input type="hidden" name="hid" id="hid" value="<?php echo $fact->fact_id; ?>">	
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="factname" id="factname" tabindex="1" class="form-control" value="<?php echo $fact->fact_nm; ?>" maxlength="25" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Name" class="col-sm-4">Description</label>
              <div class="col-sm-8">
              	 <input type="text" name="factdesc" id="factdesc" tabindex="3" class="form-control" value="<?php echo $fact->fact_desc; ?>" maxlength="25" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Photo" class="col-sm-4">Icon</label>
          
			   
              <div class="col-sm-8">
              	 <input type="text" name="fact_photo" id="fact_photo" tabindex="4" class="form-control"   value="<?php echo $fact->fact_photo; ?>" >
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
include('include/fact.php');

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
