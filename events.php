<?php include('./header.php'); ?>  
<div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/bg/bg3.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white">Event</h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="#">Home</a></li>
                
                <li class="active text-gray-silver">Event</li>
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
				$new_date = date('M.d.Y', $middle);
				$eventdt=explode('.',$new_date);
				if((empty($event_time)) and (empty($event_place)))
				{
					$size="8";
					$e_content=substr($event_content,0,300);
				}
				else
				{
					$size="4";
					$e_content=substr($event_content,0,100);
				}
				
				?>
            <div class="upcoming-events bg-white-f3 mb-20">
              <div class="row">
                <div class="col-sm-4 pr-0 pr-sm-15">
                  <div class="thumb p-15">
                    <img class="img-fullwidth"  alt="<?php echo $event_title;?>" src="./admin-panel/uploads/<?php echo $event_photo;?>">
                  </div>
                </div>
                <div class="col-sm-<?php echo $size;?> pl-0 pl-sm-15">
                  <div class="event-details p-15 mt-20">
                    <h4 class="mt-0 text-uppercase font-weight-500"><?php echo $event_title;?></h4>
                    <p><?php echo $event_content;?></p>
                    <a href="./event.php?eve=<?php echo md5($event_id); ?>" class="btn btn-flat btn-dark btn-theme-colored btn-sm mt-10">Details <i class="fa fa-angle-double-right"></i></a>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="event-count p-15 mt-15">
                    <ul class="event-date list-inline font-16 text-uppercase mt-10 mb-20">
                    	<?php if(!empty($event_time))
						{
							
							?>
                      	<li class="p-15 mr-5 bg-lightest"><?php echo $eventdt[0]; ?></li>
                      	<li class="p-15 pl-20 pr-20 mr-5 bg-lightest"><?php echo $eventdt[1]; ?></li>
                      	<li class="p-15 bg-lightest"><?php echo $eventdt[2]; ?></li>
                        <?php
						}
						?>
                    </ul>
                    <ul>
                    <?php if(!empty($event_time))
					{
						?>
                      <li class="mb-10"><a href="#"><i class="fa fa-clock-o mr-5"></i> at <?php echo $event_time;?></a></li>
                      <?php
					}
					 if(!empty($event_place))
					{
						?>
                      <li><a href="#"><i class="fa fa-map-marker mr-5"></i> <?php echo $event_place;?></a></li>
                      <?php
					}
					?>
                    </ul>
                  </div>
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
    
    <!-- Section: Services -->
    
    
  </div>
<?php include('./footer.php'); ?>    