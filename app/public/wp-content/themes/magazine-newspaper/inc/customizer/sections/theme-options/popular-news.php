<?php
/**
 * Popular News Settings
 *
 * @package magazine-newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_popular_news' );

function magazine_newspaper_customize_register_popular_news( $wp_customize ) {
	
  $wp_customize->add_section( 'magazine_newspaper_popular_news_sections', array(
    'title'          => esc_attr__( 'Popular News', 'magazine-newspaper' ),
    'description'    => esc_attr__( 'Popular News section.', 'magazine-newspaper' ),
    'panel'          => 'magazine_newspaper_theme_panel',
    'priority'       => 5,
    'capability'     => 'edit_theme_options',
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_popular_news_display', array(
    'sanitize_callback'     =>  'magazine_newspaper_sanitize_checkbox',
    'default'               =>  true
  ) );
          
  $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control(
    $wp_customize, 'magazine_newspaper_popular_news_display', array(
      'label'     => esc_attr__( 'Show Popular News', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_popular_news_sections',
      'settings' => 'magazine_newspaper_popular_news_display',
      'type'=> 'toggle',
    )
  ) );

  $wp_customize->selective_refresh->add_partial('magazine_newspaper_popular_news_display', array(
    'selector' => '#magazine_newspaper_popular_news_sections > .container'
  ));

  $wp_customize->add_setting( 'magazine_newspaper_popular_news_title', array(
    'sanitize_callback'     =>  'sanitize_text_field',
    'default'               =>  'Popular News'
  ) );

  $wp_customize->add_control( 'magazine_newspaper_popular_news_title', array(
    'label'     => esc_attr__( 'Popular News Title', 'magazine-newspaper' ),
    'section' => 'magazine_newspaper_popular_news_sections',
    'settings' => 'magazine_newspaper_popular_news_title',
    'type'=> 'text',
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_popular_news_number_of_posts', array(
    'sanitize_callback'     =>  'sanitize_text_field',
    'default'               =>  '4'
  ) );

  $wp_customize->add_control( 'magazine_newspaper_popular_news_number_of_posts', array(
    'label'     => esc_attr__( 'Number of posts', 'magazine-newspaper' ),
    'section' => 'magazine_newspaper_popular_news_sections',
    'settings' => 'magazine_newspaper_popular_news_number_of_posts',
    'type'=> 'text',
  ) );

}