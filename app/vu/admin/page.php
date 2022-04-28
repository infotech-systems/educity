<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Page Information</h3>
      </div>
      <div class="card-body  table-responsive">  
        <table id="example1" class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Parent</th>
              <th>Serial</th>
              <th>Status</th>
              <th>
                <div class="btn-group float-right">
                  <a href="<?php echo site_url('admin/page/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                </div> 
              </th>
            </tr>
          </thead>
          <tbody>
          <?php
          if($pages)
          {
              foreach($pages as $page): 
            $srl=null;      
            $id=$page['page_id'];
            $parent_id=$page['parent_id'];
            $show_tag=$page['show_tag'];
            $srl=$page['srl'];
            if($show_tag=='T')
            {
            $show='Published';
            }
            else
            {
            $show='Not Published';
            }
            ?>
              <tr>
                <td><?php echo $page['page_name']; ?></td>
                <td>
                <?php 
                if($parent_id!='0')
                {
                  foreach($allpages as $page):
                  if($parent_id==$page['page_id'])
                  echo  $page['page_name'];
                  endforeach; 
                }                            
                ?>
                </td>
                <td><?php echo $srl; ?></td>
                <td><?php echo $show; ?></td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo site_url('admin/page/edit/'.md5($id)); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo site_url('admin/page/delete/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
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
  
<?php
include('temp/footer.php');
?>