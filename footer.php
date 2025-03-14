<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the class=container div and all content
 * after.
 *
 * @package nextawards
 */
?>


<footer class="pt-3 pb-3">

	<div class="col-100">
		<hr class="mb-3">
	</div>

	<div class="grid">

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer') ) : ?>

			<?php endif; ?>
		
	</div>

	<div class="grid">

		<div class="col-50">
			<p class="sma-text-center"><?php esc_html_e('&copy; Copyright ', 'nextawards'); ?> <?php echo date("o");?>   <?php bloginfo('name'); ?>  </p>
		</div>
		<div class="col-50">
			<p class="alignright sma-text-center"> <a href="#top" title="scroll top link"  ><i class="fa fa-angle-double-up"></i> <?php esc_html_e('Top ', 'nextawards'); ?></a></p>
		</div>

	</div>

</footer>

</div>

<?php if(esc_attr(get_theme_mod( 'nextawards_whatsapp', '')) != '') { ?> 

	<a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr(get_theme_mod( 'nextawards_whatsapp', '')); ?>" title="whatsapp link" target="_blank" class="logo-whats-app">
		<div class="icon-wa"></div>
	</a>

<?php } ?>

<?php wp_footer();?>

</body>
</html>
