<?php
/**
 * Breaking News Settings
 *
 * @package magazine-newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_breaking_news' );

function magazine_newspaper_customize_register_breaking_news( $wp_customize ) {

    $wp_customize->add_section( 'magazine_newspaper_breaking_news', array(
      'title'          => esc_attr__( 'Breaking News', 'magazine-newspaper' ),
      'description'    => esc_attr__( 'Breaking News section.', 'magazine-newspaper' ),
      'panel'          => 'magazine_newspaper_theme_panel',
      'priority'       => 1,
      'capability'     => 'edit_theme_options',
    ) );

    $wp_customize->add_setting( 'magazine_newspaper_breaking_news_display', array(
        'sanitize_callback'     =>  'magazine_newspaper_sanitize_checkbox',
        'default'               =>  true
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control(
      $wp_customize, 'magazine_newspaper_breaking_news_display', array(
        'label'     => esc_attr__( 'Show Breaking News', 'magazine-newspaper' ),
        'section' => 'magazine_newspaper_breaking_news',
        'settings' => 'magazine_newspaper_breaking_news_display',
        'type'=> 'toggle',
      )
    ) );

    $wp_customize->selective_refresh->add_partial('magazine_newspaper_breaking_news_display', array(
      'selector' => '#magazine_newspaper_breaking_news'
    ));

    $wp_customize->add_setting( 'magazine_newspaper_breaking_news_title', array(
      'sanitize_callback'     =>  'sanitize_text_field',
      'default'               =>  'Breaking News'
    ) );

    $wp_customize->add_control( 'magazine_newspaper_breaking_news_title', array(
      'label'     => esc_attr__( 'Breaking News Title', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_breaking_news',
      'settings' => 'magazine_newspaper_breaking_news_title',
      'type'=> 'text',
    ) );

    $wp_customize->add_setting( 'magazine_newspaper_breaking_news_category', array(
      'sanitize_callback' => 'magazine_newspaper_sanitize_category',
      'capability'  => 'edit_theme_options',
      'default'     => '',
    ) );

    $wp_customize->add_control( new Magazine_Newspaper_Customize_Dropdown_Taxonomies_Control(
      $wp_customize, 'magazine_newspaper_breaking_news_category', array(
        'label'     => esc_html__( 'Breaking News Category', 'magazine-newspaper' ),
        'section'   => 'magazine_newspaper_breaking_news',
        'settings'  => 'magazine_newspaper_breaking_news_category',
        'type'      => 'dropdown-taxonomies',
        'taxonomy'  =>  'category'
      )
    ) );
}