/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Header Options: Site Identity

	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'site_title_color_option', function( value ) {
		value.bind( function( to ) {
			$( 'header .logo .site-title' ).css( 'color', to );
		} );
	} );

	wp.customize( 'site_title_size_option', function( value ) {
		value.bind( function( to ) {
			$( 'header .logo .site-title' ).css( 'font-size', to + "px" );
		} );
	} );

	wp.customize( 'site_title_font_family', function( value ) {
		value.bind( function( to ) {
			$( "head" ).append("<link href='https://fonts.googleapis.com/css?family=" + to + ":200,300,400,500,600,700,800,900|' rel='stylesheet' type='text/css'>");
			$( 'header .logo .site-title' ).css( 'font-family', to );
		} );
	} );

	// General Options: Colors
	
	wp.customize( 'primary_colors', function( value ) {
		value.bind( function( to ) {
			$( '.pri-color,a .readmore' ).css( 'color', to );
			$( '.pri-bg-color,.widget_search' ).css( 'background-color', to );
		} );
	} );

	wp.customize( 'secondary_colors', function( value ) {
		value.bind( function( to ) {
			$( '.sec-color' ).css( 'color', to );
			$( 'h2.news-heading,h2.widget-title' ).css( 'border-color', to );
			$( '.sec-bg-color,.popular-news-snippet .summary .news-category,.jetpack_subscription_widget,.news-ticker b,h2.widget-title:after,h4.news-title:after,.news-ticker-label' ).css( 'background-color', to );
			$( '#tempstyles_news-title-after' ).remove();
			$( 'body' ).append( '<style type="text/css" id="tempstyles_news-title-after">.news-title:after{background-color: '+to+' !important;}</style>' );
			$( '#tempstyles_widget-title-after' ).remove();
			$( 'body' ).append( '<style type="text/css" id="tempstyles_widget-title-after">.widget-title:after{background-color: '+to+' !important;}</style>' );
			$( '#tempstyles_news-ticker-after' ).remove();
			$( 'body' ).append( '<style type="text/css" id="tempstyles_news-ticker-after">.news-ticker-label:after{background-color: '+to+' !important;}</style>' );
		} );
	} );

	wp.customize( 'font_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'color', to );
		} );
	} );

	wp.customize( 'secondary_font_color', function( value ) {
		value.bind( function( to ) {
			$( '.info a,small.date,.widget span.post-date' ).css( 'color', to );
		} );
	} );

	wp.customize( 'heading_title_color', function( value ) {
		value.bind( function( to ) {
			$( 'h1' ).css( 'color', to );
		} );
	} );

	wp.customize( 'h2_heading_title_color', function( value ) {
		value.bind( function( to ) {
			$( 'h2' ).css( 'color', to );
		} );
	} );

	wp.customize( 'h3_heading_title_color', function( value ) {
		value.bind( function( to ) {
			$( 'h3' ).css( 'color', to );
		} );
	} );

	wp.customize( 'h4_heading_title_color', function( value ) {
		value.bind( function( to ) {
			$( 'h4,h5,h6' ).css( 'color', to );
		} );
	} );

	wp.customize( 'heading_link_color', function( value ) {
		value.bind( function( to ) {
			$( 'h2 a,h2 a:hover,h2 a:active,h2 a:focus,h2 a:visited,h3 a,h3 a:hover,h3 a:active,h3 a:focus,h3 a:visited,h4 a,h4 a:hover,h4 a:active,h4 a:focus,h4 a:visited,h5 a,h5 a:hover,h5 a:active,h5 a:focus,h5 a:visited,h6 a,h6 a:hover,h6 a:active,h6 a:focus,h6 a:visited' ).css( 'color', to );
		} );
	} );

	wp.customize( 'button_color', function( value ) {
		value.bind( function( to ) {
			$( '.search-submit,input.submit,.widget .profile-link,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,form#wte_enquiry_contact_form input#enquiry_submit_button,.widget-instagram .owl-carousel .owl-nav .owl-prev,.widget-instagram .owl-carousel .owl-nav .owl-next,.widget_search input.search-submit,.navigation li a:hover,.navigation li.active a,.loadmore button:hover' ).css( 'background-color', to );
		} );
	} );

	// General Options: Fonts

	wp.customize( 'magazine_newspaper_font_family', function( value ) {
		value.bind( function( to ) {
			$("head").append("<link href='https://fonts.googleapis.com/css?family=" + to + ":200,300,400,500,600,700,800,900|' rel='stylesheet' type='text/css'>");
			$( 'body' ).css( 'font-family', to );
		} );
	} );

	wp.customize( 'magazine_newspaper_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'font-size', to );
		} );
	} );

	wp.customize( 'magazine_newspaper_font_weight', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'font-weight', to );
		} );
	} );

	wp.customize( 'magazine_newspaper_line_height', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'line-height', to + 'px' );
		} );
	} );

	wp.customize( 'magazine_newspaper_heading_font_family', function( value ) {
		value.bind( function( to ) {
			$("head").append("<link href='https://fonts.googleapis.com/css?family=" + to + ":200,300,400,500,600,700,800,900|' rel='stylesheet' type='text/css'>");
			$( 'h1, h2, h3, h4, h5, h6' ).css( 'font-family', to );
		} );
	} );

	wp.customize( 'magazine_newspaper_heading_font_weight', function( value ) {
		value.bind( function( to ) {
			$( 'h1, h2, h3, h4, h5, h6' ).css( 'font-weight', to );
		} );
	} );

	wp.customize( 'magazine_newspaper_heading_1_size', function( value ) {
		value.bind( function( to ) {
			$( 'h1' ).css( 'font-size', to + 'px' );
		} );
	} );

	wp.customize( 'magazine_newspaper_heading_2_size', function( value ) {
		value.bind( function( to ) {
			$( 'h2' ).css( 'font-size', to + 'px' );
		} );
	} );

	wp.customize( 'magazine_newspaper_heading_3_size', function( value ) {
		value.bind( function( to ) {
			$( 'h3' ).css( 'font-size', to + 'px' );
		} );
	} );

	wp.customize( 'magazine_newspaper_heading_4_size', function( value ) {
		value.bind( function( to ) {
			$( 'h4' ).css( 'font-size', to + 'px' );
		} );
	} );

	wp.customize( 'magazine_newspaper_heading_5_size', function( value ) {
		value.bind( function( to ) {
			$( 'h5' ).css( 'font-size', to + 'px' );
		} );
	} );

	wp.customize( 'magazine_newspaper_heading_6_size', function( value ) {
		value.bind( function( to ) {37
			$( 'h6' ).css( 'font-size', to + 'px' );
		} );
	} );

} )( jQuery );
