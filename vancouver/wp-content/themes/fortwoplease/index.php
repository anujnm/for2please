 <?php get_header(); ?>

<script type="text/javascript">
<?php if ( !is_user_logged_in() ) { ?>
if (document.referrer == "" || document.referrer == "http://fortwoplease.com/" || document.referrer.indexOf("fortwoplease") < 0) {
	window.location.assign('/vancouver/subscribe');
}
<?php } ?>

</script>

<link rel="stylesheet" type="text/css" href="/vancouver/wp-content/themes/fortwoplease/index.css" />
<script src="/vancouver/js/jquery.dropkick-1.0.0.js" type="text/javascript" charset="utf-8"></script>

<div class="center_content">

	<div class="banner" style="display:none;">
	</div>

	<div class="dates_content">
		<div id="ur-date-ideas" class="dates_searched">
			<div class="dash_line"></div>
			<p id="ur-date-ideas-title">THE LATEST DATE IDEAS IN VANCOUVER</p>
		</div>
		<div id="results2" class="dates_searched_results"></div>
		
		<div style="clear: both;"></div>
	</div>
</div>
 
<script src="/vancouver/js/f2p-main.js" type="text/javascript" charset="utf-8"></script>
<?php get_footer(); ?>