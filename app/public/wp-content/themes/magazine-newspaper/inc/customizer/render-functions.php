<?php
/**
 * render callback function
 *
 * @package magazine-newspaper
 */

//copyright
function magazine_newspaper_get_copyright(){
    return get_theme_mod( 'magazine_newspaper_copyright_text', __( 'Powered by <a href="https://wordpress.org">WordPress</a> | Theme by <a href="https://thebootstrapthemes.com/">TheBootstrapThemes</a>', 'magazine-newspaper' ) );
}

// site title
function magazine_newspaper_customize_partial_blogname() {
    bloginfo( 'name' );
}

// site description
function magazine_newspaper_customize_partial_blogdescription() {
    bloginfo( 'description' );
}