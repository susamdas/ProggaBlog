<?php
/**
 * Top News Settings
 *
 * @package magazine-newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_top_news' );

function magazine_newspaper_customize_register_top_news( $wp_customize ) {

  $wp_customize->add_section( 'magazine_newspaper_top_news_sections', array(
    'title'          => esc_attr__( 'Top News', 'magazine-newspaper' ),
    'description'    => esc_attr__( 'Top News section.', 'magazine-newspaper' ),
    'panel'          => 'magazine_newspaper_theme_panel',
    'priority'       => 7,
    'capability'     => 'edit_theme_options',
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_top_news_display', array(
    'sanitize_callback'     =>  'magazine_newspaper_sanitize_checkbox',
    'default'               =>  true
  ) );
          
  $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control(
    $wp_customize, 'magazine_newspaper_top_news_display', array(
      'label'     => esc_attr__( 'Show Top News', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_top_news_sections',
      'settings' => 'magazine_newspaper_top_news_display',
      'type'=> 'toggle',
    )
  ) );

  $wp_customize->selective_refresh->add_partial('magazine_newspaper_top_news_display', array(
    'selector' => '#magazine_newspaper_top_news_sections > .container'
  ));

  $wp_customize->add_setting( 'magazine_newspaper_top_news_section_title', array(
    'sanitize_callback'     =>  'sanitize_text_field',
    'default'               =>  ''
  ) );

  $wp_customize->add_control( 'magazine_newspaper_top_news_section_title', array(
    'label'     => esc_attr__( 'Top News Title', 'magazine-newspaper' ),
    'section' => 'magazine_newspaper_top_news_sections',
    'settings' => 'magazine_newspaper_top_news_section_title',
    'type'=> 'text',
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_top_news_category', array(
    'capability'  => 'edit_theme_options',        
    'sanitize_callback' => 'magazine_newspaper_sanitize_category',
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Customize_Dropdown_Taxonomies_Control(
    $wp_customize, 'magazine_newspaper_top_news_category', array(
      'label' => esc_html__( 'Top News Category', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_top_news_sections',
      'settings' => 'magazine_newspaper_top_news_category',
      'type' => 'dropdown-taxonomies',
  ) ) );

  $wp_customize->add_setting( 'magazine_newspaper_top_news_number_of_posts', array(
    'sanitize_callback'     =>  'sanitize_text_field',
    'default'               =>  '3'
  ) );

  $wp_customize->add_control( 'magazine_newspaper_top_news_number_of_posts', array(
    'label'     => esc_attr__( 'Number of posts', 'magazine-newspaper' ),
    'section' => 'magazine_newspaper_top_news_sections',
    'settings' => 'magazine_newspaper_top_news_number_of_posts',
    'type'=> 'text',
  ) );

}