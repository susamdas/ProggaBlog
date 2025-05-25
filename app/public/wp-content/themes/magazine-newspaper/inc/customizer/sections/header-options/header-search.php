<?php
/**
 * Header Layout Settings
 *
 * @package Magazine Newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_header_search_section' );

function magazine_newspaper_header_search_section( $wp_customize ) {

    $wp_customize->add_section( 'magazine_newspaper_header_search_section', array(
        'title'          => esc_html__( 'Header Search', 'magazine-newspaper' ),
        'panel'          => 'magazine_newspaper_header_panel',
        'priority'       => 3,
        'capability'     => 'edit_theme_options',
    ) );

    $wp_customize->add_setting( 'magazine_newspaper_header_search_display_option', array(
        'sanitize_callback'     =>  'magazine_newspaper_sanitize_checkbox',
        'default'               =>  true
    ) );
            
    $wp_customize->add_control( new Magazine_Newspaper_Toggle_Control(
        $wp_customize, 'magazine_newspaper_header_search_display_option', array(
            'label' => esc_html__( 'Hide / Show Header Search','magazine-newspaper' ),
            'section' => 'magazine_newspaper_header_search_section',
            'settings' => 'magazine_newspaper_header_search_display_option',
            'type'=> 'toggle',
            )
    ) );

    $wp_customize->selective_refresh->add_partial('magazine_newspaper_header_search_display_option', array(
        'selector' => '#magazine_newspaper_header_search_section'
    ));

}