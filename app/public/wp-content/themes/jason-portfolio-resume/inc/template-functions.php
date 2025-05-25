<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Jason_Portfolio_Resume
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function jason_portfolio_resume_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    // Added class to change theme mode.
    $classes[] = 'dark-theme';

    $classes[] = jason_portfolio_resume_sidebar_layout();

    return $classes;
}
add_filter( 'body_class', 'jason_portfolio_resume_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function jason_portfolio_resume_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'jason_portfolio_resume_pingback_header' );


/**
 * Get all posts for customizer Post content type.
 */
function jason_portfolio_resume_get_post_choices() {
    $choices = array( '' );
    $args    = array( 'numberposts' => -1 );
    $posts   = get_posts( $args );

    foreach ( $posts as $post ) {
        $id             = $post->ID;
        $title          = $post->post_title;
        $choices[ $id ] = $title;
    }

    return $choices;
}

/**
 * Get all pages for customizer Page content type.
 */
function jason_portfolio_resume_get_page_choices() {
    $choices = array( '' );
    $pages   = get_pages();

    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }

    return $choices;
}

/**
 * Get all categories for customizer Category content type.
 */
function jason_portfolio_resume_get_post_cat_choices() {
    $choices = array( '' );
    $cats    = get_categories();

    foreach ( $cats as $cat ) {
        $choices[ $cat->term_id ] = $cat->name;
    }

    return $choices;
}

if ( ! function_exists( 'jason_portfolio_resume_excerpt_length' ) ) :
    /**
     * Excerpt length.
     */
    function jason_portfolio_resume_excerpt_length( $length ) {
        if ( is_admin() ) {
            return $length;
        }

        return get_theme_mod( 'jason_portfolio_resume_excerpt_length', 20 );
    }
endif;
add_filter( 'excerpt_length', 'jason_portfolio_resume_excerpt_length', 999 );

if ( ! function_exists( 'jason_portfolio_resume_excerpt_more' ) ) :
    /**
     * Excerpt more.
     */
    function jason_portfolio_resume_excerpt_more( $more ) {
        if ( is_admin() ) {
            return $more;
        }

        return '&hellip;';
    }
endif;
add_filter( 'excerpt_more', 'jason_portfolio_resume_excerpt_more' );

if ( ! function_exists( 'jason_portfolio_resume_sidebar_layout' ) ) {
    /**
     * Get sidebar layout.
     */
    function jason_portfolio_resume_sidebar_layout() {
        $sidebar_position      = get_theme_mod( 'jason_portfolio_resume_sidebar_position', 'right-sidebar' );
        return $sidebar_position;
    }
}

if ( ! function_exists( 'jason_portfolio_resume_is_sidebar_enabled' ) ) {
    /**
     * Check if sidebar is enabled.
     */
    function jason_portfolio_resume_is_sidebar_enabled() {
        $sidebar_position      = get_theme_mod( 'jason_portfolio_resume_sidebar_position', 'right-sidebar' );
        return $sidebar_position;
    }
}

function jason_portfolio_resume_section_link( $section_id ) {
    $section_name      = str_replace( 'jason_portfolio_resume_', ' ', $section_id );
    $section_name      = str_replace( '_', ' ', $section_name );
    $starting_notation = '#';
    ?>
    <span class="section-link">
		<span class="section-link-title"><?php echo esc_html( $section_name ); ?></span>
	</span>
    <style type="text/css">
        section:hover .section-link {
            visibility: visible;
        }
    </style>
    <?php
}

function jason_portfolio_resume_section_link_css() {
    if ( is_customize_preview() ) {
        ?>
        <style type="text/css">
            .section-link {
                visibility: hidden;
                background-color: black;
                position: relative;
                top: 80px;
                z-index: 99;
                left: 40px;
                color: #fff;
                text-align: center;
                font-size: 20px;
                border-radius: 10px;
                padding: 20px 10px;
                text-transform: capitalize;
            }
            .section-link-title {
                padding: 0 10px;
            }
        </style>
        <?php
    }
}
add_action( 'wp_head', 'jason_portfolio_resume_section_link_css' );


/**
 * Breadcrumb.
 */
function jason_portfolio_resume_breadcrumb( $args = array() ) {
    if ( ! get_theme_mod( 'jason_portfolio_resume_enable_breadcrumb', true ) ) {
        return;
    }

    $args = array(
        'show_on_front' => false,
        'show_title'    => true,
        'show_browse'   => false,
    );
    breadcrumb_trail( $args );
}
add_action( 'jason_portfolio_resume_breadcrumb', 'jason_portfolio_resume_breadcrumb', 10 );

/**
 * Add separator for breadcrumb trail.
 */
function jason_portfolio_resume_breadcrumb_trail_print_styles() {
    $breadcrumb_separator = get_theme_mod( 'jason_portfolio_resume_breadcrumb_separator', '/' );

    $style = '
	.trail-items li::after {
		content: "' . $breadcrumb_separator . '";
		}'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    $style = apply_filters( 'jason_portfolio_resume_breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", '  ' ), '', $style ) ) );

    if ( $style ) {
        echo "\n" . '<style type="text/css" id="breadcrumb-trail-css">' . $style . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}
add_action( 'wp_head', 'jason_portfolio_resume_breadcrumb_trail_print_styles' );

/**
 * Pagination for archive.
 */
function jason_portfolio_resume_render_posts_pagination() {
    $is_pagination_enabled = get_theme_mod( 'jason_portfolio_resume_enable_pagination', true );
    if ( $is_pagination_enabled ) {
        $pagination_type = get_theme_mod( 'jason_portfolio_resume_pagination_type', 'default' );
        if ( 'default' === $pagination_type ) :
            the_posts_navigation();
        else :
            the_posts_pagination();
        endif;
    }
}
add_action( 'jason_portfolio_resume_posts_pagination', 'jason_portfolio_resume_render_posts_pagination', 10 );

/**
 * Pagination for single post.
 */
function jason_portfolio_resume_render_post_navigation() {
    the_post_navigation(
        array(
            'prev_text' => '<span class="nav-title">%title</span><span class="nav-label">'.esc_html__( 'Prev Post', 'jason-portfolio-resume' ).'</span>',
            'next_text' => '<span class="nav-title">%title</span><span class="nav-label">'.esc_html__( 'Next Post', 'jason-portfolio-resume' ).'</span>',
        )
    );
}
add_action( 'jason_portfolio_resume_post_navigation', 'jason_portfolio_resume_render_post_navigation' );

if ( ! function_exists( 'jason_portfolio_resume_validate_excerpt_length' ) ) :
    function jason_portfolio_resume_validate_excerpt_length( $validity, $value ) {
        $value = intval( $value );
        if ( empty( $value ) || ! is_numeric( $value ) ) {
            $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'jason-portfolio-resume' ) );
        } elseif ( $value < 1 ) {
            $validity->add( 'min_no_of_words', esc_html__( 'Minimum no of words is 1', 'jason-portfolio-resume' ) );
        } elseif ( $value > 100 ) {
            $validity->add( 'max_no_of_words', esc_html__( 'Maximum no of words is 100', 'jason-portfolio-resume' ) );
        }
        return $validity;
    }
endif;

/**
 * Adds footer copyright text.
 */
function jason_portfolio_resume_output_footer_copyright_content() {
    $theme_data = wp_get_theme();
    $search     = array( '[the-year]', '[site-link]' );
    $replace    = array( date( 'Y' ), '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );
    /* translators: 1: Year, 2: Site Title with home URL. */
    $copyright_default = sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'jason-portfolio-resume' ), '[the-year]', '[site-link]' );
    $copyright_text    = get_theme_mod( 'jason_portfolio_resume_footer_copyright_text', $copyright_default );
    $copyright_text    = str_replace( $search, $replace, $copyright_text );
    $copyright_text   .= ' ' . esc_html( ' | ' . $theme_data->get( 'Name' ) ) . '&nbsp;' . esc_html__( 'by', 'jason-portfolio-resume' ) . '&nbsp;<a target="_blank" href="' . esc_url( $theme_data->get( 'AuthorURI' ) ) . '">' . esc_html( ucwords( $theme_data->get( 'Author' ) ) ) . '</a>';
    /* translators: %s: WordPress.org URL */
    $copyright_text .= sprintf( esc_html__( ' | Powered by %s', 'jason-portfolio-resume' ), '<a href="' . esc_url( __( 'https://wordpress.org/', 'jason-portfolio-resume' ) ) . '" target="_blank">WordPress</a>. ' );
    ?>
    <div class="copyright">
        <span><?php echo wp_kses_post( $copyright_text ); ?></span>
    </div>
    <?php
}
add_action( 'jason_portfolio_resume_footer_copyright', 'jason_portfolio_resume_output_footer_copyright_content' );

/**
 * Section default.
 */
function jason_portfolio_resume_priority_section($key) {
    $section_order_default = array (
        'jason_portfolio_resume_about_section' => 10,
        'jason_portfolio_resume_resume_section' => 15,
        'jason_portfolio_resume_project_section' => 20,
        'jason_portfolio_resume_service_section' => 25,
        'jason_portfolio_resume_client_section' => 30,
        'jason_portfolio_resume_price_section' => 35,
        'jason_portfolio_resume_blog_section' => 40,
        'jason_portfolio_resume_contact_section' => 45,
    );
    $section_order         = get_theme_mod( 'sections_order' );
    $section_order_decoded = json_decode( $section_order, true );
    if(empty($section_order_decoded)) {
        $section_order_decoded = array();
    }
    $section_order_decoded = array_replace_recursive($section_order_default, $section_order_decoded);
    return isset($section_order_decoded[$key]) ? $section_order_decoded[$key]:10;
}

/**
 * Check is json.
 */
function is_json($string) {
    json_decode(html_entity_decode($string), true);
    return json_last_error() === JSON_ERROR_NONE;
}

/**
 * Convert json to array.
 */
function json_to_array($data) {
    $array = array();
    $data = json_decode($data);
    if(empty($data)) {
        return $array;
    }
    foreach ($data as $key => $value) {
        $array_item = array();
        if(is_object($value)) {
            foreach ($value as $key_item =>  $value_item) {
                if(is_json($value_item)){
                    $array_item[$key_item] = json_decode(html_entity_decode($value_item), true);
                } else {
                    $array_item[$key_item] = $value_item;
                }
            }
            $array[$key] = is_object($value) ? (array) $array_item : $array_item;
        }
    }
    return $array;
}

/**
 * General height select.
 */
function general_height_from_count_post($data = array()) {
    $count = count($data);
    $height_default = 50;
    if($count < 30) {
        $height_default = 100;
    } elseif($count < 50) {
        $height_default = 150;
    } elseif($count < 100) {
        $height_default = 200;
    } elseif($count < 300) {
        $height_default = 250;
    }
    return $height_default;
}