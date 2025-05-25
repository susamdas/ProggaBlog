<?php
/**
 * Front Page Options
 *
 * @package Jason_Portfolio_Resume
 */

$wp_customize->add_panel(
    'jason_portfolio_resume_theme_options',
    array(
        'title'    => esc_html__( 'Theme Options', 'jason-portfolio-resume' ),
        'priority' => 130,
    )
);

$wp_customize->add_panel(
    'jason_portfolio_resume_front_page_options',
    array(
        'title'    => esc_html__( 'Front Page Sections', 'jason-portfolio-resume' ),
        'priority' => 130,
    )
);
require get_template_directory() . '/inc/customizer/front-page-options/about.php';
require get_template_directory() . '/inc/customizer/front-page-options/resume.php';
require get_template_directory() . '/inc/customizer/front-page-options/project.php';
require get_template_directory() . '/inc/customizer/front-page-options/service.php';
require get_template_directory() . '/inc/customizer/front-page-options/client.php';
require get_template_directory() . '/inc/customizer/front-page-options/price.php';
require get_template_directory() . '/inc/customizer/front-page-options/blog.php';
require get_template_directory() . '/inc/customizer/front-page-options/contact.php';
require get_template_directory() . '/inc/customizer/front-page-options/footer-options.php';
require get_template_directory() . '/inc/customizer/front-page-options/left-options.php';
require get_template_directory() . '/inc/customizer/front-page-options/sidebar-layout.php';
