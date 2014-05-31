<?php
/*
Template Name: subscribe
*/

//get_header();

?>

<head>
	<?php include_once("analyticstracking.php") ?>
	<link rel="icon" type="image/png" href="/vancouver/wp-content/themes/images/favicon2c.png">
	<script src="https://fortwoplease.com/vancouver/wp-content/themes/fortwoplease/facebook_login.js" type="text/javascript"></script>
	<script type="text/javascript">
		// Add a script element as a child of the body
		function downloadJSAtOnload() {
			var element = document.createElement("script");
			element.src = "/vancouver/js/googleanalyticscall.js";
			document.body.appendChild(element);

			var element2 = document.createElement("script");
			element2.src = "/vancouver/js/jquery_cookie.js";
			document.body.appendChild(element2);

		}

		// Check for browser support of event handling capability
		if (window.addEventListener)
			window.addEventListener("load", downloadJSAtOnload, false);
		else if (window.attachEvent)
			window.attachEvent("onload", downloadJSAtOnload);
		else window.onload = downloadJSAtOnload;

	</script>
	<style type="text/css">
	body { margin: 0; background: #fff url('/vancouver/wp-content/themes/images/squeeze_page_bg_2.jpg') no-repeat !important; background-size: 100% !important; font-family: 'Ubuntu'; }
	p { margin: 0; }
	div.subscribe {margin:40px;}
	div.head {padding-top: 80px;font-size:40px;text-align:left; }
	div.head div.logo { margin: 80px 0 0 40px; background: url('/vancouver/wp-content/themes/images/squeeze_tagline_2.png') no-repeat; background-size: 100%; width: 70%; height: 100px; }
	div.head img { height: 76px; }
	div.login_box {padding-top:80px;}
	div.head-box {display:inline-block; height:76px; vertical-align:middle;}
	div.skip { background: url('/vancouver/wp-content/themes/images/sign_up_skip_box.png') no-repeat; margin-top: 10px; width: 518px; height: 94px; padding: 26px 0; color: white; font-size: 16px; }
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

<div class='subscribe'>
	<div class='head' style='display:none;'>
		<div class='head-box'>
			<img src='/dev/wp-content/themes/images/squeeze_tagline_3.png'/>
		</div>
		<div class='head-box'>
			<span style='margin-top:10px;display:inline-block;'>The best date ideas in your city</span>
		</div>
	</div>
	<div class="login_box"></div>
	<div class="skip" style="display:none;">
		<p>I have a fear of commitment and I’m not ready to sign up...<p>
		<p style=" margin-top: 4px;"><a href="#" id="skip_link" style="font-size: 20px; font-weight: bold;">Just let me in!</a></p>
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="/vancouver/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
/* Don't need Google Analytics on Dev */
		jQuery(document).ready(function() {
			jQuery(".login_box").load("/vancouver/join", function() {
				jQuery(".skip").show();
				jQuery(".head").show();
			});
		});

		jQuery("#skip_link").click(function() {
			var date = new Date();
			date.setTime(date.getTime() + (60 * 60 * 1000));
			$.cookie("squeeze_popup", "show", { expires: date, path: '/' });
			location.assign('<?php echo home_url(); ?>');
		});
</script>
<!-- start Mixpanel -->
<script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===e.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.2.min.js';f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f);b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==
	typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");for(g=0;g<i.length;g++)f(c,i[g]);
	b._i.push([a,e,d])};b.__SV=1.2}})(document,window.mixpanel||[]);
	mixpanel.init("9eaba85c30a39f0fc095ffa962f63863");
</script>
<!-- end Mixpanel -->
<?php

//get_footer();

?>
