<?php
/**
 * Background Settings
 *
 * @package magazine-newspaper
 */


add_action( 'customize_register', 'magazine_newspaper_change_background_panel' );

function magazine_newspaper_change_background_panel( $wp_customize)  {
    $wp_customize->get_section( 'background_image' )->priority = 3;
    $wp_customize->get_section( 'background_image' )->panel = 'magazine_newspaper_general_panel';
}