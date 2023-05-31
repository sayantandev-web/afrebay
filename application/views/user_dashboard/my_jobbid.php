<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= base_url('assets/images/resource/mslider1.jpg')?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header" style="padding-top: 90px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="dashboardhak">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">List of Bids</h2>
                <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Job</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('sidebar');?>
<div class="col-md-12 col-md-12 col-sm-12 display-table-cell v-align">
    <div class="user-dashboard" style="text-align: center;">
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cardak custom-cardak">
                    <table class="table table-modific">
                        <!-- <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Post Title</th>
                                <th scope="col">Freelancer</th>
                                <th scope="col">Bid Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead> -->
                        <tbody>
                            <?php
                            if(!empty($get_postjob)){
                                $i=1;
                                foreach ($get_postjob as $key) { ?>
                                <tr>
                                    <td class="table-modific-td">
                                        <table class="custom-table">
                                            <tr>
                                                <td class="heading"><?=$key->post_title; ?></td>
                                                <td class="btn-option">
                                                    <?php if($_SESSION['afrebay']['userType'] == '2') { ?>
                                                    <?php if(@$key->bidding_status=='Pending'){?>
                                                    <a href="#" onclick="change_biddingstatus('<?= $key->id?>');"><span class="badge badge-warning" >
                                                        <?= @$key->bidding_status; ?></span></a>
                                                    <?php } else if(@$key->bidding_status=='Accept'){ ?>
                                                        <span class="badge badge-success"><?= @$key->bidding_status; ?></span>
                                                    <?php } else if(@$key->bidding_status=='Reject'){?>
                                                        <span class="badge badge-danger"><?= @$key->bidding_status; ?></span>
                                                    <?php } ?>
                                                    <?php } else { 
                                                        echo @$key->bidding_status;
                                                    } ?>
                                                    <a href="javascript:void(0)" id="view_<?php echo $key->id?>" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    <div class="modal fade" id="exampleModal_<?php echo $key->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog list-job-modal">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Job Bid Details</h5>
                                                                    <button type="button" class="btn-close modalClose_<?php echo $key->id?>" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-job-modal-col">
                                                                            <p>Bid Amount : <span>$ <?php echo $key->bid_amount?></span></p>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-job-modal-col">
                                                                            <p>Email : <span><?php echo $key->email?></span></p>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-job-modal-col">
                                                                            <p>Duration : <span><?php echo $key->duration?></span></p>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-job-modal-col">
                                                                            <p>Phone Number : <span><?php echo $key->mobile?></span></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="bid_contact-profile">
                                                    <img src="<?php echo base_url()?>uploads/users/<?php echo $key->profilePic?>" alt="" style="width: 60px; height: 60px; object-fit: cover;">
                                                    <a href="<?php echo base_url()?>worker-detail/<?php echo base64_encode($key->userid)?>" target="_blank"><p><?=$key->fullname; ?></p></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="bid-amount">
                                                    <label>Bid Amount:</label> <?="USD"." ".$key->bid_amount; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="year">
                                                    <label>Date:</label> <?= date('d-M-Y',strtotime($key->created_date)); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="desc">
                                                    <?php echo $key->description?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="height"></td>
                                </tr>
                                <?php $i++; }}else{?>
                                <tr>
                                    <td colspan="6">
                                        <center>No Data Found</center>
                                        <button class="post-job-btn pull-right" type="submit" style=" background: linear-gradient(180deg, rgba(252, 119, 33, 1) 0%, rgba(249, 80, 30, 1) 100%) !important; border: 0 !important; "><a href="<?= base_url('ourjobs')?>" title="" target="_blank">Apply for Jobs</a></button>
                                    </td>
                                    </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
function change_biddingstatus(jobbid_id) {
    var cnf = confirm('Are you sure to change the status?');
    if(cnf==true) {
        $.ajax({
            type:"POST",
            url:'<?= base_url('user/dashboard/changebiddingstatus')?>',
            data:{jobbid_id:jobbid_id},
            success:function(returndata) {
                if(returndata==1){
                    location.reload();
                }
            }
        });
    }
}
$(document).ready(function(){
    <?php if(!empty($get_postjob)) {
    $i=1;
    foreach ($get_postjob as $value) { ?>
    $('#view_<?php echo $value->id?>').click(function() {
        $('#exampleModal_<?php echo $value->id?>').css("opacity", "1");
        $('#exampleModal_<?php echo $value->id?>').css("display", "block");
        $('#exampleModal_<?php echo $value->id?>').css("top", "0");
        $('#exampleModal_<?php echo $value->id?>').css("background", "#0e0d0d9e");
        $('.modal-content').css("top", "220px");
    })
    $('.modalClose_<?php echo $value->id?>').click(function() {
        $('#exampleModal_<?php echo $value->id?>').css("opacity", "0");
        $('#exampleModal_<?php echo $value->id?>').css("display", "none");
    })
    <?php $i++; } } ?>
})
</script>
