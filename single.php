<?php get_header(); ?>

	<main  id="content" class="grid grid--center" role="main">

	<div class="col-70">

		<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<h1 class=""><?php the_title(); ?></h1>

					<p class="meta-article"><strong> <?php the_time('j M , Y') ?> - <?php the_category(','); ?></strong> </p>

					<?php the_post_thumbnail('nextawards_big', array('class' => 'img-res mb-2','alt' => get_the_title())); ?>

					<div class="text-content">
						<?php the_content(esc_html__('Read More...', 'nextawards'));?>
					</div>
					<?php wp_link_pages('pagelink=Page %'); ?>

					<div class="clearfix"></div>

					<hr class="mt-3 mb-3" />


					<?php $post_tags = wp_get_post_tags($post->ID); if(!empty($post_tags)) {?>
						<p class=""> <?php the_tags('', ', ', ''); ?> </p>
					<?php } ?>

					<div id="comments">
						<?php comments_template(); ?>
					</div>


					<div class="alignfull">

<?php /* Custom Loop */

$custom_loop = new WP_Query(array(
'post_type' => 'post',
'category__in' => wp_get_post_categories(get_the_ID()),
'post__not_in' => array(get_the_ID()),
'posts_per_page' => 3,
'orderby' => 'date',
));?>

<div class="grid grid--center pt-4 pb-4">

	<?php if ($custom_loop->have_posts()):?> 

	<div class="col-100">
		<h3 class="text-center text-2">Related Posts</h3>
	</div>
		
		
	<?php while ($custom_loop->have_posts()): $custom_loop->the_post();?>


	<div class="col-33">
		<div class="p-2">
			<a href="<?php the_permalink(); // link to post single page ?>">

				<?php the_post_thumbnail('medium', array('class' => 'img-res pb-2', 'alt' => get_the_title())); // display featured image of the post  ?>
				<h3><?php the_title(); // display title of the post  ?></h3>

			</a>

			<p class="mb-1">
				<strong>
					<?php the_time('j M , Y'); // display date of the post ?>
					- <?php the_category(' ');?>
					<?php $post_tags = wp_get_post_tags($post->ID);if (!empty($post_tags)) {?>
					<?php the_tags('- ', ',  ', '');?>
					<?php }?>
				</strong>
			</p>
		</div>

	</div>

	<?php wp_reset_postdata();?>
	<?php endwhile;endif;?>

</div>

</div>

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
