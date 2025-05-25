<?php
/**
 * About Section
 *
 * @package Jason_Portfolio_Resume
 */

$wp_customize->add_section(
	'jason_portfolio_resume_contact_section',
	array(
		'panel'    => 'jason_portfolio_resume_front_page_options',
		'title'    => esc_html__( 'Contact Section', 'jason-portfolio-resume' ),
		'priority' => jason_portfolio_resume_priority_section('jason_portfolio_resume_contact_section'),
	)
);

// About Section - Enable Section.
$wp_customize->add_setting(
	'jason_portfolio_resume_enable_contact_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
		$wp_customize,
		'jason_portfolio_resume_enable_contact_section',
		array(
			'label'    => esc_html__( 'Enable About Section', 'jason-portfolio-resume' ),
			'section'  => 'jason_portfolio_resume_contact_section',
			'settings' => 'jason_portfolio_resume_enable_contact_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'jason_portfolio_resume_enable_contact_section',
		array(
			'selector' => '#contact .section-link',
			'settings' => 'jason_portfolio_resume_enable_contact_section',
		)
	);
}

// Headline
$wp_customize->add_setting(
    'jason_portfolio_resume_contact_section_headline',
    array(
        'default'           => __( 'Contact <strong>Us</strong>', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_contact_section_headline',
    array(
        'label'           => esc_html__( 'Headline', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_contact_section',
        'settings'        => 'jason_portfolio_resume_contact_section_headline',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_contact_section_enabled',
    )
);

// Headline sub
$wp_customize->add_setting(
    'jason_portfolio_resume_contact_section_headline_sub',
    array(
        'default'           => __( 'What do i help', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_contact_section_headline_sub',
    array(
        'label'           => esc_html__( 'Headline', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_contact_section',
        'settings'        => 'jason_portfolio_resume_contact_section_headline_sub',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_contact_section_enabled',
    )
);

// Fields
$wp_customize->add_setting(
    'jason_portfolio_resume_contact_section_list',
    array(
        'default'           => '',
        'sanitize_callback' => 'jason_portfolio_resume_customizer_repeater_sanitize',
    )
);
$wp_customize->add_control(
    new Jason_Portfolio_Resume_Customize_Field_Repeater(
        $wp_customize,
        'jason_portfolio_resume_contact_section_list',
        array(
            'label'   => esc_html__('Contact Item','jason-portfolio-resume'),
            'label_item'   => esc_html__('Contact Item','jason-portfolio-resume'),
            'section' => 'jason_portfolio_resume_contact_section',
            'custom_repeater_icon_control' => true,
            'custom_repeater_text_control' => true,
            'custom_repeater_text2_control' => true,
            'active_callback' => 'jason_portfolio_resume_is_contact_section_enabled',
        )
    )
);

$wp_customize->add_setting(
    'jason_portfolio_resume_contact_section_form',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_contact_section_form',
    array(
        'label'           => esc_html__( 'Form', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_contact_section',
        'settings'        => 'jason_portfolio_resume_contact_section_form',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_contact_section_enabled',
    )
);