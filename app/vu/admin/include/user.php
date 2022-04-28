<script language="javascript">

  $('#useradd').submit(function(e) {
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
					window.location.href = '<?php echo base_url('admin/user/add'); ?>';
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
  $('#userupdate').submit(function(e) {
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
					window.location.href = '<?php echo base_url('admin/user'); ?>';
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
	
	  $('#myupdate').submit(function(e) {
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
  $('#userpermission').submit(function(e) {
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
					window.location.href = '<?php echo base_url('admin/user'); ?>';
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