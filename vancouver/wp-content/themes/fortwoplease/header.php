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

	?></title>
<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>

<link rel="stylesheet" type="text/css" href="/vancouver/js/css/ui-darkness/jquery-ui-1.8.20.custom.css" />
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu" />
<link rel="stylesheet" href="/vancouver/js/dropkick.css" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="/vancouver/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
<script src="/vancouver/js/f2p-common.js" type="text/javascript"></script>
<script src="/vancouver/js/jquery.lightbox_me.js" type="text/javascript"></script>
<script src="/vancouver/js/jquery-ui.multidatespicker.js" type="text/javascript"></script>
<script src="/vancouver/js/sessionstorage.1.4.js" type="text/javascript"></script>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<script src="/vancouver/js/jquery_cookie.js" type="text/javascript"></script>
<script src="/vancouver/js/googleanalyticscall.js" type="text/javascript"></script>

<script type="text/javascript">
jQuery(document).ready(function() {
	<?php if ( !is_user_logged_in() ) { ?>
		if (window.location.href === "<?php echo get_home_url() ?>/") {
			// do nothing...
		} else {
			var squeeze_show_cookie = $.cookie('squeeze_popup');
			if (squeeze_show_cookie == null) {
				setTimeout(function() {
					window.setTimeout("GoogleTracking('/vancouver/join/');", 100);
					jQuery("#join_div").load('/vancouver/join', function() {
						jQuery("#join_div").lightbox_me({
							centered: true, 
						});
						jQuery('#join_div').append('<img src="/vancouver/wp-content/themes/images/close_icon.png" width="34" height="34" id="squeeze_close_button" style="position:absolute; top: 14px; left: 470px; cursor: pointer;" onclick="squeeze_close_action();" />');
						
					});
				}, 5000);
			}
		}
	<?php } ?>
	
	<?php
		$uri = parse_url(current_page_url());
		$path_str = "". $uri['path'];
		if (strpos($path_str, "date-idea-type") !== false) {
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
 
</head>

<body>

<div id="brandingfortwo">
<img class="source-image" src="/vancouver/wp-content/themes/images/main-bckg2.jpg" alt="" />
<div id="header-content">

<div id="header-left" style="float:left;">
	<div style='margin-top:20px;'>
		<a href="/vancouver/">
			<img src="/vancouver/wp-content/themes/images/ftp_logo_header.png" style="border:none;"/>
		</a>
		<img src="/vancouver/wp-content/themes/images/ftp_best_date_ideas_tagline.png" style="border:none;"/>
	</div>
</div>


<div id="header-about" style="float:right;margin-top:40px;">
			<ul id="nav-one" class="nav" style="float:left;">
				<li>
					<a id="downarrow" style="float:left;" href="#item1">About&nbsp;&nbsp;<img src="/vancouver/wp-content/themes/images/down-arrow.png" /></a>
					<ul style="display: block; border-top: 3px solid #6f6f6f;">
						<li><a class="about" id="how_it_works" href="/vancouver/about-us/">How It Works</a></li>
						<li><a class="about" id="perfectdate" href="/vancouver/perfect-date-guarantee/">Date Guarantee</a></li>
						<li><a class="about" id="suggest_a_date" href="/vancouver/suggest-a-date-idea/">Suggest a Date Idea</a></li>
						<li><a class="about" id="faq" href="/vancouver/faq/">FAQ</a></li>
						<li><a class="about" id="contactus" href="/vancouver/contact-us/">Contact</a></li>
						<li><a class="about" id="press" href="/vancouver/press/">Press</a></li>
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
				<a id="sign_in" href="#">Login</a> <span style="color: #3ECDFF;">|</span> <a id="join_now" href="#">Join</a>
			<?php } else{ ?>
				<a href="/vancouver/myaccount/">My Account</a> <span style="color: #3ECDFF;">|</span> <a href="<?php echo wp_logout_url(current_page_url()); ?>" title="Logout">Logout</a>
			<?php } ?>
			</div>
		</div>
	</div>




</div>
    
   <div id="suggest-date" style="background:url(/vancouver/wp-content/themes/images/addons/add-on-bckg.png);color:white;padding:20px;display:none;width:500px;">
  
</div>

<div class="search_background">
	<div class="search_area">
		<div class="category_box">
			<ul class="categories">
				<?php if (strcmp($category, "packages") == 0) { ?>
					<li><a href="/vancouver/date-idea-type/packages/" class="package_selected">Date Packages</a></li>
				<?php } else {?>
					<li><a href="/vancouver/date-idea-type/packages/" class="package">Date Packages</a></li>
				<? } ?>
				
				<?php if (strcmp($category, "restaurants") == 0) { ?>
					<li><a href="/vancouver/date-idea-type/restaurants/" class="selected">Dining</a></li>
				<?php } else {?>
					<li><a href="/vancouver/date-idea-type/restaurants/">Dining</a></li>
				<? } ?>
				<?php if ("active" == $category) { ?>
					<li><a href="/vancouver/date-idea-type/active/" class="selected">Active</a></li>
				<?php } else {?>
					<li><a href="/vancouver/date-idea-type/active/">Active</a></li>
				<? } ?>
				<?php if ("adventurous" == $category) { ?>
					<li><a href="/vancouver/date-idea-type/adventurous/" class="selected">Adventurous</a></li>
				<?php } else {?>
					<li><a href="/vancouver/date-idea-type/adventurous/">Adventurous</a></li>
				<? } ?>
				<?php if ("getaway" == $category) { ?>
					<li><a href="/vancouver/date-idea-type/getaway/" class="selected">Getaway</a></li>
				<?php } else {?>
					<li><a href="/vancouver/date-idea-type/getaway/">Getaway</a></li>
				<? } ?>
				<?php if ("entertainment" == $category) { ?>
					<li><a href="/vancouver/date-idea-type/entertainment/" class="selected">Entertainment</a></li>
				<?php } else {?>
					<li><a href="/vancouver/date-idea-type/entertainment/">Entertainment</a></li>
				<? } ?>
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