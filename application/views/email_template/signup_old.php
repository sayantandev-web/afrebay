<?php $settings=$this->Crud_model->get_single('setting'); ?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
<body>
   <div style="width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6; font-size:13px;">
      <div style="padding: 30px 30px 15px 30px;box-sizing: border-box;">
        <div style="border-bottom:2px solid grey;">
         <img src="<?=base_url('assets/images/gig-work01.jpg')?>" style="width:100%;margin-top: 0 auto;">
</div>

         <p style="font-size:15px;color:blue;">Thank you for your Joining GreatGigz!</p>
         <p>
             <table>
				 <thead>				
				 <tr>
				 <th colspan='2'><p style='font-size:12px;list-style: none;'>Please click on the link below to activate your new listing.</p></th>
				 </tr>
				 <tr>
				 <th><p style='font-size:12px;list-style: none;'><a href='#'>Greatgigz</a></p></th>
				 </tr>
				 <tr>
				 <th col span='2'> <p style='color:blue;'>Your Login Details</p></th>

				 </tr>
					 <tr>
						 <th style='border:1px solid grey'>
							 Username
						 </th>
						 <th style='border:1px solid grey'>
							 <?= @$email?>
						 </th>
					 </tr>
				 </thead>
				 <tbody>
					 <tr>
						 <th style='border:1px solid grey'>
							 Pasword
						 </th>
						 <th style='border:1px solid grey'>
						<?= @$password?>
						 </th>
					 </tr>
				 </tbody>
			 </table>
         </p>
          <p>If you need any  assitance while using our website, please reply directly to this mail.</p>
          <p>Thank You</p>
          <!--<p>David kassiance</p>-->
          <p><a href="base_url()"> GreatGigz</a></p>
          <p><a href="#">E-mail: <?=@$settings->email?></a></p>
          <!--<p><a href="< ?= base_url('unsubscribe/'.$email)?>" style="color:#000; text-decoration:none;">unsubscribe</a></p>-->
         </div>
         <!-- <footer style="height:25px;width:100%;"><span style="width: 100%; padding:20px; box-sizing: border-box; display: block;
    background: #ffffff;"><a href="< ?= base_url('unsubscribe/'.$email)?>">unsubscribe</a></span></footer> -->
      </div>

   </body>
   </html>
