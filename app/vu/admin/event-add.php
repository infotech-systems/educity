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
       <?php echo form_open_multipart('admin/event/adds', array('id'=>'eventadd')); ?>	
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="eventname" id="eventname" tabindex="1" class="form-control" value="" maxlength="50" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Date & Time" class="col-sm-4">Date & Time</label>
              <div class="col-sm-4">
              	 <input type="text" name="event_dt" id="event_dt" tabindex="1" class="form-control" value="" tabindex="3" autocomplete="off">
               </div>
               <div class="col-sm-4">
              	 <input type="text" name="event_time" id="event_time" tabindex="1" class="form-control" value="" tabindex="4" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
         	<div class="form-group">
              <label for="Place" class="col-sm-4">Place</label>
              <div class="col-sm-8">
              	 <input type="text" name="eventplace" id="eventplace" tabindex="1" class="form-control" value="" maxlength="50" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Photo" class="col-sm-4">Photo</label>
              <div class="col-sm-6">
              	 <input type="file" name="event_photo" id="event_photo" placeholder="Include Photo" >
               </div>
            </div>
            
         </div> 
         <div class="col-md-12">
            <textarea id="ckeditor" name="ckeditor" rows="10" cols="100" tabindex="6"></textarea> 
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
include('include/event.php');

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
    $('input[name="event_dt"]').daterangepicker({
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
