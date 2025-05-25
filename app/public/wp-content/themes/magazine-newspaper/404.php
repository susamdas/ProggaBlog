<?php
/**
 * The template for displaying 404 pages (not found).
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

<section class="page-header spacer">
  <div class="container">
    <div class="row">

      <?php if ( $layout == 'left-sidebar' ) : ?>
      <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
      <?php endif; ?>

    	<div class="<?php echo esc_attr( $content_column_class ); ?>">
        <h1 class="text-center">
      		<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'magazine-newspaper' ); ?>
      	</h1>

        <div class="detail-content">
        	<div class="not-found">
          		<p class="text-center"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'magazine-newspaper' ); ?></p>
  		         <?php get_search_form(); ?>
        	</div>
        </div>
      </div>

      <?php if( $layout == 'right-sidebar' ) : ?>
        <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
      <?php endif; ?>
      
    </div>
  </div>
</section>

<?php get_footer(); ?>