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
<!-- Testing FTP Ads -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<div style="margin: 0 auto; width:1040px; background-color:white; over-flow:hidden; padding:10px; text-align:left; text-align:center; box-shadow: 1px 40px 30px 4px #333; border-bottom: 30px solid black;">
	<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px;padding-bottom:50px;"
     data-ad-client="ca-pub-4081693765901599"
     data-ad-slot="6672957644"></ins>
	<div style="border-bottom: 2px dashed #F07323; width: 1020px; margin: 0 auto;"></div>
	<?php if (strcmp(single_cat_title("", false), "Packages") == 0) {?>
		<h1 style="margin: -17px auto 20px auto; text-align:center; text-transform:uppercase; color: #f07422; background-color:white; width: 645px;">Date <?php echo single_cat_title(); ?> Around Your City</h1>
	<?php } else {?>
		<h1 style="margin: -17px auto 20px auto; text-align:center; text-transform:uppercase; color: #f07422; background-color:white; width: 730px;"><?php echo single_cat_title(); ?> Date Ideas Around Your City</h1>
	<?php }?>
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			$itemPermalink = get_permalink($id);
			$datetypes = get_the_term_list( $id, 'date-type', '', ', ', '' );
			echo "<div id='";
			echo $id;
			echo "' onclick='location.href=\"$itemPermalink\";' class='testsearch date-container' style='background:url(";
			echo get_field('thumbnail',$id);
			echo");height:235px;width:330px; float:left;margin: 0 8px 30px 8px;box-shadow:2px 2px 5px #888;position:relative;'>";
			if(stristr(strip_tags($datetypes),'Packages') !== FALSE) {
				// echo '<div style="position:relative;left:-125px;top:5px;z-index:2;position:absolute;top:0;left:0;"><img src="/date-ideas/wp-content/themes/images/get-it-here.png"></div>';
				echo '<div style="position:relative;left:-125px;top:5px;z-index:2;position:absolute;top:0;left:0;"><img src="/date-ideas/wp-content/themes/images/get-it-here.png"></div>';
			}
			echo "<div style='height:200px;width:330px;'>";
			echo "<div id='searchtest' class='testsearch2'>";
			echo "<div class='result-type' style='width:240px;text-align:right;'>";
			if (!empty($datetypes)) {
				echo "<p style='color:#F07323'><a style='text-decoration:none;' href='". $itemPermalink . "'>", strip_tags($datetypes), "</a></p>";
			}
			echo "</div><div style='position: relative;  text-align: left; left: 20px; overflow: hidden; width: 305px; height: 140px;clear:both;'>";
			echo "<a style='color:#FFF;font-size:18px;font-weight:700;text-decoration:none;' href='";
			echo $itemPermalink;
			echo "'>";
			echo get_the_title($id);
			echo "</a><br/>";
			$terms_as_text = get_the_term_list( $id, 'location', '', ', ', '' );
			if (!empty($terms_as_text)) echo '<p style="color:#FFF;"><a style="color:#FFF;text-decoration:none;" href="'. $itemPermalink .'">', strip_tags($terms_as_text) ,'</a></p>';
			echo "<br/><p style='color:white;width:300px;'><a style='color:#FFF;text-decoration:none;' href='";
			echo $itemPermalink."'>";
			echo showBrief(get_field('short_description',$id),20 );
			echo "...</a></p><a style='float:right;margin-right:10px;text-decoration:none;' href='";
			echo $itemPermalink;
			echo "'>Read More...</a></div></div></div>";
			echo "<div class='overlay'><h3><a href='";
			echo $itemPermalink;
			echo "'>";
			echo the_field('sub_title',$id);
			echo "</a></h3></div></div>";
		endwhile;
	endif;
	?>
	<div style="clear: both;"></div>
</div><!-- #content -->
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<script type="text/javascript">
jQuery(".testsearch").live("mouseenter",function(){jQuery("div.testsearch2",this).fadeIn('fast');});
jQuery(".testsearch").live("mouseleave",function(){jQuery("div.testsearch2",this).fadeOut('fast');});

$('.date-container').hover(
	function(e) {
		var label = 'date-' + this.id + '-container-link';
		ga('send', 'event', 'link', 'hover-in', label, 1);
	}, function(e) {
		var label = 'date-' + this.id + '-container-link';
		ga('send', 'event', 'link', 'hover-out', label, 1);
	});

$('.date-container').click(function(e) {
	var label = 'date-' + this.id + '-container-link';
	ga('send', 'event', 'link', 'click', label, 1);
});

jQuery("#go-back").click(function(e){
e.preventDefault();
history.go(-1);
});
</script>


<?php get_footer(); ?>
