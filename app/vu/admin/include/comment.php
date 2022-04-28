<script language="javascript">
  
	$('#blogupdate').submit(function(e) {
		$("#loading").addClass('overlay dark');
    	$("#loading").html('<i class="fa fa-spinner fa-pulse"></i>');
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
				$("#loading").removeClass('overlay dark');
            	$("#loading").fadeOut();

				if (response.success == true) {
					alertify.alert(response.message, function(){
						window.location.href = '<?php echo base_url('admin/comment/blog'); ?>';
					});
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