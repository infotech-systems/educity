<?php include('./header.php'); ?>  
<div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white">Gallery</h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="#">Home</a></li>
                <li class="active text-gray-silver">Gallery</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: About -->
    <section>
      <div class="container">
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
            <div id="grid" class="gallery-isotope grid-3 gutter clearfix">

              <!-- Portfolio Item Start -->
               <?php
				$SqlG= "select cat_id,photo_nm,small_path,big_path ";
				
				$SqlG.=" from gallery_master ";
				//echo $sqlG;
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
            </div>
            <!-- End Portfolio Gallery Grid -->
          </div>
        </div>
      </div>
    </section>
    
    <!-- Section: Services -->
    
    
  </div>
<?php include('./footer.php'); ?>    