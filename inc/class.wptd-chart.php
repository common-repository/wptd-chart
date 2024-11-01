<?php
/**
 * WPTD Chart Shortcode Class
 * The main class that initiates and runs the plugin. 
 * @since 1.0.0
 */
final class WPTD_Chart_Shortcode {
	
	/**
	 * Instance
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var Shortcode The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Constructor
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		
		$this->init();

	}
	
	public function init() {
			
		// Create Catgeory
		$this->create_wptd_elementor_category();
		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'editor_enqueue_scripts' ] );
		
		// Register Elementor Widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		
		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		
	}
	
	/**
     * Register plugin shortcode category
	 * @since 2.6.8
	 * @access public
	 * @return void
	 */
	public function create_wptd_elementor_category() {
	   \Elementor\Plugin::instance()->elements_manager->add_category(
			'wptd',
			array(
				'title' => esc_html__( 'WPTD', 'wptd-chart' )
			),
		1);
	}
	
	public function editor_enqueue_scripts(){
		wp_enqueue_style( 'wptd-icons', WPTD_CHART_URL .'assets/css/wptd-icons.css', array(), '1.0', 'all' );
	}
	
	/**
	 * Widget Scripts
	 * Include widgets scripts
	 * @since 1.0.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'chart', WPTD_CHART_URL . 'assets/js/chart.min.js',  array( 'jquery' ), '3.1.0', true );
		wp_register_script( 'wptd-chart', WPTD_CHART_URL . 'assets/js/wptd-chart.js',  array( 'jquery' ), '1.0', true );
	}
	
	/**
	 * Init Widgets
	 * Include widgets files and register them
	 * @since 1.0.0
	 * @access public
	 */
	public function init_widgets() {
		// Connect Widget File
		require_once( WPTD_CHART_DIR . 'widgets/chart.php' );
		
		//Call Widget Class
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \WPTD_Chart_Widget() );
	}
	
	/**
	 * Creates and returns an instance of the class
	 * @since 2.6.8
	 * @access public
	 * return object
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	
} 
WPTD_Chart_Shortcode::instance();