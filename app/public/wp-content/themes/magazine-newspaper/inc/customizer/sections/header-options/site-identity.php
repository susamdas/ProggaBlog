<?php
/**
 * Site Identity Settings
 *
 * @package Magazine Newspaper
 */


add_action( 'customize_register', 'magazine_newspaper_change_site_identity_panel' );

function magazine_newspaper_change_site_identity_panel( $wp_customize)  {
  $wp_customize->get_section( 'title_tagline' )->priority = 1;
  $wp_customize->get_section( 'title_tagline' )->panel = 'magazine_newspaper_header_panel';

  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

  $wp_customize->selective_refresh->add_partial('blogname', array(
    'selector'        => '.site-title',
    'render_callback' => 'magazine_newspaper_customize_partial_blogname',
  ) );

  $wp_customize->selective_refresh->add_partial('blogdescription', array(
    'selector'        => '.site-description',
    'render_callback' => 'magazine_newspaper_customize_partial_blogdescription',
  ) );
}

add_action( 'customize_register', 'magazine_newspaper_site_identity_settings' );

function magazine_newspaper_site_identity_settings( $wp_customize ) {

  $wp_customize->add_setting( 'site_title_color_option', array(
    'capability'  => 'edit_theme_options',
    'default'     => '#000',
    'transport' => 'postMessage',
    'sanitize_callback' => 'magazine_newspaper_sanitize_hex_color'
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize, 'site_title_color_option', array(
    'label'      => esc_html__( 'Title Color', 'magazine-newspaper' ),
    'section'    => 'title_tagline',
    'settings'   => 'site_title_color_option',
    )
  ) );

  $wp_customize->add_setting( 'site_title_size_option', array(
    'default'           => 30,
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage',
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Slider_Control(
    $wp_customize, 'site_title_size_option', array(
      'section' => 'title_tagline',
      'settings' => 'site_title_size_option',
      'label'   => esc_html__( 'Title Size', 'magazine-newspaper' ),
      'choices'     => array(
        'min'   => 15,
        'max'   => 60,
        'step'  => 1,
      )
    )
  ) );

  $wp_customize->add_setting( 'site_title_font_family', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'magazine_newspaper_sanitize_google_fonts',
    'default'     => 'Poppins',
  ) );

  $wp_customize->add_control( 'site_title_font_family', array(
    'settings'    => 'site_title_font_family',
    'label'       =>  esc_html__( 'Title Font Family', 'magazine-newspaper' ),
    'section'     => 'title_tagline',
    'type'        => 'select',
    'choices'     => google_fonts(),
  ) );

}