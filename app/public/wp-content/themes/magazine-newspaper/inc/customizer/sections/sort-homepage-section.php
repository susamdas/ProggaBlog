<?php
/**
 * Rearrange Sections
 *
 * @package magazine-newspaper
 */
add_action( 'customize_register', 'magazine_newspaper_sort_homepage_sections' );

function magazine_newspaper_sort_homepage_sections( $wp_customize ) {

	$wp_customize->add_section( 'magazine_newspaper_sort_homepage_sections', array(
    'title'          => esc_attr__( 'Rearrange Home Sections', 'magazine-newspaper' ),
	  'description'    => esc_attr__( 'Rearrange Home Sections', 'magazine-newspaper' ),
    'panel'          => '',
    'priority'       => 12,
    'capability'     => 'edit_theme_options',
  ) );

	$wp_customize->add_setting( 'magazine_newspaper_sort_homepage', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_newspaper_sanitize_array',
		'default'     			=> array(
      'top-news-section',
      'ad-slider__premium_only',
      'banner-news-section',
      'recent-news-section',
      'popular-news-section',
      'detail-news-section',
    ),
	) );

	$wp_customize->add_control( new Magazine_Newspaper_Control_Sortable(
		$wp_customize, 'magazine_newspaper_sort_homepage', array(
			'label'    => esc_html__( 'Drag and Drop Sections to rearrange.', 'magazine-newspaper' ),
			'section'  => 'magazine_newspaper_sort_homepage_sections',
			'settings' => 'magazine_newspaper_sort_homepage',
			'type'     => 'sortable',
			'disabled'     => fs_magazine_newspaper()->is_free_plan(),
			'choices'     => array(
				'top-news-section' => esc_attr__( 'Top News Section', 'magazine-newspaper' ),
				'ad-slider__premium_only' => esc_attr__( 'Advertisement Slider', 'magazine-newspaper' ),
				'banner-news-section' => esc_attr__( 'Banner News Section', 'magazine-newspaper' ),
				'recent-news-section' => esc_attr__( 'Recent News Section', 'magazine-newspaper' ),
				'detail-news-section' => esc_attr__( 'Detail News Section', 'magazine-newspaper' ),
				'popular-news-section' => esc_attr__( 'Popular News Section', 'magazine-newspaper' ),
			),
		) 
	) );

	if ( fs_magazine_newspaper()->is_free_plan() ) {
    $wp_customize->add_setting( 'magazine_newspaper_sort_homepage_upgrade_to_pro', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Magazine_Newspaper_Control_Upgrade_To_Pro(
      $wp_customize, 'magazine_newspaper_sort_homepage_upgrade_to_pro', array(
        'section' => 'magazine_newspaper_sort_homepage_sections',
        'settings'    => 'magazine_newspaper_sort_homepage_upgrade_to_pro',
        'title'   => __( 'Rearrange homepage sections and prioritize what your visitors should see first.', 'magazine-newspaper' ),
        'items' => array(
          'one'   => array(
            'title' => __( 'Rearrange sections on the Homepage', 'magazine-newspaper' ),
          ),
        ),
        'button_url'   => esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/#free-vs-pro' ),
        'button_text'   => __( 'Upgrade Now', 'magazine-newspaper' ),
      )
    ) );
    }

}