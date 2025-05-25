<?php

/**
 * Magazine Newspaper Theme Customizer
 *
 * @package magazine-newspaper
 */
$panels = array(
    'general-options',
    'header-options',
    'theme-options',
    'advertisement-options'
);
add_action( 'customize_register', 'magazine_newspaper_change_homepage_settings_options' );
function magazine_newspaper_change_homepage_settings_options(  $wp_customize  ) {
    $wp_customize->get_section( 'title_tagline' )->priority = 12;
    $wp_customize->get_section( 'static_front_page' )->priority = 13;
    $wp_customize->remove_control( 'header_textcolor' );
    require get_template_directory() . '/inc/google-fonts.php';
}

$general_sections = array(
    'blog-options',
    'post-options',
    'colors',
    'fonts',
    'background',
    'footer',
    'pagination'
);
$header_sections = array(
    'header-image',
    'site-identity',
    'header-search',
    'social-media',
    'header-layout'
);
$theme_sections = array(
    'breaking-news',
    'detail-news',
    'top-news',
    'banner-news',
    'recent-news',
    'popular-news'
);
$ad_section = array('header-ad', 'ad-slider');
if ( !empty( $panels ) ) {
    foreach ( $panels as $panel ) {
        require get_template_directory() . '/inc/customizer/panels/' . $panel . '.php';
    }
}
if ( !empty( $general_sections ) ) {
    foreach ( $general_sections as $section ) {
        require get_template_directory() . '/inc/customizer/sections/general-options/' . $section . '.php';
    }
}
if ( !empty( $header_sections ) ) {
    foreach ( $header_sections as $section ) {
        require get_template_directory() . '/inc/customizer/sections/header-options/' . $section . '.php';
    }
}
if ( !empty( $theme_sections ) ) {
    foreach ( $theme_sections as $section ) {
        require get_template_directory() . '/inc/customizer/sections/theme-options/' . $section . '.php';
    }
}
if ( !empty( $ad_section ) ) {
    foreach ( $ad_section as $section ) {
        require get_template_directory() . '/inc/customizer/sections/ad-options/' . $section . '.php';
    }
}
require get_template_directory() . '/inc/customizer/sections/sort-homepage-section.php';
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function magazine_newspaper_customize_preview_js() {
    wp_enqueue_script(
        'magazine-newspaper-customizer-preview',
        get_template_directory_uri() . '/inc/js/customizer.js',
        array('jquery'),
        MAGAZINE_NEWSPAPER_VERSION,
        true
    );
}

add_action( 'customize_preview_init', 'magazine_newspaper_customize_preview_js' );
function magazine_newspaper_customizer_scripts() {
    wp_enqueue_script(
        'magazine_newspaper_customize',
        get_template_directory_uri() . '/inc/js/customize.js',
        array('jquery'),
        MAGAZINE_NEWSPAPER_VERSION,
        true
    );
    $array = array(
        'home' => get_home_url(),
    );
    wp_localize_script( 'magazine_newspaper_customize', 'data', $array );
}

add_action( 'customize_controls_enqueue_scripts', 'magazine_newspaper_customizer_scripts' );
/**
 * Binds Customizer CSS directives for free theme version.
 */
function magazine_newspaper_customizer_css() {
    wp_enqueue_style(
        'magazine_newspaper_customizer_css',
        get_template_directory_uri() . '/inc/css/customizer.css',
        array(),
        MAGAZINE_NEWSPAPER_VERSION
    );
}

if ( fs_magazine_newspaper()->is_free_plan() ) {
    add_action( 'customize_controls_enqueue_scripts', 'magazine_newspaper_customizer_css' );
}
/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';
/**
 * Render Callback Functions
*/
require get_template_directory() . '/inc/customizer/render-functions.php';
require get_template_directory() . '/inc/customizer/sections/upgrade-to-pro.php';