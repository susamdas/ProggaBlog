<?php
/**
 * Front Page Left Options
 *
 * @package Jason_Portfolio_Resume
 */

$wp_customize->add_section(
    'jason_portfolio_resume_left_options',
    array(
        'title'    => esc_html__( 'Front Page Left', 'jason-portfolio-resume' ),
    )
);

// Show or Hide Social
$wp_customize->add_setting(
    'jason_portfolio_resume_left_mode_enable',
    array(
        'default'           => true,
        'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
    )
);

$wp_customize->add_control(
    new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
        $wp_customize,
        'jason_portfolio_resume_left_mode_enable',
        array(
            'label'    => esc_html__( 'Enable Dark Mode', 'jason-portfolio-resume' ),
            'section'  => 'jason_portfolio_resume_left_options',
            'settings' => 'jason_portfolio_resume_left_mode_enable',
        )
    )
);

// Show or Hide Social
$wp_customize->add_setting(
    'jason_portfolio_resume_left_social_enable',
    array(
        'default'           => true,
        'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
    )
);

$wp_customize->add_control(
    new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
        $wp_customize,
        'jason_portfolio_resume_left_social_enable',
        array(
            'label'    => esc_html__( 'Enable Social', 'jason-portfolio-resume' ),
            'section'  => 'jason_portfolio_resume_left_options',
            'settings' => 'jason_portfolio_resume_left_social_enable',
        )
    )
);

// Skill & List Skill
$wp_customize->add_setting(
    'jason_portfolio_resume_left_social',
    array(
        'default'           => '',
        'sanitize_callback' => 'customizer_repeater_sanitize',
    )
);
$wp_customize->add_control(
    new Jason_Portfolio_Resume_Customize_Field_Repeater(
        $wp_customize,
        'jason_portfolio_resume_left_social',
        array(
            'label'   => esc_html__('Social','jason-portfolio-resume'),
            'intro'   => esc_html__('List social show in navigation','jason-portfolio-resume'),
            'label_item'   => esc_html__('Social Item','jason-portfolio-resume'),
            'section' => 'jason_portfolio_resume_left_options',
            'custom_repeater_link_control' => true,
            'custom_repeater_icon_control' => true,
            'custom_repeater_color_control' => true,
        )
    )
);

$wp_customize->add_setting(
    'jason_portfolio_resume_left_below_text',
    array(
        'default'           => __( 'Copyright © 2022 All rights reserved.', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'jason_portfolio_resume_left_below_text',
    array(
        'label'           => esc_html__( 'Footer left below', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_left_options',
        'settings'        => 'jason_portfolio_resume_left_below_text',
        'type'            => 'text',
    )
);