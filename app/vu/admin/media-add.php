<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/media/adds', array('id'=>'mediaadd')); ?>	
       <input type="hidden" name="media" value="media">
         <div class="col-md-6">
            <div class="form-group">
              <label for="Photo" class="col-sm-4">Media</label>
              <div class="col-sm-6">
              	 <input type="file" name="media_path" id="media_path" placeholder="Include Photo" >
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
include('include/media.php');

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
	$('#event_dt').datepicker({
      autoclose: true
    });
$('#event_dt').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
</script>
