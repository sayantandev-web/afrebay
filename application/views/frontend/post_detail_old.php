<?php
 if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
     $banner_img=base_url("uploads/banner/".$get_banner->image);
            } else{
       $banner_img=base_url("assets/images/resource/mslider1.jpg");
        } ?>

<style media="screen">
  .postdetail{
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

                                <div class="inner-header">

                                    <h3 style="text-transform: uppercase;"><?php if(!empty($post_data->post_title)){ echo $post_data->post_title;} ?></h3>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <section class="dashboard-gig">
               <div class="container display-table">
                   <div class="row display-table-row">

                       <div class="col-md-12 col-sm-12 display-table-cell v-align">
                       <div class="user-dashboard">
                           <div class="row row-sm">
                               <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-12">
                                   <div class="bid-dis">
                                       <ul>

                                           <li><?php if(!empty($post_data->description)){ echo $post_data->description;} ?></li>

                                           <li>Skills : <a href="<?= base_url('employerdetail/'.base64_encode($post_data->user_id))?>" style="text-transform: uppercase;"><?php if(!empty($post_data->post_title)){ echo $post_data->post_title;} ?></a></li>
                                       </ul>

                                          <a href="<?= base_url('employerdetail/'.base64_encode($post_data->user_id))?>"><strong><?php if(!empty($post_data->fullname)){ echo ucfirst($post_data->fullname);} else{ echo ucfirst($post_data->username);} ?></strong></a>

                                   </div>
                                   <div class="employe-about">
                                   <div class="row">
                                       <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12">
                                       <span class="rat-b">0.0</span>
                                      <span class="fa fa-star checked1"></span>
                                       <span class="fa fa-star checked1"></span>
                                       <span class="fa fa-star checked1"></span>
                                       <span class="fa fa-star checked1"></span>
                                       <span class="fa fa-star checked1"></span>
                                       <span>(0 reviews)</span>
                               </div>
                                 <!-- <img src="<?= base_url('assets/images/aust.png')?>">  -->
                               <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12">
                                   <div class="hope-aus">
                                    <span> <?php if(!empty($post_data->user_address)){ echo $post_data->user_address;} ?></span>
                                   </div>
                               </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12">
                                   <div class="hope-aus1">
                                      <ul>
                                          <!-- <li><a href="javascript:void(0)"><i class="fa fa-shield"></i></a></li> -->
                                          <li><a href="javascript:void(0)"><i class="fa fa-envelope"></i></a></li>
                                          <!-- <li><a href="javascript:void(0)"><i class="fa fa-user"></i></a></li> -->
                                          <li><a href="javascript:void(0)"><i class="fa fa-phone"></i></a></li>

                                      </ul>
                                   </div>
                               </div>

                           </div>
                                   </div>

                               </div>
                               <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12">
                                   <form class="bd-form" action="<?= base_url('user/dashboard/save_postbid')?>" method="post">
                                       <h2 class="job-bid">Job Bidding</h2>
                                       <div class="row">
                                           <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                               <input type="text" class="form-control f1" placeholder="Your bid Amount" name="bid_amount" required>
                                             </div>
                                         </div>
                                         <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                             <div class="form-group">
                                               <input type="email" class="form-control f1" placeholder="Contact Email" name="email" required>
                                             </div>
                                         </div>
                                         <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                             <div class="form-group">
                                               <input type="text" class="form-control f1" placeholder="Duration" name="duration" required>
                                             </div>
                                         </div>
                                         <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                              <div class="form-group">
                                               <input type="text" class="form-control f1" placeholder="Phone" name="phone" onkeypress="only_number(event)" required>
                                             </div>
                                           </div>
                                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                              <div class="form-group">
                                               <textarea class="form-control" name="description" placeholder="Description"></textarea>
                                             </div>
                                           </div>
                                            <input type="hidden" name="postjob_id" value="<?php if(!empty($post_data->id)){ echo $post_data->id;} ?>">
                                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             <div class="bid-btn">
                                               <?php if(!empty($_SESSION['afrebay']['userId'])){

                                                 if(@$_SESSION['afrebay']['userType']=='1'){

                                                   ?>
                                              <input type="submit" name="">
                                              <?php } else{?>
                                               <h2 class="job-bid" style="font-size:16px;">You are not accepted bidding</h2>
                                              <?php } } else{?>
                                                <br/>
                                                   <a href="<?= base_url('login')?>" class="postdetail">Submit Query</a>

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
