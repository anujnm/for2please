<?php
show_admin_bar( false ); 

function limit_terms($val) {
    return array_splice($val, 0, 3);
}

add_filter( "term_links-location", 'limit_terms');

function save_Rdata($s) {
	global $post;
	 $setflag = true;
	$postID = $post->ID;
	if(get_field('merchant_username',$postID)){
	$merchantID = get_field('merchant_username',$postID);
	if(get_user_meta($merchantID,'pckg',false)){
		$livePackages = get_user_meta($merchantID,'pckg',false);
		foreach($livePackages as $value) {
		if($value == $postID){
		  $setflag = false;
		}
		}
	if($setflag == true){
		add_user_meta($merchantID,'pckg',$postID);
	}
	}
	}
    return $s;
}

add_filter( "content_save_pre", 'save_Rdata');

function get_permalink_now(){
	$id = $_POST['id'];
	echo get_permalink($id);
	exit();
}
add_action('wp_ajax_nopriv_getpermalink', 'get_permalink_now');
add_action('wp_ajax_getpermalink', 'get_permalink_now');//for users that are not logged in.



function load_single_date(){
	if($_POST['dateID1']!='rand')
	{
	$id[1] = $_POST['dateID1'];
	$id[2] = $_POST['dateID2'];
	$id[3] = $_POST['dateID3'];
	}
	else{
		$id[1]= get_random_date();
		$id[2] = get_random_date();
	    $id[3] = get_random_date();
	}
	$cflag = 1;
	if($id[2] != "empt"){
	$cflag = 2;
	}
	if($id[2] != "empt"){
	$cflag = 3;
	}
	
	for($iz=1;$iz<=$cflag;$iz++){
	$itemPermalink = get_permalink($id[$iz]);
	$datetypes = get_the_term_list( $id[$iz], 'date-type', '', ', ', '' );
	echo "<div id='";
	echo $id[$iz];
	echo "' class='testsearch' style='background:url(";
	echo get_field('thumbnail',$id[$iz]);
	echo");height:235px;width:330px;margin-bottom:30px;float:left;margin-right:10px;box-shadow:2px 2px 5px #888;position:relative;'>";
	if(stristr(strip_tags($datetypes),'Packages') !== FALSE)
	{
	echo '<div style="position:relative;left:-125px;top:5px;z-index:2;position:absolute;top:0;left:0;"><img src="/dev/wp-content/themes/images/get-it-here.png"></div>';
	}
	echo "<div style='height:200px;width:330px;'>";
	echo "<div id='searchtest' class='testsearch2'>";
	echo "<div class='result-type' style='width:240px;text-align:right;'>";
	if (!empty($datetypes)) echo '<p style="color:#F07323">', strip_tags($datetypes) ,'</p>';
	echo "</div><div style='position: relative;  text-align: left; left: 20px; overflow: hidden; width: 305px; height: 140px;clear:both;'><a style='color:#FFF;font-size:18px;font-weight:700;text-decoration:none;' href='";
    echo $itemPermalink;
	echo "'>";
	echo get_the_title($id[$iz]);
	echo "</a><br/>";
	$terms_as_text = get_the_term_list( $id[$iz], 'location', '', ', ', '' );
	if (!empty($terms_as_text)) echo '<p style="color:#FFF;">', strip_tags($terms_as_text) ,'</p>';
	echo "<br/><p style='color:white;width:300px;'>";
	echo showBrief(get_field('short_description',$id[$iz]),20 ); 
	echo "...</p><a style='float:right;margin-right:10px;text-decoration:none;' href='";
	echo $itemPermalink;
	echo "'>Read More...</a></div></div></div>";
	echo "<div class='overlay'><h3><a href='";
	echo $itemPermalink;
	echo "'>";
	echo the_field('sub_title',$id[$iz]);
	echo "</a></h3></div></div>";
	}
	exit();
}
add_action('wp_ajax_nopriv_loaddate', 'load_single_date');
add_action('wp_ajax_loaddate', 'load_single_date');//for users that are not logged in.

function get_random_date(){
	$args = array('showposts' => 1, 'orderby' => 'rand', 'post_type' => 'dates', 'post_status' => 'publish');
	$rand_posts = get_posts($args);
	if($rand_posts){
		return $rand_posts[0]->ID;
	}
}

function recommend_dates(){
	$ID[0] = $_POST['id1'];
	$ID[1] = $_POST['id2'];
	$ID[2] = $_POST['id3'];
	
	
	//$POST = wp_get_single_post($ID1);
	
	for ($i=0;$i<3;$i++)
{
	if($ID[$i]==0){
		$ID[$i] = get_random_date();
	}
	$itemPermalink = get_permalink($ID[$i]);
	if($i==0)
	{
		echo "<p style='font-size:16px;font-weight:700;color:#666;margin-left:90px;padding-top:10px;'>More Great Date Ideas</p>";
	}
	echo "<div id='";
	
	echo $ID[$i];
	echo "' class='testsearch' style='background:url(";
	echo get_field('thumbnail',$ID[$i]);
	echo");height:188px;width:264px;margin-bottom:30px;float:left;margin-right:10px;box-shadow:2px 2px 5px #888;margin-top:10px;margin-left:35px;color:#FFF;'>";
	if(stristr(strip_tags(get_the_term_list( $ID[$i], 'date-type', '', ', ', '' )),'Packages') !== FALSE)
	{
	echo '<div style="z-index:2;position:absolute;"><img src="/dev/wp-content/themes/images/get-it-here.png"></div>';
	}
	echo "<div style='height:180px;width:264px'>";
	echo "<div id='searchtest' class='testsearch2' style='height:180px;width:264px;'>";
	echo "<div class='result-type' style='margin-top:5px;margin-right:5px;height:18px;overflow:hidden;color:#f07323;width:180px;'>";
	echo strip_tags(get_the_term_list( $ID[$i], 'date-type', '', ', ', '' ));
	echo "</div><div style='position: relative;  text-align: left; left: 20px; overflow: hidden; width: 244px; height: 150px;clear:both;top:40px;'><a style='color:#FFF;font-weight:700;font-size:18px;' href='";
    echo $itemPermalink;
	echo "'>";
	echo showBrief(get_the_title($ID[$i]),5);
	echo "</a><br/>";
	echo strip_tags(get_the_term_list( $ID[$i], 'location', '', ', ', '' ));
	echo "<br/><p style='color:white;width:240px;margin-top:10px;'>";
	echo showBrief(get_field('short_description',$ID[$i]),20 ); 
	echo "...</p>";
	echo "</div></div></div>";
	echo "<div class='overlay' style='width:264px;height:20px;text-align:center;'><p style='font-size:14px;font-weight:700;'><a href='";
	echo $itemPermalink;
	echo "'>";
	echo the_field('sub_title',$ID[$i]);
	echo "</a></p></div></div><div style='clear:both;'></div>";
}
	exit();
	
}
add_action('wp_ajax_nopriv_recommenddates', 'recommend_dates');
add_action('wp_ajax_recommenddates', 'recommend_dates');//for users that are not logged in.

function search_by_keyword(){
	$myquery['post_type'] = 'dates';
	$myquery['posts_per_page'] = '500';
	$myquery['post_status'] = 'publish';
	query_posts($myquery);
	$index = 1;
	while ( have_posts() ) : the_post();
	if(stristr(get_the_title(),$_POST['key']) !== FALSE || stristr(get_field('sub_title'),$_POST['key']) !== FALSE || stristr(get_field('short_description'),$_POST['key']) !== FALSE )
	{
	
	$result_array[$index] = get_the_ID();
	$index++;

	}
	endwhile;
	$result_array["length"] = $index;
	wp_reset_query();
	echo json_encode($result_array); 
	exit();

	
}
add_action('wp_ajax_nopriv_searchbykeyword', 'search_by_keyword');
add_action('wp_ajax_searchbykeyword', 'search_by_keyword');//for users that are not logged in.




/**
 * Send HTTP POST Request
 *
 * @param	string	The API method name
 * @param	string	The POST Message fields in &name=value pair format
 * @return	array	Parsed HTTP Response body
 */
function pp_action() {
	/*
	$environment = 'live';	// or 'beta-sandbox' or 'live'
	global $environment;
	
	// Set up your API credentials, PayPal end point, and API version.
	$API_UserName = urlencode('admin_api1.fortwoplease.com');
	$API_Password = urlencode('CXFGR3NZBH5BPJL6');
	$API_Signature = urlencode('AFcWxV21C7fd0v3bYYYRCpSSRl31AP0MHJ3Cg3PUZuxPFpgs7cWNMGgc');
	$API_Endpoint = "https://api-3t.paypal.com/nvp";
	if("sandbox" === $environment || "beta-sandbox" === $environment) {
		$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
	}
	$version = urlencode('51.0');
	
	/*
	error_log("first_name: ".$_POST['first_name']);
	error_log("last_name: ".$_POST['last_name']);
	error_log("quantity: " . $_POST['quantity']);
	error_log("cardholder first name: " . $_POST['cardholder_fname']);
	error_log("cardholder last name: " . $_POST['cardholder_lname']);
	error_log("card number: " . $_POST['card_number']);
	error_log("exp year: " . $_POST['exp_year']);
	error_log("exp month: " . $_POST['exp_month']);
	error_log("csv: " . $_POST['csv']);
	error_log("street: " . $_POST['street']);
	error_log("city: " . $_POST['city']);
	error_log("province: " . $_POST['province']);
	error_log("country code: " . $_POST['country_code']);
	error_log("postal code: " . $_POST['postal_code']);
	error_log("amount: " . $_POST['amount']);
	*/
	/*
	$theID = $_POST['theID'];
	$totalPrice = $amount;
	$phone = get_field('phone_number',$theID);
	$bname = get_field('business_name',$theID);
	$pname = get_field('package_name',$theID);
	$postid = $_POST['postid'];
	$numberp = $_POST['quantity'];
	
	// Set request-specific fields.
	$paymentType = urlencode('Sale');				// or 'Sale'
	$firstName = urlencode($_POST['cardholder_fname']);
	$lastName = urlencode($_POST['cardholder_lname']);
	// $creditCardType = urlencode('customer_credit_card_type');
	$creditCardNumber = urlencode($_POST['card_number']);
	$expDateMonth = $_POST['exp_month'];
	// Month must be padded with leading zero
	$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));

	$expDateYear = urlencode($_POST['exp_year']);
	$cvv2Number = urlencode($_POST['csv']);
	$address1 = urlencode($_POST['street']);
	// $address2 = urlencode('customer_address2');
	$city = urlencode($_POST['city']);
	$state = urlencode($_POST['province']);
	$zip = urlencode($_POST['postal_code']);
	$country = urlencode($_POST['country_code']);				// US or other valid country code
	$amount = urlencode($_POST['amount']);
	$currencyID = urlencode('CAD');							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
	

	// Add request-specific fields to the request string.
	$nvpStr =	"&PAYMENTACTION=$paymentType&AMT=$amount&ACCT=$creditCardNumber".
				"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".
				"&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";
	

	// Set the curl parameters.
	$ch = curl_init();
	//curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
	//curl_setopt($ch, CURLOPT_VERBOSE, 1);

	// Turn off the server and peer verification (TrustManager Concept).
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt($ch, CURLOPT_POST, 1);

	// Set the API operation, version, and API signature in the request.
	$nvpreq = "METHOD=DoDirectPayment&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr";

	// Set the request as a POST FIELD for curl.
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
	
	/*
	if(curl_errno($ch)) {
	  $err = print_r(curl_getinfo($ch),1);
	  $err .= "\nError No.:".curl_errno($ch);
	  $err .= "\nError Description:".curl_error($ch);
		error_log($err);
	}
	*/

	// Get response from the server.
	//$httpResponse = curl_exec($ch);

	/*
	if(!$httpResponse) {
		exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
	}
	*/

	// Extract the response details.
	/*
	$httpResponseAr = explode("&", $httpResponse);

	$httpParsedResponseAr = array();
	foreach ($httpResponseAr as $i => $value) {
		$tmpAr = explode("=", $value);
		if(sizeof($tmpAr) > 1) {
			$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
		}
	}

	if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
		exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
	}	
	*/
	/*
	//if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
		//$transID = $httpParsedResponseAr['TRANSACTIONID'];
		
		$transID = 0;
		$uid = wp_get_current_user();
		$userID = $uid->ID;
		$name = $uid->user_login;
		$user_email = $uid->user_email;

		$headers = 'From: ForTwoPlease <info@fortwoplease.com>' . "\r\n";
		add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
		wp_mail($user_email, 'Purchase Successful!', '<p style="margin:0;"><strong>Congratulations,</strong></p><p style="margin:0;">Your purchase of '.$pname.' from '.$bname.' was successful.</p><br/><p style="margin:0;"><b>Payment Summary</b></p><p style="margin:0;">Total: $'.$amount.'</p><p style="margin:0;">Confirmation Number: '.$transID.'</p><br/><p style="margin:0;"><b>How-To-Use This Date Package:</b></p><p style="margin:0;">1. Make your reservation now by calling '.$bname.' at '.$phone.'.</p><p style="margin:0;">2. Print & bring your ForTwoPlease Voucher, which is available on <a href="http://www.fortwoplease.com/vancouver/myaccount">your account page</a>.</p><br/><p style="margin:0;">(Reservations are required for all ForTwoPlease Date Packages)</p><br/><p style="margin:0;">Enjoy!</p><br/><p style="margin:0;">The ForTwoPlease Team</p>
<br/><p style="margin:0;">p.s. Have any questions or need some help? Email us at <b>support@fortwoplease.com</b> and we\'ll get back to you as soon as we can!</p><br/><p style="margin:0;"><a href="http://www.fortwoplease.com/vancouver/myaccount">Take me to my account page</a></p><p style="margin:0;"><a href="http://www.fortwoplease.com/">Discover more date ideas!</a></p>',$headers);
		
		$uid = wp_get_current_user();
		$merchantuname = get_field('merchant_username',$postid);
		$datename = get_field('sub_title',$postid);
		date_default_timezone_set('Canada/Pacific');
		$timestamp =  date("Y-m-d H:i:s");
		$price = get_field('price');
		$merchantname = intval($merchantuname);
		for ($i = $numberp; $i > 0; $i--) {
			$unique = uniqid();
			add_user_meta($uid->ID,'purchased',$unique); 
			add_user_meta($uid->ID,$unique.'_item',$datename);
			add_user_meta($uid->ID,$unique.'_id',$postid); 
			add_user_meta($uid->ID,$unique.'_np',$numberp);
			add_user_meta($uid->ID,$unique.'_time',$timestamp);
			add_user_meta($uid->ID,$unique.'_stat','notdone');
			add_user_meta($uid->ID,$unique.'_for_fname', $_POST['first_name']);
			add_user_meta($uid->ID,$unique.'_for_lname', $_POST['last_name']);
			add_user_meta($merchantuname,$postid,$unique);
			add_user_meta($merchantuname,$unique,$uid->ID); 
			add_user_meta($merchantuname,$unique.'_d','notdone'); 
			$summary = $timestamp. ' '. $price . ' ' . $datename . ' ' .$uid->user_login . ' ' . $uid->user_email . ' '  . $uid->user_firstname . ' ' . $uid->user_lastname ;
			add_user_meta(1,'sold',$summary);
		}
		
		echo "<div style='min-height:300px;background:#231f20;color:#FFF;padding-left:15px;'><div style='color:white;width:320px;height:40px;'><h1 style='float:left;margin-left:0px;'>SUCCESS!</h1><img style='float:right;margin-top:5px;margin-right:20px;' src='/dev/wp-content/themes/images/step3.png' /></div><div style='float:left;clear:both;'><p><b>Your card has been charged $".$amount.".</b></p><br/><p>Make your reservation now by calling <b>".$bname."</b> at <b>".$phone."</b>.</p><br/><p>Just remember to take your ForTwoPlease Voucher, which is located on <a href='/dev/myaccount'>your account page</a>.</p><br/><p>We've also sent you an email for reference, with your confirmation code, <b>".$transID."</b>.</p><br/><p>Have a great date!</p><br/><a href='/dev/myaccount'>Your Account</a><br/><a href='/vancouver/date-idea-type/packages'>< Browse More Date Packages!</a></div></div>";
		
		//echo "Success";
		error_log ('Direct Payment Completed Successfully: '.print_r($httpParsedResponseAr, true));
	
	/*} else {
		echo "Your payment did not go through. Please review all required fields to ensure accuracy. If you need help purchasing, email ForTwoPlease at support@fortwoplease.com." ;
		
		error_log ($httpParsedResponseAr['TIMESTAMP']);
		error_log ('DoDirectPayment failed: ' . print_r($httpParsedResponseAr, true));
	}*/
	require_once('stripe-php-1.10.1/lib/Stripe.php');
	$trialAPIKey = "sk_test_2Dx34r6YqUHebwPHUEoqf1JC"; // These are the SECRET keys!
	$token = $_POST['stripeToken'];
	$theID = $_POST['theID'];
	$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
	$firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
	$lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
	$redemptionFirstName = filter_var($_POST['redemptionFirstName'], FILTER_SANITIZE_STRING);
	$redemptionLastName = filter_var($_POST['redemptionLastName'], FILTER_SANITIZE_STRING);
	$numberp = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
	$post_info = get_post_meta($theID);
	$price_per_package = $post_info['price'][0];
	$taxes = $post_info['taxes'][0];
	$fees = $post_info['fees'][0];
	$total_per_package = $price_per_package + $taxes + $fees;
	$total = $numberp * $total_per_package;
	$total_cents = $total * 100;
	Stripe::setApiKey($trialAPIKey);
    try
    {
        $phone = get_field('phone_number',$theID);
        $bname = get_field('business_name',$theID);
        $pname = get_field('package_name',$theID);
        $uid = wp_get_current_user();
        if (!isset($token)) {
            throw new Exception("Server Error: Could not complete payment with payment provider Stripe. Please try again later.");
        } 
        if (!isset($email) && !filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Server Error: Please ensure you have a valid email address to process this transaction. Your card was not charged. ");
        }
        if (!isset($firstName)) { 
            throw new Exception("Server Error: Invalid first name, your credit card was NOT charged. Please try again later.");
        }
        if (!isset($lastName)) { 
            throw new Exception("Server Error: Invalid last name, your credit card was NOT charged. Please try again later.");
        }
        if (!isset($total_cents)) { 
            throw new Exception("Server Error: Your credit card was NOT charged. Please try again later.");
        }
        if (!isset($redemptionFirstName) && !isset($redemptionLastName)) {
            throw new Exception("Please enter a valid name for the person who will be using the date package. Your card was not charged.");
        }
        if (!isset($numberp) || $numberp<0 || $numberp > 4) {
            throw new Exception("Transaction failed, your card was not charged. Please select a valid quantity.");
        }
        try {
            // Create charge on Stripe using token that was created on the client. Ensure the right meta data is sent to Stripe's server. 
            $charge = Stripe_Charge::create(array(
             "amount" => $total_cents,
             "currency" => "cad",
             "card" => $token,
             "description" => "Purchase of ".$pname." from ".$bname." by ".$email,
             "metadata" => array("user id"=> $uid->ID,
                                 "email"=>$email,
                                 "purchase name"=> $pname,
                                 "merchant name"=> $bname,
                                 "merchant id"=> $theID
                                )

            ));
            if ($charge->paid != true) {
                throw new Exception("Error while processing charge. Please try again later. ");
            }
            $voucherIDs = array();
            $voucherString = "";
            for ($i = $numberp; $i>0; $i--) {
                $unique = uniqid();
                $index = $numberp-$i;
                $voucherIDs[$index] = $unique;
                $voucherString = $voucherString.'<p style="margin:0;">'.($index+1).'. '.$unique.'</p>';
            }
            $transID = $charge->id;
            $merchantuname = get_field('merchant_username',$theID);
            $datename = get_field('sub_title',$theID);
            $headers = 'From: ForTwoPlease <info@fortwoplease.com>' . "\r\n";
            add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
            $numberVouchers = "";
            if ($numberp == 1) {
                $numberVouchers = $numberp." voucher";
            } else {
                $numberVouchers = $numberp." vouchers";
            }

            // Send email using Mandrill API.
            $html = '<p style="margin:0;"><strong>Congratulations,</strong></p><p style="margin:0;">Your purchase of '.$numberVouchers.' of '.$pname.' from '.$bname.' was successful!</p><br/><p style="margin:0;"><b>Payment Summary</b></p><p style="margin:0;">Total: $'.$total.'</p><p style="margin:0;">Confirmation Number: '.$transID.'</p><br/><p style="margin:0;"><b>Voucher IDs:</b></p><p style="margin:0;">'.$voucherString.'</p><br/><p style="margin:0;"><b>How-To-Use This Date Package:</b></p><p style="margin:0;">1. Make your reservation now by calling '.$bname.' at '.$phone.'.</p><p style="margin:0;">2. Print & bring your ForTwoPlease Voucher, which is available on <a href="http://www.fortwoplease.com/vancouver/myaccount">your account page</a>.</p><br/><p style="margin:0;">(Reservations are required for all ForTwoPlease Date Packages)</p><br/><p style="margin:0;">Enjoy!</p><br/><p style="margin:0;">The ForTwoPlease Team</p><br/><p style="margin:0;">p.s. Have any questions or need some help? Email us at <b>support@fortwoplease.com</b> and we\'ll get back to you as soon as we can!</p><br/><p style="margin:0;"><a href="http://www.fortwoplease.com/vancouver/myaccount">Take me to my account page</a></p><p style="margin:0;"><a href="http://www.fortwoplease.com/">Discover more date ideas!</a></p>';
            $to = array(array('email'=>$email, 'type'=>'to'));
            $message = array('html'=> $html, 'subject' => 'Purchase Successful!', 'from_email'=>'info@fortwoplease.com', 'from_name'=> 'ForTwoPlease', 'to'=> $to);
            $data = json_encode(array('key'=>'OybeEIWO9N2oDsURJI3qmg', 'message' => $message));
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_URL, 'https://mandrillapp.com/api/1.0/messages/send.json');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($curl);
            // Add transaction meta data to usermeta table.
            date_default_timezone_set('Canada/Pacific');
            $timestamp =  date("Y-m-d H:i:s");
            $merchantname = intval($merchantuname);
            for ($i = $numberp; $i > 0; $i--) {
                    $unique = $voucherIDs[$numberp-$i];
                    add_user_meta($uid->ID,'purchased',$unique); 
                    add_user_meta($uid->ID,$unique.'_item',$datename);
                    add_user_meta($uid->ID,$unique.'_id',$theID); 
                    add_user_meta($uid->ID,$unique.'_np',$numberp);
                    add_user_meta($uid->ID,$unique.'_time',$timestamp);
                    add_user_meta($uid->ID,$unique.'_stat','notdone');
                    add_user_meta($uid->ID,$unique.'_for_fname', $redemptionFirstName);
                    add_user_meta($uid->ID,$unique.'_for_lname', $redemptionLastName);
                    add_user_meta($uid->ID, $unique.'_transID', $transID);
                    add_user_meta($uid->ID, $unique.'_amount', $price_per_package);
                    add_user_meta($merchantuname,$theID,$unique);
                    add_user_meta($merchantuname,$unique,$uid->ID); 
                    add_user_meta($merchantuname,$unique.'_d','notdone'); 
                    $summary = $timestamp. ' '. $total . ' ' . $datename . ' ' .$uid->user_login . ' ' . $uid->user_email . ' '  . $uid->user_firstname . ' ' . $uid->user_lastname ;
                    add_user_meta(1,'sold',$summary);
            }
            
            // Display confirmation to user.
            $message = "<div style='min-height:300px;background:#231f20;color:#FFF;padding-left:15px;'><div style='color:white;width:320px;height:40px;'><h1 style='float:left;margin-left:0px;'>SUCCESS!</h1><img style='float:right;margin-top:5px;margin-right:20px;' src='/dev/wp-content/themes/images/step3.png' /></div><div style='float:left;clear:both;'><p><b>Your card has been charged $".$total.".</b></p><br/><p>Make your reservation now by calling <b>".$bname."</b> at <b>".$phone."</b>.</p><br/><p>Just remember to take your ForTwoPlease Voucher, which is located on <a href='/dev/myaccount'>your account page</a>.</p><br/><p>We've also sent you an email for reference, with your confirmation code, <b>".$transID."</b>.</p><br/><p>Have a great date!</p><br/><a href='/dev/myaccount'>Your Account</a><br/><a href='/vancouver/date-idea-type/packages'>< Browse More Date Packages!</a></div></div>";
            $tax = $taxes * $numberp;
            $ga_data = array('transID' => $transID, 'merchantName' => $bname, 'total' => $total, 'tax' => $tax, 'price_per_item' => $price_per_package, 'category' => '', 'productName' => $pname, 'quantity' => $numberp);
            $array = array('result' => 0, 'email' => "anuj.nm@gmail.com", 'price' => $total, 'message' => $message, 'ga_data' => $ga_data);
            echo json_encode($array);
        }
        catch (Stripe_Error $e) {
            $message = $e->getMessage();
            $array = array('result' => 1, 'message' => $message);
            echo json_encode($array);
        }
    }
    catch (Exception $e) 
    {
        $message = $e->getMessage();
        $array = array('result' => 1, 'message' => $message);
        echo json_encode($array);
    }

	die();	
}
add_action('wp_ajax_nopriv_pp_action', 'pp_action');
add_action('wp_ajax_pp_action', 'pp_action');//for users that are not logged in.

function implement_ajax() {		
			//set POST variables
	$postid = $_POST['postid'];
	$numberp = $_POST['numberp'];
	$url = $_POST['url'];
	unset($_POST['url']);
 
	$fields_string = "";
	//url-ify the data for the POST
	foreach($_POST as $key=>$value) {
    $fields_string .= $key.'='.$value.'&';
	}
	$fields_string = rtrim($fields_string,'&');
 
	//open connection
	$ch = curl_init();
 	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,count($_POST));
	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
 
	//execute post
	$result = curl_exec($ch);
	//close connection
	parse_str($result,$parsedresults);
	if($parsedresults['trnApproved'] == 0)
	{		
		echo $result;
	}
	if($parsedresults['trnApproved'] == 1)
	{
	echo $result;
		
	$uid = wp_get_current_user();
	$merchantuname = get_field('merchant_username',$postid);
	$datename = get_field('sub_title',$postid);
	$timestamp =  date("Y-m-d H:i:s");
	$price = get_field('price');
	$merchantname = intval($merchantuname);
	for ($i = $numberp; $i > 0; $i--) {
	$unique = uniqid();
	add_user_meta($uid->ID,'purchased',$unique); 
	add_user_meta($uid->ID,$unique.'_item',$datename);
	add_user_meta($uid->ID,$unique.'_id',$postid); 
	add_user_meta($uid->ID,$unique.'_np',$numberp);
	add_user_meta($uid->ID,$unique.'_time',$timestamp);
	add_user_meta($uid->ID,$unique.'_stat','notdone');
	add_user_meta($merchantuname,$postid,$unique);
	add_user_meta($merchantuname,$unique,$uid->ID); 
	add_user_meta($merchantuname,$unique.'_d','notdone'); 
	$summary = $timestamp. ' '. $price . ' ' . $datename . ' ' .$uid->user_login . ' ' . $uid->user_email . ' '  . $uid->user_firstname . ' ' . $uid->user_lastname ;
	add_user_meta(1,'sold',$summary);
	}
		
	}
	
	
	curl_close($ch);
	
	
	exit;
}// end if

add_action('wp_ajax_nopriv_my_special_action', 'implement_ajax');
add_action('wp_ajax_my_special_action', 'implement_ajax');//for users that are not logged in.

function current_page_url() {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function logged_in() {		
	$result = is_user_logged_in();
	return $result;

}// end if
add_action('wp_ajax_nopriv_loggedin', 'logged_in');
add_action('wp_ajax_loggedin', 'logged_in');//for users that are not logged in.


function pass_change() {
	include '../wp-includes/class-phpass.php';	
		$oldpass = $_POST['opass'];
		$newpass = $_POST['npass'];
		$newpassconfirm = $_POST['npassc'];
		global $current_user;
		get_currentuserinfo();
		
		$pass1 = $current_user->user_pass;
	
	$wp_hasher = new PasswordHash(8, TRUE);
	$check = $wp_hasher->CheckPassword($oldpass, $pass1);
	
		if($check)
		{
			if($newpass == $newpassconfirm)
			{
			wp_update_user( array ('ID' => $current_user->ID, 'user_pass' => $newpass) ) ;
			echo "Password change complete";
			}
			else
			{
			echo "The new password fields do not match";
			}
		}
		else{
			echo "Failed, please make sure you have entered the correct password";
		}
			
	}
add_action('wp_ajax_nopriv_passchange', 'pass_change');
add_action('wp_ajax_passchange', 'pass_change');//for users that are not logged in.

function log_me_in(){
	//We shall SQL escape all inputs
	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember = $_POST['rememberme'];
	
	if($remember) $remember = "true";
	else $remember = "false";
	$login_data = array();
	$login_data['user_login'] = $username;
	$login_data['user_password'] = $password;
	$login_data['remember'] = $remember;
	$user_verify = wp_signon( $login_data, true ); 
	
	if ( is_wp_error($user_verify) ) {
		echo 'Invalid username or password. Please try again!';
		exit();
	} else {
		echo 'Success';
		exit();
	}
}
	
add_action('wp_ajax_nopriv_logmein', 'log_me_in');
add_action('wp_ajax_logmein', 'log_me_in');//for users that are not logged in.

function send_confirmation_email(){
	$theID = $_POST['theID'];
	$totalPrice = $_POST['totalPrice'];
	$transID = $_POST['transID'];
	$phone = get_field('phone_number',$theID);
	$bname = get_field('business_name',$theID);
	$pname = get_field('package_name',$theID);
	$uid = wp_get_current_user();
	$userID = $uid->ID;
	$name = $uid->user_login;
	$user_email = $uid->user_email;
	
	$headers = 'From: ForTwoPlease <info@fortwoplease.com>' . "\r\n";
	add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
	wp_mail($user_email, 'Your Next Great Date!', '<strong>Congratulations '.$name.'</strong><p>Your purchase of ['.$bname.'-'.$pname.'] was successful.</p><p><b>TO USE: Phone '.$phone.' to reserve a time for your date.</b> Just say your name and ForTwoPlease ID, which is <b>'.$userID.'</b>, and the business will take care of the rest. (You can call to reserve anytime, however you have to reserve before you can use your date.)</p><p>When you show up, say your name and ForTwoPlease ID -  it’s that easy!</p><p>The details of your Date Package are also in your account, which you can access at anytime: <a href="http://fortwoplease.com/myaccount/">Your Account</a>. But please don’t print anything. Dating is a classy affair!</p><BR /><strong>Date Package Payment Summary</strong><p>Total: $'.$totalPrice.'</p><p>Transaction ID:'.$transID.'</p><BR /><p>And, if you want to really WOW your date, we can help you with flowers, babysitters or even hair dos with our <a href="http://fortwoplease.com/date-enhancer/">Date Enhancers.</a></p><p>Enjoy!</p><p>-The ForTwoPlease Team</p><p>p.s. As always, if you have any questions shoot us an email and we’ll get back to you within one business day - support@ForTwoPlease.com</p>',$headers);
	
	
	
}
add_action('wp_ajax_nopriv_sendconfmail', 'send_confirmation_email');
add_action('wp_ajax_sendconfmail', 'send_confirmation_email');//for users that are not logged in.






function login_with_email_address($username) {
	$user = get_user_by_email($username);
	if(!empty($user->user_login))
		$username = $user->user_login;
	return $username;
}
add_action('wp_authenticate','login_with_email_address');

/* Don't need Google Analytics on Dev
function add_googleanalytics() {
	echo "<script type='text/javascript'>";
	echo "var _gaq = _gaq || [];";
	echo "_gaq.push(['_setAccount', 'UA-22573395-1']);";
	echo "_gaq.push(['_setDomainName', 'fortwoplease.com']);";
	echo "_gaq.push(['_trackPageview']);";
	
	echo "(function() {";
	echo "var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;";
	echo "ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';";
	echo "var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);";
	echo "})();";
	echo "</script>";
}
add_action('wp_footer', 'add_googleanalytics');
*/


function email_subscription() {
	//We shall SQL escape all inputs
	$user_email = $_POST['email'];
	$user_pass = $_POST['password'];
	
	$already_exists = email_exists($user_email);
	
	//If not exist, then we add a new user first
	if (!$already_exists) {
	
		//$userdata = compact('user_email', 'user_pass') ;
		$status = wp_insert_user(array ('user_login' => $user_email, 'user_email' => $user_email, 'user_pass' => $user_pass));	
	}
	
	if ($already_exists) {
		echo 'Email already exists. Please try another one';
	} else {
		if (is_wp_error($status)) {
			echo 'This username is already registered.';
		} else {
			//Add User email to mailChimp
			$login_data = array();
			$login_data['user_login'] = $user_email;
			$login_data['user_password'] = $user_pass;
			$login_data['remember'] = "true";
			$user_verify = wp_signon( $login_data, true );  
			if ( !is_wp_error($user_verify) ) {
			/*
				$headers = 'From: ForTwoPlease <info@fortwoplease.com>' . "\r\n";
				add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
				wp_mail($user_email, 'Your Dates Just Got Better ', '<strong>You are in!</strong><p>We’re excited that you’ve joined our ForTwoPlease community. Now that you’re a member, we can start recommending better dates that we think you’ll enjoy.</p><p><b>It’s easy to get started.</b> Find local date ideas based on what you want to do and we’ll help you with the rest – like cabs, babysitters and even private airplanes!</p><a href="http://fortwoplease.com">Your next great date awaits</a><p>If you have any questions, we’d love to hear from you. Shoot us a line on <a href="http://www.facebook.com/fortwoplease/">Facebook</a>
				or email us at support@ForTwoPlease.</p><p>Best of Luck!</p><p>The ForTwoPlease Team</p>',$headers);
			*/
			
				//Call the method that adds the email to the MailChimp subscriber list
				add_email_to_mail_chimp($user_email, null, null);
			
				echo 'Success';
			} else {
				echo 'Invalid Email. Please try again.';
			}
		}
	}
	
	exit();
}
	
add_action('wp_ajax_nopriv_email_subscribe', 'email_subscription');
add_action('wp_ajax_email_subscribe', 'email_subscription');//for users that are not logged in.


function add_email_to_mail_chimp ($email, $fname, $lname) {
	//MailChimp API Files
	require_once 'inc/MCAPI.class.php';
	require_once 'inc/config.inc.php'; //contains apikey

	$api = new MCAPI($apikey);
	if ($fname == null)
		$merge_vars = array('FNAME'=>'', 'LNAME'=>'', 'INTERESTS'=>'');
	else
		$merge_vars = array('FNAME'=>$fname, 'LNAME'=>$lname, 'INTERESTS'=>'');
	// By default this sends a confirmation email - you will not see new members
	// until the link contained in it is clicked!
	$retval = $api->listSubscribe( $listId, $email, $merge_vars, 'html', false );
	
	if ($api->errorCode) {
		error_log("Unable to load listSubscribe()!", 0);
		error_log("\tCode=".$api->errorCode."\n", 0);
		error_log("\tMsg=".$api->errorMessage."\n", 0);
	} else {
		error_log("Returned: ". $retval ."\n", 0);
		$retval = $api->listMembers($listId, 'subscribed', null, 0, 5000 );
		if ($api->errorCode) {
			error_log("Unable to load listMembers()!", 0);
			error_log("\n\tCode=".$api->errorCode, 0);
			error_log("\n\tMsg=".$api->errorMessage."\n", 0);
		} else {
			error_log("Members matched: ". $retval['total']. "\n", 0);
			error_log("Members returned: ". sizeof($retval['data']). "\n", 0);
			foreach($retval['data'] as $member) {
				error_log($member['email']." - ".$member['timestamp']."\n", 0);
			}
		}
	}
}


function check_user_has_ftp_account () {
	$user_email = $_POST['user_login'];
	error_log($_POST['user_login']);
	$user = get_user_by_email($user_email);
	
	//require_once('/fortwoplease/wp-includes/class-phpass.php');
	require_once ( ABSPATH . 'wp-includes/class-phpass.php');
	$wp_hasher = new PasswordHash(8, TRUE);

	$password_hashed = $user -> user_pass;
	$plain_password = '123456';

	if($wp_hasher->CheckPassword($plain_password, $password_hashed)) {
		error_log("YES, Matched");
		echo "Success";
	} else {
		error_log("No, Wrong Password");
	    echo "No, Wrong Password";
	}
}
add_action('wp_ajax_nopriv_userhasftpaccount', 'check_user_has_ftp_account');
add_action('wp_ajax_userhasftpaccount', 'check_user_has_ftp_account');//for users that are not logged in.


//Check if 
function fb_check_user_existence_and_login() {
	//We shall SQL escape all inputs
	$user_login = $_POST['username'];
	$user_pass = $_POST['password'];
	$user_pass2 = $_POST['password2'];
	$first_name = $_POST['fname'];
	$last_name = $_POST['lname'];
	$user_email = $_POST['email'];
	
	$already_exists = true;
	
	//If not exist, then we add a new user first
	if (!email_exists($user_email)) {
		$already_exists = false;
		$userdata = compact('user_login', 'user_email', 'user_pass', 'first_name', 'last_name') ;
		$status = wp_insert_user($userdata);	
	}
	
	$user = get_user_by_email($user_email);
	$username = $user -> user_login;
	$login_data = array();
	$login_data['user_login'] = $username;
	
	if (!$already_exists) {
		$login_data['user_password'] = $user_pass;
		$login_data['remember'] = "true";
		$user_verify = wp_signon( $login_data, true );
	} else {
		wp_set_current_user($user -> id, $user -> username);
		wp_set_auth_cookie($user -> id, true);
	}

	//if (is_wp_error($user_verify)) {
	//	echo 'Invalid username or password. Please try again!';
	//} else {
		if (!$already_exists) {
			add_email_to_mail_chimp($user_email, $first_name, $last_name);
			// $headers = 'From: ForTwoPlease <info@fortwoplease.com>' . "\r\n";
			// add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
			// wp_mail($user_email, 'Your Dates Just Got Better ', '<strong>You are in!</strong><p>We’re excited that you’ve joined our ForTwoPlease community. Now that you’re a member, we can start recommending better dates that we think you’ll enjoy.</p><p><b>It’s easy to get started.</b> Find local date ideas based on what you want to do and we’ll help you with the rest – like cabs, babysitters and even private airplanes!</p><a href="http://fortwoplease.com">Your next great date awaits</a><p>If you have any questions, we’d love to hear from you. Shoot us a line on <a href="http://www.facebook.com/fortwoplease/">Facebook</a>
			// or email us at support@ForTwoPlease.</p><p>Best of Luck!</p><p>The ForTwoPlease Team</p>',$headers);	
		}
		echo 'Success';
	//}
	
	exit();
}
add_action('wp_ajax_nopriv_fbcheckuserexists', 'fb_check_user_existence_and_login');
add_action('wp_ajax_fbcheckuserexists', 'fb_check_user_existence_and_login');//for users that are not logged in.


function set_ftp_pass() {
	$newpass = $_POST['npass'];
	$newpassconfirm = $_POST['npassc'];
	global $current_user;
	get_currentuserinfo();

	if($newpass == $newpassconfirm) {
		wp_update_user( array ('ID' => $current_user->ID, 'user_pass' => $newpass) ) ;
		echo "Password change complete";
	} else {
		echo "The new password fields do not match";
	}

}
add_action('wp_ajax_nopriv_setftppass', 'set_ftp_pass');
add_action('wp_ajax_setftppass', 'set_ftp_pass');//for users that are not logged in.







function new_user_reg(){
	//We shall SQL escape all inputs
	$user_login = $_POST['username'];
	$user_pass = $_POST['password'];
	$user_pass2 = $_POST['password2'];
	$firstname = $_POST['fname'];
	$last_name = $_POST['lname'];
	$user_email = $_POST['email'];
	
	
	 $userdata = compact('user_login', 'user_email', 'user_pass', 'first_name', 'last_name') ;
	 
	 $status = wp_insert_user($userdata);
	
	if ( is_wp_error($status) )
		{
	echo 'Username already exists. Please try another one';
	exit();
		}
	if($user_pass != $user_pass2)
	{
		echo "Password don't match";
		exit();
		}
	else
		{
	$login_data = array();
	$login_data['user_login'] = $user_login;
	$login_data['user_password'] = $user_pass;
	$login_data['remember'] = "true";
	$user_verify = wp_signon( $login_data, true );  
	if ( !is_wp_error($user_verify) )
		{
	// $headers = 'From: ForTwoPlease <info@fortwoplease.com>' . "\r\n";
	// add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
	// wp_mail($user_email, 'Your Dates Just Got Better ', '<strong>You are in!</strong><p>We’re excited that you’ve joined our ForTwoPlease community. Now that you’re a member, we can start recommending better dates that we think you’ll enjoy.</p><p><b>It’s easy to get started.</b> Find local date ideas based on what you want to do and we’ll help you with the rest – like cabs, babysitters and even private airplanes!</p><a href="http://fortwoplease.com">Your next great date awaits</a><p>If you have any questions, we’d love to hear from you. Shoot us a line on <a href="http://www.facebook.com/fortwoplease/">Facebook</a>
	// or email us at support@ForTwoPlease.</p><p>Best of Luck!</p><p>The ForTwoPlease Team</p>',$headers);
		add_email_to_mail_chimp($user_email, null, null);

		echo 'Success';
		} 
	exit();
		}
	}
	
add_action('wp_ajax_nopriv_newuserreg', 'new_user_reg');
add_action('wp_ajax_newuserreg', 'new_user_reg');//for users that are not logged in.

function done_date(){
	date_default_timezone_set('Canada/Pacific');
	$uval = $_POST['uniqueval'];
	$checked = $_POST['checked'];
	$uid = wp_get_current_user();
	$package_uid = substr($uval, 0,strrpos($uval, "_"));
	error_log("package_uid: $package_uid");
	$timestamp = date(DATE_RFC822);
	error_log($timestamp);
	if($checked=='notchecked') {
		update_user_meta($uid->ID,$uval,'notdone');
		update_user_meta($uid->ID, $package_uid.'_redeemded_date', '' );
	} elseif($checked == 'checked') {
		update_user_meta($uid->ID,$uval,'done');
		update_user_meta($uid->ID, $package_uid.'_redeemded_date', $timestamp );
	}
}

add_action('wp_ajax_nopriv_donedate', 'done_date');
add_action('wp_ajax_donedate', 'done_date');//for users that are not logged in.

function share_date(){

$toemail = $_POST['recipient-email'];
$toname = $_POST['recipient-name'];
$fromname = $_POST['sender-name'];
$message = $_POST['message'];
$postid = $_POST['pid'];
$postobject = wp_get_single_post($postid);
$permalink = get_permalink($id);

$headers = 'From: ForTwoPlease <info@fortwoplease.com>' . "\r\n";
	
	
add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
wp_mail($toemail, 'You’ve Been Asked Out By '.$fromname, '<p>Lucky You</p><p>You\'\ve been asked out by '.$fromname.' to go on this date:</p><b><a href="$permalink">'.$postobject->post_title .'</a></b><p>Let '.$fromname. ' know what you think.</p><p>Have Fun<br/>-The ForTwoPlease Team</p>',$headers);
}

add_action('wp_ajax_nopriv_sharedate', 'share_date');
add_action('wp_ajax_sharedate', 'share_date');//for users that are not logged in.


function search_dates(){
	
	$datetype = $_POST['datetype'];
	$location = $_POST['location'];
	$price = $_POST['price'];
	$time = $_POST['time'];
	$day = 1;
	
	if($time == 'alltime')
	{
		$time = array('morning','day','night');
	}
	if($price == 'allprice')
	{
		$price = array('0-25','100-150','150','25-50','25-50','50-100','free-3');
	}
	if($location == 'alllocations')
	{
		$location = array('bc','everything-else');
	}
	if($datetype == 'alltypes')
	{
		$datetype = array('restaurants','entertainment','active','adventurous','getaways','anniversary','packages');
	}
	
$myquery['tax_query'] = array(
    array(
        'taxonomy' => 'date-type',
        'terms' => $datetype,
        'field' => 'slug',
    ),
    array(
        'taxonomy' => 'location',
        'terms' => $location,
        'field' => 'slug',
    ),
	array(
        'taxonomy' => 'price',
        'terms' => $price,
        'field' => 'slug',
    ),
	array(
        'taxonomy' => 'time',
        'terms' => $time,
        'field' => 'slug'
    )
	
);


$myquery['orderby'] = 'rand';
$myquery['post_type'] = 'dates';
$myquery['posts_per_page'] = '300';
$myquery['post_status'] = 'publish';


/*if($day == 0){$day = 'Sunday';}
else if($day == 1){$day = 'Monday';}
else if($day == 2){$day = 'Tuesday';}
else if($day == 3){$day = 'Wednesday';}
else if($day == 4){$day = 'Thursday';}
else if($day == 5){$day = 'Friday';}
else if($day == 6){$day = 'Saturday';}*/

query_posts($myquery);
$result_array = array ();
$index = 2;
$index_s = 1;
while ( have_posts() ) : the_post();
//	if(get_the_ID()){
	//foreach (get_field('days_availible') as $values){
	//if($values=='All Days'){
	$id = get_the_ID();
	$datetypes = get_the_term_list( $id, 'date-type', '', ', ', '' );
	if(stristr(strip_tags($datetypes),'Packages') !== FALSE && $index_s<2)
	{
	$result_array[$index_s] = $id;
	$index_s++;
	}
	else{
	$result_array[$index] = $id;
//	echo $result[$index].'';
	$index++;}
//	break;
		
	//}
	//else if($values == $day)
	//{
//	$result_array[$index] = get_the_ID();
//	echo $result[$index].'';
	//$index++;
	//break;
	//}
	//}
//}
	
endwhile;
$result_array["length"] = $index;
wp_reset_query();
echo json_encode($result_array); 
exit();


}
add_action('wp_ajax_nopriv_searchdates', 'search_dates');
add_action('wp_ajax_searchdates', 'search_dates');//for users that are not logged in.

function showBrief($str, $length) {
  $str = strip_tags($str);
  $str = explode(" ", $str);
  return implode(" " , array_slice($str, 0, $length));
}

function array2json($arr) { 
    if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
    $parts = array(); 
    $is_list = false; 

    //Find out if the given array is a numerical array 
    $keys = array_keys($arr); 
    $max_length = count($arr)-1; 
    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
        $is_list = true; 
        for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position 
            if($i != $keys[$i]) { //A key fails at position check. 
                $is_list = false; //It is an associative array. 
                break; 
            } 
        } 
    } 

    foreach($arr as $key=>$value) { 
        if(is_array($value)) { //Custom handling for arrays 
            if($is_list) $parts[] = array2json($value); /* :RECURSION: */ 
            else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */ 
        } else { 
            $str = ''; 
            if(!$is_list) $str = '"' . $key . '":'; 

            //Custom handling for multiple data types 
            if(is_numeric($value)) $str .= $value; //Numbers 
            elseif($value === false) $str .= 'false'; //The booleans 
            elseif($value === true) $str .= 'true'; 
            else $str .= '"' . addslashes($value) . '"'; //All other things 
            // :TODO: Is there any more datatype we should be in the lookout for? (Object?) 

            $parts[] = $str; 
        } 
    } 
    $json = implode(',',$parts); 
     
    if($is_list) return '[' . $json . ']';//Return numerical JSON 
    return '{' . $json . '}';//Return associative JSON 
} 
?>