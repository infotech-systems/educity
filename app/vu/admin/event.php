<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Event Information</h3>
      </div>
      <div class="card-body  table-responsive p-0">          		
        <table class="table table-hover" id="example1">
          <tr>
            <th>Date</th> 
            <th>Name</th> 
            <th>
                <div class="btn-group float-right">
                    <a href="<?php echo site_url('admin/event/add/'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                </div> 
             </th>
           </tr>
            <?php
            if($events)
            {
                foreach($events as $event):	
                $id=$event['event_id'];
                ?>
                <tr>
                    <td><?php echo date('d/m/y', strtotime($event['event_date'])); ?></td>
                    <td><?php echo $event['event_title']; ?></td>
                    <td>
                       <div class="btn-group float-right">
                            <a href="<?php echo site_url('admin/event/edit/'.md5($id)); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                         <a href="<?php echo site_url('admin/event/delete/'.md5($id)); ?>" class="btn btn-danger btn-sm" style="margin-left:5px;"><i class="fa fa-trash-o"></i></a>
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