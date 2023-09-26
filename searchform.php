<?php
/**
 * The template for displaying the Search Form
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package nextawards
 */
 ?>
<form method="get" action="<?php echo esc_url(home_url());  ?>" class="form-search">
    <input type="text" placeholder="<?php esc_attr_e('Try to make a search...', 'nextawards');?>" name="s">
    <button type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title><?php esc_html_e('Search ', 'nextawards'); ?></title><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"/></svg>
    </button>
</form>
