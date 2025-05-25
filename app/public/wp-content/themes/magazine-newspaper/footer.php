<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package magazine-newspaper
 */

?>
	<footer class="pri-bg-color">
		<div class="container">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>
	</footer>
	<div class="copyright text-center">
    <?php $copyright = get_theme_mod( 'magazine_newspaper_copyright_text', '' ); ?>
    <p>
      <span class="editable"><?php echo wp_kses_post( $copyright ); ?></span>
      <?php if ( fs_magazine_newspaper()->is_free_plan() ) : ?>
       | <?php esc_html_e( "Powered by", 'magazine-newspaper' ); ?> <a href="<?php echo esc_url( __( 'https://wordpress.org', 'magazine-newspaper' ) ); ?>"><?php esc_html_e( "WordPress", 'magazine-newspaper' ); ?></a> | <?php esc_html_e( 'Theme by', 'magazine-newspaper' ); ?> <a href="<?php echo esc_url( 'https://thebootstrapthemes.com/' ); ?>"><?php esc_html_e( 'TheBootstrapThemes','magazine-newspaper' );?></a>
      <?php endif; ?>
    </p>
  </div>
	<div class="scroll-top-wrapper">
		<span class="scroll-top-inner"><i class="fa fa-2x fa-angle-up"></i></span>
	</div> 	
	<?php wp_footer(); ?>
	</body>
</html>