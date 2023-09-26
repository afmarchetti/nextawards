<?php
/**
 * Template for displaying 404 pages (Not Found)
 *
 * @package nextawards
 */

 get_header(); ?>

	<main id="content" class="grid" role="main">

	<div class="col-100">

		<article>

		

				<h1 class=""><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'nextawards' ); ?></h1>
				<h2 class=""><?php esc_html_e( '404 Error', 'nextawards' ); ?></h2>

				<p><?php esc_html_e( 'The page you are trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'nextawards' ); ?></p>

				<?php get_search_form(); ?>

		

		</article>

		</div>

	</main>


<?php get_footer(); ?>
