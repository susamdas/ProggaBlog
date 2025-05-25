<?php
/**
 * The template for displaying search results pages.
 *
 * @package magazine-newspaper
 */

get_header(); ?>

<?php
  $layout = get_theme_mod( 'magazine_newspaper_blog_sidebar_layout', 'right-sidebar' );

  if( $layout == 'no-sidebar' ) {
      $content_column_class = 'col-sm-12';
  } else {
      $content_column_class = 'col-sm-8';
  }
?>

<div class="spacer post-list">
  <div class="container">
    <div class="row">

      <?php if ( $layout == 'left-sidebar' ) : ?>
      <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
      <?php endif; ?>

      <div class="flex-table view <?php echo esc_attr( $content_column_class ); ?>">
        <?php if ( have_posts() ) : ?>

          <h2><?php printf( esc_html__( 'Search Results for: %s', 'magazine-newspaper' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>

            <?php
            /**
             * Run the loop for the search to output the results.
             * If you want to overload this in a child theme then include a file
             * called content-search.php and that will be used instead.
             */
            get_template_part( 'template-parts/content', 'search' );
            ?>

          <?php endwhile; ?>

        <?php else : ?>

          <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>

      </div><!-- #primary -->

      <?php if( $layout == 'right-sidebar' ) : ?>
        <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
      <?php endif; ?>

    </div>

  </div>
</div>

<?php get_footer(); ?>