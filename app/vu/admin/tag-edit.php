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
       <?php echo form_open_multipart('admin/tag/update', array('id'=>'tagedit')); ?>	
       <input type="hidden" name="hid" id="hid" tabindex="1" class="form-control" value="<?php echo $tag->tag_id; ?>" maxlength="30" autofocus autocomplete="off">
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="tag_desc" id="tag_desc" tabindex="1" class="form-control" value="<?php echo $tag->tag_desc; ?>" maxlength="30" autofocus autocomplete="off">
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
include('include/tag.php');

?>
