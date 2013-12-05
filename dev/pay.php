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

	$transID = "0";
	$pname = "this date package";
	$bname = "For Two Please";
	$phone = "604 600 8441";
	$headers = 'From: ForTwoPlease <info@fortwoplease.com>' . "\r\n";
	//add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
	//wp_mail($email, 'Purchase Successful!', '<p style="margin:0;"><strong>Congratulations,</strong></p><p style="margin:0;">Your purchase of '.$pname.' from '.$bname.' was successful.</p><br/><p style="margin:0;"><b>Payment Summary</b></p><p style="margin:0;">Total: $'.$price.'</p><p style="margin:0;">Confirmation Number: '.$transID.'</p><br/><p style="margin:0;"><b>How-To-Use This Date Package:</b></p><p style="margin:0;">1. Make your reservation now by calling '.$bname.' at '.$phone.'.</p><p style="margin:0;">2. Print & bring your ForTwoPlease Voucher, which is available on <a href="http://www.fortwoplease.com/vancouver/myaccount">your account page</a>.</p><br/><p style="margin:0;">(Reservations are required for all ForTwoPlease Date Packages)</p><br/><p style="margin:0;">Enjoy!</p><br/><p style="margin:0;">The ForTwoPlease Team</p>
	//<br/><p style="margin:0;">p.s. Have any questions or need some help? Email us at <b>support@fortwoplease.com</b> or call us at <b>604.600.8441</b> and we\'ll get back to you as soon as we can!</p><br/><p style="margin:0;"><a href="http://www.fortwoplease.com/vancouver/myaccount">Take me to my account page</a></p><p style="margin:0;"><a href="http://www.fortwoplease.com/">Discover more date ideas!</a></p>',$headers);
    
    $message = "<div style='min-height:300px;background:#231f20;color:#FFF;padding-left:15px;'><div style='color:white;width:320px;height:40px;'><h1 style='float:left;margin-left:0px;'>SUCCESS!</h1><img style='float:right;margin-top:5px;margin-right:20px;' src='/dev/wp-content/themes/images/step3.png' /></div><div style='float:left;clear:both;'><p><b>Your card has been charged $".$price.".</b></p><br/><p>Make your reservation now by calling <b>".$bname."</b> at <b>".$phone."</b>.</p><br/><p>Just remember to take your ForTwoPlease Voucher, which is located on <a href='/dev/myaccount'>your account page</a>.</p><br/><p>We've also sent you an email for reference, with your confirmation code, ".$transID."<b></b>.</p><br/><p>Have a great date!</p><br/><a href='/dev/myaccount'>Your Account</a><br/><a href='/vancouver/date-idea-type/packages'>< Browse More Date Packages!</a></div></div>";
    $array = array('result' => 0, 'email' => $email, 'price' => $price, 'message' => $message);
    echo json_encode($array);
}
catch (Exception $e) 
{
	echo "payments aren't working yet.";
}
?>