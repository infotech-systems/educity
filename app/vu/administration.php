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
<style>
    p
    {
        margin:0 0 5px;
    }
    .educaremember-area .singlemember-area .member-over .member-name p {
  font-size: 16px;
  line-height: 16px;
  margin-bottom: 10px;
}
</style>
 <!-- educaremember one area start Here -->
 <div class="educaremember-area">
            <div class="container">
              <div class="row">
                <?php
                if($administrations):
                    foreach($administrations as $administration):
                        if(empty($administration['photo_path']))
                        {
                            $administration['photo_path']='assets/public/images/user.png';
                        }
                    ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="singlemember-area">
                            <div class="member-img">
                                <img src="<?php echo base_url($administration['photo_path']); ?>" alt="<?php echo $administration['adm_nm'].' - '.$administration['adm_desig']; ?>"  title="<?php echo $administration['adm_nm'].' - '.$administration['adm_desig']; ?>">
                            </div>
                            <div class="member-title">
                                <img src="<?php echo base_url('images/member/shape.png'); ?>" alt="">
                            </div>
                            <div class="member-over">
                                <div class="hover-img">
                                    <img src="<?php echo base_url($administration['photo_path']); ?>" alt="<?php echo $administration['adm_nm'].' - '.$administration['adm_desig']; ?>"  title="<?php echo $administration['adm_nm'].' - '.$administration['adm_desig']; ?>">
                                </div>
                                <div class="member-name">
                                    <h4><a href="#"><?php echo $administration['adm_nm']; ?></a></h4>
                                    <p>Designation: <?php echo $administration['adm_desig']; ?></p>
                                    <?php
                                    if(!empty($administration['subject'])):
                                        ?>
                                        <p>Subject: <?php echo $administration['subject']; ?></p>
                                        <?php
                                    endif;
                                    ?>
                                    <p>Contact No: <?php echo $administration['contact_no']; ?></p>
                                    <p>Email: <?php echo $administration['email_id']; ?></p>
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
        <!-- educaremember one-area end Here -->
