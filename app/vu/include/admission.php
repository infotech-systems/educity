<script src="<?php echo base_url(); ?>assets/admin/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
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
/*
 $('#admissionsend').submit(function(e) {
	var photo = $("#photo").val();
    var pay_photo = $("#pay_photo").val();

	if(photo=='')
	{
		alert('Please choose photo');
		return false;
	}
	if(pay_photo=='')
	{
		alert('Please choose Slip');
		return false;
	}
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
					window.location.href = '<?php echo base_url('admission'); ?>';
				}
				else {
					
					$.each(response.messages, function(key, value) {
						var element = $('#' + key);
				//		alert(key);
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
	});*/
   /* $('#dob').datepicker({
      autoclose: true
    });*/
    var date2 = new Date();
$('input[name="dob"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    timePicker: false,
    timePicker24Hour: true,
    timePickerIncrement: 1,
    autoApply: true,
    format: 'DD/MM/YYYY',
  //  maxDate:date2,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'))
}, function(start, end, label) {

    var years = moment().diff(start, 'years');
    //alert("You are " + years + " years old!");
});
$('input[name="pay_date"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    timePicker: false,
    timePicker24Hour: true,
    timePickerIncrement: 1,
    autoApply: true,
    format: 'DD/MM/YYYY',
  //  maxDate:date2,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'))
}, function(start, end, label) {

    var years = moment().diff(start, 'years');
    //alert("You are " + years + " years old!");
});
$('#stream').change(function(){
    var stream = $('#stream').val();
	 var request = $.ajax({
	  url: '<?php echo base_url('admission/getfee'); ?>',
	  method: "POST",
	  data: {class_id:stream},
	  dataType: "html",
		  success:function(msg) {
	      $("#div_fee").html(msg);  
  
	},
	error: function(xhr, status, error) {
		alert(status);
		alert(error);
		alert(xhr.responseText);
	  },
  });

}) ; 
</script> 