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



// Add package redemption report
add_action('admin_menu', 'reporting_system');
function reporting_system() {
	add_submenu_page( 'salereport', 'Reporting System', 'Reporting System', 'administrator', 'reporting-system', 'package_report_page');
}

function package_report_page() {
	
	echo "<h1>Package Redemption Report</h1>";
	
	$data = get_data_for_redemption_report();

	foreach ($data as $month_name => $month_data) {
		echo "<h2>" . $month_name . "</h2>";
		echo "<table border='1'>";
		echo "<tr><th>Package ID</th><th>Business</th><th>Date Package</th><th>Number Redeemed</th><th>Price per Package</th><th>Merchant Payout %</th><th>Total Payout</th></tr>";
		
		foreach ($month_data as $package_id => $package_data) {
			echo '<tr>';
			echo '<td>' . $package_id . '</td>';
			echo "<td>" . $package_data['business_name'] ."</td>";
			echo "<td>" . $package_data['package_name'] . "</td>";
			echo "<td>" . $package_data['number_vouchers_redeemed'] . "</td>";
			echo "<td>" . $package_data['price_per_package'] . "</td>";
			echo "<td>" . $package_data['merchant_payout_percent'] . "</td>";
			$total_payout = $package_data['merchant_payout_percent'] * $package_data['number_vouchers_redeemed'] * $package_data['price_per_package'] / 100;
			echo "<td>" . $total_payout . "</td>";
			echo '</tr>';
		}

		echo "</table>";
	}
	
}

function get_data_for_redemption_report() {
	$args['role'] = 'merchant';
	$users = get_users( $args );
	
	$data = array();
	$month_arr = array (
	    1 => 'Jan',
	    2 => 'Feb',
	    3 => 'Mar',
	    4 => 'Apr',
	    5 => 'May',
	    6 => 'Jun',
	    7 => 'Jul',
	    8 => 'Aug',
	    9 => 'Sep',
	    10 => 'Oct',
	    11 => 'Nov',
	    12 => 'Dec'
	);
	// Retrieve all merchant IDs
	foreach ($users as $user) {

		// Retrieve all package IDs for this merchant
		$packages = get_user_meta($user->ID, 'pckg', false);
		foreach ($packages as $package) {
			$number_vouchers_redeemed = 0;
			$post_info = get_post_meta($package);
			$business_name = $post_info['business_name'][0];
			$package_name = $post_info['package_name'][0];
			$price_per_package = $post_info['price'][0];
			$commission = $post_info['commission'][0];
			$merchant_payout_percent = 0;
			if ($commission != '') { 
				$merchant_payout_percent = 100 - intval($post_info['commission'][0]);
			}
			

			// Here pid is the voucher ID. Not sure how voucher ID is retrieved from this query, but it is. 
			$p_ids = get_user_meta($user->ID, $package, false);
			foreach ($p_ids as $p_id) {
				foreach(get_user_meta($user->ID, $p_id.'_redeemded_date', false) as $redeemded_date) {
					if ($redeemded_date != '') {
						$date = date_parse_from_format(DATE_RFC822, $redeemded_date);
						$current_month = $month_arr[$date["month"]] . " " . $date["year"];
						// Check if there is any data for that month. Then check if there is data about this package during this month.
						if ($data[$current_month]) {
							$month_data = $data[$current_month];
							if (array_key_exists($package, $month_data)) {
								// There is data about this date in this month already. Modify it. 
								$package_data = $month_data[$package];
								$package_data['number_vouchers_redeemed'] += 1;
								$month_data[$package] = $package_data;
								$data[$current_month] = $month_data;
							} else {
								// There is data about this month, but no data about this package in this month.
								$number_vouchers_redeemed = 1;
								$package_data = array('package_id' => $package, 'business_name' => $business_name, 'package_name' => $package_name, 'number_vouchers_redeemed' => $number_vouchers_redeemed, 'price_per_package' => $price_per_package, 'merchant_payout_percent' => $merchant_payout_percent);
								$month_data[$package] = $package_data;
								$data[$current_month] = $month_data;
							}
							
						} else {
							// Each month has data about a set of packages
							$month_data = array();
							// Each package is an array of data such as business name, package name and number of vouchers sold for that package.
							$number_vouchers_redeemed = 1;
							$package_data = array('package_id' => $package, 'business_name' => $business_name, 'package_name' => $package_name, 'number_vouchers_redeemed' => $number_vouchers_redeemed, 'price_per_package' => $price_per_package, 'merchant_payout_percent' => $merchant_payout_percent);
							$month_data[$package] = $package_data;
							$data[$current_month] = $month_data;
						}
					}
				}
			}
		}
	}
	return $data;
}


// Add inventory report to show total number of date packages sold and available. 
add_action('admin_menu', 'inventory_report');
function inventory_report() {
	add_submenu_page( 'salereport', 'Inventory Report', 'Inventory Report', 'administrator', 'inventory-report', 'inventory_report_page');
}

function inventory_report_page() {
	
	echo "<h1>Inventory Report</h1>";
	
	$data = get_data_for_inventory_report();

	echo "<table border='1'>";
	echo "<tr><th>Package ID</th><th>Business</th><th>Date Package</th><th>Number Sold</th><th>Number Redeemed</th><th>Number Available</th><th>Expiry Date</th><th>Total Sales ($)</th><th>Total Revenue ($)</th></tr>";

	foreach ($data as $package => $package_data) {
		echo '<tr>';
		echo '<td>' . $package . '</td>';
		echo "<td>" . $package_data['business_name'] ."</td>";
		echo "<td>" . $package_data['package_name'] . "</td>";
		echo "<td>" . $package_data['number_vouchers_sold'] . "</td>";
		echo "<td>" . $package_data['number_vouchers_redeemed'] . "</td>";
		echo "<td>" . $package_data['number_vouchers_available'] . "</td>";
		echo "<td>" . $package_data['expiry_date'] . "</td>";
		echo "<td>" . $package_data['total_sales'] . "</td>";
		echo "<td>" . $package_data['total_revenue'] . "</td>";
		echo '</tr>';
	}
	echo "</table>";
	
}

function get_data_for_inventory_report() {

	$args['role'] = 'merchant';
	$users = get_users( $args );

	// Retrieve all merchant IDs
	foreach ($users as $user) {

		// Retrieve all package IDs for this merchant
		$packages = get_user_meta($user->ID, 'pckg', false);
		foreach ($packages as $package) {
			$number_vouchers_sold = 0;
			$number_vouchers_redeemed = 0;
			$post_info = get_post_meta($package);
			$business_name = $post_info['business_name'][0];
			$package_name = $post_info['package_name'][0];
			$price_per_package = $post_info['price'][0];
			$commission = $post_info['commission'][0];
			$expiry_date = $post_info['expiration_date_package'][0];
			$merchant_payout_percent = 0;
			if ($commission != '') { 
				$merchant_payout_percent = 100 - intval($post_info['commission'][0]);
			}

			// Here pid is the voucher ID. Not sure how voucher ID is retrieved from this query, but it is. 
			$p_ids = get_user_meta($user->ID, $package, false);
			foreach ($p_ids as $p_id) {
				$number_vouchers_sold ++;
				foreach(get_user_meta($user->ID, $p_id.'_redeemded_date', false) as $redeemded_date) {
					if ($redeemded_date != '') {
						$number_vouchers_redeemed ++;
					}
				}
			}
			$total_sales = $number_vouchers_sold * $price_per_package;
			$total_revenue = $total_sales * $commission / 100;
			$number_vouchers_available = intval($number_vouchers_sold) - intval($number_vouchers_redeemed);
			$package_data = array('package_id' => $package, 'business_name' => $business_name, 'package_name' => $package_name, 'number_vouchers_redeemed' => $number_vouchers_redeemed, 'number_vouchers_sold' => $number_vouchers_sold, 'number_vouchers_available' => $number_vouchers_available, 'expiry_date' => $expiry_date, 'total_sales' => $total_sales, 'total_revenue' => $total_revenue);
			$data[$package] = $package_data;
		}
	}
	return $data;
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

