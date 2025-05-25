<?php
define( 'SECTIONS_ORDER_VERSION', '1.0.0' );

require get_template_directory() . '/inc/customizer/sanitize-callback.php';

require get_template_directory() . '/inc/customizer/active-callback.php';

require get_template_directory() . '/inc/customizer/custom-controls.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jason_portfolio_resume_customize_register($wp_customize) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    // Custom logo text
    $wp_customize->add_setting(
        'logo_dark', array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'logo_dark',
            array(
                'label'      => esc_html__( 'Logo dark', 'jason-portfolio-resume' ),
                'section'         => 'title_tagline',
                'priority' => 9,
            )
        )
    );

    // Save order section
    $wp_customize->add_setting(
        'sections_order', array(
            'sanitize_callback' => 'jason_portfolio_resume_sanitize_sections_order',
        )
    );
    $wp_customize->add_control(
        'sections_order', array(
            'section'  => 'static_front_page',
            'type'     => 'hidden',
            'priority' => 80,
        )
    );

    // Homepage Settings - Enable Homepage Content.
    $wp_customize->add_setting(
        'jason_portfolio_resume_enable_frontpage_content',
        array(
            'default'           => false,
            'sanitize_callback' => 'jason_portfolio_resume_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'jason_portfolio_resume_enable_frontpage_content',
        array(
            'label'           => esc_html__( 'Enable Homepage Content', 'jason-portfolio-resume' ),
            'description'     => esc_html__( 'Check to enable content on static homepage.', 'jason-portfolio-resume' ),
            'section'         => 'static_front_page',
            'type'            => 'checkbox',
            'active_callback' => 'jason_portfolio_resume_is_static_homepage_enabled',
        )
    );

    // Front Page Options.
    require get_template_directory() . '/inc/customizer/front-page-options.php';
    $wp_customize->register_control_type( 'Jason_Portfolio_Resume_Customize_Select_Multiple' );
}
add_action( 'customize_register', 'jason_portfolio_resume_customize_register' );

function jason_portfolio_section_order_section_priority( $value, $key = '' ) {
    $orders = get_theme_mod( 'sections_order' );
    if ( ! empty( $orders ) ) {
        $json = json_decode( $orders );
        if ( isset( $json->$key ) ) {
            return $json->$key;
        }
    }

    return $value;
}
add_filter( 'section_priority', 'jason_portfolio_section_order_section_priority', 10, 2 );

/**
 * Function to refresh customize preview when changing sections order
 */
function jason_portfolio_resume_sections() {
    $section_order         = get_theme_mod( 'sections_order' ); // Edit this
    $section_order_decoded = json_decode( $section_order, true );
    if ( ! empty( $section_order_decoded ) ) {
        remove_all_actions( 'theme_sections' );
        foreach ( $section_order_decoded as $k => $priority ) {
            if ( function_exists( $k ) ) {
                add_action( 'theme_sections', $k, $priority );
            }
        }
    }
}
add_action( 'customize_preview_init', 'jason_portfolio_resume_sections', 1 );

if ( ! function_exists( 'jason_portfolio_resume_about_section' ) ) {
    function jason_portfolio_resume_about_section() {
        require get_template_directory() . '/sections/about.php';
    }
}
if ( ! function_exists( 'jason_portfolio_resume_resume_section' ) ) {
    function jason_portfolio_resume_resume_section() {
        require get_template_directory() . '/sections/resume.php';
    }
}
if ( ! function_exists( 'jason_portfolio_resume_project_section' ) ) {
    function jason_portfolio_resume_project_section() {
        require get_template_directory() . '/sections/project.php';
    }
}
if ( ! function_exists( 'jason_portfolio_resume_service_section' ) ) {
    function jason_portfolio_resume_service_section() {
        require get_template_directory() . '/sections/service.php';
    }
}
if ( ! function_exists( 'jason_portfolio_resume_client_section' ) ) {
    function jason_portfolio_resume_client_section() {
        require get_template_directory() . '/sections/client.php';
    }
}
if ( ! function_exists( 'jason_portfolio_resume_price_section' ) ) {
    function jason_portfolio_resume_price_section() {
        require get_template_directory() . '/sections/price.php';
    }
}
if ( ! function_exists( 'jason_portfolio_resume_blog_section' ) ) {
    function jason_portfolio_resume_blog_section() {
        require get_template_directory() . '/sections/blog.php';
    }
}
if ( ! function_exists( 'jason_portfolio_resume_contact_section' ) ) {
    function jason_portfolio_resume_contact_section() {
        require get_template_directory() . '/sections/contact.php';
    }
}
/**
 * Enqueue script for custom customize control.
 */
function jason_portfolio_resume_custom_control_scripts() {
    // Append .min if SCRIPT_DEBUG is false.
    $min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    wp_enqueue_style( 'jason-portfolio-resume-custom-controls-css', get_template_directory_uri() . '/assets/css/custom-controls.css', array(), '1.0', 'all' );
    wp_enqueue_script( 'jason-portfolio-resume-custom-controls-js', get_template_directory_uri() . '/assets/js/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), JASON_PORTFOLIO_RESUME_VERSION, true );

    wp_enqueue_script( 'jason-portfolio-resume-order-script', get_template_directory_uri() . '/assets/js/customizer-sections-order.js', array( 'jquery', 'jquery-ui-sortable' ), JASON_PORTFOLIO_RESUME_VERSION, true );
    $control_settings = array(
        'sections_container' => '#sub-accordion-panel-jason_portfolio_resume_front_page_options',
        'saved_data_input'   => '#customize-control-sections_order input',
    );
    wp_localize_script( 'jason-portfolio-resume-order-script', 'control_settings', $control_settings );
    wp_enqueue_style( 'jason-portfolio-resume-order-style', get_template_directory_uri() . '/assets/css/customizer-sections-order-style.css', array( 'dashicons' ), JASON_PORTFOLIO_RESUME_VERSION );

}
add_action( 'customize_controls_enqueue_scripts', 'jason_portfolio_resume_custom_control_scripts' );