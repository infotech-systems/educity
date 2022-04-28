<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Media Information</h3>
      </div>
      <div class="card-body  table-responsive p-0">  
        <table class="table table-hover">
          <tr>
            <th>Path</th>
            <th>
              <div class="btn-group float-right">
                <a href="<?php echo site_url('admin/media/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
              </div> 
            </th>
          </tr>
          <?php
          if($medias)
          {
              foreach($medias as $media): 
                  
              $id=$media['media_id'];
            ?>
              <tr>
                <td><input type="text" class="form-control" value="<?php echo base_url($media['media_path']); ?>" ></td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo site_url('admin/media/delete/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
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