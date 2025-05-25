<?php
function magazine_newspaper_dynamic_css() {

	wp_enqueue_style( 'magazine-newspaper-style', get_stylesheet_uri(), array(), MAGAZINE_NEWSPAPER_VERSION );

	$primary_color           = get_theme_mod( 'primary_colors', '#3e63b6' );
	$secondary_color         = get_theme_mod( 'secondary_colors', '#ffc000' );
	$font_color              = get_theme_mod( 'font_color', '#000' );
	$secondary_font_color    = get_theme_mod( 'secondary_font_color', '#aaa' );
	$button_color            = get_theme_mod( 'button_color', '#2173ce' );
	$heading_title_color     = get_theme_mod( 'heading_title_color', '#3e63b6' );
	$heading_link_color      = get_theme_mod( 'heading_link_color', '#3e63b6' );
	$h2_heading_title_color  = get_theme_mod( 'h2_heading_title_color', '#3e63b6' );
	$h3_heading_title_color  = get_theme_mod( 'h3_heading_title_color', '#3e63b6' );
	$h4_heading_title_color  = get_theme_mod( 'h4_heading_title_color', '#3e63b6' );

	$site_title_color 			    = get_theme_mod( 'site_title_color_option', '#000' );
	$site_title_size            = get_theme_mod( 'site_title_size_option', 30 );
	$site_title_font_family  		= esc_attr( get_theme_mod( 'site_title_font_family', 'Poppins' ) );

	$font_family = esc_attr( get_theme_mod( 'magazine_newspaper_font_family', 'Raleway' ) );
	$font_size   = esc_attr( get_theme_mod( 'magazine_newspaper_font_size', '14px' ) );
	$font_weight = absint( get_theme_mod( 'magazine_newspaper_font_weight', 500 ) );
	$line_height = absint( get_theme_mod( 'magazine_newspaper_line_height', 22 ) );

	$heading_font_family = esc_attr( get_theme_mod( 'magazine_newspaper_heading_font_family', 'Raleway' ) );
	$heading_font_weight = esc_attr( get_theme_mod( 'magazine_newspaper_heading_font_weight', 400 ) );


	$default_size = array(
		'1' =>  28,
    '2' =>  24,
    '3' =>  22,
    '4' =>  19,
    '5' =>  16,
    '6' =>  14,
	);

	for ( $i = 1; $i <= 6; $i ++ ) {
		$heading[ $i ] = absint( get_theme_mod( 'magazine_newspaper_heading_' . $i . '_size', absint( $default_size[ $i ] ) ) );
	}


	$dynamic_css = "
		body{ font: $font_weight $font_size/$line_height" . "px $font_family; color: $font_color; }

    /* Primary Colors */
    .pri-color{color: $primary_color;}
		.pri-bg-color,.widget_search{background-color: $primary_color;}

    /* Secondary Colors */
    .sec-color,a .readmore{color: $secondary_color;}
    h2.news-heading,h2.widget-title{border-color: $secondary_color;}
		.sec-bg-color,.popular-news-snippet .summary .news-category,.news-title:after,widget-title:after,.jetpack_subscription_widget,.news-ticker b,h2.widget-title:after,h4.news-title:after,.news-ticker-label,.news-ticker-label:after{background-color: $secondary_color;}

		/* Secondary Font Colors */
		.info a,small.date,.widget span.post-date{color: $secondary_font_color;}

    /* Heading Title */
    h1{font: $heading_font_weight {$heading[1]}" . "px $heading_font_family; color: $heading_title_color;}
    h2{font: $heading_font_weight {$heading[2]}" . "px $heading_font_family; color: $h2_heading_title_color;}
    h3{font: $heading_font_weight {$heading[3]}" . "px $heading_font_family; color: $h3_heading_title_color;}
    h4{font: $heading_font_weight {$heading[4]}" . "px $heading_font_family; color: $h4_heading_title_color;}
    h5{font: $heading_font_weight {$heading[5]}" . "px $heading_font_family; color: $h4_heading_title_color;}
    h6{font: $heading_font_weight {$heading[6]}" . "px $heading_font_family; color: $h4_heading_title_color;}

    /* Heading Link */
    h2 a,h2 a:hover,h2 a:active,h2 a:focus,h2 a:visited{color: $heading_link_color;}
    h3 a,h3 a:hover,h3 a:active,h3 a:focus,h3 a:visited{color: $heading_link_color;}
    h4 a,h4 a:hover,h4 a:active,h4 a:focus,h4 a:visited{color: $heading_link_color;}
    h5 a,h5 a:hover,h5 a:active,h5 a:focus,h5 a:visited{color: $heading_link_color;}
    h6 a,h6 a:hover,h6 a:active,h6 a:focus,h6 a:visited{color: $heading_link_color;}

    /* Header */
    header .logo .site-title{color: {$site_title_color}; font-size: {$site_title_size}px; font-family: {$site_title_font_family}; }

    /* Buttons */
    .search-submit,input.submit,.widget .profile-link,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,form#wte_enquiry_contact_form input#enquiry_submit_button,.widget-instagram .owl-carousel .owl-nav .owl-prev,.widget-instagram .owl-carousel .owl-nav .owl-next,.widget_search input.search-submit,.navigation li a:hover,.navigation li.active a,.loadmore button:hover {background-color: $button_color;}
  ";
	wp_add_inline_style( 'magazine-newspaper-style', $dynamic_css );
}

add_action( 'wp_enqueue_scripts', 'magazine_newspaper_dynamic_css' );
?>