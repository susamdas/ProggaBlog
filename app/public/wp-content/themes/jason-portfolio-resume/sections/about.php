<?php
if ( ! get_theme_mod( 'jason_portfolio_resume_enable_about_section', false ) ) {
	return;
}

$section_content = array();
$section_content['section_about_left_text_top'] = get_theme_mod( 'jason_portfolio_resume_about_section_left_text_top', __( 'Best Design Awards', 'jason-portfolio-resume' ) );
$section_content['section_about_avatar'] = get_theme_mod( 'jason_portfolio_resume_about_image') ? get_theme_mod( 'jason_portfolio_resume_about_image') : get_template_directory_uri() . '/assets/img/bg_avatar.png';
$section_content['section_about_left_text_bottom_left'] = get_theme_mod( 'jason_portfolio_resume_about_section_left_text_bottom_left', __( '<strong>9+</strong><span>Years of<br>Experiencs</span>', 'jason-portfolio-resume' ) );
$section_content['section_about_left_text_bottom_right'] = get_theme_mod( 'jason_portfolio_resume_about_section_left_text_bottom_right', __( '20+<br/>Happy Clients', 'jason-portfolio-resume' ) );
$section_content['section_about_right_featured_text'] = get_theme_mod( 'jason_portfolio_resume_about_section_right_featured_text', '"Joe Morgan.","Designer","Developer"' );
$section_content['section_about_right_name'] = get_theme_mod( 'jason_portfolio_resume_about_section_right_name', __('Hi, I am', 'jason-portfolio-resume' ) );
$section_content['section_about_right_intro'] = get_theme_mod( 'jason_portfolio_resume_about_section_right_intro', __('<p>Senior UX designer with 9+ years experience and specialization in complex web application design.</p><p>Achieved 15% increase in user satisfaction and 20% increase in conversions through the creation of interactively tested, data-driven, and user-centered design.</p>', 'jason-portfolio-resume' ) );
$section_content['section_about_right_button_text'] = get_theme_mod( 'jason_portfolio_resume_about_section_right_button_text', __('Contact', 'jason-portfolio-resume' ) );
$section_content['section_about_right_button_url'] = get_theme_mod( 'jason_portfolio_resume_about_section_right_button_url', __('#', 'jason-portfolio-resume' ) );
$section_content['section_about_right_social_enable'] = get_theme_mod( 'jason_portfolio_resume_social_enable');
$section_content['section_about_right_social'] = json_to_array(get_theme_mod( 'jason_portfolio_resume_about_section_right_social'));

$section_content = apply_filters( 'jason_portfolio_resume_about_section_content', $section_content );

jason_portfolio_resume_render_about_section( $section_content );

/**
 * Render About Section
 */
function jason_portfolio_resume_render_about_section( $section_content ) {
    $class = '';
    if(trim(CRT_THEMES_NAME_TEMPLATE) == 'jason-portfolio-resume') {
        $class = 'mb-0 px-50 w-75 offset-0 offset-lg-3';
    }
?>
<section id="about-me" class="about-me <?php echo esc_attr($class);?>" >
<?php
    if ( is_customize_preview() ) :
        jason_portfolio_resume_section_link( 'jason_portfolio_resume_about_section' );
    endif;
?>
    <div class="container-xl h-100">
        <div class="row align-items-center h-100">
            <div class="col-10 col-sm-8 mb-5 mb-sm-0 col-md-8 col-lg-6 offset-1 offset-sm-2 offset-md-2 offset-lg-0">
                <figure class="about-me__avatar ratio ratio-1x1 lazy" data-viewport="custom" data-delay="1000" data-src="<?php echo esc_attr($section_content['section_about_avatar']); ?>">
                    <?php if(!empty($section_content['section_about_left_text_bottom_right'])): ?>
                        <div class="about-me__clients" data-viewport="opacity">
                            <div class="brand">
                                <i class="icofont-brand-disney"></i>
                                <i class="icofont-brand-gucci"></i>
                                <i class="icofont-brand-adobe"></i>
                            </div>
                            <?php echo wp_kses_post($section_content['section_about_left_text_bottom_right']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($section_content['section_about_left_text_top'])): ?>
                    <div class="about-me__awards" data-viewport="opacity">
                        <i class="icofont-royal"></i>
                        <span class="d-block"><?php echo esc_html($section_content['section_about_left_text_top']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($section_content['section_about_left_text_bottom_left'])): ?>
                        <div class="about-me__exp" data-viewport="opacity">
                            <?php echo wp_kses_post($section_content['section_about_left_text_bottom_left']); ?>
                        </div>
                    <?php endif; ?>
                </figure>
            </div>
            <div class="col-12 col-md-10 col-lg-5 offset-0 offset-md-1">
                <h3 class="about-me__name" data-viewport="opacity" data-delay="600">
                    <span class="d-block"><?php echo esc_html($section_content['section_about_right_name']) ?></span>
                    <strong class="d-block type--js" data-period="2000" data-type='[<?php echo esc_html($section_content['section_about_right_featured_text']); ?>]'></strong>
                </h3>
                <div class="about-me__intro" data-viewport="opacity" data-delay="500">
                    <?php echo wp_kses_post($section_content['section_about_right_intro']); ?>
                </div>
                <div class="about-me__contact d-flex justify-content-between align-items-center" data-viewport="opacity">
                    <?php if(!empty($section_content['section_about_right_button_text'])): ?>
                        <div class="about-me__button">
                            <a href="<?php echo esc_html($section_content['section_about_right_button_url']); ?>"><?php echo esc_html($section_content['section_about_right_button_text']); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if($section_content['section_about_right_social_enable']): ?>
                        <?php $social = $section_content['section_about_right_social']; ?>
                        <?php if( !empty( $social ) ): ?>
                            <ul class="social">
                                <?php foreach ( $social as $item ): ?>
                                    <li class="li-<?php echo esc_attr($item['icon_value']); ?>"> <a class="ms-1 ms-md-2" href="<?php echo esc_html($item['link']); ?>" target="_blank" rel="alternate" title="<?php echo esc_html($item['icon_value']); ?>"> <i class="fa <?php echo esc_html($item['icon_value']); ?>"></i></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
}
