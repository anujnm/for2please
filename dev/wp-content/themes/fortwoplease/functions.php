<?php
show_admin_bar( false );

function limit_terms($val) {
    return array_splice($val, 0, 3);
}

add_filter( "term_links-location", 'limit_terms');

/*
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
*/
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
	if($id[3] != "empt"){
		$cflag = 3;
	}

	for($iz=1;$iz<=$cflag;$iz++) {
		$itemPermalink = get_permalink($id[$iz]);
		$datetypes = get_the_term_list( $id[$iz], 'date-type', '', ', ', '' );
		echo "<div id='";
		echo $id[$iz];
		echo "' class='testsearch' style='background:url(";
		echo get_field('thumbnail',$id[$iz]);
		echo");height:235px;width:330px;margin-bottom:30px;float:left;margin-right:10px;box-shadow:2px 2px 5px #888;position:relative;'>";
		if(stristr(strip_tags($datetypes),'Packages') !== FALSE) {
			echo '<div style="position:relative;left:-125px;top:5px;z-index:2;position:absolute;top:0;left:0;"><img src="/wp-content/themes/images/get-it-here.png"></div>';
		}
		echo "<div style='height:200px;width:330px;'>";
		echo "<div id='searchtest' class='testsearch2'>";
		echo "<div class='result-type' style='width:240px;text-align:right;'>";
		if (!empty($datetypes)) {
			echo '<p style="color:#F07323">', strip_tags($datetypes) ,'</p>';
		}
		echo "</div><div style='position: relative;  text-align: left; left: 20px; overflow: hidden; width: 305px; height: 140px;clear:both;'><a style='color:#FFF;font-size:18px;font-weight:700;text-decoration:none;' href='";
	    echo $itemPermalink;
		echo "'>";
		echo get_the_title($id[$iz]);
		echo "</a><br/>";
		$terms_as_text = get_the_term_list( $id[$iz], 'location', '', ', ', '' );
		if (!empty($terms_as_text)) {
			echo '<p style="color:#FFF;">', strip_tags($terms_as_text) ,'</p>';
		}
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


function load_date_for_idea_page(){
	if($_POST['dateID1']!='rand')
	{
		$id[1] = $_POST['dateID1'];
		$id[2] = $_POST['dateID2'];
	}
	else{
		$id[1]= get_random_date();
		$id[2] = get_random_date();
	}
	$cflag = 1;
	if($id[2] != "empt"){
		$cflag = 2;
	}

	for($iz=1;$iz<=$cflag;$iz++) {
		$itemPermalink = get_permalink($id[$iz]);
		$datetypes = get_the_term_list( $id[$iz], 'date-type', '', ', ', '' );
		echo '<div style="height: 2px;"></div>';
		if ($iz == 1) {
			echo '<div class="content"><div class="yourself">';
		} else {
			echo '<div class="option">';
		}
		echo "<div id='";
		echo $id[$iz];
		echo "' class='testsearch-content date-container' style='background:url(";
		echo get_field('thumbnail',$id[$iz]);
		echo");height:235px;width:320px; float:left;margin: 0 8px 30px 0;box-shadow:2px 2px 5px #888;position:relative;'>";
		echo '<div style="position:relative;left:-125px;top:5px;z-index:2;position:absolute;top:0;left:0;"><img src="/wp-content/themes/images/get-it-here.png"></div>';
		echo "<div style='height:200px;width:320px;'>";
		echo "<div id='searchtest' class='testsearch2-content' style='display: none;''>";
		echo "<div class='result-type' style='width:240px;text-align:right;'>";
		if (!empty($datetypes)) {
			echo '<p style="color:#F07323"><a style="text-decoration:none;" href="', $itemPermalink, '" class="similar-package-tags">', strip_tags($datetypes), '</a></p>';
		}
		echo "</div><div style='position: relative;  text-align: left; left: 20px; overflow: hidden; width: 305px; height: 140px;clear:both;'><a style='color:#FFF;font-size:18px;font-weight:700;text-decoration:none;' href='";
	    echo $itemPermalink;
		echo "'>";
		echo get_the_title($id[$iz]);
		echo "</a><br/>";
		$terms_as_text = get_the_term_list( $id[$iz], 'location', '', ', ', '' );
		if (!empty($terms_as_text)) {
			echo '<p style="color:#FFF;"><a style="color:#FFF;text-decoration:none;" href="', $itemPermalink, '" class="similar-package-link">', strip_tags($terms_as_text) ,'</a></p>';
		}
		echo "<br/><p style='color:white;width:300px;'><a style='color:#FFF;text-decoration:none;' href='", $itemPermalink, "' class='similar-package-link'>";
		echo showBrief(get_field('short_description', $id[$iz]), 20);
		echo "...</a></p><a style='float:right;margin-right:10px;text-decoration:none;' href='";
		echo $itemPermalink;
		echo "'>Read More...</a></div></div></div>";
		echo "<div class='overlay-content'><h3><a class='similar-package-link' href='";
		echo $itemPermalink;
		echo "'>";
		echo the_field('sub_title',$id[$iz]);
		echo "</a></h3></div></div></div>";
		if ($iz == 1) {
			echo '</div>';
		}
	}
	exit();
}
add_action('wp_ajax_nopriv_loaddateforideapage', 'load_date_for_idea_page');
add_action('wp_ajax_loaddateforideapage', 'load_date_for_idea_page');//for users that are not logged in.


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
	echo '<div style="z-index:2;position:absolute;"><img src="/wp-content/themes/images/get-it-here.png"></div>';
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

		if($check) {
			if($newpass == $newpassconfirm) {
			wp_update_user( array ('ID' => $current_user->ID, 'user_pass' => $newpass) ) ;
			echo "Password change complete";
			} else {
			echo "The new password fields do not match";
			}
		} else {
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

	if (!username_exists($username)) {
		echo 'There is no account for this email. Please try a different email address or create a new account.';
		exit();
	}

	if ($remember) {
		$remember = "true";
	} else {
		$remember = "false";
	}

	$login_data = array();
	$login_data['user_login'] = $username;
	$login_data['user_password'] = $password;
	$login_data['remember'] = $remember;
	$user_verify = wp_signon( $login_data, true );

	if (is_wp_error($user_verify)) {
		echo 'Invalid username or password. Please try again!';
		exit();
	} else {
		echo 'Success';
		exit();
	}
}

add_action('wp_ajax_nopriv_logmein', 'log_me_in');
add_action('wp_ajax_logmein', 'log_me_in');//for users that are not logged in.


function login_with_email_address($username) {
	$user = get_user_by_email($username);
	if(!empty($user->user_login))
		$username = $user->user_login;
	return $username;
}
add_action('wp_authenticate','login_with_email_address');


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

				//Call the method that adds the email to the MailChimp subscriber list
				add_email_to_mail_chimp($user_email, null, null);
				send_welcome_email($user_email);
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


function location_subscribe() {
	$user_email = $_POST['email'];
	$location = $_POST['location'];
	$data = $location . ','. $user_email . "\n";
	file_put_contents('/home/fortwo9/public_html/dev/subscriptions/location_subscribers.txt', $data, FILE_APPEND);
	echo 'Success';
	exit();
}

add_action('wp_ajax_nopriv_location_subscribe', 'location_subscribe');
add_action('wp_ajax_location_subscribe', 'location_subscribe');


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


function send_welcome_email($user_email, $first_name) {
	$to = array(array('email'=>$user_email, 'type'=>'to'));
    $message = array('from_email'=>'jesse@<?php echo DOMAIN_NAME;?>', 'from_name'=> 'Jesse from ForTwoPlease', 'to'=> $to);
    if ($first_name	) {
    	$greeting = "Hey " . $first_name . ",";
    } else {
    	$greeting  = "Hey, ";
    }
    $template_content = array(array('name'=>'greeting', 'content'=>$greeting));
    $data = json_encode(array('key'=>'OybeEIWO9N2oDsURJI3qmg', 'template_name'=>'Welcome', 'message' => $message, 'template_content'=>$template_content));
    $curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_URL, 'https://mandrillapp.com/api/1.0/messages/send-template.json');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($curl);
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

	if (!$already_exists) {
		add_email_to_mail_chimp($user_email, $first_name, $last_name);
		send_welcome_email($user_email, $first_name);
	}
	echo 'Success';

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
	$user_pass = $_POST['password'];
	$user_pass2 = $_POST['password2'];
	$firstname = $_POST['fname'];
	$last_name = $_POST['lname'];
	$user_login = $_POST['email'];

	if ($user_pass != $user_pass2) {
		echo "Please ensure that the passwords match.";
		exit();
	}

	$userdata = compact('user_login', 'user_pass', 'first_name', 'last_name') ;

	$status = wp_insert_user(array ('user_login' => $user_login, 'user_email' => $user_login, 'user_pass' => $user_pass, 'first_name' => $firstname, 'last_name' => $lastname));

	if (is_wp_error($status)) {
		echo 'Username already exists. Please try another one. ';
		exit();
	} else {
		$login_data = array();
		$login_data['user_login'] = $user_login;
		$login_data['user_password'] = $user_pass;
		$login_data['remember'] = "true";
		$user_verify = wp_signon( $login_data, true );
		if (!is_wp_error($user_verify)) {
			add_email_to_mail_chimp($user_login, null, null);
			send_welcome_email($user_login, $firstname);
			echo 'Success';
		}
		exit();
	}
}
add_action('wp_ajax_nopriv_newuserreg', 'new_user_reg');
add_action('wp_ajax_newuserreg', 'new_user_reg');//for users that are not logged in.


function share_date(){

	$toemail = $_POST['recipient-email'];
	$toname = $_POST['recipient-name'];
	$fromname = $_POST['sender-name'];
	$message = $_POST['message'];
	$postid = $_POST['pid'];
	$postobject = wp_get_single_post($postid);
	$permalink = get_permalink($postid);

	$headers = 'From: ForTwoPlease <info@<?php echo DOMAIN_NAME;?>>' . "\r\n";
	$contents = '<p>Lucky You!</p><p>'.$fromname.' thought you would like this great date idea:</p><b><a href="'.$permalink.'">'.$postobject->post_title .'</a></b><p>Check it out and let '.$fromname.' know what you think.</p><p>Have Fun<br/>-The ForTwoPlease Team</p>';

	if (strlen($message) > 0) {
		$contents = 'Message from '.$fromname.':<p><i> '.$message.'</i></p><p>You can check out the date here: <b><a href="'.$permalink.'">'.$postobject->post_title .'</a></b><p>Have Fun<br/>-The ForTwoPlease Team</p>';
	}

	add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
	wp_mail($toemail, $fromname. ' has sent you this date idea', $contents, $headers);
}

add_action('wp_ajax_nopriv_sharedate', 'share_date');
add_action('wp_ajax_sharedate', 'share_date');//for users that are not logged in.


function search_dates() {

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

function create_date_idea() {
  $city_name = $_POST['city'];
  $city_id = $_POST['city_id'];
  $business_name = $_POST['business_name'];
  $user_name = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $business_phone = $_POST['business_phone'];
  $website = $_POST['website'];
  $street_address1 = $_POST['street_address1'];
  $address_city = $_POST['address_city'];
  $province = $_POST['province'];
  $country = $_POST['country'];
  $postal_code = $_POST['postal_code'];

  $date_title = $_POST['date_title'];
  $short_desc = $_POST['short_desc'];
  $full_desc = $_POST['full_desc'];
  $date_idea_types = $_POST['date_idea_type'];
  $date_times = $_POST['date_time'];
  $testimonial1 = $_POST['testimonial1'];
  $testimonial2 = $_POST['testimonial2'];
  $testimonial3 = $_POST['testimonial3'];

  require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

  $post = array(
    'post_content' => '',
    'post_name' => $date_title,
    'post_title' => $business_name,
    'post_status' => 'draft',
    'post_type' => 'dates',
    'post_author' => 727,
  );

  $testimonials = $testimonial1 . '<p>' . $testimonial2 . '<p>' . $testimonial3;

  $result1 = wp_insert_post($post, true);
  add_post_meta($result1, 'sub_title', $date_title, true);
  add_post_meta($result1, 'why_is_this_a_great_date', $full_desc, true);
  add_post_meta($result1, 'this_package_does_not_expire', '1', true);
  add_post_meta($result1, 'days_availible', 'All Days', true);
  add_post_meta($result1, 'short_description', $short_desc, true);
  add_post_meta($result1, 'word_on_the_street', $testimonials, true);
  add_post_meta($result1, 'mailing_address', $street_address1, true);
  add_post_meta($result1, 'address_city', $address_city, true);
  add_post_meta($result1, 'postal_code', $postal_code, true);
  add_post_meta($result1, 'phone_number', $business_phone, true);
  add_post_meta($result1, 'web_address', $website, true);
  add_post_meta($result1, 'business_name', $business_name, true);
  add_post_meta($result1, 'city', $city_name, true);

  if (isset($_FILES['attach1'])) {
    $attachment1 = media_handle_upload('attach1', $result1);
    if (!is_wp_error($attachment1)) {
      $result14 = add_post_meta($result1, 'image_1', $attachment1, true);
    } else {
      $result14 = $attachment1->get_error_message();
    }
  }
  if (isset($_FILES['attach2'])) {
    $attachment2 = media_handle_upload('attach2', $result1);
    if (!is_wp_error($attachment2)) {
      $result15 = add_post_meta($result1, 'image_2', $attachment2, true);
    } else {
      $result15 = $attachment2->get_error_message();
    }
  }
  if (isset($_FILES['attach3'])) {
    $attachment3 = media_handle_upload('attach3', $result1);
    if (!is_wp_error($attachment3)) {
      $result16 = add_post_meta($result1, 'image_3', $attachment3, true);
    } else {
      $result16 = $attachment3->get_error_message();
    }
  }
  if (isset($_FILES['attach4'])) {
    $attachment4 = media_handle_upload('attach4', $result1);
    if (!is_wp_error($attachment4)) {
      $result17 = add_post_meta($result1, 'image_4', $attachment4, true);
    } else {
      $result17 = $attachment4->get_error_message();
    }
  }
  if (isset($_FILES['attach5'])) {
    $attachment5 = media_handle_upload('attach5', $result1);
    if (!is_wp_error($attachment5)) {
      $result18 = add_post_meta($result1, 'image_5', $attachment5, true);
    } else {
      $result18 = $attachment5->get_error_message();
    }
  }

  $date_idea_types = array_map('intval', $date_idea_types);
  $date_idea_types = array_unique($date_idea_types);
  wp_set_object_terms($result1, $date_idea_types, 'date-type');
  $date_times = array_map('intval', $date_times);
  $date_times = array_unique($date_times);
  wp_set_object_terms($result1, $date_times, 'time');
  wp_set_object_terms($result1, $city_name, 'city');

  $preview_link = '<?php echo BASE_URL?>/?post_type=dates&p=' . $result1 . '&preview=true';
  $csv_contents = array($result1, $preview_link, $business_name, $user_name, '', $user_email, $business_phone, $website, $street_address1, '', $address_city, $province, $country, $postal_code, '', '', $city_name);
  #$csv_contents = array('Post ID', 'Preview Link', 'Business Name', 'Contact Name', 'Title', 'Email', 'Phone', 'Website', 'Street 1', 'Street 2', 'City', 'Province', 'Country', 'Postal Code', 'Best contact time', 'Neighbourhood');
  $city = get_term_by('id', $city_id, 'city');
  $file = fopen('business_info2.csv', 'a');
  fputcsv($file, $csv_contents, ',');
  fclose($file);
  $redirect_url = BASE_URL . '/upload?uploaded=True&city=' . $city->slug;
  header('Location: '. $redirect_url);
  die();
}
add_action('wp_ajax_nopriv_create_date_idea', 'create_date_idea');
add_action('wp_ajax_create_date_idea', 'create_date_idea');

?>
