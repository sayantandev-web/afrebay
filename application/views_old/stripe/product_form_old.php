<?php
    $baseUrl = base_url();
?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url(<?=$baseUrl; ?>assets/images/resource/mslider1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Subscription</h3>
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
                    <div class="account-popup-area signup-popup-box static">
                        <div class="account-popup">
                            <h3><img src="<?= base_url('assets/images/stripe.png')?>" style="width:100%; height:100%;"></h3>
                            <div id="payment-errors"></div>
                            <span class="text-danger f-25"><?=$this->session->flashdata('error');  ?></span>
                            <form method="post" id="paymentFrm" enctype="multipart/form-data" action="<?php echo base_url(); ?>Stripe/check">
                                <div class="error text-left">Full Name</div>
                                <div class="cfield">
                                    <input type="text" placeholder="Full Name" name="name" id="name" onkeypress="only_alphabets(event)" value="<?php if(!empty($get_user->firstname)){ echo $get_user->firstname.' '.$get_user->lastname;} else{ echo $get_user->username;}?>" autocomplete="off"/>
                                     <i class="la la-user"></i>
                                </div>
                                <div class="error text-left">Email</div>
                                <div class="cfield">
                                    <input type="email" placeholder="Email" name="email" id="email" value="<?= @$_SESSION['gigwork']['userEmail']; ?>"required autocomplete="off"/>
                                    <i class="la la-envelope-o"></i>
                                </div>
                                 <div class="error text-left">Card Number</div>
                                <div class="cfield">
                                    <input type="text" placeholder="card Number" name="card_num" id="card_num" onkeypress="only_number(event)" autocomplete="off" />
                                   
                                </div>
                                <div class="error text-left">Card Month</div>
                                <div class="cfield">
                                    <input type="text" placeholder="MM" name="exp_month" id="card-expiry-month" onkeypress="only_number(event)" maxlength="2" required autocomplete="off"/>
                                   
                                </div>
                                <div class="error text-left">Card Year</div>
                                <div class="cfield">
                                    <input type="text" placeholder="YYYY" name="exp_year" id="card-expiry-year" maxlength="4" onkeypress="only_number(event)" required autocomplete="off"/>
                                   
                                </div>
                                <div class="error text-left">CVC</div>
                                <div class="cfield">
                                    <input type="text" placeholder="CVC" name="cvc" id="card-cvc" maxlength="3" onkeypress="only_number(event)" required autocomplete="off"/>
                                   
                                </div>
                               
                                 <input type="hidden" name="subscription_id" value="<?php if(!empty($get_data->id)){ echo $get_data->id;}?>">
                        <input type="hidden" name="subscription_amount" value="<?php if(!empty($get_data->subscription_amount)){ echo $get_data->subscription_amount;}?>">
                                <button type="submit" id="payBtn">Pay ($<?php if(!empty($get_data->subscription_amount)){ echo $get_data->subscription_amount;}?>)</button>
                            </form>
                           
                        </div>
                    </div>
                    <!-- SIGNUP POPUP -->
                </div>
            </div>
        </div>
    </div>
</section>



 <!-- Stripe JavaScript library -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        //set your publishable key
        Stripe.setPublishableKey('pk_test_mj53x8AO1emJ6ZO5D9k5P0fi');

        //callback to handle the response from stripe
        function stripeResponseHandler(status, response) {
            if (response.error) {
                //enable the submit button
                $('#payBtn').removeAttr("disabled");
                //display the errors on the form
                // $('#payment-errors').attr('hidden', 'false');
                $('#payment-errors').addClass('alert alert-danger');
                $("#payment-errors").html(response.error.message);
            } else {
                var form$ = $("#paymentFrm");
                //get token id
                var token = response['id'];
                //insert the token into the form
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                //submit form to the server
                form$.get(0).submit();
            }
        }
        $(document).ready(function() {
            //on form submit
            $("#paymentFrm").submit(function(event) {
                //disable the submit button to prevent repeated clicks
                $('#payBtn').attr("disabled", "disabled");

                //create single-use token to charge the user
                Stripe.createToken({
                    number: $('#card_num').val(),
                    cvc: $('#card-cvc').val(),
                    exp_month: $('#card-expiry-month').val(),
                    exp_year: $('#card-expiry-year').val()
                }, stripeResponseHandler);

                //submit from callback
                return false;
            });
        });
    </script>


