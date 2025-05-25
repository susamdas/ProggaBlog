<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
                    <div class="archive__inner archive__inner--w100">
                        <header class="page-header">
                            <h1 class="page-title">
                                <?php
                                /* translators: %s: search query. */
                                printf( esc_html__( 'Search Results for: %s', 'jason-portfolio-resume' ), '<span>' . get_search_query() . '</span>' );
                                ?>
                            </h1>
                        </header><!-- .page-header -->
                        <div class="archive__list">
                            <?php if ( have_posts() ) : ?>
                                <?php
                                /* Start the Loop */
                                while ( have_posts() ) :
                                    the_post();
                                    /*
                                    * Include the Post-Type-specific template for the content.
                                    * If you want to override this in a child theme, then include a file
                                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                    */
                                    get_template_part( 'template-parts/content', 'search' );
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
