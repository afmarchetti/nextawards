<?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div class="container">.
 *
 * @since nextawards
 */
?><!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta for IE support -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

  
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>


   <?php wp_body_open(); ?>

   <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'nextawards' ); ?></a>


	 <header class="header" role="banner">

  
    <?php if(esc_attr(get_theme_mod( 'nextawards_topbar_text', '')) != '') { ?> 
      <div class="header__topbar">
        <?php echo esc_attr(get_theme_mod( 'nextawards_topbar_text', '')); ?>
      </div>
    <?php } ?>

    <div class="header__content">

        <?php 
        $nextawards_logo_id = get_theme_mod( 'custom_logo' );
        $nextawards_logo = wp_get_attachment_image_src( $nextawards_logo_id , 'full' );


        $nextawards_logo_white = get_theme_mod( 'logo_white' );

        ?>

        <?php if ( has_custom_logo() ) { ?>

          <a class="header__logo" href="<?php echo esc_url(home_url()); ?>">
          
            <?php if ( $nextawards_logo_white && is_page_template( 'page-templates/menu-trasparent.php'  )) { ?>

                 <img class="header__logo_white-img hide-mobile" src="<?php echo esc_url( $nextawards_logo_white ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                 <img class="header__logo-img hide-desktop" src="<?php echo esc_url( $nextawards_logo[0] ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
            <?php } else { ?> 

              <img class="header__logo-img" src="<?php echo esc_url( $nextawards_logo[0] ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
           
            <?php } ?>

          </a>

          <?php } else { ?>
          
          <a class="header__logo" href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('title'); ?> </a>
        <?php } ?>


      <button class="icon-hamburger" aria-expanded="false" aria-controls="main-menu" aria-label="open main menu">
            <strong><?php _e( 'Menu', 'nextawards' ); ?></strong>
            <span></span>
            <span></span>
      </button>

      <nav role="navigation" aria-label="main menu">

        <?php // insert custom menu header
          wp_nav_menu(array(
            'theme_location' => 'header',
            'container' => false,
            'items_wrap' => '<ul class="menu">%3$s</ul>'
          ));
        ?>

      </nav>
    
      <?php if ( has_nav_menu( 'quickmenu' ) ) { ?>
        <div class="header__quick">

            <?php if(esc_attr(get_theme_mod( 'nextawards_search', 'No')) == 'Yes') { ?> 

              <div class="quick-search">
                <form method="get" action="<?php echo esc_url(home_url());  ?>">
                  <button class="quick-search__icon"><span class="icon icon-search"> Search </span></button>

                  <label for="quick-search" class="visually-hidden"><?php esc_html_e('Search...', 'nextawards');?></label>
                  <input id="quick-search"class="quick-search__input" type="search" placeholder="<?php esc_attr_e('Search...', 'nextawards');?>" name="s"  aria-label="<?php esc_attr_e('Search...', 'nextawards');?>">

                  <?php if(esc_attr(get_theme_mod( 'nextawards_search_products', 'No')) == 'Yes') { ?> 

                    <input type="hidden" name="post_type" value="product">

                  <?php } ?>

                </form>
              </div>

            <?php } ?>
            

            <?php // insert quick menu
            wp_nav_menu(array(
              'theme_location' => 'quickmenu',
              'container' => false,
              'items_wrap' => '<ul>%3$s</ul>'
            ));
            ?>
        </div>
      <?php } ?>

     

    </div>
  </header>

  <div class="wrapper load">

	<div class="spacer"></div>


    <?php if (is_page_template( 'page-templates/home-page.php' )) { ?>

  		<!-- seo title home -->
  		<h1 class="home-title"><?php bloginfo('name'); ?> -  <?php bloginfo('description'); ?></h1>

  	<?php } ?>


