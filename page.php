<?php include('./header.php'); ?>  
<?php
$hr_id = isset($_REQUEST['hr_id']) ? $_REQUEST['hr_id'] : '';

 $sqlp ="select page_name,page_content,parent_id ";
 $sqlp.="from page_master where ";
 $sqlp.="md5(page_id)=:hr_id";
// echo $sqlp;
 $sthp = $conn->prepare($sqlp);
 $sthp->bindParam(':hr_id', $hr_id);
 $sthp->execute();
 $ssp=$sthp->setFetchMode(PDO::FETCH_ASSOC);
 $rowp = $sthp->fetch();
 $s_page_name=$rowp['page_name'];
 $s_page_content=$rowp['page_content'];
 $parent_id=$rowp['parent_id'];
 
// echo $s_page_name;

 ?>
<div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white"><?php echo $s_page_name; ?></h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="#">Home</a></li>
                <?php
				if(($parent_id>0) or ($parent_id!=null))
				{
					 $sqlg ="select page_name ";
					 $sqlg.="from page_master where ";
					 $sqlg.="page_id=:parent_id";
					 $sthg = $conn->prepare($sqlg);
					 $sthg->bindParam(':parent_id', $parent_id);
					 $sthg->execute();
					 $ssg=$sthg->setFetchMode(PDO::FETCH_ASSOC);
					 $rowg = $sthg->fetch();
					 $g_page_name=$rowg['page_name'];
					 ?>
                    <li><a href="#"><?php echo $g_page_name; ?></a></li>
                    <?php
				}
				?>
                <li class="active text-gray-silver"><?php echo $s_page_name; ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: About -->
    <section class="">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h6 class="letter-space-4 text-gray-darkgray text-uppercase mt-0 mb-0">All About</h6>
              <h2 class="text-uppercase font-weight-600 mt-0 font-28 line-bottom"><?php echo $s_page_name; ?></h2>
              <?php echo $s_page_content; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Section: Services -->
    
    
  </div>
<?php include('./footer.php'); ?>    