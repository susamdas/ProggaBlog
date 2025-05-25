<?php
/**
 * Magazine Newspaper Pro Theme Info
 *
 * @package magazine-newspaper
 */

function magazine_newspaper_customizer_upgrade_to_pro( $wp_customize ) {

	$wp_customize->add_section( new Magazine_Newspaper_Customize_Section_Pro_Control(
		$wp_customize, 'upgrade-to-pro',	array(
			'type'	=> 'upgrade-to-pro',
			'pro_text' => esc_html__( 'Check options available in Pro version', 'magazine-newspaper' ),
			'pro_url'  => esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/#free-vs-pro' ),
			'priority' => 1
		)
	)	);
}
add_action( 'customize_register', 'magazine_newspaper_customizer_upgrade_to_pro' );