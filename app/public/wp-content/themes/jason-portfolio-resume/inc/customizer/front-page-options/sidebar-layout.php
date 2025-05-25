<?php
/**
 * Sidebar Option
 *
 * @package Jason_Portfolio_Resume
 */

$wp_customize->add_section(
	'jason_portfolio_resume_sidebar_option',
	array(
		'title' => esc_html__( 'Layout', 'jason-portfolio-resume' ),
		'panel' => 'jason_portfolio_resume_theme_options',
	)
);

// Sidebar Option - Global Sidebar Position.
$wp_customize->add_setting(
	'jason_portfolio_resume_sidebar_position',
	array(
		'sanitize_callback' => 'jason_portfolio_resume_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'jason_portfolio_resume_sidebar_position',
	array(
		'label'   => esc_html__( 'Sidebar Position', 'jason-portfolio-resume' ),
		'section' => 'jason_portfolio_resume_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'jason-portfolio-resume' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'jason-portfolio-resume' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'jason-portfolio-resume' ),
		),
	)
);

