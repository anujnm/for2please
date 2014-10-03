 <?php get_header(); ?>

<script type="text/javascript">
<?php if ( !is_user_logged_in() ) { ?>
if (document.referrer == "" || document.referrer.indexOf("fortwodev.com") < 0) {
	window.location.assign('/subscribe');
}
<?php
}
$wp_session = WP_Session::get_instance();
$current_city = get_term_by('name', $wp_session['f2p-city'], 'city');
?>
</script>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/index.css" />
<script src="<?php echo home_url(); ?>/js/jquery.dropkick-1.0.0.js" type="text/javascript" charset="utf-8-without-bom"></script>

<div class="center_content">

	<div class="dates_content">
		<div id="ur-date-ideas" class="dates_searched">
			<div class="dash_line"></div>
			<p id="ur-date-ideas-title">THE LATEST DATE IDEAS IN <?php echo strtoupper($current_city->name);?></p>
		</div>
		<div id="results2" class="dates_searched_results"></div>

		<div style="clear: both;"></div>
	</div>
</div>
<script src="/js/f2p-main.js" type="text/javascript" charset="utf-8-without-bom"></script>

<?php get_footer(); ?>
