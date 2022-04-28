<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Slider -->
<div class="slider-area">
  <div class="bend niceties preview-2">
    <div id="ensign-nivoslider" class="slides"> 
      <?php
      if($sliders)
      {
          foreach($sliders as $slider):
              $id=$slider['slider_id'];
              $slider_path=$slider['image_path'];
              $slider_nm=$slider['slider_nm'];
              ?>
              <img src="<?php echo base_url($slider_path); ?>" alt="<?php echo $slider_nm; ?>" title="#slider-direction-<?php echo $id; ?>"  />
              <?php
          endforeach;
      }
      ?>
    </div>
      <!-- direction 1 -->
      <?php
        if($sliders)
        {
            foreach($sliders as $slider):
                $id=$slider['slider_id'];
                $slider_path=$slider['image_path'];
                $slider_nm=$slider['slider_nm'];
                ?>
                <div id="slider-direction-<?php echo $id; ?>" class="t-cn slider-direction">
                <div class="slider-progress"></div>
                <div class="slider-content t-cn s-tb slider-<?php echo $id; ?>">
                    <div class="title-container s-tb-c title-compress">
                    </div>
                </div>  
            </div>                        
            <?php
            endforeach;
        }
        ?>
  </div>
  <!-- Slider end-->
  <!-- about area start Here -->
  <section id="about">
      <div class="about-area">
          <div class="container">
            <div class="reagestar-area">
                <div class="row">
                    <h3>Admission Inquiry <?php echo $orgn[0]['active_year']; ?></h3>
                    <div class="ragester-form">
                    <?php echo form_open_multipart('home/inquiry', array('id'=>'inquiryhome','autocomplete'=>'off')); ?>	
                        <input type="hidden" name="hid_code" value="<?php echo $this->session->userdata('captchaWord'); ?>" />
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="nameHere">Name</label>
                            <input type="text" placeholder="Enter Your Name" id="your_name" name="your_name">
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="nameHere">Mobile No</label>
                            <input type="text" placeholder="Enter Your Mobile No" id="your_mobile" name="your_mobile">
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="nameHere">Email Id</label>
                            <input type="text" placeholder="Enter Your Email ID" id="your_email" name="your_email">
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="nameHere">Message</label>
                            <input type="text" placeholder="Enter Your Message" id="your_email" name="your_message">
                          </div>
                          <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6" id="captachre">
                            <?php
                            echo $captcha['image']; 
                            ?>
                            </div>
                          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <input  type="text" class="form-control" name="captcha_code" id="captcha_code" placeholder="type captcha here"/>
                          </div>
                          <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                            <a href="javascript:void(0)" id="refresh" style="font-size:36px;"><i class="fa fa-refresh"></i></a>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <button type="submit" class="btn-icon">Submit</button>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
             
          </div>
      </div>
  </section>
  <!-- about area end Here -->
  
  <!-- education build area start Here  -->
 
  <section>
      <div class="educationbuild-area">
          <div class="container">
              <div class="row">

   <!--               <div class="col-lg-7 col-lg-offset-5 col-md-7 col-md-ofset-5 col-sm-12 col-xs-12">-->
                      <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                        <div class="educarionbuld-content" id="bullet">
                          <h2><?php echo $homes[0]['home_title']; ?></h2>
                          <p><?php echo $homes[0]['home_content']; ?></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- education build area  end Here -->
  
 <!-- gallery area start Here -->
 <section id="gallery">
    <div class="gallery-area ">
      <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="section-title text-center">
                    <h2>Photo Gallery</h2>
                    <img src="<?php echo base_url('assets/public/images/shaparator.png'); ?>" alt="shaparator">
                </div>
            </div>
        </div>
        <div class="row">
          <div class="gallary-menu">
            <ul>
              <li class="active" data-filter="*">all</li>
              <?php
              if($categorys):
                foreach($categorys as $cat):
                ?>
                <li data-filter=".<?php echo $cat['cat_slug'] ?>"><?php echo $cat['cat_nm']; ?></li>
                <?php
                endforeach;
              endif;
              ?>
          </div>
        </div>
        <div class="row">
          <div class="filter-gallary">
            <?php
            if($categorys):
              foreach($categorys as $cat):
                $cat_id=$cat['cat_id'];
                foreach($photos[$cat_id] as $photo):
                  ?>
                  <div class="single-gallary <?php echo $photo['cat_slug']; ?>">
                    <div class="gallary-img">
                      <img src="<?php echo base_url($photo['photo_path']); ?>">
                      <div class="gallary-overlay">
                        <div class="overlay-content">
                          <div class="gallary-title">
                            <h3><?php echo $photo['photo_nm']; ?> <span><?php echo $orgn[0]['orgn_nm']; ?></span></h3>
                          </div>
                          <div class="galary-cosial">
                            <ul>
                              <li><a href="<?php echo base_url($photo['photo_path']); ?>"  data-rel="lightcase"><i class="fa fa-photo"></i></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                endforeach; 
              endforeach;
            endif;
            ?>
           
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- gallery area end Here -->
  