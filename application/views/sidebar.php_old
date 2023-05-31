<?php
if(empty($_SESSION['afrebay']['userId']))
{
redirect(base_url('login'));
}
$seg1=$this->uri->segment(1);
?>
<section class="dashboard-gig User_Sidemenu">
    <div class="container-fluid display-table" style="display: block;">
        <div class="row display-table-row">
            <div class="col-md-12 col-md-12 col-sm-12 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="navi">
                    <ul>
                        <?php if(@$_SESSION['afrebay']['userType']=='2') { ?>
                        <li <?php if($seg1=='subscription') { ?> class="active" <?php } ?>>
                            <a href="<?= base_url('subscription')?>"><i class="fa fa-bookmark" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Subscription</span>
                            </a>
                        </li>
                        <?php } ?>

                        <li <?php if($seg1=='profile') { ?> class="active" <?php } ?>>
                            <?php if(@$_SESSION['afrebay']['userType']=='2') {
                            $get_sub_data = $this->db->query("SELECT * FROM employer_subscription where employer_id = ".$_SESSION['afrebay']['userId']." and payment_status = 'paid'")->result_array();
                            if(!empty($get_sub_data)) {
                            ?>
                            <a href="<?= base_url('profile')?>"><i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Profile</span>
                            </a>
                            <?php } else { ?>
                            <a href="javascript:void(0)"><i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Profile</span>
                            </a>
                            <?php } } else { ?>
                            <a href="<?= base_url('profile')?>"><i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Profile</span>
                            </a>
                            <?php } ?>
                        </li>

                        <?php if(@$_SESSION['afrebay']['userType']=='1') { ?>
                        <li <?php if($seg1=='education-list') { ?>class="active" <?php } ?>>
                            <a href="<?= base_url('education-list')?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Education</span>
                            </a>
                        </li>
                        <li <?php if($seg1=='workexperience-list') { ?>class="active" <?php } ?>>
                            <a href="<?= base_url('workexperience-list')?>"><i class="fa fa-id-card" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Work Experience</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php if(@$_SESSION['afrebay']['userType']=='2') {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription where employer_id = ".$_SESSION['afrebay']['userId']." and payment_status = 'paid'")->result_array();
                        if(!empty($get_sub_data)) {
                        $profile_check = $this->db->query("SELECT `profilePic`, `companyname`, `email`, `mobile`,`address`, `foundedyear`, `teamsize`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                        if(in_array('', $profile_check[0])) { ?>
                        <li <?php if($seg1=='myjob') { ?> class="active" <?php } ?>>
                            <a href="javascript:void(0)"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <li <?php if($seg1=='jobbid') { ?> class="active" <?php } ?>>
                            <a href="javascript:void(0)"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">List of Bids</span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li <?php if($seg1=='myjob') { ?> class="active" <?php } ?>>
                            <a href="<?= base_url('myjob')?>"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <li <?php if($seg1=='jobbid') { ?> class="active" <?php } ?>>
                            <a href="<?= base_url('jobbid')?>"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">List of Bids</span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg1=='myjob') { ?> class="active" <?php } ?>>
                            <a href="javascript:void(0)"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <li <?php if($seg1=='jobbid') { ?> class="active" <?php } ?>>
                            <a href="javascript:void(0)"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">List of Bids</span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg1=='jobbid') { ?> class="active" <?php } ?>>
                            <a href="<?= base_url('jobbid')?>"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">List of Bids</span>
                            </a>
                        </li>
                        <?php } ?>


                        <?php if(@$_SESSION['afrebay']['userType']=='2') {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription where employer_id = ".$_SESSION['afrebay']['userId']." and payment_status = 'paid'")->result_array();
                        if(!empty($get_sub_data)) {
                        $profile_check = $this->db->query("SELECT `profilePic`, `companyname`, `email`, `mobile`,`address`, `foundedyear`, `teamsize`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                        if(in_array('', $profile_check[0])) { ?>
                        <li <?php if($seg1=='chat') { ?>class="active" <?php } ?>>
                            <a href="javascript:void(0)"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li <?php if($seg1=='chat') { ?>class="active" <?php } ?>>
                            <a href="<?= base_url('chat')?>"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg1=='chat') { ?>class="active" <?php } ?>>
                            <a href="javascript:void(0)"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg1=='chat') { ?>class="active" <?php } ?>>
                            <a href="<?= base_url('chat')?>"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php if(@$_SESSION['afrebay']['userType']=='2') {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription where employer_id = ".$_SESSION['afrebay']['userId']." and payment_status = 'paid'")->result_array();
                        if(!empty($get_sub_data)) {
                            $profile_check = $this->db->query("SELECT `profilePic`, `companyname`, `email`, `mobile`,`address`, `foundedyear`, `teamsize`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                            if(in_array('', $profile_check[0])) { ?>
                            <li <?php if($seg1=='product'){?>class="active" <?php } ?>>
                                <a href="javascript:void(0)"><i class="fa fa-tags" aria-hidden="true"></i>
                                    <span class="hidden-xs hidden-sm">Products</span>
                                </a>
                            </li>
                        <?php } else { ?>
                        <li <?php if($seg1=='product') { ?>class="active" <?php } ?>>
                            <a href="<?= base_url('product')?>"><i class="fa fa-tags" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Products</span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg1=='product') { ?>class="active" <?php } ?>>
                            <a href="javascript:void(0)"><i class="fa fa-tags" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Products</span>
                            </a>
                        </li>
                        <?php } }?>
                    </ul>
                </div>
            </div>
