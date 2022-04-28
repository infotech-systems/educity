<?php
include('temp/header.php');
?>
<div class="col-md-12">
  	<div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Expert Information</h3>
          </div>
          <div class="card-body  table-responsive">          		
            <table id="example1" class="table table-hover">
              <thead>
                <tr>
                  <th>Name</th> 
                  <th>Expert</th> 
                  <th>
                    <div class="btn-group float-right">
                      <a href="<?php echo site_url('admin/expert/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                    </div> 
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                if($teachers)
                {
                  foreach($teachers as $teacher):	
                    $id=$teacher['tid'];
                    ?>
                    <tr>
                      <td><?php echo $teacher['teacher_nm']; ?></td>
                      <td><?php echo $teacher['faculty']; ?></td>
                      <td>
                        <div class="btn-group float-right">
                          <a href="<?php echo site_url('admin/expert/edit/'.md5($id)); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                          <a href="<?php echo site_url('admin/expert/delete/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
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
  </div>
<?php
include('temp/footer.php');
?>