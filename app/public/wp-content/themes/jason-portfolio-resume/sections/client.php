<?php
if ( ! get_theme_mod( 'jason_portfolio_resume_enable_client_section', false ) ) {
    return;
}
$section_content = array();
$section_content['section_client_headline'] = get_theme_mod( 'jason_portfolio_resume_client_section_headline', __( 'My Client', 'jason-portfolio-resume' ) );
$section_content['section_client_headline_sub'] = get_theme_mod( 'jason_portfolio_resume_client_section_headline_sub', __( 'What customers say about us', 'jason-portfolio-resume' ) );
$section_content['section_client_list'] = json_to_array(get_theme_mod( 'jason_portfolio_resume_resume_section_client_list' ));
$section_content = apply_filters( 'jason_portfolio_resume_client_section_content', $section_content );
jason_portfolio_resume_render_client_section( $section_content );

/**
 * Render Client Section
 */
function jason_portfolio_resume_render_client_section( $section_content ) {
    $list_client = $section_content['section_client_list'];
    $class = '';
    if(trim(CRT_THEMES_NAME_TEMPLATE) == 'jason-portfolio-resume') {
        $class = 'mb-0 px-50 w-75 offset-0 offset-lg-3';
    }
?>
<section id="my-client" class="my-client <?php echo esc_attr($class);?>">
<?php
if ( is_customize_preview() ) :
    jason_portfolio_resume_section_link( 'jason_portfolio_resume_client_section' );
endif;
?>
    <div class="container-xl">
        <div class="row">
            <div class="col-12 col-md-8 offset-0 offset-md-2">
                <h2 class="heading-default" data-viewport="custom"><?php echo wp_kses_post($section_content['section_client_headline']); ?><span><?php echo esc_html($section_content['section_client_headline_sub']); ?></span></h2>
                <?php if(!empty($list_client)) : ?>
                <div class="my-client__list my-client__js owl-carousel owl-theme" data-viewport="opacity">
                    <?php foreach ($list_client as $items) {
                        if(!empty($items['field_repeater'])) {
                        foreach ($items['field_repeater'] as $item) { ?>
                        <div class="my-client__item">
                            <div class="my-client__intro mb-3">
                                <?php echo esc_html($item['client_content']); ?>
                            </div>
                            <h2 class="my-client__name"><?php echo esc_html($item['client_name']); ?></h2>
                            <p class="my-client__position"><?php echo esc_html($item['client_job']); ?></p>
                        </div>
                        <?php } ?>
                    <?php } } ?>
                </div>
                <div class="my-client__list--thumb my-client__js--thumb owl-carousel owl-theme" data-viewport="opacity">
                    <?php foreach ($list_client as $items) {
                        if(!empty($items['field_repeater'])) {
                        foreach ($items['field_repeater'] as $item) { ?>
                            <div class="my-client__item--thumb">
                                <figure class="mx-2 mt-2 ratio ratio-1x1 rounded-circle bg-cover owl-lazy" data-src="<?php echo esc_html($item['client_image']); ?>"></figure>
                            </div>
                        <?php } ?>
                    <?php } } ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php }
