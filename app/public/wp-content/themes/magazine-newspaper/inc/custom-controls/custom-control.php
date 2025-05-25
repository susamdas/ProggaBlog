<?php
if( ! function_exists( 'Magazine_Newspaper_register_custom_controls' ) ) :
/**
 * Register Custom Controls
*/
function Magazine_Newspaper_register_custom_controls( $wp_customize ) {
    
    // Load our custom control.
    require_once get_template_directory() . '/inc/custom-controls/toggle/class-toggle-control.php';
    require_once get_template_directory() . '/inc/custom-controls/repeater/class-repeater-setting.php';
    require_once get_template_directory() . '/inc/custom-controls/repeater/class-control-repeater.php';
    require_once get_template_directory() . '/inc/custom-controls/radioimg/class-radio-image-control.php';
    require_once get_template_directory() . '/inc/custom-controls/radiobtn/class-radio-buttonset-control.php';
    require_once get_template_directory() . '/inc/custom-controls/multicheck/class-multi-check-control.php';
    require_once get_template_directory() . '/inc/custom-controls/slider/class-slider-control.php';
    require_once get_template_directory() . '/inc/custom-controls/sortable/class-sortable-control.php';
    require_once get_template_directory() . '/inc/custom-controls/dropdown-taxonomies/class-dropdown-taxonomies-control.php';
    require_once get_template_directory() . '/inc/custom-controls/separator/class-separator-control.php';

    require_once get_template_directory() . '/inc/custom-controls/notes.php';

    require get_template_directory() . '/inc/custom-controls/upgrade-to-pro/class-section-pro-control.php';
    require get_template_directory() . '/inc/custom-controls/upgrade-to-pro/class-control-upgrade-to-pro.php';
            
    // Register the control types
    $wp_customize->register_control_type( 'Magazine_Newspaper_Toggle_Control' );
    $wp_customize->register_control_type( 'Magazine_Newspaper_Radio_Image_Control' );
    $wp_customize->register_control_type( 'Magazine_Newspaper_Radio_Buttonset_Control' );
    $wp_customize->register_control_type( 'Magazine_Newspaper_Multi_Check_Control' );
    $wp_customize->register_control_type( 'Magazine_Newspaper_Slider_Control' );
    $wp_customize->register_control_type( 'Magazine_Newspaper_Control_Sortable' );
    $wp_customize->register_control_type( 'Magazine_Newspaper_Separator_Control' );
    $wp_customize->register_section_type( 'Magazine_Newspaper_Customize_Section_Pro_Control' );
    $wp_customize->register_control_type( 'Magazine_Newspaper_Control_Upgrade_To_Pro' );
}
endif;
add_action( 'customize_register', 'Magazine_Newspaper_register_custom_controls' );

function magazine_newspaper_enqueue_custom_admin_style() {
        wp_register_style( 'magazine-newspaper-upgrade-to-pro', get_template_directory_uri() . '/inc/custom-controls/upgrade-to-pro/upgrade-to-pro.css', false );
        wp_enqueue_style( 'magazine-newspaper-upgrade-to-pro' );

        wp_enqueue_script( 'magazine-newspaper-upgrade-to-pro', get_template_directory_uri() . '/inc/custom-controls/upgrade-to-pro/upgrade-to-pro.js', array( 'jquery' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'magazine_newspaper_enqueue_custom_admin_style' );