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
       <?php echo form_open_multipart('admin/facility/update', array('id'=>'facilityupdate')); ?>	
       <input type="hidden" name="hid" id="hid" value="<?php echo $facility->id; ?>">   
       <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="facilities_name" id="facilities_name" tabindex="1" class="form-control" value="<?php echo $facility->facilities_name; ?>" maxlength="50" autofocus autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
         	<div class="form-group">
              <label for="Teacher" class="col-sm-4">Teacher</label>
              <div class="col-sm-8">
              	 <input type="text" name="trainer_name" id="trainer_name" tabindex="2" class="form-control" value="<?php echo $facility->trainer_name; ?>" maxlength="50" autofocus autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-12">
            <textarea id="ckeditor" name="ckeditor" rows="10" cols="100" tabindex="6"><?php echo $facility->description; ?></textarea> 
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Photo" class="col-sm-4">Photo</label>
              <?php
              if($facility->small_path):
               ?>
               <img src="<?php echo base_url($facility->small_path); ?>" class="col-sm-2">
               <?php
               endif;
               ?>
              <div class="col-sm-6">
              	 <input type="file" name="facilities_path" id="facilities_path" placeholder="Include Photo" >
               </div>
            </div>
            
         </div> 
      </div>
      <div class="card-footer">
            <input type="submit" name="submit" id="submit" class="btn btn-primary float-right" value="Update">
           
      </div>
    </div>   
  </div>
</div>

<?php
include('temp/footer.php');
include('include/facility.php');

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
	
$('#event_dt').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
</script>
