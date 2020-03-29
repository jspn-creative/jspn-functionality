<?php
/**
 * Adds widget area on homepage
 * 
 * @package     JSPN
 * @subpackage  JSPN/includes
 * @copyright   Copyright (c) 2020, Jaspin Creative
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Josh Spinney <josh@jaspin.io>
 */

class JSPN_Home_Widget {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'init_home_widget' ) );
		add_action( 'wp_body_open', array( $this, 'show_home_widget' ) );
	}

	/**
     * Remove admin bar
     *
     * @since  1.0.0
     * @access public
     * @return void
     */

  public function init_home_widget() {
    register_sidebar(array(
      'name' => 'Homepage Widget',
      'id' => 'jspn-homepage-widget',
      'before_widget' => '',
      'after_widget'  => '',
    ));
  }

  public function show_home_widget() {
    if ( is_front_page() && is_active_sidebar( 'jspn-homepage-widget' ) ) : ?>
        <?php dynamic_sidebar( 'jspn-homepage-widget' ); ?>
    <?php endif; 
  }

  }