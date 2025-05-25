<?php
if ( ! get_theme_mod( 'jason_portfolio_resume_enable_resume_section', false ) ) {
    return;
}

$section_content = array();
$section_content['section_resume_headline'] = get_theme_mod( 'jason_portfolio_resume_resume_section_headline', __( 'My Resume', 'jason-portfolio-resume' ) );
$section_content['section_resume_headline_sub'] = get_theme_mod( 'jason_portfolio_resume_resume_section_headline_sub', __( 'The services we provide', 'jason-portfolio-resume' ) );
$section_content['section_resume_list_skill'] = json_to_array(get_theme_mod( 'jason_portfolio_resume_resume_section_skill_list' ));

$section_content = apply_filters( 'jason_portfolio_resume_resume_section_content', $section_content );
jason_portfolio_resume_render_resume_section( $section_content );

/**
 * Render Resume Section
 */
function jason_portfolio_resume_render_resume_section( $section_content ) {
    $list_skill = $section_content['section_resume_list_skill'];
    $class = '';
    if(trim(CRT_THEMES_NAME_TEMPLATE) == 'jason-portfolio-resume') {
        $class = 'mb-0 px-50 w-75 offset-0 offset-lg-3';
    }
?>
<section id="my-resume" class="my-resume <?php echo esc_attr($class);?>">
    <?php
    if ( is_customize_preview() ) :
        jason_portfolio_resume_section_link( 'jason_portfolio_resume_resume_section' );
    endif;
    ?>
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <h2 class="heading-default" data-viewport="custom"><?php echo wp_kses_post($section_content['section_resume_headline']); ?><span><?php echo esc_html($section_content['section_resume_headline_sub']); ?></span></h2>
                <div class="">
                    <div class="row">
                    <?php foreach ($list_skill as $skill) { ?>
                        <?php if($skill['field_type'] == 'type_1'): ?>
                            <div class="col-12 col-md-6 pe-2 pe-md-4 pe-lg-5 my-resume__item mb-4">
                                <h3 class="heading-default__small" data-viewport="opacity" style="background-color: <?php echo esc_attr($skill['color']); ?>"><?php echo esc_html($skill['title']); ?></h3>
                                <div class="my-resume__skill">
                                    <?php if(!empty($skill['field_repeater'])): foreach ( $skill['field_repeater'] as $item_skill ) : ?>
                                    <div class="my-resume__skill--item " data-viewport="custom">
                                        <label><?php echo esc_html($item_skill['skill_title']); ?></label>
                                        <div class="my-resume__skill--precent" data-precent="<?php echo esc_attr($item_skill['skill_precent'] . '0'); ?>"><div></div><span class="count"></span></div>
                                    </div>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                        <?php elseif($skill['field_type'] == 'type_2'): ?>
                            <div class="col-12 col-md-6 my-resume__item mb-4">
                                <h3 class="heading-default__small" data-viewport="opacity" style="background-color: <?php echo esc_attr($skill['color']); ?>"><?php echo esc_html($skill['title']); ?></h3>
                                <div class="education__list highlight">
                                <?php if(!empty($skill['field_repeater'])): foreach ( $skill['field_repeater'] as $item_skill ) : ?>
                                    <div class="education__item highlight__item" data-viewport="opacity">
                                        <div class="education__date"><?php echo esc_html($item_skill['skill_title']); ?></div>
                                        <div class="education__description">
                                            <?php echo wp_kses_post($item_skill['skill_content']); ?>
                                        </div>
                                    </div>
                                <?php endforeach; endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }