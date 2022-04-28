<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header" id="button_div">
            <h3 class="card-title"> 
            </h3>
            
        </div>
      <div class="card-body  table-responsive">  
        <table id="example3"  class="table table-hover">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Name</th>
                    <th>Contact No</th>
                    <th>Email_id</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($mails)
                {
                    foreach($mails as $mail): 
                        $id=$mail['mail_id'];
                        $mail_time1= DateTime::createFromFormat('Y-m-d H:i:s', $mail['mail_time']); 
                        $mail_time= $mail_time1->format('d/m/Y H:i'); 
                        ?>
                        <tr>
                            <td><?php echo $mail_time; ?></td>
                            <td><?php echo $mail['sender_name']; ?></td>
                            <td><?php echo $mail['mobile_no']; ?></td>
                            <td><?php echo $mail['mail_from']; ?></td>
                            <td><?php echo $mail['mail_content']; ?></td>
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
<script>
$('#example3').DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [
        { extend: "print",title:"Admission Inquiry"},
        { extend: "excel",title:"Admission Inquiry"},
        { extend: "pdf",title:"Admission Inquiry"},
        { extend: "colvis"}
        ]

     }).buttons().container().appendTo('#button_div .card-title:eq(0)');
 
  /*   var oTable = $('#example3').DataTable();
        $('#table_search').keyup(function(){
        oTable.search( $(this).val() ).draw();
    })*/
  </script>