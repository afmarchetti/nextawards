<?php
/**
 * Template for displaying menu trasparent
 *
 * @package nextawards
 */
/*

Template Name: Menu Black

*/
?>
<?php get_header(); ?>

<main id="content" class="grid grid--center" role="main">

<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>

	<div class="col-70">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		
			<?php the_content(esc_html__('Read More...', 'nextawards'));?>
	

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
