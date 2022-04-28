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
       <?php echo form_open_multipart('admin/page/adds', array('id'=>'pageadd')); ?>		
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="pagename" id="pagename" tabindex="1" class="form-control" value="" maxlength="50" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Url" class="col-sm-4">Url</label>
              <div class="col-sm-8">
              	 <input type="text" name="page_url" id="page_url" tabindex="3" class="form-control" value="" autofocus autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Publish" class="col-sm-4">Publish</label>
              <div class="col-sm-8">
              	 <select name="page_publish" id="page_publish" class="form-control select2" tabindex="5">
                   <option value="T">Yes </option>
                   <option value="F"> No</option>
                </select>
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Parent Page" class="col-sm-4">Parent Page</label>
              <div class="col-sm-8">
              	 <select name="page_parent" id="page_parent" class="form-control select2" tabindex="2">
                   <option value=""> </option>
                   <?php
                    foreach($pages as $page)
                    {                                       
                        ?>
                        <option value="<?php echo $page['page_id']; ?>">
                            <?php echo $page['page_name']; ?>
                        </option>
                        <?php
                    }
                    ?>                                   
                 </select>
               </div>
            </div>
            <div class="form-group">
              <label for="Position" class="col-sm-4">Position</label>
              <div class="col-sm-8">
              	<input type="text" name="page_serial" id="page_serial" tabindex="4" class="form-control" value="" autocomplete="off">      
               </div>
            </div>
            <div class="form-group">
              <label for="Publish" class="col-sm-4">Parent</label>
              <div class="col-sm-8">
              	 <select name="parent" id="parent" class="form-control select2" tabindex="5">
                   <option value="0">No </option>
                   <option value="1"> Yes</option>
                </select>
               </div>
            </div>
         </div> 
         <div class="col-md-12">
            <div class="form-group">
           		<textarea id="ckeditor" name="ckeditor" rows="10" cols="100" tabindex="6"></textarea> 
           </div>
         </div> 
         <div class="col-md-12">
         	<div class="form-group">
                <label for="Meta Tag" class="col-sm-2">Meta Keywords</label>
                <div class="col-sm-4">
           			<textarea id="meta_tag" name="meta_keywords" class="form-control"  rows="5"  tabindex="7"></textarea> 
                </div>
                <label for="Meta Description" class="col-sm-2">Meta Description</label>
                <div class="col-sm-4">
           			<textarea id="meta_desc" name="meta_desc" class="form-control"  rows="5"  tabindex="8"></textarea> 
                </div>
            </div>
         </div>
         <div class="col-md-12">
         	<div class="form-group">
                <label for="Page Slider" class="col-sm-2">Page Slider</label>
                <div class="col-sm-4">
                  <input type="file" name="page_slider" id="page_slider" placeholder="Include Photo" >
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
include('include/page.php');

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
