<?php 

class WPTD_Chart_Settings {
	
	private static $_instance = null;
	
	public function __construct() {

		//WPTD chart admin menu
		add_action( 'admin_menu', array( $this, 'wptd_admin_menu' ) );
		
		//WPTD chart admin scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'wptd_admin_scripts' ) );
		
		//Plugin Links
		add_filter( 'plugin_action_links', array( $this, 'wptd_chart_plugin_action_links' ), 90, 2 );
				
	}
	
	public function wptd_admin_menu() {
		add_menu_page( 
			esc_html__( 'WPTD Chart', 'wptd-chart' ),
			esc_html__( 'WPTD Chart', 'wptd-chart' ),
			'manage_options',
			'wptd-chart', 
			array( $this, 'wptd_chart_page' ),
			'dashicons-chart-area',
			6
		);
	}
	
	public function wptd_admin_scripts(){
		if( isset( $_GET['page'] ) && $_GET['page'] == 'wptd-chart' ){
			wp_enqueue_style( 'wptd-chart-admin', WPTD_CHART_URL . 'admin/assets/css/style.css', array(), '1.0.0', 'all' );
		}
	}
	
	public function wptd_chart_page() {
		require_once ( WPTD_CHART_DIR . 'admin/admin-page.php' );
	}
	
	public function wptd_chart_plugin_action_links( $plugin_actions, $plugin_file ){		
		$new_actions = array(); 
		if( 'wptd-chart/wptd-chart.php' === $plugin_file ) {
			$new_actions = array( sprintf( __( '<a href="%s">Settings</a>', 'wptd-chart' ), esc_url( admin_url( 'admin.php?page=wptd-chart' ) ) ) );
		}
		return array_merge( $new_actions, $plugin_actions );
	}
	
	/**
	 * Creates and returns an instance of the class
	 * @since 1.0.0
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
WPTD_Chart_Settings::get_instance();