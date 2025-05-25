<?php
/**
 * The template for displaying all single posts.
 *
 * @package magazine-newspaper
 */

get_header(); ?>

<?php
  $layout = get_theme_mod( 'magazine_newspaper_post_sidebar_layout', 'right-sidebar' );
  if( $layout == 'no-sidebar' ) {
    $content_column_class = 'col-sm-12';
  } else {
    $content_column_class = 'col-sm-8';
  }
?>

<div class="inside-page">
  <div class="container">
    <div class="row"> 

      <?php if ( $layout == 'left-sidebar' ) : ?>
      <div class="col-sm-4"><div class="inside-sidebar"><?php dynamic_sidebar( 'sidebar-1' ); ?></div></div>
      <?php endif; ?>

      <div class="<?php echo esc_attr( $content_column_class ); ?>">
        <section class="page-section">
          <div class="detail-content">

            <?php while ( have_posts() ) : the_post(); ?>
              <?php
                get_template_part( 'template-parts/content', 'single' );
              ?>
            <?php endwhile; // End of the loop. ?>
            <?php comments_template(); ?>

          </div><!-- /.end of deatil-content -->
        </section> <!-- /.end of section -->  
      </div>

      <?php if( $layout == 'right-sidebar' ) : ?>
        <div class="col-sm-4"><div class="inside-sidebar"><?php dynamic_sidebar( 'sidebar-1' ); ?></div></div>
      <?php endif; ?>

    </div>
  </div>
</div>

<?php get_footer();