<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/content-dates.css" />
<script src="<?php echo home_url(); ?>/slider/galleria-1.2.6.js" type="text/javascript" charset="utf-8"></script>
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
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script src="/js/f2p-dates.js" type="text/javascript" charset="utf-8"></script>
<!-- <script src="https://maps.google.com/maps?file=api&v=2&key=AIzaSyDLEOimOjJBjY5kPHxkRcSAfihslNNOUAI&sensor=false" type="text/javascript"></script> -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<div id="nav-links" class="nav_links">
	<div id="previous_page_link"></div>
	<div id="next_page_link"></div>
</div>

<div style="display:none;"><img src="/wp-content/themes/images/get-it-normal.png" /><img src="/wp-content/themes/images/get-t-hover.png"  /><img src="/wp-content/themes/images/get-it-pressed.png"  /></div>
<div class="date-content">


<article id="date-<?php the_ID(); ?>">

<div class="center_content">
	<div class="content_block">
		<div class="content_header">
			<div class="title"><?php the_field('sub_title'); ?></div>
				<div class="package_title">DATE IDEA</div>
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
			<div class="date_info">
				<div class="links">
					<div style="width: 140px;">
					<?php
						$uri = $_SERVER["REQUEST_URI"];
						$uri = substr($uri, 13);
						#get_permalink( $post->ID );
						//$uri = "http://fortwoplease.com".$uri;
						$uri = "http://fortwoplease.com/vancouver".$uri;
						// echo $uri."<br/>";
						echo '<div class="fb-like" data-href="'.$uri.'" data-send="false" data-layout="button_count" data-show-faces="false" data-action="recommend" data-font="verdana"></div>';
					?>
					</div>

					<div style="width: 90px;">
					<a href="<?php echo $uri ?>" class="twitter-share-button" url="http://twitter.com/share?url=<?php echo $uri ?>" data-counturl="<?php echo $uri ?>">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
					<div style="width: 70px;"><img src="/wp-content/themes/images/email_btn.png" width="60" height="22" style="cursor:pointer;" onclick="jQuery('#share-date').lightbox_me({centered: true,});"/></div>
					<div style="width: 65px;"><a href="http://pinterest.com/pin/create/button/?url=<?php echo current_page_url(); ?>&media=<?php the_field('image_1'); ?>&description=this%20is%20the%20description" class="pin-it-button" count-layout="vertical"><img border="0" src="/wp-content/themes/images/pinit.png" title="Pin It" /></a></div>

				</div>
				<div style="clear: both;"></div>
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

				<div class="title">
						THE DATE IDEA...
				</div>
				<?php if(get_field('short_description')){ ?>
					<p class="short_desc"><?php the_field('short_description'); ?></p>
				<?php } ?>
				<div class="why"><?php the_field('why_is_this_a_great_date'); ?></div>

				<div id="word-on-street" class="quotes"><?php the_field('word_on_the_street'); ?></div>
			</div>
		</div>
		<div class="date_content">
			<div class="date_package">
				<!-- FTP Sidebar Ads 2 -->
				<ins class="adsbygoogle"
				     style="display:inline-block;width:300px;height:250px;padding-top:50px;padding-bottom:110px;padding-left:18px;"
				     data-ad-client="ca-pub-4081693765901599"
				     data-ad-slot="7853482845"></ins>

				<div style="clear: both;"></div>
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
						<a href="<?php the_field('web_address'); ?>" target="_blank" >Visit Website</a>
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
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
