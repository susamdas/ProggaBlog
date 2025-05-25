<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jason_Portfolio_Resume
 */

?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if ( is_singular() ) : ?>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title heading-default-single">', '</h1>' ); ?>
            </header><!-- .entry-header -->
            <?php
            if ( 'post' === get_post_type() ) :
                setup_postdata( get_post() );
                ?>
                <div class="entry-meta">
                    <?php
                    jason_portfolio_resume_posted_on();
                    jason_portfolio_resume_posted_by();
                    ?>
                </div><!-- .entry-meta -->
                <?php
            endif;
            ?>
        <?php endif; ?>


        <div class="entry-content editor-content">
            <?php
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'jason-portfolio-resume' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jason-portfolio-resume' ),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer entry-footer--single">
            <?php jason_portfolio_resume_entry_single_footer(); ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-<?php the_ID(); ?> -->
