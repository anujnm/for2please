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
	   <div id="login-window" style="display:none;background:url(/vancouver/wp-content/themes/images/addons/add-on-bckg.png);width:500px;height:300px;border-radius:10px;border:thin solid #CCC;color:white;">
       
	   <div id="login-part" class="atestclass">
        <div style="margin-bottom:10px;margin-left:15px;margin-top:35px;">
 		<!-- To hold validation results -->
        <form id="wp_login_form_head" action="" method="post">
       
         <div style="height: 30px; width: 300px; position: relative; left: 70px;"><label>Username</label>
        <input type="text" name="username" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;width:150px;float:right;" class="text" value=""></div>
         <div style="height: 30px; width: 300px; position: relative; left: 70px;"><label>Password</label>
        <input type="password" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;width:150px;float:right;" name="password" class="text" value=""></div>
		<a id="forgotpass" href="#"> Forgot your password? </a> <br/>
        <input type="submit" class="f2p-button" style="margin-top:10px;"  id="submit-login" name="submit" value="Login">
        </form>
        </div><br/>
		<h2 style="margin-top:0px;"> or use facebook </h2>

<!-- <div class="fb-login-button" data-show-faces="true" data-width="200" data-max-rows="1"></div> -->
		<a><img id="fb_login_btn" src="/vancouver/wp-content/themes/images/f-connect.png" width="87" height="21" style="cursor:pointer;"/></a>
		<!-- <button id="fb_login_btn">FB Login</button> -->
 <!-- <?php echo do_shortcode('[AWD_loginbutton]'); ?> -->

</div>
	
		<div id="tab3_login" class="tab_content_login" style="display:none;">
			<h3>Lose something?</h3>
			<p>Enter your username or email to reset your password.</p>
			<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login" class="hide"><?php _e('Username or Email'); ?>: </label>
					<input type="text" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
				</div>
				<div class="login_fields">
					<?php do_action('login_form', 'resetpass'); ?>
					<input type="submit" class="f2p-button" style="margin-top:10px;margin-bottom:10px;" name="user-submit" value="<?php _e('Reset my password'); ?>" class="user-submit" tabindex="1002" />
					<?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
			
			<a href="#" id="backtologin"> << Back to login </a>
		</div>
</div>

<div id="register-window" style="display:none;background:url(/vancouver/wp-content/themes/images/addons/add-on-bckg.png);width:500px;height:300px;border-radius:10px;border:thin solid #CCC;color:white;">
	   <div id="loginpart">

        <div style="margin-bottom:10px;margin-left:15px;margin-top:15px;">
       <form style="float:left;margin-right:20px;margin-top:15px;width:300px;"id="wp_reg_form_head" action="" method="post">  
         <div style="height:30px;"> <label>Username</label>  
        <input type="text" name="username" class="text" value="" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;width:150px;"/></div>  
        <div style="height:30px;"> <label>First Name</label>  
        <input type="text" name="fname" class="text" value="" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;width:150px;"/></div> 
        <div style="height:30px;"> <label>Last Name</label>  
        <input type="text" name="lname" class="text" value="" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;width:150px;"/></div> 
        <div style="height:30px;"> <label>Email address</label>  
        <input type="text" name="email" class="text" value="" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;width:150px;"/> </div> 
        <div style="height:30px;"> <label>Password</label>  
        <input type="password" name="password" class="text" value="" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;width:150px;"/> </div> 
        <div style="height:30px;"> <label>Confirm Password</label>  
        <input type="password" name="password2" class="text" value="" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;width:150px;"/> </div> 
        
        <input type="submit" id="submitreg" class="f2p-button" name="submit" value="SignUp" style="clear:both;float:right;margin-right:50px;" />  
        </form> 
              </div>  <br/>
		<h2 style="margin-top: 50px;"> or use facebook </h2>

		<!-- <button id="fb_login_btn2">FB Login</button> -->
		<a><img id="fb_login_btn2" src="/vancouver/wp-content/themes/images/f-connect.png" width="87" height="21" style="cursor:pointer;"/></a>
 <!-- <?php echo do_shortcode('[AWD_loginbutton]'); ?> -->
 </div>

<div id="how-it-works" style="background:url(/vancouver/wp-content/themes/images/addons/add-on-bckg.png);border-radius:10px;border:solid 1px #ccc;width:900px;height:500px;display:none;color:#FFF;">

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

<?php wp_footer(); ?>

<script type="text/javascript">

jQuery("#text-search").click( function () {
	var query = jQuery("#input-text-search").val();
	window.location.assign("/vancouver/index.php?q=" + query);
 });
		 
jQuery("#text-form").submit( function (e) {
	e.preventDefault();
	var query = jQuery("#input-text-search").val();
	window.location.assign("/vancouver/index.php?q=" + query);
});

jQuery(document).ready(function(){
	
			jQuery("#nav-one li").hover(
				function(){ jQuery("ul", this).fadeIn("fast"); }, 
				function() { } 
			);
	  	if (document.all) {
				jQuery("#nav-one li").hoverClass ("sfHover");
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
		
		jQuery("#submit-login").click(function() {
	
	var input_data = jQuery('#wp_login_form_head').serialize();
	jQuery.ajax({
	type: "POST",
	url:  "/vancouver/wp-admin/admin-ajax.php",
	data: "action=logmein&" + input_data,
	success: function(msg){
		if(msg=='Success'){
		setTimeout("location.reload(true);");
		}
		else
		{ alert(msg)};
	}
	});
	return false;
	
	});
	
jQuery(".logmein").click(function(e){
		jQuery('#login-window').lightbox_me({
        centered: true, 
        });
    e.preventDefault();
});

jQuery(".registerme").click(function(e){
		jQuery('#register-window').lightbox_me({
        centered: true, 
        });
    e.preventDefault();
});

	

jQuery("#forgotpass").click(function(){
	jQuery("#login-part").hide();
	jQuery("#tab3_login").show();
	});
	
jQuery("#backtologin").click(function(){
	jQuery("#tab3_login").hide();
	jQuery("#login-part").show();
});

jQuery("#submitreg").click(function() {
	
	var input_data = jQuery('#wp_reg_form_head').serialize();
	alert(input_data);
	jQuery.ajax({
	type: "POST",
	url:  "/vancouver/wp-admin/admin-ajax.php",
	data: "action=newuserreg&" + input_data,
	success: function(msg){
	
	if(msg=='Success'){
		setTimeout("location.reload(true);");
		}
		else
		{ alert(msg)};
	}
	
	});
	return false;
	
	});
	
		jQuery("#regon").click(function(){
		jQuery("#user-ajax-login").hide();
		jQuery("#user-ajax-register").show();
		return false;
	});
	jQuery("#logon").click(function(){
		jQuery("#user-ajax-register").hide();
		jQuery("#user-ajax-login").show();
		return false;
	});
	
		
	jQuery("#env-img").click(function(e){
		jQuery('#share-date').lightbox_me({
        centered: true, 
        });
    e.preventDefault();
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
		jQuery("#sign_in_div").load('/vancouver/login', function() {
			window.setTimeout("GoogleTracking('/vancouver/login/');", 100);
			jQuery("#sign_in_div").lightbox_me({
				centered: true, 
			});
			
		});
		e.preventDefault();
/*
	} else {
		jQuery("#sign_in_div").lightbox_me({
			centered: true, 
		});
		e.preventDefault();
	}
*/
	return false;
});

jQuery("#join_now").click(function(e){
//	if (jQuery("#join_block").length == 0) {
		jQuery("#join_div").load('/vancouver/join', function() {
			window.setTimeout("GoogleTracking('/vancouver/join/');", 100);
			jQuery("#join_div").lightbox_me({
				centered: true, 
			});
			
		});
		e.preventDefault();
/*
	} else {
		jQuery("#join_div").lightbox_me({
			centered: true, 
		});
		e.preventDefault();
	}
*/
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