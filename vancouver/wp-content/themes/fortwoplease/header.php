<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html xmlns="https://www.w3.org/1999/xhtml" xmlns:og="https://opengraphprotocol.org/schema/" xmlns:fb="https://www.facebook.com/2008/fbml" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<?php include_once("analyticstracking.php") ?>
	<link rel="icon" type="image/png" href="/vancouver/wp-content/themes/images/favicon2c.png">

<?php
	echo '<meta property="og:title" content="'.get_field('sub_title').'" />';
	// echo '<meta property="og:description" content="description" />';
	if(get_field('image_1')) {
		echo '<meta property="og:image" content="'.get_field('image_1').'" />';
		echo '<link rel="image_src" href="'.get_field('image_1').'" />';
	} else if (has_post_thumbnail()) {
		echo '<meta property="og:image" content="'.the_post_thumbnail('full').'" />';
		echo '<link rel="image_src" href="'.the_post_thumbnail('full').'" />';
	}
	echo '<meta property="og:site_name" content="For Two Please" />';
	if (get_field('short_description')) {
		echo '<meta name="description" content="'.get_field('short_description').'" />';
		echo '<meta property="og:description" content="'.get_field('short_description').'" />';
	} else {
		echo '<meta name="description" content="Find the best date ideas in Vancouver, and go on better dates more often. We\'ll help you discover local date ideas based on your interests and give you exclusive member discounts on amazing date nights."/>';
	}
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	echo '<meta property="og:url" content="'.$protocol.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"].'" />';
	echo '<meta property="fb:app_id" content="185259828274700" />';
	echo '<meta property="og:type" content="article">';
	//echo '<meta property="og:type" content="Web Site" />';
?>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = "Go on your next great date";
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
	
		?>
	</title>
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
	
	<link rel="stylesheet" type="text/css" href="/vancouver/js/css/ui-darkness/jquery-ui-1.8.20.custom.css" />
	<link rel="stylesheet" href="/vancouver/js/dropkick.css" type="text/css" />
	<script src="/vancouver/js/f2p-base.js" type="text/javascript"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="/vancouver/js/jquery_cookie.js" type="text/javascript"></script>
	<script src="/vancouver/js/sessionstorage.1.4.js" type="text/javascript"></script>
	<script src="/vancouver/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
	<script src="/vancouver/js/jquery.lightbox_me.js" type="text/javascript"></script>
	<script src="https://fortwoplease.com/vancouver/wp-content/themes/fortwoplease/facebook_login.js" type="text/javascript"></script>
	<!-- start Mixpanel -->
	<script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===e.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.2.min.js';f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f);b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==
		typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");for(g=0;g<i.length;g++)f(c,i[g]);
		b._i.push([a,e,d])};b.__SV=1.2}})(document,window.mixpanel||[]);
		mixpanel.init("0813a7af01d22d10ec6373cedce06431");
	</script>
	<!-- end Mixpanel -->
	<script>
		function downloadJSAtOnload() {
			var element = document.createElement("script");
			element.src = "/vancouver/js/jquery-ui.multidatespicker.js";
			document.body.appendChild(element);

			var element3 = document.createElement("script");
			element3.src = "//assets.pinterest.com/js/pinit.js";
			document.body.appendChild(element3);

		}

		// Check for browser support of event handling capability
		if (window.addEventListener)
			window.addEventListener("load", downloadJSAtOnload, false);
		else if (window.attachEvent)
			window.attachEvent("onload", downloadJSAtOnload);
		else window.onload = downloadJSAtOnload;

		function getInternetExplorerVersion() {
			var rv = -1; // Return value assumes failure.
			if (navigator.appName == 'Microsoft Internet Explorer') {
				var ua = navigator.userAgent;
				var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
				if (re.exec(ua) != null)
					rv = parseFloat(RegExp.$1);
			}
			return rv;
		}
		function checkVersion() {
			var msg = false;
			var ver = getInternetExplorerVersion();
			if (ver > -1) {
				if (ver >= 8.0)
					msg = false;
				else
					msg = true;
			}
			if(msg==true)
			{window.location = "error-ie.html";
			}
			
		}
		
		checkVersion();
		
		if (navigator.appVersion.indexOf("Mac")!=-1) {
			$("body").css("background-color","#DEDEE0");	
		};
		
		jQuery(document).ready(function() {
			<?php if ( !is_user_logged_in() ) { ?>
				if (window.location.href === "<?php echo get_home_url() ?>/") {
					// do nothing...
				} else {
					var squeeze_show_cookie = $.cookie('squeeze_popup');
					if (squeeze_show_cookie == null) {
						setTimeout(function() {
							//window.setTimeout("GoogleTracking('/vancouver/join/');", 100);
							jQuery("#join_div").load('/vancouver/join', function() {
								jQuery("#join_div").lightbox_me({
									centered: true, 
								});
								jQuery('#join_div').append('<img src="/vancouver/wp-content/themes/images/close_icon.png" width="34" height="34" id="squeeze_close_button" style="position:absolute; top: 14px; left: 470px; cursor: pointer;" onclick="squeeze_close_action();" />');						
							});
		
		/*
							setTimeout(function() {
								jQuery('#join_div').append('<img src="/dev/wp-content/themes/images/close_icon.png" width="34" height="34" id="squeeze_close_button" style="position:absolute; top: 14px; left: 470px; cursor: pointer;" onclick="squeeze_close_action();" />');
								}, 200);
								*/
		
						}, 5000);
					}
				}
			<?php } ?>
			
			<?php
				$uri = parse_url(current_page_url());
				$path_str = "". $uri['path'];
				if (strpos($path_str, "date-type") !== false) {
					$path = explode("/", $path_str);
					$length = sizeof($path);
					//error_log($path[$length-2]);
					$category = $path[$length-2];
					error_log($category);
				} else {
					$category = "";
				}
			?>

			$(".date-package-link").click(function() {
				ga('send', 'event', 'link', 'click', 'date-package-link', 1);
			});

			$(".header-logo-link").click(function() {
				ga('send', 'event', 'link', 'click', 'header-logo-link', 1);
			});
			
			$(".header-account-link").click(function() {
				ga('send', 'event', 'link', 'click', 'header-account-link', 1);
			});

			$(".header-signin-link").click(function() {
				ga('send', 'event', 'link', 'click', 'header-signin-link', 1);
			});

			$(".header-signout-link").click(function() {
				ga('send', 'event', 'link', 'click', 'header-signout-link', 1);
			});
			
			$(".header-join-link").click(function() {
				ga('send', 'event', 'link', 'click', 'header-join-link', 1);
			});

			$("#downarrow").hover(
				function() {
					ga('send', 'event', 'link', 'hover', 'about-hover-in', 1);
				}, function() {
					ga('send', 'event', 'link', 'hover', 'about-hover-out', 1);
				}
			);

			$("#downarrow2").hover(
				function() {
					ga('send', 'event', 'link', 'hover-in', 'date-idea-link', 1);
				}, function() {
					ga('send', 'event', 'link', 'hover-out', 'date-idea-link', 1);
				}
			);
		 });

	</script>
	<style type="text/css">
	@font-face {
		font-family: 'Ubuntu';
		font-style: normal;
		font-weight: 400;
		src: local('Ubuntu'), url(https://themes.googleusercontent.com/static/fonts/ubuntu/v4/vRvZYZlUaogOuHbBTT1SNevvDin1pK8aKteLpeZ5c0A.woff) format('woff');
	}
	</style>
</head>

<body>
<div id="overlay-background">
</div>
<div id="overlay">
     <div>
          <img src="/vancouver/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif" />
     </div>
</div>
<div id="brandingfortwo">
<img class="source-image" src="/vancouver/wp-content/themes/images/main-bckg2.jpg" alt="" />
<div id="header-content">

<div id="header-left" style="float:left;">
	<div style='margin-top:20px;'>
		<a class="header-logo-link" href="/vancouver/">
			<img src="/vancouver/wp-content/themes/images/ftp_logo_header.png" style="border:none;"/>
		</a>
		<img src="/vancouver/wp-content/themes/images/ftp_best_date_ideas_tagline.png" style="border:none;"/>
	</div>
</div>


		<div id="header-about" style="float:right;margin-top:15px;">
			<div class="account_links">
				<a id="not_from_location" href="#">Not From Vancouver?</a>
			</div>
			<ul id="nav-one" class="nav m-t-m m-l-xl" style="float:left;">
				<li>
					<a id="downarrow" style="float:left;" href="#item1">About&nbsp;&nbsp;<img src="/vancouver/wp-content/themes/images/down-arrow.png" /></a>
					<ul style="display: block; border-top: 3px solid #6f6f6f;">
						<li><a class="about" id="how_it_works" href="/vancouver/about-us/">How It Works</a></li>
						<li><a class="about" id="perfectdate" href="/vancouver/perfect-date-guarantee/">Date Guarantee</a></li>
						<li><a class="about" id="suggestadate"href="#">Suggest a Date Idea</a></li>
						<li><a class="about" id="faq" href="/vancouver/faq/">FAQ</a></li>
						<li><a class="about" id="contactus" href="/vancouver/contact-us/">Contact</a></li>
						<li><a class="about" id="aboutus" href="/vancouver/about-us/">About Us</a></li>
						<li><a class="about" id="careers" href="/vancouver/careers/">Careers</a></li>
						<li><a class="about" id="policies" href="/vancouver/policies/">Policies</a></li>
					</ul>
				</li>			
			</ul>
		</div>

		<div id="header-right" style="float:right;margin-top:15px;margin-right:20px;">
			<div style="margin: 0 0 6px 16px;">
				<a href="http://www.twitter.com/fortwoplease" target="_blank"><img src="/vancouver/wp-content/themes/images/twitter_page_btn.png" /></a>&nbsp;&nbsp;
				<a href="http://www.facebook.com/fortwoplease" target="_blank"><img src="/vancouver/wp-content/themes/images/fb_page_btn.png" /></a>
			</div>
			<div class="account_links">
			<?php if ( !is_user_logged_in() ) { ?>
				<!--<a class="logmein" href="#">Login</a> | <a class="registerme" href="#">Register</a>-->
				<a id="sign_in" class="header-signin-link" href="#">Login</a> | <a class="header-join-link" id="join_now" href="#">Join</a>
			<?php } else{ ?>
				<a class="header-account-link" href="/vancouver/myaccount/">My Account</a> | <a class="header-signout-link" href="<?php echo wp_logout_url(current_page_url()); ?>" title="Logout">Logout</a>
			<?php } ?>
			</div>
		</div>
	</div>
    
	<div id="suggest-date" style="background:url(/vancouver/wp-content/themes/images/addons/add-on-bckg.png);color:white;padding:20px;display:none;width:500px;">
		<strong>Suggest a Date</strong>
		<p>Do you have a great date idea that we've missed? Let us know on our <a href="https://facebook.com/fortwoplease/" target="_blank">Facebook Page</a> or send us an email (dateideas@fortwoplease.com) - we're always looking for hidden gems!</p> <br/>
		<strong>Not sure if it's a good idea?</strong>
		<p>We love everything from skinny dipping on Wreck Beach to 5 Course Dining at Divino Wine Bar to renting kayaks on False Creek. Be bold and suggest it, chances are someone will love it too!</p>
	</div>
</div>

<div class="search_background">
	<div class="search_area">
		<div class="category_box">
			<ul class="categories">
				<li style="margin: 3px 13px 0 13px;"><a class="date-package-link" href="/vancouver/date-type/packages/">Date Packages</a></li>
				<ul id="nav-two" class="header-dropdown" style="float:left;">
					<li>
						<a id="downarrow2" style="float:left;" href="#">Date Ideas&nbsp;&nbsp;<img src="/vancouver/wp-content/themes/images/down-arrow.png" /></a>
						<ul style="display: block;">
							<li><a class="about" id="how_it_works" href="/vancouver/date-type/restaurants/">Dining</a></li>
							<li><a class="about" id="perfectdate" href="/vancouver/date-type/active/">Active</a></li>
							<li><a class="about" id="suggestadate"href="/vancouver/date-type/adventurous/">Adventurous</a></li>
							<li><a class="about" id="contactus" href="/vancouver/date-type/getaways/">Getaways</a></li>
							<li><a class="about" id="entertainment" href="/vancouver/date-type/entertainment/">Entertainment</a></li>
						</ul>
					</li>			
				</ul>
				
				<div style="clear: both;"></div>
			</ul>
		</div>
		<div class="search_box">
			<form id="text-form">
				<input id="input-text-search" type="text" class="search_field"/>
				<img id="text-search" src="/vancouver/wp-content/themes/images/search-mag.png" />
			</form>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>

<div id="page" class="hfeed">

	<div id="main">