<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/youtube/update', array('id'=>'youtubeupdate')); ?>	
       <input type="hidden" name="hid" id="hid" value="<?php echo $youtube->yt_id; ?>">	

        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Title</label>
              <div class="col-sm-8">
              	 <input type="text" name="yt_title" id="yt_title" tabindex="1" class="form-control" value="<?php echo $youtube->yt_title; ?>" maxlength="30" autofocus autocomplete="off">
               </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Youtube Link</label>
              <div class="col-sm-8">
              	 <input type="text" name="yt_link" id="yt_link" tabindex="2" class="form-control" value="<?php echo $youtube->yt_link; ?>" maxlength="60" autocomplete="off">
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
include('include/youtube.php');

?>
