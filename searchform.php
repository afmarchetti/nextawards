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
    <label for="search-field" class="visually-hidden"><?php esc_html_e('Try to make a search...', 'nextawards');?></label>
   
    <input id="search-field" type="search" placeholder="<?php esc_attr_e('Try to make a search...', 'nextawards');?>" name="s" aria-label="<?php esc_attr_e('Try to make a search...', 'nextawards');?>">
   
    <button type="submit" aria-label="<?php esc_attr_e('Search', 'nextawards'); ?>">
    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" aria-hidden="true" focusable="false">
        <path d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0034.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 00327.3 362.6l94.09 94.09a25 25 0 0035.3-35.3zM97.92 222.72a124.8 124.8 0 11124.8 124.8 124.95 124.95 0 01-124.8-124.8z"/>
    </svg>
    </button>
</form>
