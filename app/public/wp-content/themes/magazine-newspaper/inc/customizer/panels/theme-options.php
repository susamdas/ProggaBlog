<?php
/**
 * Homepage Settings
 *
 * @package magazine-newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_homepage_panel' );

function magazine_newspaper_customize_register_homepage_panel( $wp_customize ) {
	$wp_customize->add_panel( 'magazine_newspaper_theme_panel', array(
	    'priority'    => 12,
	    'title'       => esc_html__( 'Theme Options', 'magazine-newspaper' ),
	    'description' => esc_html__( 'Theme Options', 'magazine-newspaper' ),
	) );
}