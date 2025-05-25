<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
                    <div class="block-default__inner mb-4">
                        <?php jason_portfolio_resume_post_thumbnail(); ?>
                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content', 'single' );

                            do_action( 'jason_portfolio_resume_post_navigation' );

                            if ( is_singular( 'post' ) ) {
                                $related_posts_label = get_theme_mod( 'jason_portfolio_resume_post_related_post_label', __( 'Related Posts', 'jason-portfolio-resume' ) );
                                $cat_content_id      = get_the_category( $post->ID )[0]->term_id;
                                $args                = array(
                                    'cat'            => $cat_content_id,
                                    'posts_per_page' => 3,
                                    'post__not_in'   => array( $post->ID ),
                                    'orderby'        => 'rand',
                                );
                                $query               = new WP_Query( $args );

                                if ( $query->have_posts() ) :
                                    ?>
                                    <div class="related-posts">
                                        <?php
                                        if ( get_theme_mod( 'jason_portfolio_resume_post_hide_related_posts', false ) === false ) :
                                            ?>
                                            <h2><?php echo esc_html( $related_posts_label ); ?></h2>
                                            <div class="my-blog__list">
                                                <?php
                                                while ( $query->have_posts() ) :
                                                    $query->the_post();
                                                ?>
                                                <div class="col-12 my-blog__item">
                                                    <div class="row">
                                                        <div class="col-4 col-md-3">
                                                            <a class="my-blog__detail" data-id="3">
                                                                <?php jason_portfolio_resume_post_thumbnail(); ?>
                                                            </a>
                                                        </div>
                                                        <div class="col-8 col-md-9">
                                                            <?php the_title( '<h5 class="my-blog__detail entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
                                                            <?php
                                                            if ( 'post' === get_post_type() ) :
                                                                setup_postdata( get_post() );
                                                                ?>
                                                                <div class="related_entry-meta">
                                                                    <?php
                                                                    jason_portfolio_resume_posted_on();
                                                                    jason_portfolio_resume_posted_by();
                                                                    ?>
                                                                </div><!-- .entry-meta -->
                                                            <?php
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    endwhile;
                                                    wp_reset_postdata();
                                                ?>
                                            </div>
                                            <?php
                                        endif;
                                        ?>
                                    </div>
                                    <?php
                                endif;
                            }

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
