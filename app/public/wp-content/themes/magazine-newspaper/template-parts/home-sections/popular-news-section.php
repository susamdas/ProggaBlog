<?php
if( get_theme_mod( 'magazine_newspaper_popular_news_display', $default = true ) ) : ?>
	<?php
	$title = get_theme_mod( 'magazine_newspaper_popular_news_title' );
	$number_of_posts = get_theme_mod( 'magazine_newspaper_popular_news_number_of_posts' );
	$popular_post = new WP_Query( array(
		'posts_per_page' => abs( $number_of_posts ),
		'meta_key' => 'magazine_newspaper_post_views_count',
		'orderby' => 'meta_value_num',
		'order' => 'DESC',
	) );

	if( $popular_post->have_posts() ): ?>

		<!-- popular news -->
		<section id="magazine_newspaper_popular_news_sections" class="popular-news-block spacer">
			<div class="container">
				<?php if( $title ) : ?><h2 class="widget-title"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
				<div id="owl-crewmembers" class="owl-carousel">
					<?php while( $popular_post->have_posts() ): $popular_post->the_post(); ?>
						<div class="item">
							<div class="popular-news-snippet">
		            <a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark" class="featured-image">
									<?php
									$args = array(
										'class' => 'attachment-thumbnail size-thumbnail wp-post-image',
										'alt' => ''
									);
									if( has_post_thumbnail() ) :
										the_post_thumbnail( 'medium', $args );
									else : ?>
									<img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image.jpg' ); ?>" class="attachment-thumbnail size-thumbnail wp-post-image">
							    <?php endif; ?>                                	
								</a>  
                <!-- summary -->
                <div class="summary">
                	<?php
                    $categories = get_the_category();                    
                    $separator = ' ';
                    $output = '';
                    if ( ! empty( $categories ) ) :                     
                      foreach ( $categories as $cat ) {
                        $output .= '<a class="news-category sec-bg-color" href="'. esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>' . $separator;
                      }
                      echo trim( $output, $separator );
                    endif;
                ?>				                    	
                  <h4 class="pop-news-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                  <small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date(); ?></small>
                </div>
                <!-- summary -->
		          </div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</section>
		<!-- popular news -->

	<?php endif;
endif;