<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Update Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/organization/update', array('id'=>'organizationupdate')); ?>	
        <input type="hidden" name="hid" id="hid" value="<?php echo $orgn->orgn_id; ?>">	
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="orgnname" id="orgnname" tabindex="1" class="form-control" value="<?php echo $orgn->orgn_nm; ?>" maxlength="45" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Contact No" class="col-sm-4">Contact No</label>
              <div class="col-sm-8">
              	 <input type="text" name="cont_per_no" id="cont_per_no" tabindex="3" class="form-control" value="<?php echo $orgn->cont_per_no; ?>" maxlength="10" autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Contact Email" class="col-sm-4">Contact Email</label>
              <div class="col-sm-8">
              	 <input type="text" name="cont_per_email" id="cont_per_email" tabindex="3" class="form-control" value="<?php echo $orgn->cont_per_email; ?>"  autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Address" class="col-sm-4">Address</label>
              <div class="col-sm-8">
                 <textarea name="orgn_addr1" id="orgn_addr1" class="form-control" rows="3"><?php echo $orgn->orgn_addr1; ?></textarea>
               </div>
            </div>
            <div class="form-group">
              <label for="Contact Email" class="col-sm-4">Web Address</label>
              <div class="col-sm-8">
              	 <input type="text" name="web_addr" id="web_addr" tabindex="3" class="form-control" value="<?php echo $orgn->web_addr; ?>"  autocomplete="off">
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
include('include/orgn.php');
?>


