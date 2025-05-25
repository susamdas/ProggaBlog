<?php
if ( ! get_theme_mod( 'jason_portfolio_resume_enable_blog_section', false ) ) {
    return;
}

$section_content['section_blog_headline'] = get_theme_mod( 'jason_portfolio_resume_blog_section_headline', __( 'My Blog', 'jason-portfolio-resume' ) );
$section_content['section_blog_headline_sub'] = get_theme_mod( 'jason_portfolio_resume_blog_section_headline_sub', __( 'My shared posts', 'jason-portfolio-resume' ) );
$section_content['section_blog_list'] = get_theme_mod( 'jason_portfolio_resume_blog_list');
$section_content['section_blog_button_text'] = get_theme_mod( 'jason_portfolio_resume_blog_section_button_text');
$section_content['section_blog_button_url'] = get_theme_mod( 'jason_portfolio_resume_blog_section_button_url');
$section_content = apply_filters( 'jason_portfolio_resume_blog_section_content', $section_content );
jason_portfolio_resume_render_blog_section( $section_content );

/**
 * Render Blog Section
 */
function jason_portfolio_resume_render_blog_section($section_content) {
    $class = '';
    if(trim(CRT_THEMES_NAME_TEMPLATE) == 'jason-portfolio-resume') {
        $class = 'mb-0 px-50 w-75 offset-0 offset-lg-3';
    }
?>
<section id="my-blog" class="my-blog <?php echo esc_attr($class);?>">
    <?php
    if ( is_customize_preview() ) :
        jason_portfolio_resume_section_link( 'jason_portfolio_resume_blog_section' );
    endif;
    ?>
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="my-blog__inner">
                    <h2 class="heading-default" data-viewport="custom"><?php echo wp_kses_post($section_content['section_blog_headline']); ?><span><?php echo esc_html($section_content['section_blog_headline_sub']); ?></span></h2>
                    <?php if( !empty( $section_content['section_blog_list'] ) ) { ?>

                    <div class="my-blog__list">

                        <?php foreach ( $section_content['section_blog_list'] as $post_id ) {
                            $post = get_post( $post_id );
                            $date = date('F d, Y', strtotime($post->post_date));
                            $get_permalink = get_post_permalink( $post );
                            $get_thumbnail_url = get_the_post_thumbnail_url( $post );
                        ?>
                        <div class="my-blog__items" data-viewport="opacity">
                            <div class="my-blog__items--inner">
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                                        <a class="my-blog__detail" href="<?php echo esc_html($get_permalink); ?>">
                                            <figure class="m-0 ratio ratio-4x3 lazy bg-cover" data-src="<?php echo esc_html($get_thumbnail_url); ?>"></figure>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="my-blog__items--content">
                                            <h3><a class="my-blog__detail" href="<?php echo esc_html($get_permalink); ?>"><?php echo esc_html($post->post_title); ?></a></h3>
                                            <div class="entry">
                                                <span class="entry__category"><?php jason_portfolio_resume_entry( $post_id ); ?></span>
                                                <span class="entry__date"><?php echo esc_html($date); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="my-blog__button d-flex justify-content-center" data-viewport="opacity">
                        <a class="pointer-event" href="<?php echo esc_attr($section_content['section_blog_button_url']); ?>"><?php echo esc_html($section_content['section_blog_button_text']); ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>