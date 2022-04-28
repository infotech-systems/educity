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

<!-- Contact Us-area start Here -->
<div class="contactus-area">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="address-area">
                <div class="row">
                  <div class="col-lg-4 md-4 col-sm-12 col-xs-12">
                    <div class="singpe-address">
                      <div class="hotline-icon">
                        <a href="#"><i class="fa fa-map-marker"></i></a>
                      </div>  
                     <div class="hotline-content">
                        <h4>Address</h4>
                        <p><?php echo $orgn[0]['orgn_addr1']; ?></p>
                     </div>
                    </div>
                  </div>
                  <div class="col-lg-3 md-3 col-sm-12 col-xs-12">
                    <div class="singpe-address">
                      <div class="hotline-icon">
                       <a href="#"> <i class="fa fa-phone"></i></a>
                      </div>  
                     <div class="hotline-content">
                        <h4>Phone</h4>
                        <a href="#">+91 <?php echo $orgn[0]['cont_per_no']; ?> </a>
                     </div>
                    </div>
                  </div>
                  <div class="col-lg-5 md-5 col-sm-12 col-xs-12">
                    <div class="singpe-address">
                      <div class="hotline-icon">
                        <a href="#"><i class="fa fa-envelope"></i></a>
                      </div>  
                     <div class="hotline-content">
                        <h4>Email</h4>
                        <a href="mailto:<?php echo $orgn[0]['cont_per_email']; ?>"><?php echo $orgn[0]['cont_per_email']; ?></a>
                        <a href="mailto:<?php echo $orgn[0]['email_id']; ?>"><?php echo $orgn[0]['email_id']; ?></a>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
         
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-title text-center">
                <h3>Leave us a message</h3>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
               <div class="row">
                 <div class="contractus-form">
                 <?php echo form_open_multipart('contact/send', array('id'=>'contactsend','autocomplete'=>'off')); ?>	
                 <input type="hidden" name="hid_code" value="<?php echo $this->session->userdata('captchaWord'); ?>" />
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                       <div class="row">
                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="text"  placeholder="Name*" name="form_name" required>
                         </div>
                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="number" placeholder="Mobile*" name="form_number" required>
                         </div>
                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="email" placeholder="Email*" name="form_email" required>
                         </div>
                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="text" placeholder="Subject*" name="form_subject" required>
                         </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <textarea name="messagess" id="messagess" cols="30" rows="6" placeholder="Message*" required></textarea>
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="captachre">
                            <?php
                            echo $captcha['image']; 
                            ?>
                            </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <input  type="text" class="form-control" name="captcha_code" id="captcha_code" placeholder="type captcha here"/>
                          </div>
                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <a href="javascript:void(0)" id="refresh" style="font-size:36px;"><i class="fa fa-refresh"></i></a>
                          </div>
                       </div>
                     </div>
                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                       <button class="btn" type="submit"><span>s</span><span>u</span><span>b</span><span>m</span><span>i</span><span>t</span></button>
                     </div>
                     <?php echo form_close(); ?>
                 </div>
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <!-- Contact Page Map Area Start-->   
              <div class="map-area">
               <!-- <div id="map" style="width:100%;height:220px;"></div>-->
               <?php
               if($orgn[0]['map_addr']):
                ?>
               <iframe id="map" src="<?php echo $orgn[0]['map_addr']; ?>"  style="border:0; width:100%; height:300px" allowfullscreen="" loading="lazy"></iframe>
             <?php endif; ?>
              </div>
              <!-- Contact Page Map Area End-->
            </div>
          </div>
        </div>
      </div>
      <!-- 40.contactus-area end Here -->
