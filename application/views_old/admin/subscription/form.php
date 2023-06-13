<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-xl-8 offset-xl-2">
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title"><?php echo $heading?></h3>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
	            		<?php if($button=='Update') { ?>
	        			<form  action="<?php echo admin_url('subscription/update_action'); ?>" method="post" enctype="multipart/form-data">
	            		<?php } else { ?>
	    				<form class="forms-sample" action="<?php echo admin_url('Subscription/create_action'); ?>" method="post" enctype="multipart/form-data">
	            		<?php } ?>
							<div class="form-group">
								<label>Subscription Name</label>
								<input class="form-control" type="text" placeholder="Example: Basic" name="subscription_name" value="<?= $subscription_name;?>" required>
							</div>
							<div class="form-group">
								<label>Subscription Type</label>
								<select class="form-control" name="subscription_type" id="subscription_type" required onclick="showHideDiv()">
									<option value="">Choose an option</option>
									<option value="free" <?php if($subscription_type == 'free') { echo "selected"; } ?>>Free</option>
									<option value="paid" <?php if($subscription_type == 'paid') { echo "selected"; } ?>>Paid</option>
								</select>
							</div>
							<div class="form-group <?php if($button != 'Update') { echo "showHideSection"; }?>" >
								<label>Subscription Amount</label>
								<input class="form-control" type="text" placeholder="Example: 100 USD" id="subscription_amount" name="subscription_amount" value="<?= $subscription_amount;?>" required>
							</div>
							<!-- <div class="form-group <?php if($button != 'Update') { echo "showHideSection"; }?>" >
								<label>Payment Link (Stripe Payment Link)</label>
								<input class="form-control" type="text" placeholder="Example: https://abc.abcdef.com/xxxx_xxxxxxxxxxxxxxxxxx" id="payment_link" name="payment_link" value="<?= $payment_link;?>" required>
							</div> -->
							<div class="form-group <?php if($button != 'Update') { echo "showHideSection"; }?>" >
								<label>Product ID (Stripe Product Key)</label>
								<input class="form-control" type="text" placeholder="Example: prod_XXXXXXXXXXXXXX" id="product_key" name="product_key" value="<?= $product_key;?>" required>
							</div>
							<div class="form-group <?php if($button != 'Update') { echo "showHideSection"; }?>" >
								<label>Price ID (Stripe Price Key)</label>
								<input class="form-control" type="text" placeholder="Example: price_XXXXXXXXXXXXXXXXXXXXXXXX" id="price_key" name="price_key" value="<?= $price_key;?>" required>
							</div>
							<div class="form-group">
								<label>Subscription Durations</label>
								<input class="form-control" type="text" placeholder="Example: 1 Year" name="subscription_duration" value="<?= $subscription_duration;?>" required>
							</div>
							<div class="form-group">
								<label>Subscription Description</label>
								<!-- <input class="form-control" type="text" name="subscription_description" value="<?= $subscription_description;?>"> -->
								<textarea class="form-control" name="subscription_description" id="subscription_description"><?= @$subscription_description ?></textarea>
							</div>
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="hidden" name="button" value="<?php echo $button; ?>">
							<div class="mt-4">
								<button class="btn btn-primary" type="submit">Submit</button>
								<a href="<?= admin_url('subscription')?>" class="btn btn-link">Cancel</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.showHideSection {display: none;}
</style>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace('subscription_description');
</script>
<script >
/*function add_row() {
	var y=document.getElementById('clonetable_feedback1');
	var new_row = y.rows[0].cloneNode(true);
	var len = y.rows.length;
	new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;
	var inp3 = new_row.cells[0].getElementsByTagName('input')[0];
	inp3.value = '';
	inp3.id = 'service'+(len+1);
	var submit_btn =$('#submit').val();
	y.appendChild(new_row);
}

function remove(row) {
	var y=document.getElementById('purchaseTableclone1');
	var len = y.rows.length;
	if(len>2) {
		var i= (len-1);
		document.getElementById('purchaseTableclone1').deleteRow(i);
	}
}*/
function showHideDiv() {
	var selectedOption = $('#subscription_type').val();
	if(selectedOption == 'free') {
		$('.showHideSection').show();
		$('#subscription_amount').val('0.00');
		$('#subscription_amount').prop('readonly', true);
	} else if (selectedOption == 'paid') {
		$('.showHideSection').show();
		$('#subscription_amount').prop('readonly', false);
	} else {
		$('.showHideSection').hide();
	}
}
</script>
