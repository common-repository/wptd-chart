<?php 
/*
Plugin Name: WPTD Chart
Plugin URI: http://plugins.wpthemedevelopers.com/wptd-chart/
Description: WPTD Chart is advanced elementor chart plugin. Convert easily data into chart. We gives you 4 models of charts example: pie chart, line chart, doughnut chart, bar chart. Also you can control chart legend details. In future we planned to give more chart types as free.
Version: 1.1
Author: wpthemedevelopers
Author URI: https://wpthemedevelopers.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'WPTD_CHART_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPTD_CHART_URL', plugin_dir_url( __FILE__ ) );

/*
* Intialize and Sets up the plugin
*/
class WPTD_Chart {
	
	private static $_instance = null;
	
	public static $version = '1.1';
	
	/**
	* Sets up needed actions/filters for the plug-in to initialize.
	* @since 1.0.0
	* @access public
	* @return void
	*/
	public function __construct() {

		//WPTD chart setup page
		add_action( 'plugins_loaded', array( $this, 'wptd_chart_setup') );
		
		//WPTD chart shortcodes
		add_action( 'init', array( $this, 'wptd_chart_init_addons' ), 20 );
		
	}
	
	/**
	* Installs translation text domain
	* @since 1.0.0
	* @access public
	* @return void
	*/
	public function wptd_chart_setup() {
		//Load text domain
		$this->wptd_chart_load_domain();
	}
	
	/**
	 * Load plugin translated strings using text domain
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function wptd_chart_load_domain() {
		load_plugin_textdomain( 'wptd-chart', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
	}
		
	/**
	* Load required file for addons integration
	* @return void
	*/
	public function wptd_chart_init_addons() {
		//Settings
		require_once ( WPTD_CHART_DIR . 'admin/wptd-settings.php' );
		
		//Shortcodes
		require_once ( WPTD_CHART_DIR . 'inc/class.elementor.settings.php' );
	}
	
	/**
	 * Creates and returns an instance of the class
	 * @since 2.6.8
	 * @access public
	 * return object
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}
WPTD_Chart::get_instance();