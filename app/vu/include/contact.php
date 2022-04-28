<script>
$('#refresh').click(function(){
	//alert('ddd');
	 var request = $.ajax({
	  url: '<?php echo base_url('contact/refreshCaptcha'); ?>',
	  method: "POST",
	  data: {},
	  dataType: "html",
		  success:function(msg) {
			//  alert(msg);
	      $("#captachre").html(msg);  
  
	},
	error: function(xhr, status, error) {
		alert(status);
		alert(error);
		alert(xhr.responseText);
	  },
  });

}) ; 

 $('#contactsend').submit(function(e) {
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
					alert(response.message);
					window.location.href = '<?php echo base_url('contact'); ?>';
				}
				else {
					
					$.each(response.messages, function(key, value) {
						var element = $('#' + key);
						//alert(key);
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