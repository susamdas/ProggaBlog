<div id="magazine_newspaper_banner_news_sections" class="banner-news banner-news-slider spacer">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">   
    <section  id="owl-slider-one" class="owl-carousel"> 
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="item">
          <div class="banner-news-list">
          <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'banner' ); ?>
              <?php
                if( ! empty( $image ) ) :
                  $image = $image[0];
                else :
                  $image = get_template_directory_uri() . '/images/a.jpg';
                endif;
              ?>
              <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="img-responsive">
              <div class="banner-news-caption">
                  <?php
                    if ( ! empty( $slider_details ) && is_array( $slider_details ) ) {
                      if( in_array( 'categories', $slider_details ) ) {
                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';
                        if ( ! empty( $categories ) ) {                     
                          foreach ( $categories as $cat ) {
                            $output .= '<a class="news-category sec-bg-color" href="'. esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>' . $separator;
                          }
                          echo trim( $output, $separator );
                        }
                      }
                    }
                  ?>
                  <h3 class="banner-news-title">
                    <a href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>"><?php the_title(); ?></a>
                  </h3>

                  <?php if ( ! empty( $slider_details ) && is_array( $slider_details ) ) : ?>
                      <?php if( in_array( 'date', $slider_details ) ) : ?>
                        <small class="date">
                          <i class="fa fa-clock-o"  aria-hidden="true"></i>
                          <?php echo esc_attr( get_the_date() ); ?>
                        </small>
                      <?php endif; ?>
                  <?php endif; ?>                  
                </div>           
          </div>
          </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </section> 
  </div>
  <div class="col-sm-4">

<!-- Top News  -->
  <?php if( $title ) : ?><h2 class="widget-title"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
  <section class="top-news-side">
      <div class="clearfix">
          <?php
            $category_id = get_theme_mod( 'top_news_category' );            
            $category = get_category( $category_id );
            $title = get_theme_mod( 'top_news_section_title' );
            $number_of_posts = get_theme_mod( 'top_news_number_of_posts', 3 );

            $args = array(
              'cat' => $category_id,
              'posts_per_page' => $number_of_posts
            );

            $loop = new WP_Query( $args );
          ?>      
          <?php if( $title ) : ?><h2 class="news-heading"><?php echo esc_html( $title ); ?></h2><?php endif; ?>  
              <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
              <div class="item">
                  <div class="news-snippet">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="featured-image"><?php the_post_thumbnail( 'thumbnail' ); ?></a>                  
                    <?php endif; ?>  
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
    </div>  <!-- /.end of container -->
  </section>  <!-- /.end of section -->
  <!-- Top News  -->




  </div>
  </div>
  </div>
</div>