<?php if( get_theme_mod( 'magazine_newspaper_top_news_display', $default = true ) ) : ?>
<!-- Top News  -->
  <section id="magazine_newspaper_top_news_sections" class="top-news spacer">
      <div class="container">
        <div class="inside-wrapper">
        <?php
          $category_id = get_theme_mod( 'magazine_newspaper_top_news_category', '' );
          $title = get_theme_mod( 'magazine_newspaper_top_news_section_title', '' );
          $number_of_posts = get_theme_mod( 'magazine_newspaper_top_news_number_of_posts', 3 );
          $args = array(
            'cat' => $category_id,
            'posts_per_page' => abs( $number_of_posts )
          );

          $query = new WP_Query( $args );
        ?>      
        <?php if( $title ) : ?><h2 class="widget-title"><?php echo esc_html( $title ); ?></h2><?php endif; ?>  
          <div id="owl-topnews" class="owl-carousel">
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="item">
                <div class="news-snippet">                    
                  <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="featured-image">
                    <?php
                      if ( has_post_thumbnail() ) :
                        the_post_thumbnail( 'thumbnail' );
                      else : ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image.jpg' ); ?>">
                      <?php endif;
                    ?>                      
                  </a>
                  <!-- summary -->
                  <div class="summary">
                    <h4 class="news-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                    <small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date(); ?></small>
                  </div>
                  <!-- summary -->
                </div>
            </div>
          <?php
            endwhile;
                wp_reset_postdata();
            endif;
          ?>
        </div>
      </div>
    </div>  <!-- /.end of container -->
  </section>  <!-- /.end of section -->
  <!-- Top News  -->
<?php endif;