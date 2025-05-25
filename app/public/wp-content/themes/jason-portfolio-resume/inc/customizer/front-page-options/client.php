<?php
/**
 * Client Section
 *
 * @package Jason_Portfolio_Resume
 */

$wp_customize->add_section(
	'jason_portfolio_resume_client_section',
	array(
		'panel'    => 'jason_portfolio_resume_front_page_options',
		'title'    => esc_html__( 'Client Section', 'jason-portfolio-resume' ),
		'priority' => jason_portfolio_resume_priority_section('jason_portfolio_resume_client_section'),
	)
);

// Project Section - Enable Section.
$wp_customize->add_setting(
	'jason_portfolio_resume_enable_client_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
		$wp_customize,
		'jason_portfolio_resume_enable_client_section',
		array(
			'label'    => esc_html__( 'Enable Client Section', 'jason-portfolio-resume' ),
			'section'  => 'jason_portfolio_resume_client_section',
			'settings' => 'jason_portfolio_resume_enable_client_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'jason_portfolio_resume_enable_client_section',
		array(
			'selector' => '#my-client .section-link',
			'settings' => 'jason_portfolio_resume_enable_client_section',
		)
	);
}

// Headline
$wp_customize->add_setting(
    'jason_portfolio_resume_client_section_headline',
    array(
        'default'           => __( 'My Client', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_client_section_headline',
    array(
        'label'           => esc_html__( 'Headline', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_client_section',
        'settings'        => 'jason_portfolio_resume_client_section_headline',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_client_section_enabled',
    )
);

// Headline sub
$wp_customize->add_setting(
    'jason_portfolio_resume_client_section_headline_sub',
    array(
        'default'           => __( 'My Client', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_client_section_headline_sub',
    array(
        'label'           => esc_html__( 'Headline sub', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_client_section',
        'settings'        => 'jason_portfolio_resume_client_section_headline_sub',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_client_section_enabled',
    )
);

// List Client
$wp_customize->add_setting(
    'jason_portfolio_resume_resume_section_client_list',
    array(
        'default'           => '',
        'sanitize_callback' => 'jason_portfolio_resume_customizer_repeater_sanitize',
    )
);
$wp_customize->add_control(
    new Jason_Portfolio_Resume_Customize_Field_Repeater(
        $wp_customize,
        'jason_portfolio_resume_resume_section_client_list',
        array(
            'label'   => esc_html__('Client','jason-portfolio-resume'),
            'label_item'   => esc_html__('Client Item','jason-portfolio-resume'),
            'section' => 'jason_portfolio_resume_client_section',
            'custom_repeater_repeater_fields' => array(
                'label' => array('List','Add Row','Delete Row'),
                'key' => 'custom_repeater_repeater_fields',
                'fields' => array(
                    'client_image' => array('class' => 'trigger_field', 'type' => 'image', 'label' => 'Avatar'),
                    'client_content' => array('class' => 'trigger_field', 'type' => 'textarea', 'label' => 'Content'),
                    'client_name' => array('class' => 'trigger_field', 'type' => 'text','label' => 'Name'),
                    'client_job' => array('class' => 'trigger_field', 'type' => 'text','label' => 'Job position'),
                )
            ),
            'active_callback' => 'jason_portfolio_resume_is_client_section_enabled',
        )
    )
);