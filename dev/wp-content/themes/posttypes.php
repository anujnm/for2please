<?php


// Add new post type for Dates
add_action('init', 'dates_init');
function dates_init()
{
	$date_labels = array(
		'name' => _x('Dates', 'post type general name'),
		'singular_name' => _x('Date', 'post type singular name'),
		'all_items' => __('All Dates'),
		'add_new' => _x('Add new Date', 'Dates'),
		'add_new_item' => __('Add new Date'),
		'edit_item' => __('Edit Date'),
		'new_item' => __('New Date'),
		'view_item' => __('View Date'),
		'search_items' => __('Search in Dates'),
		'not_found' =>  __('No Dates found'),
		'not_found_in_trash' => __('No Dates found in trash'),
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $date_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
		'has_archive' => 'dates'
	);
	register_post_type('dates',$args);
}

?>
<?php
// Add new Custom Post Type icons

add_action( 'admin_head', 'cooking_icons' );
function cooking_icons() {
?>
	<style type="text/css" media="screen">
		#menu-posts-dates .wp-menu-image {
			background: url(<?php bloginfo('url') ?>/wp-content/themes/images/datesmall.png) no-repeat 6px !important;
		}
		#menu-posts-dates:hover div.wp-menu-image,#adminmenu #menu-posts-gallery.wp-has-current-submenu div.wp-menu-image{
			background: url(<?php bloginfo('url') ?>/wp-content/themes/images/datesmalle.png) no-repeat 6px !important;
		}
		.icon32-posts-dates {
			background: url(<?php bloginfo('url') ?>/wp-content/themes/images/datelarge.png) no-repeat !important;
		}

    </style>
<?php }

add_action( 'init', 'type_create_taxonomies', 0 );

function type_create_taxonomies()
{
	// Date type
	$type_labels = array(
		'name' => _x( 'Date Type', 'taxonomy general name' ),
		'singular_name' => _x( 'Date type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search by date type' ),
		'all_items' => __( 'All date types' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit date type' ),
		'update_item' => __( 'Update date type' ),
		'add_new_item' => __( 'Add new date type' ),
		'new_item_name' => __( 'New date type' ),
		'menu_name' => __( 'Date Type' ),
	);
		register_taxonomy('date-type',array('dates'),array(
		'hierarchical' => true,
		'labels' => $type_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'date-type' )
	));
}

add_action( 'init', 'location_create_taxonomies', 0 );

function location_create_taxonomies()
{
	// Date Location
	$location_labels = array(
		'name' => _x( 'Location', 'taxonomy general name' ),
		'singular_name' => _x( 'Location', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search by Location' ),
		'all_items' => __( 'All date Locations' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Location' ),
		'update_item' => __( 'Update Location' ),
		'add_new_item' => __( 'Add new Location' ),
		'new_item_name' => __( 'New Location' ),
		'menu_name' => __( 'Location' ),
	);
		register_taxonomy('location',array('dates'),array(
		'hierarchical' => true,
		'labels' => $location_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'location' )
	));
}

add_action( 'init', 'city_create_taxonomies', 0 );

function city_create_taxonomies()
{
	// Date Location
	$city_labels = array(
		'name' => _x( 'Cities', 'taxonomy general name' ),
		'singular_name' => _x( 'City', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search by City' ),
		'all_items' => __( 'All Cities' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit City' ),
		'update_item' => __( 'Update City' ),
		'add_new_item' => __( 'Add new City' ),
		'new_item_name' => __( 'New City' ),
		'menu_name' => __( 'City' ),
	);
		register_taxonomy('city',array('dates'),array(
		'hierarchical' => true,
		'labels' => $city_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'city' )
	));
}

add_action( 'init', 'time_create_taxonomies', 0 );

function time_create_taxonomies()
{
	// Date Time
	$time_labels = array(
		'name' => _x( 'Time', 'taxonomy general name' ),
		'singular_name' => _x( 'Time', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search by Time' ),
		'all_items' => __( 'All Times' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Time' ),
		'update_item' => __( 'Update Time' ),
		'add_new_item' => __( 'Add new Time' ),
		'new_item_name' => __( 'New Time' ),
		'menu_name' => __( 'Time' ),
	);
		register_taxonomy('time',array('dates'),array(
		'hierarchical' => true,
		'labels' => $time_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'time' )
	));
}

add_action( 'init', 'price_create_taxonomies', 0 );

function price_create_taxonomies()
{
	// Price Range
	$price_labels = array(
		'name' => _x( 'Price', 'taxonomy general name' ),
		'singular_name' => _x( 'Price', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search by Price Range' ),
		'all_items' => __( 'All Price Ranges' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Price Range' ),
		'update_item' => __( 'Update Price Range' ),
		'add_new_item' => __( 'Add new Price Range' ),
		'new_item_name' => __( 'New Price Range' ),
		'menu_name' => __( 'Price Range' ),
	);
		register_taxonomy('price',array('dates'),array(
		'hierarchical' => true,
		'labels' => $price_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'price' )
	));
}


// Add idea submission report
 add_action('admin_menu', 'idea_submission_init');

 function idea_submission_init() {
 	add_menu_page('Idea Submission Report', 'Idea Submission Report', 'administrator', 'idea_submission_report', 'idea_report', '/wp-content/themes/images/datesmalle.png', 10);
 }

 function idea_report() {
	echo '<div class="wrap"><h2>Date Idea Submission Report</h2>';
	$args = array('hide_empty' => false);
 	$city_list = get_terms('city', $args);
	if (sizeof($city_list) == 0) {
		echo 'Sorry, there are no new Date Idea Submissions pending. ';
		return;
	}
	echo '<table class="wp-list-table widefat fixed posts" cellspacing="0">';
	echo '<thead><tr><th class="manage-column column-columnname" scope="col">City</th><th class="manage-column column-columnname" scope="col">Business</th><th class="manage-column column-columnname" scope="col">Date Title</th><th class="manage-column column-columnname" scope="col">Date Added</th></tr></thead>';
	echo '<tbody>';
	$counter = 1;
  foreach ($city_list as $city) {
		$args = array('post_status' => 'draft',
							'post_type' => 'dates',
							'posts_per_page' => 10,
							'tax_query' => array(
								array(
									'taxonomy' => 'city',
									'field' => 'slug',
									'terms' => $city->name
								))
							);
		$city_dates = get_posts($args);
		if (sizeof($city_dates) > 0) {
			foreach ($city_dates as $date) {
				if ($counter % 2 == 1) {
					echo '<tr class="alternate">';
				} else {
					echo '<tr>';
				}
				echo '<td class="column-columnname">' . $city->name .'</td>';
				echo '<td class="column-columnname"><a href=\'' . BASE_URL . 'wp-admin/post.php?post=' . $date->ID . '&action=edit\'>' . $date->post_title . '</a></td>';
				echo '<td class="column-columnname"><a href=\'' . BASE_URL . 'wp-admin/post.php?post=' . $date->ID . '&action=edit\'>' . get_post_custom_values('sub_title', $date->ID)[0] . '</a></td>';
				echo '<td class="column-columnname">' . $date->post_date . '</td>';
				echo '</tr>';
				$counter++;
			}
		}
	}
	echo '</tbody>';
	echo '<tfoot><tr><th class="manage-column column-columnname" scope="col">City</th><th class="manage-column column-columnname" scope="col">Business</th><th class="manage-column column-columnname" scope="col">Date Title</th><th class="manage-column column-columnname" scope="col">Date Added</th></tr></tfoot>';
	echo '</table></div>';
}
