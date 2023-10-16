<?php 
/* Typography Section */
	$wp_customize->add_section( 'nextawards_typography' , array(
    'title'      => __( 'Typography', 'nextawards' ),
    'priority'   => 30,
	));

	/* Font Name */
	$wp_customize->add_setting( 'nextawards_google_font' , array(
    'default'   => 'Barlow',
    'transport' => 'refresh',
		'sanitize_callback' => 'nextawards_sanitize_callback_function',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nextawards_google_font_control', array(
		'label'      => __( 'Google Font Headings (ex. Roboto )', 'nextawards' ),
		'section'    => 'nextawards_typography',
		'settings'   => 'nextawards_google_font',
		'type'   => 'text'			
	)) );

	/* Font Weights */
	$wp_customize->add_setting( 'nextawards_google_font_weight' , array(
    'default'   => '300,400,700',
    'transport' => 'refresh',
		'sanitize_callback' => 'nextawards_sanitize_callback_function',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nextawards_google_font_weight_control', array(
		'label'      => __( 'Font Weight (ex. 300,400,700 )', 'nextawards' ),
		'section'    => 'nextawards_typography',
		'settings'   => 'nextawards_google_font_weight',
		'type'   => 'text'			
	)));

	/* Font Body Name */
	$wp_customize->add_setting( 'nextawards_google_font_body' , array(
		'default'   => 'Barlow',
		'transport' => 'refresh',
		'sanitize_callback' => 'nextawards_sanitize_callback_function',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nextawards_google_font_body_control', array(
		'label'      => __( 'Google Font Body (ex. Roboto )', 'nextawards' ),
		'section'    => 'nextawards_typography',
		'settings'   => 'nextawards_google_font_body',
		'type'   => 'text'			
	)));

	/* Link color */
	$wp_customize->add_setting( 'nextawards_link_color' , array(
    'default'   => '#048ea0',
    'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nextawards_link_color_control', array(
		'label'      => __( 'Link Color', 'nextawards' ),
		'section'    => 'colors',
		'settings'   => 'nextawards_link_color',
	)));


	/* Link color hover */
	$wp_customize->add_setting( 'nextawards_link_color_hover' , array(
    'default'   => '#105862',
    'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nextawards_link_color_hover_control', array(
		'label'      => __( 'Link Color Hover', 'nextawards' ),
		'section'    => 'colors',
		'settings'   => 'nextawards_link_color_hover',
	)));

	/* Header Color */
	$wp_customize->add_setting( 'nextawards_header_color' , array(
    'default'   => '#E4E4E4',
    'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nextawards_header_color_control', array(
		'label'      => __( 'Header Color', 'nextawards' ),
		'section'    => 'colors',
		'settings'   => 'nextawards_header_color',
	)));

	/* Border Color */
	$wp_customize->add_setting( 'nextawards_border_color' , array(
    'default'   => '#222222',
    'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nextawards_border_color_control', array(
		'label'      => __( 'Border Color', 'nextawards' ),
		'section'    => 'colors',
		'settings'   => 'nextawards_border_color',
	)));


	/* Header Section */
	$wp_customize->add_section( 'nextawards_header' , array(
    'title'      => __( 'Header & Layouts', 'nextawards' ),
    'priority'   => 35,
	));

	/* Center Logo */
	$wp_customize->add_setting( 'nextawards_center_logo' , array(
    'default'   => 'No',
    'transport' => 'refresh',
		'sanitize_callback' => 'nextawards_sanitize_callback_function',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nextawards_center_logo_control', array(
		'label'      => __( 'Center Logo? (ex. Yes )', 'nextawards' ),
		'section'    => 'nextawards_header',
		'settings'   => 'nextawards_center_logo',
		'type'   => 'text'			
	)) );

	/* Menu Left */
	$wp_customize->add_setting( 'nextawards_menu_left' , array(
	'default'   => 'No',
	'transport' => 'refresh',
		'sanitize_callback' => 'nextawards_sanitize_callback_function',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nextawards_menu_left_control', array(
		'label'      => __( 'Menu Left? (ex. Yes )', 'nextawards' ),
		'section'    => 'nextawards_header',
		'settings'   => 'nextawards_menu_left',
		'type'   => 'text'			
	)) );

	/* Article Image After Title */
	$wp_customize->add_setting( 'nextawards_article_img' , array(
    'default'   => 'No',
    'transport' => 'refresh',
		'sanitize_callback' => 'nextawards_sanitize_callback_function',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nextawards_article_img_control', array(
		'label'      => __( 'Article list image after title? (ex. Yes )', 'nextawards' ),
		'section'    => 'nextawards_header',
		'settings'   => 'nextawards_article_img',
		'type'   => 'text'			
	)) );

	/* WhatsApp */
	$wp_customize->add_setting( 'nextawards_whatsapp' , array(
	'default'   => '',
	'transport' => 'refresh',
		'sanitize_callback' => 'nextawards_sanitize_callback_function',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nextawards_whatsapp_control', array(
		'label'      => __( 'WhatsApp Number (ex. 3933333333)', 'nextawards' ),
		'section'    => 'nextawards_header',
		'settings'   => 'nextawards_whatsapp',
		'type'   => 'text'			
	)) );

	/* Show Search */
	$wp_customize->add_setting( 'nextawards_search' , array(
	'default'   => 'No',
	'transport' => 'refresh',
		'sanitize_callback' => 'nextawards_sanitize_callback_function',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nextawards_search_control', array(
		'label'      => __( 'Show Search (ex. Yes)', 'nextawards' ),
		'section'    => 'nextawards_header',
		'settings'   => 'nextawards_search',
		'type'   => 'text'			
	)) );

    /* Search only products */
	$wp_customize->add_setting( 'nextawards_search_products' , array(
    'default'   => 'No',
    'transport' => 'refresh',
        'sanitize_callback' => 'nextawards_sanitize_callback_function',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nextawards_search_products_control', array(
        'label'      => __( 'Search only products (ex. Yes)', 'nextawards' ),
        'section'    => 'nextawards_header',
        'settings'   => 'nextawards_search_products',
        'type'   => 'text'			
    )) );

     /* Topbar text */
	$wp_customize->add_setting( 'nextawards_topbar_text' , array(
    'default'   => '',
    'transport' => 'refresh',
        'sanitize_callback' => 'nextawards_sanitize_callback_function',
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nextawards_topbar_text_control', array(
        'label'      => __( 'Text in top bar (ex. Black friday sale 10%)', 'nextawards' ),
        'section'    => 'nextawards_header',
        'settings'   => 'nextawards_topbar_text',
        'type'   => 'text'			
    )) );



	/* Sanitize function */
	function nextawards_sanitize_callback_function( $nextawards_input_to_sanitize ) {
    
		return sanitize_text_field( $nextawards_input_to_sanitize );
	
	}