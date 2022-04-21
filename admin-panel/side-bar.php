<div class="sidebar-nav">
        <form class="search form-inline">
            <input type="text" name="search" id="search" placeholder="<?php echo $ses_user_nm; ?>" readonly="readonly" >
        </form>

        <?php
        $sql="select * from menu_master ";
        $sql.="where parent_id='0' and show_tag='T' ";
        $sql.="order by srl";
        $sth = $conn->prepare($sql);
        $sth->execute();
        $ss=$sth->setFetchMode(PDO::FETCH_ASSOC);
        $row = $sth->fetchAll();
        foreach ($row as $key => $value) 
        {

              $mbody=$value['mbody'];
              $murl=$value['murl']; 
              $mid1=$value['mid'];     
        ?> 
       <?php 
       if(empty($ses_page_per))
        {
          $ses_page_per=0;
        }

        $sqlc ="select count(mid) as cnt from menu_master ";
        $sqlc.="where parent_id=:mid1 and show_tag='T' ";
        $sthc = $conn->prepare($sqlc);
        $sthc->bindParam(':mid1', $mid1);
        $sthc->execute();
        $ssc=$sth->setFetchMode(PDO::FETCH_ASSOC);
        $rowc = $sthc->fetchAll();
        foreach ($rowc as $keyc => $valuec) 
        {
        $cnt=$valuec['cnt'];
        }
        if($cnt>=1){
          $murl1="#$mbody-menu";
        }
        else{
          
            $murl1="./$murl";
           
        }
      //  echo $murl1;
        ?>

   
 <a href="<?php echo $murl1; ?>" class="nav-header" <?php if($cnt>=1){?>data-toggle="collapse"<?php }?>><?php echo $mbody; ?></a>
       
          <?php
      if(!empty($mid1))
         {
      ?>
   <?php
      $ct=0;
      $sql_sub ="select *  from menu_master ";
      $sql_sub.="where parent_id=:mid1 and show_tag='T' ";
      if($ses_user_type!="A")
      {
      $sql_sub.="and mid in(:ses_page_per) ";
      }
      $sql_sub.="order by srl";
    //echo $sql_sub;
      $sths = $conn->prepare($sql_sub);
      $sths->bindParam(':mid1', $mid1);
      if($ses_user_type!="A")
      {
      $sths->bindParam(':ses_page_per', $ses_page_per);
      }
      $sths->execute();
      $sss=$sths->setFetchMode(PDO::FETCH_ASSOC);
      $rows = $sths->fetchAll();
      $ct=count($rows);


    if($ct>0)
    {
    ?>
      <ul id="<?php echo $mbody; ?>-menu" class="nav nav-list collapse out">
      <?php     
           foreach ($rows as $keys => $values) 
            {
            
             $mbody_sub=$values['mbody'];
             $murl_sub=$values['murl'];         
          ?> 
            <li><a href="./<?php echo $murl_sub; ?>"><?php echo $mbody_sub; ?></a></li>
            <?php
       }
         ?>
        </ul> 
         <?php
    }
    }
  }
    ?>    
  </div>