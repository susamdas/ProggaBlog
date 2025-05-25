<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jason_Portfolio_Resume
 */

get_header();
?>
<main id="content" class="site-main">
    <section class="block-default px-50 w-75 offset-0 offset-lg-3">
        <div class="container-xl">
            <div class="row">
                <?php
                $sidebar = jason_portfolio_resume_is_sidebar_enabled();
                $col_one = '';
                $col_two = '';
                if($sidebar == 'right-sidebar') {
                    $col_one = 'col-12 col-md-8';
                    $col_two = 'col-12 col-md-4 ps-md-3';
                } elseif($sidebar == 'left-sidebar') {
                    $col_one = 'col-12 col-md-8';
                    $col_two = 'col-12 col-md-4 order-first  pe-md-3';
                }  elseif($sidebar == 'no-sidebar') {
                    $col_one = 'col-12';
                    $col_two = 'd-none';
                }
                ?>
                <div class="<?php echo esc_attr($col_one); ?>">
                    <div class="block-default__inner">
                        <?php jason_portfolio_resume_post_thumbnail(); ?>
                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content', 'page' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>
                    </div>
                </div>
                <div class="<?php echo esc_attr($col_two); ?>">
                    <?php
                    if ( jason_portfolio_resume_is_sidebar_enabled() || jason_portfolio_resume_is_sidebar_enabled() != 'no-sidebar' ) {
                        get_sidebar();
                    }
                    ?>
                </div>

            </div>
        </div>
    </section>
</main><!-- #main -->
<?php
get_footer();
