<?php

/**
 * Header Advertisement Settings
 *
 * @package magazine-newspaper
 */
add_action( 'customize_register', 'magazine_newspaper_customize_register_header_ad' );
function magazine_newspaper_customize_register_header_ad(  $wp_customize  ) {
    $wp_customize->add_section( 'magazine_newspaper_header_ad_sections', array(
        'title'    => esc_html__( 'Header Advertisement', 'magazine-newspaper' ),
        'panel'    => 'magazine_newspaper_ad_panel',
        'priority' => 1,
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_header_ad_upgrade_to_pro', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Control_Upgrade_To_Pro($wp_customize, 'magazine_newspaper_header_ad_upgrade_to_pro', array(
        'section'     => 'magazine_newspaper_header_ad_sections',
        'settings'    => 'magazine_newspaper_header_ad_upgrade_to_pro',
        'title'       => __( 'Looking to make some extra money from your blog? Monetize your website easily with this option.', 'magazine-newspaper' ),
        'items'       => array(
            'one' => array(
                'title' => __( 'Place advertisement banner at the header of your website', 'magazine-newspaper' ),
            ),
        ),
        'button_url'  => esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/#free-vs-pro' ),
        'button_text' => __( 'Upgrade Now', 'magazine-newspaper' ),
    )) );
}
