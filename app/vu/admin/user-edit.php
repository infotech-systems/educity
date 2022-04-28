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
       <?php echo form_open_multipart('admin/user/update', array('id'=>'userupdate')); ?>
       <input type="hidden" name="hid" id="hid" value="<?php echo $user->uid; ?>">	
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="user_nm" id="user_nm" tabindex="1" class="form-control" value="<?php echo $user->user_nm; ?>" maxlength="25" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Password" class="col-sm-4">Password</label>
              <div class="col-sm-8">
              	 <input type="password" name="pwd" id="pwd" tabindex="3" class="form-control" value=""  autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Type" class="col-sm-4">Type</label>
              <div class="col-sm-8">
				<select name="user_type" id="user_type" class="form-control select2" tabindex="5">
                   <option value="G" <?php if($user->user_type=='G'){ echo "SELECTED"; } ?>>General </option>
                   <option value="A" <?php if($user->user_type=='A'){ echo "SELECTED"; } ?>> Admin</option>
                   <option value="C" <?php if($user->user_type=='C'){ echo "SELECTED"; } ?>> Client</option>
                </select>
               </div>
            </div>
            <div class="form-group">
              <label for="Contact Email" class="col-sm-4">Contact Email</label>
              <div class="col-sm-8">
              	 <input type="text" name="mail_id" id="mail_id" tabindex="7" class="form-control" value="<?php echo $user->mail_id; ?>" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
         	<div class="form-group">
              <label for="User ID" class="col-sm-4">User ID</label>
              <div class="col-sm-8">
              	 <input type="text" name="user_id" id="user_id" tabindex="2" class="form-control" value="<?php echo $user->user_id; ?>" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group" >
              <label for="Photo" class="col-sm-4">Photo</label>
              <?php
              if($user->photo_path)
              {
                ?>
                        <img src="<?php echo base_url($user->photo_path); ?>" class="col-sm-2" height="40px">
                        <?php
              }
              ?>
              <div class="col-sm-6">
              	 <input type="file" name="user_photo" id="user_photo" placeholder="Include Photo" tabindex="4">
               </div>
            </div>
            <div class="form-group">
              <label for="Contact No" class="col-sm-4">Contact No</label>
              <div class="col-sm-8">
              	 <input type="text" name="user_cont_no" id="user_cont_no" tabindex="6" class="form-control" value="<?php echo $user->user_cont_no; ?>" maxlength="10" autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Status" class="col-sm-4">Status</label>
              <div class="col-sm-8">
				        <select name="status" id="status" class="form-control select2" tabindex="5">
                   <option value="A" <?php if($user->status=='A'){ echo "SELECTED"; } ?>>Active </option>
                   <option value="D" <?php if($user->status=='D'){ echo "SELECTED"; } ?>> Deactive</option>
                   <option value="P" <?php if($user->status=='P'){ echo "SELECTED"; } ?>> Approval Pending</option>
                </select>
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
include('include/user.php');

?>
