</div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#"><?php echo $soft->soft_nm; ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> <?php echo $soft->soft_ver; ?>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>


<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script src="<?php echo base_url(); ?>assets/admin/js/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/input-mask/jquery.inputmask.js"></script>

<script src="<?php echo base_url(); ?>assets/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/knob/jquery.knob.js"></script>

<script src="<?php echo base_url(); ?>assets/admin/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/fastclick/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/admin/dist/js/pages/dashboard.js"></script>

<script src="<?php echo base_url(); ?>assets/admin/plugins/select2/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/admin/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('.select2').select2()
  });
</script>
<!-- jQuery -->


<script>
  $( document ).ready(function() {
    var global_branch_id=$('#branchID').val();
    if(global_branch_id=='')
    {
      var modal = document.getElementById('magistrateModal');
      var btn = document.getElementById("myBtn");
      var span = document.getElementsByClassName("close")[0];
      var request = $.ajax({
        url: "<?php echo base_url('admin/dashboard/change_branch'); ?>",
        method: "POST",
        data: {global_branch_id:global_branch_id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        dataType: "html",
        success:function(msg) {
          $("#magistrateModal").html(msg);  
      
        },
        error: function(xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
          },
        }); 
      modal.style.display = "block";
    }
  });
  $( "#branch_change").click(function() {
    var global_branch_id=$('#branchID').val();

		var modal = document.getElementById('magistrateModal');
      var btn = document.getElementById("myBtn");
      var span = document.getElementsByClassName("close")[0];
      var request = $.ajax({
        url: "<?php echo base_url('admin/dashboard/change_branch'); ?>",
        method: "POST",
        data: {global_branch_id:global_branch_id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        dataType: "html",
        success:function(msg) {
          $("#magistrateModal").html(msg);  
      
        },
        error: function(xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
          },
        }); 
      modal.style.display = "block";
		
	});	
</script>
</body>
</html>