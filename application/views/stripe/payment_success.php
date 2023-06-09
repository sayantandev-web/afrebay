<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else{
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Payment Success</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block Pricing_Data">
        <div data-velocity="-.2" style="background: url('<?= base_url('assets/images/resource/parallax5.jpg')?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<?php
					require 'vendor/autoload.php';
					require_once APPPATH."third_party/stripe/init.php";
					\Stripe\Stripe::setApiKey('sk_test_835fqzvcLuirPvH0KqHeQz9K');
					$session = \Stripe\Checkout\Session::retrieve($s_id);
					$invoice_id = $session["invoice"];
                    $stripe = new \Stripe\StripeClient('sk_test_835fqzvcLuirPvH0KqHeQz9K');
                    $sub_data = $stripe->subscriptions->retrieve($session['subscription'],[]);
					$expire_date = date('Y-m-d', $sub_data['current_period_end']);
                    $created_date = date('Y-m-d');
                    $futureDate = $expire_date;
                    $month = (int)abs((strtotime($created_date) - strtotime($futureDate))/(60*60*24*30));
                    $price = $session['amount_total']/100;
                    $subQuery = $this->db->query("SELECT * FROM subscription where subscription_amount = '".$price."'")->result_array();
                    if($session['status'] == 'complete') {
						$dataDB = array(
							'employer_id' =>$_SESSION['afrebay']['userId'],
							'subscription_id' => $subQuery[0]['id'],
							'name_of_card' => $subQuery[0]['subscription_name'],
							'email' => $session['customer_details']['email'],
							'amount' => $price,
							'transaction_id' => $session['subscription'],
							'payment_status' => $session['payment_status'],
							'payment_date' => date('Y-m-d H:i:s'),
                            'expiry_date' => $expire_date,
                            'duration' => $month,
							'created_date' => date('Y-m-d'),
						);
						$this->db->insert('employer_subscription', $dataDB);
						if($this->db->insert_id()) { ?>
							<div class="heading">
								<h4 class="card-title">Payment Successful #<?php echo $this->db->insert_id(); ?></h4>
								<p class="card-text">We received your payment on your purchase #<?php echo $session['subscription']; ?>, check your email for more information.</p>
		                        <a href="<?php echo base_url('profile'); ?>" class="btn btn-info btn-sm float-right">Update Profile</a>
		                    </div>
					<?php }	}?>

				</div>
			</div>
		</div>
	</div>
</section>
