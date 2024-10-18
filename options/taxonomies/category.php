<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$iqconnetik_layouts           = iqconnetik_get_feed_layout_options(true);
$iqconnetik_gaps              = iqconnetik_get_feed_layout_gap_options(true);
$iqconnetik_sidebar_positions = iqconnetik_get_sidebar_position_options(true);

//options for categories
//returning array of fields
return array(
	'layout'           => array(
		'type'        => 'select',
		'label'       => esc_html__('Layout', 'iqconnetik'),
		'description' => esc_html__('Category layout', 'iqconnetik'),
		'default'     => '',
		'choices'     => $iqconnetik_layouts,
	),
	'gap'              => array(
		'type'        => 'select',
		'label'       => esc_html__('Items gap (for grid layouts)', 'iqconnetik'),
		'description' => esc_html__('Gap between elements in pixels', 'iqconnetik'),
		'default'     => '',
		'choices'     => $iqconnetik_gaps,
	),
	'sidebar_position' => array(
		'type'        => 'select',
		'label'       => esc_html__('Sidebar position', 'iqconnetik'),
		'description' => esc_html__('Sidebar position for category', 'iqconnetik'),
		'default'     => '',
		'choices'     => $iqconnetik_sidebar_positions,
	),
);
