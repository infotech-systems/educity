<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Menu Information</h3>
      </div>
      <div class="card-body  table-responsive">  
        <table class="table  table-bordered  table-hover" id="example1">
        <thead>
          <tr>
            <th>Name</th>
            <th>Parent</th>
            <th>Serial</th>
            <th>Status</th>
            <th>
              <div class="btn-group float-right">
                <a href="<?php echo site_url('admin/menu/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
              </div> 
            </th>
          </tr>
          </thead>
          <tbody>
          <?php
          if($menus)
          {
              foreach($menus as $menu): 
            $srl=null;      
            $id=$menu['id'];
            $parent_id=$menu['parent_id'];
            $show_menu=$menu['show_menu'];
            $srl=$menu['position'];
            if($show_menu=='1')
            {
            	$show='Show';
            }
            else
            {
           		 $show='Not Show';
            }
            ?>
              <tr>
                <td><?php echo $menu['title']; ?></td>
                <td>
                <?php 
				
                if($parent_id!='0')
                {
					echo $parents[$id]->title;
                }                           
                ?>
                </td>
                <td><?php echo $srl; ?></td>
                <td><?php echo $show; ?></td>
                <td>
                  <div class="btn-group float-right">
                    <a href="<?php echo site_url('admin/menu/edit/'.md5($id)); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo site_url('admin/menu/delete/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
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
      <div class="card-footer clearfix">
      </div>
    </div>    	
  </div>
</div>
  
<?php
include('temp/footer.php');
?>
<script>
  $(function () {
    $("#example1").DataTable();
    });
  });
</script>