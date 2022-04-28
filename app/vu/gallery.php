<div class="header-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 sol-xs-12">
            <div class="breadcrumbs-title text-center">
                <h2><?php echo $page->page_name; ?></h2>
                <div class="subheader-pages">
                <ul>
                    <li>Home</li>
                    <li><?php echo $page->page_name; ?></li>
                </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<section id="gallery">
    <div class="gallery-area ">
      <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="section-title text-center">
                    <h2>BGMS Gallery</h2>
                    <img src="<?php echo base_url('assets/public/images/shaparator.png'); ?>" alt="shaparator">
                </div>
            </div>
        </div>
        <div class="row">
          <div class="gallary-menu">
            <ul>
              <li class="active" data-filter="*">all</li>
              <?php
              if($categorys):
                foreach($categorys as $cat):
                ?>
                <li data-filter=".<?php echo $cat['cat_slug'] ?>"><?php echo $cat['cat_nm']; ?></li>
                <?php
                endforeach;
              endif;
              ?>
          </div>
        </div>
        <div class="row">
          <div class="filter-gallary">
            <?php
            if($categorys):
                foreach($photos as $photo):
                  ?>
                  <div class="single-gallary <?php echo $photo['cat_slug']; ?>">
                    <div class="gallary-img">
                      <img src="<?php echo base_url($photo['photo_path']); ?>">
                      <div class="gallary-overlay">
                        <div class="overlay-content">
                          <div class="gallary-title">
                            <h3><?php echo $photo['photo_nm']; ?> <span><?php echo $orgn[0]['orgn_nm']; ?></span></h3>
                          </div>
                          <div class="galary-cosial">
                            <ul>
                              <li><a href="<?php echo base_url($photo['photo_path']); ?>"  data-rel="lightcase"><i class="fa fa-photo"></i></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                endforeach; 
            endif;
            ?>
           
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- gallery area end Here -->