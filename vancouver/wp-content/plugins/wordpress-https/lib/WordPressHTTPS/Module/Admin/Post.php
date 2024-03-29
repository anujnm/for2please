<?php 
/**
 * Admin Post Module
 * 
 * Adds settings to the edit post screen.
 *
 * @author Mike Ems
 * @package WordPressHTTPS
 * 
 */

require_once('Mvied/Module.php');
require_once('Mvied/Module/Interface.php');

class WordPressHTTPS_Module_Admin_Post extends Mvied_Module implements Mvied_Module_Interface {

	/**
	 * Initialize Module 
	 *
	 * @param none
	 * @return void
	 */
	public function init() {
		// Save custom post data
		add_action('save_post', array(&$this, 'post_save'));
		// Add Force SSL checkbox to edit post screen
		add_action('add_meta_boxes', array(&$this, 'add_meta_box_post'));
	}

	/**
	 * Adds HTTPS Settings meta box to post edit screen.
	 * WordPress Hook - add_meta_boxes 
	 *
	 * @param none
	 * @return void
	 */
	public function add_meta_box_post() {
		add_meta_box(
			$this->getPlugin()->getSlug(),
			__( 'HTTPS', $this->getPlugin()->getSlug() ),
			array($this->getPlugin()->getModule('Admin'), 'meta_box_render'),
			'post',
			'side',
			'high',
			array( 'metabox' => 'post' )
		);
		add_meta_box(
			$this->getPlugin()->getSlug(),
			__( 'HTTPS', $this->getPlugin()->getSlug() ),
			array($this->getPlugin()->getModule('Admin'), 'meta_box_render'),
			'page',
			'side',
			'high',
			array( 'metabox' => 'post' )
		);
	}

	/**
	 * Save Force SSL option to post or page
	 *
	 * @param int $post_id
	 * @return int $post_id
	 */
	public function post_save( $post_id ) {
		if ( array_key_exists($this->getPlugin()->getSlug(), $_POST) ) {
			if ( ! wp_verify_nonce($_POST[$this->getPlugin()->getSlug()], $this->getPlugin()->getSlug()) ) {
				return $post_id;
			}

			if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
				return $post_id;
			}

			if ( @$_POST['post_type'] == 'page' ) {
				if ( !current_user_can('edit_page', $post_id) ) {
					return $post_id;
				}
			} else {
				if ( !current_user_can('edit_post', $post_id) ) {
					return $post_id;
				}
			}

			$force_ssl = ( @$_POST['force_ssl'] == 1 ? true : false);
			if ( $force_ssl ) {
				update_post_meta($post_id, 'force_ssl', 1);
			} else {
				delete_post_meta($post_id, 'force_ssl');
			}
		
			$force_ssl_children = ( @$_POST['force_ssl_children'] == 1  ? true : false);
			if ( $force_ssl_children ) {
				update_post_meta($post_id, 'force_ssl_children', 1);
			} else {
				delete_post_meta($post_id, 'force_ssl_children');
			}
		}
		
		return $post_id;
	}
	
}
