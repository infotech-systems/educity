<div class="col-md-12">
    <div class="form-group">
    <label class="col-sm-6">Description</label>
    <label class="col-sm-5">Amount</label>
    
    </div>
</div>
<?php
$total_amt=0;
if($fees):
    foreach($fees as $fee):
        $total_amt+=$fee['fee_amt'];
        ?>
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-sm-6">
                    <input name="check[]" class="form-control" type="hidden" checked  value="<?php echo $fee['fee_id']; ?>" style="display:block;">
                    <input name="fee_desc[<?php echo $fee['fee_id']; ?>]" class="form-control" type="text" readonly value="<?php echo $fee['fee_desc']; ?>">
                </div>
                <div class="col-sm-6">
                    <input name="fee_amt[<?php echo $fee['fee_id']; ?>]" class="form-control" type="text" readonly  value="<?php echo $fee['fee_amt']; ?>">
                </div>
            
            </div>
        </div>
        <?php
    endforeach;
endif;
?>
<div class="col-md-12">
    <div class="form-group">
        <label class="col-sm-6">Total</label>
        <div class="col-sm-6">
            <input name="total_amt" class="form-control" type="text" readonly  value="<?php echo $total_amt; ?>">
        </div>
    
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
    <label class="col-sm-4">Pay Amount</label>
    <div class="col-sm-8">
        <input name="pay_amt" class="form-control" type="text" placeholder="Pay Amount" >
    </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
    <label class="col-sm-4">Date of Payment</label>
    <div class="col-sm-8">
        <input name="pay_date" id="pay_date" readonly="readonly" class="form-control" type="text" placeholder="Date of Payment" >
    </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
    <label class="col-sm-4">Transaction ID</label>
    <div class="col-sm-8">
        <input name="transaction_id" class="form-control" type="text" placeholder="Transaction ID" >
    </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
    <label class="col-sm-4">Slip Photo</label>
    <div class="col-sm-8">
        <input name="pay_photo" id="pay_photo"  type="file" >
    </div>
    </div>
</div>
            
<script>
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
</script>