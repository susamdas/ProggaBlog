<?php get_theme_mod( 'magazine_newspaper_detail_news_display' ); ?>
<?php if( get_theme_mod( 'magazine_newspaper_detail_news_display', $default = true ) ) : ?>
    <?php
      global $paged;
      $paged = (get_query_var('page')) ? get_query_var('page') : 1;   
      $title = get_theme_mod( 'magazine_newspaper_detail_news_title' );
      $cat = get_theme_mod( 'magazine_newspaper_detail_news_category', '' );
      $posts_per_page = get_option( 'posts_per_page' );
      $args = array(
        'post_type' => 'post',
        'cat'       => $cat,
        'posts_per_page'    => absint( 0 ),
        'paged'     => esc_attr( $paged )
      );
      $wp_query = new WP_Query( $args );
    ?>

    <?php
      $view = get_theme_mod( 'magazine_newspaper_detail_news_view', 'list-view' );

      $sidebar_position = get_theme_mod( 'magazine_newspaper_detail_news_sidebar_layout', 'right-sidebar' );
      $width_class = 'col-sm-8';
      if( $sidebar_position == 'no-sidebar' ) {
        $width_class = 'col-sm-12';
      }

      $post_details = get_theme_mod( 'magazine_newspaper_detail_news_details', array( 'date', 'categories', 'tags' ) );

      set_query_var( 'post_details', $post_details );

      if ( $wp_query->have_posts() ) { ?>
      <div id="magazine_newspaper_detail_news_sections" class="home-archive inside-page post-list">
        <div class="container">
          <?php if( ! empty( $title ) ) : ?><h2 class="widget-title"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
          <div class="row">
       
            <?php if( $sidebar_position == 'left-sidebar' ) : ?>
            <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
            <?php endif; ?>

            <div class="<?php echo esc_attr( $width_class ); ?>">
            	<div class="flex-table view <?php echo $view;?> row">
                
                <?php /* Start the Loop */ ?>
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                <?php
                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content' ,null, array(
                  'view' => $view,
                  'post_details' => $post_details
                ) );
                ?>
                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>
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
          
          
      <?php } ?>
    
<?php endif; ?>