<?php
/**
 * Skill Section
 *
 * @package Jason_Portfolio_Resume
 */

$default_args = array(
    'panel'    => 'jason_portfolio_resume_front_page_options',
    'title'    => esc_html__( 'Resume Section', 'jason-portfolio-resume' ),
    'priority' => jason_portfolio_resume_priority_section('jason_portfolio_resume_resume_section'),
);
//$wp_customize->add_section(
//    'jason_portfolio_resume_resume_section',
//    $default_args
//);
$wp_customize->add_section(
    new Jason_Portfolio_Resume_Custom_Section(
        $wp_customize,
        'jason_portfolio_resume_resume_section',
        array_merge(
            $default_args,
            array(
                'button_text'      => __( 'Buy Pre', 'jason-portfolio-resume' ),
                'url'              => JASON_PORTFOLIO_RESUME_URL_DEMO,
            )
        )
    )
);

// Skill Section - Enable Section.
$wp_customize->add_setting(
	'jason_portfolio_resume_enable_resume_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
		$wp_customize,
		'jason_portfolio_resume_enable_resume_section',
		array(
			'label'    => esc_html__( 'Enable Resume Section', 'jason-portfolio-resume' ),
			'section'  => 'jason_portfolio_resume_resume_section',
			'settings' => 'jason_portfolio_resume_enable_resume_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'jason_portfolio_resume_enable_resume_section',
		array(
			'selector' => '#my-resume .section-link',
			'settings' => 'jason_portfolio_resume_enable_resume_section',
		)
	);
}


// Headline
$wp_customize->add_setting(
    'jason_portfolio_resume_resume_section_headline',
    array(
        'default'           => __( 'My Resume', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_resume_section_headline',
    array(
        'label'           => esc_html__( 'Headline', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_resume_section',
        'settings'        => 'jason_portfolio_resume_resume_section_headline',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_resume_section_enabled',
    )
);

// Headline
$wp_customize->add_setting(
    'jason_portfolio_resume_resume_section_headline_sub',
    array(
        'default'           => __( 'The services we provide', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_resume_section_headline_sub',
    array(
        'label'           => esc_html__( 'Headline sub', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_resume_section',
        'settings'        => 'jason_portfolio_resume_resume_section_headline_sub',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_resume_section_enabled',
    )
);

// Skill & List Skill
$wp_customize->add_setting(
    'jason_portfolio_resume_resume_section_skill_list',
    array(
        'default'           => '',
        'sanitize_callback' => 'jason_portfolio_resume_customizer_repeater_sanitize',
    )
);
$wp_customize->add_control(
    new Jason_Portfolio_Resume_Customize_Field_Repeater(
        $wp_customize,
        'jason_portfolio_resume_resume_section_skill_list',
        array(
            'label'   => esc_html__('Resume','jason-portfolio-resume'),
            'label_item'   => esc_html__('Resume Item','jason-portfolio-resume'),
            'section' => 'jason_portfolio_resume_resume_section',
            'custom_repeater_title_control' => true,
            'custom_repeater_color_control' => true,
            'custom_repeater_radio_control' => array(
                'name' => 'radio_type',
                'id' => 'radio_type',
                'label' => esc_html__( 'Type', 'jason-portfolio-resume' ),
                'description' => esc_html__( 'This is a custom radio input.', 'jason-portfolio-resume' ),
                'choices' => array(
                    'type_1' => esc_html__( 'Type 1 (for Precent)', 'jason-portfolio-resume' ),
                    'type_2' => esc_html__( 'Type 2 (for Content)', 'jason-portfolio-resume' ),
                ),
            ),
            'custom_repeater_repeater_fields' => array(
                'label' => array('List','Add Row','Delete Row'),
                'key' => 'custom_repeater_repeater_fields',
                'fields' => array(
                    'skill_title' => array('class' => 'trigger_field', 'type' => 'text', 'label' => 'Label'),
                    'skill_precent' => array('class' => 'trigger_field', 'type' => 'text','label' => 'Precent', 'placeholder' => '1-10'),
                    'skill_content' => array('class' => 'trigger_field', 'type' => 'textarea','label' => 'Content'),
                )
            ),
            'active_callback' => 'jason_portfolio_resume_is_resume_section_enabled',
        )
    )
);

