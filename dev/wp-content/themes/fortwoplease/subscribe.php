<?php
/*
Template Name: subscribe
*/

//get_header();

?>

<head>
	<link rel="icon" type="image/png" href="/dev/wp-content/themes/images/favicon2c.png">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="/dev/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
	<script src="/dev/js/googleanalyticscall.js" type="text/javascript"></script>
	<script src="/dev/js/jquery_cookie.js"></script>
	<style type="text/css">
	body { margin: 0; background: #fff url('/dev/wp-content/themes/images/squeeze_page_bg_2.jpg') no-repeat !important; background-size: 100% !important; font-family: 'Ubuntu'; }
	p { margin: 0; }
	div.head div.logo { margin: 80px 0 0 40px; background: url('/dev/wp-content/themes/images/squeeze_tagline_2.png') no-repeat; background-size: 100%; width: 70%; height: 100px; }
	div.head img { width: 100%; height: 76px; }
	div.skip { background: url('/dev/wp-content/themes/images/sign_up_skip_box.png') no-repeat; margin-top: 10px; width: 518px; height: 94px; padding: 26px 0; color: white; font-size: 16px; }
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


<script type="text/javascript">
/* Don't need Google Analytics on Dev
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-22573395-1']);
	_gaq.push(['_setDomainName', 'fortwoplease.com']);
	_gaq.push(['_trackPageview']);
	
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	*/
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

<?php

//get_footer();

?>
