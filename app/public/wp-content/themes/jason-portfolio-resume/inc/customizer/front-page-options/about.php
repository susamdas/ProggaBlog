<?php
/**
 * About Section
 *
 * @package Jason_Portfolio_Resume
 */
$default_args  = array(
    'panel'    => 'jason_portfolio_resume_front_page_options',
    'title'    => esc_html__( 'About Section', 'jason-portfolio-resume' ),
    'priority' => jason_portfolio_resume_priority_section('jason_portfolio_resume_about_section'),
);

//$wp_customize->add_section(
//	'jason_portfolio_resume_about_section',
//    $default_args
//);

$wp_customize->add_section(
    new Jason_Portfolio_Resume_Custom_Section(
        $wp_customize,
        'jason_portfolio_resume_about_section',
        array_merge(
            $default_args,
            array(
                'button_text'      => __( 'Buy Pre', 'jason-portfolio-resume' ),
                'url'              => JASON_PORTFOLIO_RESUME_URL_DEMO,
            )
        )
    )
);

// About Section - Enable Section.
$wp_customize->add_setting(
	'jason_portfolio_resume_enable_about_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
		$wp_customize,
		'jason_portfolio_resume_enable_about_section',
		array(
			'label'    => esc_html__( 'Enable About Section', 'jason-portfolio-resume' ),
			'section'  => 'jason_portfolio_resume_about_section',
			'settings' => 'jason_portfolio_resume_enable_about_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'jason_portfolio_resume_enable_about_section',
		array(
			'selector' => '#about-me .section-link',
			'settings' => 'jason_portfolio_resume_enable_about_section',
		)
	);
}

// Left text top
$wp_customize->add_setting(
    'jason_portfolio_resume_about_section_left_text_top',
    array(
        'default'           => __( 'Best Design Awards', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_about_section_left_text_top',
    array(
        'label'           => esc_html__( 'Left text top', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_about_section',
        'settings'        => 'jason_portfolio_resume_about_section_left_text_top',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_about_section_enabled',
    )
);

// Image
$wp_customize->add_setting(
    'jason_portfolio_resume_about_image',
    array(
        'sanitize_callback' => 'jason_portfolio_resume_sanitize_image',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'jason_portfolio_resume_about_image',
        array(
            'label'           => esc_html__( 'Left Image', 'jason-portfolio-resume' ),
            'section'         => 'jason_portfolio_resume_about_section',
            'settings'        => 'jason_portfolio_resume_about_image',
            'active_callback' => 'jason_portfolio_resume_is_about_section_enabled',
        )
    )
);

// Left text bottom left
$wp_customize->add_setting(
    'jason_portfolio_resume_about_section_left_text_bottom_left',
    array(
        'default'           => __( '<strong>9+</strong><span>Years of<br>Experiencs</span>', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_about_section_left_text_bottom_left',
    array(
        'label'           => esc_html__( 'Left text bottom(left)', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_about_section',
        'settings'        => 'jason_portfolio_resume_about_section_left_text_bottom_left',
        'type'            => 'textarea',
        'active_callback' => 'jason_portfolio_resume_is_about_section_enabled',
    )
);

// Left text bottom right
$wp_customize->add_setting(
    'jason_portfolio_resume_about_section_left_text_bottom_right',
    array(
        'default'           => __( '20+<br/>Happy Clients', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_about_section_left_text_bottom_right',
    array(
        'label'           => esc_html__( 'Left text bottom(right)', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_about_section',
        'settings'        => 'jason_portfolio_resume_about_section_left_text_bottom_right',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_about_section_enabled',
    )
);

// Right options


// Name
$wp_customize->add_setting(
    'jason_portfolio_resume_about_section_right_name',
    array(
        'default'           => __( 'Hi, I am', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_about_section_right_name',
    array(
        'label'           => esc_html__( 'Name', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_about_section',
        'settings'        => 'jason_portfolio_resume_about_section_right_name',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_about_section_enabled',
    )
);

$wp_customize->add_setting(
    'jason_portfolio_resume_about_section_right_featured_text',
    array(
        'default'           => '"Joe Morgan.","Designer","Developer"',
        'sanitize_callback' => 'wp_kses',
    )
);

$wp_customize->add_control(
    new Jason_Portfolio_Resume_Multi_Input_Custom_control(
        $wp_customize,
        'jason_portfolio_resume_about_section_right_featured_text',
        array(
            'label'           => esc_html__( 'Featured Text List', 'jason-portfolio-resume' ),
            'section'         => 'jason_portfolio_resume_about_section',
            'settings'        => 'jason_portfolio_resume_about_section_right_featured_text',
            'active_callback' => 'jason_portfolio_resume_is_about_section_enabled',
        )
    )
);

// intro
$wp_customize->add_setting(
    'jason_portfolio_resume_about_section_right_intro',
    array(
        'default'           => __( '<p>Senior UX designer with 9+ years experience and specialization in complex web application design.</p><p>Achieved 15% increase in user satisfaction and 20% increase in conversions through the creation of interactively tested, data-driven, and user-centered design.</p>', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_about_section_right_intro',
    array(
        'label'           => esc_html__( 'Right text intro', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_about_section',
        'settings'        => 'jason_portfolio_resume_about_section_right_intro',
        'type'            => 'textarea',
        'active_callback' => 'jason_portfolio_resume_is_about_section_enabled',
    )
);
// Button text
$wp_customize->add_setting(
    'jason_portfolio_resume_about_section_right_button_text',
    array(
        'default'           => __( 'Button text', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_about_section_right_button_text',
    array(
        'label'           => esc_html__( 'Contact', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_about_section',
        'settings'        => 'jason_portfolio_resume_about_section_right_button_text',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_about_section_enabled',
    )
);
// Button URL
$wp_customize->add_setting(
    'jason_portfolio_resume_about_section_right_button_url',
    array(
        'default'           => __( '#', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_about_section_right_button_url',
    array(
        'label'           => esc_html__( 'Button url', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_about_section',
        'settings'        => 'jason_portfolio_resume_about_section_right_button_url',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_about_section_enabled',
    )
);

// Show or Hide Social
$wp_customize->add_setting(
    'jason_portfolio_resume_social_enable',
    array(
        'default'           => true,
        'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
    )
);

$wp_customize->add_control(
    new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
        $wp_customize,
        'jason_portfolio_resume_social_enable',
        array(
            'label'    => esc_html__( 'Enable Social', 'jason-portfolio-resume' ),
            'section'  => 'jason_portfolio_resume_about_section',
            'settings' => 'jason_portfolio_resume_social_enable',
        )
    )
);

// Social
$wp_customize->add_setting(
    'jason_portfolio_resume_about_section_right_social',
    array(
        'default'           => '',
        'sanitize_callback' => 'jason_portfolio_resume_customizer_repeater_sanitize',
    )
);
$wp_customize->add_control(
    new Jason_Portfolio_Resume_Customize_Field_Repeater(
        $wp_customize,
        'jason_portfolio_resume_about_section_right_social',
        array(
            'label'   => esc_html__('Social','jason-portfolio-resume'),
            'intro'   => esc_html__('List social show in navigation','jason-portfolio-resume'),
            'label_item'   => esc_html__('Social Item','jason-portfolio-resume'),
            'section' => 'jason_portfolio_resume_about_section',
            'custom_repeater_link_control' => true,
            'custom_repeater_icon_control' => true,
            'active_callback' => 'jason_portfolio_resume_is_about_section_enabled',
        )
    )
);