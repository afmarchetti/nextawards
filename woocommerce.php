<?php
/**
 * Template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package nextawards
 */
 get_header(); ?>

	<main id="content" class="grid grid--center" role="main">

		<div class="col-100 woocommerce-content">

			<?php woocommerce_content(); ?>

		</div>

	</main>

<?php get_footer(); ?>
