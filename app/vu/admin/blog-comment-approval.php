<?php
include('temp/header.php');
$parent_comment=$comment->comment_parent;
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div id="loading"></div>
      <div class="card-header">
        <h3 class="card-title">Approve Comment Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/comment/bupdate', array('id'=>'blogupdate')); ?>
       <input type="hidden" name="hid" id="hid" value="<?php echo $comment->id; ?>">			
        <div class="col-md-6">
            <div class="form-group">
              <label for="Project Name" class="col-sm-4">Commenter Name</label>
              <div class="col-sm-8">
              	 <input type="text" class="form-control" value="<?php echo $comment->commenter_nm; ?>" disabled>
               </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="Product" class="col-sm-4">Blog Title</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $comment->blog_title; ?>" disabled>
               </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="Contact No" class="col-sm-4">Contact No</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $comment->commenter_contact; ?>" disabled>
              </div>
            </div>
          
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="Email" class="col-sm-4">Email</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $comment->commenter_email; ?>" disabled>
              </div>
            </div>
          </div>
          <?php
          if($bcomment)
          {
            ?>
            <div class="col-md-6">
              <div class="form-group">
                <label for="Meta Tag" class="col-sm-4">Parent Comment</label>
                <div class="col-sm-8">
                  <textarea  class="form-control"  rows="5" disabled ><?php echo $bcomment->comments; ?></textarea> 
                </div>
                </div>
              </div>
            <?php
          }
          ?>
        <div class="col-md-6">
          <div class="form-group">     
            <label for="Meta Description" class="col-sm-4">Comments</label>
            <div class="col-sm-8">
           		<textarea  class="form-control"  rows="5" disabled ><?php echo $comment->comments; ?></textarea> 
            </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="Approve" class="col-sm-4">Approve</label>
              <div class="col-sm-8">
              	 <select name="status" id="status" class="form-control select2" tabindex="6">
                   <option value="N" <?php if($comment->approval_status=='N'){ echo "SELECTED"; } ?>>No</option>
                   <option value="Y" <?php if($comment->approval_status=='Y'){ echo "SELECTED"; } ?>> Yes</option>
                </select>
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
include('include/comment.php');

?>
