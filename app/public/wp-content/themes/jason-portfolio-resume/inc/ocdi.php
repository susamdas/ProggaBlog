<?php
function import_files() {
    return [
        [
            'import_file_name'             => 'Jason',
            'categories'                   => [ 'Listings' ],
            'import_file_url'            => 'http://demo1.crthemes.com/data/jason/content.xml',
            'import_widget_file_url'     => 'http://demo1.crthemes.com/data/jason/widgets.wie',
            'import_customizer_file_url' => 'http://demo1.crthemes.com/data/jason/customizer.dat',
            'import_preview_image_url'     => get_template_directory_uri() . '/screenshot.png',
            'preview_url'                  => JASON_PORTFOLIO_RESUME_URL_DEMO,
        ]
    ];
}
add_filter( 'ocdi/import_files', 'import_files' );

/**
 * OCDI after import.
 */
function jason_portfolio_resume_after_import_setup() {
	// Assign menus to their locations.
	$primary_menu = get_term_by( 'name', 'Menu 1', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations',
		array(
			'primary' => $primary_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'ocdi/after_import', 'jason_portfolio_resume_after_import_setup' );

