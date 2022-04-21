  <!-- Footer -->
  <footer id="footer" class="footer divider layer-overlay overlay-dark-9" data-bg-img="images/bg/bg2.jpg">
    <div class="container">
      <div class="row border-bottom">
        <div class="col-sm-6 col-md-4">
          <div class="widget dark">
            <img class="mt-5 mb-20" alt="" src="images/logo-white.png">
            <p><?php echo $comp_addr; ?></p>
            <ul class="list-inline mt-5">
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">+91 <?php echo $cont_per_no; ?></a> </li>
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-color-2 mr-5"></i> <a class="text-gray" href="#"><?php echo $cont_per_email; ?></a> </li>
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-gray" href="#"><?php echo $web_addr; ?></a> </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="widget dark">
            <h4 class="widget-title">Useful Links</h4>
            <ul class="list angle-double-right list-border">
              <?php
				$sqlq=" select quick_name,quick_content,quick_link ";
				$sqlq.=" from quick_link_master order by srl ";
				$sthq = $conn->prepare($sqlq);
				$sthq->execute();
				$ssq=$sthq->setFetchMode(PDO::FETCH_ASSOC);
				$rowq = $sthq->fetchAll();
				
				foreach ($rowq as $keyq => $valueq) 
				{
					$quick_id = md5($valueq['quick_id']);
					$quick_name=$valueq['quick_name'];
					$quick_link=$valueq['quick_link'];
					if(!empty($quick_link))
					{
						$qmurl="$quick_link";
					}
					else
					{
						$qmurl="page.php?qr_id=$quick_id";
					}
				?>
				<li><a href="<?php echo $qmurl; ?>" target="_blank"><?php echo $quick_name; ?></a></li>
				<?php
				}
				?> 
            </ul>
          </div>
        </div>
       
        <div class="col-sm-6 col-md-4">
          <div class="widget dark">
            <h4 class="widget-title line-bottom-theme-colored-2">Opening Hours</h4>
            <div class="opening-hours">
              <ul class="list-border">
                <li class="clearfix"> <span> Winter  </span>
                  <div class="value pull-right">Nov. to March - 9:00 a.m. to 3:00 p.m.  </div>
                </li>
                <li class="clearfix"> <span> Summer :</span>
                  <div class="value pull-right"> April to Oct - 9:00 a.m. to 3:30 p.m. </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-30">
        <div class="col-md-2">
          <div class="widget dark">
            <h5 class="widget-title mb-10">Call Us Now</h5>
            <div class="text-gray">
              +91 <?php echo $cont_per_no; ?> <br>
              +91 <?php echo $land_no; ?>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="widget dark">
            <h5 class="widget-title mb-10">Connect With Us</h5>
            <ul class="styled-icons icon-bordered icon-sm">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-skype"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-5 col-md-offset-2">
          <div class="widget dark">
            
            <!-- Mailchimp Subscription Form Validation-->
            
            <!-- Mailchimp Subscription Form Ends Here -->
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom bg-black-333">
      <div class="container pt-20 pb-20">
        <div class="row">
          <div class="col-md-6">
            <p class="font-11 text-black-777 m-0">Copyright &copy;2019 Peace And Freedom Academy. All Rights Reserved</p>
          </div>
          <div class="col-md-6 text-right">
            <div class="widget no-border m-0">
              <ul class="list-inline sm-text-center mt-5 font-12">
                <li>
                  <a href="#">WinFo</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="js/custom.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
      (Load Extensions only on Local File Systems ! 
       The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="js/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>

</body>
</html>