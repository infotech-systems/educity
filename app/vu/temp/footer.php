 <!-- footer-area srart Here -->
 <footer>
      <div class="footer-area">
        <div class="footer-weidget">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="single-weidget">
                  <div class="footer-logo">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url($orgn[0]['footer_logo']); ?>" alt="<?php echo $orgn[0]['orgn_nm']; ?>"></a>
                  </div>
                  <div class="footer-content">
                    <ul>
                      <li><a href="#"><i class="fa fa-phone"></i>+91 <?php echo $orgn[0]['cont_per_no']; ?> (<?php echo $orgn[0]['orgn_abbr']; ?>)</a></li>
                      <li><a href="#"><i class="fa fa-phone"></i>+91 <?php echo $orgn[0]['cont_per_no2']; ?> (<?php echo $orgn[0]['orgn_abbr']; ?>)</a></li>
                      <li><a href="mailto:http://<?php echo $orgn[0]['cont_per_email']; ?>"><i class="fa fa-envelope"></i><?php echo $orgn[0]['cont_per_email']; ?></a></li>
                      <li><a href="#"><i class="fa fa-map"></i><?php echo $orgn[0]['orgn_addr1']; ?></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="single-weidget">
                  <div class="footer-header">
                    <h3>Footer Links</h3>
                  </div>
                  <div class="footer-content">
                    <div class="row">
                        <ul>
                          <?php echo $this->dynamic_usefull_link->build_footer(); ?> 
                        </ul>
                      
                    </div>
                  </div>
              </div>
            </div>
            
            
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="footer-social text-center">
                  <ul>
                    <?php
                    if($socials):
                        foreach($socials as $social):
                        ?>   
                        <li><a href="<?php echo $social['social_url']; ?>"  target="_blank" alt="<?php echo $social['social_nm']; ?>" title="<?php echo $social['social_nm']; ?>"><i class="<?php echo $social['social_path']; ?>"></i></a></li>
                        <?php
                        endforeach;
                    endif;
                    ?>
                  </ul>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="copyright-area text-center">
                  <h6>&copy; <?php echo date('Y'); ?> <?php echo $orgn[0]['orgn_nm']; ?>
                    All Rights Reserved.   Designed By <a href="http://infotechsystems.in">Infotech Systems</a></h6>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </footer>


        <a id="inquiry2" href="<?php echo base_url('admission'); ?>">Online Admission</a>

   
		    <!-- all js here -->
		    <!-- jquery latest version -->
        <script src="<?php echo base_url(); ?>assets/public/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/ajex-lap.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/jquery.counterup.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/jquery.meanmenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/wow.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/plugins.js"></script>    
        <script src="<?php echo base_url(); ?>assets/public/custom-slider/js/jquery.nivo.slider.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/public/custom-slider/home.js" type="text/javascript"></script>
    <!--    <script src="<?php echo base_url(); ?>assets/public/js/jquery.nice-select.js"></script>-->
        <script src="<?php echo base_url(); ?>assets/public/js/jquery.magnific-popup.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/jquery.nav.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/isotope.js"></script> 
        <script src="<?php echo base_url(); ?>assets/public/js/jquery.bxslider.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/main.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/lightcase.js"></script>
        <script>
           
            
            function exitFullScreen() {
              if (document.exitFullscreen) {
                  document.exitFullscreen();
              } else if (document.msExitFullscreen) {
                  document.msExitFullscreen();
              } else if (document.mozCancelFullScreen) {
                  document.mozCancelFullScreen();
              } else if (document.webkitExitFullscreen) {
                  document.webkitExitFullscreen();
              }
            }
            
            function toggleFullScreen() {
              //var player = document.getElementById("player");

              if (player.requestFullscreen)
                  if (document.fullScreenElement) {
                      document.cancelFullScreen();
                  } else {
                      player.requestFullscreen();
                  }
                  else if (player.msRequestFullscreen)
                  if (document.msFullscreenElement) {
                      document.msExitFullscreen();
                  } else {
                      player.msRequestFullscreen();
                  }
                  else if (player.mozRequestFullScreen)
                  if (document.mozFullScreenElement) {
                      document.mozCancelFullScreen();
                  } else {
                      player.mozRequestFullScreen();
                  }
                  else if (player.webkitRequestFullscreen)
                  if (document.webkitFullscreenElement) {
                      document.webkitCancelFullScreen();
                  } else {
                      player.webkitRequestFullscreen();
                  }
              else {
                  alert("Fullscreen API is not supported");
                  
              }
            }
        

        $('#inquiryadd').submit(function(e) {
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
                $('.modal-backdrop').hide();
                $('body').removeClass('modal-open');
                $('#exampleModal').modal('hide');
                $('#recipient_name').val('');
                $('#recipient_contact').val('');
                $('#recipient_email').val('');
                $('#recipient_message').val('');
                $('#captcha_code').val('');
                
                var request = $.ajax({
                  url: '<?php echo base_url('kolkata/contact/refreshCaptcha'); ?>',
                  method: "POST",
                  data: {},
                  dataType: "html",
                    success:function(msg) {
                    //  alert(msg);
                      $("#captachrem").html(msg);  
                
                },
                error: function(xhr, status, error) {
                  alert(status);
                  alert(error);
                  alert(xhr.responseText);
                  },
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
        $('#refreshm').click(function(){
        //('ddd');
        var request = $.ajax({
          url: '<?php echo base_url('kolkata/contact/refreshCaptcha'); ?>',
          method: "POST",
          data: {},
          dataType: "html",
            success:function(msg) {
            //  alert(msg);
              $("#captachrem").html(msg);  
        
        },
        error: function(xhr, status, error) {
          alert(status);
          alert(error);
          alert(xhr.responseText);
          },
        });

      }) ;
	</script>
    </body>
</html>