<?php

/**
 * Pagination Settings
 *
 * @package magazine-newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_pagination_section' );

function magazine_newspaper_customize_register_pagination_section( $wp_customize ) {

  $wp_customize->add_section( 'magazine_newspaper_pagination_section', array(
    'title'          => esc_html__( 'Pagination', 'magazine-newspaper' ),
    'panel'          => 'magazine_newspaper_general_panel',
    'priority'       => 7,
    'capability'     => 'edit_theme_options',
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_pagination_type', array(
      'sanitize_callback' => 'magazine_newspaper_sanitize_choices',
      'default'     => 'number-pagination',
      'capability'  => 'edit_theme_options',
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Radio_Buttonset_Control(
    $wp_customize, 'magazine_newspaper_pagination_type', array(
      'label'    => esc_html__( 'Choose pagination style', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_pagination_section',
      'settings' => 'magazine_newspaper_pagination_type',
      'type'=> 'radio-buttonset',
      'choices'     => array(
        'number-pagination'    =>  esc_html__( 'Number Pagination', 'magazine-newspaper' ),
        'ajax-loadmore' => esc_html__( 'Ajax Loadmore', 'magazine-newspaper' ),
      ),
    )
  ) );

  $wp_customize->selective_refresh->add_partial('magazine_newspaper_pagination_type', array(
    'selector' => '#magazine_newspaper_pagination'
  ));
}