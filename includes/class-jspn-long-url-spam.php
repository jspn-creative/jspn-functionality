<?php
/**
 * Mark long URLs as spam
 *
 * @package     JSPN
 * @subpackage  JSPN/includes
 * @copyright   Copyright (c) 2020, Jaspin Creative
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Josh Spinney <josh@jaspin.io>
 */

class JSPN_Long_URL_Spam {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'pre_comment_approved', array( $this, 'url_spamcheck' ), 99, 2 );
	}

	/**
     * Marks comments with a long author URL as spam
     *
     * @since  1.0.0
     * @access public
     * @return viod
     */
	public function url_spamcheck( $approved , $commentdata ) {
		return ( strlen( $commentdata['comment_author_url'] ) > 50 ) ? 'spam' : $approved;
	}
}