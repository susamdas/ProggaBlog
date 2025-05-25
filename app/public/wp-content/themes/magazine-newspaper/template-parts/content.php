<?php
/**
 * Template part for displaying posts.
 *
 * @package magazine-newspaper
 */

$snipet_class = "col-xs-12";
if ( $args['view'] == 'list-view' ) {
  $snipet_class = "col-xs-12";
} else if ( $args['view'] == 'grid-view' ) {
  $snipet_class = "col-xs-6";
} else if ( $args['view'] == 'full-width-view' ) {
  $snipet_class = "col-xs-12";
}

?>

<div class="<?php echo $snipet_class;?>">
    <div class="news-snippet eq-blocks">    
        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="featured-image">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'post-thumbs' ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image.jpg' ); ?>">
            <?php endif; ?> 
        </a>     
    <div class="summary">
        <h4 class="news-title">
            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h4>
        <?php if( ! empty( $post_details ) && is_array( $post_details ) ) : ?>
            <div class="info"><ul class="list-inline">
                <?php foreach ( $post_details as $key => $value ) : ?>
                    

                    <?php if( $value == 'date' ) { ?>
                      <?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day = get_the_time('d'); ?>
                      <li><i class="fa fa-clock-o"></i> <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><?php echo get_the_date(); ?></a></li>
                    <?php } ?>

                    <?php if( $value == 'categories' ) { ?>
                      <?php $categories = get_the_category();
                        if( ! empty( $categories ) ) :
                          foreach ( $categories as $cat ) { ?>
                            <li><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></li>
                          <?php }
                        endif; ?>
                    <?php } ?>

                    <?php if( $value == 'tags' ) { ?>
                      <?php $tags = get_the_tags();
                        if( ! empty( $tags ) ) :
                          foreach ( $tags as $tag ) { ?>
                            <li><a href="<?php echo esc_url( get_category_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
                          <?php }
                        endif; ?>
                    <?php } ?>
                    

                    <?php if( $value == 'number_of_comments' ) { ?>
                      <li><i class="fa fa-comments-o"></i> <?php comments_popup_link( __( 'zero comment', 'magazine-newspaper' ), __( 'one comment', 'magazine-newspaper' ), __( '% comments', 'magazine-newspaper' ) ); ?></li>
                    <?php } ?>
                <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>




        <?php the_excerpt(); ?>
        <?php if( ! empty( $post_details ) && is_array( $post_details ) ) : ?>
            <div class="info"><ul class="list-inline">
                <?php foreach ( $post_details as $key => $value ) : ?>
                    <?php if( $value == 'author' ) { ?>
                      <li>
                        <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                          <?php $avatar = get_avatar( get_the_author_meta( 'ID' ), $size = 60 ); ?>
                          <?php if( $avatar ) : ?>
                            <div class="author-image"> 
                              <?php echo $avatar; ?>
                            </div>
                          <?php endif; ?>
                          <?php echo esc_html( get_the_author() ); ?>
                        </a>
                     </li>
                    <?php } ?>

                    
                <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>     
        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="" class="readmore"><?php esc_html_e('Read More','magazine-newspaper'); ?> </a>
    </div>
</div>
</div>
