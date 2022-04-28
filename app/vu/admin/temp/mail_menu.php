<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
        <li class="nav-item active">
            <a href="<?php echo base_url('admin/mailbox'); ?>" class="nav-link">
            <i class="fas fa-inbox"></i> Inbox
            <span class="badge bg-primary float-right">12</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('admin/mailbox/sent'); ?>" class="nav-link">
            <i class="far fa-envelope"></i> Sent
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('admin/mailbox/draft'); ?>" class="nav-link">
            <i class="far fa-file-alt"></i> Drafts
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('admin/mailbox/junk'); ?>" class="nav-link">
            <i class="fas fa-filter"></i> Junk
            <span class="badge bg-warning float-right">65</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo base_url('admin/mailbox/trash'); ?>" class="nav-link">
            <i class="far fa-trash-alt"></i> Trash
            </a>
        </li>
        </ul>
    </div>