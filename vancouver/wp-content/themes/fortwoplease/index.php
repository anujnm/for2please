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
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<div class="center_content">
	<ins class="adsbygoogle"
                     style="display:inline-block;width:728px;height:90px;padding-top:20px;padding-left:30px;"
                     data-ad-client="ca-pub-4081693765901599"
                     data-ad-slot="6672957644"></ins>

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
<script src="/vancouver/js/f2p-main.js" type="text/javascript" charset="utf-8"></script>
<script>
    Stripe.setPublishableKey('pk_test_h98nYuHxvZmSc56VzOTfsKzB');  // Test key!
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php get_footer(); ?>