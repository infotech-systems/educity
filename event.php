<?php include('./header.php'); ?>  
<?php
$eve = isset($_REQUEST['eve']) ? $_REQUEST['eve'] : '';
if(!empty($eve))
{
	$sqlE="select *  from event_mas where md5(event_id)=:eve ";
	$sthE = $conn->prepare($sqlE);
	$sthE->bindParam(':eve', $eve);
	$sthE->execute();
	$ssE=$sthE->setFetchMode(PDO::FETCH_ASSOC);
	$rowE = $sthE->fetch();
	$event_date=$rowE['event_date'];
	$event_title=$rowE['event_title'];
	$event_time=$rowE['event_time'];
	$event_place=$rowE['event_place'];
	$event_content=$rowE['event_content'];
	$event_photo=$rowE['event_photo'];
}
?>
<div class="main-content">
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white"><?php echo $event_title; ?></h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="#">Home</a></li>
                
                <li class="active text-gray-silver">Event</li>
                <li class="active text-gray-silver"><?php echo $event_title; ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: About -->
    <section>
      <div class="container">
       <?php
	   if(!empty($event_photo))
	   {
		   ?>
        <div class="row">
          <div class="col-md-12">
            <img src="./admin-panel/uploads/<?php echo $event_photo; ?>" alt="<?php echo $event_title; ?>">
          </div>
        </div>
        <?php
	   }
	   ?>
        <div class="row mt-60">
          <div class="col-md-12">
            <h4 class="mt-0"><?php echo $event_title; ?></h4>
            <?php echo $event_content; ?>
          </div>
        </div>
        
      </div>
    </section>
  </div>
<?php include('./footer.php'); ?>    