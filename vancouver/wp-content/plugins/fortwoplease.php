<?php
/*
Plugin Name: ForTwoPlease Plugin
Plugin URI: http://fortwoplease.com
Description: This plugin is the real deal
Version: 0.1
Author: Amin Moshgabadi
Author URI: http://www.aminmoshgabadi.com
*/

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'f2p_post_meta' );
	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'f2p_save_meta', 10, 2 );
	add_action( 'save_post', 'f2p_save_meta_header', 10, 2 );

/* Create one or more meta boxes to be displayed on the post editor screen. */
function f2p_post_meta() {

	add_meta_box(
		'f2p-neighbourhoods',			// Unique ID
		esc_html__( 'Neighbourhood', 'f2p-location' ),		// Title
		'neighbourhoods_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',					// Context
		'default'					// Priority
	);
	add_meta_box(
		'f2p-header',			// Unique ID
		esc_html__( 'Main Header', 'f2p-location' ),		// Title
		'header_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'normal',					// Context
		'default'					// Priority
	);
}


function header_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'f2p-header-class_nonce' ); ?>

	<p>
		<input type="text" name="f2p-header-class" id="f2p-header-class" value="<?php echo esc_attr( get_post_meta( $object->ID, 'f2p-header-class', true ) ); ?>" size="300" />
	</p>
	
<?php }


/* Display the post meta box. */
function neighbourhoods_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'f2p_neighbourhood_class_nonce' ); ?>

	<p>
		
		<label for="f2p_neighbourhood_class"><?php echo ("Choose a neighbourhood for this date");  ?></label>
		
		<br />
		<select name="f2p_neighbourhood_class" id="f2p_neighbourhood_class" >
	<option value="downtown" <?php if(esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="downtown"){echo "selected='selected'";} ?> >Downtown</option>
	<option value="east-vancouver" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="east-vancouver"){echo "selected='selected'";} ?>>East Vancouver</option>
	<option value="fairview-broadway" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="fairview-broadway"){echo "selected='selected'";} ?>>Fairview-Broadway</option>
	<option value="kitsilano" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="kitsilano"){echo "selected='selected'";} ?>>Kitsilano</option>
	<option value="Mount-Pleasant-Main" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="Mount-Pleasant-Main"){echo "selected='selected'";} ?>>Mount Pleasant - Main st</option>
	<option value="north-vancouver" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="north-vancouver"){echo "selected='selected'";} ?>>North Vancouver</option>
	<option value="south-cambie" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="south-cambie"){echo "selected='selected'";} ?>>South Cambie</option>
	<option value="south-granville" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="south-granville"){echo "selected='selected'";} ?>>South Granville</option>
	<option value="south-vancouver" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="South Vancouver"){echo "selected='selected'";} ?>>South Vancouver</option>
	<option value="west-end" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="west-end"){echo "selected='selected'";} ?>>West End</option>
	<option value="west-vancouver" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="west-vancouver"){echo "selected='selected'";} ?>>West Vancouver</option>
	<option value="yale-town" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="yale-town"){echo "selected='selected'";} ?>>Yale Town</option>
	<option value="whistler-squamish" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="whitsler-squamish"){echo "selected='selected'";} ?>>Whistler & Squamish</option>
	<option value="vancouver-island" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="vancouver-island"){echo "selected='selected'";} ?>>Vancouver Island</option>
	<option value="other" <?php if( esc_attr( get_post_meta( $object->ID, 'f2p_neighbourhood_class', true ) )=="other"){echo "selected='selected'";} ?>>Other</option>
	
	
	
	</select>
	</p>
<?php }

/* Save the meta box's post metadata. */
function f2p_save_meta_header( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['f2p-header-class_nonce'] ) || !wp_verify_nonce( $_POST['f2p-header-class_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['f2p-header-class'] ) ? sanitize_html_class( $_POST['f2p-header-class'] ) : '' );


	/* Get the meta key. */
	$meta_key = 'f2p-header-class';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}

function f2p_save_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['f2p_neighbourhood_class_nonce'] ) || !wp_verify_nonce( $_POST['f2p_neighbourhood_class_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['f2p_neighbourhood_class'] ) ? sanitize_html_class( $_POST['f2p_neighbourhood_class'] ) : '' );


	/* Get the meta key. */
	$meta_key = 'f2p_neighbourhood_class';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}
?>