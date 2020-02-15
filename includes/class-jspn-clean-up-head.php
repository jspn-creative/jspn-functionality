<?php
/**
 * Remove WP generated content from the head
 * 
 * @package     JSPN
 * @subpackage  JSPN/includes
 * @copyright   Copyright (c) 2020, Jaspin Creative
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Josh Spinney <josh@jaspin.io>
 */

class JSPN_Clean_Up_Head {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'clean_up_head' ) );
	}

	/**
     * Remove WP generated content from the head
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
	public function clean_up_head() {
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
	}
}