<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jason_Portfolio_Resume
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'jason-portfolio-resume' ); ?></a>
    <section class="header d-flex align-content-center justify-content-between justify-content-lg-center w-25">
        <div class="header_inner d-flex align-items-center flex-row flex-lg-column justify-content-between justify-content-lg-center">
            <div class="header__top mt-0 mt-lg-3">
                <?php if ( has_custom_logo() ) : ?>
                    <?php
                    $logo_dark = get_theme_mod( 'logo_dark' );
                    $logo_light = wp_get_attachment_url( get_theme_mod( 'custom_logo' ) );
                    ?>
                    <div class="site-logo">
                        <?php echo is_front_page() || is_home() ? '<h1 class="header__logo m-0">':'<span class="header__logo m-0">' ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <img class="light" src="<?php echo esc_attr($logo_dark ? $logo_dark : get_template_directory_uri() . '/assets/img/logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            <img class="dark" src="<?php echo esc_attr($logo_light ? $logo_light : get_template_directory_uri() . '/assets/img/logo-dark.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                        <?php echo is_front_page() || is_home() ? '</h1>':'</span>' ?>
                    </div>
                <?php else : ?>
                    <div class="site-identity">
                        <?php echo is_front_page() || is_home() ? '<h1 class="header__logo m-0">':'<span class="header__logo m-0">' ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                        <span><?php bloginfo( 'description' ); ?></span>
                        <?php echo is_front_page() || is_home() ? '</h1>':'</span>' ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="header__menu ms-auto mt-auto mb-auto ms-lg-0 d-flex flex-row flex-lg-column justify-content-center align-items-center">
                <a class="header__button-menu d-inline-flex d-lg-none" href="#"></a>
                <div class="header__nav d-flex align-items-center justify-content-center">
                    <?php
                    if( is_front_page() || is_home() ) {
                        if ( has_nav_menu( 'primary' ) ) {
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'primary',
                                    'menu_class'     => 'header__navigation nav d-flex m-0 flex-column justify-content-center align-items-center'
                                )
                            );
                        }
                    } else {
                        if ( has_nav_menu( 'not_home_nav' ) ) {
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'not_home_nav',
                                    'menu_class'     => 'header__navigation nav d-flex m-0 flex-column justify-content-center align-items-center'
                                )
                            );
                        } elseif ( has_nav_menu( 'primary' ) ) {
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'primary',
                                    'menu_class'     => 'header__navigation nav d-flex m-0 flex-column justify-content-center align-items-center'
                                )
                            );
                        }
                    }

                    ?>
                </div>
                <?php
                    $dark_enable = get_theme_mod('jason_portfolio_resume_left_mode_enable');
                    if($dark_enable):
                ?>
                    <a class="button-dark-mode" href="#"><i class="icofont-moon"></i></a>
                <?php endif; ?>
            </div>

            <div class="header__social mt-1 mt-md-auto mb-1 mb-md-5 mb-lg-0 d-none d-lg-block">
                <div class="container-xl">
                    <?php
                        $social_enable = get_theme_mod('jason_portfolio_resume_left_social_enable');
                        if($social_enable):
                    ?>
                        <?php $social = json_to_array(get_theme_mod( 'jason_portfolio_resume_left_social' )); ?>
                        <?php if( !empty( $social ) ): ?>
                            <ul class="social d-flex justify-content-center pb-3">
                                <?php foreach ( $social as $item ): ?>
                                    <li class="li-<?php echo esc_attr($item['icon_value']) ?>"> <a style="--hover-color: <?php echo esc_attr($item['color']) ?>" class="" href="<?php echo esc_attr($item['link']) ?>" target="_blank" rel="alternate" title="<?php echo esc_attr($item['icon_value']) ?>"> <i class="fa <?php echo esc_attr($item['icon_value']) ?>"></i></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                    $left_below_text = get_theme_mod( 'jason_portfolio_resume_left_below_text', 'Copyright © 2022 All rights reserved.' );
                    ?>
                    <div class="header__copywriter text-center pb-4">
                        <?php echo esc_html($left_below_text); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="header--fixed"></div>
