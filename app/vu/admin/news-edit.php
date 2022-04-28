<?php
include('temp/header.php');
if($news->valid_upto)
{
	$news_date=date('d/m/Y', strtotime($news->valid_upto));
}
else
{
	$news_date='';
}

?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
    <div id="loading"></div>
      <div class="card-header">
        <h3 class="card-title">Add Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/news/update', array('id'=>'newsupdate')); ?>	
       <input type="hidden" name="hid" id="hid" value="<?php echo $news->news_id; ?>">   
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="newsname" id="newsname" tabindex="1" class="form-control" value="<?php echo $news->news_title; ?>" maxlength="50" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Photo" class="col-sm-4">Photo</label>
              <?php
			  if($news->attach_file)
			  {
				  ?>
                  <img src="<?php echo base_url($news->attach_file); ?>" class="col-sm-2">
                  <?php
			  }
			  ?>
              <div class="col-sm-6">
              	 <input type="file" name="news_photo" id="news_photo" placeholder="Include Photo" >
               </div>
            </div>
         </div> 
         <div class="col-md-6">
         <div class="form-group">
              <label for="Name" class="col-sm-4">Publisher</label>
              <div class="col-sm-8">
              	 <input type="text" name="publisher" id="publisher" tabindex="1" class="form-control" value="<?php echo $news->news_publisher; ?>" maxlength="50" autofocus autocomplete="off">
               </div>
            </div>
         	 <div class="form-group">
              <label for="Date" class="col-sm-4">Date</label>
              <div class="col-sm-8">
              	 <input type="text" name="news_dt" id="news_dt" class="form-control" value="<?php echo $news_date; ?>" tabindex="2" autocomplete="off">
               </div>
            </div>
            
            
         </div> 
         <div class="col-md-12">
            <textarea id="ckeditor" name="ckeditor" rows="10" cols="100" tabindex="6"><?php echo $news->news; ?></textarea> 
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
include('include/news.php');

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
    $('input[name="news_dt"]').daterangepicker({
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
