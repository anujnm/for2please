<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/content-dates.css" />
<script src="<?php echo home_url(); ?>/slider/galleria-1.2.6.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/facebook_login.js" type="text/javascript"></script>

<script type="text/javascript">
<?php if(is_user_logged_in()) { ?>
	var isUserLoggedIn = 0;
<?php } else { ?>
	var isUserLoggedIn = -1;
<?php } ?>

var postID = <?php echo the_ID(); ?>;
var homeURL = "<?php echo home_url(); ?>";
var address =  "<?php the_field("mailing_address"); ?>, <?php the_field("city"); ?>,BC,<?php the_field("postal_code"); ?>";

<?php if(get_field('price')) { ?>;
	var price = <?php the_field('price'); ?>;
	var taxes = <?php the_field('taxes'); ?>;
	var fees = <?php the_field('fees'); ?>;
	var total = price + taxes + fees;
	var orderID = <?php echo get_current_user_id(); }?>;
</script>

<script src="/vancouver/js/f2p-dates.js" type="text/javascript" charset="utf-8"></script>
<!-- <script src="https://maps.google.com/maps?file=api&v=2&key=AIzaSyDLEOimOjJBjY5kPHxkRcSAfihslNNOUAI&sensor=false" type="text/javascript"></script> -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<div id="nav-links" class="nav_links">
	<div id="previous_page_link"></div>
	<div id="next_page_link"></div>
</div>

<div style="display:none;"><img src="/vancouver/wp-content/themes/images/get-it-normal.png" /><img src="/vancouver/wp-content/themes/images/get-t-hover.png"  /><img src="/vancouver/wp-content/themes/images/get-it-pressed.png"  /></div>
<div class="date-content">


<article id="date-<?php the_ID(); ?>">

<div class="center_content">
	<div class="content_block">
		<div class="content_header">
			<div class="title"><?php the_field('sub_title'); ?></div>
			<?php if (get_field("price")) { ?>
				<div class="package_title">DATE PACKAGE</div>
			<?php } else { ?>
				<div class="date_title">DATE IDEA</div>
			<?php } ?>
		</div>
		
		
		
		<div class="header_info">
			<div class="pictures" style="overflow:hidden;">
				<div class="galleria-info sub_title">
					<?php the_title(); ?>
				</div>
				<div id="image-slider" style="overflow:hidden; z-index:-1000; margin-top: -50px; ">
					<?php 
					if(get_field('image_1')){ ?>
						<div id="galleria">
							<img src=<?php the_field('image_1'); ?>>
							<?php if(get_field('image_2')){?>
								<img src=<?php the_field('image_2'); ?>>
							<?php } if(get_field('image_3')){?>
								<img src=<?php the_field('image_3'); ?>>
							<?php } if(get_field('image_4')){?>
								<img src=<?php the_field('image_4'); ?>>
							<?php } if(get_field('image_5')){?>
								<img src=<?php the_field('image_5'); ?>>
							<?php }  ?>
						</div>
						
					<?php
					} else if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail('full');
					} ?>
				</div>
				
			</div>
			
			<div class="date_package">
				<?php if(get_field('price')){ ?>
				<div class="package_info">
					<br/>
					<div id="loading">
						<img src="/vancouver/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif" />
					</div>

					<!--<div id="buy-button" class="buynow buy_btn"></div>-->
					<div id="buy">
						<div id="buy-button">
							<input type="button" value="BUY NOW" class="f2p-button" style="font-weight: bold;"/>
						</div>
						<div class="price">$<?php echo get_field('price') ?></div>
						<div style="clear: both;"></div>
						<div class="background">
							<div class="desc">
								<div class="fine_print">
									<b>Need to Know:</b><br/>
									<?php the_field('fine_print'); ?>
								</div>
								<div class="divider"></div>
								<div class="questions">
									<div class="title">Questions?</div>
									<div class="sub_title">We're here to help.</div>
									<div class="phone">Call us: 604.600.8441</div>
									<div class="email">
										<p><b>Email us:</b> <a href="mailto:support@fortwoplease.com?Subject=ForTwoPlease Support">Support@ForTwoPlease.com</a></p>
										<p><a href="/vancouver/policies/">Refund Policy</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div style="clear: both;"></div>

					<div id="buy-process" style="display:none; z-index: 100; position: absolute; background-color: #1a1a1a; min-height:450px; overflow:hidden; margin-bottom:20px;">
						<div style='width:312px; height:30px; margin-left: 15px;'>
							<h1 style='float:left; color: white;'>PAYMENT</h1>
							<img style='float:right;' src='/vancouver/wp-content/themes/images/step2.png' />
							<div style='clear:both;'></div>
						</div>
						<div class="background">
						<form id="buy_package_form" action="" method="post">
						<div style='color:#4d4d4d; padding: 5px; background-color: white;'>
							<p style="font-size:100%; font-weight: bold;">Please confirm the full name of the person who will be using this Date Package.</p>
							<br/>
							<?php $user_data = get_user_meta(wp_get_current_user()->ID); ?>
							<div>
								<label style='float: left; padding-left:10px;'>First Name:</label>
								<input type="text" id="first_name" style=' height: 20px;margin-bottom:5px;float:right;' name="first_name" value="<?php echo $user_data['first_name'][0]; ?>"/>
							</div>
							<div style='clear:both;'></div>
							<div>
								<label style='float: left; padding-left: 10px;'>Last Name:</label>
								<input type="text" id="last_name" style=' height: 20px;margin-bottom:5px;float:right;' name="last_name" value="<?php echo $user_data['last_name'][0]; ?>"/>
							</div>
							<div style='clear:both;'></div>
							<br/>
							<hr/>
							<br/>
							<p style="font-size:100%; font-weight: bold;">Please enter your payment information below.</p>
							<br/>
							<div id='payment-error' style='background:#FF9;clear:both;color:red;width:300px;margin-bottom:10px;overflow:hidden;padding:5px;display:none;'></div>
							<div style='clear:both;margin-bottom:10px;float:right;'>
								Quantity:
								<select style='background-color:#f2f2f2;'id='buy-quantity' name="quantity">
									<option value='1'>1</option>
									<option value='2'>2</option>
									<option value='3'>3</option>
									<option value='4'>4</option>
								</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span id='price'> Price: $</span>
							</div>
							<div id='price-detail' style='float:right;clear:both;height:60px; text-align:right;'>
								<div id='taxes'>Taxes: $</div>
								<div id='fees'>Fees: $</div>
								<div id='total_price'>Total: $</div>
								<input type="hidden" id="amount" name="amount" />
							</div>
							<div style='float:left;margin-left:110px;margin-bottom:10px;'>
								<img src='/vancouver/wp-content/themes/images/payments1.png'></img>
							</div>
							<div style='clear:both;'>
								<div style='padding-left:10px;height:30px;'>
									First Name: 
									<input type='text' id='fullname' style='float:right;height: 20px;' name="cardholder_fname" value="<?php echo $user_data['first_name'][0]; ?>"/>
								</div>
								<div style='padding-left:10px;height:30px;'>
									Last Name: 
									<input type='text' id='fullname' style='float:right;height: 20px;' name="cardholder_lname" value="<?php echo $user_data['last_name'][0]; ?>"/>
								</div>
								<div style='padding-left:10px;height:30px;'>
									Card Number: 
									<input type='text' id='cnumber' style='float:right;height: 20px;' name="card_number"/>
								</div>
								<div style='padding-left:10px;height:30px;'>
									Exp. Year:
									<select style='float:right;background-color:#f2f2f2;'id='eyear' name="exp_year">
										<option value='2012'>2012</option>
										<option value='2013'>2013</option>
										<option value='2014'>2014</option>
										<option value='2015'>2015</option>
										<option value='2016'>2016</option>
										<option value='2017'>2017</option>
										<option value='2018'>2018</option>
										<option value='2019'>2019</option>
									</select>
								</div>
								<div style='padding-left:10px;height:30px;'>
									Exp. Month:
									<select style='float:right;background-color:#f2f2f2;' id='emonth' name="exp_month">
										<option value='01'>01</option>
										<option value='02'>02</option>
										<option value='03'>03</option>
										<option value='04'>04</option>
										<option value='05'>05</option>
										<option value='06'>06</option>
										<option value='07'>07</option>
										<option value='08'>08</option>
										<option value='09'>09</option>
										<option value='10'>10</option>
										<option value='11'>11</option>
										<option value='12'>12</option>
									</select>
								</div>
								<div style='padding-left:10px;height:30px;'>
									Security Code: 
									<input type='text' id='csv' style='float: right; height: 20px;' name="csv"/>
								</div>
								<br/>
								<div style="padding-left:10px; float:left;">
									<img src="/vancouver/wp-content/themes/images/lock_icon.png" width="35" height="35" />
								</div>
								<div style='height:30px; float:right;'>
									<input style='float:right;clear:both;margin-bottom:10px;' type='submit' id='buy-now' name='submit' value='Checkout' class='f2p-button' />
								</div>
								<div style='clear:both;'></div>
								<br/>
							</div>
							<div style='clear:both;'></div>
						</div>
						</form>
						</div>
						
						<div class="background" style="margin-top: -15px;">
							<div class="desc">
								<div class="fine_print">
									<b>Need to Know:</b><br/>
									<?php the_field('fine_print'); ?>
								</div>
								<div class="divider"></div>
								<div class="questions">
									<div class="title">Questions?</div>
									<div class="sub_title">We're here to help.</div>
									<div class="phone">Call us: 604.600.8441</div>
									<div class="email">
										<p><b>Email us:</b> <a href="mailto:support@fortwoplease.com?Subject=ForTwoPlease Support">Support@ForTwoPlease.com</a></p>
										<p><a href="/vancouver/policies/">Refund Policy</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="user-ajax-login" class="blocks login_block">
						<div class="header">
							<h1>LOGIN</h1>
							<img src="/vancouver/wp-content/themes/images/step1.png" />
							<div style="clear: both;"></div>
						</div>
						<div class="background">
							<div class="login_info">
								<p>
									Don't have an account? <a id="regon" href="#">Register here </a>
								</p>
								<!-- To hold validation results -->
								<form id="wp_login_form" action="" method="post">
									<div class="login_fields">
										<label>Username/Email</label>
										<input type="text" name="username" class="text login_text" value="" />
									</div>
									<div class="login_fields">
										<label>Password</label>
										<input type="password" name="password" class="text login_text" value="" /><br/>
									</div>
									<a id="fpassword" href="#" class="forgot_pass" >Forgot your password?</a>
	
									<input type="submit" id="submitbtn" name="submit" value="Login" class="f2p-button login_btn" />
								</form>
								<div class="fb_login">
									<h2> or use facebook </h2>					
									<img id="fb_login_btn" src="/vancouver/wp-content/themes/images/fb_connect.png" width="167" height="22" style="cursor:pointer;" onclick="fb_login();"/>
								</div>					
							</div>
						</div>
						<div style="clear:both;"></div>
					</div>

					<div id="user-ajax-register" class="blocks register_block">
						<div class="header">
							<h1>REGISTER</h1>
							<img src="/vancouver/wp-content/themes/images/step1.png" />
						</div>

						<div class="background">
							<div class="register_info">
							<p>
								Already have an account? <a id="logon" href="#">Login here </a>
							</p>
							<form id="wp_reg_form" action="" method="post">  
								<div class="login_fields">
									<label>Username</label>  
									<input type="text" name="username" class="text login_text" value=""/>
								</div>  
								<div class="login_fields">
									<label>First Name</label>  
									<input type="text" name="fname" class="text login_text" value="" />
								</div> 
								<div class="login_fields">
									<label>Last Name</label>  
									<input type="text" name="lname" class="text login_text" value="" />
								</div> 
								<div class="login_fields">
									<label>Email address</label>  
									<input type="text" name="email" class="text login_text" value="" />
								</div> 
								<div class="login_fields">
									<label>Password</label>  
									<input type="password" name="password" class="text login_text" value="" />
								</div> 
								<div class="login_fields">
									<label>Confirm Password</label>  
									<input type="password" name="password2" class="text login_text" value="" />
								</div>
								<br/>
								<input type="submit" class="f2p-button register_btn" value="SignUp" name="submit" id="submitbtn2" />
							</form> 
						</div>
						</div>
						<div style="clear:both;"></div>
					</div>

					<div id="forgot-pass" class="tab_content_login blocks forgot_pass_block">
						<div class="header">
							<h1>Lost something?</h1>
						</div>
						<div class="background">
							<div class="forgot_pass_info">
							<p>Enter your username or email to reset your password.</p>
							<br/>
							<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
								<div class="username">
									<label for="user_login" class="hide"><?php _e('Username or Email'); ?>: </label>
									<input type="text" style=" height: 20px;margin-bottom:5px;" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
								</div>
								<div style="clear: both;"></div>
								<br/>
								<div class="reset">
									<?php do_action('login_form', 'resetpass'); ?>
									<input type="submit" class="f2p-button reset_btn" name="user-submit" value="<?php _e('Reset my password'); ?>" class="user-submit" tabindex="1002" />
									<?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
									<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
									<input type="hidden" name="user-cookie" value="1" />
								</div>
							</form>
							<br/>
							<a href="#" id="backtologin2"> << Back to login </a>
						</div>
						</div>
						<div style="clear:both;"></div>
					</div>
				</div>

				<?php } else { ?>
					<div class="date_info">
						<div style="height: 2px;"></div>
						<div class="content">
							<div class="yourself">
								<b>This is a do-it-yourself idea.</b>
								<p>Plan your date and add your own creative touches, or maybe use some of our suggestions to make it even more special.<p>
							</div>
							<div class="option">
								<b>Want an easier option?</b>
								<p>Let us do the planning! We work with the best local date spots to create exclusive date experiences for you to enjoy with someone special.</p>
								<br/>
								<a href="/vancouver/date-idea-type/packages/" style="font-weight: bold;">Click here to see Date Packages.</a>
							</div>
						</div>
					</div>
				<?php } ?>

				<div style="clear: both;"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div class="date_content">
			
			<div class="date_info">
				
				<div class="links">
					<div style="width: 140px; margin-top:3px;">
					<?php
						$uri = $_SERVER["REQUEST_URI"];
						$uri = substr($uri, 13);
						#get_permalink( $post->ID );
						//$uri = "http://fortwoplease.com/dev".$uri;
						$uri = "http://fortwoplease.com/vancouver".$uri;
						// echo $uri."<br/>";
						echo '<div class="fb-like" data-href="'.$uri.'" data-send="false" data-layout="button_count" data-show-faces="false" data-action="recommend" data-font="verdana"></div>';
					?>
					</div>

					<div style="width: 90px; margin-top:3px;">
						<a href="<?php echo $uri ?>" class="twitter-share-button">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
					<div style="width: 65px;">
						<a href="http://pinterest.com/pin/create/button/?url=<?php echo current_page_url(); ?>&media=<?php the_field('image_2'); ?>&description=this%20is%20the%20description" class="pin-it-button" count-layout="vertical"><img border="0" src="/vancouver/wp-content/themes/images/pinit.png" title="Pin It" /></a>
					</div>
					<div style="width: 70px; margin-top:3px;"><img src="/vancouver/wp-content/themes/images/email_btn.png" width="60" height="22" style="cursor:pointer;" onclick="jQuery('#share-date').lightbox_me({
        centered: true, 
        });"/></div>
				</div>
				
				
				<?#php dd_fblike_generate('Recommend Button Count') ?>
				<?#php dd_pinterest_generate('Compact') ?>
				<?#php dd_twitter_generate('Compact','twitter_username') ?>
				
				<div id="share-date">
					<form id="share-this-date">
						<div class="info">
							<div class="label">Recipient's Email:</div>
							<div class="input"><input type='text' name="recipient-email" class="text_field" /></div>
							<div style="clear: both;"></div>
						</div>
						<div class="info">
							<div class="label">Recipient's Name:</div>
							<div class="input"><input type='text' name="recipient-name" class="text_field" /></div>
							<div style="clear: both;"></div>
						</div>
						<div class="info">
							<div class="label">Your Name:</div>
							<div class="input"><input type="text" name="sender-name" class="text_field" /></div>
							<div style="clear: both;"></div>
						</div>
						<br/>
						<div class="message">Message(optional): <br/> <textarea rows="5" name="message" cols="40"> </textarea></div>
						
						<br/>
						<input type="submit" id="share-submit" value="send" class="f2p-button" />
					</form>
				</div>
				
				<div style="clear: both;"></div>
				
				<div class="title">
					<?php if(get_field('price')) { ?>
						THE DATE PACKAGE...
					<?php } else { ?>
						THE DATE IDEA...
					<?php }?>
				</div>
				<?php if(get_field('short_description')){ ?>
					<p class="short_desc"><?php the_field('short_description'); ?></p>
				<?php } ?>
				<div class="why"><?php the_field('why_is_this_a_great_date'); ?></div>
			
				<div id="word-on-street" class="quotes"><?php the_field('word_on_the_street'); ?></div>
			</div>
			
			
			<div class="date_details">
				<?php if (get_the_term_list( $post->ID, 'date-type' ) != null ) { ?>	
				<div id="locations" class="item">
					<div class="block"><p>DATE TYPE</p> <?php echo get_the_term_list( $post->ID, 'date-type', '', ', ', '' ); ?></div>
				</div>
				<?php } ?> 
				
				<?php if (get_the_term_list( $post->ID, 'location' ) != null ) { ?>	
				<div id="location" class="item">
					<div class="block"><p>LOCATION</p> <?php echo get_the_term_list( $post->ID, 'location', '', ', ', '' ); ?></div>
				</div>
				<?php } ?> 
				
				<?php if (get_the_term_list( $post->ID, 'time' ) != null ) { ?>	
				<div id="time" class="item">
					<div class="block"><p>TIME</p> <?php echo get_the_term_list( $post->ID, 'time', '', ', ', '' ); ?></div>
				</div>
				<?php } ?>  
				
				<div style="clear:both;"></div>
				<div class="map">
					<p class="business_name"><?php the_field('business_name'); ?></p>
					<p class="extra_info">
						<?php the_field('extra_info'); ?>
						<?php the_field('mailing_address'); ?>
						<br/>
						<?php the_field('city'); ?>
						<br/>
						<?php the_field('phone_number'); ?>
						<br/>
						<?php
						if (strstr(get_field('web_address', false), "http://") == get_field('web_address', false)) {
						?>
							<a href="<?php the_field('web_address'); ?>" target="_blank" >Visit Website</a>
						<?php } else { ?>
							<a href="http://<?php the_field('web_address'); ?>" target="_blank" >Visit Website</a>
						<?php }?>
					</p>
					<br/>
					<div id="map_canvas" style="position: relative; width: 260px; height: 200px; margin: 0 auto; z-index: 1;"></div>
					<br/><br/>
				</div>
			</div>
			
			<div style="clear:both;"></div>
		</div>
		
		<div style="clear:both;"></div>
	</div>
</div>

</article>
<script type="text/javascript">
window.fbAsyncInit = function() {
	var uid;
	var accessToken;
	FB._https = (window.location.protocol == "https:");
	FB.init({
	// appId      : '140109872734286',
	//appId      : '121541631324064', // Facebook Local App ID
	//appId      : '442143535808692', // Facebook Dev App ID
	appId      : '185259828274700', // Facebook Live App ID
	//channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
	status     : true, // check login status
	cookie     : true, // enable cookies to allow the server to access the session
	xfbml      : true  // parse XFBML
	//oauth : true
	});
};

(function(d){
var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
if (d.getElementById(id)) {return;}
js = d.createElement('script'); js.id = id; js.async = true;
js.src = "//connect.facebook.net/en_US/all.js";
ref.parentNode.insertBefore(js, ref);
}(document));
</script>