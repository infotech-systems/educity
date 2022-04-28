<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Facility Information</h3>
      </div>
      <div class="card-body  table-responsive p-0">          		
        <table class="table table-hover" id="example1">
          <tr>
            <th>Name</th> 
            <th>Teacher</th> 
            <th>
                <div class="btn-group float-right">
                    <a href="<?php echo site_url('admin/facility/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                </div> 
             </th>
           </tr>
            <?php
            if($facilities)
            {
                foreach($facilities as $facility):	
                $id=$facility['id'];
                ?>
                <tr>
                    <td><?php echo $facility['facilities_name']; ?></td>
                    <td><?php echo $facility['trainer_name']; ?></td>
                    <td>
                       <div class="btn-group float-right">
                            <a href="<?php echo site_url('admin/facility/edit/'.md5($id)); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                         <a href="<?php echo site_url('admin/facility/delete/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
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