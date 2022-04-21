<?php include('./header.php'); ?>  
<div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white">Facilities</h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="#">Home</a></li>
                <li class="active text-gray-silver">Infracture</li>
                <li class="active text-gray-silver">Facilities</li>
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
           <?php 
		   $i=0;
			$sql=" select * ";
			$sql.=" from facilities order by f_path desc  ";
			//echo $sql;
			$sth = $conn->prepare($sql);
			$sth->execute();
			$ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
			$row = $sth->fetchAll();
			foreach ($row as $key => $value) 
			{
				$i++;	
				$f_title=$value['f_title'];
				$f_content=$value['f_content'];
				$f_path=$value['f_path'];
				?> 
            <div class="col-xs-12 col-sm-6 col-md-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
              <article class="post clearfix mb-sm-30"
              >
                <div class="entry-header">
                
                <?php if(!empty($f_path)){
					?>
                  <div class="post-thumb thumb"> 
                    <img src="./admin-panel/uploads/<?php echo $f_path; ?>" alt="<?php echo $f_title; ?>" class="img-responsive img-fullwidth"> 
                  </div>
                  <?php
				}
				?>
                </div>
                <div class="entry-content p-20 pr-10 bg-white" style="min-height:200px;">
                  <div class="entry-meta media mt-0 no-bg no-border">
                    
                    <div class="media-body pl-15">
                      <div class="event-content pull-left flip">
                        <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="#"><?php echo $f_title; ?></a></h4>
                                       
                      </div>
                    </div>
                  </div>
                  <p class="mt-10"><?php echo $f_content; ?></p>
                  
                  <div class="clearfix"></div>
                </div>
              </article>
            </div>
            <?php
			
			if($i==3)
			{
				$i=0;
				?>
                </div>
                <div class="row">
                <?php
			}
			}
			?>
        </div>
      </div>
    </section>
    
    <!-- Section: Services -->
    
    
  </div>
<?php include('./footer.php'); ?>    