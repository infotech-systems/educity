<div class="header-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 sol-xs-12">
            <div class="breadcrumbs-title text-center">
                <h2><?php echo $page->page_name; ?></h2>
                <div class="subheader-pages">
                <ul>
                    <li>Home</li>
                    <li><?php echo $page->page_name; ?></li>
                </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?php echo link_tag('assets/admin/css/alertify.core.css'); ?>
<?php echo link_tag('assets/admin/css/alertify.default.css'); ?>
<script src="<?php echo base_url(); ?>assets/admin/js/alertify.min.js"></script>
<style>
    .form-group
    {
      /**/ */  margin:10px 0;
    }
</style>
<!-- Contact Us-area start Here -->
<div class="contactus-area">
        <div class="container">
          
          <div class="row">
         
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-title text-center">
                <h3>Admission</h3>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="row">
                 <div class="contractus-form">
                 <?php echo form_open_multipart('admission/send', array('id'=>'admissionsend','class'=>'form-validation','autocomplete'=>'off')); ?>	
        <input type="hidden" name="hid_code" value="<?php echo $this->session->userdata('captchaWord'); ?>" />

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Name Of Applicant</label>
                <div class="col-sm-8">
                    <input name="form_name" class="form-control" type="text" placeholder="Name Of Applicant" >
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Full Address</label>
                <div class="col-sm-8">
                    <input name="form_addr" class="form-control" type="text" placeholder="Full Address" >
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Landmark</label>
                <div class="col-sm-8">
                    <input name="landmark" class="form-control" type="text" placeholder="Landmark" >
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Date of Birth</label>
                <div class="col-sm-8">
                    <input name="dob" id="dob" readonly="readonly" class="form-control" type="text" placeholder="Date of Birth" >
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Father / Guardian</label>
                <div class="col-sm-8">
                    <input name="guardian_name" class="form-control" type="text" placeholder="Father / Guardian Name" >
                </div>
              </div>
            </div>
            <div class="col-md-6" style="margin-bottom:10px;">
              <div class="form-group">
                <label class="col-sm-4">Relationship</label>
                <div class="col-sm-8">
                    <select name="relationship" id="relationship" class="form-control">
                        <option value=""></option>
                        <?php
                        if($relations):
                            foreach($relations as $rl):
                                ?>
                                <option value="<?php echo $rl['relationship_id']; ?>"><?php echo $rl['relationship_desc']; ?></option>
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
                <label class="col-sm-4">Contact No</label>
                <div class="col-sm-8">
                    <input name="contact_no" class="form-control" maxlength="10" type="text" placeholder="Contact No" >
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Category</label>
                <div class="col-sm-8">
                    <select name="category" id="category" class="form-control select2">
                        <option value="G">General</option>
                        <option value="M">Medium</option>
                        <option value="B">BPL</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Caste</label>
                <div class="col-sm-8">
                    <select name="caste" id="caste" class="form-control">
                        <option value=""></option>
                        <?php
                        if($castes):
                            foreach($castes as $cs):
                                ?>
                                <option value="<?php echo $cs['caste_id']; ?>"><?php echo $cs['caste_nm']; ?></option>
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
                <label class="col-sm-4">Class applied for</label>
                <div class="col-sm-8">
                    <select name="stream" id="stream" class="form-control select2">
                        <option value=""></option>
                        <?php
                        if($classes):
                            foreach($classes as $cl):
                                ?>
                                <option value="<?php echo $cl['class_id']; ?>"><?php echo $cl['class_name']; ?></option>
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
                <label class="col-sm-4">School Name</label>
                <div class="col-sm-8">
                    <input name="school_name" class="form-control" type="text" placeholder="Current Study School Name" >
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Batch preferred</label>
                <div class="col-sm-8">
                    <select name="batch" id="batch" class="form-control select2">
                        <option value=""></option>
                        <?php
                        if($batches):
                            foreach($batches as $bt):
                                ?>
                                <option value="<?php echo $bt['batch_id']; ?>"><?php echo $bt['batch_title'].' ['.$bt['batch_desc'].']'; ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
              </div>
            </div>
           <div id="div_fee"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Income Proof (For BPL)</label>
                <div class="col-sm-8">
                    <input name="income" type="file" >
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4">Photo</label>
                <div class="col-sm-8">
                    <input type="file" name="photo" id="photo" >
                </div>
              </div>
            </div>
          </div>
            
        

          
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="captachre">
            <?php
            echo $captcha['image']; 
            ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <input  type="text" name="captcha_code" class="form-control " id="captcha_code" placeholder="type captcha here"/>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
              
            <a href="javascript:void(0)" id="refresh" style="font-size:36px;"><i class="fa fa-refresh"></i></a>
            </div>
            <div class="col-md-12">

                <div class="form-group">
                    <input name="form_botcheck" class="form-control" type="hidden" value="" />
                    <button type="submit" class="btn btn-flat btn-theme-colored mt-10 mb-sm-30 border-left-theme-color-2-4px">Submit</button>
                </div>
                    </div>
                     <?php echo form_close(); ?>
                 </div>
               </div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- 40.contactus-area end Here -->
