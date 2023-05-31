<section class="overlape">

               <div class="block no-padding">

                   <div data-velocity="-.1" style="background: url(images/resource/mslider1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>

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

                           <h2 class="breadcrumb-title">Educations</h2>

                           <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">

                               <ol class="breadcrumb">

                                   <li class="breadcrumb-item"><a href="#">Home</a></li>

                                   <li class="breadcrumb-item active" aria-current="page">My Education</li>

                               </ol>

                           </nav> -->

                       </div>

                   </div>

               </div>

           </section>



            <?php $this->load->view('sidebar');?>

                       <div class="col-md-12 col-sm-12 display-table-cell v-align">

                           <div class="user-dashboard">

                               <div class="row row-sm">

                                  <div class="col-xl-12 col-lg-12 col-md-12" style="margin-bottom: 10px; text-align: right;">

                                   <a href="<?php echo base_url('add-education')?>" class="btn btn-primary Education_Btn">Add Education</a>

                                  </div>

                                   <div class="col-xl-12 col-lg-12 col-md-12">



                                       <div class="cardak">

                                           <span class="text-success-msg f-20" style="text-align: center;">
                                           <?php if($this->session->flashdata('message')) {
                                               echo $this->session->flashdata('message');
                                               unset($_SESSION['message']);
                                           } ?>
                                           </span>

                                           <table class="table table-bordered">

                                             <thead>

                                               <tr>

                                                 <th scope="col">#</th>

                                                 <th scope="col">Degree</th>

                                                 <th scope="col">Year of Graduation</th>
                                                 <th scope="col">College/School/University Name</th>
                                                 <th scope="col">Department</th>

                                                 <th scope="col">Action</th>

                                               </tr>

                                             </thead>

                                             <tbody>

                                               <?php  if(!empty($education_list)) {

                                                 $i=1;

                                                 foreach ($education_list as $row) {



                                                  ?>

                                               <tr>

                                                 <th scope="row"><?= $i; ?></th>

                                                 <td><?= ucfirst($row->education); ?></td>

                                                 <td><?= $row->passing_of_year; ?></td>
                                                 <td><?= $row->college_name; ?></td>
                                                 <td><?= $row->department; ?></td>

                                                 <td>

                                                   <!-- <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a> -->

                                                   <a href="<?= base_url('update-education/'.base64_encode($row->id));?>"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                   <a href="<?= base_url('user/Dashboard/delete_education/'.$row->id);?>" onclick="if(confirm('Are you sure you want to Delete?')) commentDelete(1); return false"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                                 </td>

                                               </tr>

                                             <?php $i++;}  }else{?>

                                               <tr>

                                                 <td colspan="6"><center>No Data Found</center></td>

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
