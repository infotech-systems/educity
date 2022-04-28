<?php
include('temp/header.php');
?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add Information</h3>
      </div>
      <div class="card-body"> 
       <?php echo form_open_multipart('admin/menu/adds', array('id'=>'menuadd')); ?>		
        <div class="col-md-6">
            <div class="form-group">
              <label for="Name" class="col-sm-4">Name</label>
              <div class="col-sm-8">
              	 <input type="text" name="menuname" id="menuname" tabindex="1" class="form-control" value="" maxlength="50" autofocus="autofocus" autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Url" class="col-sm-4">Uri</label>
              <div class="col-sm-8">
              	 <input type="text" name="menu_uri" id="menu_uri" tabindex="3" class="form-control" value="" maxlength="60" autofocus="autofocus" autocomplete="off">
               </div>
            </div>
            <div class="form-group">
              <label for="Position" class="col-sm-4">Position</label>
              <div class="col-sm-8">
              	<input type="text" name="position" id="position" tabindex="4" class="form-control" value="" autocomplete="off">      
               </div>
            </div>
             <div class="form-group">
              <label for="Parent Menu" class="col-sm-4">Parent Menu</label>
              <div class="col-sm-8">
              	 <select name="parent_menu" id="parent_menu" class="form-control select2" tabindex="2">
                   <option value=""> </option>
                   <?php
                    foreach($menus as $menu)
                    {                                       
                        ?>
                        <option value="<?php echo $menu['id']; ?>">
                            <?php echo $menu['title']; ?>
                        </option>
                        <?php
                    }
                    ?>                                   
                 </select>
               </div>
            </div>
            <div class="form-group">
              <label for="Publish" class="col-sm-4">Publish</label>
              <div class="col-sm-8">
              	 <select name="menu_publish" id="menu_publish" class="form-control select2" tabindex="5">
                   <option value="1">Yes </option>
                   <option value="0"> No</option>
                </select>
               </div>
            </div>
         </div> 
         <div class="col-md-6">
         	<div class="form-group">
              <label for="Url" class="col-sm-4">Url</label>
              <div class="col-sm-8">
              	 <input type="text" name="menu_url" id="menu_url" tabindex="3" class="form-control" value="" maxlength="50" autofocus="autofocus" autocomplete="off">
               </div>
            </div>
            
            <div class="form-group">
              <label for="Group" class="col-sm-4">Group</label>
              <div class="col-sm-8">
              	 <select name="group" id="group" class="form-control select2" tabindex="5">
                   <option value="2">Sidebar </option>
                   <option value="1"> Header</option>
                </select>
               </div>
            </div>
            <div class="form-group">
              <label for="Target" class="col-sm-4">Target</label>
              <div class="col-sm-8">
              	 <select name="target" id="target" class="form-control select2" tabindex="5">
                   <option value="">Same </option>
                   <option value="_blank"> New</option>
                </select>
               </div>
            </div>
           
            
            <div class="form-group">
              <label for="Publish" class="col-sm-4">Parent</label>
              <div class="col-sm-8">
              	 <select name="parent" id="parent" class="form-control select2" tabindex="5">
                   <option value="0">No </option>
                   <option value="1"> Yes</option>
                </select>
               </div>
            </div>
            <div class="form-group">
              <label for="Type" class="col-sm-4">Type</label>
              <div class="col-sm-8">
              	 <select name="type" id="type" class="form-control select2" tabindex="5">
                   <option value="W">Web Site </option>
                </select>
               </div>
            </div>
         </div> 
          
      </div>
      <div class="card-footer">
            <input type="submit" name="submit" id="submit" class="btn btn-primary float-right" value="Add">
           
      </div>
    </div>   
  </div>
</div>

<?php
include('temp/footer.php');
include('include/menu.php');
?>

