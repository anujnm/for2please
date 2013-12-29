<?php
/*
Template Name: subscribe
*/

//get_header();

?>

<head>
	<link rel="icon" type="image/png" href="/dev/wp-content/themes/images/favicon2c.png">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="/dev/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		// Add a script element as a child of the body
		function downloadJSAtOnload() {
			var element = document.createElement("script");
			element.src = "/dev/js/googleanalyticscall.js";
			document.body.appendChild(element);

			var element2 = document.createElement("script");
			element2.src = "/dev/js/jquery_cookie.js";
			document.body.appendChild(element2);

		}

		// Check for browser support of event handling capability
		if (window.addEventListener)
			window.addEventListener("load", downloadJSAtOnload, false);
		else if (window.attachEvent)
			window.attachEvent("onload", downloadJSAtOnload);
		else window.onload = downloadJSAtOnload;

		/* Don't need Google Analytics on Dev */
		jQuery(document).ready(function() {
			jQuery("#login_box").load("/dev/join", function() {
				jQuery(".skip").show();
			});
		});
		
		jQuery("#skip_link").click(function() {
			var date = new Date();
			date.setTime(date.getTime() + (60 * 60 * 1000));
			$.cookie("squeeze_popup", "show", { expires: date, path: '/' });
			location.assign('<?php echo home_url(); ?>');
		});
	</script>
	<style type="text/css">
	body { margin: 0; background: #fff url('/dev/wp-content/themes/images/squeeze_page_bg_2.jpg') no-repeat !important; background-size: 100% !important; font-family: 'Ubuntu'; }
	p { margin: 0; }
	div.head div.logo { margin: 80px 0 0 40px; background: url('/dev/wp-content/themes/images/squeeze_tagline_2.png') no-repeat; background-size: 100%; width: 70%; height: 100px; }
	div.head img { width: 100%; height: 76px; }
	div.skip { background: url('/dev/wp-content/themes/images/sign_up_skip_box.png') no-repeat; margin-top: 10px; width: 518px; height: 94px; padding: 26px 0; color: white; font-size: 16px; }
	@font-face {
		font-family: 'Ubuntu';
		font-style: normal;
		font-weight: 400;
		src: local('Ubuntu'), url(https://themes.googleusercontent.com/static/fonts/ubuntu/v4/vRvZYZlUaogOuHbBTT1SNevvDin1pK8aKteLpeZ5c0A.woff) format('woff');
	}
	</style>
	
	<title>ForTwoPlease - Join us today!</title>
	<meta name="description" content="Discover the best date ideas in Vancouver. ForTwoPlease helps you go on better dates more often, and gives you exclusive discounts on Date Nights in Vancouver!" />
</head>

<div class="head">
	<div class="logo"></div>
</div>

<div style="clear: both;"></div>

<div style="margin: 40px;">
	<div id="login_box"></div>
	<div class="skip" style="display:none;">
		<p>I have a fear of commitment and I’m not ready to sign up...<p>
		<p style=" margin-top: 4px;"><a href="#" id="skip_link" style="font-size: 20px; font-weight: bold;">Just let me in!</a></p>
	</div>
</div>

<?php

//get_footer();

?>
