<?php

/**
 * Template Name: Front Page 
 * The template used for displaying front page contents
 *
 * @package magazine-newspaper
 */
get_header();
$default = array(
    'top-news-section',
    'banner-news-section',
    'recent-news-section',
    'detail-news-section',
    'popular-news-section'
);
$sections = $default;
if ( !empty( $sections ) && is_array( $sections ) ) {
    foreach ( $sections as $section ) {
        get_template_part( 'template-parts/home-sections/' . $section, $section );
    }
}
get_footer();