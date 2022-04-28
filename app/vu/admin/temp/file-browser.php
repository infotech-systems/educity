
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Media</title>
	<?php echo link_tag('assets/admin/plugins/font-awesome/css/font-awesome.min.css'); ?>
    <?php echo link_tag('assets/admin/dist/css/adminlte.min.css'); ?>
    <?php echo link_tag('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?> 
     <?php echo link_tag('assets/admin/css/filebowser.css'); ?>
    
</head>
<body>
<div class="row">
    <div class="col-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Image</a>
          <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">File</a>
        </div>
     </div>
     <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <?php 
          if($medias)
          {
              $image_ext=array('.gif','.jpg','.jpeg','.png','.bmp','.tiff');
              foreach($medias as $media):
              $media_nm=explode('/',$media['media_path']);
              if(in_array($media['med_extn'],$image_ext))
              {
                  
                  ?>
                  <div class="file-box" onclick="returnFileUrl<?php echo $media['media_id']; ?>()">
                        <div class="file">
                            <a href="#">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt=" <?php echo $media_nm[3]; ?>" class="img-responsive" src="<?php echo base_url($media['media_path']); ?>" width="200">
                                </div>
                                <div class="file-name">
                                    <?php echo $media_nm[3]; ?>
                                </div>
                            </a>
    
                        </div>
                   </div>
                 <script>
                // Helper function to get parameters from the query string.
                function getUrlParam( paramName ) {
                    var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
                    var match = window.location.search.match( reParam );
        
                    return ( match && match.length > 1 ) ? match[1] : null;
                }
                // Simulate user action of selecting a file to be returned to CKEditor.
                function returnFileUrl<?php echo $media['media_id']; ?>() {
                    var funcNum = getUrlParam( 'CKEditorFuncNum' );
                    var fileUrl = '<?php echo base_url($media['media_path']); ?>';
                    window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl, function() {
                        // Get the reference to a dialog window.
                        var dialog = this.getDialog();
                        // Check if this is the Image Properties dialog window.
                        if ( dialog.getName() == 'image' ) {
                            // Get the reference to a text field that stores the "alt" attribute.
                            var element = dialog.getContentElement( 'info', 'txtAlt' );
                            // Assign the new value.
                            if ( element )
                                element.setValue( 'alt text' );
                        }
                        // Return "false" to stop further execution. In such case CKEditor will ignore the second argument ("fileUrl")
                        // and the "onSelect" function assigned to the button that called the file manager (if defined).
                        // return false;
                    } );
                    window.close();
                }
            </script>
                <?php
              }
              endforeach;
          }
          ?>
                
          </div>
          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          <?php 
          if($medias)
          {
              $image_ext=array('.gif','.jpg','.jpeg','.png','.bmp','.tiff');
              foreach($medias as $media):
              $media_nm=explode('/',$media['media_path']);
              if(!in_array($media['med_extn'],$image_ext))
              {
                  
                  ?>
                  <div class="file-box"  onclick="returnFileUrl<?php echo $media['media_id']; ?>()">
                    <div class="file">
                        <a href="#">
                            <span class="corner"></span>
                            <div class="icon">
                            <?php
                            if(in_array($media['med_extn'],array('.pdf')))
                            {
                                ?>
                                <i class="fa fa-file-pdf-o"></i>
                                <?php
                            }
                            ?>
                             <?php
                            if(in_array($media['med_extn'],array('.xls','.xlsx')))
                            {
                                ?>
                                <i class="fa fa-file-excel-o"></i>
                                <?php
                            }
                            ?>
                             <?php
                            if(in_array($media['med_extn'],array('.doc','.docx')))
                            {
                                ?>
                                <i class="fa fa-file-word-o"></i>
                                <?php
                            }
                            if(in_array($media['med_extn'],array('.txt')))
                            {
                                ?>
                                <i class="fa  fa-file-text"></i>
                                <?php
                            }
                            if(in_array($media['med_extn'],array('.zip','.rar')))
                            {
                                ?>
                                <i class="fa fa-file-zip-o"></i>
                                <?php
                            }
                            ?>
                            </div>
                            <div class="file-name">
                               <?php echo $media_nm[3]; ?>
                                <br>
                            </div>
                        </a>
                    </div>
                </div>
                 <script>
                // Helper function to get parameters from the query string.
                function getUrlParam( paramName ) {
                    var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
                    var match = window.location.search.match( reParam );
        
                    return ( match && match.length > 1 ) ? match[1] : null;
                }
                // Simulate user action of selecting a file to be returned to CKEditor.
                function returnFileUrl<?php echo $media['media_id']; ?>() {
                    var funcNum = getUrlParam( 'CKEditorFuncNum' );
                    var fileUrl = '<?php echo base_url($media['media_path']); ?>';
                    window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl, function() {
                        // Get the reference to a dialog window.
                        var dialog = this.getDialog();
                        // Check if this is the Image Properties dialog window.
                        if ( dialog.getName() == 'image' ) {
                            // Get the reference to a text field that stores the "alt" attribute.
                            var element = dialog.getContentElement( 'info', 'txtAlt' );
                            // Assign the new value.
                            if ( element )
                                element.setValue( 'alt text' );
                        }
                        // Return "false" to stop further execution. In such case CKEditor will ignore the second argument ("fileUrl")
                        // and the "onSelect" function assigned to the button that called the file manager (if defined).
                        // return false;
                    } );
                    window.close();
                }
            </script>
                <?php
              }
              endforeach;
          }
          ?>
          </div>
        </div>
    </div>
    </div>
       
      <!-- /.row -->
      <!-- END CUSTOM TABS -->
  <script src="<?php echo base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/dist/js/adminlte.js"></script>
<style>

 </style>
<!--
</body>
</html>-->


     