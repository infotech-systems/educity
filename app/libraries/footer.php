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
                      <li><a href="#"><i class="fa fa-phone"></i>+91 <?php echo $branch->cont_no; ?></a></li>
                      <li><a href="#"><i class="fa fa-phone"></i>+91 <?php echo $orgn[0]['cont_per_no']; ?> (<?php echo $orgn[0]['orgn_abbr']; ?>)</a></li>
                      <li><a href="mailto:http://<?php echo $orgn[0]['cont_per_email']; ?>"><i class="fa fa-envelope"></i><?php echo $orgn[0]['cont_per_email']; ?></a></li>
                      <li><a href="#"><i class="fa fa-map"></i><?php echo $branch->branch_addr; ?></a></li>
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
                          <?php echo $this->dynamic_usefull_link->build_footer($branch->branch_path,$branch->branch_id); ?> 
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
        <div >
        
        
        </div>
       <video  autoplay loop muted id="video-help">
          <source src="<?php echo base_url('assets/video/video.mp4'); ?>" type="video/mp4" />

        </video>
        <div id="clickhere" accesskey="P" onclick='playPauseVideo();' data-toggle="modal" data-target="#exampleModal">Virtual Help Desk</div>
        <div class="modal fade" id="exampleModal" tabindex2="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" id="helpdesk-modal" role="document">
            <div id='player' style="visibility: hidden;">
              <video id='video-element'>
                <source src='<?php echo base_url('assets/video/video.mp4'); ?>' type='video/mp4'>
              </video>
              <div id='controls'>
              </div>
            </div>	
            
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Admission Inquiry <?php echo $orgn[0]['active_year']; ?> </h4>
              </div>
              <?php echo form_open_multipart('kolkata/home/allinquiry', array('id'=>'inquiryadd','autocomplete'=>'off')); ?>	
                <div class="modal-body">
                  <input type="hidden" name="hid_code" value="<?php echo $this->session->userdata('captchaWord'); ?>" />
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Name:</label>
                    <input type="text" class="form-control"  name="recipient_name"  id="recipient_name">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Mobile No:</label>
                    <input type="text" class="form-control"  name="recipient_contact" id="recipient_contact">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Email ID:</label>
                    <input type="text" class="form-control"  name="recipient_email" id="recipient_email">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Mesage:</label>
                    <textarea type="text" class="form-control"  name="recipient_message" id="recipient_message"></textarea>
                  </div>
                  <div class="form-group" id="form-group">
                    <div class="col-md-4" id="captachrem">
                      <?php echo $captcha['image']; ?>
                    </div>
                    <div class="col-md-2">
                      <a href="javascript:void(0)" id="refreshm" style="font-size:36px;"><i class="fa fa-refresh"></i></a>
                    </div>
                    <div class="col-md-6">
                      <input  type="text" class="form-control" name="captcha_code" id="captcha_code" placeholder="type captcha here"/>
                    </div>
                  </div>
        
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              <?php echo form_close(); ?>

            </div>
          </div>
        </div>
        
    <!--    <div id="inquiry" accesskey="P" onclick='playPauseVideo();' data-toggle="modal" data-target="#inquiryModal">INQUIRY NOW</div>-->
        <div class="modal fade" id="inquiryModal" tabindex2="-1" role="dialog" aria-labelledby="inquiryModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Admission Inquiry 2022-23 </h4>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Name:</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Mobile No:</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Email ID:</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                </form>
        
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- footer-area end Here -->
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
        <script src="<?php echo base_url(); ?>assets/public/js/jquery.nice-select.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/jquery.magnific-popup.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/jquery.nav.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/isotope.js"></script> 
        <script src="<?php echo base_url(); ?>assets/public/js/jquery.bxslider.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/public/js/main.js"></script>
        <script>
         // Get a handle to the player
            player       = document.getElementById('video-element');
            btnPlayPause = document.getElementById('clickhere');
 //           btnPlayPause = document.getElementByClass('close');
                        
            player.addEventListener('Virtual Help Desk', function() {
              // Change the button to be a pause button
              changeButtonType(btnPlayPause, 'Virtual Help Desk');
            }, false);
            
            player.addEventListener('Virtual Help Desk', function() {
              // Change the button to be a play button
              changeButtonType(btnPlayPause, 'Virtual Help Desk');
            }, false);
            
            
            
            player.addEventListener('ended', function() { this.pause(); }, false);	
            
         //   progressBar.addEventListener("click", seek);

          

            function playPauseVideo() {
              if (player.paused || player.ended) {
                // Change the button to a pause button
                changeButtonType(btnPlayPause, 'Virtual Help Desk');
                player.play();
              }
              else {
                // Change the button to a play button
                changeButtonType(btnPlayPause, 'Virtual Help Desk');
                player.play();
              }
            }            
            
           
            // Updates a button's title, innerHTML and CSS class
            function changeButtonType(btn, value) {
              btn.title     = value;
              btn.innerHTML = value;
              btn.className = value;
            }
            
            function resetPlayer() {
              progressBar.value = 0;
              // Move the media back to the start
              player.currentTime = 0;
              // Set the play/pause button to 'play'
              changeButtonType(btnPlayPause, 'play');
            }  
            
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