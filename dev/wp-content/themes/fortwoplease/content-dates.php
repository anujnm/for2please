<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/content-dates.css" />
<script src="<?php echo home_url(); ?>/slider/galleria-1.2.6.js" type="text/javascript" charset="utf-8-without-bom"></script>
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
<script src="/js/f2p-dates.js" type="text/javascript" charset="utf-8-without-bom"></script>
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
			<?php
			if (strlen(get_field('sub_title')) > 45) {
				$title_class = 'title-small';
			} else {
				$title_class = 'title';
			}?>
			<div class="<?php echo $title_class;?>"><?php the_field('sub_title'); ?></div>
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
							<img src=<?php $image_1 = get_field('image_1');
							echo $image_1;?>>
							<?php $image_2 = get_field('image_2');
							if (isset($image_2)){?>
								<img src=<?php echo $image_2; ?>>
							<?php }
							$image_3 = get_field('image_3');
							if(isset($image_3)){?>
								<img src=<?php echo $image_3; ?>>
							<?php }
							$image_4 = get_field('image_4');
							if(isset($image_4)){?>
								<img src=<?php echo $image_4; ?>>
							<?php }
							$image_5 = get_field('image_5');
							if(isset($image_4)){?>
								<img src=<?php echo $image_5; ?>>
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
					<?php echo really_simple_share_publish($link='', $title=''); ?>
				</div>
				<div style="clear: both;"></div>
				<div class="title">
						Another Great Date Idea...
				</div>
				<?php if(get_field('short_description')){ ?>
					<p class="short_desc"><?php the_field('short_description'); ?></p>
				<?php } ?>
				<div class="why"><?php the_field('why_is_this_a_great_date'); ?></div>
				<?php if(get_field('word_on_the_street') && trim(get_field('word_on_the_street') != '')) { ?>
					<div id="word-on-street" class="quotes"><?php the_field('word_on_the_street'); ?></div>
				<?php } ?>
			</div>
		</div>
		<div class="date_content">
			<div class="date_package">
				<!-- FTP Sidebar Ads 2 -->
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
