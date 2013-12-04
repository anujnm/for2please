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
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<link rel="icon" type="image/png" href="/dev/wp-content/themes/images/favicon2c.png">

<?php
	echo '<meta property="og:title" content="'.get_field('sub_title').'" />';
	// echo '<meta property="og:description" content="description" />';
	if(get_field('image_1'))
		echo '<meta property="og:image" content="'.get_field('image_1').'" />';
	else if (has_post_thumbnail())
		echo '<meta property="og:image" content="'.the_post_thumbnail('full').'" />';
	echo '<meta property="og:site_name" content="For Two Please" />';
	echo '<meta property="og:description" content="'.get_field('short_description').'" />';
	echo '<meta property="og:type" content="Web Site" />';
?>


<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="Looking for something casual and quiet to do on Saturday night? Go start gazing in a romantic setting in Vanier Park..."/>
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
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>

<link rel="stylesheet" type="text/css" href="/dev/js/css/ui-darkness/jquery-ui-1.8.20.custom.css" />
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu" />
<link rel="stylesheet" href="/dev/js/dropkick.css" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="/dev/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
<script src="/dev/js/f2p-common.js" type="text/javascript"></script>
<script src="/dev/js/jquery.lightbox_me.js" type="text/javascript"></script>
<script src="/dev/js/jquery-ui.multidatespicker.js" type="text/javascript"></script>
<script src="/dev/js/sessionstorage.1.4.js" type="text/javascript"></script>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<script src="/dev/js/jquery_cookie.js" type="text/javascript"></script>
<script src="/dev/js/googleanalyticscall.js" type="text/javascript"></script>

<script type="text/javascript">
jQuery(document).ready(function() {
	<?php if ( !is_user_logged_in() ) { ?>
		if (window.location.href === "<?php echo get_home_url() ?>/") {
			// do nothing...
		} else {
			var squeeze_show_cookie = $.cookie('squeeze_popup');
			if (squeeze_show_cookie == null) {
				setTimeout(function() {
					// Don't need Google Analytics on Dev
					//window.setTimeout("GoogleTracking('/dev/join/');", 100);
					jQuery("#join_div").load('/dev/join', function() {
						jQuery("#join_div").lightbox_me({
							centered: true, 
						});
						jQuery('#join_div').append('<img src="/dev/wp-content/themes/images/close_icon.png" width="34" height="34" id="squeeze_close_button" style="position:absolute; top: 14px; left: 470px; cursor: pointer;" onclick="squeeze_close_action();" />');
						
					});
				}, 5000);
			}
		}
	<?php } ?>
 });
 </script>

</head>

<body>

<div id="brandingfortwo">
<img class="source-image" src="/dev/wp-content/themes/images/main-bckg.jpg" alt="" />
<div id="header-content">

<div id="header-left" style="float:left;">
<div style='margin-top:20px;'><a href="/dev/"><img src="/dev/wp-content/themes/images/logoclear.png" style="border:none;"/></a></div>
</div>


<div id="header-about" style="float:right;margin-top:40px;margin-right:10px;">
<ul id="nav-one" class="nav" style="float:left;">
			<li>
				<a class="downarrow" style="float:left;" href="#item1">About</a><img id="downarrow" src="/dev/wp-content/themes/images/down-arrow.png" />
				<ul style="display: block; opacity: 0.9999; ">
					<li><a id="howitworks" href="#">How It Works</a></li>
                    <li><a id="dateenhancer" href="/dev/date-enhancer/">Date Enhancer</a></li>
					<li><a id="perfectdate" href="/dev/perfect-date-guarantee/">Date Guarantee</a></li>
					<li><a id="suggestadate"href="#">Suggest a Date</a></li>
					<li><a id="faq" href="/dev/faq/">FAQ</a></li>
                    <li><a id="contactus" href="/dev/contact-us/">Contact</a></li>
                    <li><a id="press" href="/dev/press/">Press</a></li>
					<li><a id="aboutus" href="/dev/about-us/">About Us</a></li>
					<li><a id="careers" href="/dev/careers/">Careers</a></li>
					<li><a id="policies" href="/dev/policies/">Policies</a></li>
				</ul>
			</li>
			
</ul></div>

<div id="header-right" style="float:right;margin-top:45px;margin-right:10px;">
<?php if ( !is_user_logged_in() ) { ?>
<!--<a class="logmein" href="#">Login</a> | <a class="registerme" href="#">Register</a>-->
<a id="join_now" href="#">Join Now!</a> | <a id="sign_in" href="#">Login</a>
<?php } else{ ?>
<a href="/dev/myaccount/">My Account</a> | <a href="<?php echo wp_logout_url(current_page_url()); ?>" title="Logout">Logout</a>
<?php } ?>
</div>




</div>
    
   <div id="suggest-date" style="background:url(/dev/wp-content/themes/images/addons/add-on-bckg.png);color:white;padding:20px;display:none;width:500px;">
  
   <strong>Suggest a Date</strong>
   <p>Do you have a great date idea that we've missed? Let us know on our <a href="https://facebook.com/fortwoplease/" target="_blank">Facebook Page</a> or send us an email (dateideas@fortwoplease.com) - we're always looking for hidden gems!</p> <br/>
   <strong>Not sure if it's a good idea?</strong>
   <p>We love everything from skinny dipping on Wreck Beach to 5 Course Dining at Divino Wine Bar to renting kayaks on False Creek. Be bold and suggest it, chances are someone will love it too!</p>
   </div>
    
    

</div>



<div id="page" class="hfeed">

	<div id="main">