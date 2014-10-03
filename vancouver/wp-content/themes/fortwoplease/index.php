 <?php get_header(); ?>

<script type="text/javascript">
<?php if ( !is_user_logged_in() ) { ?>
if (document.referrer == "" || document.referrer == "http://fortwoplease.com/" || document.referrer.indexOf("fortwoplease") < 0) {
	window.location.assign('/date-ideas/subscribe');
}
<?php
}
$wp_session = WP_Session::get_instance();
$current_city = get_term_by('name', $wp_session['f2p-city'], 'city');
?>


</script>

<link rel="stylesheet" type="text/css" href="/date-ideas/wp-content/themes/fortwoplease/index.css" />
<script src="/date-ideas/js/jquery.dropkick-1.0.0.js" type="text/javascript" charset="utf-8-without-bom"></script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<div class="center_content">
	<ins class="adsbygoogle"
                     style="display:inline-block;width:728px;height:90px;padding-top:20px;padding-left:30px;"
                     data-ad-client="ca-pub-4081693765901599"
                     data-ad-slot="6672957644"></ins>

	<div class="dates_content">
		<div id="ur-date-ideas" class="dates_searched">
			<div class="dash_line"></div>
			<p id="ur-date-ideas-title">THE LATEST DATE IDEAS IN <?php echo strtoupper($current_city->name);?></p>
		</div>
		<div id="results2" class="dates_searched_results"></div>

		<div style="clear: both;"></div>
	</div>
</div>
<script src="/date-ideas/js/f2p-main.js" type="text/javascript" charset="utf-8-without-bom"></script>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php get_footer(); ?>
