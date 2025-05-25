<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package magazine-newspaper
 */

get_header(); ?>

<?php
	$view = get_theme_mod( 'magazine_newspaper_blog_view', 'list-view' );
  $layout = get_theme_mod( 'magazine_newspaper_blog_sidebar_layout', 'right-sidebar' );

  if( $layout == 'no-sidebar' ) {
      $content_column_class = 'col-sm-12';
  } else {
      $content_column_class = 'col-sm-8';
  }

  $post_details = get_theme_mod( 'magazine_newspaper_post_details', array( 'date', 'categories', 'tags' ) );
  set_query_var( 'post_details', $post_details );
?>

<div class="inside-page">
	<div class="container">
		<div class="row">

			<?php if ( $layout == 'left-sidebar' ) : ?>
	      <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
	    <?php endif; ?>

			<section class="page-section flex-table view <?php echo esc_attr( $content_column_class ); ?>">
				<div class="detail-content">
			    <?php while ( have_posts() ) : the_post(); ?>
			      <?php get_template_part( 'template-parts/content', 'page' ); ?>
			    <?php endwhile; // End of the loop. ?> 
			    <?php comments_template(); ?>
			  </div> <!-- /.end of detail-content -->	
			</section><!-- /.end of section -->

			<?php if( $layout == 'right-sidebar' ) : ?>
		    <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
		  <?php endif; ?>

		</div>
	</div>
</div>
<?php get_footer(); ?>