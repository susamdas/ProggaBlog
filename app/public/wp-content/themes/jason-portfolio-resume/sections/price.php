<?php
if ( ! get_theme_mod( 'jason_portfolio_resume_enable_price_section', false ) ) {
    return;
}
$section_content = array();
$section_content['section_price_headline'] = get_theme_mod( 'jason_portfolio_resume_price_section_headline', __( 'Price', 'jason-portfolio-resume' ) );
$section_content['section_price_headline_sub'] = get_theme_mod( 'jason_portfolio_resume_price_section_headline_sub', __( 'Price', 'jason-portfolio-resume' ) );
$section_content['section_price_list'] = json_to_array(get_theme_mod( 'jason_portfolio_resume_resume_section_price_list' ));
$section_content = apply_filters( 'jason_portfolio_resume_price_section_content', $section_content );
jason_portfolio_resume_render_price_section( $section_content );

/**
 * Render Price Section
 */
function jason_portfolio_resume_render_price_section( $section_content ) {
    $list_price = $section_content['section_price_list'];
    $class = '';
    if(trim(CRT_THEMES_NAME_TEMPLATE) == 'jason-portfolio-resume') {
        $class = 'mb-0 px-50 w-75 offset-0 offset-lg-3';
    }
?>
<section id="price" class="price <?php echo esc_attr($class);?>">
    <?php
    if ( is_customize_preview() ) :
        jason_portfolio_resume_section_link( 'jason_portfolio_resume_price_section' );
    endif;
    ?>
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <h2 class="heading-default" data-viewport="custom"><?php echo wp_kses_post($section_content['section_price_headline']); ?><span><?php echo esc_html($section_content['section_price_headline_sub']); ?></span></h2>
                <div class="row">
                    <div class="col-12" data-viewport="opacity">
                        <?php if(!empty($list_price)) { ?>
                            <div class="price__list">
                            <?php foreach ($list_price as $data) {
                                if(!empty($data['field_repeater'])) {
                                foreach ($data['field_repeater'] as $price) { ?>
                                <div class="price__item">
                                    <div class="price__item--inner">
                                        <h4 class="price__name"><?php echo esc_html($price['price_title']); ?></h4>
                                        <div class="price__cost"><?php echo wp_kses_post($price['price_value']); ?></div>
                                        <div class="price__content">
                                            <?php echo wp_kses_post($price['price_description']); ?>
                                        </div>
                                        <div class="price_button">
                                            <a href="<?php echo esc_attr($price['price_button_url']); ?>"><?php echo esc_html($price['price_button_text']); ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } } } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }
