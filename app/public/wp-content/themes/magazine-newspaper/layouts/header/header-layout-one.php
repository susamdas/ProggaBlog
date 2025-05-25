<?php $header_text_color = get_header_textcolor(); ?>
<header <?php if( has_header_image() ) : ?> style="background:url(<?php echo esc_url( get_header_image() ); ?>)" <?php endif; ?>>
	<!-- top-bar -->
	<section class="sec-bg-color top-nav">
		<div class="container">
			<div class="row">
			<div class="col-sm-6 text-left">
				<?php
				    wp_nav_menu( array(
				            'theme_location'    => 'top',
				            'depth'             => 8,
				            'container'         => 'div',
				            'menu_class'        => 'top-nav list-inline',
				            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				            'walker'            => new Magazine_Newspaper_Wp_Bootstrap_Navwalker()
				        )
				    );
				?>
			</div>

			<?php
				// To store only value which has links :
				if ( ! empty( $social_media ) && is_array( $social_media ) ) {
					$social_media_filtered = array();
					foreach ( $social_media as $value ) {
						if( empty( $value['social_media_link'] ) ) {
							continue;
						}
						$social_media_filtered[] = $value; 
					}
				}
			?>

			<div class="col-sm-6 text-right search-social">
				<?php if( get_theme_mod( 'magazine_newspaper_header_search_display_option', false ) ) : ?>
				<div id="magazine_newspaper_header_search_section" class="search-top"><?php get_search_form( $echo = true ); ?></div>
				<?php endif; ?>
				<?php if ( ! empty( $social_media_filtered ) && is_array( $social_media_filtered ) ) : ?>
					<div id="magazine_newspaper_social_media_sections" class="social-icons">
				        <ul class="list-inline">
				        	<?php foreach ( $social_media_filtered as $value ) { ?>
				        		<?php
				        			$no_space_class = str_replace( 'fa fa-', '', $value['social_media_class'] );
				        			$class = strtolower( $no_space_class );
				        		?>
					            <li class="<?php echo esc_attr( $class ); ?>"><a href="<?php echo esc_url( $value['social_media_link'] ); ?>" target="_blank"><i class="<?php echo esc_attr( $value['social_media_class'] ); ?>"></i></a></li>
				            <?php } ?>
				    	</ul>
					</div>
				<?php endif; ?>
			</div>

			</div>
		</div>
	</section>
	<!-- top-bar -->

	<section class="logo">
		<div class="container">
			<div class="row">
			<!-- Brand and toggle get grouped for better mobile display -->		
			<div class="col-sm-3 text-left">			
				<?php if ( has_custom_logo() ) { the_custom_logo(); } ?>
				<?php if( display_header_text() ) : ?>
      		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
      			<div class="site-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></div>
      			<p class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
      		</a>
      	<?php endif; ?>
			</div>

			<?php if( get_theme_mod( 'magazine_newspaper_enable_header_ad', false ) ) : ?>
			<?php $ad_image = get_theme_mod( 'magazine_newspaper_header_ad_image' ); ?>
			<?php $ad_script = get_theme_mod( 'magazine_newspaper_header_ad_script', '' ); ?>
			<?php $ad_link = get_theme_mod( 'magazine_newspaper_header_ad_link', '' ); ?>
			<div id="magazine_newspaper_header_ad_sections" class="col-sm-9 text-right">
			
			<?php if( ! empty( $ad_image ) ) : ?>
				<?php if( ! empty( $ad_link ) ) : ?>
					<a href="<?php echo esc_url( $ad_link ); ?>" target="_blank">
				<?php endif; ?>
				<img src="<?php echo esc_url( $ad_image ); ?> ">
				<?php if( ! empty( $ad_link ) ) : ?>
					</a>
				<?php endif; ?>
			<?php endif; ?>

			<?php if( ! empty( $ad_script ) ) : ?>
				<?php echo $ad_script; ?>
			<?php endif; ?>
			
			</div>
			<?php endif; ?>

			</div>
		</div> <!-- /.end of container -->
	</section> <!-- /.end of section -->
	<section  class="pri-bg-color main-nav nav-one<?php if( $menu_sticky ) echo ' sticky-header'; ?>">
		<div class="container">
			<nav class="navbar navbar-inverse">
		      	<button type="button" class="navbar-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'magazine-newspaper' ); ?></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		      	</button>	    
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  							
					<?php
			            wp_nav_menu( array(
			                'theme_location'    => 'primary',
			                'depth'             => 8,
			                'container'         => 'div',
			                'menu_class'        => 'nav navbar-nav',
			                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			                'walker'            => new Magazine_Newspaper_Wp_Bootstrap_Navwalker()
			            ) );
			        ?>			        
			    </div> <!-- /.end of collaspe navbar-collaspe -->
			</nav>
		</div>

	</section>
</header>

<?php 
if( get_theme_mod( 'magazine_newspaper_breaking_news_display', true ) ) :
	$breaking_news_title = get_theme_mod( 'magazine_newspaper_breaking_news_title', 'Breaking News' );
	$breaking_news_cat = get_theme_mod( 'magazine_newspaper_breaking_news_category' );
	$args = array(
		'cat' => $breaking_news_cat,
    'posts_per_page' => 6,
	);
	$query = new WP_Query( $args );
?>
	<?php if( $query->have_posts() ) : ?>
		<!-- ticker -->
		<div id="magazine_newspaper_breaking_news" class="container news-ticker">
			<div class="news-ticker-label"><?php echo esc_html( $breaking_news_title ); ?></div>
			<div id="example">
			  <ul>
			  	<?php while( $query->have_posts() ) : $query->the_post(); ?>
			    	<li><small class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date(); ?></small> <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="break-news"><?php the_title(); ?></a></li>
			    <?php endwhile; wp_reset_postdata(); ?>		    
			  </ul>
			</div>
		</div>
		<!-- ticker -->
	<?php endif; ?>
<?php endif;