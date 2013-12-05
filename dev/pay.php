<?php
require_once('stripe-php-1.10.1/lib/Stripe.php');
$trialAPIKey = "sk_test_2Dx34r6YqUHebwPHUEoqf1JC"; // These are the SECRET keys!
$token = $_POST['stripeToken'];
$email = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$price = $_POST['price'];
$priceInCents = $price * 100; // Stripe requires the amount to be expressed in cents

Stripe::setApiKey($trialAPIKey);
try
{
	$charge = Stripe_Charge::create(array(
         "amount" => $priceInCents,
         "currency" => "usd",
         "card" => $token,
         "description" => $email)
      );
	$array = array('result' => 0, 'email' => $email, 'price' => $price, 'message' => 'Thank you; your transaction was successful!');
	echo "<div style='min-height:300px;background:#231f20;color:#FFF;padding-left:15px;'><div style='color:white;width:320px;height:40px;'><h1 style='float:left;margin-left:0px;'>SUCCESS!</h1><img style='float:right;margin-top:5px;margin-right:20px;' src='/dev/wp-content/themes/images/step3.png' /></div><div style='float:left;clear:both;'><p><b>Your card has been charged $".$price.".</b></p><br/><p>Make your reservation now by calling <b>For Two Please</b> at <b>604.600.8441</b>.</p><br/><p>Just remember to take your ForTwoPlease Voucher, which is located on <a href='/dev/myaccount'>your account page</a>.</p><br/><p>We've also sent you an email for reference, with your confirmation code, <b></b>.</p><br/><p>Have a great date!</p><br/><a href='/dev/myaccount'>Your Account</a><br/><a href='/vancouver/date-idea-type/packages'>< Browse More Date Packages!</a></div></div>";
}
catch (Exception $e) 
{
	echo "payments aren't working yet.";
}
?>