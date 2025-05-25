<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package magazine-newspaper
 */

get_header(); ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Marquee Section -->
<div class="marquee-container" style="
    background: linear-gradient(45deg, #006400, #66c29c);
    border: 2px solid #e57373;
    padding: 5px 10px; /* Reduced padding for a thinner block */
    margin: 0 auto;
    max-width: 50%; /* Reduced max-width to make it thinner */
    border-radius: 25px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    position: relative;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255, 255, 255, 0.1); z-index: 0; pointer-events: none;"></div>
    <marquee style="
        color: #fff; /* White text color */
        font-size: 16px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        z-index: 1;
        position: relative;">
        <span style="color: red;">✨</span> 
        <?php 
        // You can dynamically fetch marquee content here if needed.
        echo esc_html__( 'ব্যক্তিগত ব্লগ সাইটে আপনাকে স্বাগতম। নতুন নতুন তথ্য ও কনট্যান্ট এর জন্য আমাদের সাথে থাকুন।', 'প্রজ্ঞা-আলাপন' ); 
        ?> 
        <span style="color: red;">✨</span> 
    </marquee>
</div>

<?php
	$layout = get_theme_mod( 'magazine_newspaper_blog_sidebar_layout', 'right-sidebar' );
	$view = get_theme_mod( 'magazine_newspaper_blog_view', 'list-view' );

	if( $layout == 'no-sidebar' ) {
		$content_column_class = 'col-sm-12';
	} else {
		$content_column_class = 'col-sm-8';
	}

	$post_details = get_theme_mod( 'magazine_newspaper_blog_details', array( 'date', 'categories' ) );
 	set_query_var( 'post_details', $post_details );
?>
<div class="home-archive inside-page post-list">
  <div class="container">
    <div class="row">

    	<?php if ( $layout == 'left-sidebar' ) : ?>
    	<div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
    	<?php endif; ?>

    	<div class="<?php echo esc_attr( $content_column_class ); ?>">
    		<div class="flex-table view <?php echo esc_attr( $view ); ?> row">
	        <!-- <div class="row"> -->
	        	<?php if ( have_posts() ) : ?>
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
	              get_template_part( 'template-parts/content' ,null, array(
                  'view' => $view,
                  'post_details' => $post_details
                ) );
              ?>
		        <?php endif; ?>
		    <!-- </div> -->
        </div> <!-- end view -->			    				    
			</div>

			<?php if( $layout == 'right-sidebar' ) : ?>
	    	<div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
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
