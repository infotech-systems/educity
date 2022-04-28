<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/blog/bupdate', array('id'=>'bupdate')); ?>
       <input type="hidden" name="hid" id="hid"  value="<?php echo $blog->blog_id; ?>">
		
        <div class="col-md-6">
            <div class="form-group">
              <label for="Title" class="col-sm-4">Title</label>
              <div class="col-sm-8">
              	 <input type="text" name="blog_title" id="blog_title" tabindex="1" class="form-control" value="<?php echo $blog->blog_title; ?>" maxlength="100" autofocus autocomplete="off">
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
                            <option value="<?php echo $tg['tag_id']; ?>" <?php if(in_array($tg['tag_id'],explode(",",$blog->tag_ids))){ echo "SELECTED"; } ?>> <?php echo $tg['tag_desc']; ?></option>
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
                        <option value="<?php echo $cat['cat_id']; ?>" <?php if($cat['cat_id']==$blog->cat_id){ echo "SELECTED"; } ?>><?php echo $cat['cat_nm']; ?></option>
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
              <label for="Approve" class="col-sm-4">Approve</label>
              <div class="col-sm-8">
              	 <select name="approve" id="approve" class="form-control select2" tabindex="2">
                    <option value="N" <?php if($blog->approval_status=='N'){ echo "SELECTED"; } ?>>No</option>
                    <option value="Y" <?php if($blog->approval_status=='Y'){ echo "SELECTED"; } ?>>Yes</option>
                 </select>
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
include('include/blog.php');

?>

