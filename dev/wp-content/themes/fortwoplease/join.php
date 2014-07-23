<?php
/*
Template Name: join
*/

?>
<head>
<title>ForTwoPlease | Join</title>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<style type="text/css">
body { margin: 0; font-family: 'Ubuntu'; }

div.center_box { position:relative; width: 514px; height: 448px; background: url('/wp-content/themes/images/join_box.png') no-repeat top left; color: white; text-align: center;}
div.center_box p { margin: 0; font-size: 122%; }
div.center_box div.top { padding: 35px 20px 0 20px; text-align: center; }
div.center_box div.top h1 { color: #f4782c !important;  padding: 0; font-size: 222%; }
div.center_box div.top p { margin-top: 12px; font-size: 133%; }
div.center_box div.inputs { position: relative; top: 34px; margin: 0 auto; width: 514px; }
div.center_box div.inputs p { padding: 6px 0; }
div.center_box form { margin-top: 6px; }
div.center_box form input.text { width: 280px; margin: 0; font-size: 18px; text-align: center; }
div.center_box form input.f2p-button { margin: 4px 0; }
div.center_box div.fb_connect { }
div.center_box div.bottom { position:absolute; top: 405px; margin: 0 auto; display:block; width: 514px; }
div.center_box div.bottom p { color: #2895d8; font-size: 20px; }
div.center_box div.bottom p label { color: white; }
</style>

<script type="text/javascript">
	if (typeof(jQuery) === 'undefined') {
		document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'>\<\/script>");
	}
</script>

</head>

<?php $randVal = rand(); ?>

<div class="center_box" id="join_block">
	<div class="top">
		<h1>A guide to the best</h1>
		<h1>date ideas in your city!</h1>
		<p>Sign up to get a weekly email of local date ideas</p>
	</div>

	<div class="inputs">
		<form id="email_subscription_form" action="" method="post">
			<p>
				<input type="text" id='email' name="email" value="Email" class="text" onblur="onBlur(this);" onfocus="onFocus(this);" />
			</p>
			<p>
				<input id="password-clear<?php echo $randVal ?>" type="text" value="Password" autocomplete="off" class="text" />
				<input id="password-password<?php echo $randVal ?>" type="password" name="password" class="text" style="display:none;" />
			</p>
			<p class="lightboxMessage hide"></p>
			<p>
				<input type="submit" id="submit-email" name="submit" value="SIGN UP" class="f2p-button" />
			</p>
		</form>
		<br/>
		<div class="fb_connect"><img id="fb_login_btn" src="/wp-content/themes/images/fb_connect.png" width="167" height="22" style="cursor:pointer;" onclick="fb_login();"/></div>
	</div>

	<div class="bottom">
		<p><label>Already a member?</label> <a href="#" id="login_link" style="font-weight: bold;">Login here</a></p>
	</div>
</div>

<script type="text/javascript">
	jQuery('#login_link').click(function() {
		jQuery("#join_block").load("/login", function() {
			// Don't need Google Analytics on Dev
			//window.setTimeout("GoogleTracking('/login/');", 100);
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

	function verifyEmail(email){
		var status = false;
		var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	     if (email.search(emailRegEx) == -1) {
	          $('.lightboxMessage').html("Please enter a valid email address.").show();
	     } else {
	          status = true;
	     }
	     return status;
	}

	jQuery("#submit-email").click(function() {
		$('.lightboxMessage').hide();
		if (verifyEmail(jQuery('#email').val())) {
			var input_data = jQuery('#email_subscription_form').serialize();
			jQuery.ajax({
				type: "POST",
				url:  "/wp-admin/admin-ajax.php",
				data: "action=email_subscribe&" + input_data,
				success: function(msg) {
					if(msg == 'Success') {
						if (window.location.pathname.indexOf('subscribe') > 0) {
							mixpanel.track('Successful Sign Up', { 'url': 'Subscribe' }, function() {
								setTimeout("location.assign('<?php echo home_url(); ?>');");
							});
						} else if (window.location.pathname.indexOf("join") > 0) {
							mixpanel.track('Successful Sign Up', { 'url': 'Join' }, function() {
								setTimeout("location.assign('<?php echo home_url(); ?>');");
							});
						} else {
							mixpanel.track('Successful Sign Up', { 'url': 'Lightbox' }, function() {
								setTimeout("location.reload(true);");
							});
						}
					} else {
						$('.lightboxMessage').html(msg).show();
					};
				}
			});
		}
		return false;
	});
</script>
