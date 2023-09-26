<?php
// ##########  Do not delete these lines
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
    die (esc_html__('Please do not load this page directly. Thanks!', 'nextawards' )); }
if ( post_password_required() ) { ?>
    <p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'nextawards'); ?></p>
<?php
    return; }
// ##########  End do not delete section

// Display Comments Section
if ( have_comments() ) : ?>
    <h3 id="comments"><?php comments_number( esc_html__( 'No Responses', 'nextawards' ), esc_html__( '1 Response', 'nextawards' ), esc_html__( '% Responses', 'nextawards') ); ?></h3>
        <div class="navigation">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </div>
    <ol class="commentlist">
     <?php
     wp_list_comments(array(
       'avatar_size' => 64,
      ));
      ?>
    </ol>
        <div class="navigation">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </div>
    <?php
    if ( ! comments_open() ) : // There are comments but comments are now closed ?>
    	<p class="nocomments"><?php esc_html_e('Comments are closed.', 'nextawards'); ?></p>
    <?php
    endif;

else : // I.E. There are no Comments
    if ( comments_open() ) : // Comments are open, but there are none yet
        // echo"<p>Be the first to write a comment.</p>";
    else : // comments are closed ?>
       <p class="nocomments"><?php esc_html_e('Comments are closed.', 'nextawards'); ?></p>
    <?php
    endif;
endif;

// Display Form/Login info Section
// the comment_form() function handles this and can be used without any paramaters simply as "comment_form()"
comment_form(array(
  // see codex http://codex.wordpress.org/Function_Reference/comment_form for default values
  // tutorial here http://blogaliving.com/wordpress-adding-comment_form-theme/
  'comment_field' => '<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4" aria-required="true"></textarea></p>',
  'label_submit' => ''.esc_html__('Submit Comment','nextawards').'',
  'comment_notes_after' => ''
  ));

// RSS comments link
echo '<div class="comments_rss">';
post_comments_feed_link(''.esc_html__('Comments RSS Feed', 'nextawards').'');
echo '</div>';

?>
