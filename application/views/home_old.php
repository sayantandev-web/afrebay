<section class="topak">
    <div class="block no-padding">
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-featured-sec">
                        <ul class="main-slider-sec text-arrows">
                            <li class="slideHome">
                                <?php if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){?>
                                <img src="<?=base_url('uploads/banner/'.$get_banner->image); ?>" alt="" />
                                <?php } else{?>
                                <img src="<?=base_url(); ?>assets/images/resource/mslider1.jpg" alt="" />
                                <?php } ?>
                            </li>
                        </ul>
                        <div class="job-search-sec">
                            <div class="job-search">
                                <h3>The Easiest Way to Get Your New Job</h3>
                                <span>Find Jobs, Employment & Career Opportunities</span>
                                <form method="post" action="<?= base_url('search-job')?>">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-5 col-sm-12 col-xs-12">
                                            <div class="job-field">
                                                <input type="text" name="search_title"
                                                    placeholder="Job title, keywords or company name" value="" required />
                                                    <i class="la la-keyboard-o"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                                            <div class="job-field">
                                                <input type="text" name="search_location" id="location" required autocomplete="off" />
                                                <input type="hidden" name="search_lat" id="search_lat">
                                                <input type="hidden" name="search_lon" id="search_lon">
                                                <i class="la la-close" onclick="return reset_location()"></i>
                                                <i class="la la-map-marker"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                            <button type="submit"><i class="la la-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="or-browser">
                                    <span>Browse job offers by</span>
                                    <a href="javascript:void(0)" title="">Category</a>
                                </div>
                            </div>
                        </div>
                        <div class="scroll-to">
                            <a href="#scroll-here" title=""><i class="la la-arrow-down"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>AfreBay Opportunities</h2>
                        <span>Found by employers communicate directly with hiring managers and recruiters.</span>
                    </div>
                    <div class="blog-sec">
                        <div class="row">
                            <?php if(!empty($get_post)) {
                            foreach($get_post as $row){
                            if(strlen($row->description)>200) {
                                $desc=substr($row->description,0,200).'...';
                            } else {
                                $desc=$row->description;
                            }
                            ?>
                            <div class="col-lg-4">
                                <div class="my-blog" onclick="location.href='<?= base_url('postdetail/'.base64_encode($row->id))?>';">
                                    <div class="blog-details">
                                        <h3 class="resk">
                                            <a title=""><?= ucfirst($row->post_title)?></a>
                                        </h3>
                                        <h3 class="nkash"><a href="javascript:void(0)" title="">Description</a></h3>
                                        <p><?= ucfirst($desc)?></p>

                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="browse-all-cat">
                        <a href="<?= base_url('ourjobs')?>" title="">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block Worker-Block">
        <div data-velocity="-.1" style="background: url('<?=base_url(); ?>assets/images/resource/parallax3.jpg') 50% -62.7px repeat scroll transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Available AfreBay Freelancer</h2>
                        <span>Found by employers communicate directly with hiring managers and recruiters.</span>
                    </div>
                    <div class="blog-sec">
                        <div class="row">
                            <?php
                            if(!empty($get_users)){
                                foreach($get_users as $user){
                                if(strlen($user->short_bio)>200) {
                                    $shortbio=substr($user->short_bio,0,200).'...';
                                } else {
                                    $shortbio=$user->short_bio;
                                }
                                ?>
                            <div class="col-lg-4">
                                <div class="my-blog">
                                    <div class="blog-thumbak">
                                        <a href="<?= base_url('worker-detail/'.base64_encode(@$user->userId))?>" title="">
                                            <?php if(!empty($user->profilePic)&& file_exists('uploads/users/'.$user->profilePic)){?>
                                            <img src="<?=base_url('uploads/users/'.$user->profilePic); ?>" alt="" style="height: 300px;" />
                                            <?php } else{?>
                                            <img src="<?=base_url('uploads/no_image.png'); ?>" alt="" style="height: 300px;" />
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="blog-details">
                                        <div class="blog-head">
                                            <h3 class="resk">
                                                <a href="<?= base_url('worker-detail/'.base64_encode(@$user->userId))?>" title=""><?= $user->category_name?></a>
                                            </h3>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <ul class="gigasjh">
                                                        <li>Date Start</li>
                                                        <li><?php echo date('m/d/Y', strtotime(@$user->created));?></li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <ul class="gigasjh">
                                                        <li>Zipcode</li>
                                                        <li><?php echo @$user->zip;?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p><?= ucfirst($shortbio)?></p>
                                            <!-- <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate.</p> -->
                                        </div>
                                        <div class="staak">
                                            <span><?= !empty($user->rate)?round($user->rate):'0';?> Star AfreBay</span>
                                            <?php if(!empty($user->rate)){
                                                for ($i = 0; $i < $user->rate; $i++) {
                                            ?>
                                            <span class="fa fa-star checked"></span>
                                            <?php }} else { ?>
                                            <span class="fa fa-star-o checked"></span>
                                            <span class="fa fa-star-o checked"></span>
                                            <span class="fa fa-star-o checked"></span>
                                            <span class="fa fa-star-o checked"></span>
                                            <span class="fa fa-star-o checked"></span>
                                            <?php } ?>
                                        </div>
                                        <h3 class="nkash">
                                            <a type="button" class="btn" href="<?= base_url('worker-detail/'.base64_encode(@$user->userId))?>" title="">
                                                <?php if(!empty($user->firstname)){ echo $user->firstname.' '.$user->lastname; } else{ echo ucfirst($user->username);}?>
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="browse-all-cat">
                        <a href="<?= base_url('workers-list')?>" title="">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="scroll-here">
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Our Services</h2>
                        <span>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy <br /> text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </span>
                    </div>
                    <!-- Heading -->
                    <div class="cat-sec">
                        <div class="row no-gape">
                            <?php if(!empty($get_ourservice)){
                                foreach($get_ourservice as $item){
                                    $get_category=$this->Crud_model->get_single('category',"id='".$item->category_id."'");
                                    if(strlen($item->description)>100) {
                                        $description=substr($item->description,0,100).'...';
                                    } else {
                                        $description=$item->description;
                                    }
                                ?>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="p-category">
                                    <a href="javascript:void(0)" title="">
                                        <i class="<?= $item->icon?>"></i>
                                        <span><?= ucfirst($get_category->category_name)?></span>
                                        <p><?= ucfirst($description);?></p>
                                    </a>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block double-gap-top double-gap-bottom">
        <div data-velocity="-.1" style="background: url(<?=base_url(); ?>assets/images/resource/parallax1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="simple-text-block">
                        <h3>Make a Difference with Your Online Resume!</h3>
                        <span>Your resume in minutes with JobHunt resume assistant is ready!</span>
                        <?php if(empty($_SESSION['afrebay']['userId'])){?>
                        <a href="<?= base_url('register')?>" title="">Create an Account</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block">
        <div data-velocity="-.1" style="background: url('<?=base_url(); ?>assets/images/resource/parallax3.jpg') 50% -62.7px repeat scroll transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container Job">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Hire the best freelancers for any job</h2>
                        <span>Found by employers communicate directly with hiring managers and recruiters.</span>
                    </div>
                    <!-- Heading -->
                    <div class="blog-sec">
                        <div class="row">
                            <?php if(!empty($get_freelancerspost)){
                            foreach($get_freelancerspost as $post){
                            if(strlen($post->description)>200) {
                                $description=substr($post->description,0,200).'...';
                            } else {
                                $description=$post->description;
                            }
                            ?>
                            <div class="col-lg-3">
                                <div class="my-blog">
                                    <div class="blog-details">
                                        <h3><?= ucfirst($post->post_title)?> </h3>
                                        <p><?= $description?></p>
                                        <a href="<?= base_url('postdetail/'.base64_encode($post->id))?>" title=""><span>View Details</span></a>
                                    </div>
                                </div>
                            </div>
                            <?php } }?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="browse-all-cat">
                        <a href="<?= base_url('ourjobs')?>" title="">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Companies We've Helped</h2>
                        <span>Some of the companies we've helped recruit excellent applicants over the years.</span>
                    </div>
                    <!-- Heading -->
                    <div class="comp-sec">
                        <?php if(!empty($get_company)) {
                        foreach($get_company as $item) { ?>
                        <div class="company-img">
                            <a href="javascript:void(0)" title="">
                                <?php if(!empty($item->logo)&& file_exists('uploads/company_logo/'.$item->logo)){?>
                                <img src="<?=base_url('uploads/company_logo/'.$item->logo); ?>" alt="" />
                                <?php } else { ?>
                                <img src="<?=base_url(); ?>assets/images/resource/b1.jpg" alt="" />
                                <?php } ?>
                            </a>
                        </div>
                        <?php } }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block Career">
        <div data-velocity="-.1" style="background: url(<?=base_url(); ?>assets/images/resource/parallax3.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Quick Career Tips</h2>
                        <span>Found by employers communicate directly with hiring managers and recruiters.</span>
                    </div>
                    <!-- Heading -->
                    <div class="blog-sec">
                        <div class="row">
                            <?php if(!empty($get_career)){ foreach($get_career as $career){
                            if(strlen($career->description)>100) {
                                $desc=substr($career->description,0,100).'...';
                            } else {
                                $desc=$career->description;
                            }
                            ?>
                            <div class="col-lg-4">
                                <div class="my-blog">
                                    <div class="blog-thumb">
                                        <a href="<?= base_url('career-tip/'.base64_encode($career->id))?>" title="">
                                            <?php if(!empty($career->image)&& file_exists('uploads/career/'.$career->image)){?>
                                            <img src="<?=base_url('uploads/career/'.$career->image); ?>" alt="" />
                                            <?php } else{?>
                                            <img src="<?=base_url(); ?>assets/images/resource/b1.jpg" alt="" />
                                            <?php } ?>
                                        </a>
                                        <div class="blog-metas">
                                            <a href="javascript:void(0)" title=""><?= date('M d,Y',strtotime($career->update_date))?></a>
                                            <a href="javascript:void(0)" title="">0 Comments</a>
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h3><a href="<?= base_url('career-tip/'.base64_encode($career->id))?>" title=""><?= ucfirst($career->title)?></a></h3>
                                        <p><?= ucfirst($desc)?></p>
                                        <a href="<?= base_url('career-tip/'.base64_encode($career->id))?>" title=""><span>Read More</span></a>
                                    </div>
                                </div>
                            </div>
                            <?php } }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(window).load(function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLocation);
        } else {
            $('#location').html('Geolocation is not supported by this browser.');
        }
    });

    function showLocation(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        displayLocation(latitude, longitude);
    }

    function displayLocation(latitude, longitude) {
        var geocoder;
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(latitude, longitude);
        geocoder.geocode({'latLng': latlng},
            function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var add = results[0].formatted_address;
                        var value = add.split(",");
                        count = value.length;
                        country = value[count - 1];
                        state = value[count - 2];
                        city = value[count - 3];
                        $("#location").val(city);
                    }
                }
            }
        );
    }
</script>
