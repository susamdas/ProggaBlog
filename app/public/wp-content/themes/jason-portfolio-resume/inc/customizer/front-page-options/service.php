<?php
/**
 * Service Section
 *
 * @package Jason_Portfolio_Resume
 */

$default_args = array(
    'panel'    => 'jason_portfolio_resume_front_page_options',
    'title'    => esc_html__( 'Service Section', 'jason-portfolio-resume' ),
    'priority' => jason_portfolio_resume_priority_section('jason_portfolio_resume_service_section'),
);

$wp_customize->add_section(
    'jason_portfolio_resume_service_section',
    $default_args
);

// Service Section - Enable Section.
$wp_customize->add_setting(
	'jason_portfolio_resume_enable_service_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
		$wp_customize,
		'jason_portfolio_resume_enable_service_section',
		array(
			'label'    => esc_html__( 'Enable Service Section', 'jason-portfolio-resume' ),
			'section'  => 'jason_portfolio_resume_service_section',
			'settings' => 'jason_portfolio_resume_enable_service_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'jason_portfolio_resume_enable_service_section',
		array(
			'selector' => '#my-service .section-link',
			'settings' => 'jason_portfolio_resume_enable_service_section',
		)
	);
}


// Headline
$wp_customize->add_setting(
    'jason_portfolio_resume_service_section_headline',
    array(
        'default'           => __( 'My <strong>Services</strong>', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_service_section_headline',
    array(
        'label'           => esc_html__( 'Headline', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_service_section',
        'settings'        => 'jason_portfolio_resume_service_section_headline',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_service_section_enabled',
    )
);

$wp_customize->add_setting(
    'jason_portfolio_resume_service_section_headline_sub',
    array(
        'default'           => __( 'Details about me', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_service_section_headline_sub',
    array(
        'label'           => esc_html__( 'Headline sub', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_service_section',
        'settings'        => 'jason_portfolio_resume_service_section_headline_sub',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_service_section_enabled',
    )
);

$wp_customize->add_setting(
    'jason_portfolio_resume_service_section_left_title',
    array(
        'default'           => __( 'What do i help ?', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_service_section_left_title',
    array(
        'label'           => esc_html__( 'Left title', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_service_section',
        'settings'        => 'jason_portfolio_resume_service_section_left_title',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_service_section_enabled',
    )
);

$wp_customize->add_setting(
    'jason_portfolio_resume_service_section_left_content',
    array(
        'default'           => __( 'With more than 100 successful projects of varying scale and complexity, Branch portfolio includes single page websites, corporate sites, healthcare portals, directory sites', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_service_section_left_content',
    array(
        'label'           => esc_html__( 'Left content', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_service_section',
        'settings'        => 'jason_portfolio_resume_service_section_left_content',
        'type'            => 'textarea',
        'active_callback' => 'jason_portfolio_resume_is_service_section_enabled',
    )
);

// Left Statistical
$wp_customize->add_setting(
    'jason_portfolio_resume_service_section_left_statistical',
    array(
        'default'           => '',
        'sanitize_callback' => 'jason_portfolio_resume_customizer_repeater_sanitize',
    )
);
$wp_customize->add_control(
    new Jason_Portfolio_Resume_Customize_Field_Repeater(
        $wp_customize,
        'jason_portfolio_resume_service_section_left_statistical',
        array(
            'label'   => esc_html__('Left Statistical','jason-portfolio-resume'),
            'label_item'   => esc_html__('Statistical Item','jason-portfolio-resume'),
            'section' => 'jason_portfolio_resume_service_section',
            'custom_repeater_title_control' => true,
            'custom_repeater_text_control' => true,
            'active_callback' => 'jason_portfolio_resume_is_service_section_enabled',
        )
    )
);


// List Service
$wp_customize->add_setting(
    'jason_portfolio_resume_service_section_list',
    array(
        'default'           => '',
        'sanitize_callback' => 'jason_portfolio_resume_customizer_repeater_sanitize',
    )
);
$wp_customize->add_control(
    new Jason_Portfolio_Resume_Customize_Field_Repeater(
        $wp_customize,
        'jason_portfolio_resume_service_section_list',
        array(
            'label'   => esc_html__('Service','jason-portfolio-resume'),
            'label_item'   => esc_html__('Service Item','jason-portfolio-resume'),
            'section' => 'jason_portfolio_resume_service_section',
            'custom_repeater_icon_control' => true,
            'custom_repeater_title_control' => true,
            'custom_repeater_text_control' => true,
            'active_callback' => 'jason_portfolio_resume_is_service_section_enabled',
        )
    )
);

