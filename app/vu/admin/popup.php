<?php
include('temp/header.php');
$valid_date=null;
if($popup):
$valid_date2= DateTime::createFromFormat('Y-m-d', $popup->valid_date); 
$valid_date= $valid_date2->format('d/m/Y');  
endif;  
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
    <div id="loading"></div>
      <div class="card-header">
        <h3 class="card-title">Add Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/popup/adds', array('id'=>'popupadd')); ?>
       <input type="hidden" name="pop_id" id="pop_id"  value="<?php if($popup){ echo $popup->pop_id; }  ?>" >
	
       <div class="col-md-6">
            <div class="form-group">
              <label for="Title" class="col-sm-4">Title</label>
              <div class="col-sm-8">
              	 <input type="text" name="pop_title" id="pop_title" autocomplete="off" tabindex="1" class="form-control" value="<?php if($popup){ echo $popup->pop_title; }  ?>" >
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Valid Upto" class="col-sm-4">Valid Upto</label>
              <div class="col-sm-8">
              	 <input type="text" name="valid_date" id="valid_date" autocomplete="off" tabindex="1" class="form-control" value="<?php echo $valid_date; ?>" >
               </div>
            </div>
         </div> 
         <div class="col-md-12">
            <textarea id="ckeditor" name="ckeditor" rows="10" cols="100"><?php if($popup){ echo $popup->pop_content; }  ?></textarea> 
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
include('include/popup.php');

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
    var date2 = new Date();
$('input[name="valid_date"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    timePicker: false,
    timePicker24Hour: true,
    timePickerIncrement: 1,
    autoApply: true,
    format: 'DD/MM/YYYY',
   // maxDate:date2,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'))
}, function(start, end, label) {

    var years = moment().diff(start, 'years');
    //alert("You are " + years + " years old!");
});
</script>
