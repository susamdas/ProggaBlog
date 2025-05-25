<?php
/**
 * Post Layout Settings
 *
 * @package magazine-newspaper
 */

add_action( 'customize_register', 'magazine_newspaper_customize_register_post_layout' );

function magazine_newspaper_customize_register_post_layout( $wp_customize ) {

	$wp_customize->add_section( 'magazine_newspaper_post_layout_section', array(
    'title'          => esc_attr__( 'Post Options', 'magazine-newspaper' ),
	  'description'    => esc_attr__( 'Single Post Options of default Layout', 'magazine-newspaper' ),
    'panel'          => 'magazine_newspaper_general_panel',
    'priority'       => 5,
    'capability'     => 'edit_theme_options',
  ) );
	
	$wp_customize->add_setting( 'magazine_newspaper_post_sidebar_layout', array(
    'capability'  => 'edit_theme_options',
    'sanitize_callback' => 'magazine_newspaper_sanitize_choices',
    'default'     => 'right-sidebar',
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Radio_Buttonset_Control(
    $wp_customize, 'magazine_newspaper_post_sidebar_layout', array(
      'label' => esc_html__( 'Select sidebar layout', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_post_layout_section',
      'settings' => 'magazine_newspaper_post_sidebar_layout',
      'type'=> 'radio-buttonset',
      'choices'     => array(
        'left-sidebar' => esc_attr__( 'Sidebar at left', 'magazine-newspaper' ),
        'right-sidebar' => esc_attr__( 'Sidebar at right', 'magazine-newspaper' ),
        'no-sidebar' => esc_attr__( 'No sidebar', 'magazine-newspaper' ),
      ),
    )
  ) );

	$wp_customize->add_setting( 'magazine_newspaper_post_details', array(
    'sanitize_callback' => 'magazine_newspaper_sanitize_array',
    'default'     => array( 'date', 'categories', 'tags', 'author_block' ),
  ) );

  $wp_customize->add_control( new Magazine_Newspaper_Multi_Check_Control(
    $wp_customize, 'magazine_newspaper_post_details', array(
      'label'       => esc_attr__( 'Hide / Show Details', 'magazine-newspaper' ),
      'section' => 'magazine_newspaper_post_layout_section',
      'settings' => 'magazine_newspaper_post_details',
      'type'=> 'multi-check',
      'choices'     => array(
        'author' => esc_attr__( 'Show post author', 'magazine-newspaper' ),
				'date' => esc_attr__( 'Show post date', 'magazine-newspaper' ),		
				'categories' => esc_attr__( 'Show Categories', 'magazine-newspaper' ),
				'tags' => esc_attr__( 'Show Tags', 'magazine-newspaper' ),
				'number_of_comments' => esc_attr__( 'Show number of comments', 'magazine-newspaper' ),
				'author_block' => esc_attr__( 'Show Author Block', 'magazine-newspaper' ),
      ),
  	)
  ) );
}
