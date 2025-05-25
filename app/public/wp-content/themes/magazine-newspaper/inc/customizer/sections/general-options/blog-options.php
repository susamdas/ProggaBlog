<?php

/**
 * Blog Options
 *
 * @package magazine-newspaper
 */
add_action( 'customize_register', 'magazine_newspaper_customize_blog_options' );
function magazine_newspaper_customize_blog_options(  $wp_customize  ) {
    $wp_customize->add_section( 'magazine_newspaper_blog_options', array(
        'title'       => esc_attr__( 'Blog Options', 'magazine-newspaper' ),
        'description' => esc_attr__( 'Customize Options on the Blog Page', 'magazine-newspaper' ),
        'panel'       => 'magazine_newspaper_general_panel',
        'priority'    => 4,
        'capability'  => 'edit_theme_options',
    ) );
    $wp_customize->add_setting( 'magazine_newspaper_blog_sidebar_layout', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_newspaper_sanitize_choices',
        'default'           => 'right-sidebar',
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Radio_Buttonset_Control($wp_customize, 'magazine_newspaper_blog_sidebar_layout', array(
        'label'    => esc_html__( 'Select sidebar layout', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_blog_options',
        'settings' => 'magazine_newspaper_blog_sidebar_layout',
        'type'     => 'radio-buttonset',
        'choices'  => array(
            'left-sidebar'  => esc_attr__( 'Sidebar at left', 'magazine-newspaper' ),
            'right-sidebar' => esc_attr__( 'Sidebar at right', 'magazine-newspaper' ),
            'no-sidebar'    => esc_attr__( 'No sidebar', 'magazine-newspaper' ),
        ),
    )) );
    $wp_customize->add_setting( 'magazine_newspaper_blog_details', array(
        'sanitize_callback' => 'magazine_newspaper_sanitize_array',
        'default'           => array('date', 'categories', 'tags'),
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Multi_Check_Control($wp_customize, 'magazine_newspaper_blog_details', array(
        'label'    => esc_attr__( 'Hide / Show Details', 'magazine-newspaper' ),
        'section'  => 'magazine_newspaper_blog_options',
        'settings' => 'magazine_newspaper_blog_details',
        'type'     => 'multi-check',
        'choices'  => array(
            'author'             => esc_attr__( 'Show post author', 'magazine-newspaper' ),
            'date'               => esc_attr__( 'Show post date', 'magazine-newspaper' ),
            'categories'         => esc_attr__( 'Show Categories', 'magazine-newspaper' ),
            'tags'               => esc_attr__( 'Show Tags', 'magazine-newspaper' ),
            'number_of_comments' => esc_attr__( 'Show number of comments', 'magazine-newspaper' ),
        ),
    )) );
    $wp_customize->add_setting( 'magazine_newspaper_blog_view_upgrade_to_pro', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Control_Upgrade_To_Pro($wp_customize, 'magazine_newspaper_blog_view_upgrade_to_pro', array(
        'section'     => 'magazine_newspaper_blog_options',
        'settings'    => 'magazine_newspaper_blog_view_upgrade_to_pro',
        'title'       => __( 'Choose how to arrange blog posts on the homepage.', 'magazine-newspaper' ),
        'items'       => array(
            'one' => array(
                'title' => __( 'Select from three different blog post layouts', 'magazine-newspaper' ),
            ),
        ),
        'button_url'  => esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/#free-vs-pro' ),
        'button_text' => __( 'Upgrade Now', 'magazine-newspaper' ),
    )) );
}
