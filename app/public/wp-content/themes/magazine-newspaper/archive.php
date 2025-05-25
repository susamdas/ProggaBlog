<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package magazine-newspaper
 */

get_header(); ?>
<?php
  global $wp_query;
  $max_pages = $wp_query->max_num_pages;
?>

<?php
  $view = get_theme_mod( 'magazine_newspaper_blog_view', 'list-view' );
  $sidebar_position = get_theme_mod( 'magazine_newspaper_blog_sidebar_layout', 'right-sidebar' );
  $width_class = 'col-sm-8';
  if( $sidebar_position == 'no-sidebar' ) {
    $width_class = 'col-sm-12';
  }

  $post_details = get_theme_mod( 'magazine_newspaper_post_details', array( 'date', 'categories', 'tags' ) );

  set_query_var( 'post_details', $post_details );
?>

<div class="post-list">
  <div class="container">
  <?php if( have_posts() ) :
    the_archive_title( '<h1 class="category-title">', '</h1>' );
    the_archive_description( '<p class="taxonomy-description">', '</p>' );
  endif; ?>
    <div class="row">

      <?php if( $sidebar_position == 'left-sidebar' ) : ?>
      <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
      <?php endif; ?>
      
      <div class="<?php echo esc_attr( $width_class ); ?>">
        <div class="flex-table view <?php echo $view;?> row">
          <?php if ( have_posts() ) : ?>
            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <?php 
                get_template_part( 'template-parts/content' ,null, array(
                  'view' => $view,
                  'post_details' => $post_details
                ) );
              ?>
            <?php endwhile; ?>
          <?php else : ?>
          <?php 
            get_template_part( 'template-parts/content', null, array(
              'view' => $view,
              'post_details' => $post_details
            ) );
          ?>
        <?php endif; ?>
        </div>
      </div>
    
      <?php if( $sidebar_position == 'right-sidebar' ) : ?>
        <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
      <?php endif; ?>

    </div>

    <?php
      if (  $wp_query->max_num_pages > 1 ) {
        if( get_theme_mod( 'magazine_newspaper_pagination_type', 'number-pagination' ) == 'number-pagination' ) {
          magazine_newspaper_numeric_posts_nav();
        } else if( get_theme_mod( 'magazine_newspaper_pagination_type', 'number-pagination' ) == 'ajax-loadmore' ) { ?>
          <div id="magazine_newspaper_pagination" class="loadmore"><button view="<?php echo $view;?>"><?php esc_html_e( 'More posts', 'magazine-newspaper' ); ?></button></div>
        <?php }
      }
    ?>

  </div>
</div>
<?php get_footer(); ?>
