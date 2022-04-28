<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">User Information</h3>
      </div>
      <div class="card-body  table-responsive p-0">  
        <table class="table table-hover">
          <tr>
            <th>Name</th>
            <th>User ID</th>
            <th>Contact No</th>
            <th>Type</th>
            <th>Status</th>
            <th>Photo</th>
            <th>
              <div class="btn-group float-right">
                <a href="<?php echo site_url('admin/user/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
              </div> 
            </th>
          </tr>
          <?php
          if($users)
          {
              foreach($users as $user): 
                  
            $id=$user['uid'];
            $status=$user['status'];
            if($status=='A')
            {
            $active='Active';
            }
            else
            {
            $active='Deactive';
            }
            if($status=='P')
            {
            $active='Approval Pending';
            }
			$user_type=$user['user_type'];
			if($user_type=='A')
            {
            $type='Admin';
            }
            else
            {
            $type='General';
            }
            ?>
              <tr>
                <td><?php echo $user['user_nm']; ?></td>
                <td><?php echo $user['user_id']; ?></td>
                <td><?php echo $user['user_cont_no']; ?></td>
                <td><?php echo $type; ?></td>
                <td><?php echo $active; ?></td>
                <td>
				<?php
				 if($user['photo_path'])
				 {
					 ?>
                     <img src="<?php echo base_url($user['photo_path']); ?>" height="25px">
                     <?php
				 }
				 ?>
                 </td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo site_url('admin/user/edit/'.md5($id)); ?>" class="btn btn-info btn-sm"  style="margin-left:5px;" alt="Edit" title="Edit"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo site_url('admin/user/permission/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"  alt="Permission" title="Permission"><i class="fa fa-key"></i></a>
                  </div> 
                </td>
              </tr>
              <?php 
               endforeach;
            }
            ?>
            
        </table>
      </div>
      <div class="card-footer clearfix">
        <?php  echo $this->pagination->create_links(); ?>
      </div>
    </div>    	
  </div>
</div>
  
<?php
include('temp/footer.php');
?>