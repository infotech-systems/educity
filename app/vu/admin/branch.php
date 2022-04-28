<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Branch Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/setting/branch_update', array('id'=>'branchupdate')); ?>
       <input type="hidden" name="hid" id="hid" value="<?php echo $branch->branch_id; ?>">	
        <div class="col-md-6">
          <div class="form-group">
            <label for="Name" class="col-sm-4">Name</label>
            <div class="col-sm-8">
                <input type="text" name="branch_nm" id="branch_nm" class="form-control" value="<?php echo $branch->branch_nm; ?>" autofocus autocomplete="off">
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Contact No" class="col-sm-4">Contact No</label>
            <div class="col-sm-8">
              <input type="text" name="cont_no" id="cont_no" class="form-control" value="<?php echo $branch->cont_no; ?>"  autocomplete="off">
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="Project Office" class="col-sm-2">Address</label>
            <div class="col-sm-10">
              <textarea name="branch_addr" id="branch_addr" class="form-control" rows="3" ><?php echo $branch->branch_addr; ?></textarea>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="Map Address" class="col-sm-2">Map Address</label>
            <div class="col-sm-10">
              <textarea name="map" id="map" class="form-control" rows="3" ><?php echo $branch->map; ?></textarea>
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
</script>