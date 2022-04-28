<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Admission Approval Pending Information</h3>
      </div>
      <div class="card-body  table-responsive p-0">  
        <table class="table table-hover">
          <tr>
          <th>Admission Date</th>

          <th>Name</th>
          <th>Contact No</th>
          <th>Class Name</th>
          <th>Batch Name</th>
           
          </tr>
          <?php
          if($students)
          {
              foreach($students as $student): 
                $id=$student['student_id'];
                $adm_date2= DateTime::createFromFormat('Y-m-d', $student['adm_date']); 
			    $adm_date= $adm_date2->format('d/m/Y'); 
                ?>
                <tr>
                <td><?php echo $adm_date; ?></td>
                <td><?php echo $student['student_name']; ?></td>
                <td><?php echo $student['mobile_no']; ?></td>
                <td><?php echo $student['class_name']; ?></td>
                <td><?php echo $student['batch_title'].'('.$student['batch_desc'].')'; ?></td>
                    <td>
                    
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