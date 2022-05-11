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
       <?php echo form_open_multipart('admin/administration/adds', array('id'=>'administrationadd')); ?>	
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="adm_nm" id="adm_nm" tabindex="1" class="form-control" value="" maxlength="30" autofocus autocomplete="off">
               </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Designation</label>
              <div class="col-sm-8">
              	 <input type="text" name="adm_desig" id="adm_desig" tabindex="2" class="form-control" value="" maxlength="35" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Subject</label>
              <div class="col-sm-8">
              	 <input type="text" name="subject" id="subject" tabindex="3" class="form-control" value=""  autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Contact No</label>
              <div class="col-sm-8">
              	 <input type="text" name="contact_no" id="contact_no" tabindex="4" maxlength="10" class="form-control" value="" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Extn</label>
              <div class="col-sm-8">
              	 <input type="text" name="extn" id="extn" tabindex="5" class="form-control" value=""  autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Email Id</label>
              <div class="col-sm-8">
              	 <input type="text" name="email_id" id="email_id" tabindex="6" class="form-control" value="" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Photo" class="col-sm-4">Photo</label>
              <div class="col-sm-6">
              	 <input type="file" name="photo_path" id="photo_path" >
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
include('include/administration.php');

?>


