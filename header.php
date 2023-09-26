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


	 <header class="header">
    <div class="header__content">

        <?php 
        $nextawards_logo_id = get_theme_mod( 'custom_logo' );
        $nextawards_logo = wp_get_attachment_image_src( $nextawards_logo_id , 'full' );
        if ( has_custom_logo() ) { ?>

          <a class="header__logo" href="<?php echo esc_url(home_url()); ?>"><img class="header__logo-img" src="<?php echo esc_url( $nextawards_logo[0] ); ?>" alt="<?php echo esc_url( get_bloginfo( 'name' )); ?>"></a>
        <?php } else { ?>
          
          <a class="header__logo" href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('title'); ?> </a>
        <?php } ?>


      <button class="icon-hamburger">
            <strong><?php _e( 'Menu', 'nextawards' ); ?></strong>
            <span></span>
            <span></span>
      </button>

			<?php // insert custom menu header
        wp_nav_menu(array(
          'theme_location' => 'header',
          'container' => false,
          'items_wrap' => '<ul class="menu">%3$s</ul>'
        ));
      ?>
    
      <?php if ( has_nav_menu( 'quickmenu' ) ) { ?>
        <div class="header__quick">
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


