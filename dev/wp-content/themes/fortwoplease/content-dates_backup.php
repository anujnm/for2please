<?php

function printAddOn ($addOnName) {
	$output = "";
	if($addOnName == 'Black Top & Checker Cabs') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/cab.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Beat the rush!</p>";
		$output .= "<span>Reserve your taxi now & be on time. <br/> Call Black Top Cabs 604.731.1111 </span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Nannies On Call') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/babysitter.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>It’s kids-free time! </p>";
		$output .= "<span>Hire a sitter & enjoy some alone time! <br/> Call Nannies on Call 1.877.214.2828 or <a href=' https://www.nanniesoncall.com/booking/online' target='_blank'>Book Online</a></span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Car-2-Go') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/Car2Go.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Be in the driver’s seat!</p>";
		$output .= "<span>Get there in the perfect car for two. <br/> <a href='https://www.car2go.com/vancouver/en/' target='_blank'>Book Car-2-Go Today</a></span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Blo Dry Bar') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/hair.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Pamper your date!</p>";
		$output .= "<span>Give them a hairdo & make them glow. <br/> Call Blo at the Four Seasons 604.609.5460</span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Davie Flowers') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/flowers.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Show them you care!</p>";
		$output .= "<span>Bring flowers & make them feel special. <br/> Call Davie Flowers 604.685.9111 or <a href='http://www.vancouverdavieflowers.ca/' target='_blank'>Book Online</a></span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'HighEnd Limousine') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/limo.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Treat them like a star!</p>";
		$output .= "<span>Book your limo now & arrive in style. <br/> Call HighEnd Limousine 604.572.8000 </span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Leonidas Chocolates') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/chocolates.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Bring their favourite chocolates.</p>";
		$output .= "<span>Visit Leonidas Chocolates - <a href='http://www.leonidaswaterfront.com/contact.php' target='_blank'>Locations</a></span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Liberty Wine Merchants') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/wine.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Make it exceptional!</p>";
		$output .= "<span>Bring wine & start the date off right. <br/> Visit Liberty Wine Merchants - <a href='http://libertywinemerchants.com/pages/locations.php' target='_blank'>Locations</a></span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Caffe Artigiano') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/coffee.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Enjoy a pre-date coffee</p>";
		$output .= "<span>Bring wine & start the date off right. <br/> Visit Liberty Wine Merchants - <a href='http://libertywinemerchants.com/pages/locations.php' target='_blank'>Locations</a></span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Party Bazaar') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/balloons.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Make them float on air!</p>";
		$output .= "<span>Visit the Party Bazaar - <a href='http://www.thepartybazaar.com/pages/contact-info' target='_blank'>Locations</a></span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'WholeFoods Market') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/picnic.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Romance al fresco!</p>";
		$output .= "<span>Grab a few treats for a delicious picnic. <br/> Visit WholeFoods Market - <a href='http://wholefoodsmarket.com/stores/' target='_blank'>Locations</a></span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'la Vie en Rose') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/lingerie.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Turn up the heat!</p>";
		$output .= "<span>Give sexy lingerie for a sultry evening. <br/> Visit la Vie en Rose or Order Online <a href='http://www.lavieenrose.com/webapp/wcs/stores/servlet/BoutiqueLocator_10052_100 01_-1' target='_blank'>Vist </a> la Vie en Rose or <a href='http://www.lavieenrose.com' target='_blank'>Order Online</a>";
		$output .= "</span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Mark Whitehead Photography') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/photoshoot.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Add a photo shoot.</p>";
		$output .= "<span>Call Mark Whitehead Photography - 778.829.9914</span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Rocky Mountain Soap Company') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/candles.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Add massage oil or candles.</p>";
		$output .= "<span>Visit Rocky Mountain Soap -  <a href='http://www.rockymountainsoap.com/webpage/1002398/1000144' target='_blank'>Locations</a></span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'MAKE IT YOU') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/poem.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>That’s right...you!</p>";
		$output .= "<span>Show your creative flair! Surprise them with a poem, card or song.</span>";
		$output .= "</div>";
		$output .= "</div>";
	} elseif($addOnName == 'Sea To Sky Air') {
		$output .= "<div class='add_ons'>";
		$output .= "<img src='/dev/wp-content/themes/images/addons/plane.png' />";
		$output .= "<div class='info'>";
		$output .= "<p>Soar with delight!</p>";
		$output .= "<span>Hire a private flight for the ultimate date <br/> Call Sea To Sky Air 604.898.1975</span>";
		$output .= "</div>";
		$output .= "</div>";
	}
	
	echo $output;
}

?>


<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/content-dates.css" />
<script src="<?php echo home_url(); ?>/slider/galleria-1.2.6.js"></script>
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

<script src="/dev/js/f2p-dates.js" type="text/javascript" charset="utf-8"></script>
<!-- <script src="https://maps.google.com/maps?file=api&v=2&key=AIzaSyDLEOimOjJBjY5kPHxkRcSAfihslNNOUAI&sensor=false" type="text/javascript"></script> -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>


<div style="display:none;"><img src="/dev/wp-content/themes/images/get-it-normal.png" /><img src="/dev/wp-content/themes/images/get-t-hover.png"  /><img src="/dev/wp-content/themes/images/get-it-pressed.png"  /></div>
<div class="date-content">
<div id="nav-links" class="nav_links">
	<span class="back"><a href="/dev/" id="b2search"><< Back to search</a></span>
	<span id="nplinks2"></span>
	<span id="nplinks"></span>
</div>

<article id="date-<?php the_ID(); ?>">

<div class="center_content">
	<div class="content_block">
		<div class="content_header">
			<div class="title" style="float:left;"><?php the_field('sub_title'); ?></div>
			<div class="links">
				<span><a href="http://pinterest.com/pin/create/button/?url=<?php echo current_page_url(); ?>&media=<?php the_field('image_2'); ?>&description=this%20is%20the%20description" class="pin-it-button" count-layout="vertical"><img border="0" src="/dev/wp-content/themes/images/pinit.png" title="Pin It" /></a></span>
				<span style="margin-top: 4px;">
				<!-- <div class="fb-like" data-send="false" data-layout="button_count" data-show-faces="false" data-action="recommend" data-font="verdana" style="float:left;"></div> -->
				<?php
					//$uri = $_SERVER["REQUEST_URI"];
					//$uri = substr($uri, 13);
					//get_permalink( $post->ID );
					//$uri = "http://fortwoplease.com/dev".$uri;
					// echo $uri."<br/>";
					$uri = get_permalink( $post->ID );
					echo '<div class="fb-like" data-href="'.$uri.'" data-send="false" data-layout="button_count" data-show-faces="false" data-action="recommend" data-font="verdana"></div>';
				?>

				</span>
			</div>
		</div>
		
		
		
		<div class="header_info">
			<div class="pictures" style="overflow:hidden;">
				<div class="galleria-info sub_title">
					<?php the_title(); ?>
				</div>
				<div id="image-slider" style="overflow:hidden; z-index:-1000; margin-top: -80px; ">
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

								<?php }  ?></div>

								<?php }
								else if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
								the_post_thumbnail('full');
								} ?>
							</div>
			</div>
			
			<div class="share">
				<div class="email">
					<p>Ask someone out on this date</p>
					<div id="env-img"><img src="/dev/wp-content/themes/images/addons/env.png" /></div>
					<div id="share-date">
						<form id="share-this-date">
							<div class="info">Recipient's Email: <input type='text' name="recipient-email" /></div>
							<div class="info">Recipient's Name: <input type='text' name="recipient-name" /></div>
							<div class="info">Your Name: <input type="text" name="sender-name" /></div>
							
							<div class="message">Message(optional): <br/> <textarea rows="5" name="message" cols="40"> </textarea></div>
							
							<br/>
							<input type="submit" id="share-submit" value="send" class="f2p-button" />
						</form>
					</div>
				</div>
				
				<?php printAddOn(get_field('add-ons-1')); ?>
				<?php printAddOn(get_field('add-on-2')); ?>
				<?php printAddOn(get_field('add-on-3')); ?>
			</div>
		</div>
		<div style="clear:both;"></div>
		<div class="date_content">
			<div class="date_details">
				<?php if (get_the_term_list( $post->ID, 'date-type' ) != null ) { ?>	
				<div id="locations" class="item">
					<span class="image"><img src="/dev/wp-content/themes/images/leftside/type.png" /></span>
					<span class="block"><p>DATE TYPE</p> <?php echo get_the_term_list( $post->ID, 'date-type', '', ', ', '' ); ?></span>
				</div>
				<?php } ?> 
				
				<?php if (get_the_term_list( $post->ID, 'location' ) != null ) { ?>	
				<div id="location" class="item">
					<span class="image"><img src="/dev/wp-content/themes/images/leftside/location.png" /></span>
					<span class="block"><p>LOCATION</p> <?php echo get_the_term_list( $post->ID, 'location', '', ', ', '' ); ?></span>
				</div>
				<?php } ?> 
				
				<?php if (get_the_term_list( $post->ID, 'time' ) != null ) { ?>	
				<div id="time" class="item">
					<span class="image"><img src="/dev/wp-content/themes/images/leftside/time.png" /></span>
					<span class="block"><p>TIME</p> <?php echo get_the_term_list( $post->ID, 'time', '', ', ', '' ); ?></span>
				</div>
				<?php } ?>  
				
				
				
				<?php if (get_field('special_information')) { ?>	 
				<div id="spe-info" class="item">
					<span class="image"><img src="/dev/wp-content/themes/images/leftside/inf.png" /></span>
					<span class="block"><p>SPECIAL INFO</p> <p class="desc"><?php the_field('special_information'); ?></p></span>
				</div>
				<?php } ?> 
				
				<?php if (get_field('average_price_per_couple')) { ?>	 
				<div id="average-price-per-couple" class="item">
					<span class="image"><img src="/dev/wp-content/themes/images/leftside/money.png" /></span>
					<span class="block"><p>AVG PRICE PER COUPLE</p><p class="desc"><?php the_field('average_price_per_couple'); ?></p></span>
				</div>
				<?php } ?> 
				
				<?php if (get_field('what_to_wear')) { ?>	 
				<div id="what-to-wear" class="item">
					<span class="image"><img src="/dev/wp-content/themes/images/leftside/wear.png" /></span>
					<span class="block"><p>WHAT TO WEAR</p> <p class="desc"><?php the_field('what_to_wear'); ?></p></span>				
				</div>
				<?php } ?> 
				
				<div class="map">
					<p class="business_name"><?php the_field('business_name'); ?></p>
					<p class="extra_info">
						<?php the_field('extra_info'); ?>
						<br/>
						<?php the_field('mailing_address'); ?>
						<br/>
						<?php the_field('city'); ?>
						<br/>
						<?php the_field('phone_number'); ?>
						<br/>
						<a href="<?php the_field('web_address'); ?>" target="_blank" >Visit Website</a>
					</p>
					<div id="map_canvas" style="width: 200px; height: 200px; margin: 0 auto 15px auto;"></div>
				</div>
			</div>
			<div class="date_info">
				<div class="title">YOUR DATE IDEA...</div>
				<?php if(get_field('short_description')){ ?>
					<p class="short_desc"><?php the_field('short_description'); ?></p>
				<?php } ?>
				<?php the_field('why_is_this_a_great_date'); ?>
			
				<div id="word-on-street" class="quotes"><?php the_field('word_on_the_street'); ?></div>
			</div>
			
			<div class="date_package">
				<?php if(get_field('price')){ ?>
				<div id="buy-widget">
					<div id="price-descriptor">
						<div id="buy-widget-title" class="ribbon">
							<div class="info">
								<div class="name"><?php the_field('package_name'); ?></div>
								<div class="price">$<?php the_field('price'); ?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="package_info">
					<br/>
					<div id="loading">
						<img src="/dev/wp-content/themes/images/FTP-Logo-Loader-Icon-Animation-2.gif" />
					</div>
				
					<!--<div id="buy-button" class="buynow buy_btn"></div>-->
					<div id="buy-button"><input type="button" value="BUY!" class="f2p-button"/></div>
					
					<div id="buy-process" style="display:none;background-color:#231f20;min-height:450px;overflow:hidden;margin-bottom:20px;">
						<form id="buy_package_form" action="" method="post">
							<div style='background:#231f20;color:#FFF;padding: 5px 5px 5px 3px; width:330px;'>
								<div style='color:white;width:320px;height:40px;'>
									<h1 style='float:left;margin-left:0px;'>PAYMENT</h1>
									<img style='float:right;margin-top:5px;margin-bottom:10px;margin-right:20px;' src='/dev/wp-content/themes/images/step2.png' />
								</div>
	
								<div style='clear:both;'></div>
								<p style="font-size:100%; font-weight: bold;">Please confirm the full name of the person who will be using this Date Package.</p>
								<br/>
								<?php $user_data = get_user_meta(wp_get_current_user()->ID); ?>
								<div>
									<label style='float: left; padding-left:10px;'>First Name:</label>
									<input type="text" id="first_name" style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-right:20px;' name="first_name" value="<?php echo $user_data['first_name'][0]; ?>"/>
								</div>
								<div style='clear:both;'></div>
								<div>
									<label style='float: left; padding-left: 10px;'>Last Name:</label>
									<input type="text" id="last_name" style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-right:20px;' name="last_name" value="<?php echo $user_data['last_name'][0]; ?>"/>
								</div>
								<div style='clear:both;'></div>
								<br/>
								<hr/>
								<br/>
								<p style="font-size:100%; font-weight: bold;">Please enter your payment information below.</p>
								<br/>
								<div id='payment-error' style='background:#FF9;clear:both;color:red;width:300px;margin-bottom:10px;overflow:hidden;padding:5px;display:none;'></div>
								<div style='clear:both;margin-left:80px;margin-bottom:10px;float:right;margin-right:20px;'>
									Quantity:
									<select style='background-color:#CCC;'id='buy-quantity' name="quantity">
										<option value='1'>1</option>
										<option value='2'>2</option>
										<option value='3'>3</option>
										<option value='4'>4</option>
									</select>
									<span id='price'> Price: $</span>
								</div>
								<div id='price-detail' style='float:right;clear:both;height:60px;margin-right:20px;'>
									<div id='taxes'>Taxes: $</div>
									<div id='fees'>Fees: $</div>
									<div id='total_price'>Total: $</div>
									<input type="hidden" id="amount" name="amount" />
								</div>
								<div style='float:right;margin-right:20px;margin-bottom:10px;'>
									<img src='/dev/wp-content/themes/images/payments1.png'></img>
								</div>
								<div style='float:right;clear:both;margin-right:20px;'>
									<div style='height:30px;width:300px;'>
										First Name: 
										<input type='text' id='fullname' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' name="cardholder_fname" value="<?php echo $user_data['first_name'][0]; ?>"/>
									</div>
									<div style='height:30px;width:300px;'>
										Last Name: 
										<input type='text' id='fullname' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' name="cardholder_lname" value="<?php echo $user_data['last_name'][0]; ?>"/>
									</div>
									<div style='height:30px;'>
										Card Number: 
										<input type='text' id='cnumber' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' name="card_number"/>
									</div>
									<div style='height:30px;'>
										Exp. Year:
										<select style='float:right;background-color:#CCC;' id='eyear' name="exp_year">
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
									<div style='height:30px;'>
										Exp. Month:
										<select style='float:right;background-color:#CCC;' id='emonth' name="exp_month">
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
									<div style='height:30px;'>
										Security Code: 
										<input type='text' id='csv' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px; margin-bottom: 5px; float: right; margin-left: 10px; width: 35px;' name="csv"/>
									</div>
									<div style='height:30px;width:300px;'>
										Street: 
										<input type='text' id='street' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' name="street"/>
									</div>
									<div style='height:30px;width:300px;'>
										City: 
										<input type='text' id='city' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' name="city"/>
									</div>
									<div style='height:30px;width:300px;'>
										Province: 
										<input type='text' id='province' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' name="province"/>
									</div>
									<div style='height:30px;width:300px;'>
										Country: 
										<input type='text' id='country_code' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' name="country_code"/>
									</div>
									<div style='height:30px;width:300px;'>
										Postal Code: 
										<input type='text' id='postal_code' style='background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;float:right;margin-left:10px;' name="postal_code"/>
									</div>
									<div style='height:30px;'>
										<input style='float:right;clear:both;margin-right:50px;margin-bottom:10px;' type='submit' id='buy-now' name='submit' value='Checkout' class='f2p-button' />
									</div>
								</div>
								<div style='clear:both;'></div>
							</div>
						</form>
					</div> 
					
					<div id="user-ajax-login" class="blocks login_block">
						<div class="header">
							<h1>LOGIN</h1>
							<img src="/dev/wp-content/themes/images/step1.png" />
						</div>
						
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
								<img id="fb_login_btn" src="/dev/wp-content/themes/images/fb_connect.png" width="167" height="22" style="cursor:pointer;" onclick="fb_login();"/>
							</div>					
						</div>
					</div>
					
					<div id="user-ajax-register" class="blocks register_block">
						<div class="header">
							<h1>REGISTER</h1>
							<img src="/dev/wp-content/themes/images/step1.png" />
						</div>
						
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

								<input type="submit" class="f2p-button register_btn" value="SignUp" name="submit" id="submitbtn2" />
							</form> 
						</div>  
					</div>
					
					<div id="forgot-pass" class="tab_content_login blocks forgot_pass_block">
						<div class="forgot_pass_info">
							<h3>Lost something?</h3>
							<p>Enter your username or email to reset your password.</p>
							<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
								<div class="username">
									<label for="user_login" class="hide"><?php _e('Username or Email'); ?>: </label>
									<input type="text" style="background-color: rgb(204, 204, 204); border: medium none; height: 20px;margin-bottom:5px;" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
								</div>
								<div style="clear: both;"></div>
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
					
					<div id="price-descriptor" class="member"><div class="descriptor"><?php the_field('price_descriptor'); ?></div></div>	
					<div class="desc">
						<?php the_field('package_description'); ?>
						<div><?php the_field('fine_print'); ?> </div>
					</div>
				</div>
        
				<?php } else { ?>
					<div id="more-deals" class="more_deals"></div>
					
					
				<?php } ?>
				
				<div style="clear: both;"></div>
			</div>
		</div>
		
		<div style="clear:both;"></div>
	</div>
</div>

</article>
