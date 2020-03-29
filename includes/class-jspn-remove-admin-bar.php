<?php
/**
 * Remove Admin bar
 * 
 * @package     JSPN
 * @subpackage  JSPN/includes
 * @copyright   Copyright (c) 2020, Jaspin Creative
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Josh Spinney <josh@jaspin.io>
 */

class JSPN_Remove_Admin_Bar {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'set_current_user', array( $this, 'remove_admin_bar' ) );
	}

	/**
     * Remove admin bar
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	public function remove_admin_bar() {
		if ( !current_user_can('edit_posts') ) {
			show_admin_bar( false );
		}
	}
}