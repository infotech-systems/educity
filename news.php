<?php include('./header.php'); ?>  
<div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white">News</h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="#">Home</a></li>
                
                <li class="active text-gray-silver">News</li>
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
			$sql=" select * ";
			$sql.=" from news_mas  ";
			$sql.=" order by valid_upto,news_id desc  ";
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
    </section>
    
    <!-- Section: Services -->
    
    
  </div>
<?php include('./footer.php'); ?>    