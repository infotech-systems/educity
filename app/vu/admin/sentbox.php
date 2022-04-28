<?php
include('temp/header.php');
if($offset=='')
{
    $ss=$offset+1;
}
else
{
    $ss=$offset;
}
$end=$ss*$limit;
$start=$end-$limit;
if($end>$total)
{
    $end=$total;
}
if($start==0)
{
    $start=1;
}
//echo "dd $end $start";
?>
<div class="row">
<div class="col-md-3">
    <a href="<?php echo base_url('admin/mailbox/compose'); ?>" class="btn btn-primary btn-block mb-3">Compose</a>

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
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="far fa-circle text-danger"></i>
            Important
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="far fa-circle text-warning"></i> Promotions
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="far fa-circle text-primary"></i>
            Social
            </a>
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
        <h3 class="card-title">Sent Mail</h3>

        <div class="card-tools">
        <div class="input-group input-group-sm">
            <input type="text" class="form-control" placeholder="Search Mail">
            <div class="input-group-append">
            <div class="btn btn-primary">
                <i class="fas fa-search"></i>
            </div>
            </div>
        </div>
        </div>
        <!-- /.card-tools -->
    </div>
    <style>
        #show
        {
            visibility:hidden !important;
            width:0px !important;
        }
        </style>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="mailbox-controls">
        <!-- Check all button -->
        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
        </button>
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-reply"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i></button>
        </div>
        <!-- /.btn-group -->
        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
        <div class="float-right">
            <?php echo "$start - $end"; ?>/<?php echo $total; ?>
            <div class="btn-group">
                 <?php  echo $this->pagination->create_links(); ?>      
            </div>
            <!-- /.btn-group -->
        </div>
        <!-- /.float-right -->
        </div>
        
        <div class="table-responsive mailbox-messages">
        <table class="table table-hover table-striped">
            <tbody>
            <?php
           
            if($mails):
                foreach($mails as $mail):
                 //   print_r($mail);
                   $id=$mail['mail_id'];
                   $mail_time =strtotime($mail['mail_time']);
                    $now = time();
                    $units = 1;
                    $ago_time= timespan($mail_time, $now, $units);
                    ?>
                    <tr>
                    <td>
                        <div class="icheck-primary">
                        <input type="checkbox" value="<?php echo $id; ?>" id="check<?php echo $id; ?>">
                        <label for="check1"></label>
                        </div>
                    </td>
                    <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
                    <td class="mailbox-name"><a href="<?php echo base_url('admin/mailbox/read/'.$id); ?>"><?php echo $mail['sender_name']; ?></a></td>
                    <td class="mailbox-subject"><b><?php echo $mail['mail_subject']; ?></b> - <?php echo word_limiter($mail['mail_message'],5); ?>
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?php echo $ago_time; ?> ago</td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            </tbody>
        </table>
        <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
    </div>
    <!-- /.card-body -->
    
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
</div>
<?php
include('temp/footer.php');
?>