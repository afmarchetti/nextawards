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
				'name'  => __( 'Light gray', 'nextawards' ),
				'slug'  => 'light-gray',
				'color'	=> '#f5f5f5',
			),
			array(
				'name'  => __( 'Medium gray', 'nextawards' ),
				'slug'  => 'medium-gray',
				'color' => '#999',
			),
			array(
				'name'  => __( 'Dark gray', 'nextawards' ),
				'slug'  => 'dark-gray',
				'color' => '#333',
			),
			array(
				'name'  => __( 'Link Color', 'nextawards' ),
				'slug'  => 'link-color',
				'color' => esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')),
			),
			array(
				'name'  => __( 'Link Color Hover', 'nextawards' ),
				'slug'  => 'link-color-hover',
				'color' => esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')),
			),
		));

		// block style
		register_block_style(
				'core/quote',
				array(
						'name'         => 'blue-quote',
						'label'        => __( 'Blue Quote', 'nextawards' ),
						'is_default'   => true,
						'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
				)
		);
	

		/* block pattern */
		require_once( get_template_directory() . '/functions/patterns.php' );


	}

}
add_action( 'after_setup_theme', 'nextawards_setup' );


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

/* Customizer CSS Front-end */
/* ------------------------------------ */
function nextawards_customize_css(){

	$nextawards_bg_color = get_background_color();
	echo '<style type="text/css">';
	echo ':root { --site-bg: #'.$nextawards_bg_color.'; --link-color: '.esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')).'; --link-color-hover: '.esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')).'; }';
	echo 'body{font-family: '.esc_attr(get_theme_mod( 'nextawards_google_font_body', 'Barlow')).'}';
	echo 'h1,h2,h3,h4,h5,h6{font-family: '.esc_attr(get_theme_mod( 'nextawards_google_font', 'Barlow')).'}';
	echo '.wp-block-button__link{background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')).'}';
    echo '.wp-block-button__link:hover{background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#105862')).'}';
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
	}

	echo '.has-light-gray-background-color {background-color: #f5f5f5 }';
	echo '.has-light-gray-color  {color: #f5f5f5 }';

	echo '.has-medium-gray-background-color {background-color: #999 }';
	echo '.has-medium-gray-color  {color: #999 }';

	echo '.has-dark-gray-background-color {background-color: #333 }';
	echo '.has-dark-gray-color {color: #333 }';

	echo '.has-link-color-background-color {background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')).';}';
	echo '.has-link-color-color {color: '.esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0')).';}';

	echo '.has-link-color-hover-background-color {background-color: '.esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#048ea0')).';}';
	echo '.has-link-color-hover-color {color: '.esc_attr(get_theme_mod( 'nextawards_link_color_hover', '#048ea0')).';}';

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
			$nextawards_font_body = esc_attr(get_theme_mod( 'nextawards_google_font_body', 'Barlow'));

			$nextawards_link_color = esc_attr(get_theme_mod( 'nextawards_link_color', '#048ea0'));
			$nextawards_bg_color = get_background_color();
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
				.edit-post-visual-editor .editor-styles-wrapper .wp-block-button__link,
				body.editor-styles-wrapper .wp-block-button__link{background-color: {$nextawards_link_color } }
					
					";
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

		$output .= '<a href="'. esc_url( $url ) .'" class="menu-cart-total">';

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
