<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$args = array('hide_empty' => true);
$city_list = get_terms('city', $args);
$current_city = wp_get_post_terms(get_the_ID(), 'city')[0];
$GLOBALS['current_city'] = $current_city->name;
setcookie('f2p-city', $GLOBALS['current_city'], time()+3600*24*365);
get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_type() ); ?>


				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
