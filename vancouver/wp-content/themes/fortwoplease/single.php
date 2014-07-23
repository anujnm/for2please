<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

<!-- Testing FTP Ads -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>


		<div id="primary">
			<div id="content" role="main">
                <ins class="adsbygoogle"
                     style="display:inline-block;width:728px;height:90px;padding-bottom:50px;padding-left:150px;"
                     data-ad-client="ca-pub-4081693765901599"
                     data-ad-slot="6672957644"></ins>
				<?php while ( have_posts() ) : the_post(); ?>		

					<?php get_template_part( 'content', get_post_type() ); ?>


				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php get_footer(); ?>
