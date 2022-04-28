<?php
include('temp/header.php');
?>
<div class="row">
    <div class="col-md-3">
    <a href="<?php echo base_url('admin/mailbox'); ?>" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Folders</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
        </div>
        <?php include('temp/mail_menu.php');  ?>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Labels</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
            <a class="nav-link" href="#"><i class="far fa-circle text-danger"></i> Important</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#"><i class="far fa-circle text-warning"></i> Promotions</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i> Social</a>
            </li>
        </ul>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
<div class="col-md-9">
    <div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Read Mail</h3>

        <div class="card-tools">
        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fas fa-chevron-left"></i></a>
        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
    <!-- /.card-header -->
    <?php
    $mail_time1= DateTime::createFromFormat('Y-m-d H:i:s', $mail->mail_time); 
    $mail_time= $mail_time1->format('d M. Y h:i A'); 
    if($mail->mail_type=='I')
    {
        $from='From';
    }
    else{
        $from='To'; 
    }
    ?>
    <div class="card-body p-0">
        <div class="mailbox-read-info">
        <h5><?php echo $mail->mail_subject; ?></h5>
        <h6><?php echo $from; ?>: <?php echo $mail->sender_name; ?>(<?php echo $mail->mail_from; ?>)
            <span class="mailbox-read-time float-right"><?php echo $mail_time; ?></span></h6>
        </div>
        <!-- /.mailbox-read-info -->
        <div class="mailbox-controls with-border text-center">
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
            <i class="far fa-trash-alt"></i></button>
            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
            <i class="fa fa-reply"></i></button>
            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
            <i class="fas fa-share"></i></button>
        </div>
        <!-- /.btn-group -->
        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
            <i class="fas fa-print"></i></button>
        </div>
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
        <?php echo $mail->mail_content;  ?>
        </div>
        <!-- /.mailbox-read-message -->
    </div>
    <!-- /.card-body -->
    <?php
    if($mail->attachments):
        $attachments=explode(',',$mail->attachments);
        ?>
        <div class="card-footer bg-white">
            <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
            <?php
            foreach($attachments as $attachment):
                $path_parts = pathinfo($attachment);
                if(in_array($path_parts['extension'],array('jpg','png','gif','jpeg'))):
                    ?>
                    <li>
                        <span class="mailbox-attachment-icon has-img"><img src="<?php echo base_url($attachment); ?>" alt="<?php echo $path_parts['basename']; ?>"></span>

                        <div class="mailbox-attachment-info">
                        <a href="<?php echo base_url('admin/mailbox/download/'.$path_parts['basename']); ?>" class="mailbox-attachment-name"><i class="fas fa-photo"></i> <?php echo $path_parts['basename']; ?></a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                                <span><?php echo filesize($attachment); ?> Byte</span>
                                <a href="<?php echo base_url('admin/mailbox/download/'.$path_parts['basename']); ?>" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                            </span>
                        </div>
                    </li>
                    <?php
                elseif(in_array($path_parts['extension'],array('pdf'))):
                ?>
                <li>
                    <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

                    <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> <?php echo $path_parts['basename']; ?></a>
                        <span class="mailbox-attachment-size clearfix mt-1">
                            <span><?php echo filesize($attachment); ?> Byte</span>
                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                    </div>
                </li>
                <?php
                elseif(in_array($path_parts['extension'],array('doc','docx'))):
                ?>
                <li>
                    <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>

                    <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> <?php echo $path_parts['basename']; ?></a>
                        <span class="mailbox-attachment-size clearfix mt-1">
                            <span><?php echo filesize($attachment); ?> Byte</span>
                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                    </div>
                </li>
                <?php
                elseif(in_array($path_parts['extension'],array('xls','xlsx'))):
                ?>
                <li>
                    <span class="mailbox-attachment-icon"><i class="far fa-file-xls"></i></span>

                    <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> <?php echo $path_parts['basename']; ?></a>
                        <span class="mailbox-attachment-size clearfix mt-1">
                            <span><?php echo filesize($attachment); ?> Byte</span>
                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                    </div>
                </li>
                <?php
                elseif(in_array($path_parts['extension'],array('zip','rar'))):
                    ?>
                    <li>
                        <span class="mailbox-attachment-icon"><i class="far fa-file-zip"></i></span>
    
                        <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i><?php echo $path_parts['basename']; ?></a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                                <span><?php echo filesize($attachment); ?> Byte</span>
                                <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                            </span>
                        </div>
                    </li>
                    <?php
                endif;
            endforeach;
            ?>
        </ul>

    </div>
    <?php
    endif;
    ?>
    <!-- /.card-footer -->
    <div class="card-footer">
        <div class="float-right">
        <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
        <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
        </div>
        <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
        <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
    </div>
    <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
<?php
include('temp/footer.php');
?>