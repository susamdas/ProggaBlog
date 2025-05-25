<?php

/**
 * Colors Settings
 *
 * @package magazine-newspaper
 */
add_action( 'customize_register', 'magazine_newspaper_change_colors_panel' );
function magazine_newspaper_change_colors_panel(  $wp_customize  ) {
    $wp_customize->get_section( 'colors' )->priority = 1;
    $wp_customize->remove_control( 'header_textcolor' );
    $wp_customize->get_section( 'colors' )->panel = 'magazine_newspaper_general_panel';
    $wp_customize->get_section( 'colors' )->title = esc_html__( 'Colors', 'magazine-newspaper' );
}

add_action( 'customize_register', 'magazine_newspaper_customize_color_options' );
function magazine_newspaper_customize_color_options(  $wp_customize  ) {
    $wp_customize->add_setting( 'primary_colors', array(
        'capability'        => 'edit_theme_options',
        'default'           => '#3e63b6',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'magazine_newspaper_sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'primary_colors', array(
        'label'    => __( 'Primary Color', 'magazine-newspaper' ),
        'section'  => 'colors',
        'settings' => 'primary_colors',
        'priority' => 1,
    )) );
    $wp_customize->add_setting( 'secondary_colors', array(
        'capability'        => 'edit_theme_options',
        'default'           => '#ffc000',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'magazine_newspaper_sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'secondary_colors', array(
        'label'    => __( 'Secondary Color', 'magazine-newspaper' ),
        'section'  => 'colors',
        'settings' => 'secondary_colors',
        'priority' => 2,
    )) );
    $wp_customize->add_setting( 'magazine_newspaper_colors_upgrade_to_pro', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Control_Upgrade_To_Pro($wp_customize, 'magazine_newspaper_colors_upgrade_to_pro', array(
        'section'     => 'colors',
        'settings'    => 'magazine_newspaper_colors_upgrade_to_pro',
        'title'       => __( 'Choose colors that perfectly align with your brand.', 'magazine-newspaper' ),
        'items'       => array(
            'one' => array(
                'title' => __( 'Additional color options for various parts of your website.', 'magazine-newspaper' ),
            ),
        ),
        'button_url'  => esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/#free-vs-pro' ),
        'button_text' => __( 'Upgrade Now', 'magazine-newspaper' ),
    )) );
}
