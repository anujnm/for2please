<?php
/*
Template Name: reset_password
*/

?>
<head>
<title>ForTwoPlease | Reset Password</title>

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<style type="text/css">
body { margin: 0; font-family: 'Ubuntu'; }
div.center_box { position:relative; width: 514px; height: 448px; background: url('/date-ideas/wp-content/themes/images/join_box.png') no-repeat top left; color: white; text-align: center;}
div.center_box p { margin: 0; font-size: 122%; }
div.center_box div.top { padding: 25px; text-align: center; }
div.center_box div.top h1 { color: #f35a23 !important; padding: 15px 0 20px 0; font-size: 266%; }
div.center_box div.inputs { position: relative; top: 26px; margin: 0 auto; width: 514px; }
div.center_box div.inputs p { padding: 6px 0; }
div.center_box form { margin-top: 30px; }
div.center_box form input.text { width: 280px; margin: 0; font-size: 18px; text-align: center; }
div.center_box form input.f2p-button { margin: 5px 0; }
div.center_box div.fb_connect { margin-top: 8px; }
div.center_box div.bottom { position:absolute; top: 405px; margin: 0 auto; display:block; width: 514px; }
div.center_box div.bottom p { color: #2895d8; }
div.center_box div.bottom p label { color: #f35a23; }
</style>

<script type="text/javascript">
	if (typeof(jQuery) === 'undefined') {
		document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'>\<\/script>");
	}
</script>

</head>

<div class="center_box" id="password_block">
	<div class="top">
		<h1>LOSE SOMETHING?</h1>
		<p>Enter your email to reset your password.</p>
	</div>

	<div class="inputs">
		<form id="reset_pass_form" method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>"
			<p>
				<input type="text" id="user_login" name="user_login" value="Email" class="text" onblur="onBlur(this);" onfocus="onFocus(this);" />
			</p>
			<p>
				<?php do_action('login_form', 'resetpass'); ?>
				<input id="user_login" type="submit" class="f2p-button" name="user-submit" value="<?php _e('RESET MY PASSWORD'); ?>" class="user-submit" />
				<?php $reset = $_GET['reset']; if($reset == true) { echo '<p style="font-size: 100%; color: white;">Check your email! A message has been sent with instructions to reset your password.</p>'; } ?>
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
				<input type="hidden" name="user-cookie" value="1" />
			</p>
		</form>
	</div>

	<div class="bottom">
		<p><label>Back to</label> <a href="#" id="pass_login_link">login</a></p>
	</div>
</div>

<script type="text/javascript">
	jQuery('#reset_pass_submit_btn').click(function(e) {
		e.preventDefault();
		var input_data = jQuery('#reset_pass_form').serialize();
		jQuery.ajax({
			type: "POST",
			url:  "/date-ideas/wp-admin/admin-ajax.php",
			data: "action=userhasftpaccount&" + input_data,
			success: function(msg) {
				console.log(msg);
				if(msg == 'Success-1'){
					jQuery("#password_block").load("/date-ideas/login-fb");
				} else {
					console.log("submit form now...");
					jQuery('#reset_pass_form').submit();
				}
			}
		});
	});

	jQuery('#pass_login_link').click(function() {
		jQuery("#password_block").load("/date-ideas/login", function() {
			//window.setTimeout("GoogleTracking('/date-ideas/login')", 100);
		});
	});

	function onBlur(el) {
		if (el.value == '') {
			el.value = el.defaultValue;
		}
	}
	function onFocus(el) {
		if (el.value == el.defaultValue) {
			el.value = '';
		}
	}
</script>
