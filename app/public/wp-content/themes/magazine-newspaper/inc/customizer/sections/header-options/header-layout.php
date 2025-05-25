<?php

/**
 * Header Layout Settings
 *
 * @package magazine-newspaper
 */
add_action( 'customize_register', 'magazine_newspaper_header_layout_section' );
function magazine_newspaper_header_layout_section(  $wp_customize  ) {
    $wp_customize->add_section( 'magazine_newspaper_header_layout_section', array(
        'title'      => esc_html__( 'Header Layout', 'magazine-newspaper' ),
        'panel'      => 'magazine_newspaper_header_panel',
        'priority'   => 6,
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_header_sticky_menu_option', array(
        'sanitize_callback' => 'magazine_newspaper_sanitize_checkbox',
        'default'           => false,
    ) );
    $wp_customize->add_control( 'magazine_newspaper_header_sticky_menu_option', array(
        'label'       => esc_attr__( 'Main menu sticky?', 'magazine-newspaper' ),
        'description' => esc_attr__( 'Check the box to make the main menu sticky.', 'magazine-newspaper' ),
        'section'     => 'magazine_newspaper_header_layout_section',
        'settings'    => 'magazine_newspaper_header_sticky_menu_option',
        'type'        => 'checkbox',
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_header_layouts_upgrade_to_pro', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Control_Upgrade_To_Pro($wp_customize, 'magazine_newspaper_header_layouts_upgrade_to_pro', array(
        'section'     => 'magazine_newspaper_header_layout_section',
        'settings'    => 'magazine_newspaper_header_layouts_upgrade_to_pro',
        'title'       => __( 'Arrange the elements in the header of your website to match your preferred style.', 'magazine-newspaper' ),
        'items'       => array(
            'one' => array(
                'title' => __( 'Choose between five beautiful layouts for your website header', 'magazine-newspaper' ),
            ),
        ),
        'button_url'  => esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/#free-vs-pro' ),
        'button_text' => __( 'Upgrade Now', 'magazine-newspaper' ),
    )) );
}
