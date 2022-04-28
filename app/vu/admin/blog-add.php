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
       <?php echo form_open_multipart('admin/blog/adds', array('id'=>'blogadd')); ?>		
        <div class="col-md-6">
            <div class="form-group">
              <label for="Title" class="col-sm-4">Title</label>
              <div class="col-sm-8">
              	 <input type="text" name="blog_title" id="blog_title" tabindex="1" class="form-control" value="" maxlength="100" autofocus autocomplete="off">
               </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="Tags" class="col-sm-4">Tags</label>
              <div class="col-sm-8">
              	 <select name="tag_ids[]" id="tag_ids" class="form-control select2"  multiple="multiple"  tabindex="5">
                   <option value=""></option>
                   <?php
                   if($tags):
                        foreach($tags as $tg):
                        ?>
                            <option value="<?php echo $tg['tag_id']; ?>"> <?php echo $tg['tag_desc']; ?></option>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </select>
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Category" class="col-sm-4">Category</label>
              <div class="col-sm-8">
              	 <select name="cat_id" id="cat_id" class="form-control select2" tabindex="2">
                   <option value=""> </option>
                   <?php
                   if($categorys):
                        foreach($categorys as $cat):                                       
                        ?>
                        <option value="<?php echo $cat['cat_id']; ?>">
                            <?php echo $cat['cat_nm']; ?>
                        </option>
                        <?php
                        endforeach;
                    endif;
                    ?>                                   
                 </select>
               </div>
            </div>
        </div>
        <div class="col-md-6">
         	<div class="form-group">
                <label for="Page Slider" class="col-sm-4">Blog Photo</label>
                <div class="col-sm-8">
                  <input type="file" name="blog_photo" id="blog_photo" placeholder="Include Photo" >
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
      </div>
      <div class="card-footer">
            <input type="submit" name="submit" id="submit" class="btn btn-primary float-right" value="Add">
           
      </div>
    </div>   
  </div>
</div>

<?php
include('temp/footer.php');
include('include/blog.php');

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
