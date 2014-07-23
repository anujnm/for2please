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
	   <div id="login-window" style="display:none;background:url(/dev/wp-content/themes/images/addons/add-on-bckg.png);width:500px;height:300px;border-radius:10px;border:thin solid #CCC;color:white;">
       
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

 <?php echo do_shortcode('[AWD_loginbutton]'); ?>

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

<div id="register-window" style="display:none;background:url(/dev/wp-content/themes/images/addons/add-on-bckg.png);width:500px;height:300px;border-radius:10px;border:thin solid #CCC;color:white;">
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

 <?php echo do_shortcode('[AWD_loginbutton]'); ?>
 </div>

<div id="how-it-works" style="background:url(/dev/wp-content/themes/images/addons/add-on-bckg.png);border-radius:10px;border:solid 1px #ccc;width:900px;height:500px;display:none;color:#FFF;">

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

<p style="clear:both;margin-bottom:10px;font-weight:700px;">Our Date Packages are easy to buy and use.</p>

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


	
	
</script>

</body>
</html>