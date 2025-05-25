<?php if( get_theme_mod( 'magazine_newspaper_recent_news_display', $default = true ) ) : ?>
<!-- recent news -->
<?php
  $category_id = get_theme_mod( 'magazine_newspaper_recent_news_category', '' );
  $title = get_theme_mod( 'magazine_newspaper_recent_news_title', '' );
  $number_of_posts = get_theme_mod( 'magazine_newspaper_recent_news_number_of_posts', 5 );
  $category_args = array(
    'cat' => $category_id,
    'posts_per_page' => abs( $number_of_posts ),
  );

  $sidebar_position = get_theme_mod( 'magazine_newspaper_recent_news_sidebar_layout', 'right-sidebar' );
  $width_class = 'col-sm-8';
  if( $sidebar_position == 'no-sidebar' ) {
    $width_class = 'col-sm-12';
  }
?>

<?php $query = new WP_Query( $category_args );
if( $query->have_posts() ) : ?>
  <div id="magazine_newspaper_recent_news_sections" class="recent-news spacer">
    <div class="container">
    <?php if( $title ) : ?><h2 class="widget-title"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
    <div class="row">

      <?php if( $sidebar_position == 'left-sidebar' ) : ?>
      <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
      <?php endif; ?>

      <div class="<?php echo esc_attr( $width_class ); ?>">
        <div class="row flex-table">
          <?php
            $item_counter = 1;            
          ?>
           <?php while ( $query->have_posts() ) : $query->the_post(); ?>
              <?php if( $item_counter == 1 ) {
                $class = "col-xs-12 big-block";
                $image_size = "full";
              }
              else {
              	$class = "col-12 col-xs-6";
                $image_size = "thumbnail";
              }
              ?>
                <div class="<?php echo $class; ?>">
                  <div class="news-snippet">                    
                    <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="featured-image">
                      <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( $image_size ); ?>
                      <?php else : ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image.jpg' ); ?>">
                      <?php endif; ?>                      
                    </a>
                    <!-- summary -->
                    <div class="summary">
                      <h4 class="news-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                      <small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date(); ?></small>
                    </div>
                    <!-- summary -->
                  </div>
                </div>              
              <?php $item_counter++; ?>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php
        // category news starts
        $defaults = array(
          array(
            'category_title' => '',
            'category_news'  => '',
            'number_of_posts' =>  '5'
          ),
          array(
            'category_title' => '',
            'category_news'  => '',
            'number_of_posts' =>  '5'
          ),
          array(
            'category_title' => '',
            'category_news'  => '',
            'number_of_posts' =>  '5'
          ),
        );
        $settings = get_theme_mod( 'magazine_newspaper_category_news_settings', $defaults );

        if( ! empty( $settings ) ) :
          foreach ( $settings as $setting ) :
            $category_id = $setting['category_news'];
            $title = $setting['category_title'];
            $number_of_posts = $setting['number_of_posts'];
            $args = array(
              'cat' => $category_id,
              'posts_per_page' => abs( $number_of_posts )
            );
            $query = new WP_Query( $args );
          ?>

            <?php if( $query->have_posts() ) : ?>
              <div class="category-news"> 
                <?php if( $title ) : ?><h2 class="widget-title"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
                  <div class="row flex-table">
                     <?php while ( $query->have_posts() ) : $query->the_post(); ?>                             
                        <div class="col-12 col-xs-6">
                          <div class="news-snippet">                      
                            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="featured-image">
                              <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'thumbnail' ); ?>
                              <?php else : ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image.jpg' ); ?>">
                              <?php endif; ?>                        
                            </a>
                          <!-- summary -->
                          <div class="summary">
                            <h4 class="news-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                            <small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date(); ?></small>
                          </div>
                          <!-- summary -->
                          </div>
                        </div>            
                      <?php endwhile; wp_reset_postdata(); ?>
                  </div>
              </div>
            <?php endif;
          endforeach;
        endif;
        // category news ends
        ?>
        </div>

        <?php if( $sidebar_position == 'right-sidebar' ) : ?>
        <div class="col-sm-4"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
        <?php endif; ?>

      </div>
    </div>
  </div>
<?php endif; ?>
<?php endif; ?>
<!-- recent news -->