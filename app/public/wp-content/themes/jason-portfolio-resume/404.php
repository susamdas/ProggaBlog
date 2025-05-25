<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Jason_Portfolio_Resume
 */

get_header();
?>
<main id="content" class="site-main">
    <section class="block-default px-50 w-75 offset-0 offset-lg-3">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <section class="error-404 not-found">
                        <header>
                            <h1><?php esc_html_e( '404', 'jason-portfolio-resume' ); ?></h1>
                            <p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'jason-portfolio-resume' ); ?></p>
                        </header><!-- .page-header -->
                        <div class="page-content">
                            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'jason-portfolio-resume' ); ?></p>
                            <?php get_search_form(); ?>
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->
                </div>
            </div>
        </div>
    </section>
</main><!-- #main -->
<?php
get_footer();
