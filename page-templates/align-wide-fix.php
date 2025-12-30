<?php
/**
 * Template for displaying content
 *
 * @package nextawards
 */
/*

Template Name: Align Wide Fix

*/
?>
<?php get_header(); ?>

<main id="content" role="main">

<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>

	

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'is-align-system' ); ?>>

			<?php the_content(esc_html__('Read More...', 'nextawards'));?>
		
	</article>


<?php endwhile; ?>
<?php else : ?>

<p><?php esc_html_e('Sorry, no posts matched your criteria.', 'nextawards'); ?></p>

<?php endif; ?>

</main>

<?php get_footer(); ?>
