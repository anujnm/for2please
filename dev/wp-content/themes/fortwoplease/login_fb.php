<?php
/*
Template Name: login_fb
*/

?>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<style type="text/css">
body { margin: 0; font-family: 'Ubuntu' !important; }
div.center_box { position:relative; width: 514px; height: 385px; background: url('/dev/wp-content/themes/images/sign_in_box.png') no-repeat top left; color: white; text-align: center;}
div.center_box p { margin: 0; font-size: 122%; }
div.center_box div.top { padding: 25px; text-align: center; }
div.center_box div.top h1 { color: #ea5f1a; padding: 15px 0 10px 0; font-size: 266%; }
div.center_box form { margin-top: 5px; }
div.center_box div.inputs { position: relative; top: 26px; margin: 0 auto; width: 514px; }
div.center_box div.inputs p { color: white; }
div.center_box div.fb_connect { margin-top: 40px; }
div.center_box div.bottom { position:absolute; top: 343px; margin: 0 auto; width: 514px; }
div.center_box div.bottom p { color: #2895d8; }
div.center_box div.bottom p label { color: #f35a23; }
</style>

<script type="text/javascript">
	if (typeof(jQuery) === 'undefined') {
		document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'>\<\/script>");
	}
</script>

<script src="<?php bloginfo('stylesheet_directory'); ?>/facebook_login.js" type="text/javascript"></script>

<div class="center_box" id="sign_in_block">
	<div class="top">
		<h1>SIGN IN BELOW!</h1>
	</div>
		
	<div class="inputs">
		<p>Your ForTwoPlease account is connected through Facebook. Please Connect with Facebook.</p>
		<div class="fb_connect"><img id="fb_login_btn2" src="/dev/wp-content/themes/images/fb_connect.png" width="167" height="22" style="cursor:pointer;" onclick="fb_login();"/></div>
	</div>
	
	<div class="bottom">
	</div>
</div>