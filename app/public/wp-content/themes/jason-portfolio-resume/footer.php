<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jason_Portfolio_Resume
 */
$class = '';
if(trim(CRT_THEMES_NAME_TEMPLATE) == 'jason-portfolio-resume') {
    $class = 'w-75 offset-0 offset-lg-3';
}
?>
<section class="footer px-50 py-5 py-md-4 <?php echo esc_attr($class);?>">
    <div class="container-xl">
        <div class="row align-items-center">
            <div class="col-12 col-md-2">
                <?php if ( has_custom_logo() ) : ?>
                    <?php
                    $logo_dark = get_theme_mod( 'logo_dark' );
                    $logo_light = wp_get_attachment_url( get_theme_mod( 'custom_logo' ) );
                    ?>
                    <h2 class="footer__logo m-0 text-center text-md-start">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <img class="light" src="<?php echo esc_attr($logo_dark ? $logo_dark : get_template_directory_uri() . '/assets/img/logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            <img class="dark" src="<?php echo esc_attr($logo_light ? $logo_light : get_template_directory_uri() . '/assets/img/logo-dark.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                    </h2>
                <?php else : ?>
                    <div class="footer__logo--text">
                        <span><?php bloginfo( 'name' ); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-5">
                <div class="footer__social my-3 my-md-0">
                    <?php
                        $social_enable = get_theme_mod( 'jason_portfolio_resume_footer_social_enable' );
                        if($social_enable):
                    ?>
                    <?php $social = json_to_array(get_theme_mod( 'jason_portfolio_resume_social' )); ?>
                        <?php if( !empty( $social ) ): ?>
                            <ul class="social justify-content-center justify-content-md-start">
                                <?php foreach ( $social as $item ): ?>
                                    <li class="li-<?php echo esc_attr($item['icon_value']) ?>"> <a class="ms-1 ms-md-2" href="#" target="_blank" rel="alternate" title="<?php echo esc_attr($item['icon_value']) ?>"> <i class="fa <?php echo esc_attr($item['icon_value']) ?>"></i></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="footer__copywriter text-center text-md-end">
                    <?php
                        $right_text = get_theme_mod( 'jason_portfolio_resume_right_text', 'Copyright © 2022 All rights reserved.' );
                    ?>
                    <?php echo esc_html($right_text); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php wp_footer(); ?>

</body>
</html>
