<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Page Permission For Details <?php echo "$users->user_nm"; ?> </h3>
      </div>
      <div class="card-body  table-responsive p-0">  
	   <?php echo form_open_multipart('admin/user/user_permission', array('id'=>'userpermission')); ?>	
          <?php echo form_hidden('uid',$users->uid); ?>
          <table class="table table-hover">
            <tr>
                <th>
                      <i class="fa fa-unlock"></i>
                </th>
                <th>Label 1</th>
                <th>Label 2</th>
                <th>Label 3</th>
               
            </tr>
            <?php
            $user_page=explode(',',$users->page_per);
            if($main_menu)
            {
			//	print_r($main_menu);
              foreach($main_menu as $level1):
                if ($level1['parent_id'] == 0)    
                {
                  $level1_id=$level1['id'];
                  ?>
                   <tr>
                      <td>
                        <input type="checkbox" name="checkbox[]" value="<?php echo $level1_id; ?>" 
                       <?php if(in_array($level1_id, $user_page)){ ?> checked="checked" <?php } ?>>
                      </td>
                      <td colspan="3"><?php echo $level1['title']; ?> </td>
                   </tr>
                   <?php
				 //  echo $level1_id;
                   foreach($main_menu as $level2):
                    if ($level2['parent_id'] == $level1_id)    
                    {
                      $level2_id=$level2['id'];
                      ?>
                       <tr>
                          <td colspan="2">
                            <input type="checkbox" name="checkbox[]" value="<?php echo $level2_id; ?>" 
                             <?php if(in_array($level2_id, $user_page)){ ?> checked="checked" <?php } ?>>
                          </td>
                          <td colspan="2"><?php echo $level2['title']; ?> </td>
                       </tr>
                       <?php

                      foreach($main_menu as $level3):
                      if ($level3['parent_id'] == $level2_id)    
                      {
                        $level3_id=$level3['id'];
                        ?>
                         <tr>
                            <td colspan="3">
                              <input type="checkbox" name="checkbox[]" value="<?php echo $level3_id; ?>" 
                             <?php if(in_array($level2_id, $user_page)){ ?> checked="checked" <?php } ?>>
                            </td>
                            <td><?php echo $level3['title']; ?> </td>
                         </tr>
                         <?php

                      }
                    endforeach;

                    }
                  endforeach;

                }
              endforeach;
              
            }
             ?>
          </table>
        </div>
        <div class="card-footer">
          <input type="submit" name="submit" id="submit" value="Unlock" class="btn btn-primary pull-right" tabindex="18" / >
        </div>
       </form>   
     </div>    	
  </div>
</div>
    
<?php
include('temp/footer.php');
include('include/user.php');
?>


