<?php 
include('header.php'); 
?>
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white">Contact</h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="#">Home</a></li>                
                <li class="active text-gray-silver">Contact</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

<section class="divider">
  <div class="container">
    <div class="row pt-30">
      <div class="col-md-4">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="icon-box left media bg-deep p-30 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-map-2 text-theme-colored"></i></a>
              <div class="media-body"> <strong>OUR OFFICE LOCATION</strong>
                <p><?php echo $comp_addr; ?></p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-12">
            <div class="icon-box left media bg-deep p-30 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-call text-theme-colored"></i></a>
              <div class="media-body"> <strong>OUR CONTACT NUMBER</strong>
                <p>+91 <?php echo $cont_per_no; ?></p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-12">
            <div class="icon-box left media bg-deep p-30 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-mail text-theme-colored"></i></a>
              <div class="media-body"> <strong>OUR CONTACT E-MAIL</strong>
                <p><?php echo $cont_per_email; ?></p>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <div class="col-md-8">
        <h3 class="line-bottom mt-0 mb-20">Contact</h3>
        
        <!-- Contact Form -->
        <form id="contact_form" name="contact_form" class="" action="" method="post">

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <input name="form_name" class="form-control" type="text" placeholder="Enter Name" required>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
              </div>
            </div>
          </div>
            
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <input name="form_subject" class="form-control required" type="text" placeholder="Enter Subject">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <input name="form_phone" class="form-control" type="text" placeholder="Enter Phone">
              </div>
            </div>
          </div>

          <div class="form-group">
            <textarea name="form_message" class="form-control required" rows="5" placeholder="Enter Message"></textarea>
          </div>
          <div class="form-group">
            <input name="form_botcheck" class="form-control" type="hidden" value="" />
            <button type="submit" class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px" data-loading-text="Please wait...">Send your message</button>
            <button type="reset" class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php 
include('footer.php'); 
?>