<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Photo Information</h3>
      </div>
      <div class="card-body  table-responsive p-0">  
        <table class="table table-hover" id="example1">
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Photo</th>
            <th>
              <div class="btn-group float-right">
                <a href="<?php echo site_url('admin/photo/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
              </div> 
            </th>
          </tr>
          <?php
          if($photos)
          {
              foreach($photos as $photo): 
                  
            $id=$photo['photo_id'];
			$photo_slug=$photo['photo_slug'];
            $cat_id=$photo['cat_id'];
            ?>
              <tr>
                <td><?php echo $photo['photo_nm']; ?></td>
                <td>
                <?php 
                if($catagorys)
                {
                  foreach($catagorys as $catagory):
                  if($cat_id==$catagory['cat_id'])
                  echo  $catagory['cat_nm'];
                  endforeach; 
                }                            
                ?>
                </td>
                <td>
				<?php 
				if($photo['photo_path'])
				{
					?>
                    <img src="<?php echo base_url($photo['photo_path']); ?>" style="height:25px;">
                    <?php
				}
				?>
                </td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo site_url('admin/photo/edit/'.$photo_slug); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo site_url('admin/photo/delete/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
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