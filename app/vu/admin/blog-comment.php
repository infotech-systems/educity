<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Blog Comment Information</h3>
      </div>
      <div class="card-body  table-responsive">          		
        <table class="table table-hover table-bordered" id="example1">
        <thead>
          <tr>
            <th>Name</th> 
            <th>Blog Title</th> 
            <th>Comments</th> 
            <th>Approve</th> 
            <th>#</th>
           </tr>
        </thead>  
        <tbody> 
            <?php
            
            if($comments)
            {
                foreach($comments as $comment):	
                $id=md5($comment['id']);
                if($comment['approval_status']=='N')
                {
                    $status='No';
                }
                else
                {
                    $status='Yes';
                }
                
                ?>
                <tr>
                    <td><?php echo $comment['commenter_nm']; ?></td>
                    <td><?php echo $comment['blog_title']; ?></td>
                    <td><?php echo $comment['comments']; ?></td>
                    <td><?php echo $status; ?></td>
                    <td>
                       <div class="btn-group float-right">
                            <a href="<?php echo site_url('admin/comment/bedit/'.$id); ?>" class="btn btn-info btn-sm"><i class="fa fa-check"></i></a>
                         <a href="<?php echo site_url('admin/comment/bdelete/'.$id); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
                       </div> 
                    </td>

                </tr>
                 <?php 
                 endforeach;
                }
                ?>
              </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
$(function () {
$("#example1").DataTable({
    "order":[[3,"asc"]]
});
});
</script>
<?php
include('temp/footer.php');
?>
