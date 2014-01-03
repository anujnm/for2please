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
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:fb="http://ogp.me/ns/fb#">
<!--<![endif]-->
<head>
	<?php include_once("analyticstracking.php") ?>
	<link rel="icon" type="image/png" href="/dev/wp-content/themes/images/favicon2c.png">
	
	<?php
		echo '<meta property="og:title" content="'.get_field('sub_title').'" />';
		// echo '<meta property="og:description" content="description" />';
		if(get_field('image_1'))
			echo '<meta property="og:image" content="'.get_field('image_1').'" />';
			//echo '<meta property="og:image" content="http://fortwoplease.com/vancouver/wp-content/uploads/2012/03/FTP-Date-Idea-Photo-1-Nuba-Restaurant-Lunch.jpg" />';
		else if (has_post_thumbnail())
			echo '<meta property="og:image" content="'.the_post_thumbnail('full').'" />';
		echo '<meta property="og:site_name" content="For Two Please" />';
		echo '<meta property="og:description" content="'.get_field('short_description').'" />';
		echo '<meta property="og:type" content="Web Site" />';
	?>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
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
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
	
	<link rel="stylesheet" type="text/css" href="/dev/js/css/ui-darkness/jquery-ui-1.8.20.custom.css" />
	<link rel="stylesheet" href="/dev/js/dropkick.css" type="text/css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="/dev/js/jquery_cookie.js" type="text/javascript"></script>
	<script src="/dev/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
	<script>
		function downloadJSAtOnload() {
			var element = document.createElement("script");
			element.src = "/dev/js/jquery-ui.multidatespicker.js";
			document.body.appendChild(element);

			var element2 = document.createElement("script");
			element2.src = "/dev/js/sessionstorage.1.4.js";
			document.body.appendChild(element2);

			var element3 = document.createElement("script");
			element3.src = "//assets.pinterest.com/js/pinit.js";
			document.body.appendChild(element3);

			//var element4 = document.createElement("script");
			//element4.src = "/dev/js/jquery_cookie.js";
			//document.body.appendChild(element4);

			var element5 = document.createElement("script");
			element5.src = "/dev/js/jquery.lightbox_me.js";
			document.body.appendChild(element5);

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
							jQuery("#join_div").load('/dev/join', function() {
								
								jQuery("#join_div").lightbox_me({
									centered: true, 
								});
								jQuery('#join_div').append('<img src="/dev/wp-content/themes/images/close_icon.png" width="34" height="34" id="squeeze_close_button" style="position:absolute; top: 14px; left: 470px; cursor: pointer;" onclick="squeeze_close_action();" />');
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
          <img src="/dev/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif" />
     </div>
</div>
<div id="brandingfortwo">
	<img class="source-image" src="/dev/wp-content/themes/images/main-bckg2.jpg" alt="" />
	<div id="header-content">
		<div id="header-left" style="float:left;">
			<div style='margin-top:20px;'>
				<a href="/dev/">
					<img src="/dev/wp-content/themes/images/ftp_logo_header.png" style="border:none;"/>
				</a>
				<img src="/dev/wp-content/themes/images/ftp_best_date_ideas_tagline.png" style="border:none;"/>
			</div>
		</div>


		<div id="header-about" style="float:right;margin-top:40px;">
			<ul id="nav-one" class="nav" style="float:left;">
				<li>
					<a id="downarrow" style="float:left;" href="#item1">About&nbsp;&nbsp;<img src="/dev/wp-content/themes/images/down-arrow.png" /></a>
					<ul style="display: block; border-top: 3px solid #6f6f6f;">
						<li><a class="about" id="how_it_works" href="/dev/about-us/">How It Works</a></li>
						<li><a class="about" id="perfectdate" href="/dev/perfect-date-guarantee/">Date Guarantee</a></li>
						<li><a class="about" id="suggestadate"href="#">Suggest a Date Idea</a></li>
						<li><a class="about" id="faq" href="/dev/faq/">FAQ</a></li>
						<li><a class="about" id="contactus" href="/dev/contact-us/">Contact</a></li>
						<li><a class="about" id="press" href="/dev/press/">Press</a></li>
						<li><a class="about" id="aboutus" href="/dev/about-us/">About Us</a></li>
						<li><a class="about" id="careers" href="/dev/careers/">Careers</a></li>
						<li><a class="about" id="policies" href="/dev/policies/">Policies</a></li>
					</ul>
				</li>			
			</ul>
		</div>

		<div id="header-right" style="float:right;margin-top:15px;margin-right:20px;">
			<div style="margin: 0 0 6px 16px;">
				<a href="http://www.twitter.com/fortwoplease" target="_blank"><img src="/dev/wp-content/themes/images/twitter_page_btn.png" /></a>&nbsp;&nbsp;
				<a href="http://www.facebook.com/fortwoplease" target="_blank"><img src="/dev/wp-content/themes/images/fb_page_btn.png" /></a>
			</div>
			<div class="account_links">
			<?php if ( !is_user_logged_in() ) { ?>
				<!--<a class="logmein" href="#">Login</a> | <a class="registerme" href="#">Register</a>-->
				<a id="sign_in" href="#">Login</a> | <a id="join_now" href="#">Join</a>
			<?php } else{ ?>
				<a href="/dev/myaccount/">My Account</a> | <a href="<?php echo wp_logout_url(current_page_url()); ?>" title="Logout">Logout</a>
			<?php } ?>
			</div>
		</div>
	</div>
    
	<div id="suggest-date" style="background:url(/dev/wp-content/themes/images/addons/add-on-bckg.png);color:white;padding:20px;display:none;width:500px;">
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
				<div>
					<ul id="nav-two" class="header-dropdown" style="float:left;">
						<li>
							<a id="downarrow2" style="float:left;" href="/dev/date-type/packages/">Date Package&nbsp;&nbsp;<img src="/dev/wp-content/themes/images/down-arrow.png" /></a>
							<ul style="display: block;">
								<li><a class="about" id="how_it_works" href="/dev/date-type/restaurants/">Dining</a></li>
								<li><a class="about" id="perfectdate" href="/dev/date-type/active/">Active</a></li>
								<li><a class="about" id="suggestadate"href="/dev/date-type/adventurous/">Adventurous</a></li>
								<li><a class="about" id="contactus" href="/dev/date-type/getaways/">Getaways</a></li>
								<li><a class="about" id="press" href="/dev/date-type/entertainment/">Entertainment</a></li>
							</ul>
						</li>			
					</ul>
				</div>
				<div style="clear: both;"></div>
			</ul>
		</div>
		<div class="search_box">
			<form id="text-form">
				<input id="input-text-search" type="text" class="search_field"/>
				<img id="text-search" src="/dev/wp-content/themes/images/search-mag.png" />
			</form>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>

<div id="page" class="hfeed">

	<div id="main">