<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="example-modal">
    <div class="modal" >
      <div class="modal-dialog" style="width:100% !important; min-width:400px;">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h4 class="modal-title">Select Branch</h4>
            <?php
            if($global_branch_id):
            ?>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
            <span aria-hidden="true">&times;</span></button>
            <?php
            endif;
            ?>
          </div>
           <?php echo form_open_multipart('admin/dashboard/setbranch', array('id'=>'branchid')); ?>	
          <div class="modal-body" style="width:100% !important; min-width:400px;">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="Ledger Name" class="col-sm-4">Branch</label>
                  <div class="col-sm-8">
                      <select name="branch_id" id="branch_id" class="form-control select2" tabindex="2" require>
                        <option value=""> </option>
                        <?php
                        if($branchs):
                          foreach($branchs as $branch):
                            ?>  
                            <option value="<?php echo $branch['branch_id']; ?>" <?php if($global_branch_id==$branch['branch_id']){ echo "SELECTED"; } ?>><?php echo $branch['branch_nm']; ?> </option>
                            <?php
                          endforeach;
                        endif;
                        ?>
                      </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer" style="width:100% !important; min-width:400px;">
               <input type="submit" name="doc_submit" id="doc_submit" class="btn btn-primary pull-right" value="Submit" tabindex="4">
           </div>
          <?php echo form_close(); ?>	
        </div>
      </div>
    </div>
  </div>
  <script>
	  $(".close").click(function(){
			modal.style.display = "none";
		});
	  /***************************** Start Photo Upload Code with modal ***********************/
	$.fn.enterKey = function (fnc) {
		return this.each(function () {
			$(this).keypress(function (ev) {
				var keycode = (ev.keyCode ? ev.keyCode : ev.which);
				if (keycode == '13') {
					fnc.call(this, ev);
				}
			})
		})
	}
	var modal = document.getElementById('magistrateModal');
	var btn = document.getElementById("myBtn");
	var span = document.getElementsByClassName("close")[0];
  $('#branchid,#close').submit(function(e) {
			e.preventDefault();
			var me = $(this);
			$.ajax({
				url: me.attr('action'),
				type: 'post',
				data: new FormData($(this)[0]),
				 contentType: false,
				processData: false,
				dataType: 'json',
				success: function(response) {
					if (response.success == true) {
            modal.style.display = "none";

						window.location.href = '<?php echo base_url('admin/dashboard'); ?>';
					}
					else {
						
						$.each(response.messages, function(key, value) {
							var element = $('#' + key);
							
							element.closest('div.form-group')
							.removeClass('has-error')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.find('.text-danger')
							.remove();
							
							element.after(value);
						});
					}
				}
			});
		});
</script>

