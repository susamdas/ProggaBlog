<?php
/**
 * Construction Landing Page Theme Info
 *
 * @package construction_landing_page
 */


if( class_exists( 'WP_Customize_control' ) ){

	class Themoments_Theme_Info extends WP_Customize_Control
	{
    	/**
       	* Render the content on the theme customizer page
       	*/
       	public function render_content()
       	{
       		?>
       		<label>
       			<strong class="customize-text_editor"><?php echo esc_html( $this->label ); ?></strong>
       			<br />
       			<span class="customize-text_editor_desc">
       				<?php echo wp_kses_post( $this->description ); ?>
       			</span>
       		</label>
       		<?php
       	}
    }//editor close
    
}//class close

function magazine_newspaper_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'theme_info' , array(
		'title'       => __( 'Demo and Documentation' , 'magazine-newspaper' ),
		'priority'    => 6,
	) );
        
    $wp_customize->add_setting( 'setup_instruction', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new Themoments_Theme_Info( $wp_customize, 'setup_instruction', array(
		'settings'		=> 'setup_instruction',
		'section'		=> 'theme_info',
		'description'	=> __( 'Check out step-by-step tutorial to create your website like the demo of Magazine Newspaper WordPress theme.', 'magazine-newspaper'),
	) ) );
    

	$wp_customize->add_setting( 'theme_info_theme', array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
	) );
    
    $theme_info = '';
	
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Demo', 'magazine-newspaper' ) . ': </label><a href="' . esc_url( 'https://thebootstrapthemes.com/previews/magazine-newspaper-pro/' ) . '" target="_blank">' . __( 'Click Here', 'magazine-newspaper' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Details', 'magazine-newspaper' ) . ': </label><a href="' . esc_url( 'https://thebootstrapthemes.com/magazine-newspaper/' ) . '" target="_blank">' . __( 'Click Here', 'magazine-newspaper' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'How to use', 'magazine-newspaper' ) . ': </label><a href="' . esc_url( 'https://thebootstrapthemes.freshdesk.com/support/solutions/folders/44001184343' ) . '" target="_blank">' . __( 'Click Here', 'magazine-newspaper' ) . '</a></span><br />';

	$wp_customize->add_control( new Themoments_Theme_Info( $wp_customize ,'theme_info_theme',array(
		'section' => 'theme_info',
		'description' => $theme_info
	) ) );
}
add_action( 'customize_register', 'magazine_newspaper_customizer_theme_info' );