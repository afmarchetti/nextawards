<?php
/**
 * Theme: Nextawards
 *
 * Theme Functions, includes, etc.
 *
 * @package nextawards
 */


/* ------------------------------------------------------------------------- *
 *  Base functionality
/* ------------------------------------------------------------------------- */

// fix bug wp 6.9 global block-styles
add_action('init', function () {
    if (!wp_style_is('global-styles', 'registered')) {
        wp_register_style('global-styles', false);
    }
});

// Content width
if ( !isset( $content_width ) ) { $content_width = 720; }


/*  Theme setup
/* ------------------------------------ */
if ( ! function_exists( 'nextawards_setup' ) ) {

	function nextawards_setup() {

		$nextawards_bg_color_defaults = array(
			'default-color'          => 'E4E4E4',
		);
		add_theme_support( 'custom-background', $nextawards_bg_color_defaults );

		// add title
		add_theme_support( "title-tag" );

		// add woocommerce support
		add_theme_support( 'woocommerce' );

		// add woocommerce gallery 
		add_theme_support( 'wc-product-gallery-slider' );
      	add_theme_support( 'wc-product-gallery-zoom' );
    	add_theme_support( 'wc-product-gallery-lightbox' );

		// logo
		$nextawards_logo_defaults = array(
			'height'               => 100,
			'width'                => 400,
			'flex-height'          => true,
			'flex-width'           => true,
			'header-text'          => array( 'site-title', 'site-description' ),
			'unlink-homepage-logo' => true, 
		);
		add_theme_support( 'custom-logo', $nextawards_logo_defaults );

		// Enable automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// responsive embeds css classes
		add_theme_support( "responsive-embeds" );

		// html5
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

		// add default Gutenberg block styles 
		add_theme_support( 'wp-block-styles' );

		// Enable featured image
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'align-wide' );

		// Thumbnail sizes
		add_image_size( 'nextawards_single', 800, 493, true ); //(cropped)
		add_image_size( 'nextawards_big', 1400, 928, true ); 	//(cropped)

		// Custom menu areas
		register_nav_menus( array(
			'header' => esc_html__( 'Header', 'nextawards' ),
			'quickmenu' => esc_html__( 'Quick Menu', 'nextawards' )
		) );

		// Load theme languages
		load_theme_textdomain( 'nextawards', get_template_directory().'/languages' );

		// Adds support for editor color palette.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Light Color', 'nextawards' ),
				'slug'  => 'light-gray',
				'color'	=> esc_attr(get_theme_mod( 'nextawards_header_color', '#E4E4E4')),
			),
			array(
				'name'  => __( 'Medium Color', 'nextawards' ),
				'slug'  => 'medium-gray',
				'color' => esc_attr(get_theme_mod( 'nextawards_footer_color', '#cecece')),
			),
			array(
				'name'  => __( 'Dark Color', 'nextawards' ),
				'slug'  => 'dark-gray',
				'color' => esc_attr(get_theme_mod( 'nextawards_header_scroll_color', '#222222')),
			),
			array(
				'name'  => __( 'Accent Color', 'nextawards' ),
				'slug'  => 'link-color',
				'color' => esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')),
			),
			array(
				'name'  => __( 'Accent Color Hover', 'nextawards' ),
				'slug'  => 'link-color-hover',
				'color' => esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')),
			),
			array(
				'name'  => __( 'Secondary Accent Color', 'nextawards' ),
				'slug'  => 'secondary-color',
				'color' => esc_attr(get_theme_mod( 'nextawards_secondary_button_color', '#ea5a39')),
			),
		));

		// block style quote
		register_block_style(
				'core/quote',
				array(
						'name'         => 'blue-quote',
						'label'        => __( 'Blue Quote', 'nextawards' ),
						'is_default'   => false,
						'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
				)
		);

		// block style background cover blur
		register_block_style(
				'core/cover',
				array(
						'name'         => 'blur-image',
						'label'        => __( 'Default', 'nextawards' ),
						'is_default'   => true,
						'inline_style' => '',
				)
		);
		register_block_style(
				'core/cover',
				array(
						'name'         => 'blur-image',
						'label'        => __( 'Blur Image', 'nextawards' ),
						'is_default'   => false,
						'inline_style' => '.wp-block-cover.is-style-blur-image > .wp-block-cover__image-background{ filter: blur(10px); }',
				)
		);
		register_block_style(
				'core/cover',
				array(
						'name'         => 'blur-image-more',
						'label'        => __( 'Blur Image More', 'nextawards' ),
						'is_default'   => false,
						'inline_style' => '.wp-block-cover.is-style-blur-image-more > .wp-block-cover__image-background{ filter: blur(25px);}',
				)
		);

		register_block_style(
        		'core/button',
				array(
					'name'         => 'secondary-button',
					'label'        => __( 'Secondary Button', 'nextawards' ),
					'is_default'   => false,
					'inline_style' => '
						.wp-block-button.is-style-secondary-button .wp-block-button__link {
							background-color: '.esc_attr(get_theme_mod( 'nextawards_secondary_button_color', '#ea5a39')).';
							color: '.esc_attr(get_theme_mod( 'nextawards_secondary_button_text_color', '#ffffff')).';
						}
					',
				)
		);
	
		/* block pattern */
		require_once( get_template_directory() . '/functions/patterns.php' );


	}

}
add_action( 'after_setup_theme', 'nextawards_setup' );


/*  Dynamic gradients from Customizer colors
/* ------------------------------------ */
if ( ! function_exists( 'nextawards_hex_to_rgba' ) ) {
	function nextawards_hex_to_rgba( $hex, $alpha = 1 ) {
		$hex = ltrim( $hex, '#' );
		if ( strlen( $hex ) === 3 ) {
			$hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
		}
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
		return "rgba({$r}, {$g}, {$b}, {$alpha})";
	}
}

add_filter( 'wp_theme_json_data_theme', function( $theme_json ) {
	$dark            = get_theme_mod( 'nextawards_header_scroll_color',        '#222222' );
	$light           = get_theme_mod( 'nextawards_header_color',               '#E4E4E4' );
	$medium          = get_theme_mod( 'nextawards_footer_color',               '#cecece' );
	$accent          = get_theme_mod( 'nextawards_link_color',                 '#048ea0' );
	$hover           = get_theme_mod( 'nextawards_link_color_hover',           '#105862' );
	$secondary       = get_theme_mod( 'nextawards_secondary_button_color',       '#ea5a39' );
	$secondary_hover = get_theme_mod( 'nextawards_secondary_button_hover_color', '#d33a32' );

	$google_heading = str_replace( '+', ' ', get_theme_mod( 'nextawards_google_font',      'Barlow' ) );
	$google_body    = str_replace( '+', ' ', get_theme_mod( 'nextawards_google_font_body', 'Barlow' ) );

	$font_families = array(
		array(
			'name'       => sprintf( __( 'Theme Headings (%s)', 'nextawards' ), $google_heading ),
			'slug'       => 'theme-headings',
			'fontFamily' => '"' . $google_heading . '", sans-serif',
		),
		array(
			'name'       => sprintf( __( 'Theme Body (%s)', 'nextawards' ), $google_body ),
			'slug'       => 'theme-body',
			'fontFamily' => '"' . $google_body . '", sans-serif',
		),
		array(
			'name'       => 'System',
			'slug'       => 'system',
			'fontFamily' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
		),
		array(
			'name'       => 'Arial',
			'slug'       => 'arial',
			'fontFamily' => 'Arial, Helvetica, sans-serif',
		),
		array(
			'name'       => 'Helvetica',
			'slug'       => 'helvetica',
			'fontFamily' => '"Helvetica Neue", Helvetica, Arial, sans-serif',
		),
		array(
			'name'       => 'Verdana',
			'slug'       => 'verdana',
			'fontFamily' => 'Verdana, Geneva, sans-serif',
		),
		array(
			'name'       => 'Tahoma',
			'slug'       => 'tahoma',
			'fontFamily' => 'Tahoma, Geneva, sans-serif',
		),
		array(
			'name'       => 'Trebuchet MS',
			'slug'       => 'trebuchet',
			'fontFamily' => '"Trebuchet MS", "Lucida Grande", sans-serif',
		),
		array(
			'name'       => 'Georgia',
			'slug'       => 'georgia',
			'fontFamily' => 'Georgia, "Times New Roman", serif',
		),
		array(
			'name'       => 'Times New Roman',
			'slug'       => 'times',
			'fontFamily' => '"Times New Roman", Times, serif',
		),
		array(
			'name'       => 'Courier New',
			'slug'       => 'courier',
			'fontFamily' => '"Courier New", Courier, monospace',
		),
	);

	$legacy = array(
		array(
			'name'     => 'Black',
			'slug'     => 'black',
			'gradient' => 'linear-gradient(135deg, rgba(0, 0, 0, 1), rgba(20, 17, 30, 0))',
		),
		array(
			'name'     => 'Brown',
			'slug'     => 'brow',
			'gradient' => 'linear-gradient(135deg, rgba(81, 31, 31, 1), rgba(97, 97, 97, 0))',
		),
		array(
			'name'     => 'Blue',
			'slug'     => 'blue',
			'gradient' => 'linear-gradient(135deg, rgba(84, 73, 113, 1), rgba(35, 26, 28, 1))',
		),
		array(
			'name'     => 'Green',
			'slug'     => 'green',
			'gradient' => 'linear-gradient(135deg, rgba(101, 216, 82, 1), rgba(27, 216, 179, 1))',
		),
		array(
			'name'     => 'Purple',
			'slug'     => 'purple',
			'gradient' => 'linear-gradient(135deg, rgba(192, 43, 230, 1), rgba(74, 38, 173, 1))',
		),
	);

	$dynamic = array(
		array(
			'name'     => 'Dark Fade',
			'slug'     => 'dark-fade',
			'gradient' => "linear-gradient(135deg, {$dark} 0%, ".nextawards_hex_to_rgba( $dark, 0 )." 100%)",
		),
		array(
			'name'     => 'Light to Medium',
			'slug'     => 'light-to-medium',
			'gradient' => "linear-gradient(135deg, {$light} 0%, {$medium} 100%)",
		),
		array(
			'name'     => 'Accent Fade',
			'slug'     => 'accent-fade',
			'gradient' => "linear-gradient(135deg, {$accent} 0%, ".nextawards_hex_to_rgba( $accent, 0 )." 100%)",
		),
		array(
			'name'     => 'Secondary Blend',
			'slug'     => 'secondary-blend',
			'gradient' => "linear-gradient(135deg, {$secondary} 0%, ".nextawards_hex_to_rgba( $secondary_hover, 0.4 )." 100%)",
		),
		array(
			'name'     => 'Dark to Accent',
			'slug'     => 'dark-to-accent',
			'gradient' => "linear-gradient(135deg, {$dark} 0%, {$accent} 100%)",
		),
		array(
			'name'     => 'Dark to Secondary',
			'slug'     => 'dark-to-secondary',
			'gradient' => "linear-gradient(135deg, {$dark} 0%, {$secondary} 100%)",
		),
		array(
			'name'     => 'Brand Crossover',
			'slug'     => 'accent-to-secondary',
			'gradient' => "linear-gradient(135deg, {$accent} 0%, ".nextawards_hex_to_rgba( $secondary, 0.8 )." 100%)",
		),
	);

	return $theme_json->update_with( array(
		'version'  => 2,
		'settings' => array(
			'color' => array(
				'gradients' => array_merge( $legacy, $dynamic ),
			),
			'typography' => array(
				'fontFamilies' => $font_families,
			),
		),
	) );
} );


/*  Enqueue javascript front
/* ------------------------------------ */
if ( ! function_exists( 'nextawards_scripts' ) ) {

	function nextawards_scripts() {

		// all script
		wp_enqueue_script( 'nextawards-script', get_template_directory_uri() . '/js/script.js', array(),'', true );

		if ( is_singular() && get_option( 'thread_comments' ) )	{ wp_enqueue_script( 'comment-reply' ); }
	}

}
add_action( 'wp_enqueue_scripts', 'nextawards_scripts' );


/*  Enqueue css front
/* ------------------------------------ */
if ( ! function_exists( 'nextawards_styles' ) ) {

	function nextawards_styles() {

		$nextawards_google_font_headings = esc_attr(get_theme_mod( "nextawards_google_font", "Barlow"));
		$nextawards_google_font_body = esc_attr(get_theme_mod( "nextawards_google_font_body", "Barlow"));

		if($nextawards_google_font_headings == $nextawards_google_font_body ){

			wp_enqueue_style( 'nextawards-google-font','//fonts.googleapis.com/css?family='.$nextawards_google_font_headings.':'.esc_attr(get_theme_mod( "nextawards_google_font_weight", "300,400,700")));

		} else {

			wp_enqueue_style( 'nextawards-google-font','//fonts.googleapis.com/css?family='.$nextawards_google_font_headings.':'.esc_attr(get_theme_mod( "nextawards_google_font_weight", "300,400,700")));
			wp_enqueue_style( 'nextawards-google-font-body','//fonts.googleapis.com/css?family='.$nextawards_google_font_body.':400,700');

		}
		
		wp_enqueue_style( 'nextawards', get_template_directory_uri().'/style.css');

	}

}
add_action( 'wp_enqueue_scripts', 'nextawards_styles' );


/*  Register sidebars
/* ------------------------------------ */
if ( ! function_exists( 'nextawards_sidebars' ) ) {

	function nextawards_sidebars()	{
		register_sidebar(array( 'name' => esc_html__( 'Footer', 'nextawards' ),'id' => 'footer','description' => esc_html__( 'Normal full width sidebar.', 'nextawards' ), 'before_widget' => '<div id="%1$s" class="col-33 mb-3 %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	}

}
add_action( 'widgets_init', 'nextawards_sidebars' );


/*  Register editor stylesheet for the theme.
/* ------------------------------------ */
function nextawards_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'nextawards_add_editor_styles' );


/* Customizer Settings
/* ------------------------------------ */
function nextawards_customize_register( $wp_customize ) {

	/* block pattern */
	require_once( get_template_directory() . '/functions/customizer.php' );


	
}
add_action( 'customize_register', 'nextawards_customize_register' );

/* Build CSS rule for <em> from "Font,Weight" customizer value */
/* ------------------------------------ */
function nextawards_italic_em_css( $selector = 'em' ) {
	$raw = trim( get_theme_mod( 'nextawards_italic_font_style', '' ) );
	if ( $raw === '' ) {
		return '';
	}
	$parts  = array_map( 'trim', explode( ',', $raw, 2 ) );
	$font   = isset( $parts[0] ) ? preg_replace( '/[^A-Za-z0-9 \-]/', '', $parts[0] ) : '';
	$weight = isset( $parts[1] ) ? preg_replace( '/[^A-Za-z0-9]/', '', $parts[1] ) : '';

	$decls = '';
	if ( $font !== '' ) {
		$css_font = ( strpos( $font, ' ' ) !== false ) ? '"' . $font . '"' : $font;
		$decls   .= 'font-family:' . $css_font . ';';
	}
	if ( $weight !== '' ) {
		$decls .= 'font-weight:' . $weight . ';';
	}
	if ( $decls === '' ) {
		return '';
	}
	return $selector . '{' . $decls . '}';
}


/* Customizer CSS Front-end */
/* ------------------------------------ */
function nextawards_customize_css(){

	$nextawards_bg_color = get_background_color();
	$nextawards_google_font = esc_attr(get_theme_mod( 'nextawards_google_font', 'Barlow'));
	$nextawards_google_font = str_replace("+", " ", $nextawards_google_font);

	$nextawards_google_font_body = esc_attr(get_theme_mod( 'nextawards_google_font_body', 'Barlow'));
	$nextawards_google_font_body = str_replace("+", " ", $nextawards_google_font_body);


	$nextawards_light     = esc_attr(get_theme_mod( 'nextawards_header_color',          '#E4E4E4'));
	$nextawards_medium    = esc_attr(get_theme_mod( 'nextawards_footer_color',          '#cecece'));
	$nextawards_dark      = esc_attr(get_theme_mod( 'nextawards_header_scroll_color',   '#222222'));
	$nextawards_accent    = esc_attr(get_theme_mod( 'nextawards_link_color',            '#048ea0'));
	$nextawards_accent_h  = esc_attr(get_theme_mod( 'nextawards_link_color_hover',      '#105862'));
	$nextawards_secondary = esc_attr(get_theme_mod( 'nextawards_secondary_button_color','#ea5a39'));

	echo '<style type="text/css">';
	echo ':root {'
		.' --site-bg: #'.$nextawards_bg_color.';'
		.' --link-color: '.$nextawards_accent.';'
		.' --link-color-hover: '.$nextawards_accent_h.';'
		.' --wp--preset--color--light-gray: '.$nextawards_light.';'
		.' --wp--preset--color--medium-gray: '.$nextawards_medium.';'
		.' --wp--preset--color--dark-gray: '.$nextawards_dark.';'
		.' --wp--preset--color--link-color: '.$nextawards_accent.';'
		.' --wp--preset--color--link-color-hover: '.$nextawards_accent_h.';'
		.' --wp--preset--color--secondary-color: '.$nextawards_secondary.';'
		.' }';
	echo 'body, :root :where(body), p, ul, li, ol{font-family: '.$nextawards_google_font_body.'}';
	echo 'h1,h2,h3,h4,h5,h6{font-family: '.$nextawards_google_font.'}';
	echo '.wp-block-button__link:not(.is-style-outline .wp-block-button__link):not(.is-style-secondary-button .wp-block-button__link), input[type=submit].wpcf7-submit{background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')).'}';
    echo '.wp-block-button__link:hover:not(.is-style-outline .wp-block-button__link):not(.is-style-secondary-button .wp-block-button__link),.wp-block-button__link:focus:not(.is-style-outline .wp-block-button__link):focus:not(.is-style-secondary-button .wp-block-button__link), input[type=submit].wpcf7-submit:hover, input[type=submit].wpcf7-submit:focus{background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')).'}';
	echo '.is-style-outline .wp-block-button__link{color: '. esc_attr(get_theme_mod( 'nextawards_border_color', '#222222')).'}';
	echo '.is-style-outline .wp-block-button__link:hover{color: '. esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')).'}';
	echo '.header {background-color: '.esc_attr(get_theme_mod( 'nextawards_header_color', '#E4E4E4')).'}';
	echo '.header__content, .header__menu li {border-color: '.esc_attr(get_theme_mod( 'nextawards_border_color', '#222222')).'}';
	if(esc_attr(get_theme_mod( 'nextawards_center_logo', 'no')) == "Yes"){
		echo '@media (min-width: 768px) {.header__logo{position: absolute; left: 50%; transform: translate(-50%,50%);}.header__logo img{margin-top:-10px}}';
	}
	if(esc_attr(get_theme_mod( 'nextawards_menu_left', 'no')) == "Yes"){
		echo '@media (min-width: 998px) { .header__content{position: relative; justify-content: flex-start;} .header__quick{position: absolute; right:70px;top: 27px}}';
	}
	if( class_exists( 'WooCommerce' ) ){
		echo '.woocommerce .button{background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')).'!important}';
		echo '.woocommerce .button:hover{background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')).'!important}';
		echo '.woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit {background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')).'!important; color:#fff}';
		echo '.woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit:hover {background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')).'!important;color:#fff}';
	}

	echo '.has-light-gray-background-color {background-color: '.esc_attr(get_theme_mod( 'nextawards_header_color', '#E4E4E4')).' }';
	echo '.has-light-gray-color  {color: '.esc_attr(get_theme_mod( 'nextawards_header_color', '#E4E4E4')).' }';

	echo '.has-medium-gray-background-color {background-color: '.esc_attr(get_theme_mod( 'nextawards_footer_color', '#cecece')).' }';
	echo '.has-medium-gray-color  {color: '.esc_attr(get_theme_mod( 'nextawards_footer_color', '#cecece')).' }';

	echo '.has-dark-gray-background-color {background-color: '.esc_attr(get_theme_mod( 'nextawards_header_scroll_color', '#222222')).' }';
	echo '.has-dark-gray-color {color: '.esc_attr(get_theme_mod( 'nextawards_header_scroll_color', '#222222')).' }';

	echo '.has-link-color-background-color {background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')).';}';
	echo '.has-link-color-color {color: '.esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')).';}';

	echo '.has-link-color-hover-background-color {background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')).';}';
	echo '.has-link-color-hover-color {color: '.esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')).';}';

	echo '.has-secondary-color-background-color {background-color: '.esc_attr(get_theme_mod( 'nextawards_secondary_button_color', '#ea5a39')).';}';
	echo '.has-secondary-color-color {color: '.esc_attr(get_theme_mod( 'nextawards_secondary_button_color', '#ea5a39')).';}';

	// footer color
	echo '.footer-content {background-color: '.esc_attr(get_theme_mod( 'nextawards_footer_color', '#cecece')).'; color: '.esc_attr(get_theme_mod( 'nextawards_footer_text_color', '#333')).'}';
	echo '.footer-content hr {border-color: '.esc_attr(get_theme_mod( 'nextawards_border_color', '#222222')).'}';

	if(esc_attr(get_theme_mod( 'nextawards_search_blog', 'no')) == "Yes"){
		echo '#blog-search{display:none}';
	}

	if(esc_attr(get_theme_mod( 'nextawards_header_wide_fix', 'no')) == "Yes"){
		echo '.header__content, .footer-container .grid { max-width: 1300px;}';
		echo '.footer-container{ margin: 0 auto; padding: 0;max-width: 1300px;}';

		echo '@media (min-width: 1450px){ .header__content,.footer-container, .footer-container .grid {max-width: 1500px;} } ';

	}

	if(esc_attr(get_theme_mod( 'nextawards_current_menu_item_style', 'no')) == "Line"){
		echo '@media (min-width: 1190px) { .menu > li.current-menu-item > a::before{ content: ""; position: absolute; left: 16px; right: 16px; bottom: 10px; height: 2px; background: #000; opacity:0.2;}}';
	} else if(esc_attr(get_theme_mod( 'nextawards_current_menu_item_style', 'no')) == "Pill"){
		echo '@media (min-width: 1190px) { .menu > li.current-menu-item > a::before{ content: ""; position: absolute; left: 0px; right: 0px; bottom: 14px; height: 25px; background: #000; opacity:0.15;border-radius:30px;}}';
	} else if(esc_attr(get_theme_mod( 'nextawards_current_menu_item_style', 'no')) == "LinkColor"){	
		echo '.menu li.current-menu-item > a{color: '.esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')).' !important}';
	} else if(esc_attr(get_theme_mod( 'nextawards_current_menu_item_style', 'no')) == "LinkColorHover"){	
		echo '.menu li.current-menu-item > a{color: '.esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')).' !important}';
	}


	echo '@media (min-width: 1190px) {.page-template-menu-trasparent.scroll-down .header, .page-template-align-wide-fix-trasparent.scroll-down .header{background: '.esc_attr(get_theme_mod( 'nextawards_header_scroll_color', '#222222')).'!important}}';

	// secondary button
	echo '.wp-block-button.is-style-secondary-button .wp-block-button__link { background-color: '.esc_attr(get_theme_mod( 'nextawards_secondary_button_color', '#ea5a39')).'; color: '.esc_attr(get_theme_mod( 'nextawards_secondary_button_text_color', '#ffffff')).';}';
	echo '.wp-block-button.is-style-secondary-button .wp-block-button__link:hover { background-color: '.esc_attr(get_theme_mod( 'nextawards_secondary_button_hover_color', '#d33a32')).'; color: '.esc_attr(get_theme_mod( 'nextawards_secondary_button_text_color', '#ffffff')).';}';

	// button border radius
	echo '.wp-block-button .wp-block-button__link, .evi a{ border-radius: '.esc_attr(get_theme_mod( 'nextawards_button_border_radius', '99px')).'}';

	// italic <em> custom font + weight (from customizer) — only inside headings in #content
	echo nextawards_italic_em_css( '#content :is(h1,h2,h3,h4,h5,h6) em' );

	echo '</style>';

}
add_action( 'wp_head', 'nextawards_customize_css');


/* Customizer CSS Back-end */
/* ------------------------------------ */
add_action( 'enqueue_block_assets', 'nextawards_customize_css_iframe_editor' );

function nextawards_customize_css_iframe_editor() {
    if ( is_admin() ) {

		/* Google Font */
		$nextawards_google_font_headings = esc_attr(get_theme_mod( "nextawards_google_font", "Barlow"));
		$nextawards_google_font_body = esc_attr(get_theme_mod( "nextawards_google_font_body", "Barlow"));

		if($nextawards_google_font_headings == $nextawards_google_font_body ){

			wp_register_style( 'nextawards-admin-google-font', 'https://fonts.googleapis.com/css?family='.$nextawards_google_font_headings.':'.esc_attr(get_theme_mod( "nextawards_google_font_weight", "300,400,700")));
			wp_enqueue_style( 'nextawards-admin-google-font' );

		} else {

			wp_register_style( 'nextawards-admin-google-font', 'https://fonts.googleapis.com/css?family='.$nextawards_google_font_headings.':'.esc_attr(get_theme_mod( "nextawards_google_font_weight", "300,400,700")));
			wp_register_style( 'nextawards-admin-google-font-body', 'https://fonts.googleapis.com/css?family='.$nextawards_google_font_body.':400,700');
			
			wp_enqueue_style( 'nextawards-admin-google-font' );
			wp_enqueue_style( 'nextawards-admin-google-font-body' );
		}


		/* Backend Css Custom */
		wp_enqueue_style( 'custom-editor-style', get_template_directory_uri() . '/custom-editor-style.css');
			
			$nextawards_font = esc_attr(get_theme_mod( 'nextawards_google_font', 'Barlow'));
			$nextawards_font = str_replace("+", " ", $nextawards_font);
			
			$nextawards_font_body = esc_attr(get_theme_mod( 'nextawards_google_font_body', 'Barlow'));
			$nextawards_font_body = str_replace("+", " ", $nextawards_font_body);

			$nextawards_link_color = esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0'));
			$nextawards_bg_color = get_background_color();

			$nextawards_border_color = esc_attr(get_theme_mod( 'nextawards_border_color', '#222222'));
			$nextawards_button_border_radius = esc_attr(get_theme_mod( 'nextawards_button_border_radius', '99px'));

			$custom_css = "
				.editor-styles-wrapper .wp-block-post-title,
			    .editor-styles-wrapper .wp-block-heading,
			    .editor-styles-wrapper .wp-block { 
					font-family: {$nextawards_font_body};
				}

				.editor-styles-wrapper .wp-block-heading,
				.editor-styles-wrapper .wp-block-post-title,
				.editor-styles-wrapper .gb-headline:not(p){ font-family: {$nextawards_font}; }
				.editor-styles-wrapper{background: #{$nextawards_bg_color} ;}
				.edit-post-visual-editor .editor-styles-wrapper .wp-block-button__link:not(.is-style-outline .wp-block-button__link):not(.is-style-secondary-button .wp-block-button__link),
				body.editor-styles-wrapper .wp-block-button__link:not(.is-style-outline .wp-block-button__link):not(.is-style-secondary-button .wp-block-button__link){background-color: {$nextawards_link_color } }
				body.editor-styles-wrapper .is-style-outline .wp-block-button__link{color: #{$nextawards_border_color}; }

				.edit-post-visual-editor .editor-styles-wrapper .wp-block-button__link,
				body.editor-styles-wrapper .wp-block-button__link {border-radius: {$nextawards_button_border_radius}; }
				";
			$custom_css .= nextawards_italic_em_css( '.editor-styles-wrapper :is(h1,h2,h3,h4,h5,h6) em' );
			wp_add_inline_style( 'custom-editor-style', $custom_css );
    }
}



/* WooCommerce Cart Icon */
/* ------------------------------------ */
if (  class_exists( 'WooCommerce' ) ) {

	// Add the cart link to menu
	function wpexplorer_add_menu_cart_item_to_menus( $items, $args ) {

		// Make sure your change 'main_menu' to your Menu location !
		if ( 'quickmenu' === $args->theme_location ) {
			$css_class = 'menu-item menu-item-type-cart menu-item-type-woocommerce-cart';
			if ( function_exists( 'is_cart' ) && is_cart() ) {
				$css_class .= ' current-menu-item';
			}
			$items .= '<li class="' . esc_attr( $css_class ) . '">';
				$items .= wpexplorer_menu_cart_item();
			$items .= '</li>';
		}

		return $items;
	}
	add_filter( 'wp_nav_menu_items', 'wpexplorer_add_menu_cart_item_to_menus', 10, 2 );

	// Function returns the main menu cart link
	function wpexplorer_menu_cart_item() {
		$output = '';

		$cart_count = absint( WC()->cart->cart_contents_count );
		$cart_total = WC()->cart->get_cart_total();

		$url = wc_get_cart_url();
		
		$icon = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>';

		$output .= '<a href="'. esc_url( $url ) .'" class="menu-cart-total" aria-label="open cart">';

			$output .= $icon . '<span>'. wp_kses_post( $cart_count ).'</span>';

		$output .= '</a>';

		return $output;
	}


	// Update cart link with AJAX
	function wpexplorer_main_menu_cart_link_fragments( $fragments ) {
		$fragments['.menu-cart-total'] = wpexplorer_menu_cart_item();
		return $fragments;
	}
	add_filter( 'add_to_cart_fragments', 'wpexplorer_main_menu_cart_link_fragments' );
}

?>