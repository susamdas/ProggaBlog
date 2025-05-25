<?php
if ( ! get_theme_mod( 'jason_portfolio_resume_enable_project_section', false ) ) {
    return;
}

$section_content = array();
$section_content['section_project_headline'] = get_theme_mod( 'jason_portfolio_resume_project_section_headline', __( 'My Project', 'jason-portfolio-resume' ) );
$section_content['section_project_headline_sub'] = get_theme_mod( 'jason_portfolio_resume_project_section_headline_sub', __( 'Projects that I have done', 'jason-portfolio-resume' ) );
$section_content['section_project_background'] = get_theme_mod( 'jason_portfolio_resume_project_section_background_grey', '--bg-section' );
$section_content['section_project_list'] = json_to_array(get_theme_mod( 'jason_portfolio_resume_resume_section_project_list' ));
$section_content = apply_filters( 'jason_portfolio_resume_project_section_content', $section_content );
jason_portfolio_resume_render_project_section( $section_content );

/**
 * Render Project Section
 */
function jason_portfolio_resume_render_project_section( $section_content ) {
    $list_project = $section_content['section_project_list'];
    $class = '';
    if(trim(CRT_THEMES_NAME_TEMPLATE) == 'jason-portfolio-resume') {
        $class = 'mb-0 px-50 w-75 offset-0 offset-lg-3';
    }
?>
<section id="my-project" class="my-project <?php echo esc_attr($class);?>">
    <?php
    if ( is_customize_preview() ) :
        jason_portfolio_resume_section_link( 'jason_portfolio_resume_project_section' );
    endif;
    ?>
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="my-project__inner">
                    <h2 class="heading-default" data-viewport="custom"><?php echo wp_kses_post($section_content['section_project_headline']); ?><span><?php echo esc_html($section_content['section_project_headline_sub']); ?></span></h2>
                    <ul class="my-project__nav nav d-flex justify-content-center mb-3" data-viewport="opacity">
                        <li class="nav-item" role="presentation">
                            <button class="active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                        </li>
                        <?php foreach ($list_project as $nav) { ?>
                            <li class="nav-item" role="presentation">
                                <button class="" id="<?php echo esc_attr(sanitize_title($nav['title'])); ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr(sanitize_title($nav['title'])); ?>" type="button" role="tab" aria-controls="<?php echo esc_attr(sanitize_title($nav['title'])); ?>" aria-selected="false"><?php echo esc_html($nav['title']); ?></button>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content" data-viewport="opacity">
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <div class="project__list">
                            <?php foreach ($list_project as $items) :
                                if(!empty($items['field_repeater'])): foreach ($items['field_repeater'] as $item) : ?>
                                <div class="product__item">
                                    <div class="product__item--inner">
                                        <a class="<?php echo esc_attr(empty($item['project_url']) ? 'button-image':'') ?>" href="<?php echo esc_attr(!empty($item['project_url']) ? $item['project_url']:$item['project_image']); ?>">
                                            <figure class="ratio ratio-4x3 lazy" data-src="<?php echo esc_attr($item['project_image']); ?>"></figure>
                                            <div class="product__content">
                                                <h4 class="product__name mt-0 mb-2"><?php echo esc_html($item['project_name']); ?></h4>
                                                <p class="product__score mb-2"><?php echo esc_html($item['project_category']); ?></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach; endif; ?>
                            <?php endforeach; ?>
                            </div>
                        </div>
                        <?php foreach ($list_project as $items) : ?>
                            <div class="tab-pane fade" id="<?php echo esc_attr(sanitize_title($items['title'])); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr(sanitize_title($items['title'])); ?>-tab">
                                <div class="project__list">
                                    <?php if(!empty($items['field_repeater'])): foreach ($items['field_repeater'] as $item) : ?>
                                    <div class="product__item">
                                        <div class="product__item--inner">
                                            <a class="<?php echo esc_attr(empty($item['project_url']) ? 'button-image':'') ?>" href="<?php echo esc_attr(!empty($item['project_url']) ? $item['project_url']:$item['project_image']); ?>">
                                                <figure class="ratio ratio-4x3 lazy" data-src="<?php echo esc_attr($item['project_image']); ?>"></figure>
                                                <div class="product__content">
                                                    <h4 class="product__name mt-0 mb-2"><?php echo esc_html($item['project_name']); ?></h4>
                                                    <p class="product__score mb-2"><?php echo esc_html($item['project_category']); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }

