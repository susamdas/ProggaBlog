<?php

/**
 * Magazine Newspaper functions and definitions
 *
 * @package magazine-newspaper
 */
// freemius integration start
if ( !function_exists( 'fs_magazine_newspaper' ) ) {
    // Create a helper function for easy SDK access.
    function fs_magazine_newspaper() {
        global $fs_magazine_newspaper;
        if ( !isset( $fs_magazine_newspaper ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $fs_magazine_newspaper = fs_dynamic_init( array(
                'id'             => '6395',
                'slug'           => 'magazine-newspaper',
                'premium_slug'   => 'magazine-newspaper-pro',
                'type'           => 'theme',
                'public_key'     => 'pk_ad07e3fb2412d715fc88a9b25072b',
                'is_premium'     => false,
                'premium_suffix' => 'Pro',
                'has_addons'     => false,
                'has_paid_plans' => true,
                'navigation'     => 'tabs',
                'menu'           => array(
                    'slug'        => 'magazine-newspaper',
                    'parent'      => array(
                        'slug' => 'themes.php',
                    ),
                    'first-path'  => 'themes.php?page=magazine-newspaper',
                    'contact'     => true,
                    'account'     => true,
                    'support'     => false,
                    'addons'      => false,
                    'affiliation' => false,
                    'pricing'     => false,
                ),
                'is_live'        => true,
            ) );
        }
        return $fs_magazine_newspaper;
    }

    // Init Freemius.
    fs_magazine_newspaper();
    // Signal that SDK was initiated.
    do_action( 'fs_magazine_newspaper_loaded' );
}
// freemius integration end
if ( !defined( 'MAGAZINE_NEWSPAPER_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( 'MAGAZINE_NEWSPAPER_VERSION', '3.5.0' );
}
if ( !function_exists( 'magazine_newspaper_setup' ) ) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function magazine_newspaper_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on magazine-newspaper, use a find and replace
         * to change 'magazine-newspaper' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'magazine-newspaper', get_template_directory() . '/languages' );
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'post-templates' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'register_block_style' );
        add_theme_support( 'register_block_pattern' );
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'top'     => esc_html__( 'Top Menu', 'magazine-newspaper' ),
            'primary' => esc_html__( 'Primary Menu', 'magazine-newspaper' ),
        ) );
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ) );
        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'custom-logo', array(
            'height'     => 90,
            'width'      => 400,
            'flex-width' => true,
        ) );
        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'magazine_newspaper_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
        add_theme_support( "custom-header", array(
            'default-color' => 'ffffff',
        ) );
        add_editor_style();
        // Define Image Sizes:
        add_image_size(
            'banner',
            717,
            401,
            true
        );
    }

    // magazine_newspaper_setup
}
add_action( 'after_setup_theme', 'magazine_newspaper_setup' );
/**
 * Enqueue scripts and styles.
 */
function magazine_newspaper_scripts() {
    $font_family = get_theme_mod( 'magazine_newspaper_font_family', 'Raleway' );
    $site_title_font_family = esc_attr( get_theme_mod( 'site_title_font_family', 'Poppins' ) );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.css' );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
    wp_enqueue_style( 'owl', get_template_directory_uri() . '/css/owl.carousel.css' );
    wp_enqueue_style( 'magazine-newspaper-googlefonts', 'https://fonts.googleapis.com/css?family=' . esc_attr( $font_family ) . ':200,300,400,500,600,700,800,900|' . $site_title_font_family . ':200,300,400,500,600,700,800,900' );
    wp_enqueue_style( 'magazine-newspaper-style', get_stylesheet_uri() );
    if ( is_rtl() ) {
        wp_enqueue_style( 'magazine-newspaper-style', get_stylesheet_uri() );
        wp_style_add_data( 'magazine-newspaper-style', 'rtl', 'replace' );
        wp_enqueue_style( 'magazine-newspaper-css-rtl', get_template_directory_uri() . '/css/bootstrap-rtl.css' );
        wp_enqueue_script(
            'magazine-newspaper-js-rtl',
            get_template_directory_uri() . '/js/bootstrap.rtl.js',
            array('jquery'),
            BOOTSTRAP_COACH_VERSION,
            true
        );
    }
    // Detect Adblock and show custom message on enable.
    if ( get_theme_mod( 'magazine_newspaper_enable_ad_blocker_message', true ) ) {
        $ad_blocker_message = get_theme_mod( 'magazine_newspaper_custom_message_to_ad_blockers', esc_attr__( 'Please disable ad blocker!', 'magazine-newspaper' ) );
        // Register the script
        wp_register_script( 'detect', get_template_directory_uri() . '/js/detect.js' );
        $data_ad_blocker = array(
            'ad_blocker_message' => esc_attr( $ad_blocker_message ),
        );
        wp_localize_script( 'detect', 'php_vars', $data_ad_blocker );
        wp_enqueue_script(
            'ads',
            get_template_directory_uri() . '/js/ads.js',
            array('jquery'),
            '1.0.0',
            false
        );
        wp_enqueue_script(
            'detect',
            get_template_directory_uri() . '/js/detect.js',
            array('jquery'),
            '1.0.0',
            false
        );
    }
    wp_enqueue_script(
        'bootstrap',
        get_template_directory_uri() . '/js/bootstrap.js',
        array('jquery'),
        '5.0.0',
        true
    );
    wp_enqueue_script(
        'wow',
        get_template_directory_uri() . '/js/wow.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_enqueue_script(
        'owl',
        get_template_directory_uri() . '/js/owl.carousel.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_enqueue_script(
        'ticker',
        get_template_directory_uri() . '/js/jquery.vticker.min.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_enqueue_script(
        'magazine-newspaper-scripts',
        get_template_directory_uri() . '/js/script.js',
        array('jquery'),
        MAGAZINE_NEWSPAPER_VERSION,
        true
    );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    // Ajax loadmore
    $category = '';
    if ( is_front_page() && !is_home() ) {
        $category = get_theme_mod( 'magazine_newspaper_detail_news_category' );
    }
    $args = array(
        'post_type' => 'post',
        'cat'       => absint( $category ),
        'paged'     => ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 ),
    );
    $wp_query = new WP_Query($args);
    wp_register_script( 'magazine_newspaper_loadmore', get_template_directory_uri() . '/js/loadmore.js', array('jquery') );
    wp_localize_script( 'magazine_newspaper_loadmore', 'magazine_newspaper_loadmore_params', array(
        'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
        'current_page' => ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 ),
        'max_page'     => $wp_query->max_num_pages,
        'cat'          => absint( $category ),
    ) );
    wp_enqueue_script( 'magazine_newspaper_loadmore' );
}

add_action( 'wp_enqueue_scripts', 'magazine_newspaper_scripts' );
/**
 * Required Plugins
 */
add_theme_support( 'required-plugins', array(array(
    'slug'            => 'tbthemes-demo-import',
    'name'            => 'TBThemes Theme Import',
    'active_filename' => 'tbthemes-demo-import/tbthemes-demo-import.php',
)) );
function magazine_newspaper_load_more_ajax() {
    if ( isset( $_POST['page'] ) ) {
        $args['paged'] = absint( $_POST['page'] + 1 );
    }
    $args['post_status'] = esc_html( 'publish' );
    $args['cat'] = absint( $_POST['cat'] );
    $wp_query = new WP_Query($args);
    if ( $wp_query->have_posts() ) {
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            get_template_part( 'template-parts/content', null, array(
                'view' => $_POST['view'],
            ) );
        }
    }
    die;
    // here we exit the script and even no wp_reset_query() required!
}

add_action( 'wp_ajax_magazine_newspaper_loadmore', 'magazine_newspaper_load_more_ajax' );
add_action( 'wp_ajax_nopriv_magazine_newspaper_loadmore', 'magazine_newspaper_load_more_ajax' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( !isset( $content_width ) ) {
    $content_width = 900;
}
function magazine_newspaper_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'magazine_newspaper_content_width', 640 );
}

add_action( 'after_setup_theme', 'magazine_newspaper_content_width', 0 );
function magazine_newspaper_filter_front_page_template(  $template  ) {
    return ( is_home() ? '' : $template );
}

add_filter( 'frontpage_template', 'magazine_newspaper_filter_front_page_template' );
/**
* Call Widget page
**/
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/breadcrumbs.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom contrl
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
/**
 * Register Custom Navigation Walker
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
/**
 * Demo Content Section
 */
require get_template_directory() . '/inc/demo-content.php';
/**
 * Dynamic css
 */
require get_template_directory() . '/inc/dynamic-css.php';
/**
 * Add theme compatibility function for woocommerce if active
*/
if ( class_exists( 'woocommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce-functions.php';
}
// Remove default "Category or Tags" from title
add_filter( 'get_the_archive_title', 'remove_default_tax_title' );
function remove_default_tax_title(  $title  ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    }
    return $title;
}

if ( !function_exists( 'magazine_newspaper_home_section_enable' ) ) {
    /**
     * Check if home page section are enable or not.
     */
    function magazine_newspaper_home_section_enable() {
        $magazine_newspaper_sections = array(
            'magazine-newspaper-home-about-page',
            'magazine-newspaper-home-slider-page-1',
            'magazine-newspaper-home-slider-page-2',
            'magazine-newspaper-home-slider-page-3',
            'features_display',
            'testimonial_display',
            'crew_display',
            'client_display'
        );
        $enable_section = false;
        foreach ( $magazine_newspaper_sections as $section ) {
            if ( get_theme_mod( $section ) != "" ) {
                $enable_section = true;
            }
        }
        return $enable_section;
    }

}
// Popular Posts
if ( !function_exists( 'magazine_newspaper_set_post_views' ) ) {
    function magazine_newspaper_set_post_views(  $postID  ) {
        $count_key = 'magazine_newspaper_post_views_count';
        $count = get_post_meta( $postID, $count_key, true );
        if ( $count == "" ) {
            $count = 1;
            delete_post_meta( $postID, $count_key );
            add_post_meta( $postID, $count_key, $count );
        } else {
            $count++;
            update_post_meta( $postID, $count_key, $count );
        }
    }

}
if ( !function_exists( 'magazine_newspaper_track_post_views' ) ) {
    function magazine_newspaper_track_post_views(  $post_id  ) {
        if ( !is_single() ) {
            return;
        }
        if ( empty( $post_id ) ) {
            global $post;
            $post_id = $post->ID;
        }
        magazine_newspaper_set_post_views( $post_id );
    }

    add_action( 'wp_head', 'magazine_newspaper_track_post_views' );
}
/**
 * Theme Admin Dashboard
 */
require get_template_directory() . '/inc/admin/dashboard.php';
// Remove Read more from post excerpt
function magazine_newspaper_remove_post_excerpt(  $more  ) {
    return '...';
}

add_filter( 'excerpt_more', 'magazine_newspaper_remove_post_excerpt', 11 );
// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );
// rendering function of number pagination
function magazine_newspaper_numeric_posts_nav() {
    if ( is_singular() ) {
        return;
    }
    global $wp_query;
    global $paged;
    /** Stop execution if there's only 1 page */
    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }
    $paged = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
    $max = intval( $wp_query->max_num_pages );
    /** Add current page to the array */
    if ( $paged >= 1 ) {
        $links[] = $paged;
    }
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if ( $paged + 2 <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    echo '<div id="magazine_newspaper_pagination" class="navigation"><ul>' . "\n";
    /** Previous Post Link */
    if ( get_previous_posts_link() ) {
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
    }
    /** Link to first page, plus ellipses if necessary */
    if ( !in_array( 1, $links ) ) {
        $class = ( 1 == $paged ? ' class="active"' : '' );
        printf(
            '<li%s><a href="%s">%s</a></li>' . "\n",
            $class,
            esc_url( get_pagenum_link( 1 ) ),
            '1'
        );
        if ( !in_array( 2, $links ) ) {
            echo '<li>…</li>';
        }
    }
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = ( $paged == $link ? ' class="active"' : '' );
        printf(
            '<li%s><a href="%s">%s</a></li>' . "\n",
            $class,
            esc_url( get_pagenum_link( $link ) ),
            $link
        );
    }
    /** Link to last page, plus ellipses if necessary */
    if ( !in_array( $max, $links ) ) {
        if ( !in_array( $max - 1, $links ) ) {
            echo '<li>…</li>' . "\n";
        }
        $class = ( $paged == $max ? ' class="active"' : '' );
        printf(
            '<li%s><a href="%s">%s</a></li>' . "\n",
            $class,
            esc_url( get_pagenum_link( $max ) ),
            $max
        );
    }
    /** Next Post Link */
    if ( get_next_posts_link() ) {
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
    }
    echo '</ul></div>' . "\n";
}
