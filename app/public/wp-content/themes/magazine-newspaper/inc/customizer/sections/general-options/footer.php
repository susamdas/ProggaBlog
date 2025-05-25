<?php
/**
 * Footer Settings
 *
 * @package magazine-newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_footer_section' );

function magazine_newspaper_customize_register_footer_section( $wp_customize ) {

  $wp_customize->add_section( 'magazine_newspaper_footer_section', array(
    'title'          => esc_attr__( 'Footer Section', 'magazine-newspaper' ),
    'description'    => esc_attr__( 'Footer text', 'magazine-newspaper' ),
    'panel'          => 'magazine_newspaper_general_panel',
    'priority'       => 5,
    'capability'     => 'edit_theme_options',
  ) );
  
  $wp_customize->add_setting( 'magazine_newspaper_copyright_text', array(
    'sanitize_callback'     =>  'wp_kses_post',
    'default'               =>  ''
  ) );

  $wp_customize->add_control( 'magazine_newspaper_copyright_text', array(
    'label'     => esc_attr__( 'Copyright Text', 'magazine-newspaper' ),
    'section' => 'magazine_newspaper_footer_section',
    'settings' => 'magazine_newspaper_copyright_text',
    'type'=> 'textarea',
  ) );

  $wp_customize->selective_refresh->add_partial( 'magazine_newspaper_copyright_text', array(
    'selector' => '.copyright',
    'render_callback' => 'magazine_newspaper_get_copyright'
  ) );

  if ( fs_magazine_newspaper()->is_free_plan() ) {
    $wp_customize->add_setting( 'magazine_newspaper_footer_upgrade_to_pro', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Control_Upgrade_To_Pro(
        $wp_customize, 'magazine_newspaper_footer_upgrade_to_pro', array(
            'section' => 'magazine_newspaper_footer_section',
            'settings'    => 'magazine_newspaper_footer_upgrade_to_pro',
            'title'   => __( 'Want the full control over your copyright?', 'magazine-newspaper' ),
            'items' => array(
                'one'   => array(
                    'title' => __( 'Remove WordPress links from the copyright', 'magazine-newspaper' ),
                ),
            ),
            'button_url'   => esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/#free-vs-pro' ),
            'button_text'   => __( 'Upgrade Now', 'magazine-newspaper' ),
        )
    ) );
    }

}