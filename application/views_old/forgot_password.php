
 <section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= base_url("assets/images/resource/mslider1.jpg")?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Forgot Password</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="block remove-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-popup-area signin-popup-box static">
                        <div class="account-popup">
                            <h3>Forgot Password</h3>
                            
                            <span class="text-success-msg f-20"><?=$this->session->flashdata('success');  ?></span>
                            <span class="text-danger f-20"><?=$this->session->flashdata('error');  ?></span>
                            <form action="<?= base_url('user/login/send_forget_password')?>" method="post">
                               
                                <div class="error text-left">Email</div>
                                <div class="cfield">
                                    <input type="email" placeholder="Registered Email Id" name="email" id="forget_email" required/>
                                    <i class="la la-user"></i>
                                </div>
                                
                                <button type="submit">Submit</button>
                            </form>
                           
                        </div>
                    </div>
                    <!-- LOGIN POPUP -->
                </div>
            </div>
        </div>
    </div>
</section>


            