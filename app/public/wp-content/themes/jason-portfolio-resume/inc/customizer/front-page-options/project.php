<?php
/**
 * Skill Section
 *
 * @package Jason_Portfolio_Resume
 */

$default_args = array(
    'panel'    => 'jason_portfolio_resume_front_page_options',
    'title'    => esc_html__( 'Project Section', 'jason-portfolio-resume' ),
    'priority' => jason_portfolio_resume_priority_section('jason_portfolio_resume_project_section'),
);
//$wp_customize->add_section(
//    'jason_portfolio_resume_project_section',
//    $default_args
//);
$wp_customize->add_section(
    new Jason_Portfolio_Resume_Custom_Section(
        $wp_customize,
        'jason_portfolio_resume_project_section',
        array_merge(
            $default_args,
            array(
                'button_text'      => __( 'Buy Pre', 'jason-portfolio-resume' ),
                'url'              => JASON_PORTFOLIO_RESUME_URL_DEMO,
            )
        )
    )
);

// Project Section - Enable Section.
$wp_customize->add_setting(
	'jason_portfolio_resume_enable_project_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'jason_portfolio_resume_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Jason_Portfolio_Resume_Toggle_Switch_Custom_Control(
		$wp_customize,
		'jason_portfolio_resume_enable_project_section',
		array(
			'label'    => esc_html__( 'Enable Project Section', 'jason-portfolio-resume' ),
			'section'  => 'jason_portfolio_resume_project_section',
			'settings' => 'jason_portfolio_resume_enable_project_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'jason_portfolio_resume_enable_project_section',
		array(
			'selector' => '#my-project .section-link',
			'settings' => 'jason_portfolio_resume_enable_project_section',
		)
	);
}

// Headline
$wp_customize->add_setting(
    'jason_portfolio_resume_project_section_headline',
    array(
        'default'           => __( 'My Project', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_project_section_headline',
    array(
        'label'           => esc_html__( 'Headline', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_project_section',
        'settings'        => 'jason_portfolio_resume_project_section_headline',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_project_section_enabled',
    )
);

$wp_customize->add_setting(
    'jason_portfolio_resume_project_section_headline_sub',
    array(
        'default'           => __( 'The services we provide', 'jason-portfolio-resume' ),
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'jason_portfolio_resume_project_section_headline_sub',
    array(
        'label'           => esc_html__( 'Headline', 'jason-portfolio-resume' ),
        'section'         => 'jason_portfolio_resume_project_section',
        'settings'        => 'jason_portfolio_resume_project_section_headline_sub',
        'type'            => 'text',
        'active_callback' => 'jason_portfolio_resume_is_project_section_enabled',
    )
);

// List Project
$wp_customize->add_setting(
    'jason_portfolio_resume_resume_section_project_list',
    array(
        'default'           => '',
        'sanitize_callback' => 'jason_portfolio_resume_customizer_repeater_sanitize',
    )
);
$wp_customize->add_control(
    new Jason_Portfolio_Resume_Customize_Field_Repeater(
        $wp_customize,
        'jason_portfolio_resume_resume_section_project_list',
        array(
            'label'   => esc_html__('Project','jason-portfolio-resume'),
            'label_item'   => esc_html__('Project Item','jason-portfolio-resume'),
            'section' => 'jason_portfolio_resume_project_section',
            'custom_repeater_title_control' => true,
            'custom_repeater_repeater_fields' => array(
                'label' => array('List','Add Row','Delete Row'),
                'key' => 'custom_repeater_repeater_fields',
                'fields' => array(
                    'project_name' => array('class' => 'trigger_field', 'type' => 'text', 'label' => 'Name Project'),
                    'project_category' => array('class' => 'trigger_field', 'type' => 'text', 'label' => 'Category'),
                    'project_image' => array('class' => 'trigger_field', 'type' => 'image', 'label' => 'Image'),
                    'project_url' => array('class' => 'trigger_field', 'type' => 'text','label' => 'URL', 'placeholder' => '#'),
                )
            ),
            'active_callback' => 'jason_portfolio_resume_is_project_section_enabled',
        )
    )
);
