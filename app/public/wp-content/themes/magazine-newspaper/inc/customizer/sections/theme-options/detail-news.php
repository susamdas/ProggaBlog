<?php

/**
 * Detail News Settings
 *
 * @package magazine-newspaper
 */
add_action( 'customize_register', 'magazine_newspaper_customize_register_detail_news' );
function magazine_newspaper_customize_register_detail_news(  $wp_customize  ) {
    $wp_customize->add_section( 'magazine_newspaper_detail_news_sections', array(
        'title'       => esc_attr__( 'Detail News', 'magazine-newspaper' ),
        'description' => esc_attr__( 'Detail News section.', 'magazine-newspaper' ),
        'panel'       => 'magazine_newspaper_theme_panel',
        'priority'    => 2,
        'capability'  => 'edit_theme_options',
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_detail_news_display', array(
        'sanitize_callback' => 'magazine_newspaper_sanitize_checkbox',
        'default'           => true,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control($wp_customize, 'magazine_newspaper_detail_news_display', array(
        'label'    => esc_attr__( 'Show Detail News', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_detail_news_sections',
        'settings' => 'magazine_newspaper_detail_news_display',
        'type'     => 'toggle',
    )) );
    $wp_customize->selective_refresh->add_partial( 'magazine_newspaper_detail_news_display', array(
        'selector' => '#magazine_newspaper_detail_news_sections > .container',
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_detail_news_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ) );
    $wp_customize->add_control( 'magazine_newspaper_detail_news_title', array(
        'label'    => esc_attr__( 'Detail News Title', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_detail_news_sections',
        'settings' => 'magazine_newspaper_detail_news_title',
        'type'     => 'text',
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_detail_news_category', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_newspaper_sanitize_category',
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Customize_Dropdown_Taxonomies_Control($wp_customize, 'magazine_newspaper_detail_news_category', array(
        'label'    => esc_html__( 'Detail News Category', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_detail_news_sections',
        'settings' => 'magazine_newspaper_detail_news_category',
        'type'     => 'dropdown-taxonomies',
    )) );
    $wp_customize->add_setting( 'magazine_newspaper_detail_news_view_not_available', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Custom_Text($wp_customize, 'magazine_newspaper_detail_news_view_not_available', array(
        'label'    => esc_html__( 'Upgrade to Pro to change post layout', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_detail_news_sections',
        'settings' => 'magazine_newspaper_detail_news_view_not_available',
        'type'     => 'customtext',
    )) );
    $wp_customize->add_setting( 'magazine_newspaper_detail_news_details', array(
        'sanitize_callback' => 'magazine_newspaper_sanitize_array',
        'default'           => array('date', 'categories', 'tags'),
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Multi_Check_Control($wp_customize, 'magazine_newspaper_detail_news_details', array(
        'label'    => esc_attr__( 'Hide / Show Details', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_detail_news_sections',
        'settings' => 'magazine_newspaper_detail_news_details',
        'type'     => 'multi-check',
        'choices'  => array(
            'author'             => esc_attr__( 'Show post author', 'magazine-newspaper' ),
            'date'               => esc_attr__( 'Show post date', 'magazine-newspaper' ),
            'categories'         => esc_attr__( 'Show Categories', 'magazine-newspaper' ),
            'tags'               => esc_attr__( 'Show Tags', 'magazine-newspaper' ),
            'number_of_comments' => esc_attr__( 'Show number of comments', 'magazine-newspaper' ),
        ),
    )) );
    $wp_customize->add_setting( 'magazine_newspaper_detail_news_separator1', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Separator_Control($wp_customize, 'magazine_newspaper_detail_news_separator1', array(
        'section' => 'magazine_newspaper_detail_news_sections',
    )) );
    $wp_customize->add_setting( 'magazine_newspaper_detail_news_sidebar_layout', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_newspaper_sanitize_choices',
        'default'           => 'right-sidebar',
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Radio_Buttonset_Control($wp_customize, 'magazine_newspaper_detail_news_sidebar_layout', array(
        'label'    => esc_html__( 'Select sidebar layout', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_detail_news_sections',
        'settings' => 'magazine_newspaper_detail_news_sidebar_layout',
        'type'     => 'radio-buttonset',
        'choices'  => array(
            'left-sidebar'  => esc_attr__( 'Sidebar at left', 'magazine-newspaper' ),
            'right-sidebar' => esc_attr__( 'Sidebar at right', 'magazine-newspaper' ),
            'no-sidebar'    => esc_attr__( 'No sidebar', 'magazine-newspaper' ),
        ),
    )) );
}
