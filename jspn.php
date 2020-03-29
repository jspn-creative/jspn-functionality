<?php
/**
 * @package     JSPNF
 * @link      	https://github.com/jspn-creative/
 * @copyright   Copyright (c) 2020, Jaspin Creative
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Josh Spinney <josh@jaspin.io>
 *
 * @wordpress-plugin
 * Plugin Name:       JSPN Functionality
 * Plugin URI:        https://github.com/jspn-creative/
 * Description:       Custom functionality plugin for Jaspin Creative
 * Version:           1.0.0
 * Author:            Jaspin Creative
 * Author URI:        https://jaspin.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       
 * Domain Path:       /languages
 */


if ( !defined( 'ABSPATH' ) ) {
	exit;
}
if( !class_exists( 'JSPN' ) ) {
	class JSPN {

		public static $instance;

		/**
		 * Instantiate the class
		 *
		 * @since 1.0.0
		 * @static
		 * @return Instance
		 */
		public static function instance() {
			if ( !isset( self::$instance ) && ! ( self::$instance instanceof JSPN ) ) {
				self::$instance = new JSPN;
				self::$instance->define_constants();
				add_action( 'plugins_loaded', array(self::$instance, 'load_textdomain'));
				self::$instance->includes();
				self::$instance->init = new JSPN_Init();
			}
		return self::$instance;
		}

		/**
		 * Define the plugin constants
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function define_constants() {

			if ( ! defined( 'JSPN_BASENAME' ) ) {
				define( 'JSPN_BASENAME', plugin_basename(__FILE__) );
			}
			if ( ! defined( 'JSPN_VERSION' ) ) {
				define( 'JSPN_VERSION', '1.0.0' );
			}
			if ( ! defined( 'JSPN_PREFIX' ) ) {
				define( 'JSPN_PREFIX', 'jspn_' );
			}
			if ( ! defined( 'JSPN_TEXTDOMAIN' ) ) {
				define( 'JSPN_TEXTDOMAIN', 'jspn' );
			}
			if ( ! defined( 'JSPN_OPTIONS' ) ) {
				define( 'JSPN_OPTIONS', 'jspn-options' );
			}
			if ( ! defined( 'JSPN_PLUGIN_DIR' ) ) {
				define( 'JSPN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}
			if ( ! defined( 'JSPN_PLUGIN_URL' ) ) {
				define( 'JSPN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			if ( ! defined( 'JSPN_PLUGIN_FILE' ) ) {
				define( 'JSPN_PLUGIN_FILE', __FILE__ );
			}
		}

		/**
		 * Required files
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function includes() {
			$includes_path = plugin_dir_path( __FILE__ ) . 'includes/';
			
			// require_once JSPN_PLUGIN_DIR . 'includes/class-jspn-settings.php';
			require_once JSPN_PLUGIN_DIR . 'includes/class-jspn-remove-admin-bar.php';
			require_once JSPN_PLUGIN_DIR . 'includes/class-jspn-home-widget.php';
			require_once JSPN_PLUGIN_DIR . 'includes/class-jspn-dupe-pages.php';
			require_once JSPN_PLUGIN_DIR . 'includes/class-jspn-clean-up-head.php';
			require_once JSPN_PLUGIN_DIR . 'includes/class-jspn-long-url-spam.php';
			require_once JSPN_PLUGIN_DIR . 'includes/class-jspn-add-mime-types.php';
			require_once JSPN_PLUGIN_DIR . 'includes/class-jspn-remove-post-author-url.php';
			require_once JSPN_PLUGIN_DIR . 'includes/class-jspn-init.php';
		}

		/**
		 * Load text domain for translation.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function load_textdomain() {
			$jspn_lang_dir = dirname( plugin_basename( JSPN_PLUGIN_FILE ) ) . '/languages/';
			$jspn_lang_dir = apply_filters( 'JSPN_lang_dir', $jspn_lang_dir );

			$locale = apply_filters( 'plugin_locale',  get_locale(), JSPN_TEXTDOMAIN );
			$mofile = sprintf( '%1$s-%2$s.mo', JSPN_TEXTDOMAIN, $locale );

			$mofile_local  = $jspn_lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/edd/' . $mofile;

			if ( file_exists( $mofile_local ) ) {
				load_textdomain( JSPN_TEXTDOMAIN, $mofile_local );
			} else {
				load_plugin_textdomain( JSPN_TEXTDOMAIN, false, $jspn_lang_dir );
			}
		}

		/**
		 * Prevent object clone
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Nope.', JSPN_TEXTDOMAIN ), '1.6' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Nope.', JSPN_TEXTDOMAIN ), '1.6' );
		}

	}
}
/**
 * Return the instance
 *
 * @since 1.0.0
 * @return object
 */
function JSPN_Run() {
	return JSPN::instance();
}
JSPN_Run();
