 <?php get_header(); ?>

<script type="text/javascript">
<?php if ( !is_user_logged_in() ) { ?>
if (document.referrer == "" || document.referrer.indexOf("fortwoplease") < 0) {
	window.location.assign('/dev/subscribe');
}
<?php } ?>
</script>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/index.css" />
<script src="<?php echo home_url(); ?>/js/jquery.dropkick-1.0.0.js" type="text/javascript" charset="utf-8"></script>

<div class="center_content">

	<div class="dates_content">
		<div id="ur-date-ideas" class="dates_searched">
			<div class="dash_line"></div>
			<p id="ur-date-ideas-title">THE LATEST DATE IDEAS IN VANCOUVER</p>
		</div>
		<div id="results2" class="dates_searched_results"></div>
		
		<div style="clear: both;"></div>
	</div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="/dev/js/f2p-main.js" type="text/javascript" charset="utf-8"></script>
<script>
    Stripe.setPublishableKey('pk_test_h98nYuHxvZmSc56VzOTfsKzB');  // Test key!
</script>

<?php get_footer(); ?>