<?php
/*
Template Name: login
*/

?>

<head>
<title>ForTwoPlease | Login</title>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<style type="text/css">
body { margin: 0; font-family: 'Ubuntu' !important; }
div.center_box { position:relative; width: 514px; height: 445px; background: url('/date-ideas/wp-content/themes/images/join_box.png') no-repeat top left; color: white; text-align: center;}
div.center_box p { margin: 0; font-size: 122%; }
div.center_box div.top { padding: 25px 0 0 0; text-align: center; }
div.center_box div.top h1 { color: #ea5f1a; padding: 15px 0 10px 0; font-size: 266%; }
div.center_box div.inputs { position: relative; top: 20px; margin: 0 auto; width: 514px; }
div.center_box div.inputs p { padding: 6px 0; }
div.center_box form { margin-top: 25px; }
div.center_box form input.text { width: 280px; margin: 0; font-size: 18px; text-align: center; }
div.center_box form input.f2p-button { margin: 4px 0; }
div.center_box div.fb_connect { margin-top: 5px; }
div.center_box div.bottom { position:absolute; top: 403px; margin: 0 auto; width: 514px; }
div.center_box div.bottom p { color: #2895d8; font-size: 18px; }
div.center_box div.bottom p label { color: white; }
</style>

<script type="text/javascript">
	if (typeof(jQuery) === 'undefined') {
		document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'>\<\/script>");
	}
</script>

</head>

<?php $randVal = rand(); ?>

<div class="center_box" id="sign_in_block">
	<div class="top">
		<h1>WELCOME BACK!</h1>
	</div>

	<div class="inputs">
		<div class="fb_connect"><img id="fb_login_btn2" src="/date-ideas/wp-content/themes/images/fb_connect.png" width="167" height="22" style="cursor:pointer;" onclick="fb_login();"/></div>
		<p>or sign in with your email and password</p>
		<form id="sign_in_form" action="" method="post">
			<p>
				<input type="text" name="username" value="Email" class="text" onblur="onBlur(this);" onfocus="onFocus(this);" />
			</p>
			<p>
				<input id="password-clear<?php echo $randVal ?>" type="text" value="Password" autocomplete="off" class="text" />
				<input id="password-password<?php echo $randVal ?>" type="password" name="password" class="text" style="display:none;" />
			</p>
			<p class="lightboxMessage hide"></p>
			<p>
				<input type="submit" id="submit-signin" name="submit" value="SIGN IN" class="f2p-button" />
			</p>
		</form>
	</div>

	<div class="bottom">
		<p><a href="#" id="password_link">Forgot your password?</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Not a member?</label> <a href="#" id="join_link">Join Now!</a></p>
	</div>
</div>

<script type="text/javascript">
	jQuery('#password_link').click(function() {
		jQuery("#sign_in_block").load("/date-ideas/forgot-password", function() {
			//window.setTimeout("GoogleTracking('/date-ideas/forgot-password/');", 100);
		});
	});

	jQuery('#join_link').click(function() {
		jQuery("#sign_in_block").load("/date-ideas/join", function() {
			//window.setTimeout("GoogleTracking('/date-ideas/join/');", 100);
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

	jQuery('#password-clear<?php echo $randVal ?>').focus(function() {
		jQuery('#password-clear<?php echo $randVal ?>').hide();
		jQuery('#password-password<?php echo $randVal ?>').show();
		jQuery('#password-password<?php echo $randVal ?>').focus();
	});

	jQuery('#password-password<?php echo $randVal ?>').blur(function() {
		if(jQuery('#password-password<?php echo $randVal ?>').val() == '') {
			jQuery('#password-clear<?php echo $randVal ?>').show();
			jQuery('#password-password<?php echo $randVal ?>').hide();
		}
	});


	jQuery("#submit-signin").click(function() {
		var input_data = jQuery('#sign_in_form').serialize();
		$('.lightboxMessage').hide();
		jQuery.ajax({
			type: "POST",
			url:  "/date-ideas/wp-admin/admin-ajax.php",
			data: "action=logmein&" + input_data,
			success: function(msg){
				if(msg == 'Success'){
					if (window.location.pathname.indexOf("subscribe") > 0) {
						mixpanel.track('Successful Login', { 'url': 'Subscribe' }, function() {
							setTimeout("location.assign('<?php echo home_url(); ?>');");
						});
					} else if (window.location.pathname.indexOf('login') > 0) {
						mixpanel.track('Successful Login', { 'url': 'Login' }, function() {
							setTimeout("location.assign('<?php echo home_url(); ?>');");
						});
					}
					else {
						mixpanel.track('Successful Login', { 'url': 'Lightbox' }, function() {
							setTimeout("location.reload(true);");
						});
					}
				} else {
					$('.lightboxMessage').html(msg).show();
				};
			}
		});
		return false;
	});
</script>
