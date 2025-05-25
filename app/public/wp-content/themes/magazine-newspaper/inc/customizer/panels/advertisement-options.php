<?php
/**
 * Advertisement Settings
 *
 * @package magazine-newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_ad_panel' );

function magazine_newspaper_customize_register_ad_panel( $wp_customize ) {
	$wp_customize->add_panel( 'magazine_newspaper_ad_panel', array(
	    'priority'    => 13,
	    'title'       => esc_html__( 'Advertisement Options', 'magazine-newspaper' ),
	    'description' => esc_html__( 'Advertisement Options', 'magazine-newspaper' ),
	) );
}