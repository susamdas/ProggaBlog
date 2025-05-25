<?php

if ( get_theme_mod( 'magazine_newspaper_banner_news_display', $default = true ) ) {
    ?>
  <!-- banner-news -->
  <?php 
    $category_id = get_theme_mod( 'magazine_newspaper_banner_news_category', '' );
    $title = get_theme_mod( 'magazine_newspaper_banner_news_title', '' );
    $number_of_posts = get_theme_mod( 'magazine_newspaper_banner_news_number_of_posts', 3 );
    $category_args = array(
        'cat'            => $category_id,
        'posts_per_page' => $number_of_posts,
    );
    $query = new WP_Query($category_args);
    $slider_details = get_theme_mod( 'magazine_newspaper_slider_details', array('date', 'categories') );
    set_query_var( 'query', $query );
    set_query_var( 'title', $title );
    set_query_var( 'slider_details', $slider_details );
    ?>

  <?php 
    if ( $query->have_posts() ) {
        ?>

    <?php 
        get_template_part( 'layouts/slider/banner-news/banner-news-layout', 'one' );
        ?>
  <?php 
    }
    ?>
  <!-- banner-news -->
<?php 
}