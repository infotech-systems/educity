<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Social Information</h3>
      </div>
      <div class="card-body  table-responsive p-0">  
        <table class="table table-hover">
          <tr>
            <th>Name</th>
            <th>
              <div class="btn-group float-right">
                <a href="<?php echo site_url('admin/social/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
              </div> 
            </th>
          </tr>
          <?php
          if($socials)
          {
              foreach($socials as $social): 
                  
              $id=$social['social_id'];
            ?>
              <tr>
                <td><?php echo $social['social_nm']; ?></td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo site_url('admin/social/edit/'.md5($id)); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo site_url('admin/social/delete/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
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