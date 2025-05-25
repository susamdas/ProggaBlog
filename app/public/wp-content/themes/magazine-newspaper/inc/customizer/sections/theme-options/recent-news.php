<?php
/**
 * Recent News Settings
 *
 * @package magazine-newspaper
 */

function get_dropdown_categories() {
  $terms = get_terms( 'category' );
  $cat = array();
  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    foreach ( $terms as $term ) {
      $cat[ $term->term_id ] = $term->name;
    }
  }
  return $cat;
}

add_action( 'customize_register', 'magazine_newspaper_customize_register_recent_news' );

function magazine_newspaper_customize_register_recent_news( $wp_customize ) {

  $wp_customize->add_section( 'magazine_newspaper_recent_news_sections', array(
    'title'          => esc_attr__( 'Recent News', 'magazine-newspaper' ),
    'description'    => esc_attr__( 'Recent News section.', 'magazine-newspaper' ),
    'panel'          => 'magazine_newspaper_theme_panel',
    'priority'       => 6,
    'capability'     => 'edit_theme_options',
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_recent_news_display', array(
    'sanitize_callback'     =>  'magazine_newspaper_sanitize_checkbox',
    'default'               =>  true
  ) );
          
  $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control(
    $wp_customize, 'magazine_newspaper_recent_news_display', array(
      'label'     => esc_attr__( 'Show Recent News', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_recent_news_sections',
      'settings' => 'magazine_newspaper_recent_news_display',
      'type'=> 'toggle',
    )
  ) );

  $wp_customize->selective_refresh->add_partial('magazine_newspaper_recent_news_display', array(
    'selector' => '#magazine_newspaper_recent_news_sections > .container'
  ));

  $wp_customize->add_setting( 'magazine_newspaper_recent_news_title', array(
    'sanitize_callback'     =>  'sanitize_text_field',
    'default'               =>  'Recent News'
  ) );

  $wp_customize->add_control( 'magazine_newspaper_recent_news_title', array(
    'label'     => esc_attr__( 'Recent News Title', 'magazine-newspaper' ),
    'section' => 'magazine_newspaper_recent_news_sections',
    'settings' => 'magazine_newspaper_recent_news_title',
    'type'=> 'text',
  ) );
  
  $wp_customize->add_setting( 'magazine_newspaper_recent_news_category', array(
    'capability'  => 'edit_theme_options',        
    'sanitize_callback' => 'magazine_newspaper_sanitize_category',
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Customize_Dropdown_Taxonomies_Control(
    $wp_customize, 'magazine_newspaper_recent_news_category', array(
      'label' => esc_html__( 'Recent News Category', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_recent_news_sections',
      'settings' => 'magazine_newspaper_recent_news_category',
      'type' => 'dropdown-taxonomies',
  ) ) );


  $wp_customize->add_setting( 'magazine_newspaper_recent_news_number_of_posts', array(
    'sanitize_callback'     =>  'sanitize_text_field',
    'default'               =>  '5'
  ) );

  $wp_customize->add_control( 'magazine_newspaper_recent_news_number_of_posts', array(
    'label'     => esc_attr__( 'Number of posts', 'magazine-newspaper' ),
    'section' => 'magazine_newspaper_recent_news_sections',
    'settings' => 'magazine_newspaper_recent_news_number_of_posts',
    'type'=> 'text',
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_recent_news_separator1', array(
    'sanitize_callback' => null,
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Separator_Control(
      $wp_customize, 'magazine_newspaper_recent_news_separator1', array(
        'section' => 'magazine_newspaper_recent_news_sections',
      )
  ) );

  $wp_customize->add_setting( new Magazine_Newspaper_Repeater_Setting(
    $wp_customize, 'magazine_newspaper_category_news_settings', array(
      'default'     => '',
      'sanitize_callback' => array( 'Magazine_Newspaper_Repeater_Setting', 'sanitize_repeater_setting' ),
    )
  ) );
    
  $wp_customize->add_control( new Magazine_Newspaper_Control_Repeater(
    $wp_customize, 'magazine_newspaper_category_news_settings',array(
      'section' => 'magazine_newspaper_recent_news_sections',
      'settings'    => 'magazine_newspaper_category_news_settings',
      'label'       => esc_attr__( 'Category News', 'magazine-newspaper' ),
      'description' => esc_attr__( 'Add one or more sections', 'magazine-newspaper' ),
      'type'=> 'repeater',
      'row_label' => array(
        'type'  => 'field',
        'value' => esc_attr__( 'Category section', 'magazine-newspaper' ),
        'field' => 'category_title',
      ),
      'fields' => array(
        'category_title' => array(
          'type'        => 'text',
          'label'       => esc_attr__( 'Title', 'magazine-newspaper' ),
          'default'     => '',
        ),
        'category_news' => array(
          'type'      => 'select',
          'label'     => esc_attr__( 'Category News', 'magazine-newspaper' ),
          'choices'   => get_dropdown_categories(),
        ),
        'number_of_posts' => array(
          'type'      => 'text',
          'label'     => esc_attr__( 'Number of posts', 'magazine-newspaper' ),
          'default'   => '3',
        ),
      ),
    )
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_recent_news_separator2', array(
    'sanitize_callback' => null,
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Separator_Control(
      $wp_customize, 'magazine_newspaper_recent_news_separator2', array(
        'section' => 'magazine_newspaper_recent_news_sections',
      )
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_recent_news_sidebar_layout', array(
    'capability'  => 'edit_theme_options',
    'sanitize_callback' => 'magazine_newspaper_sanitize_choices',
    'default'     => 'right-sidebar',
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Radio_Buttonset_Control(
    $wp_customize, 'magazine_newspaper_recent_news_sidebar_layout', array(
      'label' => esc_html__( 'Select sidebar layout', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_recent_news_sections',
      'settings' => 'magazine_newspaper_recent_news_sidebar_layout',
      'type'=> 'radio-buttonset',
      'choices'     => array(
        'left-sidebar' => esc_attr__( 'Sidebar at left', 'magazine-newspaper' ),
        'right-sidebar' => esc_attr__( 'Sidebar at right', 'magazine-newspaper' ),
        'no-sidebar' => esc_attr__( 'No sidebar', 'magazine-newspaper' ),
      ),
    )
  ) );

}