<?php
 if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
     $banner_img=base_url("uploads/banner/".$get_banner->image);
            } else{
       $banner_img=base_url("assets/images/resource/mslider1.jpg");
        } ?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;"
            class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>About Us</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block About_Us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-us">
                        <div class="row">
                            <div class="col-lg-7">
                                <h2><?= ucfirst($get_cms->title)?></h2>
                                <p>
                                    <?= $get_cms->description?>
                                </p>
                            </div>
                            <div class="col-lg-5">
                                <img src="<?= base_url('assets/images/resource/About_Us.jpg')?>" alt="" />
                            </div>
                            <!-- <div class="col-lg-12">
                                <p>
                                    Far much that one rank beheld bluebird after outside ignobly allegedly more when oh
                                    arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely
                                    crud meretriciously
                                    hastily dalmatian a glowered inset one echidna cassowary some parrot and much as
                                    goodness some froze the sullen much connected bat wonderfully on instantaneously eel
                                    valiantly petted this
                                    along across highhandedly much.
                                </p>
                                <p>
                                    Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers
                                    loosely yikes that as or eel underneath kept and slept compactly far purred sure
                                    abidingly up above fitting
                                    to strident wiped set waywardly far the and pangolin horse approving paid chuckled
                                    cassowary oh above a much opposite far much hypnotically more therefore wasp less
                                    that hey apart well like
                                    while superbly orca and far hence one.Far much that one rank beheld bluebird after
                                    outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy.
                                </p>
                            </div> -->
                        </div>
                        <!-- <div class="tags-share">
                            <div class="share-bar">
                                <a href="javascript:void(0)" title="" class="share-fb"><i class="fa fa-facebook"></i></a><a href="javascript:void(0)" title="" class="share-twitter"><i class="fa fa-twitter"></i></a>
                                <a href="javascript:void(0)" title="" class="share-google"><i class="la la-google"></i></a><span>Share</span>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block About_Us_Testimonial">
        <div data-velocity="-.1"
            style="background: url('<?= base_url('assets/images/resource/parallax2.jpg')?>') repeat scroll 50% 422.28px transparent;"
            class="parallax scrolly-invisible layer color light"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading light">
                        <h2>Reviews submitted by our vendors</h2>
                        <span>What other people thought about the service provided by Afrebay</span>
                    </div>
                    <!-- Heading -->
                    <div class="reviews-sec" id="reviews-carousel">
                        <?php if(!empty($get_employer)){ foreach($get_employer as $user){?>
                        <div class="col-lg-6">
                            <a href="<?= base_url('employerdetail/'.base64_encode($user->userId))?>">
                                <div class="reviews">
                                    <?php if(!empty($user->profilePic) && file_exists('uploads/users/'.$user->profilePic)){ ?>
                                    <img src="<?= base_url('uploads/users/'.$user->profilePic)?>" alt="" />

                                    <?php  }else{ ?>
                                    <img src="<?= base_url('uploads/users/user.png')?>" alt="" />
                                    <?php  } ?>

                                    <h3><?php if(!empty($user->firstname)){ echo ucfirst($user->firstname).' '.$user->lastname;} else{ echo ucfirst($user->username);}?><span><?= ucfirst(@$user->skills);?></span>
                                    </h3>
                                    <p><?= @$user->short_bio;?></p>
                                </div>
                            </a>
                            <!-- Reviews -->
                        </div>
                        <?php } }?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<section>-->
<!--    <div class="block">-->
<!--        <div data-velocity="-.1" style="background: url(images/resource/parallax3.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>-->
<!-- PARALLAX BACKGROUND IMAGE -->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-lg-12">-->
<!--                    <div class="heading">-->
<!--                        <h2>Quick Career Tips</h2>-->
<!--                        <span>Found by employers communicate directly with hiring managers and recruiters.</span>-->
<!--                    </div>-->
<!-- Heading -->
<!--                    <div class="blog-sec">-->
<!--                        <div class="row">-->
<!--                            <div class="col-lg-4">-->
<!--                                <div class="my-blog">-->
<!--                                    <div class="blog-thumb">-->
<!--                                        <a href="javascript:void(0)" title=""><img src="<?= base_url('assets/images/resource/b1.jpg')?>" alt="" /></a>-->
<!--                                        <div class="blog-metas">-->
<!--                                            <a href="javascript:void(0)" title="">March 29, 2017</a>-->
<!--                                            <a href="javascript:void(0)" title="">0 Comments</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="blog-details">-->
<!--                                        <h3><a href="javascript:void(0)" title="">Attract More Attention Sales And Profits</a></h3>-->
<!--                                        <p>A job is a regular activity performed in exchange becoming an employee, volunteering,</p>-->
<!--                                        <a href="javascript:void(0)" title="">Read More <i class="la la-long-arrow-right"></i></a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-lg-4">-->
<!--                                <div class="my-blog">-->
<!--                                    <div class="blog-thumb">-->
<!--                                        <a href="javascript:void(0)" title=""><img src="<?= base_url('assets/images/resource/b2.jpg')?>" alt="" /></a>-->
<!--                                        <div class="blog-metas">-->
<!--                                            <a href="javascript:void(0)" title="">March 29, 2017</a>-->
<!--                                            <a href="javascript:void(0)" title="">0 Comments</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="blog-details">-->
<!--                                        <h3><a href="javascript:void(0)" title="">11 Tips to Help You Get New Clients</a></h3>-->
<!--                                        <p>A job is a regular activity performed in exchange becoming an employee, volunteering,</p>-->
<!--                                        <a href="javascript:void(0)" title="">Read More <i class="la la-long-arrow-right"></i></a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-lg-4">-->
<!--                                <div class="my-blog">-->
<!--                                    <div class="blog-thumb">-->
<!--                                        <a href="javascript:void(0)" title=""><img src="<?= base_url('assets/images/resource/b3.jpg')?>" alt="" /></a>-->
<!--                                        <div class="blog-metas">-->
<!--                                            <a href="javascript:void(0)" title="">March 29, 2017</a>-->
<!--                                            <a href="javascript:void(0)" title="">0 Comments</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="blog-details">-->
<!--                                        <h3><a href="javascript:void(0)" title="">An Overworked Newspaper Editor</a></h3>-->
<!--                                        <p>A job is a regular activity performed in exchange becoming an employee, volunteering,</p>-->
<!--                                        <a href="javascript:void(0)" title="">Read More <i class="la la-long-arrow-right"></i></a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!--<section>-->
<!--    <div class="block">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-lg-12">-->
<!--                    <div class="heading">-->
<!--                        <h2>Companies We've Helped</h2>-->
<!--                        <span>Some of the companies we've helped recruit excellent applicants over the years.</span>-->
<!--                    </div>-->
<!-- Heading -->
<!--                    <div class="comp-sec">-->
<!--                        <div class="company-img">-->
<!--                            <a href="javascript:void(0)" title=""><img src="<?= base_url('assets/images/resource/cc1.jpg')?>" alt="" /></a>-->
<!--                        </div>-->
<!-- Client  -->
<!--                        <div class="company-img">-->
<!--                            <a href="javascript:void(0)" title=""><img src="<?= base_url('assets/images/resource/cc2.jpg')?>" alt="" /></a>-->
<!--                        </div>-->
<!-- Client  -->
<!--                        <div class="company-img">-->
<!--                            <a href="javascript:void(0)" title=""><img src="<?= base_url('assets/images/resource/cc3.jpg')?>" alt="" /></a>-->
<!--                        </div>-->
<!-- Client  -->
<!--                        <div class="company-img">-->
<!--                            <a href="javascript:void(0)" title=""><img src="<?= base_url('assets/images/resource/cc4.jpg')?>" alt="" /></a>-->
<!--                        </div>-->
<!-- Client  -->
<!--                        <div class="company-img">-->
<!--                            <a href="javascript:void(0)" title=""><img src="<?= base_url('assets/images/resource/cc5.jpg')?>" alt="" /></a>-->
<!--                        </div>-->
<!-- Client  -->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
