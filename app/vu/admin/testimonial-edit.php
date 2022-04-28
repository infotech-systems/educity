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
       <?php echo form_open_multipart('admin/testimonial/update', array('id'=>'testimonialupdate')); ?>
       <input type="hidden" name="hid" id="hid" value="<?php echo $testimonial->test_id; ?>">	
       <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="test_name" id="test_name" tabindex="1" class="form-control" value="<?php echo $testimonial->test_name; ?>" maxlength="50" autofocus autocomplete="off">
               </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="Company" class="col-sm-4">Company</label>
              <div class="col-sm-8">
              	 <input type="text" name="company_nm" id="company_nm" tabindex="2" class="form-control" maxlength="50" value="<?php echo $testimonial->company_nm; ?>"  autofocus autocomplete="off">
               </div>
            </div>
        </div>
        <div class="col-md-6">
         	<div class="form-group">
              <label for="Photo" class="col-sm-4">Photo</label>
              <?php 
                if($testimonial->photo_path):
                  ?>
                  <img src="<?php echo base_url($testimonial->photo_path); ?>" class="col-sm-1">
                  <?php
                endif;
                ?>
              <div class="col-sm-6">
                <input type="file" name="photo_path" id="photo_path" tabindex="5"  placeholder="Include Photo" >
              </div>
            </div>
        </div> 
         <div class="col-md-6">
         	<div class="form-group">
                <label for="Comment" class="col-sm-4">Comment</label>
                <div class="col-sm-8">
           			<textarea id="test_comment" name="test_comment" class="form-control"  rows="2"  tabindex="6"><?php echo $testimonial->test_comment; ?></textarea> 
                </div>
                
            </div>
        </div>
    </div>
      <div class="card-footer">
            <input type="submit" name="submit" id="submit" class="btn btn-primary float-right" tabindex="7"  value="Update">
           
      </div>
    </div>   
  </div>
</div>

<?php
include('temp/footer.php');
include('include/testimonial.php');
?>

