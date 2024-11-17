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

		<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>

			<div class="col-70 tab-100">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			

					<h1 class=""><?php the_title(); ?></h1>

					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail('nextawards_single', array('class' => 'img-res mb-2','alt' => get_the_title())); ?>
		      		<?php } ?>


					<div class="text-content">
		      	<?php the_content(esc_html__('Read More...', 'nextawards'));?>
					</div>


				

			</article>

			</div>

		<?php endwhile; ?>
        <?php else : ?>


					<div class="col-100">

                <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'nextawards'); ?></p>

								</div>

        <?php endif; ?>

	</main>

<?php get_footer(); ?>
