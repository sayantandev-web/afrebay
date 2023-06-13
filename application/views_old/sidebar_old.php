<?php
if(empty($_SESSION['afrebay']['userId']))
{
redirect(base_url('login'));
}
$seg1=$this->uri->segment(1);
?>
<section class="dashboard-gig User_Sidemenu">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-12 col-md-12 col-sm-12 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="navi">
                    <ul>
                        <!-- <li <?php if($seg1=='dashboard'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('dashboard')?>"><i class="fa fa-home" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">Dashboard</span></a>
                        </li> -->
                        <?php if(@$_SESSION['afrebay']['userType']=='2'){?>
                        <!-- <li <?php if($seg1=='myservice'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('myservice')?>"><i class="fa fa-tasks" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">My Services</span></a>
                        </li> -->

                        <li <?php if($seg1=='myjob'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('myjob')?>"><i class="fa fa-joomla" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">My Jobs </span></a>
                        </li>
                        <li <?php if($seg1=='jobbid'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('jobbid')?>"><i class="fa fa-joomla" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">Jobs Bidding </span></a>
                        </li>
                        <?php }?>
                        <li <?php if($seg1=='chat'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('chat')?>"><i class="fa fa-commenting-o" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">Chat</span></a>
                        </li>
                        <?php if(@$_SESSION['afrebay']['userType']=='2'){?>
                        <li <?php if($seg1=='subscription'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('subscription')?>"><i class="fa fa-bar-chart"
                                    aria-hidden="true"></i><span class="hidden-xs hidden-sm">Subscription </span></a>
                        </li>

                        <?php }?>
                        <li <?php if($seg1=='profile'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('profile')?>"><i class="fa fa-image" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">Profile</span></a>
                        </li>
                        <!-- <li <?php if($seg1=='calender'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('calender')?>"><i class="fa fa-calendar" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">Appointment</span></a>
                        </li>
                        <li <?php if($seg1=='video'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('video')?>"><i class="fa fa-phone" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">Video Call</span></a>
                        </li>
                        <li <?php if($seg1=='password-reset'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('password-reset')?>"><i class="fa fa-lock"
                                    aria-hidden="true"></i><span class="hidden-xs hidden-sm">Change Password</span></a>
                        </li> -->
                        <?php if(@$_SESSION['afrebay']['userType']=='1'){?>
                        <li <?php if($seg1=='education-list'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('education-list')?>"><i class="la la-graduation-cap"
                                    aria-hidden="true"></i><span class="hidden-xs hidden-sm">Education</span></a>
                        </li>
                        <li <?php if($seg1=='workexperience-list'){?>class="active" <?php } ?>>
                            <a href="<?= base_url('workexperience-list')?>"><i class="fa fa-file"
                                    aria-hidden="true"></i><span class="hidden-xs hidden-sm">Work Experience</span></a>
                        </li>
                        <?php } ?>
                        <!-- <li class="signin-popup">
                            <a href="<?= base_url('logout')?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">Logout</span></a>
                        </li> -->
                    </ul>
                </div>
            </div>
