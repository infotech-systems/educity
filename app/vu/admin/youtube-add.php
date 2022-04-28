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
       <?php echo form_open_multipart('admin/youtube/adds', array('id'=>'youtubeadd')); ?>	
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Title</label>
              <div class="col-sm-8">
              	 <input type="text" name="yt_title" id="yt_title" tabindex="1" class="form-control" value="" maxlength="50" autofocus autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
         	<div class="form-group">
              <label for="Teacher" class="col-sm-4">Youtube Link</label>
              <div class="col-sm-8">
              	 <input type="text" name="yt_link" id="yt_link" tabindex="2" class="form-control" value="" maxlength="50" autofocus autocomplete="off">
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
include('include/youtube.php');

?>
