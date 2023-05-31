<?php
if (!empty($get_banner->image) && file_exists('uploads/banner/' . $get_banner->image)) {
    $banner_img = base_url("uploads/banner/" . $get_banner->image);
} else {
    $banner_img = base_url("assets/images/resource/mslider1.jpg");
} ?>
<style media="screen">
    .postdetail {
        padding: 7px 33px;
        border-radius: 10px;
        background: red;
        color: #fff;
        margin: 10px;
        font-size: 20px;
    }
</style>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header text-center">
                        <h3 style="text-transform: uppercase;">
                            <?php if (!empty($post_data->post_title)) {
                                echo $post_data->post_title;
                            } ?>
                           

                        </h3>
                        <?php
                        if ($type == 'admin') {
                        ?>
                            <a class="btn btn-info position-relative" style="z-index:9;" onclick="location.href = '<?= base_url('admin/jobsbidding') ?>'">Go to the admin dashboard</a>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="dashboard-gig">
    <div class="text-success-msg f-20" style="text-align: center; margin-bottom: 20px;">
        <?php if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
            unset($_SESSION['message']);
        } ?>
    </div>
    <div class="container display-table">
        <div class="row display-table-row">
            <div class="col-md-12 col-sm-12 display-table-cell v-align">
                <div class="user-dashboard">
                    <div class="row row-sm">
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-12">
                            <div class="bid-dis">
                                <?php //echo "<pre>"; print_r($post_data); die();
                                ?>
                                <ul>
                                    <li>
                                        <span>Job Title </span>
                                        <a href="<?= base_url('postdetail/' . base64_encode($post_data->id)) ?>" style="text-transform: uppercase;"><?php if (!empty($post_data->post_title)) {
                                                                                                                                                        echo $post_data->post_title;
                                                                                                                                                    } ?></a>
                                    </li>
                                    <?php if (!empty($post_data->description)) { ?>
                                        <li><span>Description</span><?php echo $post_data->description; ?>
                                        <?php } ?>
                                        </li>
                                        <div class="Bid-Data">
                                            <?php if (!empty($post_data->required_key_skills)) { ?>
                                                <li><span>Required key skills </span><?php echo ucfirst($post_data->required_key_skills); ?></li>
                                            <?php } ?>
                                            <?php if (!empty($post_data->appli_deadeline)) { ?>
                                                <li><span>Application Deadline Date </span><?php echo $post_data->appli_deadeline; ?></li>
                                            <?php } ?>
                                        </div>
                                        <div class="Bid-Data">
                                            <?php if (!empty($post_data->category_id)) { ?>
                                                <li><span>Categories </span>
                                                    <?php
                                                    $cname = $this->db->query("SELECT * FROM category WHERE id = '" . $post_data->category_id . "'")->result_array();
                                                    echo $cname[0]['category_name'];
                                                    ?>
                                                </li>
                                            <?php } ?>
                                            <?php if (!empty($post_data->subcategory_id)) { ?>
                                                <li><span>Sub Categories </span>
                                                    <?php
                                                    $scname = $this->db->query("SELECT * FROM sub_category WHERE id = '" . $post_data->subcategory_id . "'")->result_array();
                                                    echo $scname[0]['sub_category_name'];
                                                    ?>
                                                </li>
                                            <?php } ?>
                                        </div>
                                        <div class="Bid-Data">
                                            <?php if (!empty($post_data->charges)) { ?>
                                                <li><span>Charges </span><?php echo $post_data->charges; ?></li>
                                            <?php } ?>
                                            <?php if (!empty($post_data->duration)) { ?>
                                                <li><span>Duration </span><?php echo $post_data->duration; ?></li>
                                            <?php } ?>
                                        </div>
                                        <?php if (!empty($post_data->country)) { ?>
                                            <li><span>Complete Address </span><?php echo $post_data->city . ', ' . $post_data->state . ', ' . $post_data->country; ?></li>
                                        <?php } ?>
                                </ul>
                                <?php $postedBy = $this->db->query("SELECT * FROM users WHERE userId = '" . $post_data->user_id . "'")->result_array(); ?>
                                <a class="btn btn-info" href="<?= base_url('employerdetail/' . base64_encode($post_data->user_id)) ?>">
                                    <?php
                                    if ($postedBy[0]['userType'] == 1) {
                                        echo $postedBy[0]['firstname'] . ' ' . $postedBy[0]['lastname'];
                                    } else if ($postedBy[0]['userType'] == 2) {
                                        echo $postedBy[0]['companyname'];
                                    } ?>
                                </a>
                            </div>
                            <div class="employe-about d-none">
                                <ul>
                                    <li>
                                        <span class="rat-b">0.0</span>
                                        <span class="fa fa-star checked1"></span>
                                        <span class="fa fa-star checked1"></span>
                                        <span class="fa fa-star checked1"></span>
                                        <span class="fa fa-star checked1"></span>
                                        <span class="fa fa-star checked1"></span>
                                        <span>( 0 reviews )</span>
                                    </li>
                                    <li>
                                        <div class="hope-aus">
                                            <span><?php if (!empty($post_data->user_address)) {
                                                        echo $post_data->user_address;
                                                    } ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="hope-aus1">
                                            <ul>
                                                <!-- <li><a href="javascript:void(0)"><i class="fa fa-shield"></i></a></li> -->
                                                <li><a href="javascript:void(0)"><i class="fa fa-envelope"></i></a></li>
                                                <!-- <li><a href="javascript:void(0)"><i class="fa fa-user"></i></a></li> -->
                                                <li><a href="javascript:void(0)"><i class="fa fa-phone"></i></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12">
                            <form class="bd-form" action="<?= base_url('user/dashboard/save_postbid') ?>" method="post">
                                <h3 class="job-bid">Job Bidding</h3>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="" class="form-label">Bid Amount</label>
                                        <input type="text" class="form-control f1" placeholder="Your bid Amount" name="bid_amount" required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" class="form-control f1" placeholder="Contact Email" name="email" required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="" class="form-label">Duration</label>
                                        <input type="text" class="form-control f1" placeholder="Duration" name="duration" required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control f1" placeholder="Phone" name="phone" onkeypress="only_number(event)" required maxlength="10">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="" class="form-label">Details</label>
                                        <textarea class="form-control" name="description" placeholder="Description"></textarea>
                                    </div>
                                    <input type="hidden" name="postjob_id" value="<?php if (!empty($post_data->id)) {
                                                                                        echo $post_data->id;
                                                                                    } ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="bid-btn">
                                            <?php if (!empty(@$_SESSION['afrebay']['userType'])) {
                                                if (@$_SESSION['afrebay']['userType'] == '1') {
                                            ?>
                                                    <input type="submit" name="">
                                                <?php } else { ?>
                                                    <h2 class="job-bid" style="font-size:16px;">Verdors are not eligible to Bid for jobs</h2>
                                                <?php }
                                            } else { ?>
                                                <br />
                                                <a href="<?= base_url('login') ?>" class="btn btn-info postdetail">Submit Query</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</section>