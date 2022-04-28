<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div id="loading"></div>
      <div class="card-header">
        <h3 class="card-title">Organization Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/setting/orgn_update', array('id'=>'orgnupdate')); ?>
       <input type="hidden" name="hid" id="hid" value="<?php echo $orgn->orgn_id; ?>">	
        <div class="col-md-6">
          <div class="form-group">
            <label for="Name" class="col-sm-4">Name</label>
            <div class="col-sm-8">
                <input type="text" name="orgn_nm" id="orgn_nm" class="form-control" value="<?php echo $orgn->orgn_nm; ?>" autofocus autocomplete="off">
              </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="ABBR" class="col-sm-4">ABBR</label>
              <div class="col-sm-8">
              	 <input type="text" name="orgn_abbr" id="orgn_abbr" class="form-control" value="<?php echo $orgn->orgn_abbr; ?>" autocomplete="off">
               </div>
            </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Project Office" class="col-sm-4">Address</label>
            <div class="col-sm-8">
              <textarea name="orgn_addr" id="orgn_addr" class="form-control" rows="3" ><?php echo $orgn->orgn_addr1; ?></textarea>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Email" class="col-sm-4">Email</label>
            <div class="col-sm-8">
              <input type="text" name="email_id" id="email_id" class="form-control" value="<?php echo $orgn->email_id; ?>"  autocomplete="off">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Web Address" class="col-sm-4">Web Address</label>
            <div class="col-sm-8">
                <input type="text" name="web_addr" id="web_addr" class="form-control" value="<?php echo $orgn->web_addr; ?>" autocomplete="off">
              </div>
          </div>            
        </div> 
        <div class="col-md-6">
          <div class="form-group">
            <label for="Contact Person" class="col-sm-4">Contact Person</label>
            <div class="col-sm-8">
                <input type="text" name="cont_per" id="cont_per" class="form-control" value="<?php echo $orgn->cont_per; ?>"autocomplete="off">
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Land No" class="col-sm-4">Contact No 1</label>
            <div class="col-sm-8">
                <input type="text" name="cont_per_no" id="cont_per_no" class="form-control" value="<?php echo $orgn->cont_per_no; ?>" autofocus autocomplete="off">
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Contact No" class="col-sm-4">Contact No 2</label>
            <div class="col-sm-8">
                <input type="text" name="cont_per_no2" id="cont_per_no2" class="form-control" value="<?php echo $orgn->cont_per_no2; ?>" autofocus autocomplete="off">
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Contact Email" class="col-sm-4">Contact Email</label>
            <div class="col-sm-8">
                <input type="text" name="cont_per_email" id="cont_per_email" class="form-control" value="<?php echo $orgn->cont_per_email; ?>" autofocus autocomplete="off">
              </div>
          </div>
        </div>           
        <div class="col-md-12">
			    <div class="form-group">
            <label for="Web Address" class="col-sm-4">About Me</label>
          </div>            
        </div> 
        <div class="col-md-12">
          <textarea id="ckeditor" name="ckeditor" rows="10" cols="100" tabindex="6"><?php echo $orgn->about_me; ?></textarea> 
        </div> 
        <div class="col-md-6">
          <div class="form-group">
            <label for="Active Year" class="col-sm-4">Active Year</label>
            <div class="col-sm-8">
                <input type="text" name="active_year" id="active_year" class="form-control" value="<?php echo $orgn->active_year; ?>" autofocus autocomplete="off">
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Logo" class="col-sm-4">Logo</label>
            <?php
            if($orgn->orgn_logo)
            {
              ?>
              <img src="<?php echo base_url($orgn->orgn_logo); ?>" class="col-sm-2">
              <?php
            }
            ?>
            <div class="col-sm-6">
                <input type="file" name="orgn_logo" id="orgn_logo" class="form-control" >
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Logo" class="col-sm-4">Footer Logo</label>
            <?php
            if($orgn->footer_logo)
            {
              ?>
              <img src="<?php echo base_url($orgn->footer_logo); ?>" class="col-sm-2">
              <?php
            }
            ?>
            <div class="col-sm-6">
                <input type="file" name="footer_logo" id="footer_logo" class="form-control" >
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Logo" class="col-sm-4">Icon</label>
            <?php
            if($orgn->favicon)
            {
              ?>
              <img src="<?php echo base_url($orgn->favicon); ?>" class="col-sm-2">
              <?php
            }
            ?>
            <div class="col-sm-6">
                <input type="file" name="favicon" id="favicon" class="form-control" >
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