<?php
/**
 * Active Callbacks
 *
 * @package Jason_Portfolio_Resume
 */

// Theme Options.
function jason_portfolio_resume_is_pagination_enabled( $control ) {
	return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_pagination' )->value() );
}
function jason_portfolio_resume_is_breadcrumb_enabled( $control ) {
	return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_breadcrumb' )->value() );
}

// About Section
function jason_portfolio_resume_is_skill_section_enabled( $control ) {
	return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_about_section' )->value() );
}

// Check if static home page is enabled.
function jason_portfolio_resume_is_static_homepage_enabled( $control ) {
	return ( 'page' === $control->manager->get_setting( 'show_on_front' )->value() );
}
function jason_portfolio_resume_is_about_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_about_section' )->value() );
}
function jason_portfolio_resume_is_resume_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_resume_section' )->value() );
}
function jason_portfolio_resume_is_project_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_project_section' )->value() );
}
function jason_portfolio_resume_is_service_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_service_section' )->value() );
}
function jason_portfolio_resume_is_client_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_client_section' )->value() );
}
function jason_portfolio_resume_is_price_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_price_section' )->value() );
}
function jason_portfolio_resume_is_blog_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_blog_section' )->value() );
}
function jason_portfolio_resume_is_contact_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'jason_portfolio_resume_enable_contact_section' )->value() );
}