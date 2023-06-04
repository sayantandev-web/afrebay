<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= base_url('assets/images/resource/mslider1.jpg')?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
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
                <h2 class="breadcrumb-title">Subscription</h2>
                <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Subscription</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('sidebar');?>
<div class="col-md-12 col-sm-12 display-table-cell v-align User_Sub">
    <div id="subscription-messages" class="text-success-msg f-20">
        <p style="color: #28a745;">Subscription Successful.</p>
    </div>
    <div id="err-messages">
        <h4 style="color: red;">Error</h4>
        <p style="color: red;">Oops, somthing went wrong. Please try again later.</p>
    </div>
    <div class="user-dashboard">
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cardak custom-cardak">
                    <span class="text-success-msg f-20" style="text-align: center;">
                    <?php if($this->session->flashdata('message')) {
                        echo $this->session->flashdata('message');
                        unset($_SESSION['message']);
                    } ?>
                    </span>
                    <div class="col-xl-12 col-lg-12 col-md-12" style="display: inline-block; text-align: center; padding-bottom: 15px;">
                        <h3>Current Plan</h3>
                    </div>
                    <div class="row row-sm">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="cardak custom-cardak">
                                <table class="table table-modific">
                                    <!-- <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Transaction ID</th>
                                            <th scope="col">Plan Name</th>
                                            <th scope="col">Price ($)</th>
                                            <th scope="col">Payment Date</th>
                                            <th scope="col">Duration</th>
                                            <th scope="col">Expiry Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        <?php
                                        if(!empty($subcriber_pack)) {
                                            $i = 1;
                                            foreach ($subcriber_pack as $row) { ?>
                                                    <tr>
                                                     <td class="table-modific-td">
                                                         <table class="custom-table">
                                                              <tr>
                                                                  <td class="heading">Transaction ID: <?php echo $row->transaction_id;?></td>
                                                                  <td class="btn-option">
                                                                        <?php
                                                                        $now_date = date('Y/m/d');
                                                                        $expire_date = date('Y/m/d', strtotime($row->expiry_date));
                                                                        if($expire_date < $now_date) {
                                                                            echo "Expired";
                                                                        } else {
                                                                            echo "Active";
                                                                        } ?>
                                                                  </td>
                                                              </tr>
                                                              <tr>
                                                                  <td colspan="2" class="heading">Subscription Plan Name: <?php echo $row->name_of_card;?></td>
                                                              </tr>
                                                              <tr>
                                                                  <td colspan="2" class="bid-amount">
                                                                    <?php  if($row->name_of_card=='FREE'){?>
                                                                  <!-- <label>Price : </label> -->

                                                                  <?php  } else{
                                                                    ?>
                                                                <label>Price ($):</label> <?php echo "$". number_format((float)$row->amount, 2, '.', '');?>



                                                                 <?php } ?>
                                                                  </td>
                                                              </tr>
                                                              <tr>
                                                                  <td colspan="2" class="year">
                                                                  <label>Payment Date:</label> <?php echo date ('Y-m-d',strtotime($row->payment_date));?>
                                                                  </td>
                                                              </tr>
                                                              <tr>
                                                                  <td colspan="2" class="year">
                                                                  <label>Duration:</label> <?php echo $row->duration." Days";?>
                                                                  </td>
                                                              </tr>
                                                              <tr>
                                                                  <td colspan="2" class="year">
                                                                  <label>Expiry Date:</label> <?php echo date ('Y-m-d',strtotime($row->expiry_date));?>
                                                                  </td>
                                                              </tr>
                                                         </table>
                                                     </td>
                                                  </tr>
                                                  <tr>
                                                      <td colspan="2" class="height"></td>
                                                   </tr>
                                        <?php $i++; }  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(empty($subcriber_pack)) { ?>
                <div class="cardak" style="background: #f2f2f2 !important; margin-top: 40px;">
                    <div style="display: inline-block; text-align: center;">
                        <h3>Pricing</h3>
                    </div>
                    <div class="container-fluid">
                        <div class="row text-center align-items-end">
                            <!-- Pricing Table-->
                            <?php if(!empty($get_subscription)) {
                                $i=1;
                                foreach ($get_subscription as $value) { ?>
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="Sub_Block">
                                    <div class="Sub_Head">
                                        <div class="Heading">
                                            <h1><?= $value->subscription_name; ?></h1>
                                            <h2>Price: <?= ' '.$value->subscription_amount; ?><span></span></h2>
                                            <p style="text-align: justify;">Duration: <b><?= ' '.$value->subscription_duration." Days"; ?></b><span></span></p>
                                        </div>
                                        <div class="Icon">
                                            <span>
                                                <!-- <img src="https://cdn-icons-png.flaticon.com/512/5673/5673647.png"> -->
                                                <img src="<?php echo base_url()?>uploads/logo/3397_favicon.png" />
                                            </span>
                                        </div>
                                    </div>
                                    <div></div>
                                    <div><?= $value->subscription_description; ?></div>
                                    <!-- <a href="javascript:void(0);" class="btn btn-primary" id="getSubscription_<?php echo $value->id?>">Subscribe</a> -->
                                    <?php if($value->subscription_type == 'paid') { ?>
                                    <a class="btn btn-info" href="<?= base_url('stripe/'.base64_encode($value->price_key))?>">Subscribe</a>
                                    <?php } else { ?>
                                    <a href="javascript:void(0);" class="btn btn-primary getSubscription_<?php echo $value->id?>" id="getSubscription_<?php echo $value->id?>">Subscribe</a>
                                    <input type="hidden" name="user_id_<?php echo $value->id?>" id="user_id_<?php echo $value->id?>" value="<?php echo $_SESSION['afrebay']['userId']?>">
                                    <input type="hidden" name="sub_id_<?php echo $value->id?>" id="sub_id_<?php echo $value->id?>" value="<?php echo $value->id?>">
                                    <input type="hidden" name="sub_name_<?php echo $value->id?>" id="sub_name_<?php echo $value->id?>" value="<?php echo $value->subscription_name?>">
                                    <input type="hidden" name="user_email_<?php echo $value->id?>" id="user_email_<?php echo $value->id?>" value="<?php echo $_SESSION['afrebay']['userEmail']?>">
                                    <input type="hidden" name="sub_price_<?php echo $value->id?>" id="sub_price_<?php echo $value->id?>" value="<?php echo $value->subscription_amount?>">
                                    <input type="hidden" name="sub_duration_<?php echo $value->id?>" id="sub_duration_<?php echo $value->id?>" value="<?php echo $value->subscription_duration?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <?php $i++; }} else { ?>
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="bg-white p-5 rounded-lg shadow" style="height: 500px;">
                                    <h1 class="h6 text-uppercase font-weight-bold mb-4">No Data Found</h1>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<style>
#loader {display: none; width: 40px;}
</style>
<div id="add_project" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Project</h4>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="Project Title" name="name" />
                <input type="text" placeholder="Post of Post" name="mail" />
                <input type="text" placeholder="Author" name="passsword" />
                <textarea placeholder="Desicrption"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel" data-dismiss="modal">Close</button>
                <button type="button" class="add-project" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
</section>
<style>
#subscription-messages{display: none; text-align: center;}
#err-messages{display: none; text-align: center;}
</style>
<script>
$(document).ready(function(){
    <?php
    if(!empty($get_subscription)) {
        $i=1;
        foreach ($get_subscription as $value) { ?>
        $('#getSubscription_<?php echo $value->id?>').click(function() {
            var user_id = $('#user_id_<?php echo $value->id?>').val();
            var sub_id = $('#sub_id_<?php echo $value->id?>').val();
            var sub_name = $('#sub_name_<?php echo $value->id?>').val();
            var user_email = $('#user_email_<?php echo $value->id?>').val();
            var sub_price = $('#sub_price_<?php echo $value->id?>').val();
            var sub_duration = $('#sub_duration_<?php echo $value->id?>').val();
            var base_url = $('#base_url').val();
            $.ajax({
                url:base_url+"user/dashboard/userSubscription",
                method:"POST",
                data:{user_id: user_id,sub_id: sub_id,sub_name: sub_name,user_email: user_email,sub_price: sub_price,sub_duration: sub_duration},
                beforeSend : function(){
        			$("#loader").show();
        			$(".getSubscription_<?php echo $value->id?>").text('Please wait..');
        		},
                success:function(data) {
                    if (data == '1'){
                        setTimeout(function () {
                            $("#loader").hide();
                            window.scroll({top: 0, behavior: "smooth"});
                            $('#subscription-messages').show();
                        }, 10000);
                        setTimeout(function () {
                            $('#subscription-messages').hide();
                        }, 13000);
                        setTimeout(function () {
                            location.reload(true);
                        }, 16000);
                    } else {
                        $('#err-messages').show();
                        setTimeout(function () {
                            window.scroll({top: 0, behavior: "smooth"})
                        }, 5000);
                        setTimeout(function () {
                            $('#err-messages').hide();
                        }, 8000);
                        setTimeout(function () {
                            location.reload(true);
                        }, 9000);
                    }
                }

            })
        })
    <?php $i++; } } ?>
})
</script>
