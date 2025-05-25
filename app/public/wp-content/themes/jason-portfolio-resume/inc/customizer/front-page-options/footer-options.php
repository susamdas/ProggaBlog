<?php
/**
 * Footer Options
 *
 * @package Jason_Portfolio_Resume
 */

$wp_customize->add_section(
    'jason_portfolio_resume_footer_options',
    array(
        'title'    => esc_html__( 'Footer Options', 'jason-portfolio-resume' ),
    )
);

// Show or Hide Social
$wp_customize->add_setting(
    'jason_portfolio_resume_footer_social_enable',
    array(
        'default'           => true,
        'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
    )
);

$wp_customize->add_control(
    new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
        $wp_customize,
        'jason_portfolio_resume_footer_social_enable',
        array(
            'label'    => esc_html__( 'Enable Social', 'jason-portfolio-resume' ),
            'section'  => 'jason_portfolio_resume_footer_options',
            'settings' => 'jason_portfolio_resume_footer_social_enable',
        )
    )
);

// Skill & List Skill
$wp_customize->add_setting(
    'jason_portfolio_resume_social',
    array(
        'default'           => '',
        'sanitize_callback' => 'jason_portfolio_resume_customizer_repeater_sanitize',
    )
);
$wp_customize->add_control(
    new Jason_Portfolio_Resume_Customize_Field_Repeater(
        $wp_customize,
        'jason_portfolio_resume_social',
        array(
            'label'   => esc_html__('Social','jason-portfolio-resume'),
            'intro'   => esc_html__('List social','jason-portfolio-resume'),
            'label_item'   => esc_html__('Social Item','jason-portfolio-resume'),
            'section' => 'jason_portfolio_resume_footer_options',
            'custom_repeater_link_control' => true,
            'custom_repeater_icon_control' => true,
        )
    )
);

$wp_customize->add_setting(
    'jason_portfolio_resume_right_text',
    array(
        'default'           => __( 'Copyright © 2022 All rights reserved.', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'jason_portfolio_resume_right_text',
    array(
        'label'           => esc_html__( 'Footer right text', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_footer_options',
        'settings'        => 'jason_portfolio_resume_right_text',
        'type'            => 'text',
    )
);