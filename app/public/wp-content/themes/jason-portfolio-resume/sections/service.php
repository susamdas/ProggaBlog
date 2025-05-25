<?php
if ( ! get_theme_mod( 'jason_portfolio_resume_enable_service_section', false ) ) {
    return;
}
$section_content = array();
$section_content['section_service_headline'] = get_theme_mod( 'jason_portfolio_resume_service_section_headline', __( 'My <strong>Services</strong>', 'jason-portfolio-resume' ) );
$section_content['section_service_headline_sub'] = get_theme_mod( 'jason_portfolio_resume_service_section_headline_sub', __( 'Our service provided', 'jason-portfolio-resume' ) );
$section_content['section_service_left_title'] = get_theme_mod( 'jason_portfolio_resume_service_section_left_title', __( 'What do i help ?', 'jason-portfolio-resume' ) );
$section_content['section_service_left_content'] = get_theme_mod( 'jason_portfolio_resume_service_section_left_content', __( 'With more than 100 successful projects of varying scale and complexity, Branch portfolio includes single page websites, corporate sites, healthcare portals, directory sites', 'jason-portfolio-resume' ) );
$section_content['section_service_left_statistical'] = json_to_array(get_theme_mod( 'jason_portfolio_resume_service_section_left_statistical'));
$section_content['section_service_list'] = json_to_array(get_theme_mod( 'jason_portfolio_resume_service_section_list' ));

$section_content = apply_filters( 'jason_portfolio_resume_service_section_content', $section_content );
jason_portfolio_resume_render_service_section( $section_content );

/**
 * Render Resume Section
 */
function jason_portfolio_resume_render_service_section( $section_content ) {
    $service_list = $section_content['section_service_list'];
    $statistical_list = $section_content['section_service_left_statistical'];
    $class = '';
    if(trim(CRT_THEMES_NAME_TEMPLATE) == 'jason-portfolio-resume') {
        $class = 'mb-0 px-50 w-75 offset-0 offset-lg-3';
    }
?>
<section id="my-service" class="my-service <?php echo esc_attr($class);?>">
    <?php
    if ( is_customize_preview() ) :
        jason_portfolio_resume_section_link( 'jason_portfolio_resume_service_section' );
    endif;
    ?>
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="my-service__inner">
                    <h2 class="heading-default" data-viewport="custom"><?php echo wp_kses_post($section_content['section_service_headline']); ?><span><?php echo esc_html($section_content['section_service_headline_sub']); ?></span></h2>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="my-service__left">
                                <h3 class="my-service__left--heading" data-viewport="opacity"><?php echo esc_html($section_content['section_service_left_title']); ?></h3>
                                <div class="my-service__left--intro" data-viewport="opacity"><?php echo esc_html($section_content['section_service_left_content']); ?></div>
                                <div class="row">
                                    <?php if(!empty($statistical_list)): ?>
                                        <?php foreach ($statistical_list as $statistical_item): ?>
                                            <div class="col-6">
                                                <div class="my-service__left--statistical" data-viewport="opacity">
                                                    <strong><?php echo esc_html($statistical_item['text']) ?></strong>
                                                    <span><?php echo esc_html($statistical_item['title']) ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="my-service__right">
                                <div class="my-service__list">
                                    <?php if(!empty($service_list)): ?>
                                        <?php foreach ($service_list as $service_item): ?>
                                        <div class="my-service__item" data-viewport="opacity">
                                            <div class="my-service__item--inner">
                                                <i class="fa <?php echo esc_attr($service_item['icon_value']); ?>"></i>
                                                <h3 class="my-service__title"><?php echo esc_html($service_item['title']); ?></h3>
                                                <div class="my-service__intro">
                                                    <?php echo esc_html($service_item['text']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>