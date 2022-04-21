<div class="content">
        <div class="header">
             <h1 class="page-title"><a href="index.php" style="color:#666;">Dashboard</a></h1>
        </div>
        
        <ul class="breadcrumb">
          
        <?php
		 $sql_p="select mbody,parent_id,sub_id from menu_master ";
         $sql_p.="where murl=:current_page ";
         $sthp = $conn->prepare($sql_p);
	     $sthp->bindParam(':current_page', $current_page);
	     $sthp->execute();
	     $ssp=$sthp->setFetchMode(PDO::FETCH_ASSOC);
	     $rowp = $sthp->fetchAll();
		 foreach ($rowp as $keyp => $valuep) 
		 {				
			$mbody_p=$valuep['mbody'];
			$parent_id_p=$valuep['parent_id'];
			$sub_id_p=$valuep['sub_id'];
		 }
		
		if(!empty($parent_id_p))
		{
		 $sql_h="select mbody from menu_master ";
         $sql_h.="where mid=:parent_id_p ";
         $sthh = $conn->prepare($sql_h);
	     $sthh->bindParam(':parent_id_p', $parent_id_p);
	     $sthh->execute();
	     $ssh=$sthh->setFetchMode(PDO::FETCH_ASSOC);
	     $rowh = $sthh->fetchAll();
		 foreach ($rowh as $keyh => $valueh) 
		 {								
			$mbody_h=$valueh['mbody'];
		 }	
		?>
            
        <li><a href="index.php"><?php echo $mbody_h; ?></a></li>
        <?php
		}
		
        if(!empty($sub_id_p))
        {
			 $sql_g="select mbody,murl from menu_master ";
	         $sql_g.="where mid=:sub_id_p and parent_id=:parent_id_p ";
			// echo $sql_g;
	         $sthg = $conn->prepare($sql_g);
		     $sthg->bindParam(':sub_id_p', $sub_id_p);
	     	 $sthg->bindParam(':parent_id_p', $parent_id_p);
		     $sthg->execute();
		     $ssg=$sthg->setFetchMode(PDO::FETCH_ASSOC);
		     $rowg = $sthg->fetchAll();
			 foreach ($rowg as $keyg => $valueg) 
			 {								
				$mbody_g=$valueg['mbody'];
				$murl_g=$valueg['murl'];
			 }	
			?>
            
            <li><span class="divider">>></span><a href="<?php echo $murl_g; ?>"><?php echo $mbody_g; ?></a> </li>
            <?php
			}
			?>
			 <li class="active"> 
			 	<?php  if($current_page!="index.php")
			 	{ if(!empty($parent_id_p))
			 	{
			 	?>
			 	<span class="divider">>></span>
			 	<?php 
			 	}} 
			 	echo $mbody_p; 
			 	?>
			 </li>
        </ul>
