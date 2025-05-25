<?php

/**
 * Banner News Settings
 *
 * @package magazine-newspaper
 */
add_action( 'customize_register', 'magazine_newspaper_customize_register_banner_news' );
function magazine_newspaper_customize_register_banner_news(  $wp_customize  ) {
    $wp_customize->add_section( 'magazine_newspaper_banner_news_sections', array(
        'title'       => esc_attr__( 'Banner News', 'magazine-newspaper' ),
        'description' => esc_attr__( 'Banner News section.', 'magazine-newspaper' ),
        'panel'       => 'magazine_newspaper_theme_panel',
        'priority'    => 3,
        'capability'  => 'edit_theme_options',
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_banner_news_display', array(
        'sanitize_callback' => 'magazine_newspaper_sanitize_checkbox',
        'default'           => true,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control($wp_customize, 'magazine_newspaper_banner_news_display', array(
        'label'    => esc_attr__( 'Show Banner News', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_banner_news_sections',
        'settings' => 'magazine_newspaper_banner_news_display',
        'type'     => 'toggle',
    )) );
    $wp_customize->selective_refresh->add_partial( 'magazine_newspaper_banner_news_display', array(
        'selector' => '#magazine_newspaper_banner_news_sections > .container',
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_banner_news_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ) );
    $wp_customize->add_control( 'magazine_newspaper_banner_news_title', array(
        'label'    => esc_attr__( 'Banner News Title', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_banner_news_sections',
        'settings' => 'magazine_newspaper_banner_news_title',
        'type'     => 'text',
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_banner_news_category', array(
        'sanitize_callback' => 'magazine_newspaper_sanitize_category',
        'capability'        => 'edit_theme_options',
        'default'           => '',
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Customize_Dropdown_Taxonomies_Control($wp_customize, 'magazine_newspaper_banner_news_category', array(
        'label'    => esc_html__( 'Banner News Category', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_banner_news_sections',
        'settings' => 'magazine_newspaper_banner_news_category',
        'type'     => 'dropdown-taxonomies',
        'taxonomy' => 'category',
    )) );
    $wp_customize->add_setting( 'magazine_newspaper_banner_news_number_of_posts', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '3',
    ) );
    $wp_customize->add_control( 'magazine_newspaper_banner_news_number_of_posts', array(
        'label'       => esc_attr__( 'Number of posts', 'magazine-newspaper' ),
        'description' => esc_attr__( 'put -1 for unlimited', 'magazine-newspaper' ),
        'section'     => 'magazine_newspaper_banner_news_sections',
        'settings'    => 'magazine_newspaper_banner_news_number_of_posts',
        'type'        => 'text',
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_slider_details', array(
        'sanitize_callback' => 'magazine_newspaper_sanitize_array',
        'default'           => array('date', 'categories'),
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Multi_Check_Control($wp_customize, 'magazine_newspaper_slider_details', array(
        'label'    => esc_attr__( 'Hide / Show Details', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_banner_news_sections',
        'settings' => 'magazine_newspaper_slider_details',
        'type'     => 'multi-check',
        'choices'  => array(
            'date'       => esc_attr__( 'Show date', 'magazine-newspaper' ),
            'categories' => esc_attr__( 'Show Categories', 'magazine-newspaper' ),
        ),
    )) );
    $wp_customize->add_setting( 'magazine_newspaper_banner_layouts_upgrade_to_pro', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Control_Upgrade_To_Pro($wp_customize, 'magazine_newspaper_banner_layouts_upgrade_to_pro', array(
        'section'     => 'magazine_newspaper_banner_news_sections',
        'settings'    => 'magazine_newspaper_banner_layouts_upgrade_to_pro',
        'title'       => __( 'Choose how your banner will look like.', 'magazine-newspaper' ),
        'items'       => array(
            'one' => array(
                'title' => __( 'Choose between three beautiful banner layouts', 'magazine-newspaper' ),
            ),
        ),
        'button_url'  => esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/#free-vs-pro' ),
        'button_text' => __( 'Upgrade Now', 'magazine-newspaper' ),
    )) );
}
