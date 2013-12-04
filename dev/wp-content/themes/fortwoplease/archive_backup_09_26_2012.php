<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div style="margin-right:auto;margin-left:auto;width:1020px;background-color:white;min-height:800px;over-flow:hidden;padding:10px;text-align:left;">
        <a href="#" id="go-back"> Go Back </a>
        
			<h1 style="text-align:left;margin-bottom:20px;"><?php echo single_cat_title(); ?> Dates </h1>
            
			<?php if ( have_posts() ) : 

				
				while ( have_posts() ) : the_post(); 
				
				$itemPermalink = get_permalink($id);
				$datetypes = get_the_term_list( $id, 'date-type', '', ', ', '' );
				echo "<div id='";
				echo $id;
				echo "' class='testsearch' style='background:url(";
				echo get_field('thumbnail',$id);
				echo");height:235px;width:330px;margin-bottom:30px;float:left;margin-right:10px;box-shadow:2px 2px 5px #888;position:relative;'>";
				if(stristr(strip_tags($datetypes),'Packages') !== FALSE)
				{
				echo '<div style="position:relative;left:-125px;top:5px;z-index:2;position:absolute;top:0;left:0;"><img src="/dev/wp-content/themes/images/get-it-here.png"></div>';
				}
				echo "<div style='height:200px;width:330px;'>";
				echo "<div id='searchtest' class='testsearch2'>";
				echo "<div class='result-type' style='width:240px;text-align:right;'>";
				if (!empty($datetypes)) echo '<p style="color:#F07323">', strip_tags($datetypes) ,'</p>';
				echo "</div><div style='position: relative;  text-align: left; left: 20px; overflow: hidden; width: 305px; height: 140px;clear:both;'><a 								style='color:#FFF;font-size:18px;font-weight:700;text-decoration:none;' href='";
				echo $itemPermalink;
				echo "'>";
				echo get_the_title($id);
				echo "</a><br/>";
				$terms_as_text = get_the_term_list( $id, 'location', '', ', ', '' );
				if (!empty($terms_as_text)) echo '<p style="color:#FFF;">', strip_tags($terms_as_text) ,'</p>';
				echo "<br/><p style='color:white;width:300px;'>";
				echo showBrief(get_field('short_description',$id),20 ); 
				echo "...</p><a style='float:right;margin-right:10px;text-decoration:none;' href='";
				echo $itemPermalink;
				echo "'>Read More...</a></div></div></div>";
				echo "<div class='overlay'><h3><a href='";
				echo $itemPermalink;
				echo "'>";
				echo the_field('sub_title',$id);
				echo "</a></h3></div></div>";
				
                
				
				endwhile;

			endif; ?>

			</div><!-- #content -->
            
            <script type="text/javascript">
			jQuery(".testsearch").live("mouseenter",function(){jQuery("div.testsearch2",this).fadeIn('fast');});
jQuery(".testsearch").live("mouseleave",function(){jQuery("div.testsearch2",this).fadeOut('fast');});

	jQuery("#go-back").click(function(e){
		e.preventDefault();
		history.go(-1);
	});
			</script>
	

<?php get_footer(); ?>