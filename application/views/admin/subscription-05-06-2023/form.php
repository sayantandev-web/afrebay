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
							<div class="form-group showHideSection subscription_amount" >
								<label>Subscription Amount ($)</label>
								<input class="form-control" type="text" placeholder="Example: 100 USD" id="subscription_amount" name="subscription_amount" value="<?= $subscription_amount;?>" required  onkeypress="only_number(event)">
							</div>
							<div class="form-group showHideSection product_key" >
								<label>Product ID (Stripe Product Key)</label>
								<input class="form-control" type="text" placeholder="Example: prod_XXXXXXXXXXXXXX" id="product_key" name="product_key" value="<?= $product_key;?>">
							</div>
							<div class="form-group showHideSection price_key" >
								<label>Price ID (Stripe Price Key)</label>
								<input class="form-control" type="text" placeholder="Example: price_XXXXXXXXXXXXXXXXXXXXXXXX" id="price_key" name="price_key" value="<?= $price_key;?>">
							</div>
							<div class="form-group">
								<label>Subscription Duration (in days)</label>
								<input class="form-control" type="text" placeholder="Example: 30" name="subscription_duration" value="<?= $subscription_duration;?>" required onkeypress="only_numbers(event)">
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
.product_key {display: none;}
.price_key {display: none;}
</style>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
$(document).ready(function(){
	var subscription_type = $('#subscription_type').val();
	if(subscription_type == 'free') {
		$('.product_key').hide();
		$('.price_key').hide();
		$('.product_key').prop('required',false);
		$('.price_key').prop('required',false);
		$('.subscription_amount').show();
		$('#subscription_amount').val('0.00');
		$('#subscription_amount').prop('readonly', true);
	}else if(subscription_type == 'paid') {
		$('.product_key').show();
		$('.price_key').show();
		$('.product_key').prop('required',true);
		$('.price_key').prop('required',true);
	}

	$("#subscription_amount").on("keypress keyup blur", function (event) {
 		var patt = new RegExp(/(?<=\.\d\d).+/i);
     	$(this).val($(this).val().replace(patt, ''));
     	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        	event.preventDefault();
     	}
 	});
})
function showHideDiv() {
	var selectedOption = $('#subscription_type').val();
	if(selectedOption == 'free') {
		$('.showHideSection').show();
		$('#subscription_amount').val('0.00');
		$('#subscription_amount').prop('readonly', true);
		$('.product_key').hide();
		$('.price_key').hide();
	} else if (selectedOption == 'paid') {
		$('.showHideSection').show();
		$('#subscription_amount').prop('readonly', false);
		$('.product_key').show();
		$('.price_key').show();
		$('.product_key').prop('required',true);
		$('.price_key').prop('required',true);
	} else {
		$('.showHideSection').hide();
	}
}
function only_number(event) {
    var x = event.which || event.keyCode;
    console.log(x);
    if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 || x == 46) {
        return;
    } else {
        event.preventDefault();
    }
}
function only_numbers(event) {
    var x = event.which || event.keyCode;
    console.log(x);
    if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13) {
        return;
    } else {
        event.preventDefault();
    }
}
</script>
