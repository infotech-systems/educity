<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Slider Information</h3>
      </div>
      <div class="card-body  table-responsive p-0">          		
        <table class="table table-hover">
          <tr>
            <th>Name</th> 
            <th>Photo</th> 
            <th>
                <div class="btn-group float-right">
                    <a href="<?php echo site_url('admin/slider/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                </div> 
             </th>
           </tr>
            <?php
            if($sliders)
            {
                foreach($sliders as $slider):	
                $id=$slider['slider_id'];
                ?>
                <tr>
                    <td><?php echo $slider['slider_nm']; ?></td>
                    <td><img src="<?php echo base_url($slider['image_path']); ?>" alt="<?php echo $slider['slider_nm']; ?>" style="height:25px;"></td>
                    <td>
                       <div class="btn-group float-right">
                            <a href="<?php echo site_url('admin/slider/edit/'.md5($id)); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                         <a href="<?php echo site_url('admin/slider/delete/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
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