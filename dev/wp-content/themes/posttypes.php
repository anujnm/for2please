<?php


//Add sals report tab
add_action('init', 'sales_init');
function sales_init()
{
	add_menu_page('Sales Report', 'Sales Report', 'administrator' , 'salereport','sales_report_page','/dev/wp-content/themes/images/datesmalle.png',6);
}

function sales_report_page(){
  foreach (get_user_meta(1, 'sold',false) as $values){
  echo $values;
  echo '<br/>';
  }
}




add_action('admin_menu', 'reporting_system');
function reporting_system() {
	add_submenu_page( 'salereport', 'Reporting System', 'Reporting System', 'administrator', 'reporting-system', 'package_report_page');
}

function package_report_page() {
	echo "<h1>Reporting System</h1>";
	echo "<table border='1'>";
	echo "<tr><th>Business</th><th>Date Package</th><th>Date Redeemed</th></tr>";
	
	
	$args['role'] = 'merchant';
	$users = get_users( $args );
	
	
	foreach ($users as $user) {
		// echo $user -> user_login . ", id: " . $user->ID;
		// echo "<br/>";
		$packages = get_user_meta($user->ID, 'pckg', false);
		foreach ($packages as $package) {
			// echo $package . '<br/>';
			$p_ids = get_user_meta($user->ID, $package, false);
			foreach ($p_ids as $p_id) {
				// echo $p_id . '<br/>';
				foreach(get_user_meta($user->ID, $p_id.'_redeemded_date', false) as $redeemded_date) {
					if ($redeemded_date != '') {
						$post_info = get_post_meta($package);
						// error_log (print_r($post_info));
						// echo $post_info['sub_title'][0] ."<br/>";
						echo "<tr>";
						echo "<td>" . $post_info['business_name'][0] ."</td>";
						echo "<td>" . $post_info['package_name'][0] ."</td>";
						echo "<td>" . $redeemded_date . "</td>";
						// echo "<td>" . $post_info['price'][0] ."</td>";
						echo "</tr>";
					}
				}
			}
				
			// echo "<br/>";
		}
		// echo "<hr/>";
	}
	
	echo "</table>";
	
	/*
	$packages = get_user_meta(1, 'sold', false);
	foreach ($packages as $package){
		echo $values;
		echo '<br/>';
	}
	*/
}




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

