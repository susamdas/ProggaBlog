<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jason_Portfolio_Resume
 */

?>
<div class="archive__item">
    <div class="archive__item--inner">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="row">
                <div class="col-12 col-md-4 mb-3 mb-md-0">
                    <?php jason_portfolio_resume_post_thumbnail(); ?>
                </div>
                <div class="col-12 col-md-8">
                    <div class="my-blog__items--content">
                        <?php
                        if ( is_singular() ) :
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        else :
                            the_title( '<h3 class="entry-title heading-default-single"><a class="magic-hover magic-hover__square" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                        endif;
                        ?>
                        <div class="entry">
                            <?php
                                jason_portfolio_resume_posted_on();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </article><!-- #post-<?php the_ID(); ?> -->
    </div>
</div>