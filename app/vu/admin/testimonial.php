<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Testimonial Information</h3>
      </div>
      <div class="card-body  table-responsive">          		
        <table class="table table-hover table-bordered" id="example1">
        <thead>
          <tr>
            <th>Name</th> 
            <th>Company</th> 
            <th>Photo</th> 
            <th>
                <div class="btn-group float-right">
                    <a href="<?php echo site_url('admin/testimonial/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                </div> 
             </th>
           </tr>
        </thead>  
        <tbody> 
            <?php
            if($testimonials)
            {
                foreach($testimonials as $testimonial):	
                $id=$testimonial['test_id'];
                
                ?>
                <tr>
                    <td><?php echo $testimonial['test_name']; ?></td>
                    <td><?php echo $testimonial['company_nm']; ?></td>
                    <td> 
                    <?php
                    if($testimonial['photo_path']):
                        ?>
                        <img src="<?php echo base_url($testimonial['photo_path']); ?>" style="height:20px;" >
                        <?php
                    endif;
                    ?>
                    </td>
                    <td>
                       <div class="btn-group float-right">
                            <a href="<?php echo site_url('admin/testimonial/edit/'.$id); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                         <a href="<?php echo site_url('admin/testimonial/delete/'.$id); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
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