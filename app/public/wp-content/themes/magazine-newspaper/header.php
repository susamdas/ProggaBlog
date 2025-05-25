<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <header>
 *
 * @package magazine-newspaper
 */
?><!DOCTYPE html>
<html <?php 
language_attributes();
?>>
<head></head>
	<meta charset="<?php 
bloginfo( 'charset' );
?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="<?php 
echo esc_url( 'http://gmpg.org/xfn/11' );
?>">
	<link rel="pingback" href="<?php 
bloginfo( 'pingback_url' );
?>">
	<?php 
wp_head();
?>
</head>


<body <?php 
body_class();
?>>
	<?php 
wp_body_open();
?>

<?php 
$defaults = array(
    array(
        'social_media_title' => esc_attr__( 'Facebook', 'magazine-newspaper' ),
        'social_media_class' => 'fa fa-facebook',
        'social_media_link'  => '',
    ),
    array(
        'social_media_title' => esc_attr__( 'Twitter', 'magazine-newspaper' ),
        'social_media_class' => 'fa fa-twitter',
        'social_media_link'  => '',
    ),
    array(
        'social_media_title' => esc_attr__( 'Google Plus', 'magazine-newspaper' ),
        'social_media_class' => 'fa fa-google-plus',
        'social_media_link'  => '',
    ),
    array(
        'social_media_title' => esc_attr__( 'Youtube', 'magazine-newspaper' ),
        'social_media_class' => 'fa fa-youtube-play',
        'social_media_link'  => '',
    ),
    array(
        'social_media_title' => esc_attr__( 'Linkedin', 'magazine-newspaper' ),
        'social_media_class' => 'fa fa-linkedin',
        'social_media_link'  => '',
    ),
    array(
        'social_media_title' => esc_attr__( 'Pinterest', 'magazine-newspaper' ),
        'social_media_class' => 'fa fa-pinterest',
        'social_media_link'  => '',
    ),
    array(
        'social_media_title' => esc_attr__( 'Instagram', 'magazine-newspaper' ),
        'social_media_class' => 'fa fa-instagram',
        'social_media_link'  => '',
    )
);
$social_media = get_theme_mod( 'magazine_newspaper_social_media', $defaults );
$menu_sticky = get_theme_mod( 'magazine_newspaper_header_sticky_menu_option', false );
set_query_var( 'menu_sticky', $menu_sticky );
set_query_var( 'social_media', $social_media );
get_template_part( 'layouts/header/header-layout', 'one' );
?>
<?php 
if ( class_exists( 'Breadcrumb_Trail' ) && !is_home() && !is_front_page() ) {
    ?>             
	<div class="breadcrumbs-block">
		<div class="container"><?php 
    magazine_newspaper_pro_breadcrumb_trail();
    ?></div>
	</div>
<?php 
}