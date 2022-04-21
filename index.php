<?php include('./header.php'); ?>   
    <!-- Section: home -->
    <section id="home">
      <div class="container-fluid p-0">
        
        <!-- Slider Revolution Start -->
        <div class="rev_slider_wrapper">
          <div class="rev_slider" data-version="5.0">
            <ul>
			 <?php
            $i=0;
            $slider = "select * from slider_img where show_tag = 'T'";
            $sthi = $conn->prepare($slider);
            $sthi->execute();
            $ssi=$sthi->setFetchMode(PDO::FETCH_ASSOC);
            $rowi = $sthi->fetchAll();
            foreach ($rowi as $keyi => $valuei) 
            {
				$i++;
                $image_path = $valuei['image_path'];
                $slider_id = $valuei['slider_id'];
                $slider_nm = $valuei['slider_nm'];
                $slider_content = $valuei['slider_content'];
                ?>                
              <!-- SLIDE 1 -->
              <li data-index="rs-<?php echo $i;?>" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="./admin-panel/uploads/<?php echo $image_path;?>" data-rotate="0" data-saveperformance="off" data-title="Slide <?php echo $i;?>" data-description="">
                <!-- MAIN IMAGE -->
                <img src="./admin-panel/uploads/<?php echo $image_path;?>"  alt=""  data-bgposition="center 10%" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10" data-no-retina  alt="<?php echo $slider_nm;?>">
                <!-- LAYERS -->
                <?php echo $slider_content; ?>               
               
              </li>
			<?php
			}
			?>
             

            </ul>
          </div>
          <!-- end .rev_slider -->
        </div>
        <!-- end .rev_slider_wrapper -->
        <script>
          $(document).ready(function(e) {
            $(".rev_slider").revolution({
              sliderType:"standard",
              sliderLayout: "auto",
              dottedOverlay: "none",
              delay: 5000,
              navigation: {
                  keyboardNavigation: "off",
                  keyboard_direction: "horizontal",
                  mouseScrollNavigation: "off",
                  onHoverStop: "off",
                  touch: {
                      touchenabled: "off",
                      swipe_threshold: 75,
                      swipe_min_touches: 1,
                      swipe_direction: "horizontal",
                      drag_block_vertical: false
                  },
                arrows: {
                  style:"zeus",
                  enable:false,
                  hide_onmobile:true,
                  hide_under:600,
                  hide_onleave:true,
                  hide_delay:200,
                  hide_delay_mobile:1200,
                  tmp:'',
                  left: {
                    h_align:"left",
                    v_align:"center",
                    h_offset:30,
                    v_offset:0
                  },
                  right: {
                    h_align:"right",
                    v_align:"center",
                    h_offset:30,
                    v_offset:0
                  }
                },
                bullets: {
                  enable:true,
                  hide_onmobile:true,
                  hide_under:600,
                  style:"metis",
                  hide_onleave:true,
                  hide_delay:200,
                  hide_delay_mobile:1200,
                  direction:"horizontal",
                  h_align:"center",
                  v_align:"bottom",
                  h_offset:0,
                  v_offset:30,
                  space:5,
                  tmp:'<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
                }
              },
              responsiveLevels: [1240, 1024, 778],
              visibilityLevels: [1240, 1024, 778],
              gridwidth: [1170, 1024, 778, 480],
              gridheight: [650, 768, 960, 720],
              lazyType: "none",
              parallax: {
                  origo: "slidercenter",
                  speed: 1000,
                  levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                  type: "scroll"
              },
              shadow: 0,
              spinner: "off",
              stopLoop: "on",
              stopAfterLoops: 0,
              stopAtSlide: -1,
              shuffle: "off",
              autoHeight: "off",
              fullScreenAutoWidth: "off",
              fullScreenAlignForce: "off",
              fullScreenOffsetContainer: "",
              fullScreenOffset: "0",
              hideThumbsOnMobile: "off",
              hideSliderAtLimit: 0,
              hideCaptionAtLimit: 0,
              hideAllCaptionAtLilmit: 0,
              debugMode: false,
              fallbacks: {
                  simplifyAll: "off",
                  nextSlideOnWindowFocus: "off",
                  disableFocusListener: false,
              }
            });
          });
        </script>
        <!-- Slider Revolution Ends -->

      </div>
    </section>

    <!-- Section: About -->
    <section class="">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h6 class="letter-space-4 text-gray-darkgray text-uppercase mt-0 mb-0"> About <?php echo $comp_nm; ?> </h6>
             	<?php
				$sql4=" select id,hedding,content,substr(content,1,700) as view_cnt ";
				$sql4.=" from  home_content_mas  ";
				
				$sth4 = $conn->prepare($sql4);
				$sth4->execute();
				$ss4=$sth4->setFetchMode(PDO::FETCH_ASSOC);
				$row4 = $sth4->fetch();
				$s_hedding=$row4['hedding'];
				$s_content=$row4['content'];
				$view_cnt=$row4['view_cnt'];
				$total=strlen($s_content);
				?>
              <h2 class="text-uppercase font-weight-600 mt-0 font-28 line-bottom"><?php echo $s_hedding;?></h2>
              <?php echo $s_content;?>
              <!--<a class="btn btn-theme-colored btn-flat btn-lg mt-10 mb-sm-30" href="#">Know More →</a>-->
            </div>
            <!--<div class="col-md-6">
              <div class="video-popup">                
                <a href="https://www.youtube.com/watch?v=pW1uVUg5wXM" data-lightbox-gallery="youtube-video" title="Video">
                  <img alt="" src="images/about/5.jpg" class="img-responsive img-fullwidth">
                </a>
              </div>
            </div>-->
          </div>
        </div>
      </div>
    </section>
    <!-- Divider: Funfact -->
    <section class="divider parallax layer-overlay overlay-theme-colored-9" data-bg-img="images/bg/bg2.jpg" data-parallax-ratio="0.7">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-smile mt-5 text-theme-color-2"></i>
              <h2 data-animation-duration="2000" data-value="5248" class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
              <h5 class="text-white text-uppercase mb-0">Happy Students</h5>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-note2 mt-5 text-theme-color-2"></i>
              <h2 data-animation-duration="2000" data-value="675" class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
              <h5 class="text-white text-uppercase mb-0">Our Courses</h5>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-users mt-5 text-theme-color-2"></i>
              <h2 data-animation-duration="2000" data-value="248" class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
              <h5 class="text-white text-uppercase mb-0">Our Teachers</h5>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-0">
            <div class="funfact text-center">
              <i class="pe-7s-cup mt-5 text-theme-color-2"></i>
              <h2 data-animation-duration="2000" data-value="24" class="animate-number text-white mt-0 font-38 font-weight-500">0</h2>
              <h5 class="text-white text-uppercase mb-0">Awards Won</h5>
            </div>
          </div>
        </div>
      </div>
    </section>

     <!-- Section: team -->
    <section>
      <div class="container">
        <div class="section-title mb-10">
          <div class="row">
            <div class="col-md-8">
              <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">FROM Our <span class="text-theme-color-2 font-weight-400">Administration</span></h2>
           </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row multi-row-clearfix">
            <?php
            $slider = "select name,desig,substr(content,1,100) ";
			$slider .= " as view_cnt,photo_path from teacher_mas  ";
			$slider .= " where type='A' ";
            $sthi = $conn->prepare($slider);
            $sthi->execute();
            $ssi=$sthi->setFetchMode(PDO::FETCH_ASSOC);
            $rowi = $sthi->fetchAll();
            foreach ($rowi as $keyi => $valuei) 
            {
                $name = $valuei['name'];
                $desig = $valuei['desig'];
                $view_cnt = $valuei['view_cnt'];
                $photo_path = $valuei['photo_path'];
				?>
                <div class="col-sm-6 col-md-3 sm-text-center mb-sm-30">
                  <div class="team maxwidth400">
                    <div class="thumb"><img class="img-fullwidth" src="./admin-panel/uploads/<?php echo $photo_path;?>" alt=""></div>
                    <div class="content border-1px border-bottom-theme-color-2-2px p-15 bg-light clearfix" style="min-height:220px;">
                      <h4 class="name text-theme-color-2 mt-0"><?php echo $name;?> - <small><?php echo $desig;?></small></h4>
                      <p class="mb-20"><?php echo $view_cnt;?></p>
                      <ul class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm pull-left flip">
                      
                      </ul>
                      <a class="btn btn-theme-colored btn-sm pull-right flip" href="page-teachers-details.php">view details</a>
                    </div>
                  </div>
                </div>
            <?php
			}
			?>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Gallery -->
    <section id="gallery" class="bg-lighter">
     <div class="container">
        <div class="section-title mb-10">
          <div class="row">
            <div class="col-md-12">
              <h2 class="mt-0 text-uppercase text-theme-colored title line-bottom line-height-1">Our<span class="text-theme-color-2 font-weight-400"> Gllery</span></h2>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <!-- Works Filter -->
              <div class="portfolio-filter font-alt align-center">
                <a href="#" class="active" data-filter="*">All</a>
                 <?php
				$SqlC = "select cat_id,cat_nm from cat_master ";
				$sthC = $conn->prepare($SqlC);
				$sthC->execute();
				$ssC=$sthC->setFetchMode(PDO::FETCH_ASSOC);
				$rowC = $sthC->fetchAll();
				foreach ($rowC as $keyC => $valueC) 
				{
					$cat_id = $valueC['cat_id'];
					$cat_nm = $valueC['cat_nm'];
					?>
                <a href="#select<?php echo $cat_id; ?>" class="" data-filter=".select<?php echo $cat_id; ?>"><?php echo $cat_nm; ?></a>
                <?php
				}
				?>
              </div>
              <!-- End Works Filter -->
              
              <!-- Portfolio Gallery Grid -->
              <div id="grid" class="gallery-isotope grid-4 gutter clearfix">
                <?php
				$SqlG = "select cat_id,photo_nm,small_path,big_path ";
				$SqlG .=" from gallery_master order by rand() limit 8 ";
				$sthG = $conn->prepare($SqlG);
				$sthG->execute();
				$ssG=$sthG->setFetchMode(PDO::FETCH_ASSOC);
				$rowG = $sthG->fetchAll();
				foreach ($rowG as $keyG => $valueG) 
				{
					$g_cat_id = $valueG['cat_id'];
					$g_photo_nm = $valueG['photo_nm'];
					$g_small_path = $valueG['small_path'];
					$g_big_path = $valueG['big_path'];
					?>
                <!-- Portfolio Item Start -->
                <div class="gallery-item select<?php echo $g_cat_id;?>">
                  <div class="thumb">
                    <img class="img-fullwidth" src="./admin-panel<?php echo substr($g_big_path,1);?>" alt="<?php echo $g_photo_nm;?>">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a data-lightbox="image" href="./admin-panel/<?php echo substr($g_big_path,1);?>"><i class="fa fa-plus"></i></a>
                          <!--<a href="#"><i class="fa fa-link"></i></a>-->
                        </div>
                      </div>
                    </div>
                    <a class="hover-link" data-lightbox="image" href="./admin-panel/uploads/<?php echo substr($g_big_path,1);?>">View more</a>
                  </div>
                </div>
                <?php
				}
				?>
                <!-- Portfolio Item End -->
              </div>
              <!-- End Portfolio Gallery Grid -->
            </div>
          </div>
        </div>
      </div >
    </section>

    <!-- Section: Why Choose Us -->
    <section id="event" class="">
      <div class="container pb-50">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h3 class="text-uppercase line-bottom mt-0 line-height-1"><i class="fa fa-calendar mr-10"></i>Upcoming <span class="text-theme-color-2">Events</span></h3>
              <?php 
				$sql=" select * ";
				$sql.=" from event_mas order by event_id desc limit 6 ";
				$sth = $conn->prepare($sql);
				$sth->execute();
				$ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
				$row = $sth->fetchAll();
				foreach ($row as $key => $value) 
				{
	
					$event_id=$value['event_id'];
					$event_content=$value['event_content'];
					$event_title=$value['event_title'];
					$event_date=$value['event_date'];
					$event_time=$value['event_time'];
					$event_place=$value['event_place'];
					$event_photo=$value['event_photo'];
					$middle = strtotime($event_date);  
					$new_date = date('M d, Y', $middle);
					?>
			  
              <article class="post media-post clearfix pb-0 mb-10">
                 <?php
				 if(!empty($event_photo))
				 {
					 ?>
                	<a href="#" class="post-thumb mr-20 col-sm-2"><img alt="<?php echo $event_title;?>" src="./admin-panel/uploads/<?php echo $event_photo;?>"></a>
                    <?php
				 }
				 ?>
                <div class="post-right">
                  <h4 class="mt-0 mb-5"><a href="#"><?php echo $event_title;?></a></h4>
                  <ul class="list-inline font-12 mb-5">
                  	<?php
					if(!empty($event_time))
					{
						?>
                    	<li class="pr-0"><i class="fa fa-calendar mr-5"></i><?php echo $new_date;?> |</li>
                        <?php
					}
					
					if(!empty($event_place))
					{
						?>
                    <li class="pl-5"><i class="fa fa-map-marker mr-5"></i><?php echo $event_place;?></li>
                     <?php
					}
					?>
                  </ul>
                  <p class="mb-0 font-13"><?php echo substr($event_content,0, 380); if(strlen($event_content)>80){ echo "....."; } ?></p>
                  
                </div>
              </article>
              <?php
				}
				?>
              
            </div>
           
            <!--<div class="col-md-6">
              <h3 class="line-bottom mt-0 line-height-1">Why <span class="text-theme-color-2">Choose Olivia?</span></h3>
              <p class="mb-10">The Cweren Law Firm is a recognized leader in landlord tenant representation throughout Texas.The largest professional property.</p>
              <div id="accordion1" class="panel-group accordion">
                <div class="panel">
                  <div class="panel-title"> <a class="active" data-parent="#accordion1" data-toggle="collapse" href="#accordion11" aria-expanded="true"> <span class="open-sub"></span> Why this Company is Best?</a> </div>
                  <div id="accordion11" class="panel-collapse collapse in" role="tablist" aria-expanded="true">
                    <div class="panel-content">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore impedit quae repellendus provident dolor iure poss imusven am aliquam. Officiis totam ea laborum deser unt vonsess.  iure poss imusven am aliquam</p>
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion12" class="" aria-expanded="true"> <span class="open-sub"></span> Why this Company is Best?</a> </div>
                  <div id="accordion12" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                    <div class="panel-content">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore impedit quae repellendus provident dolor iure poss imusven am aliquam. Officiis totam ea laborum deser unt vonsess.  iure poss imusven am aliquam</p>
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion13" class="" aria-expanded="true"> <span class="open-sub"></span> Why this Company is Best?</a> </div>
                  <div id="accordion13" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                    <div class="panel-content">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore impedit quae repellendus provident dolor iure poss imusven am aliquam. Officiis totam ea laborum deser unt vonsess.  iure poss imusven am aliquam</p>
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion14" class="" aria-expanded="true"> <span class="open-sub"></span> Why this Company is Best?</a> </div>
                  <div id="accordion14" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                    <div class="panel-content">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore impedit quae repellendus provident dolor iure poss imusven am aliquam. Officiis totam ea laborum deser unt vonsess.  iure poss imusven am aliquam</p>
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion15" class="" aria-expanded="true"> <span class="open-sub"></span> Why this Company is Best?</a> </div>
                  <div id="accordion15" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                    <div class="panel-content">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore impedit quae repellendus provident dolor iure poss imusven am aliquam. Officiis totam ea laborum deser unt vonsess.  iure poss imusven am aliquam</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>-->
          </div>
        </div>
      </div>
    </section>

    <!-- Divider: testimonials -->
    <section class="divider parallax layer-overlay overlay-theme-colored-9" data-background-ratio="0.5" data-bg-img="images/bg/bg2.jpg">
      <div class="container pb-50">
        <div class="section-title">
          <div class="row">
            <div class="col-md-6">
              
              <h2 class="mt-0 mb-0 text-uppercase line-bottom text-white font-28">Administration<span class="font-30 text-theme-color-2">.</span></h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-10">
           <div class="owl-carousel-3col boxed" data-dots="true">
			<?php 
            $sql=" select * ";
            $sql.=" from teacher_mas ";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
            $row = $sth->fetchAll();
            foreach ($row as $key => $value) 
            {  
                $name=$value['name'];
                $photo_path=$value['photo_path'];
                $desig=$value['desig'];
                ?>
              <div class="item">
                <div class="testimonial pt-10">
                  <div class="thumb pull-left mb-0 mr-0 pr-20">
                    <img  class="img-box col-sm-6" alt="<?php echo $name;?>" src="./admin-panel/uploads/<?php echo $photo_path;?>">
                    <p class="author mt-20">- <span class="text-theme-color-2"><?php echo $name; ?></span></p> 
                    <p class="author mt-20"> <small><em class="text-gray-lightgray"><?php echo $desig; ?></em></small></p> 
                  </div>
                  
                </div>
              </div>
              <?php
			}
			?>
            </div>
           </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: blog -->
    <section id="blog" class="bg-lighter">
      <div class="container">
        <div class="section-title mb-10">
          <div class="row">
            <div class="col-md-8">
              <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Latest <span class="text-theme-color-2 font-weight-400">News</span></h2>
           </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
           <?php 
			$sql=" select * ";
			$sql.=" from news_mas  ";
			$sql.=" order by valid_upto,news_id desc limit 3 ";
			//echo $sql;
			$sth = $conn->prepare($sql);
			$sth->execute();
			$ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
			$row = $sth->fetchAll();
			foreach ($row as $key => $value) 
			{
	
				$news_id=$value['news_id'];
				$news=$value['news'];
				$news_title=$value['news_title'];
				$valid_upto=$value['valid_upto'];
				$attach_file=$value['attach_file'];
				$middle = strtotime($valid_upto);  
				$new_date = date('d.M.Y', $middle);
				$news_dt=explode('.',$new_date);
				?> 
            <div class="col-xs-12 col-sm-6 col-md-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
              <article class="post clearfix mb-sm-30"
              >
                <div class="entry-header">
                  <div class="post-thumb thumb"> 
                    <img src="./admin-panel/uploads/<?php echo $attach_file; ?>" alt="<?php echo $news_title; ?>" class="img-responsive img-fullwidth"> 
                  </div>
                </div>
                <div class="entry-content p-20 pr-10 bg-white" style="min-height:200px;">
                  <div class="entry-meta media mt-0 no-bg no-border">
                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                      <ul>
                        <li class="font-16 text-white font-weight-600 border-bottom"><?php echo $news_dt[0]; ?></li>
                        <li class="font-12 text-white text-uppercase"><?php echo $news_dt[1]; ?></li>
                      </ul>
                    </div>
                    <div class="media-body pl-15">
                      <div class="event-content pull-left flip">
                        <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="#"><?php echo $news_title; ?></a></h4>
                       <!-- <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214 Comments</span>                       
                        <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-heart-o mr-5 text-theme-colored"></i> 895 Likes</span>  -->                     
                      </div>
                    </div>
                  </div>
                  <p class="mt-10"><?php echo substr($news,0, 80); if(strlen($news)>80){ echo "....."; } ?></p>
                  <a href="new.php?new=<?php echo md5($news_id); ?>" class="btn-read-more">Read more</a>
                  <div class="clearfix"></div>
                </div>
              </article>
            </div>
            <?php
			}
			?>
          </div>
        </div>
      </div>
    </section>

    <!-- Divider: Clients -->
    <section class="clients bg-theme-color-2">
      <div class="container pt-10 pb-0">
        <div class="row">
          <div class="col-md-12">
            <!-- Section: Clients -->
            
            <div class="owl-carousel-6col clients-logo transparent text-center owl-nav-top">
              <div class="item"> <a href="#"></a></div>
            
            </div>

          </div>
        </div>
      </div>
    </section>
  <!-- end main-content -->
  </div>
<?php include('./footer.php'); ?>
