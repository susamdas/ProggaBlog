<?php

/**
 * Advertisement Slider Settings
 *
 * @package magazine-newspaper
 */
add_action( 'customize_register', 'magazine_newspaper_customize_register_ad_slider' );
function magazine_newspaper_customize_register_ad_slider(  $wp_customize  ) {
    $wp_customize->add_section( 'magazine_newspaper_ad_slider_section', array(
        'title'    => esc_html__( 'Advertisement Slider', 'magazine-newspaper' ),
        'panel'    => 'magazine_newspaper_ad_panel',
        'priority' => 2,
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_ad_slider_upgrade_to_pro', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Control_Upgrade_To_Pro($wp_customize, 'magazine_newspaper_ad_slider_upgrade_to_pro', array(
        'section'     => 'magazine_newspaper_ad_slider_section',
        'settings'    => 'magazine_newspaper_ad_slider_upgrade_to_pro',
        'title'       => __( 'Looking to make some extra money from your blog? Monetize your website easily with this option.', 'magazine-newspaper' ),
        'items'       => array(
            'one' => array(
                'title' => __( 'Place advertisement slider to the body of your website', 'magazine-newspaper' ),
            ),
            'two' => array(
                'title' => __( 'Display multiple advertisement banners with dynamic transitions', 'magazine-newspaper' ),
            ),
        ),
        'button_url'  => esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/#free-vs-pro' ),
        'button_text' => __( 'Upgrade Now', 'magazine-newspaper' ),
    )) );
}
