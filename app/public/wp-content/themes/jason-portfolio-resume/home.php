<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jason_Portfolio_Resume
 */

get_header();
?>
<main id="content" class="site-main home">
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
                    <div class="archive__inner archive__inner--w100">
                        <?php if ( is_front_page() && is_home() ) : ?>
                            <header class="page-header">
                                <h1 class="page-title"><?php echo esc_html__( 'Latest post', 'jason-portfolio-resume' ); ?></h1>
                            </header>
                        <?php endif; ?>
                        <div class="archive__list">
                            <?php if ( have_posts() ) :
                                /* Start the Loop */
                                while ( have_posts() ) :
                                    the_post();
                                    /*
                                    * Include the Post-Type-specific template for the content.
                                    * If you want to override this in a child theme, then include a file
                                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                    */
                                    get_template_part( 'template-parts/content', get_post_type() );
                                endwhile;
                            else :
                                get_template_part( 'template-parts/content', 'none' );
                            endif;
                            ?>
                        </div>
                        <?php
                            do_action( 'jason_portfolio_resume_posts_pagination' );
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
