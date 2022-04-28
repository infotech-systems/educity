<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Blog Information</h3>
      </div>
      <div class="card-body  table-responsive p-0">  
        <table class="table table-hover">
          <tr>
            <th>Date</th>
            <th>Title</th>
            <th>Author</th>
            <th>Status</th>
            <th>
              <div class="float-right">#</div> 
            </th>
          </tr>
          <?php
          if($blogs)
          {
              foreach($blogs as $blog): 
                $id=$blog['blog_id'];
                $blog_slug=$blog['blog_slug'];
                $blog_date1= DateTime::createFromFormat('Y-m-d', $blog['blog_date']); 
			          $blog_date= $blog_date1->format('d/m/Y'); 
                $approval_status=$blog['approval_status'];
                if($approval_status=='Y')
                {
                $status='Approved';
                }
                else
                {
                $status='Pending Approved';
                }
                ?>
                <tr>
                    <td><?php echo $blog_date; ?></td>
                    <td><?php echo $blog['blog_title']; ?></td>
                    <td><?php echo $blog['user_nm']; ?></td>
                    <td><?php echo $status; ?></td>
                    <td>
                    <div class="btn-group float-right">
                        <a href="<?php echo site_url('admin/blog/approved/'.md5($id)); ?>" class="btn btn-info btn-sm"><i class="fa  fa-check-square-o"></i></a>
                        <a href="<?php echo site_url('admin/blog/delete/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
                    </div> 
                    </td>
                </tr>
                <?php 
               endforeach;
            }
            ?>
            
        </table>
      </div>
    </div>    	
  </div>
</div>
  
<?php
include('temp/footer.php');
?>