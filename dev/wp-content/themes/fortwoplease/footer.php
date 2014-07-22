<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->



	<div id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				if ( ! is_404() )
					get_sidebar( 'footer' );
			?>


	</div><!-- #colophon -->

<div id="how-it-works" style="background:url(/wp-content/themes/images/addons/add-on-bckg.png);border-radius:10px;border:solid 1px #ccc;width:900px;height:500px;display:none;color:#FFF;">

<h2 style="margin-top:20px;margin-bottom:20px;">How it Works</h2>
<p style="margin-top:20px;margin-bottom:20px;font-weight:700;">We make it easy to go on your next great date.</p>


<div style="float:left;height:150px;width:250px;margin-left:70px;">
<p style="font-weight:700;">1. Choose A Date Idea</p>
<p>Find local date ideas based on what you want to do. </p>
<p>Not sure? Hit “Surprise Me!” and we’ll inspire you</p>
</div>

<div style="float:left;height:150px;width:250px;">
<p style="font-weight:700;">2. Enhance It</p>
<p>Make it happen with our “Date Enhancers” like cabs and babysitters. </p>
<p>If you want to WOW your beau, we’ll help you add flowers or even private airplanes!</p>
</div>

<div style="float:left;height:150px;width:250px;">
<p style="font-weight:700;">3. Get it HERE!</p>
<p>You can buy Date Packages through us, which include perks like free Champagne, late check outs and more...</p>
<p>*All packages you can buy are marked “Get it HERE!”</p>
</div>

<p style="clear:both;margin-bottom:10px;font-weight:700;">Our Date Packages are easy to buy and use.</p>

<div style="float:left;height:150px;width:250px;margin-left:70px;">
<p style="font-weight:700;">1. Choose a Date Package</p>
<p>You can get date ideas marked “Get it Here!” through ForTwoPlease!</p>
<p>Simply fill out the secured fields to purchase it</p>
</div>

<div style="float:left;height:150px;width:250px;margin-right:10px;">
<p style="font-weight:700;">2. Reserve It</p>
<p>After you buy a Date Package, we give you the number to call & reserve a time that’s best for you. Say your name and ForTwoPlease ID to make your reservation.</p>
<p style="font-style:italic;">*Every member has their own ForTwoPlease ID, like a phone number. You can find yours on your account page.</p>
</div>

<div style="float:left;height:150px;width:250px;">
<p style="font-weight:700;">3. Show Up</p>
<p>When you arrive, just say your name and ForTwoPlease ID  – it’s that easy! </p>
<p>p.s. We send you a confirmation email, and the Date Package you purchased will appear in your account so you can review the details. (Remember, no need to print anything. Dating is a classy affair!)</p>
</div>

</div>
</div>


</div><!-- #page -->

<div id="fb-root"></div>

<div id="join_div"></div>
<div id="sign_in_div"></div>
<div id='location_div'></div>
<?php wp_footer(); ?>

<script type="text/javascript">
jQuery("#text-search").click( function () {
	var query = jQuery("#input-text-search").val();
	window.location.assign("/index.php?q=" + query);
 });

jQuery("#text-form").submit( function (e) {
	e.preventDefault();
	var query = jQuery("#input-text-search").val();
	window.location.assign("/index.php?q=" + query);
});

jQuery(document).ready(function(){

	jQuery("#nav-one li").hover(
		function(){
            jQuery("ul", this).fadeIn("fast");
        },
		function() { }
	);
  	if (document.all) {
		jQuery("#nav-one li").hoverClass ("sfHover");
	}

    jQuery("#nav-two li").hover(
        function() {
            jQuery("ul", this).fadeIn("fast");
        },
        function() {}
    );

    if (document.all) {
        jQuery("nav-two li").hoverClass("sfHover");
    }
});

jQuery.fn.hoverClass = function(c) {
	return this.each(function(){
		jQuery(this).hover(
			function() { jQuery(this).addClass(c);  },
			function() { jQuery(this).removeClass(c); }
		);
	});
};


jQuery("#forgotpass").click(function(){
	jQuery("#login-part").hide();
	jQuery("#tab3_login").show();
	});

	jQuery("#qmark").click(function(e){
		jQuery('#qmark-popup').lightbox_me({
        centered: true,
        });
    e.preventDefault();
	});

	jQuery("#howitworks").click(function(e){
		jQuery('#how-it-works').lightbox_me({
        centered: true,
        });
    e.preventDefault();
	return false;
});

jQuery("#suggestadate").click(function(e){
		jQuery('#suggest-date').lightbox_me({
        centered: true,
        });
    e.preventDefault();
	return false;
});

jQuery("#sign_in").click(function(e){
//	if (jQuery("#sign_in_block").length == 0) {
		jQuery("#sign_in_div").load('/login', function() {
			//window.setTimeout("GoogleTracking('/login/');", 100);
			jQuery("#sign_in_div").lightbox_me({
				centered: true,
			});

		});
		e.preventDefault();
	return false;
});

jQuery("#join_now").click(function(e){
//	if (jQuery("#join_block").length == 0) {
		jQuery("#join_div").load('/join', function() {
			// Don't need Google Analytics on Dev
			//window.setTimeout("GoogleTracking('/join/');", 100);
			jQuery("#join_div").lightbox_me({
				centered: true,
			});

		});
		e.preventDefault();
	return false;
});

jQuery("#not_from_location").click(function(e) {
    jQuery("#location_div").load('/city/', function() {
        jQuery("#location_div").lightbox_me({
            centered: true,
        });
    });
    e.preventDefault();
    return false;
});

function squeeze_close_action() {
	var date = new Date();
	date.setTime(date.getTime() + (60 * 60 * 1000));
	$.cookie("squeeze_popup", "show", { expires: date, path: '/' });
	jQuery("#join_div").trigger('close');
}

<?php #} ?>


(function(d){
var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
if (d.getElementById(id)) {return;}
js = d.createElement('script'); js.id = id; js.async = true;
js.src = "//connect.facebook.net/en_US/all.js";
ref.parentNode.insertBefore(js, ref);
}(document));




</script>

</body>
</html>
