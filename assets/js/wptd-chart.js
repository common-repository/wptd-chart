
(function( $ ) {
	
	"use strict";
	
	$( document ).ready(function() {
		
	}); // document ready end
	
	/* Chart Handler */
	var wptd_chart_handler = function( $scope, $ ) {
		$scope.find('.pie-chart').each(function() {
			wptd_pie_chart_generate( this );
		});		
		$scope.find('.line-chart').each(function() {
			wptd_line_chart_generate( this );
		});		
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/wptdchart.default', wptd_chart_handler );
	} );
	
	function wptd_pie_chart_generate( chart_ele ){
		var chart_ele = $( chart_ele );
		var c_chart = chart_ele;
		var chart_labels = c_chart.attr("data-labels");
		var chart_values = c_chart.attr("data-values");
		var chart_bgs = c_chart.attr("data-backgrounds");
		var chart_responsive = c_chart.attr("data-responsive");
		var chart_legend = c_chart.attr("data-legend-position");
		var chart_type = c_chart.attr("data-type");
		var chart_zorobegining = c_chart.attr("data-yaxes-zorobegining");
		
		chart_labels = chart_labels ? chart_labels.split(",") : [];
		chart_values = chart_values ? chart_values.split(",") : [];
		chart_bgs = chart_bgs ? chart_bgs.split(",") : [];
		chart_responsive = chart_responsive ? chart_responsive : 1;
		chart_legend = chart_legend ? chart_legend : 'none';
		chart_type = chart_type ? chart_type : 'doughnut';
		
		if( chart_zorobegining ){
			chart_zorobegining = {
				yAxes: [{
					ticks: {
						beginAtZero: parseInt( chart_zorobegining )
					}
				}]
			}
		}
		
		var ctx = c_chart[0].getContext('2d');
		var myChart = new Chart(ctx, {
			type: chart_type,
			data: {
				labels: chart_labels,
				datasets: [{
					label: '# of Votes',
					data: chart_values,
					backgroundColor: chart_bgs,
					borderWidth: 1
				}]
			},
			options: {
				scales: chart_zorobegining,
				responsive: parseInt( chart_responsive ),
				legend: {
					position: chart_legend,
				}
			}
		});
	}
	
	function wptd_line_chart_generate( chart_ele ){
		var chart_ele = $( chart_ele );
		var c_chart = chart_ele;
		var chart_labels = c_chart.attr("data-labels");
		var chart_values = c_chart.attr("data-values");
		var chart_bg = c_chart.attr("data-background");
		var chart_border = c_chart.attr("data-border");
		var chart_fill = c_chart.attr("data-fill");
		var chart_zorobegining = c_chart.attr("data-yaxes-zorobegining");
		var chart_title = c_chart.attr("data-title-display");
		var chart_responsive = c_chart.attr("data-responsive");
		var chart_legend = c_chart.attr("data-legend-position");
		
		chart_labels = chart_labels ? chart_labels.split(",") : [];
		chart_values = chart_values ? chart_values.split(",") : [];
		chart_bg = chart_bg ? chart_bg : '';
		chart_border = chart_border ? chart_border : '';
		chart_fill = chart_fill ? chart_fill : 0;
		
		chart_zorobegining = chart_zorobegining ? chart_zorobegining : 1;
		chart_title = chart_title ? chart_title : 1;
		chart_responsive = chart_responsive ? chart_responsive : 1;
		chart_legend = chart_legend ? chart_legend : 'none';
		
		var ctx = c_chart[0].getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: chart_labels,
				datasets: [{
					label: '# of Votes',
					data: chart_values,
					fill: parseInt( chart_fill ),
					backgroundColor: chart_bg,
					borderColor: chart_border,
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: parseInt( chart_zorobegining )
						}
					}]
				},
				responsive: parseInt( chart_responsive ),
				legend: {
					position: chart_legend,
				},
				title: {
					display: parseInt( chart_title ),
				}
			}
		});
	}
			
})( jQuery );

