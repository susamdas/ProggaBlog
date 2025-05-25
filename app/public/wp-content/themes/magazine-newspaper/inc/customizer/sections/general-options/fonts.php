<?php

/**
 * Fonts Settings
 *
 * @package magazine-newspaper
 */


add_action( 'customize_register', 'magazine_newspaper_customize_register_fonts_section' );

function magazine_newspaper_customize_register_fonts_section( $wp_customize ) {
  $wp_customize->add_section( 'magazine_newspaper_fonts_section', array(
    'title'          => esc_html__( 'Fonts', 'magazine-newspaper' ),
    'description'    => esc_html__( 'Fonts :', 'magazine-newspaper' ),
    'panel'          => 'magazine_newspaper_general_panel',
    'priority'       => 2,
  ) );
}

add_action( 'customize_register', 'magazine_newspaper_customize_font_family' );

function magazine_newspaper_customize_font_family( $wp_customize ) {

  $wp_customize->add_setting( 'magazine_newspaper_font_family', array(
      //'capability'  => 'edit_theme_options',
      'default'     => 'Raleway',
      'transport' => 'postMessage',
      'sanitize_callback' => 'magazine_newspaper_sanitize_google_fonts',
  ) );

  $wp_customize->add_control( 'magazine_newspaper_font_family', array(
      'settings'    => 'magazine_newspaper_font_family',
      'label'       =>  __( 'Choose Font Family For Your Site', 'magazine-newspaper' ),
      'section'     => 'magazine_newspaper_fonts_section',
      'type'        => 'select',
      'choices'     => google_fonts(),
      'priority'    => 1
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_font_size', array(
    'capability'  => 'edit_theme_options',
    'default'     => '14px',
    'transport' => 'postMessage',
    'sanitize_callback' => 'magazine_newspaper_sanitize_google_fonts',
  ) );
  
  $wp_customize->add_control( 'magazine_newspaper_font_size', array(
    'settings'    => 'magazine_newspaper_font_size',
    'label'       =>  __( 'Choose Font Size', 'magazine-newspaper' ),
    'section'     => 'magazine_newspaper_fonts_section',
    'type'        => 'select',
    'default'     => '14px',
    'choices'     =>  array(             
      '13px' => '13px',
      '14px' => '14px',
      '15px' => '15px',
      '16px' => '16px',
      '17px' => '17px',
      '18px' => '18px',
    ),
    'priority'    =>  2
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_font_weight', array(
    'default'           => 500,
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage',
  ) );
    
  $wp_customize->add_control( new Magazine_Newspaper_Slider_Control(
    $wp_customize, 'magazine_newspaper_font_weight', array(
      'section' => 'magazine_newspaper_fonts_section',
      'settings' => 'magazine_newspaper_font_weight',
      'label'   => esc_html__( 'Font Weight', 'magazine-newspaper' ),
      'priority' => 3,
      'choices'     => array(
        'min'  => 100,
        'max'  => 900,
        'step' => 100,
      ),
    ) 
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_line_height', array(
      'default'           => 22,
      'sanitize_callback' => 'absint',
      'transport' => 'postMessage',
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Slider_Control(
    $wp_customize, 'magazine_newspaper_line_height', array(
      'section' => 'magazine_newspaper_fonts_section',
      'settings' => 'magazine_newspaper_line_height',
      'label'   => esc_html__( 'Line Height', 'magazine-newspaper' ),
      'priority' => 4,
      'choices'     => array(
        'min'  => 13,
        'max'  => 53,
        'step' => 1,
      ),
  )
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_fonts_separator1', array(
    'sanitize_callback' => null,
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Separator_Control(
      $wp_customize, 'magazine_newspaper_fonts_separator1', array(
        'section' => 'magazine_newspaper_fonts_section',
        'priority'    => 5
      )
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_heading_options_text', array(
      'default' => '',
      'type' => 'customtext',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_text_field',
    ) );
      
  $wp_customize->add_control( new Magazine_Newspaper_Custom_Text(
    $wp_customize, 'magazine_newspaper_heading_options_text', array(
      'label' => esc_html__( 'Heading Options :', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_fonts_section',
      'settings' => 'magazine_newspaper_heading_options_text',
      'priority'    => 6
    ) 
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_heading_font_family', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'magazine_newspaper_sanitize_google_fonts',
    'default'     => 'Raleway',
  ) );

  $wp_customize->add_control( 'magazine_newspaper_heading_font_family', array(
    'settings'    => 'magazine_newspaper_heading_font_family',
    'label'       =>  esc_html__( 'Font Family', 'magazine-newspaper' ),
    'section'     => 'magazine_newspaper_fonts_section',
    'type'        => 'select',
    'choices'     => google_fonts(),
    'priority'    => 7
  ) );

  $wp_customize->add_setting( 'magazine_newspaper_heading_font_weight', array(
    'default'           => 400,
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage',
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Slider_Control(
    $wp_customize, 'magazine_newspaper_heading_font_weight', array(
      'section' => 'magazine_newspaper_fonts_section',
      'settings' => 'magazine_newspaper_heading_font_weight',
      'label'   => esc_html__( 'Font Weight', 'magazine-newspaper' ),
      'priority' => 8,
      'choices'     => array(
        'min'  => 100,
        'max'  => 900,
        'step' => 100,
      ),
    )
  ) );

  $default_size = array(
    '1' =>  28,
    '2' =>  24,
    '3' =>  22,
    '4' =>  19,
    '5' =>  16,
    '6' =>  14,
  );
    
  for( $i = 1; $i <= 6 ; $i++ ) {

    $wp_customize->add_setting( 'magazine_newspaper_heading_' . $i . '_size', array(
      'default'           => $default_size[$i],
      'sanitize_callback' => 'absint',
      'transport' => 'postMessage',
    ) );

    $wp_customize->add_control( 'magazine_newspaper_heading_' . $i . '_size', array(
      'type'  => 'number',
      'section'   => 'magazine_newspaper_fonts_section',
      'label' => esc_html__( 'Heading ', 'magazine-newspaper' ) . $i . esc_html__(' Size', 'magazine-newspaper' ),
      'priority' => 11,
      'input_attrs' => array(
        'min' => 10,
        'max' => 50,
        'step'  =>  1
      ),
    ) );
  }

  if ( fs_magazine_newspaper()->is_free_plan() ) {

    $wp_customize->add_setting( 'magazine_newspaper_fonts_upgrade_to_pro', array(
      'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Control_Upgrade_To_Pro(
      $wp_customize, 'magazine_newspaper_fonts_upgrade_to_pro', array(
        'section' => 'magazine_newspaper_fonts_section',
        'settings'    => 'magazine_newspaper_fonts_upgrade_to_pro',
        'title'   => __( 'Choose fonts that resonate with your target audience.', 'magazine-newspaper' ),
        'items' => array(
          'one'   => array(
            'title' => __( 'Select from more than 850 Google Fonts.', 'magazine-newspaper' ),
          ),
        ),
        'button_url'   => esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/#free-vs-pro' ),
        'button_text'   => __( 'Upgrade Now', 'magazine-newspaper' ),
        'priority'    => 110
      )
    ) );
  
  }

}


