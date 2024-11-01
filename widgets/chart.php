<?php
/**
 * WPTD Chart
 * @since 1.0.0
 */
 
class WPTD_Chart_Widget extends \Elementor\Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Chart widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "wptdchart";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Chart widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Chart", "wptd-chart" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Chart widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "wptd-chart-default-icon icon-pie-chart";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Animated Text widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ "wptd" ];
	}
	
	/**
	 * Retrieve the list of scripts the chart widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'chart', 'wptd-chart' ];
	}
	
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'chart', 'pie', 'doughnut', 'bar', 'line', 'data' ];
	}

	/**
	 * Register Animated Text widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//General Section
		$this->start_controls_section(
			"general_section",
			[
				"label"	=> esc_html__( "General", "wptd-chart" ),
				"tab"	=> \Elementor\Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default chart options.", "wptd-chart" ),
			]
		);
		$this->add_control(
			"chart_type",
			[
				"label"			=> esc_html__( "Chart Type", "wptd-chart" ),
				"type"			=> \Elementor\Controls_Manager::SELECT,
				"default"		=> "pie",
				"options"		=> [
					"pie"		=> esc_html__( "Pie Chart", "wptd-chart" ),
					"doughnut"	=> esc_html__( "Doughnut Chart", "wptd-chart" ),
					"bar"		=> esc_html__( "Bar Chart", "wptd-chart" ),
					"line"		=> esc_html__( "Line Chart", "wptd-chart" )
				]
			]
		);
		$this->add_control(
			"yaxis_zorobegining",
			[
				"label" 		=> esc_html__( "Y-Axis Zero Beginning", "wptd-chart" ),
				"description"	=> esc_html__( "This is option for set y-axis zero value beginning.", "wptd-chart" ),
				"type" 			=> \Elementor\Controls_Manager::SWITCHER,
				"default" 		=> "yes",
				"condition" 	=> [
					"chart_type" 	=> array( "bar", "line" )
				]
			]
		);
		$this->add_control(
			"chart_fill",
			[
				"label" 		=> esc_html__( "Chart Fill", "wptd-chart" ),
				"description"	=> esc_html__( "This is option for fill chart.", "wptd-chart" ),
				"type" 			=> \Elementor\Controls_Manager::SWITCHER,
				"default" 		=> "yes",
				"condition" 	=> [
					"chart_type" 	=> "line"
				]
			]
		);
		$this->add_control(
			"chart_responsive",
			[
				"label" 		=> esc_html__( "Chart Responsive", "wptd-chart" ),
				"description"	=> esc_html__( "This is option for responsive chart.", "wptd-chart" ),
				"type" 			=> \Elementor\Controls_Manager::SWITCHER,
				"default" 		=> "yes"
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			"chart_labels",
			[
				"type"			=> \Elementor\Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Chart Label", "wptd-chart" ),
				"description"	=> esc_html__( "Chart item label.", "wptd-chart" )
			]
		);	
		$repeater->add_control(
			"chart_values",
			[
				"type"			=> \Elementor\Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Chart Value", "wptd-chart" ),
				"description"	=> esc_html__( "Chart item value.", "wptd-chart" )
			]
		);	
		$repeater->add_control(
			"chart_colors",
			[
				"type"			=> \Elementor\Controls_Manager::COLOR,
				"label" 		=> esc_html__( "Chart Color", "wptd-chart" ),
				"description"	=> esc_html__( "Chart item color.", "wptd-chart" )
			]
		);	
		$this->add_control(
			"chart_details",
			[
				"label"			=> esc_html__( "Chart Details", "wptd-chart" ),
				"description"	=> esc_html__( "This is options for put chart item labels and values.", "wptd-chart" ),
				"type"			=> \Elementor\Controls_Manager::REPEATER,
				"fields"		=> $repeater->get_controls(),
				"default"		=> [
					[
						"chart_labels" 	=> esc_html__( "App", "wptd-chart" ),
						"chart_values"	=> "25",
						"chart_colors"	=> "#ae43ba"
					],
					[
						"chart_labels" 	=> esc_html__( "Web", "wptd-chart" ),
						"chart_values"	=> "30",
						"chart_colors"	=> "#ff267d"
					],
					[
						"chart_labels" 	=> esc_html__( "SEO", "wptd-chart" ),
						"chart_values"	=> "45",
						"chart_colors"	=> "#3945ab"
					]
				],
				"title_field"	=> "{{{ chart_labels }}}"				
			]
		);		
		$this->end_controls_section();
		
		// Style General Section
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'General', 'wptd-chart' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'chart_padding',
			[
				'label' => esc_html__( 'Padding', 'wptd-chart' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'chart_margin',
			[
				'label' => esc_html__( 'Margin', 'wptd-chart' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'chart_border',
				'selector' => '{{WRAPPER}} .elementor-widget-container',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'chart_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wptd-chart' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'chart_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-widget-container'
			]
		);
		$this->add_control(
			'chart_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wptd-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();	
		
		// Style Chart Section
		$this->start_controls_section(
			'section_style_chart',
			[
				'label' => __( 'Chart', 'wptd-chart' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"chart_width",
			[
				"type"			=> \Elementor\Controls_Manager::SLIDER,
				"label"			=> esc_html__( "Chart Width", "wptd-chart" ),
				"description"	=> esc_html__( "Here you can specify chart width. Example 800", "wptd-chart" ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1500,
						'step' => 50,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 800,
				],
			]
		);
		$this->add_control(
			"chart_height",
			[
				"type"			=> \Elementor\Controls_Manager::SLIDER,
				"label"			=> esc_html__( "Chart Height", "wptd-chart" ),
				"description"	=> esc_html__( "Here you can specify chart height. Example 300", "wptd-chart" ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
						'step' => 50,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
			]
		);
		$this->add_control(
			"legend_position",
			[
				"label"			=> esc_html__( "Chart Legend Position", "wptd-chart" ),
				"type"			=> \Elementor\Controls_Manager::SELECT,
				"default"		=> "top",
				"options"		=> [
					"none"		=> esc_html__( "None", "wptd-chart" ),
					"top"		=> esc_html__( "Top", "wptd-chart" ),
					"bottom"	=> esc_html__( "Bottom", "wptd-chart" ),
					"left"		=> esc_html__( "Left", "wptd-chart" ),
					"right"		=> esc_html__( "Right", "wptd-chart" )
				]
			]
		);
		$this->add_control(
			"chart_bg",
			[
				"type"			=> \Elementor\Controls_Manager::COLOR,
				"label"			=> esc_html__( "Dots Color", "wptd-chart" ),
				"description"	=> esc_html__( "Here you can specify chart dots color. Example #3945ab", "wptd-chart" ),
				"default" 		=> "#3945ab",
				"condition" 	=> [
					"chart_type" 	=> "line"
				]
			]
		);
		$this->add_control(
			"chart_border",
			[
				"type"			=> \Elementor\Controls_Manager::COLOR,
				"label"			=> esc_html__( "Line Color", "wptd-chart" ),
				"description"	=> esc_html__( "Here you can specify chart ,line color. Example #3945ab", "wptd-chart" ),
				"default" 		=> "#3945ab",
				"condition" 	=> [
					"chart_type" 	=> "line"
				]
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render Animated Text widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		//Define Variables
		$title = isset( $title ) && $title != '' ? $title : '';
		$chart_type = isset( $chart_type ) && $chart_type != '' ? $chart_type : 'pie';
		$chart_width = isset( $chart_width['size'] ) && $chart_width['size'] != '' ? $chart_width['size'] : '800';
		$chart_height = isset( $chart_height['size'] ) && $chart_height['size'] != '' ? $chart_height['size'] : '300';
		$yaxis = isset( $yaxis_zorobegining ) && $yaxis_zorobegining == 'yes' ? true : false;
		
		$chart_bg = isset( $chart_bg ) && $chart_bg != '' ? $chart_bg : '#1555bd';		
		$chart_border = isset( $chart_border ) && $chart_border != '' ? $chart_border : '#4580e0';
		
		$chart_fill = isset( $chart_fill ) && $chart_fill == 'yes' ? true : false;
		$chart_responsive = isset( $chart_responsive ) && $chart_responsive == 'yes' ? true : false;
		$legend_position = isset( $legend_position ) && $legend_position != '' ? $legend_position : 'top';
		
		$chart_details =  isset( $chart_details ) ? $chart_details : ''; // $prc_fetrs is pricing features
		$chart_labels = $chart_values = $chart_colors = '';
		if( $chart_details ){
			foreach( $chart_details as $chart_detail ) {
				$chart_labels .= isset( $chart_detail['chart_labels'] ) ? $chart_detail['chart_labels'] . ',' : '';
				$chart_values .= isset( $chart_detail['chart_values'] ) ? $chart_detail['chart_values'] .',' : '';
				$chart_colors .= isset( $chart_detail['chart_colors'] ) ? $chart_detail['chart_colors'] .',' : '#333333';
			}
			$chart_labels = rtrim( $chart_labels, ',' );
			$chart_values = rtrim( $chart_values, ',' );
			$chart_colors = rtrim( $chart_colors, ',' );
		}
		
		
		
		$chart_rand_id = $rand_class = 'chart-rand-' . self::wptd_chart_shortcode_rand_id();		
		
		switch( $chart_type ){
			case "pie":
				echo '<canvas id="'. esc_attr( $chart_rand_id ) .'" class="pie-chart" width="'. esc_attr( $chart_width ) .'" height="'. esc_attr( $chart_height ) .'" data-type="pie" data-labels="'. esc_attr( $chart_labels ) .'" data-values="'. esc_attr( $chart_values ) .'" data-backgrounds="'. esc_attr( $chart_colors ) .'" data-responsive="'. esc_attr( $chart_responsive ) .'" data-legend-position="'. esc_attr( $legend_position ) .'"></canvas>';
			break;
			case "doughnut":
				echo '<canvas id="'. esc_attr( $chart_rand_id ) .'" class="pie-chart" width="'. esc_attr( $chart_width ) .'" height="'. esc_attr( $chart_height ) .'" data-type="doughnut" data-labels="'. esc_attr( $chart_labels ) .'" data-values="'. esc_attr( $chart_values ) .'" data-backgrounds="'. esc_attr( $chart_colors ) .'" data-responsive="'. esc_attr( $chart_responsive ) .'" data-legend-position="'. esc_attr( $legend_position ) .'"></canvas>';
			break;
			case "bar":
				echo '<canvas id="'. esc_attr( $chart_rand_id ) .'" class="pie-chart" width="'. esc_attr( $chart_width ) .'" height="'. esc_attr( $chart_height ) .'" data-type="bar" data-labels="'. esc_attr( $chart_labels ) .'" data-values="'. esc_attr( $chart_values ) .'" data-backgrounds="'. esc_attr( $chart_colors ) .'" data-responsive="'. esc_attr( $chart_responsive ) .'" data-legend-position="'. esc_attr( $legend_position ) .'" data-yaxes-zorobegining="'. esc_attr( $yaxis ) .'"></canvas>';
			break;
			case "line":
				echo '<canvas id="'. esc_attr( $chart_rand_id ) .'" class="line-chart" width="'. esc_attr( $chart_width ) .'" height="'. esc_attr( $chart_height ) .'" data-labels="'. esc_attr( $chart_labels ) .'" data-values="'. esc_attr( $chart_values ) .'" data-background="'. esc_attr( $chart_bg ) .'" data-border="'. esc_attr( $chart_border ) .'" data-fill="'. esc_attr( $chart_fill ) .'" data-responsive="'. esc_attr( $chart_responsive ) .'" data-legend-position="'. esc_attr( $legend_position ) .'" data-yaxes-zorobegining="'. esc_attr( $yaxis ) .'"></canvas>';
			break;
		}
		

	}
	
	public static function wptd_chart_shortcode_rand_id(){
		static $random_ = 1;
		return $random_++;
	}
	
}