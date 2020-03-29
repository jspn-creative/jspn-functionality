<?php
/**
 * Main Init Class
 *
 * @package     JSPN
 * @subpackage  JSPN/includes
 * @copyright   Copyright (c) 2020, Jaspin Creative
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Josh Spinney <josh@jaspin.io>
 */

class JSPN_Init {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		//$add_settings				= new JSPN_Add_Settings(); // Adds settings page
		$dupe_pages					= new JSPN_Dupe_Pages();
		$home_widget				= new JSPN_Home_Widget();
		$remove_admin_bar			= new JSPN_Remove_Admin_Bar();
		$clean_up_head				= new JSPN_Clean_Up_Head();
		$long_url_spam				= new JSPN_Long_URL_Spam(); // If comment author's URL is long, automatically marks as spam
		$add_mime_types				= new JSPN_Add_Mime_Types(); // Adds SVG Upload support
		$remove_post_author_url		= new JSPN_Remove_Post_Author_Url(); // From comment posts
		
	}

}