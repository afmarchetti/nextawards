<?php
/**
 * Theme: Nextawards
 *
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Also it's used to display search results, category page, tag page and date page.
 *
 * @package nextawards
 */
 get_header(); ?>

	
			<div class="grid">
				<div class="col-100">
				<?php get_search_form(); ?>
				</div>
			</div>
			


	<main id="content" class="grid" role="main">

	<div class="col-100">

		<?php if ( is_search() ) { ?>
			<h1 class="mb-3"><?php esc_html_e('Result for:', 'nextawards'); ?> <strong><i><?php echo esc_html($s); ?></i></strong></h1>
		<?php } else  if ( is_category() || is_tag() ) { ?>
			<h1 class="mb-3"><?php echo single_cat_title() ?></h1>
		<?php } else if ( is_home() ){ ?>
			<h1 class="mb-3"><?php echo get_bloginfo( 'name' ); ?> <span class="text-3 light"><?php echo get_bloginfo( 'description' ); ?></span></h1>
		<?php } else if ( is_date() ){ ?>
			<h1 class="mb-3"><?php single_month_title(' '); ?> </h1>
		<?php } else if ( is_archive() ){ ?>
			<h1 class="mb-3"><?php post_type_archive_title(); ?> </h1>
		<?php } ?>

		</div>

		<?php if (have_posts()) :?><?php while(have_posts()) : the_post(); ?>


			<div class="col-50 mb-3">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if(esc_attr(get_theme_mod( 'nextawards_article_img', 'No')) == 'No') { ?> 

						<a href="<?php the_permalink(); ?>" class="">
							<?php the_post_thumbnail('nextawards_single', array('class' => 'img-res mb-2','alt' => get_the_title())); ?>
						</a>

					<?php } ?>


					<h2 class=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<?php if ( 'post' == get_post_type() ){ ?>

						<p class=""> <strong><?php the_time('j M , Y') ?> - <?php the_category(','); ?></strong></p>

					<?php } ?>


					<?php if(esc_attr(get_theme_mod( 'nextawards_article_img', 'No')) == 'Yes') { ?> 

						<a href="<?php the_permalink(); ?>" class="">
							<?php the_post_thumbnail('nextawards_single', array('class' => 'img-res mb-2','alt' => get_the_title())); ?>
						</a>

					<?php } ?>

					<?php the_excerpt();?>


					<?php $post_tags = wp_get_post_tags($post->ID); if(!empty($post_tags)) { ?>
						<p><span class=""> <?php the_tags('', ', ', ''); ?> </span></p>
					<?php } ?>


			</article>

			<div class="clearfix"></div>

			</div>

		<?php endwhile; ?>

		<div class="col-100">

				<div class="pagination">

					<?php
					global $wp_query;
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages
					) );
					?>

				</div>


			</div>

		<?php else : ?>

			<div class="col-100">

					<h3><?php esc_html_e('Sorry, no posts matched your criteria.', 'nextawards'); ?></h3>
					

				<?php get_search_form(); ?>


		</div>

		
        <?php endif; ?>

	</main>


<?php get_footer(); ?>
