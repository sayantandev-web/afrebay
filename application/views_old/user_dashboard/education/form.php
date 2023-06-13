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

                <h2 class="breadcrumb-title">Add Education</h2>

                <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="#">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Add Education</li>

                    </ol>

                </nav> -->

            </div>

        </div>

    </div>

</section>



<?php $this->load->view('sidebar');?>

<div class="col-md-12 col-sm-12 display-table-cell v-align form-design">

    <div class="user-dashboard">

        <form class="form" action="<?= $action; ?>" method="post" id="registrationForm" enctype="multipart/form-data">

            <div class="row row-sm">



                <div class="col-xl-12 col-lg-12 col-md-12">

                    <div class="cardak">

                        <div class="container bootstrap snippet">

                            <div class="new-pro">

                                <a href="#" class="pull-right">



                                </a>

                            </div>

                        </div>

                        <div class="profile-dsd">

                            <div class="tab-content">

                                <div class="tab-pane active" style="padding: 0px;">




                                    <div class="form-group">

                                        <div class="row">

                                            <div class="col-lg-6">

                                                <label for="first_name"><h4>Degree <span style="color: red">*</span></h4></label>

                                                <input type="text" class="form-control" name="education" placeholder="Enter Degree"  value="<?= @$education; ?>" required list="education" autocomplete="off"/>

                                                <datalist id="education">

                                                    <?php if(!empty($get_education)){ foreach($get_education as $row){?>

                                                        <option value="<?= $row->education ?>">

                                                        <?php } }?>

                                                    </datalist>

                                                </div>

                                                <div class="col-lg-6">

                                                    <label for="first_name"><h4>Year of Graduation <span style="color: red">*</span></h4></label>

                                                    <input type="text" class="form-control" name="passing_of_year" placeholder="Enter the Year of Graduation"  value="<?= @$passing_of_year; ?>" required list="passing_of_year" autocomplete="off"/>

                                                    <datalist id="passing_of_year">

                                                        <?php if(!empty($get_passing)){ foreach($get_passing as $row){?>

                                                            <option value="<?= $row->passing_of_year ?>">

                                                            <?php } }?>

                                                        </datalist>

                                                    </div>

                                                    <div class="col-lg-6">

                                                        <label for="first_name"><h4>College/School/University Name <span style="color: red">*</span></h4></label>

                                                        <input type="text" class="form-control" name="college_name" placeholder="Enter College/School/University Name"  value="<?= $college_name; ?>" required list="college_name" autocomplete="off"/>

                                                        <datalist id="education">

                                                            <?php if(!empty($get_college)){ foreach($get_college as $row){?>

                                                                <option value="<?= $row->college_name ?>">

                                                                <?php } }?>

                                                            </datalist>

                                                        </div>

                                                        <div class="col-lg-6">

                                                            <label for="first_name"><h4>Department <span style="color: red">*</span></h4></label>

                                                            <input type="text" class="form-control" name="department" placeholder="Enter Department"  value="<?= @$department; ?>" required list="department" autocomplete="off"/>

                                                            <datalist id="department">

                                                                <?php if(!empty($get_department)){ foreach($get_department as $row){?>

                                                                    <option value="<?= $row->department ?>">

                                                                    <?php } }?>

                                                                </datalist>

                                                            </div>



                                                            <div class="col-lg-12"><br>

                                                                <label for="first_name"><h4>Description </h4></label>

                                                                <textarea type="text" class="form-control" name="description" id="description" value="<?= $description; ?>" ><?= @$description; ?></textarea>

                                                            </div>

                                                            <input type="hidden" name="id" value="<?= @$id; ?>">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <div class="col-xs-12 aksek">

                                                            <button class="post-job-btn pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button>

                                                        </div>

                                                    </div>



                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>



    </section>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
    CKEDITOR.replace('description');
    </script>
