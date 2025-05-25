<?php
/**
 * Blog Section
 *
 * @package Jason_Portfolio_Resume
 */

$wp_customize->add_section(
	'jason_portfolio_resume_blog_section',
	array(
		'panel'    => 'jason_portfolio_resume_front_page_options',
		'title'    => esc_html__( 'Blog Section', 'jason-portfolio-resume' ),
		'priority' => jason_portfolio_resume_priority_section('jason_portfolio_resume_blog_section'),
        'description' => esc_html__( 'Blog section options.', 'jason-portfolio-resume' ),
	)
);

// Project Section - Enable Section.
$wp_customize->add_setting(
	'jason_portfolio_resume_enable_blog_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
		$wp_customize,
		'jason_portfolio_resume_enable_blog_section',
		array(
			'label'    => esc_html__( 'Enable Blog Section', 'jason-portfolio-resume' ),
			'section'  => 'jason_portfolio_resume_blog_section',
			'settings' => 'jason_portfolio_resume_enable_blog_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'jason_portfolio_resume_enable_blog_section',
		array(
			'selector' => '#my-blog .section-link',
			'settings' => 'jason_portfolio_resume_enable_blog_section',
		)
	);
}

// Headline
$wp_customize->add_setting(
    'jason_portfolio_resume_blog_section_headline',
    array(
        'default'           => __( 'My Blog', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_blog_section_headline',
    array(
        'label'           => esc_html__( 'Headline', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_blog_section',
        'settings'        => 'jason_portfolio_resume_blog_section_headline',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_blog_section_enabled',
    )
);

// Headline
$wp_customize->add_setting(
    'jason_portfolio_resume_blog_section_headline_sub',
    array(
        'default'           => __( 'My shared posts', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_blog_section_headline_sub',
    array(
        'label'           => esc_html__( 'Headline sub', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_blog_section',
        'settings'        => 'jason_portfolio_resume_blog_section_headline_sub',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_blog_section_enabled',
    )
);

// List blog
$wp_customize->add_setting(
    'jason_portfolio_resume_blog_list',
    array(
        'sanitize_callback' => 'sanitize_array',
    )
);
$wp_customize->add_control(
    new Jason_Portfolio_Resume_Customize_Select_Multiple(
        $wp_customize,
        'jason_portfolio_resume_blog_list',
        array(
            'label'           => esc_html__( 'Select List', 'jason-portfolio-resume' ),
            'description'           => esc_html__( 'Can you choosen multiple', 'jason-portfolio-resume' ),
            'section'         => 'jason_portfolio_resume_blog_section',
            'settings' => 'jason_portfolio_resume_blog_list',
            'choices' => jason_portfolio_resume_get_post_choices(),
            'height' => general_height_from_count_post(jason_portfolio_resume_get_post_choices()),
            'active_callback' => 'jason_portfolio_resume_is_blog_section_enabled',
        )
    )
);


// Button text
$wp_customize->add_setting(
    'jason_portfolio_resume_blog_section_button_text',
    array(
        'default'           => __( 'View All', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_blog_section_button_text',
    array(
        'label'           => esc_html__( 'Button Text', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_blog_section',
        'settings'        => 'jason_portfolio_resume_blog_section_button_text',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_blog_section_enabled',
    )
);

// Button url
$wp_customize->add_setting(
    'jason_portfolio_resume_blog_section_button_url',
    array(
        'default'           => __( '#', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_blog_section_button_url',
    array(
        'label'           => esc_html__( 'Button URL', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_blog_section',
        'settings'        => 'jason_portfolio_resume_blog_section_button_url',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_blog_section_enabled',
    )
);