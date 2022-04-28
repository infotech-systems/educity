<?php
include('temp/header.php');
if($student->dob)
{
$dob=date('d/m/Y', strtotime($student->dob));
}
else
{
	$dob='';
}
$adm_date='';
if($student->adm_date)
{
$adm_date=date('d/m/Y', strtotime($student->adm_date));
}
$pay_date='';
if($bill->pay_date)
{
$pay_date=date('d/m/Y', strtotime($bill->pay_date));
}
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
    <div id="loading"></div>

      <div class="card-header">
        <h3 class="card-title">Student Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/admission/approved', array('id'=>'admissionupdate')); ?>	
       <input type="hidden" name="hid" id="hid" value="<?php echo $student->student_id; ?>">   
       <input type="hidden" name="tr_id" id="tr_id" value="<?php echo $bill->tr_id; ?>">   
       <input type="hidden" name="s_bill_no" id="s_bill_no" value="<?php echo $bill->s_bill_no; ?>">   
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Year</label>
              <div class="col-sm-8">
              	 <input type="text" name="year" id="year" tabindex="1" class="form-control" value="<?php echo $student->year; ?>" maxlength="4" readonly autocomplete="off">
               </div>
            </div>
            
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Admission Date</label>
              <div class="col-sm-8">
              	 <input type="text" name="adm_date" id="adm_date" tabindex="2" class="form-control" value="<?php echo $adm_date; ?>" maxlength="10" readonly autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Student Name</label>
              <div class="col-sm-8">
                  <div class="input-group">
              	 <input type="text" name="student_name" id="student_name" tabindex="3" class="form-control" value="<?php echo $student->student_name; ?>" maxlength="50" autofucus autocomplete="off">
                   <div class="input-group-prepend" data-toggle="modal" data-target="#modal-photo">
                        <span class="input-group-text"><i class="fas fa-photo"></i></span>
                    </div>
                </div>
                </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Mobile No</label>
              <div class="col-sm-8">
              	 <input type="text" name="mobile_no" id="mobile_no" tabindex="4" class="form-control" value="<?php echo $student->mobile_no; ?>" maxlength="4" readonly autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Date of Birth</label>
              <div class="col-sm-8">
              	 <input type="text" name="dob" id="dob" tabindex="5" class="form-control" value="<?php echo $dob; ?>" readonly autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Guardian Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="guardian_name" id="guardian_name" tabindex="6" class="form-control" value="<?php echo $student->guardian_name; ?>" maxlength="50" autofucus autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Relation</label>
              <div class="col-sm-8">
              	 <select name="relationship" id="relationship" class="form-control select2" tabindex="7">
                    <option value=""></option>
                    <?php
                    if($relations):
                        foreach($relations as $relation):
                            ?>
                            <option value="<?php echo $relation['relationship_id']; ?>" <?php if($relation['relationship_id']==$student->relationship_id){ echo "SELECTED"; } ?>><?php echo $relation['relationship_desc']; ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                  </select>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Address</label>
              <div class="col-sm-8">
              	 <input type="text" name="student_addr" id="student_addr" tabindex="8" class="form-control" value="<?php echo $student->student_addr; ?>" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Landmark</label>
              <div class="col-sm-8">
              	 <input type="text" name="landmark" id="landmark" tabindex="9" class="form-control" value="<?php echo $student->landmark; ?>" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Caste</label>
              <div class="col-sm-8">
              	 <select name="caste" id="caste" class="form-control select2" tabindex="10">
                    <option value=""></option>
                    <?php
                    if($castes):
                        foreach($castes as $cast):
                            ?>
                            <option value="<?php echo $cast['caste_id']; ?>" <?php if($cast['caste_id']==$student->caste){ echo "SELECTED"; } ?>><?php echo $cast['caste_nm']; ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                  </select>
               </div>
            </div>
         </div>
         <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Category</label>
                <div class="col-sm-8">
                <div class="input-group">
                <select name="category" id="category" class="form-control"  tabindex="11">
                        <option value="G"  <?php if($student->category=='G'){ echo "SELECTED"; } ?>>General</option>
                        <option value="M"  <?php if($student->category=='M'){ echo "SELECTED"; } ?>>Medium</option>
                        <option value="B" <?php if($student->category=='B'){ echo "SELECTED"; } ?>>BPL</option>
                    </select>
                    <div class="input-group-prepend" data-toggle="modal" data-target="#modal-income">
                        <span class="input-group-text"><i class="fas fa-photo"></i></span>
                    </div>
                </div>
                    
                </div>
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">School Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="cur_school_name" id="cur_school_name" tabindex="12" class="form-control" value="<?php echo $student->cur_school_name; ?>" autocomplete="off">
               </div>
            </div>
         </div> 
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Class</label>
              <div class="col-sm-8">
                    <select name="stream" id="stream" class="form-control select2" tabindex="13" >
                        <option value=""></option>
                        <?php
                        if($classes):
                            foreach($classes as $cl):
                                ?>
                                <option value="<?php echo $cl['class_id']; ?>"  <?php if($cl['class_id']==$student->class_id){ echo "SELECTED"; } ?>><?php echo $cl['class_name']; ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Batch</label>
              <div class="col-sm-8">
                    <select name="batch" id="batch" class="form-control select2" tabindex="14" >
                        <option value=""></option>
                        <?php
                        if($batches):
                            foreach($batches as $bt):
                                ?>
                                <option value="<?php echo $bt['batch_id']; ?>" <?php if($bt['batch_id']==$student->batch_id){ echo "SELECTED"; } ?>><?php echo $bt['batch_title'].' ['.$bt['batch_desc'].']'; ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
               </div>
            </div>
         </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Pay Amt</label>
              <div class="col-sm-8">
              	 <input type="text" name="bill_amt" id="bill_amt" readonly tabindex="12" class="form-control" value="<?php echo $bill->bill_amt; ?>" autocomplete="off">
               </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Trans ID</label>
              <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input type="text" name="pay_id" id="pay_id" readonly tabindex="12" class="form-control" value="<?php echo $bill->pay_id; ?>" autocomplete="off">
                    <div class="input-group-prepend" data-toggle="modal" data-target="#modal-default">
                        <span class="input-group-text"><i class="fas fa-photo"></i></span>
                    </div>
                </div>
  
              </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Pay Date</label>
              <div class="col-sm-8">
              	 <input type="text" name="pay_date" id="pay_date" readonly tabindex="12" class="form-control" value="<?php echo $pay_date; ?>" autocomplete="off">
               </div>
            </div>
        </div>
      </div>
      <div class="card-footer">
            <input type="submit" name="submit" id="submit" class="btn btn-primary float-right" value="Approved">
           
      </div>
    </div>   
  </div>
</div>

<div class="modal fade" id="modal-photo">
<div class="modal-dialog">
<div class="modal-content bg-default">
<div class="modal-header">
<h4 class="modal-title">Student Photo</h4>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <img src="<?php echo base_url($student->photo_path); ?>" class="col-sm-12">
</div>

</div>

</div>

</div>
<div class="modal fade" id="modal-income">
<div class="modal-dialog">
<div class="modal-content bg-default">
<div class="modal-header">
<h4 class="modal-title">Income Proof</h4>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <img src="<?php echo base_url($student->income_proof); ?>" class="col-sm-12">
</div>

</div>

</div>

</div>

<div class="modal fade" id="modal-default">
<div class="modal-dialog">
<div class="modal-content bg-default">
<div class="modal-header">
<h4 class="modal-title">Slip</h4>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <img src="<?php echo base_url($bill->pay_slip); ?>" class="col-sm-12">
</div>

</div>

</div>

</div>



<?php
include('temp/footer.php');
include('include/approved.php');

?>
