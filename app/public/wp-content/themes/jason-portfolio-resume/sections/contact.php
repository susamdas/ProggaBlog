<?php
if ( ! get_theme_mod( 'jason_portfolio_resume_enable_contact_section', false ) ) {
    return;
}

$section_content = array();
$section_content['section_contact_headline'] = get_theme_mod( 'jason_portfolio_resume_contact_section_headline', __( 'Contact <strong>Us</strong>', 'jason-portfolio-resume' ) );
$section_content['section_contact_headline_sub'] = get_theme_mod( 'jason_portfolio_resume_contact_section_headline_sub', __( 'What do i help', 'jason-portfolio-resume' ) );
$section_content['section_contacts'] = json_to_array(get_theme_mod( 'jason_portfolio_resume_contact_section_list' ));
$section_content['section_contact_form'] = get_theme_mod( 'jason_portfolio_resume_contact_section_form' );
$section_content = apply_filters( 'jason_portfolio_resume_contact_section_content', $section_content );
jason_portfolio_resume_render_contact_section( $section_content );

/**
 * Render Contact Section
 */
function jason_portfolio_resume_render_contact_section($section_content) {
    $form = $section_content['section_contact_form'];
    $contacts = $section_content['section_contacts'];
    $class = '';
    if(trim(CRT_THEMES_NAME_TEMPLATE) == 'jason-portfolio-resume') {
        $class = 'mb-0 px-50 w-75 offset-0 offset-lg-3';
    }
?>
<section id="contact" class="contact <?php echo esc_attr($class);?>">
<?php
    if ( is_customize_preview() ) :
        jason_portfolio_resume_section_link( 'jason_portfolio_resume_contact_section' );
    endif;
?>
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="contact__inner">
                    <h2 class="heading-default" data-viewport="custom"><?php echo wp_kses_post($section_content['section_contact_headline']); ?><span><?php echo esc_html($section_content['section_contact_headline_sub']); ?></span></h2>
                    <div class="row mt-4">
                        <div class="col-12 col-lg-3">
                            <div class="contact__list d-flex flex-column flex-md-row flex-lg-column justify-content-start justify-content-md-between justify-content-lg-start" data-viewport="opacity">
                                <?php if(!empty($contacts)): ?>
                                    <?php foreach ($contacts as $item): ?>
                                        <div class="contact__item mb-4">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <i class="fa <?php echo esc_attr($item['icon_value']); ?>"></i>
                                                </div>
                                                <span><?php echo esc_html($item['text']); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-9">
                            <?php echo do_shortcode($form);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}
?>
